<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

include('adodb/adodb.inc.php');
require_once('vteversion.php'); // crmv@181168

if(version_compare(phpversion(), '7.0') < 0) { // crmv@180737
	require_once('errorpages/phpversionfail.php'); // crmv@138188
	die();
}

//for migration
global $table_prefix;
if (empty($table_prefix)) {
	$table_prefix = 'vtiger';
}

require_once('include/install/language/en_us.lang.php');
require_once('include/install/resources/utils.php');
global $installationStrings, $vtiger_current_version;

// crmv@37463 check permissions
$oldinstall = glob('*install.php.txt');
if (is_array($oldinstall) && count($oldinstall) > 0) die('Unauthorized!');
// crmv@37463e


@include_once('config.db.php');
global $dbconfig, $vtconfig;
if(empty($_REQUEST['file']) && is_array($vtconfig) && $vtconfig['quickbuild'] == 'true') {
	$the_file = 'BuildInstallation.php';
} elseif (!empty($_REQUEST['file'])) {
	$the_file = $_REQUEST['file'];
} else {
	$the_file = "welcome.php";
}

Common_Install_Wizard_Utils::checkFileAccess("install/".$the_file);
include("install/".$the_file);
?>
