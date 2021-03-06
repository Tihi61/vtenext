<?php
/*+*************************************************************************************
 * The contents of this file are subject to the VTECRM License Agreement
 * ("licenza.txt"); You may not use this file except in compliance with the License
 * The Original Code is: VTECRM
 * The Initial Developer of the Original Code is VTECRM LTD.
 * Portions created by VTECRM LTD are Copyright (C) VTECRM LTD.
 * All Rights Reserved.
 ***************************************************************************************/
/* crmv@195745 */

require_once(dirname(__FILE__).'/Base.php');

class PMActionDeleteProductRow extends PMActionBase {
	
	function edit(&$smarty,$id,$elementid,$retrieve,$action_type,$action_id='') {
		$PMUtils = ProcessMakerUtils::getInstance();
		if ($action_id != '') {
			$vte_metadata = Zend_Json::decode($retrieve['vte_metadata']);
			if (!empty($vte_metadata[$elementid])) {
				$metadata_action = $vte_metadata[$elementid]['actions'][$action_id];
				$smarty->assign('METADATA', $metadata_action);
			}
		}
	}
	
	function execute($engine,$actionid) {
		
		$action = $engine->vte_metadata['actions'][$actionid];
		
		(!empty($this->cycleRow['id'])) ? $cycleIndex = $this->cycleRow['id'] : $cycleIndex = $this->cycleIndex;
		
		list($metaid, $fieldid, $relatedmodule, $fieldname) = explode(':', $action['cycle_field']);
		
		$parentId = $engine->getCrmid($metaid, $engine->running_process); //crmv@182891
		$parentModule = getSalesEntityType($parentId);
		
		if (!isInventoryModule($parentModule)) {
			$engine->log("Action {$action['action_type']}","action $actionid - {$action['action_title']} FAILED module $parentModule is not inventory");
			return;
		}
		
		$IU = InventoryUtils::getInstance();
		$IU->removeRowFromRecordByIndex($parentModule, $parentId, $cycleIndex);
		
		$engine->log("Action {$action['action_type']}","action $actionid - {$action['action_title']} completed");
	}
	
}
