<?php
/*+********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ********************************************************************************/

require_once('include/database/PearDatabase.php');
global $adb,$table_prefix;
$idlist = vtlib_purify($_REQUEST['idlist']);

if(isset($_REQUEST['idlist']) && $_REQUEST['idlist'] != '' && $_REQUEST['destination_module'] == 'Contacts')
{
	//split the string and store in an array
	$storearray = explode (";",trim($idlist,";"));
	foreach($storearray as $id)
	{
		if($id != '')
		{
			$record = vtlib_purify($_REQUEST['parentid']);
			$sql = "insert into ".$table_prefix."_cntactivityrel values (?,?)";
			$adb->pquery($sql, array($id, $_REQUEST["parentid"]));
		}
	}
		header("Location: index.php?action=CallRelatedList&module=Calendar&activity_mode=Events&record=".$record);
	
}
elseif(isset($_REQUEST['entityid']) && $_REQUEST['entityid'] != '' && $_REQUEST['destination_module'] == 'Contacts')
{
	$record = vtlib_purify($_REQUEST["parentid"]);
	$sql = "insert into ".$table_prefix."_cntactivityrel values (?,?)";
	$adb->pquery($sql, array($_REQUEST["entityid"], $_REQUEST["parentid"]));
	header("Location: index.php?action=DetailView&module=Calendar&activity_mode=Events&record=".$record);
}

//This if for adding the vtiger_users
if(isset($_REQUEST['idlist']) && $_REQUEST['idlist'] != '' && $_REQUEST['destination_module'] == 'Users')
{
	//split the string and store in an array
	$storearray = explode (";",$idlist);
	foreach($storearray as $id)
	{
		if($id != '')
		{
			$record = vtlib_purify($_REQUEST['parentid']);
			$sql = "insert into ".$table_prefix."_salesmanactivityrel values (?,?)";
			$adb->pquery($sql, array($id, $_REQUEST["parentid"]));
		}
	}
	header("Location: index.php?action=DetailView&module=Calendar&activity_mode=Events&record=".$record);
}
elseif(isset($_REQUEST['entityid']) && $_REQUEST['entityid'] != '' && $_REQUEST['destination_module'] == 'Users')
{
	$record = vtlib_purify($_REQUEST['parentid']);
	$sql = "insert into ".$table_prefix."_salesmanactivityrel values (?,?)";
	$adb->pquery($sql, array($_REQUEST["entityid"], $_REQUEST["parentid"]));
	header("Location: index.php?action=DetailView&module=Calendar&activity_mode=Events&record=".$record);
	
}

//crmv@17001 crmv@186446
$dest_mod = vtlib_purify($_REQUEST['destination_module']);
$parenttab = getParentTab();
$forCRMRecord = vtlib_purify($_REQUEST['parentid']);
$action = "DetailView";

$ids = array();
if (!empty($_REQUEST['idlist'])) {
	// Split the string of ids
	$ids = array_filter(explode (";",trim($idlist,";")));
} elseif (!empty($_REQUEST['entityid'])) {
	$ids = array(intval($_REQUEST['entityid']));
}
$focus = CRMEntity::getInstance($currentModule);
if (count($ids) > 0) {
	$focus->save_related_module($currentModule, $forCRMRecord, $dest_mod, $ids, true);
}

header("Location: index.php?action=$action&module=$currentModule&record=".$forCRMRecord."&parenttab=".$parenttab);
//crmv@17001e crmv@186446e