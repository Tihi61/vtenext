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


require_once('include/database/PearDatabase.php');
require_once('include/utils/utils.php');
require_once('include/utils/UserInfoUtil.php');

$delete_role_id = $_REQUEST['roleid'];
$delete_role_name = getRoleName($delete_role_id);
global $app_strings;
global $app_list_strings;
global $mod_strings;
$smarty=new VteSmarty();
$smarty->assign("APP", $app_strings);
$smarty->assign("MOD", return_module_language($current_language,'Settings'));
$smarty->assign("CMOD", $mod_strings);
global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
$smarty->assign("IMAGE_PATH",$image_path);

$smarty->assign("ROLEID", $delete_role_id);
$smarty->assign("ROLENAME", $delete_role_name);
$opt = '<a href="javascript:openPopup(\'index.php?module=Users&action=UsersAjax&file=RolePopup&maskid='.$delete_role_id.'&parenttab=Settings\',\'roles_popup_window\',\'height=425,width=640,toolbar=no,menubar=no,dependent=yes,resizable=no\');"><img src="'.$image_path.'select.gif" border="0" align="absmiddle"></a>';//crmv@23800
$smarty->assign("ROLEPOPUPBUTTON", $opt);
$smarty->display("DeleteRole.tpl");

?>
