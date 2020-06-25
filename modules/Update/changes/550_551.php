<?php
global $adb;

$_SESSION['modules_to_update']['WSAPP'] = 'packages/vte/mandatory/WSAPP.zip';
$_SESSION['modules_to_update']['SLA'] = 'packages/vte/mandatory/SLA.zip';
$_SESSION['modules_to_install']['Touch'] = 'packages/vte/mandatory/Touch.zip';
$_SESSION['modules_to_install']['ModNotifications'] = 'packages/vte/mandatory/ModNotifications.zip';

$leadsFocus = CRMEntity::getInstance('Leads');
$leadsFocus->updateConvertLead();

SDK::setLanguageEntry('ALERT_ARR','it_it','ERR_SELECT_EITHER','Selezionare Azienda o Contatto per convertire il Lead');
SDK::setLanguageEntry('ALERT_ARR','it_it','ERR_SELECT_ACCOUNT','Selezionare l\'Azienda per procedere');
SDK::setLanguageEntry('ALERT_ARR','it_it','ERR_SELECT_CONTACT','Selezionare il Contatto per procedere');
SDK::setLanguageEntry('ALERT_ARR','it_it','ERR_MANDATORY_FIELD_VALUE','Alcuni valori obbligatori sono mancanti, si prega di inserirli');
SDK::setLanguageEntry('ALERT_ARR','it_it','ERR_POTENTIAL_AMOUNT','L\'Ammontare deve essere un importo valido');
SDK::setLanguageEntry('ALERT_ARR','it_it','ERR_EMAILID','Inserire un valido Email Id');
SDK::setLanguageEntry('ALERT_ARR','it_it','ERR_TRANSFER_TO_ACC','Deve essere selezionata un\'Azienda per trasferire i record relazionati');
SDK::setLanguageEntry('ALERT_ARR','it_it','ERR_TRANSFER_TO_CON','Deve essere selzionato un contatto per trasferire i record relazionati');
SDK::setLanguageEntry('ALERT_ARR','it_it','SURE_TO_DELETE_CUSTOM_MAP','Sei sicuro di voler cancellare la Mappatura Campi?');
SDK::setLanguageEntry('ALERT_ARR','it_it','LBL_CLOSE_DATE','Data Chiusura');
SDK::setLanguageEntry('ALERT_ARR','it_it','LBL_EMAIL','Email');
SDK::setLanguageEntry('ALERT_ARR','it_it','MORE_THAN_500','Hai selezionato pi� di 500 records. Questa operazione potrebbe impiegare molto tempo. Vuoi continuare?');
SDK::setLanguageEntry('ALERT_ARR','it_it','LBL_MAPPEDALERT','Il campo � gi� stato mappato');

SDK::setLanguageEntry('ALERT_ARR','en_us','ERR_SELECT_EITHER','Select either Organization or Contact to convert the lead');
SDK::setLanguageEntry('ALERT_ARR','en_us','ERR_SELECT_ACCOUNT','Select Organization to proceed');
SDK::setLanguageEntry('ALERT_ARR','en_us','ERR_SELECT_CONTACT','Select Contact to proceed');
SDK::setLanguageEntry('ALERT_ARR','en_us','ERR_MANDATORY_FIELD_VALUE','Values for Mandatory Fields are missing');
SDK::setLanguageEntry('ALERT_ARR','en_us','ERR_POTENTIAL_AMOUNT','Potential Amount must be a number');
SDK::setLanguageEntry('ALERT_ARR','en_us','ERR_EMAILID','Enter valid Email Id');
SDK::setLanguageEntry('ALERT_ARR','en_us','ERR_TRANSFER_TO_ACC','Organization should be selected to transfer related records');
SDK::setLanguageEntry('ALERT_ARR','en_us','ERR_TRANSFER_TO_CON','Contact should be selected to transfer related records ');
SDK::setLanguageEntry('ALERT_ARR','en_us','SURE_TO_DELETE_CUSTOM_MAP','Are you sure you want to delete the Field Mapping?');
SDK::setLanguageEntry('ALERT_ARR','en_us','LBL_CLOSE_DATE','Close Date');
SDK::setLanguageEntry('ALERT_ARR','en_us','LBL_EMAIL','Email');
SDK::setLanguageEntry('ALERT_ARR','en_us','MORE_THAN_500','You selected more than 500 records. For this action it may take longer time. Are you sure want to proceed?');
SDK::setLanguageEntry('ALERT_ARR','en_us','LBL_MAPPEDALERT','The field has been already mapped');
 
SDK::setLanguageEntry('ALERT_ARR','pt_br','ERR_SELECT_EITHER','Selecione uma Organiza��o ou Contato para converter o Lead');
SDK::setLanguageEntry('ALERT_ARR','pt_br','ERR_SELECT_ACCOUNT','Selecione Organiza��o para prosseguir');
SDK::setLanguageEntry('ALERT_ARR','pt_br','ERR_SELECT_CONTACT','Selecione Contato para prosseguir');
SDK::setLanguageEntry('ALERT_ARR','pt_br','ERR_MANDATORY_FIELD_VALUE','Est�o faltando valores para Campos Obrigat�rios');
SDK::setLanguageEntry('ALERT_ARR','pt_br','ERR_POTENTIAL_AMOUNT','O valor da Oportunidade deve ser um n�mero');
SDK::setLanguageEntry('ALERT_ARR','pt_br','ERR_EMAILID','Digite um Email v�lido');
SDK::setLanguageEntry('ALERT_ARR','pt_br','ERR_TRANSFER_TO_ACC','A Organiza��o deve ser selecionada para transferir os registros relacionados');
SDK::setLanguageEntry('ALERT_ARR','pt_br','ERR_TRANSFER_TO_CON','O Contato deve ser selecionado paa transferir os registros relacionados');
SDK::setLanguageEntry('ALERT_ARR','pt_br','SURE_TO_DELETE_CUSTOM_MAP','Tem certeza que deseja apagar o Mapeamento de Campos?');
SDK::setLanguageEntry('ALERT_ARR','pt_br','LBL_CLOSE_DATE','Feche Dados');
SDK::setLanguageEntry('ALERT_ARR','pt_br','LBL_EMAIL','Email');
SDK::setLanguageEntry('ALERT_ARR','pt_br','MORE_THAN_500','Voc� selecionou mais de 500 registros. Esta a��o poder� demorar muito tempo. Tem certeza que deseja prosseguir?');
SDK::setLanguageEntry('ALERT_ARR','pt_br','LBL_MAPPEDALERT','O campo j� foi mapeado');

SDK::setLanguageEntry('Leads','it_it','LBL_TRANSFER_RELATED_RECORDS_TO','Trasferisci elementi collegati a');
SDK::setLanguageEntry('Leads','it_it','LBL_ADD_MAPPING','Aggiungi campo da mappare');
SDK::setLanguageEntry('Leads','it_it','LBL_FIELD_SETTINGS','Impostazioni Campi');
SDK::setLanguageEntry('Leads','it_it','LBL_FIELD_MAPPING','Mappatura campi');

SDK::setLanguageEntry('Leads','en_us','LBL_TRANSFER_RELATED_RECORDS_TO','Transfer related records to');
SDK::setLanguageEntry('Leads','en_us','LBL_ADD_MAPPING','Add Mapping');
SDK::setLanguageEntry('Leads','en_us','LBL_FIELD_SETTINGS','Field Settings');
SDK::setLanguageEntry('Leads','en_us','LBL_FIELD_MAPPING','Field Mapping');

SDK::setLanguageEntry('Leads','pt_br','LBL_TRANSFER_RELATED_RECORDS_TO','Transferir registros relacionados para');
SDK::setLanguageEntry('Leads','pt_br','LBL_ADD_MAPPING','Configura��es do Campo');
SDK::setLanguageEntry('Leads','pt_br','LBL_FIELD_SETTINGS','Mapeamento do Campo');
SDK::setLanguageEntry('Leads','pt_br','LBL_FIELD_MAPPING','Adiciona Mapeamento');

$fields = array();
$fields[] = array('module'=>'Users','block'=>'LBL_USERLOGIN_ROLE','name'=>'notify_me_via','label'=>'Notify me via','uitype'=>'15','picklist'=>array('ModNotifications','Emails'));
include('modules/SDK/examples/fieldCreate.php');
SDK::setLanguageEntries('Users', 'Notify me via', array('it_it'=>'Notificami via','en_us'=>'Notify me via','pt_br'=>'Notifique-me via'));
SDK::setLanguageEntries('Users', 'ModNotifications', array('it_it'=>'VTE','en_us'=>'VTE','pt_br'=>'VTE'));
$adb->pquery('update vtiger_users set notify_me_via = ?',array('ModNotifications'));

$adb->pquery('delete from vtiger_settings_field where name = ?',array('NOTIFICATIONSCHEDULERS'));
$adb->pquery('delete from vtiger_settings_field where name = ?',array('INVENTORYNOTIFICATION'));

$pt_br = array(
 'ModNotifications'=>'Notifica��es',
 'SINGLE_ModNotifications'=>'Notifica��o',
 'LBL_MODNOTIFICATION_INFORMATION'=>'Informa��es Notifica��o',
 'LBL_CUSTOM_INFORMATION'=>'Informa��o Customizada',
 'LBL_DESCRIPTION_INFORMATION'=>'Informa��o Descri��o',
 'Notification No'=>'N�mero Notifica��o',
 'Assigned To'=>'Respons�vel',
 'Created Time'=>'Data Cria��o',
 'Modified Time'=>'Hora Modifica��o',
 'Related To'=>'Relacionado �',
 'Description'=>'Descri��o',
 'Type'=>'Tipo',
 'Creator'=>'Criador',
 'Seen'=>'Viu',
 'Subject'=>'Objeto',
 'From Email'=>'Remetente Mail',
 'From Email Name'=>'Nome Remetente',
 'LBL_FOLLOW'=>'Notifique-me de modifica��es',
 'LBL_NOTIFICATION_MODULE_SETTINGS'=>'Configura��es Notifica��es Modulos',
 'LBL_CREATE_NOTIFICATION'=>'Notifique-me a cria��o',
 'LBL_EDIT_NOTIFICATION'=>'Notifique-me a mudan�a',
 'LBL_SHOW_OTHER_NOTIFICATIONS'=>'Mostra outras notifica��es',
 'has changed'=>'mudou',
 'has created and assigned to you'=>'criou e atribui a voc�',
 'responded to'=>'respondiu a',
 'has created'=>'criou',
 'has invited you to'=>'convidou voc� para',
 'will attend'=>'vai partecipar',
 'did not attend'=>'n�o vai partecipar',
 'reminder activity'=>'Aviso atividade',
);
foreach($pt_br as $key => $value){
	SDK::setLanguageEntry('ModNotifications', 'pt_br', $key, $value);
}
?>