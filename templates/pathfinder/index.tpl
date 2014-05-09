<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Pathfinder</title>
    <link rel="stylesheet" type="text/css" href="templates/pathfinder/_resources/css/style.css">
    {block name="scriptblock_unten"}
        {$bootstrap_css}
        {$swipe_css}
    {/block}
</head>
<body>
<div id="fullscreenEffect"></div>
{block name=navigation_top}
    {include "templates/pathfinder/_elements/navigation_top.tpl"}
{/block}

<div class="container">
    {if isset($success)}
        {$success}
    {/if}
    {if isset($message)}
        {$message}
    {/if}
    {if isset($warning)}
        {$warning}
    {/if}
    {block name=content}
        <div class="alert alert-info">
            <h1>Pathfinder-WebApp von Old Division</h1>
        </div>

    {/block}
    {if !$isLoggedIn}
        <div class="alert alert-info">
            Zum Mitspielen bitte <a href="{$index}?site=login">anmelden</a>
        </div>
    {/if}
</div>

{block name="scriptblock_unten"}
    {$jquery}
    {$bootstrap_js}
    {$swipe_js}
{/block}
</body>
</html>