{*/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/*}
 
<script language="javascript" type="text/javascript" src="modules/Home/Homestuff.js"></script>

{if $ALLOW_CHARTS eq 'yes'}
	<script language="javascript" type="text/javascript" src="modules/Charts/Charts.js"></script>
{/if}

<input id="homeLayout" type="hidden" value="{$LAYOUT}">

{include file="Home/HomeButtons.tpl"}

<div id="vtbusy_homeinfo" style="display:none;">
	{include file="LoadingIndicator.tpl" LIOLDMODE=true}
</div>

<table width="97%" class="" cellpadding="0" cellspacing="0" border="0" align="center" valign="top">
	<tr><td>{include file="Buttons_List_Contestual.tpl"}</td></tr>
	<tr>
		<td width="100%" align="center" valign="top" height="350">
			<div id="MainMatrix" class="topMarginHomepage" style="padding:0px;width:100%">
				{foreach item=tablestuff from=$HOMEFRAME name="homeframe"}
					{* create divs for each widget - the contents will be loaded dynamically from javascript *}
					{include file="Home/MainHomeBlock.tpl"}
					{* load contents for the widget *}
					<script type="text/javascript">
						{if $tablestuff.Stufftype eq 'Default' && $tablestuff.Stufftitle eq 'Home Page Dashboard'|@getTranslatedString:'Home'}
							VTE.Homestuff.fetch_homeDB({$tablestuff.Stuffid});
						{elseif $tablestuff.Stufftype eq 'DashBoard'}
							VTE.Homestuff.loadStuff({$tablestuff.Stuffid},'{$tablestuff.Stufftype}');
						{/if}
					</script>
				{/foreach}
			</div>
		</td>
	</tr>
</table>

<script type="text/javascript">
	var Vt_homePageWidgetInfoList = [
		{foreach item=tablestuff key=index from=$HOMEFRAME_RESTRICTED name="homeframe"}
			{ldelim}
				'widgetId': {$tablestuff.Stuffid},
				'widgetType': '{$tablestuff.Stufftype}'
			{rdelim}
			{if $index+1 < $HOMEFRAME_RESTRICTED|@count},{/if}
		{/foreach}
	];
	
	VTE.Homestuff.loadAllWidgets(Vt_homePageWidgetInfoList, 1);
	VTE.Homestuff.initHomePage();

	{* crmv@146652 *}
	{if $OPEN_MYNOTES_POPUP > 0}
		jQuery(document).ready(function(){ldelim}
			openPopup('index.php?module=MyNotes&action=SimpleView&record={$OPEN_MYNOTES_POPUP}');
		{rdelim});
	{/if}
	{* crmv@146652e *}
</script>
