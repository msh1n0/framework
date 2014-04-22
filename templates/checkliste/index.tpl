<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Checkliste</title>
    {block name=scripts_top}
        {$bootstrap_css}
        {$swipe_css}
        <link href="templates/checkliste/_resources/css/style.css" type="text/css" rel="stylesheet">
    {/block}
</head>
<body>
{block name=navigation_top}
    {include "templates/checkliste/_elements/navigation_top.tpl"}
{/block}

<div class="container">
    {$error}
    {$message}
    {block name=content}
    {/block}
</div>
{block name=scripts_bottom}
    {$jquery}
    {$bootstrap_js}
    {$swipe_js}
{/block}
</body>
</html>