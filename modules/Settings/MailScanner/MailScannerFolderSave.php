<?php
/*********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * Portions created by VTECRM LTD are Copyright (C) VTECRM LTD.
 * All Rights Reserved.
 *
 ********************************************************************************/
require_once('modules/Settings/MailScanner/core/MailScannerInfo.php');

$scannername = $_REQUEST['scannername'];
$scannerinfo = new Vtiger_MailScannerInfo($scannername);

$folderinfo = Array();
foreach($_REQUEST as $key=>$value) {
	$matches = Array();
	if(preg_match("/folder_([0-9]+)/", $key, $matches)) {
		$folderinfo[$value] = Array('folderid'=>$matches[1], 'enabled'=>1);
	}
}
$scannerinfo->enableFoldersForScan($folderinfo);

//crmv@56233
$spam_folder = vtlib_purify($_REQUEST['spam_folder']);
$scannerinfo->setSpamFolder($spam_folder);
//crmv@56233e

include('modules/Settings/MailScanner/MailScannerInfo.php');
?>