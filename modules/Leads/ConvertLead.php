<?php
/*+********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ******************************************************************************* */
//crmv@29463
require_once('data/Tracker.php');
require_once('include/utils/utils.php');
require_once('include/utils/UserInfoUtil.php');
require_once 'include/Webservices/DescribeObject.php';

global $currentModule, $app_strings, $log, $current_user, $theme;

if (isset($_REQUEST['record'])) {
	$id = vtlib_purify($_REQUEST['record']);
	$log->debug(" the id is " . $id);
}
$category = getParentTab();

require_once 'modules/Leads/ConvertLeadUI.php';
$uiinfo = new ConvertLeadUI($id, $current_user);

$smarty = new VteSmarty();
$smarty->assign('APP', $app_strings); // crmv@98824
$smarty->assign('UIINFO', $uiinfo);
$smarty->assign('MODULE', 'Leads');
$smarty->assign('CATEGORY', $category);
$smarty->assign('THEME', $theme);
$smarty->assign('DATE_FORMAT', $current_user->date_format);
$smarty->assign('CAL_DATE_FORMAT', parse_calendardate($app_strings['NTC_DATE_FORMAT']));
$smarty->display(vtlib_getModuleTemplate($currentModule, 'ConvertLead.tpl'));
//crmv@29463e
?>