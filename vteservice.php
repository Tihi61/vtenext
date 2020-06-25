<?php
/*+*******************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ********************************************************************************/

// crmv@148163 - security fix + clean old code
// crmv@181168 - rename file

if (isset($_REQUEST['service'])) {
	if($_REQUEST['service'] == "customerportal") {
		include("soap/customerportal.php");
	} else {
		echo "No Service Configured for ". strip_tags($_REQUEST['service']);
	}
} else {
	echo "<h1>VTECRM Soap Services</h1>\n";
	echo "<ul>\n";
	echo "<li>VTECRM Legacy Customer Portal EndPoint URL -- Click <a href='vteservice.php?service=customerportal'>here</a></li>\n";
	echo "</ul>\n";
}
