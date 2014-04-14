<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Testumgebung</title>
    {$bootstrap_css}
    {$swipe_css}
</head>
<body>
{block name=navigation_top}
    {include "framework/template/system/elements/navigation_top.tpl"}
{/block}

<div class="container">
    {block name=content}
        {include "framework/template/system/elements/mapboard.tpl"}
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