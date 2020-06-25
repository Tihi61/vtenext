<?php
$_SESSION['modules_to_update']['ModComments'] = 'packages/vte/mandatory/ModComments.zip';
$_SESSION['modules_to_update']['Ddt'] = 'packages/vte/mandatory/Ddt.zip';

SDK::setLanguageEntries('ALERT_ARR','PLS_SELECT_VALID_FILE',array(
'it_it'=>'Selezionare un file con le seguenti estensioni: ',
'en_us'=>'Please select a file with the following extension: ',
'pt_br'=>'Por favor, selecione um arquivo com a seguinte extens�o: ',
'de_de'=>'Bitte w�hlen Sie eine Datei mit einem der folgenden Formate: ',
));
SDK::setLanguageEntries('ALERT_ARR','ERR_SELECT_ATLEAST_ONE_MERGE_CRITERIA_FIELD',array(
'it_it'=>'Selezionare almeno un campo per il controllo duplicati',
'en_us'=>'Select at least one field for merge criteria',
'pt_br'=>'Selecionar pelo menos um campo para os crit�rios de mesclagem',
'de_de'=>'Bitte w�hlen Sie mindesten ein Feld als Kriterium f�r die Zusammenf�hrung',
));
SDK::setLanguageEntries('ALERT_ARR','ERR_FIELDS_MAPPED_MORE_THAN_ONCE',array(
'it_it'=>'Il seguente campo � mappato pi� di una volta. Controllare la mappatura.',
'en_us'=>'Following field is mapped more than once. Please check the mapping.',
'pt_br'=>'Os seguintes campos est�o mapeados mais de um vez. Por favor, verifique o mapeamento.',
'de_de'=>'Das gew�hlte Felde wurde mehrfach zugewiesen. Bitte �berpr�fen Sie die Zuweisungen.',
));
SDK::setLanguageEntries('ALERT_ARR','ERR_PLEASE_MAP_MANDATORY_FIELDS',array(
'it_it'=>'E\' necessario mappare i seguenti campi obbligatori',
'en_us'=>'Please map the following mandatory fields',
'pt_br'=>'Por favor, mapeie os seguintes campos obrigat�rios',
'de_de'=>'Bitte weisen Sie die folgenden Pflichtfelder zu',
));
SDK::setLanguageEntries('ALERT_ARR','ERR_MAP_NAME_CANNOT_BE_EMPTY',array(
'it_it'=>'Inserire un nome per la mappatura',
'en_us'=>'Map name cannot be empty',
'pt_br'=>'O nome do mapeamento n�o pode estar vazio',
'de_de'=>'Bitte vergeben Sie eine Bezeichnung f�r die Zuweisung.',
));
SDK::setLanguageEntries('ALERT_ARR','ERR_MAP_NAME_ALREADY_EXISTS',array(
'it_it'=>'Esiste gi� una mappatura con questo nome.',
'en_us'=>'Map name already exists. Please give a different name',
'pt_br'=>'O nome do mapeamento j� existe. Por favor, d� um nome diferente',
'de_de'=>'Eine Zuweisung mit dieser Bezeichnung existiert bereits. Bitte w�hlen Sie eine andere Bezeichnung.',
));
SDK::setLanguageEntry('Import', 'it_it', 'LBL_VIEW_LAST_IMPORTED_RECORDS', 'Visualizza i record importati');

global $enterprise_current_version,$enterprise_mode;
SDK::setLanguageEntries('APP_STRINGS', 'LBL_BROWSER_TITLE', array(
'it_it'=>"$enterprise_mode $enterprise_current_version",
'en_us'=>"$enterprise_mode $enterprise_current_version",
'pt_br'=>"$enterprise_mode $enterprise_current_version",
'de_de'=>"$enterprise_mode $enterprise_current_version"
));
?>