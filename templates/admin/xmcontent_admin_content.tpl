<script type="text/javascript">
    IMG_ON = '<{xoAdminIcons success.png}>';
    IMG_OFF = '<{xoAdminIcons cancel.png}>';
</script>
<{if $message_tips|default:false == true}>
	<div class="tips ui-corner-all">
        <img class="floatleft tooltip" src="<{xoAdminIcons tips.png}>" alt="<{$smarty.const._AM_SYSTEM_TIPS}>" title="<{$smarty.const._AM_SYSTEM_TIPS}>"/>

        <div class="floatleft"><{$smarty.const._AM_XMCONTENT_CONTENT_TIPS}></div>
        <div class="clear">&nbsp;</div>
    </div>
<{/if}>
<div class="xmcontent">
    <{$renderbutton|default:''}>
</div>
<{if $message_error|default:'' != ''}>
    <div class="errorMsg" style="text-align: left;">
        <{$message_error}>
    </div>
<{/if}>

<div class="xmcontent">
    <{$form|default:''}>
</div>
<{if $filter|default:false}>
	<div align="right">
		<form id="form_content_tri" name="form_content_tri" method="post" action="content.php">
			<{$smarty.const._AM_XMCONTENT_CONTENT_TITLE}>
			<input type="text" id="title" name="title" value="<{$title}>" />
			<input type="submit" value="<{$smarty.const._GO}>" />
			<input type='button' name='reset'  id='reset' value='<{$smarty.const._RESET}>' onclick="location='content.php'" />
			<{$smarty.const._AM_XMCONTENT_CONTENT_STATUS}>
			<select name="content_filter" id="content_filter" onchange="location='content.php?title=<{$title}>&fcontent_status='+this.options[this.selectedIndex].value">
				<{$content_status_options}>
			<select>
		</form>
	</div>
<{/if}>
<{if $content_count|default:0 != 0}>
    <table id="xo-xmcontact-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtleft"><{$smarty.const._AM_XMCONTENT_CONTENT_TITLE}></th>
            <th class="txtcenter width5"><{$smarty.const._AM_XMCONTENT_CONTENT_WEIGHT}></th>
            <th class="txtcenter width5"><{$smarty.const._AM_XMCONTENT_CONTENT_STATUS}></th>
			<th class="txtcenter width10"><{$smarty.const._AM_XMCONTENT_CONTENT_MAINDISPLAY}></th>
			<th class="txtcenter width10"><{$smarty.const._AM_XMCONTENT_CONTENT_DOTITLE}></th>
            <th class="txtcenter width10"><{$smarty.const._AM_XMCONTENT_ACTION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach item=content from=$content}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtleft"><a href="<{$content.link}>" title="<{$content.title}>"><{$content.title}></a></td>
                <td class="txtcenter"><{$content.weight}></td>
                <td class="xo-actions txtcenter">
                    <img id="loading_sml<{$content.id}>" src="../assets/images/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>"
                    alt="<{$smarty.const._AM_SYSTEM_LOADING}>"/><img class="cursorpointer tooltip" id="sml<{$content.id}>"
                    onclick="system_setStatus( { op: 'content_update_status', content_id: <{$content.id}> }, 'sml<{$content.id}>', 'content.php' )"
                    src="<{if $content.status}><{xoAdminIcons success.png}><{else}><{xoAdminIcons cancel.png}><{/if}>"
                    alt="<{if $content.status}><{$smarty.const._AM_XMCONTENT_CONTENT_STATUS_NA}><{else}><{$smarty.const._AM_XMCONTENT_CONTENT_STATUS_A}><{/if}>"
                    title="<{if $content.status}><{$smarty.const._AM_XMCONTENT_CONTENT_STATUS_NA}><{else}><{$smarty.const._AM_XMCONTENT_CONTENT_STATUS_A}><{/if}>"/>
                </td>
				<td class="txtcenter"><{$content.maindisplay}></td>
				<td class="txtcenter"><{$content.dotitle}></td>
                <td class="xo-actions txtcenter">
                    <a class="tooltip" href="content.php?op=view&amp;content_id=<{$content.id}>" title="<{$smarty.const._AM_XMCONTENT_VIEW}>">
                        <img src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._AM_XMCONTENT_VIEW}>"/></a>
					<a class="tooltip" href="content.php?op=clone&amp;content_id=<{$content.id}>" title="<{$smarty.const._AM_XMCONTENT_CLONE}>">
						<img src="<{xoAdminIcons clone.png}>" alt="<{$smarty.const._AM_XMCONTENT_CLONE}>"></a>
                    <a class="tooltip" href="content.php?op=edit&amp;content_id=<{$content.id}>&amp;fcontent_status=<{$fcontent_status}>&amp;&title=<{$title}>" title="<{$smarty.const._AM_XMCONTENT_EDIT}>">
                        <img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._AM_XMCONTENT_EDIT}>"/></a>
                    <a class="tooltip" href="content.php?op=del&amp;content_id=<{$content.id}>" title="<{$smarty.const._AM_XMCONTENT_DEL}>">
                        <img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._AM_XMCONTENT_DEL}>"/></a>
                </td>
            </tr>
        <{/foreach}>
        </tbody>
    </table>
    <div class="clear spacer"></div>
    <{if $nav_menu|default:false}>
        <div class="xo-avatar-pagenav floatright"><{$nav_menu}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $view|default:false}>
    <table id="xo-xmcontact-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtleft width20"><{$smarty.const._AM_XMCONTENT_CONTENT_TITLE}></th>
            <th class="txtleft"><{$smarty.const._AM_XMCONTENT_CONTENT_INFORMATION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach from=$content_arr key=title item=information}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtleft"><{$title}></td>
                <td class="txtleft"><{$information}></td>
            </tr>
        <{/foreach}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td><{$smarty.const._AM_XMCONTENT_ACTION}></td>
                <td class="xo-actions txtleft">
					<a class="tooltip" href="<{$link}>" title="<{$smarty.const._AM_XMCONTENT_VIEW}>">
                        <img src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._AM_XMCONTENT_VIEW}>"/></a>
                    <a class="tooltip" href="content.php?op=edit&amp;content_id=<{$content_id}>" title="<{$smarty.const._AM_XMCONTENT_EDIT}>">
                        <img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._AM_XMCONTENT_EDIT}>"/></a>
                    <a class="tooltip" href="content.php?op=del&amp;content_id=<{$content_id}>" title="<{$smarty.const._AM_XMCONTENT_DEL}>">
                        <img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._AM_XMCONTENT_DEL}>"/></a>
                </td>
            </tr>
        </tbody>
    </table>
<{/if}>


