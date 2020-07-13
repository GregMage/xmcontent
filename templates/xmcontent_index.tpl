<{if $index_header}>
    <div class="row">
        <div class="col-sm-12" style="padding-bottom: 10px; padding-top: 5px;">
            <{$index_header}>
        </div>
    </div>
<{/if}>
<div class="row">
	<div class="col">
		<{if $index_content != 0}>
			<{include file="db:xmcontent_viewcontent.tpl"}>
		<{else}>
			<{if $content_count != 0}>
			<div class="row" style="padding-bottom: 5px; padding-top: 5px;">
				<{foreach item=content from=$content}>
					<{if $index_columncontent == 1}>			
					<div class="col-sm-12" style="padding-bottom: 5px; padding-top: 5px;">
					<{/if}>
					<{if $index_columncontent == 2}>			
					<div class="col-sm-6" style="padding-bottom: 5px; padding-top: 5px;">
					<{/if}>
					<{if $index_columncontent == 3}>			
					<div class="col-sm-4" style="padding-bottom: 5px; padding-top: 5px;">
					<{/if}>
					<{if $index_columncontent == 4}>			
					<div class="col-sm-3" style="padding-bottom: 5px; padding-top: 5px;">
					<{/if}>
						<div class="row" style="min-height: 180px;">
							<div class="col-sm-3">
								<img class="img-responsive" src="<{$content.logo}>" alt="<{$content.title}>">
							</div>
							<div class="col-sm-9">
								<h4><{$content.title}></h4>
								<p><{$content.text}></p>
								<a href="viewcontent.php?content_id=<{$content.id}>">
									<button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MD_XMCONTENT_INDEX_MORE}></button>
								</a>
							</div>
						</div>
					</div>					
				<{/foreach}>
			</div>
			<{if $nav_menu}>
				<div class="row">
					<div class="col-sm-12" style="padding-bottom: 10px; padding-top: 5px; padding-right: 60px; text-align: right;">
						<{$nav_menu}>
					</div>
				</div>
			<{/if}>
			<{/if}>			
		<{/if}>
	</div>
</div>

<{if $index_footer}>
    <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
        <div class="col-sm-12">
            <{$index_footer}>
        </div>
    </div>
<{/if}>
