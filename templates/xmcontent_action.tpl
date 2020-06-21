<div class="xmcontent">
    <{if $error_message}>
        <div class="alert alert-danger" role="alert"><{$error_message}></div>
    <{/if}>
    <{if $form}>
        <ol class="breadcrumb">
            <li><a href="index.php"><{$index_module}></a></li>
            <li class="active"><{$smarty.const._AM_XMCONTENT_EDIT}></li>
        </ol>
        <div class="xmform">
            <{$form}>
        </div>
    <{/if}>    
</div><!-- .xmcontente -->