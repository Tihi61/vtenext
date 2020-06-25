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

global $app_strings, $mod_strings, $currentModule, $theme, $current_language;

$smarty = new VteSmarty();
$smarty->assign("MOD", return_module_language($current_language,'Settings'));
$smarty->assign("CMOD", $mod_strings);
$smarty->assign("APP", $app_strings);
$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH","themes/$theme/images/");

$scannername = $_REQUEST['scannername'];

//crmv@56233
(empty($scannername)) ? $mode = '' : $mode = 'edit';
$smarty->assign("SAVEMODE", $mode);
//crmv@56233e

$scannerinfo = new Vtiger_MailScannerInfo($scannername);

$smarty->assign("SCANNERINFO", $scannerinfo->getAsMap());
$smarty->assign("FOLDERINFO", $scannerinfo->getFolderInfo());	//crmv@2043m

$smarty->display('MailScanner/MailScannerEdit.tpl');

?>