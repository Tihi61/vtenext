<?php 
/*+*************************************************************************************
 * The contents of this file are subject to the VTECRM License Agreement
 * ("licenza.txt"); You may not use this file except in compliance with the License
 * The Original Code is: VTECRM
 * The Initial Developer of the Original Code is VTECRM LTD.
 * Portions created by VTECRM LTD are Copyright (C) VTECRM LTD.
 * All Rights Reserved.
 ***************************************************************************************/

// crmv@167019
// crmv@176893

require_once('modules/Documents/DropArea.php');

$parentModule = vtlib_purify($_REQUEST['pmodule']);
$parentRecord = intval($_REQUEST['precord']);

$DA = DropArea::getInstance();
$html = $DA->fetchDropAreaForm($parentModule, $parentRecord);

$json = array('success' => true, 'title' => getTranslatedString('LBL_SAVE_LABEL') . ' ' . getTranslatedString('Document', 'Documents'), 'html' => $html);

echo Zend_Json::encode($json);
exit();
