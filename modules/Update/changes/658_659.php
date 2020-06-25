<?php
$_SESSION['modules_to_update']['ModNotifications'] = 'packages/vte/mandatory/ModNotifications.zip';

$moduleInstance = Vtiger_Module::getInstance('ModComments');
if ($moduleInstance) {
	$moduleInstance->setDefaultSharing('Public_ReadWriteDelete');
}

SDK::setLanguageEntries('CustomView', 'LBL_STEP_5_TITLE', array(
'it_it'=>'Filtri basati su Report',
'en_us'=>'Filters based on Report',
'pt_br'=>'Filtros baseado em relat�rio',
));
SDK::setLanguageEntries('Reports', 'LBL_ERROR_PUBLIC_REPORT', array(
'it_it'=>'Per impostare a pubblico il filtro va pubblicato anche il report.',
'en_us'=>'In order to set the filter to public you have also to publish the report.',
'pt_br'=>'Para definir um filtro p�blico, tamb�m deve publicar o relat�rio.',
));
global $adb, $table_prefix;
$sqlarray = $adb->datadict->AddColumnSQL($table_prefix.'_customview','reportid I(19)');
$adb->datadict->ExecuteSQLArray($sqlarray);
?>