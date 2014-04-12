<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Testumgebung</title>
    {$bootstrap_css}
    {$swipe_css}
</head>
<body>
{block name=navigation_top}
    {include "framework/template/system/elements/navigation_top.tpl"}
{/block}

<div class="container">
    {block name=headline}
        <div class="alert alert-info">
            <h1>Willkommen</h1>
        </div>
    {/block}
    {block name=content}
        <div class="alert alert-danger">
            Standardtemplate geladen
        </div>
    {/block}
</div>


{block name=navigation_bottom}
    {include "framework/template/system/elements/navigation_bottom.tpl"}
{/block}


{$jquery}
{$bootstrap_js}
{$swipe_js}
</body>
</html>