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
global $adb,$table_prefix;

if(isset($_REQUEST['record']) && $_REQUEST['record']!='')
{
	$query="UPDATE ".$table_prefix."_inventorynotify set notificationsubject=?, notificationbody=? where notificationid=?";
	$params = array($_REQUEST['notifysubject'], $_REQUEST['notifybody'], $_REQUEST['record']);
	$adb->pquery($query, $params);	
}
$loc = "Location: index.php?action=SettingsAjax&file=listinventorynotifications&module=Settings&directmode=ajax";
header($loc);
?>
