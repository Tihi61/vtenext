<?php
/*+*******************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ******************************************************************************/
require_once("include/events/SqlResultIterator.inc");
class VTEntityMethodManager{
	
	function __construct($adb){
		$this->adb = $adb;
	}
	
	
	function addEntityMethod($moduleName, $methodName, $functionPath, $functionName){
		$adb = $this->adb;
		global $table_prefix;
		$id = $adb->getUniqueId("com_".$table_prefix."_wft_entitymeth");
		$adb->pquery("insert into com_".$table_prefix."_wft_entitymeth (workflowtasks_entitymethod_id, module_name, function_path, function_name, method_name) values (?,?,?,?,?)", array($id, $moduleName, $functionPath, $functionName, $methodName));
	}
	
	
	
	function executeMethod($entityData, $methodName){
		$adb = $this->adb;
		global $table_prefix;
		$moduleName = $entityData->getModuleName();
		$result = $adb->pquery("select function_path, function_name from com_".$table_prefix."_wft_entitymeth where module_name=? and method_name=?", array($moduleName, $methodName));
		if($adb->num_rows($result)!=0){
			$data = $adb->raw_query_result_rowdata($result, 0);
			$functionPath = $data['function_path'];
			$functionName = $data['function_name'];
			require_once($functionPath);
			$functionName($entityData);
			return true; // crmv@172616
		}
		return false; // crmv@172616
	}
	
	function methodsForModule($moduleName){
		$adb = $this->adb;
		global $table_prefix;
		$result = $adb->pquery("select method_name from com_".$table_prefix."_wft_entitymeth where module_name=?", array($moduleName));
		$it = new SqlResultIterator($adb, $result);
		$methodNames = array();
		foreach($it as $row){
			$methodNames[] = $row->method_name;
		}
		return $methodNames;
	}
	/*
	private function methodExists($object, $methodName){
		$className = get_class($object);
		$class = new ReflectionClass($className);
		$methods = $class->getMethods();
		foreach($methods as $method){
			if($method->getName()==$methodName){
				return true;
			}
		}
		return false;
	}*/
}
?>
