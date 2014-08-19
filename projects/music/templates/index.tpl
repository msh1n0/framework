<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Musik</title>
    {block name=scripts_top}
        {$bootstrap_css}
        {$swipe_css}
        <link href="projects/music/templates/_resources/css/style.css" type="text/css" rel="stylesheet">
    {/block}
</head>
<body>
{block name=navigation_top}
    {include "projects/music/templates/_elements/navigation_top.tpl"}
{/block}

<div class="container">
    {block name=content}
    {/block}
</div>
{block name=scripts_bottom}
    {$jquery}
    {$bootstrap_js}
{/block}
</body>
</html>