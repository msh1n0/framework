<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Checkliste</title>
    {$bootstrap_css}
    {$swipe_css}
</head>
<body>
{block name=navigation_top}
    {include "framework/template/checkliste/elements/navigation_top.tpl"}
{/block}

<div class="container">
    {$error}
    {$message}
    {block name=content}
    {/block}
</div>
{$jquery}
{$bootstrap_js}
{$swipe_js}
</body>
</html>