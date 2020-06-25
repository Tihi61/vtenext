<?php
$_SESSION['modules_to_update']['ModComments'] = 'packages/vte/mandatory/ModComments.zip';

$labels = array (
	'ALERT_ARR' => array (
		'de_de' => array (
			'LBL_ADD_PICKLIST_VALUE' => 'Bitte mindestens eine neue Angabe machen',
			'LBL_NO_VALUES_TO_DELETE' => 'Keine Daten zum L�schen vorhanden',
			'LBL_FORWARD_EMAIL' => 'Weiterleiten',
			'LBL_PRINT_EMAIL' => 'Drucken',
			'LBL_QUALIFY_EMAIL' => 'Qualifizieren',
			'LBL_REPLY_TO_SENDER' => 'Antworten',
			'LBL_SELECT_ROLE' => 'Bitte mindestens eine Rolle ausw�hlen zu der die neuen Werte geh�ren sollen',
			'LBL_SIZE_SHOULDNOTBE_GREATER' => 'Die Dateigr��e sollte nicht gr��er sein als',
			'VALID_SCANNER_NAME' => 'Bitte geben Sie einen g�ltigen Scanner Namen an (Er sollte nur Buchstaben und Nummern enthalten)',
			'CANT_SELECT_CONTACTS' => 'Aus Leads k�nnen keine verbundenen Kontakte ausgew�hlt werden',
			'DATE_SHOULDNOT_PAST' => 'gegenw�rtige Zeit und Datum Aktivit�ten mit geplantem Status.',
			'DELETE_ACCOUNTS' => 'Wenn Sie diese Konten l�schen, werden die damit verbundenen Potentiale und Angebote auch gel�scht. Sind Sie sicher, dass Sie sie l�schen wollen?',
			'DELETE_RECORDS' => 'Wollen Sie wirklich die %s Datens�tze l�schen?',
			'DELETE_VENDORS' => 'Wenn Sie diese Anbieter l�schen, werden die zugeh�rigen Bestellungen gel�scht. Sind Sie sicher, dass Sie sie l�schen wollen?',
			'DEL_MANDATORY' => 'Sie K�nnen Pflichtfelder nicht l�schen',
			'EMAIL_CHECK_MSG' => 'Um das Email-Feld leer zu speichern m�ssen Sie den Portalzugang sperren',
			'ENDTIME_GREATER_THAN_STARTTIME' => 'Die Endzeit muss sp�ter sein als der Anfang',
			'ERR_MANDATORY_FIELD_VALUE' => 'Einige Pflichtfelder fehlen noch. Bitte f�llen Sie diese aus',
			'ERR_SELECT_EITHER' => 'W�hlen Sie entweder die Organisation oder den Kontakt zur Leadumwandlung',
			'IS_MANDATORY_FIELD' => 'ist Pflichtfeld',
			'LBL_ALERT_EXT_CODE' => 'Es gibt bereits eine Organisation mit demselben externen Code. Wollen sie diese verbinden?',
			'LBL_ARE_YOU_SURE_TO_MOVE_TO' => 'Sind Sie sicher, dass Sie die Datei(en) in das verschieben m�chten in',
			'LBL_BLANK_REPLACEMENT' => 'Es kann kein Leerwert zum ersetzen verwendet werden.',
			'LBL_CLOSE_DATE' => 'Schlie�datum',
			'LBL_DECIMALALERT' => 'Ihre Datenfelder m�ssen das gleiche Zahlenformat haben. Die Anzahl der Dezimalstellen nach dem Komma muss gleich sein.',
			'LBL_DEL' => 'L�schen',
			'LBL_DELETE_MSG' => 'Sind Sie sicher?',
			'LBL_ERROR_WHILE_DELETING_FOLDER' => 'Es gab einen Fehler beim L�schen des Verzeichnisses. Bitte versuchen Sie es noch einmal.',
			'LBL_NO_DATA_SELECTED' => 'Sie haben keine Auswahl getroffen. F�r einen Export m�ssen Sie mindestens einen Eintrag ausw�hlen.',
			'LBL_NO_EMPTY_FOLDERS' => 'Es gibt keine leeren Ordner',
			'LBL_SAVE_LAST_CHANGES' => 'Wollen Sie die letzten �nderungen? Speichern Sie oder brechen Sie ab.',
			'LBL_SEARCH_WITHOUTSEARCH_CURRENTPAGE' => 'Sie haben die Suchfunktion verwendet, um Daten auszuw�hlen. Jedoch haben Sie ihr Exportkriterium darauf nicht bezogen. Wenn Sie auf [ok] klicken werden die Daten Ihrer aktuellen Listenansicht exportiert. Wenn Sie auf [Abbrechen] klicken, k�nnen Sie Ihre Exportkriterien neu bestimmen.',
			'LBL_SELECT_ONE_FILE' => 'Bitte mindestens eine Datei ausw�hlen',
			'LBL_SELECT_PICKLIST' => 'Bitte mindestens einen Eintrag ausw�hlen',
			'LBL_TEMPLATE_MUST_HAVE_PREVIEW_LINK' => 'Sie haben keinen Link f�r eine Vorschau eingebaut. Trotzdem fortfahren?',
			'LBL_TEMPLATE_MUST_HAVE_UNSUBSCRIPTION_LINK' => 'Sie haben keinen Link zur Abbestellung eingebaut. Trotzdem fortfahren?',
			'LBL_TYPEALERT_1' => 'Sie k�nnen nicht',
			'LINE_ITEM' => 'Sortiment',
			'MSG_CONFIRM_FTP_DETAILS' => 'FTP Details best�tigen',
			'MSG_CONFIRM_PATH' => 'Pfaddetails best�tigen',
			'SELECT_ATLEAST_ONEMSG_TO_DEL' => 'Sie m�ssen mindestens eine Nachricht zum L�schen markieren.',
			'SELECT_TEMPLATE_TO_MERGE' => 'Bitte w�hlen Sie f�r das Zusammenf�hren eine Textvorlage aus.',
			'SHOULDBE_LESS_EQUAL' => 'muss weniger oder gleich sein als',
			'SURE_TO_DELETE_CUSTOM_MAP' => 'Sind Sie sicher,dass Sie das Mapping l�schen wollen?',
			'TIME_SHOULDNOT_PAST' => 'Aktuelle Zeit f�r geplante Aktivit�ten',
			'VALID_DISCOUNT_AMOUNT' => 'Bitte geben Sie f�r den Rabatt einen g�ltigen Betrag an.',
			'VALID_DISCOUNT_PERCENT' => 'Bitte geben Sie f�r den Rabatt einen g�ltigen Zahlenwert in Prozent an.',
			'VALID_FINAL_AMOUNT' => 'Bitte geben Sie einen g�ltigen Prozentwert f�r den Rabatt an.',
			'VALID_FINAL_PERCENT' => 'Bitte geben Sie einen g�ltigen Prozentwert f�r den Rabatt an.',
		),
	),
);

foreach($labels as $module => $values) {
	foreach($values as $langid => $translations) {
		foreach($translations as $label => $new_label) {
			SDK::setLanguageEntry($module, $langid, $label, $new_label);
		}
	}
}
?>