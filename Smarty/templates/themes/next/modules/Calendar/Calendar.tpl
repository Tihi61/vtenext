{*/*+*************************************************************************************
* The contents of this file are subject to the VTECRM License Agreement
* ("licenza.txt"); You may not use this file except in compliance with the License
* The Original Code is: VTECRM
* The Initial Developer of the Original Code is VTECRM LTD.
* Portions created by VTECRM LTD are Copyright (C) VTECRM LTD.
* All Rights Reserved.
***************************************************************************************/*}

{* crmv@140887 *}

<table class="small calHdr" align="center" border="0" cellpadding="5" cellspacing="0" width="100%" style="display:none;"></table>

<div style="display:none;" id="mnuTab">
	<form name="EventViewOption" method="POST" action="index.php" style="display:none;">
		<input type="hidden" name="__csrf_token" value="{$CSRF_TOKEN}"> {* crmv@171581 *}
		{$EVENT_VIEW_OPTIONS}
	</form>
</div>

<iframe id="wdCalendar" name="wdCalendar" src="{$CALENDAR_URL}" width="100%" frameborder="0" scrolling="auto"></iframe>

<script type="text/javascript">
	var relatedAdd = '{$RELATED_ADD}';
	var calendarUrl = '{$CALENDAR_URL}';
</script>

{literal}
<script type="text/javascript">
jQuery(document).ready(function() {
	if (navigator.userAgent.indexOf('MSIE') > -1) {
		var wdCalendar_h = 22;
	} else if (navigator.userAgent.indexOf('Chrome') > -1) {
		var wdCalendar_h = 20;
	} else {
		var wdCalendar_h = 18;
	}

	if (relatedAdd.length > 0) {
		var resizeInterval = setInterval(function() {
			resizeWdCalendar();
			wdCalendarInit();
			jQuery('#vte_menu_white').height(jQuery('#vte_menu_head').outerHeight());
		}, 1000);
		
		function resizeWdCalendar() {
			jQuery('#vte_menu_white_1').height(jQuery('#Buttons_List_4').height());
			jQuery('#wdCalendar').height(jQuery(document).height() - jQuery('#vte_menu_white').height() - jQuery('#vte_footer').height() - wdCalendar_h - jQuery('#vte_menu_white_1').height() - jQuery('#Buttons_List_4').height());
		}
		
		function resizeWdCalendarFrame() {
			var new_height = parseInt(jQuery('#wdCalendar').height()) - 40;
			if (window.frames['wdCalendar']) window.frames['wdCalendar'].jQuery('#filterDivCalendar').height(new_height);
			window.wdCalendar.ResizeWindow();
		}
	
		function wdCalendarInit() {
			if (!window.frames['wdCalendar'].jQuery) return;
				
			var $dvwkcontaienr = window.frames['wdCalendar'].jQuery("#dvwkcontaienr");
			var $dvtec = window.frames['wdCalendar'].jQuery("#dvtec");
			
			if ($dvwkcontaienr.length == 0 || $dvtec.length == 0) {
				return;
			}
			
			clearInterval(resizeInterval);
			
			jQuery('#fancybox-loading').hide();
			
			if (getObj('CalendarAddButton') != undefined) {
				getObj('CalendarAddButton').innerHTML = getObj('addButton').innerHTML;
			}
			
			resizeWdCalendarFrame();
			
			jQuery(window).resize(function() {
				resizeWdCalendar();
				resizeWdCalendarFrame();
			});
		}
	} else {
		jQuery('#wdCalendar').height(document.documentElement.clientHeight - parseInt(jQuery('#Buttons_List_3').height()) - jQuery('#vte_footer').height() - wdCalendar_h);
		jQuery('#fancybox-loading').hide();
		
		if (getObj('CalendarAddButton') != undefined) {
			getObj('CalendarAddButton').innerHTML = getObj('addButton').innerHTML;
		}
	}
});
</script>
{/literal}

</td></tr></table>
</td></tr></table>
</td></tr></table>
</td></tr></table>

{if $IN_ICAL}
	{include file="Footer.tpl"}
{/if}
