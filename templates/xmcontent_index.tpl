<{if $index_header}>
    <div class="row">
        <div class="col-sm-12" style="padding-bottom: 10px; padding-top: 5px;">
            <{$index_header}>
        </div>
    </div>
<{/if}>
<{if $content_count != 0}>
    <{foreach item=content from=$content}>
        <{if $index_columncontent == 1}>
            <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
                <div class="col-sm-12">
                    <h4><{$content.title}></h4>
                    <p style="padding-top: 15px;">
                        <a href="viewcontent.php?content_id=<{$content.id}>">
                            <button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MD_XMCONTENT_INDEX_MORE}></button>
                        </a>
                    </p>
                </div>
            </div>
        <{/if}>
        <{if $index_columncontent == 2}>
            <{if $content.row == true}>
                <div class="row" style="margin-top: 5px;">
            <{/if}>
            <div class="col-sm-6">
                <h4><{$content.title}></h4>
                <p style="padding-top: 15px;">
                    <a href="viewcontent.php?content_id=<{$content.id}>">
                        <button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MD_XMCONTENT_INDEX_MORE}></button>
                    </a>
                </p>
            </div>
            <{if $content.count is div by $index_columncontent || $content.end == true}>
                </div>
            <{/if}>
        <{/if}>
        <{if $index_columncontent == 3}>
            <{if $content.row == true}>
                <div class="row" style="margin-top: 5px;">
            <{/if}>
            <div class="col-sm-4">
                <h4><{$content.title}></h4>
                <p style="padding-top: 15px;">
                    <a href="viewcontent.php?content_id=<{$content.id}>">
                        <button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MD_XMCONTENT_INDEX_MORE}></button>
                    </a>
                </p>
            </div>
            <{if $content.count is div by $index_columncontent || $content.end == true}>
                </div>
            <{/if}>
        <{/if}>
        <{if $index_columncontent == 4}>
            <{if $content.row == true}>
                <div class="row" style="margin-top: 5px;">
            <{/if}>
            <div class="col-sm-3">
                <h4><{$content.title}></h4>
                <p style="padding-top: 15px;">
                    <a href="viewcontent.php?content_id=<{$content.id}>">
                        <button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MD_XMCONTENT_INDEX_MORE}></button>
                    </a>
                </p>
            </div>
            <{if $content.count is div by $index_columncontent || $content.end == true}>
                </div>
            <{/if}>
        <{/if}>
    <{/foreach}>
    <{if $nav_menu}>
        <div class="row">
            <div class="col-sm-12" style="padding-bottom: 10px; padding-top: 5px; padding-right: 60px; text-align: right;">
                <{$nav_menu}>
            </div>
        </div>
    <{/if}>
<{/if}>

<{if $index_footer}>
    <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
        <div class="col-sm-12">
            <{$index_footer}>
        </div>
    </div>
<{/if}>
