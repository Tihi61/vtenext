<?php
/***************************************************************************************
 * The contents of this file are subject to the CRMVILLAGE.BIZ VTECRM License Agreement
 * ("licenza.txt"); You may not use this file except in compliance with the License
 * The Original Code is:  CRMVILLAGE.BIZ VTECRM
 * The Initial Developer of the Original Code is CRMVILLAGE.BIZ.
 * Portions created by CRMVILLAGE.BIZ are Copyright (C) CRMVILLAGE.BIZ.
 * All Rights Reserved.
 ***************************************************************************************/
if (isset($_REQUEST['day']) && $_REQUEST['day'] != '') {
	VteSession::set('CheckAvailableVersion'.$_REQUEST['day'], true); // crmv@128133
} else {
	VteSession::set('CheckAvailableVersion', true);
}
?>
