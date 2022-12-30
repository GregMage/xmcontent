<div class="xmcontent">
    <{if $form|default:false}>
        <ol class="breadcrumb">
            <li><a href="index.php"><{$index_module}></a></li>
            <li class="active"><{$smarty.const._AM_XMCONTENT_EDIT}></li>
        </ol>
		<{if $error_message|default:false}>
			<div class="alert alert-danger" role="alert"><{$error_message}></div>
		<{/if}>
		<{if $message_tips|default:false == true}>
			<div class="alert alert-info"><{$smarty.const._AM_XMCONTENT_CONTENT_TIPS}></div>
		<{/if}>
        <div class="xmform">
            <{$form}>
        </div>
    <{/if}>    
</div><!-- .xmcontent -->