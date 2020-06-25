<?php
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/

require_once('include/utils/utils.php');
require_once('user_privileges/CustomQuotesNo.php');
require_once('user_privileges/CustomSalesOrderNo.php');
global $app_strings;
global $mod_strings;
global $currentModule;
global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
global $current_language;

$smarty = new VteSmarty();

$smarty->assign("MOD", return_module_language($current_language,'Settings'));
$smarty->assign("CMOD", $mod_strings);
$smarty->assign("APP", $app_strings);
$smarty->assign("IMAGE_PATH",$image_path);

/*
if($singlepane_view == 'true')
	$viewstatus = 'enabled';
else
	$viewstatus = 'disabled';

$smarty->assign("ViewStatus", $viewstatus);
*/
$mode = $_REQUEST["mode"];

if ($mode=="quotes")
{
   $smarty->assign("str", $quo_str);
   $smarty->assign("no", $quo_no);
} else {
   $smarty->assign("str", $sal_str);
   $smarty->assign("no", $sal_no);
}

$smarty->assign("MODE", $mode);

$smarty->display('Settings/CustomNo.tpl');

?>