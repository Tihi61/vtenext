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
global $php_max_execution_time;

//crmv@184240
if (!is_admin($current_user)) {
	// redirect to settings, where an error will be shown
	header("Location: index.php?module=Settings&action=index&parenttab=Settings");
	die();
}
//crmv@184240e

/* crmv@74560 */
require_once('modules/Users/CreateUserPrivilegeFile.php');
set_time_limit($php_max_execution_time);

$SP = new SharingPrivileges();
$SP->recalcNow();

header("Location: index.php?action=OrgSharingDetailView&parenttab=Settings&module=Settings");
