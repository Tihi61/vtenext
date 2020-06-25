{*
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *
 ********************************************************************************/
*}

{* crmv@83878 *}

<div id="formatsElementsContainer" style="display:none;">
	{foreach key=_FIELD_NAME item=_FIELD_INFO from=$AVAILABLE_FIELDS}
		<span id="{$_FIELD_NAME}_format_container" name="{$_FIELD_NAME}_format">
			{assign var="_FIELD_FORMATS" value=$FIELDS_FORMATS[$_FIELD_NAME]}
			{if is_array($_FIELD_FORMATS) && count($_FIELD_FORMATS) > 0} {* crmv@167234 *}
				<select id="{$_FIELD_NAME}_format" name="{$_FIELD_NAME}_format" class="detailedViewTextBox">
					{html_options options=$_FIELD_FORMATS}
				</select>
			{/if}
		</span>
	{/foreach}
</div>
