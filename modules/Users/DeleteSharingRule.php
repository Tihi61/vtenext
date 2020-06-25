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
/* crmv@184240 */
require_once('include/utils/UserInfoUtil.php');

if (!is_admin($current_user)) {
	// redirect to settings, where an error will be shown
	header("Location: index.php?module=Settings&action=index&parenttab=Settings");
	die();
}

$shareid =  $_REQUEST['shareid'];
deleteSharingRule($shareid);

//crmv@7222
if (isset($_REQUEST['recalculate']) && $_REQUEST['recalculate']=='true' ) {
	require_once('modules/Users/CreateUserPrivilegeFile.php');
	createUserSharingPrivilegesfile($_REQUEST['record']);
	header("Location: index.php?module=".$_REQUEST['return_module']."&action=DetailView&parenttab=Settings&record=".$_REQUEST['record']."&sharing=true");
} elseif (isset($_REQUEST['return_module']) && isset($_REQUEST['record'])) {
	header("Location: index.php?module=".$_REQUEST['return_module']."&action=DetailView&parenttab=Settings&record=".$_REQUEST['record']);
} else {
	header("Location: index.php?module=Settings&action=OrgSharingDetailView&parenttab=Settings");
}
//crmv@7222e
