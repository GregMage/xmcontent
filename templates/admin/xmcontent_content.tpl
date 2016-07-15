<script type="text/javascript">
    IMG_ON = '<{xoAdminIcons success.png}>';
    IMG_OFF = '<{xoAdminIcons cancel.png}>';
</script>
<div class="xmcontent">
    <{$navigation}>
</div>
<div class="xmcontent">
    <{$renderbutton}>
</div>
<{if $message_error != ''}>
    <div class="errorMsg" style="text-align: left;">
        <{$message_error}>
    </div>
<{/if}>
<div class="xmcontent">
    <{$form}>
</div>
<{if $content_count != 0}>
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
                <td class="txtleft"><{$content.title}></td>
                <td class="txtcenter"><{$content.weight}></td>
                <td class="xo-actions txtcenter">
                    <img id="loading_sml<{$content.id}>" src="../images/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>"
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
                        <img src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._AM_XMCONTENT_VIEW}>"/>
                    </a>
					<a href="content.php?op=clone&amp;content_id=<{$content.id}>" title="<{$smarty.const._AM_XMCONTENT_CLONE}>">
						<img src="<{xoAdminIcons clone.png}>" alt="<{$smarty.const._AM_XMCONTENT_CLONE}>">
					</a>
                    <a class="tooltip" href="content.php?op=edit&amp;content_id=<{$content.id}>" title="<{$smarty.const._AM_XMCONTENT_EDIT}>">
                        <img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._AM_XMCONTENT_EDIT}>"/>
                    </a>
                    <a class="tooltip" href="content.php?op=del&amp;content_id=<{$content.id}>" title="<{$smarty.const._AM_XMCONTENT_DEL}>">
                        <img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._AM_XMCONTENT_DEL}>"/>
                    </a>
                </td>
            </tr>
        <{/foreach}>
        </tbody>
    </table>
    <div class="clear spacer"></div>
    <{if $nav_menu}>
        <div class="xo-avatar-pagenav floatright"><{$nav_menu}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $view}>
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
                    <a class="tooltip" href="content.php?op=edit&amp;content_id=<{$content_id}>" title="<{$smarty.const._AM_XMCONTENT_EDIT}>">
                        <img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._AM_XMCONTENT_EDIT}>"/>
                    </a>
                    <a class="tooltip" href="content.php?op=del&amp;content_id=<{$content_id}>" title="<{$smarty.const._AM_XMCONTENT_DEL}>">
                        <img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._AM_XMCONTENT_DEL}>"/>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
<{/if}>


