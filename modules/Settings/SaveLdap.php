<?php
/*********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is crmvillage.biz.
 * Portions created by vtiger are Copyright (C) crmvillage.biz.
 * All Rights Reserved.
 * 
 ********************************************************************************/
/* crmv@9010 */

require_once("include/utils/utils.php");
global $adb, $default_charset;

// crmv@167234
$params = Array(
	'ldap_active'=>vtlib_purify($_REQUEST['ldap_active']),
	'ldap_host'=>vtlib_purify($_REQUEST['ldap_host']),
	'ldap_port'=>vtlib_purify($_REQUEST['ldap_port']),
	'ldap_basedn'=>html_entity_decode(vtlib_purify($_REQUEST['ldap_basedn']),ENT_QUOTES,$default_charset),
	'ldap_username'=>html_entity_decode(vtlib_purify($_REQUEST['ldap_username']),ENT_QUOTES,$default_charset),
	'ldap_pass'=>html_entity_decode(vtlib_purify($_REQUEST['ldap_pass']),ENT_QUOTES,$default_charset),
	'ldap_objclass'=>vtlib_purify($_REQUEST['ldap_objclass']),
	'ldap_account'=>html_entity_decode(vtlib_purify($_REQUEST['ldap_account']),ENT_QUOTES,$default_charset),
	'ldap_fullname'=>html_entity_decode(vtlib_purify($_REQUEST['ldap_fullname']),ENT_QUOTES,$default_charset),
	'ldap_userfilter'=>html_entity_decode(vtlib_purify($_REQUEST['ldap_userfilter']),ENT_QUOTES,$default_charset),
	'user_role'=>html_entity_decode(vtlib_purify($_REQUEST['user_role']),ENT_QUOTES,$default_charset),
);
// crmv@167234e

//crmv@43764
if ($params['ldap_pass'] == '') {
	$result = $adb->query("select ldap_pass from tbl_s_ldap_config");
	if ($result && $adb->num_rows($result) > 0) {
		$params['ldap_pass'] = $adb->query_result($result,0,'ldap_pass');
	}
}
//crmv@43764e
		
$sql_delete = "delete from tbl_s_ldap_config";
$res = $adb->pquery($sql_delete,Array());

$sql="insert into tbl_s_ldap_config (".implode(",",array_keys($params)).") values (".generateQuestionMarks($params).")";
$adb->pquery($sql, $params);

header("Location:index.php?module=Settings&action=LdapConfig&parenttab=Settings");
?>
