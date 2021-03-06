<?php
/* +*******************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ******************************************************************************** */

require_once 'include/Webservices/Retrieve.php';
require_once 'include/Webservices/Create.php';
require_once 'include/Webservices/Delete.php';
require_once 'include/Webservices/DescribeObject.php';

function vtws_convertlead($entityvalues, $user) {

	global $adb, $log,$table_prefix;
	if (empty($entityvalues['assignedTo'])) {
		$entityvalues['assignedTo'] = vtws_getWebserviceEntityId('Users', $user->id);
	}
	if (empty($entityvalues['transferRelatedRecordsTo'])) {
		$entityvalues['transferRelatedRecordsTo'] = 'Contacts';
	}


	$leadObject = VtigerWebserviceObject::fromName($adb, 'Leads');
	$handlerPath = $leadObject->getHandlerPath();
	$handlerClass = $leadObject->getHandlerClass();

	require_once $handlerPath;

	$leadHandler = new $handlerClass($leadObject, $user, $adb, $log);


	$leadInfo = vtws_retrieve($entityvalues['leadId'], $user);
	$sql = "select converted from ".$table_prefix."_leaddetails where converted = 1 and leadid=?";
	$leadIdComponents = vtws_getIdComponents($entityvalues['leadId']);
	$result = $adb->pquery($sql, array($leadIdComponents[1]));
	if ($result === false) {
		throw new WebServiceException(WebServiceErrorCode::$DATABASEQUERYERROR,
				vtws_getWebserviceTranslatedString('LBL_' .
						WebServiceErrorCode::$DATABASEQUERYERROR));
	}
	$rowCount = $adb->num_rows($result);
	if ($rowCount > 0) {
		throw new WebServiceException(WebServiceErrorCode::$LEAD_ALREADY_CONVERTED,
				"Lead is already converted");
	}

	$entityIds = array();

	$availableModules = array('Accounts', 'Contacts', 'Potentials');

	if (!(($entityvalues['entities']['Accounts']['create']) || ($entityvalues['entities']['Contacts']['create']))) {
		return null;
	}
	
	$created = Array();  //crmv@49612

	foreach ($availableModules as $entityName) {
		if ($entityvalues['entities'][$entityName]['create']) {
			$entityvalue = $entityvalues['entities'][$entityName];
			$entityObject = VtigerWebserviceObject::fromName($adb, $entityvalue['name']);
			$handlerPath = $entityObject->getHandlerPath();
			$handlerClass = $entityObject->getHandlerClass();

			require_once $handlerPath;

			$entityHandler = new $handlerClass($entityObject, $user, $adb, $log);

			$entityObjectValues = array();
			$entityObjectValues['assigned_user_id'] = $entityvalues['assignedTo'];
			$entityObjectValues = vtws_populateConvertLeadEntities($entityvalue, $entityObjectValues, $entityHandler, $leadHandler, $leadInfo);

			//update potential related to property
			if ($entityvalue['name'] == 'Potentials') {
				if (!empty($entityIds['Accounts'])) {
					$entityObjectValues['related_to'] = $entityIds['Accounts'];
				} else {
					$entityObjectValues['related_to'] = $entityIds['Contacts'];
				}
			}

			//update the contacts relation
			if ($entityvalue['name'] == 'Contacts') {
				if (!empty($entityIds['Accounts'])) {
					$entityObjectValues['account_id'] = $entityIds['Accounts'];
				}
			}

			try {
				$create = true;
				if ($entityvalue['name'] == 'Accounts') {
					$sql = "SELECT ".$table_prefix."_account.accountid FROM ".$table_prefix."_account,".$table_prefix."_crmentity WHERE ".$table_prefix."_crmentity.crmid=".$table_prefix."_account.accountid AND ".$table_prefix."_account.accountname=? AND ".$table_prefix."_crmentity.deleted=0";
					$result = $adb->pquery($sql, array($entityvalue['accountname']));
					if ($adb->num_rows($result) > 0) {
						$entityIds[$entityName] = vtws_getWebserviceEntityId('Accounts', $adb->query_result($result, 0, 'accountid'));
						$create = false;
					}
				}
				if ($create) {
					$entityRecord = vtws_create($entityvalue['name'], $entityObjectValues, $user);
					$entityIds[$entityName] = $entityRecord['id'];
					$created[] = $entityName; //crmv@49612
				}
			} catch (Exception $e) {
				//crmv@36534
				foreach ($entityIds as $entity => $id) {
					if (in_array($entity,$created)) { //crmv@49612
						vtws_delete($id, $user);
					} //crmv@49612
				}
				//crmv@36534 e
				return null;
			}
		}
	}

	try {
		$accountIdComponents = vtws_getIdComponents($entityIds['Accounts']);
		$accountId = $accountIdComponents[1];

		$contactIdComponents = vtws_getIdComponents($entityIds['Contacts']);
		$contactId = $contactIdComponents[1];

		if (!empty($accountId) && !empty($contactId) && !empty($entityIds['Potentials'])) {
			$potentialIdComponents = vtws_getIdComponents($entityIds['Potentials']);
			$potentialId = $potentialIdComponents[1];
			$sql = "insert into ".$table_prefix."_contpotentialrel(contactid,potentialid) values(?,?)";
			$result = $adb->pquery($sql, array($contactId, $potentialIdComponents[1]));
			if ($result === false) {
				throw new WebServiceException(WebServiceErrorCode::$FAILED_TO_CREATE_RELATION,
						"Failed to related Contact with the Potential");
			}
		}
		
		/* crmv@54900 */
		$relatedIdComponents = vtws_getIdComponents($entityIds[$entityvalues['transferRelatedRecordsTo']]);
		vtws_getRelatedActivities($leadIdComponents[1], $accountId, $contactId, $relatedIdComponents[1]);

		$transfered = vtws_convertLeadTransferHandler($leadIdComponents, $entityIds, $entityvalues);

		vtws_updateConvertLeadStatus($entityIds, $entityvalues['leadId'], $user);
		
	} catch (Exception $e) {
		foreach ($entityIds as $entity => $id) {
			vtws_delete($id, $user);
		}
		return null;
	}
	
	return $entityIds;
}

/*
 * populate the entity fields with the lead info.
 * if mandatory field is not provided populate with '????'
 * returns the entity array.
 */

function vtws_populateConvertLeadEntities($entityvalue, $entity, $entityHandler, $leadHandler, $leadinfo) {
	global $adb, $log,$table_prefix;
	$column;
	$entityName = $entityvalue['name'];
	$sql = "SELECT * FROM ".$table_prefix."_convertleadmapping";
	$result = $adb->pquery($sql, array());
	if ($adb->num_rows($result)) {
		switch ($entityName) {
			case 'Accounts':$column = 'accountfid';
				break;
			case 'Contacts':$column = 'contactfid';
				break;
			case 'Potentials':$column = 'potentialfid';
				break;
			default:$column = 'leadfid';
				break;
		}

		$leadFields = $leadHandler->getMeta()->getModuleFields();
		$entityFields = $entityHandler->getMeta()->getModuleFields();
		$row = $adb->fetch_array($result);
		$count = 1;
		do {
			$entityField = vtws_getFieldfromFieldId($row[$column], $entityFields);
			if ($entityField == null) {
				//user doesn't have access so continue.TODO update even if user doesn't have access
				continue;
			}
			$leadField = vtws_getFieldfromFieldId($row['leadfid'], $leadFields);
			if ($leadField == null) {
				//user doesn't have access so continue.TODO update even if user doesn't have access
				continue;
			}
			$leadFieldName = $leadField->getFieldName();
			$entityFieldName = $entityField->getFieldName();
			$entity[$entityFieldName] = $leadinfo[$leadFieldName];
			$count++;
		} while ($row = $adb->fetch_array($result));

		foreach ($entityvalue as $fieldname => $fieldvalue) {
			if (!empty($fieldvalue)) {
				$entity[$fieldname] = $fieldvalue;
			}
		}

		$entity = vtws_validateConvertLeadEntityMandatoryValues($entity, $entityHandler, $leadinfo, $entityName);
	}
	return $entity;
}

function vtws_validateConvertLeadEntityMandatoryValues($entity, $entityHandler, $leadinfo, $module) {

	$mandatoryFields = $entityHandler->getMeta()->getMandatoryFields();
	foreach ($mandatoryFields as $field) {
		if (empty($entity[$field])) {
			$fieldInfo = vtws_getConvertLeadFieldInfo($module, $field);
			if (($fieldInfo['type']['name'] == 'picklist' || $fieldInfo['type']['name'] == 'multipicklist'
				|| $fieldInfo['type']['name'] == 'date' || $fieldInfo['type']['name'] == 'datetime')
				&& ($fieldInfo['editable'] == true)) {
				$entity[$field] = $fieldInfo['default'];
			} else {
				//crmv@36534
				$entity[$field] = '';
				/*
				switch($fieldInfo['type']['name']){
					case 'integer':
					case 'number':
					case 'decimal':
						$entity[$field] = 0;
						break;
					default:
						$entity[$field] = '????';
				}
				*/
				//crmv@36534 e
			}
		}
	}
	return $entity;
}

function vtws_getConvertLeadFieldInfo($module, $fieldname) {
	global $adb, $log, $current_user;
	$describe = vtws_describe($module, $current_user);
	foreach ($describe['fields'] as $index => $fieldInfo) {
		if ($fieldInfo['name'] == $fieldname) {
			return $fieldInfo;
		}
	}
	return false;
}

//function to handle the transferring of related records for lead
function vtws_convertLeadTransferHandler($leadIdComponents, $entityIds, $entityvalues) {

	try {
		global $adb, $table_prefix;
		
		$entityidComponents = vtws_getIdComponents($entityIds[$entityvalues['transferRelatedRecordsTo']]);
		vtws_transferLeadRelatedRecords($leadIdComponents[1], $entityidComponents[1], $entityvalues['transferRelatedRecordsTo']);
		
		//crmv@51894
		require_once('include/utils/EmailDirectory.php');
		$emailDirectory = new EmailDirectory();
  		$emailDirectory->deleteById($leadIdComponents[1]);
  		//crmv@51894e
  		
  		//crmv@63332
  		$contactIdComponents = vtws_getIdComponents($entityIds['Contacts']);
		$transferPersonId = $contactIdComponents[1];
		if (empty($transferPersonId)) { // crmv@127526
	  		$accountIdComponents = vtws_getIdComponents($entityIds['Accounts']);
			$transferPersonId = $accountIdComponents[1];
		}
		// transfer favorites
		$adb->pquery('update vte_favorites set crmid = ? where crmid = ?',array($transferPersonId,$leadIdComponents[1]));
  		//crmv@63332e
  		
  		// crmv@127526
  		// transfer newsletter statistics
  		$adb->pquery('UPDATE tbl_s_newsletter_queue SET crmid = ? WHERE crmid = ?',array($transferPersonId,$leadIdComponents[1]));
  		$adb->pquery('UPDATE tbl_s_newsletter_tl SET crmid = ? WHERE crmid = ?',array($transferPersonId,$leadIdComponents[1]));
  		$adb->pquery('UPDATE tbl_s_newsletter_failed SET crmid = ? WHERE crmid = ?',array($transferPersonId,$leadIdComponents[1]));
  		// crmv@127526e
  		
	} catch (Exception $e) {
		return false;
	}

	return true;
}

function vtws_updateConvertLeadStatus($entityIds, $leadId, $user) {
	global $adb, $log,$table_prefix;
	$leadIdComponents = vtws_getIdComponents($leadId);
	if ($entityIds['Accounts'] != '' || $entityIds['Contacts'] != '') {
		$sql = "UPDATE ".$table_prefix."_leaddetails SET converted = 1 where leadid=?";
		$result = $adb->pquery($sql, array($leadIdComponents[1]));
		if ($result === false) {
			throw new WebServiceException(WebServiceErrorCode::$FAILED_TO_MARK_CONVERTED,
					"Failed mark lead converted");
		}
		//updating the campaign-lead relation --Minnie
		$sql = "DELETE FROM ".$table_prefix."_campaignleadrel WHERE leadid=?";
		$adb->pquery($sql, array($leadIdComponents[1]));

		$sql = "DELETE FROM ".$table_prefix."_tracker WHERE item_id=?";
		$adb->pquery($sql, array($leadIdComponents[1]));

		//update the modifiedtime and modified by information for the record
		$leadModifiedTime = $adb->formatDate(date('Y-m-d H:i:s'), true);
		$crmentityUpdateSql = "UPDATE ".$table_prefix."_crmentity SET modifiedtime=?, modifiedby=? WHERE crmid=?";
		$adb->pquery($crmentityUpdateSql, array($leadModifiedTime, $user->id, $leadIdComponents[1]));
		
		//crmv@182385
		$accountid = null;
		$contactid = null;
		$potentialid = null;
		if ($entityIds['Accounts'] != '') {
			$accontIdComponents = vtws_getIdComponents($entityIds['Accounts']);
			$accountid = $accontIdComponents[1];
		}
		if ($entityIds['Contacts'] != '') {
			$contactIdComponents = vtws_getIdComponents($entityIds['Contacts']);
			$contactid = $contactIdComponents[1];
		}
		if ($entityIds['Potentials'] != '') {
			$potIdComponents = vtws_getIdComponents($entityIds['Potentials']);
			$potentialid = $potIdComponents[1];
		}
		$adb->pquery("insert into {$table_prefix}_leadconvrel (leadid, userid, convtime, accountid, contactid, potentialid) values (?,?,?,?,?,?)", array($leadIdComponents[1], $user->id, $leadModifiedTime, $accountid, $contactid, $potentialid));
		//crmv@182385e
	}
}
?>
