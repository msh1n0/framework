<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Testumgebung</title>
    <link rel="stylesheet" type="text/css" href="templates/pathfinder/_resources/css/style.css">
    {block name="scriptblock_unten"}
        {$bootstrap_css}
        {$swipe_css}
    {/block}
</head>
<body>
<div class="fullscreenEffect"></div>
{block name=navigation_top}
    {include "templates/pathfinder/elements/navigation_top.tpl"}
{/block}

<div class="container">
    {block name=content}
        <div class="alert alert-info">
            <h1>Pathfinder-WebApp von Old Division</h1>
        </div>
        <div class="alert alert-info">
            {$welcome}
        </div>
    {/block}
</div>

<script src="templates/pathfinder/scripts/custom.js"></script>
{block name="scriptblock_unten"}
    {$jquery}
    {$bootstrap_js}
    {$swipe_js}
{/block}
</body>
</html>