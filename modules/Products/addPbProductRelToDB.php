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
require_once('user_privileges/default_module_view.php');
global $adb,$singlepane_view;
global $log;
global $table_prefix;
$idlist = vtlib_purify($_POST['idlist']);
$returnmodule=vtlib_purify($_REQUEST['return_module']);
$returnaction=vtlib_purify($_REQUEST['return_action']);
$pricebook_id=vtlib_purify($_REQUEST['pricebook_id']);
$productid=vtlib_purify($_REQUEST['product_id']);
$parenttab = getParentTab();

$InventoryUtils = InventoryUtils::getInstance(); // crmv@42024

if(isset($_REQUEST['pricebook_id']) && $_REQUEST['pricebook_id']!='')
{
	$currency_id = $InventoryUtils->getPriceBookCurrency($pricebook_id);
	//split the string and store in an array
	$storearray = explode(";",$idlist);
	foreach($storearray as $id)
	{
		if($id != '') {
			$lp_name = $id.'_listprice';
			$list_price = parseUserNumber($_REQUEST[$lp_name]); // crmv@173281
			//Updating the vtiger_pricebook product rel vtiger_table
			$log->info("Products :: Inserting vtiger_products to price book");
			// crmv@150533
			$relid = $adb->getUniqueID($table_prefix."_pricebookproductrel");
			$query= "insert into ".$table_prefix."_pricebookproductrel (pbrelid, pricebookid,productid,listprice,usedcurrency) values(?,?,?,?,?)";
			$adb->pquery($query, array($relid, $pricebook_id,$id,$list_price,$currency_id));
			// crmv@150533e
		}
	}
	if($singlepane_view == 'true')
		header("Location: index.php?module=PriceBooks&action=DetailView&record=$pricebook_id&parenttab=$parenttab");
	else
		header("Location: index.php?module=PriceBooks&action=CallRelatedList&record=$pricebook_id&parenttab=$parenttab");
}
elseif(isset($_REQUEST['product_id']) && $_REQUEST['product_id']!='')
{
	//split the string and store in an array
	$storearray = explode(";",$idlist);
	foreach($storearray as $id)
	{
		if($id != '') {
			$currency_id = $InventoryUtils->getPriceBookCurrency($id);
			$lp_name = $id.'_listprice';
			$list_price = parseUserNumber($_REQUEST[$lp_name]); // crmv@173281
			//Updating the vtiger_pricebook product rel vtiger_table
			$log->info("Products :: Inserting PriceBooks to Product");
			// crmv@150533
			$relid = $adb->getUniqueID($table_prefix."_pricebookproductrel");
			$query= "insert into ".$table_prefix."_pricebookproductrel (pbrelid, pricebookid,productid,listprice,usedcurrency) values(?,?,?,?,?)";
			$adb->pquery($query, array($relid, $id,$productid,$list_price,$currency_id));
			// crmv@150533e
		}
	}
	header("Location: index.php?module=$returnmodule&action=$returnaction&record=$productid&parenttab=$parenttab");
}

?>
