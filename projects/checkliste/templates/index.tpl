<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" sizes="72x72"   href="projects/checkliste/templates/_resources/images/icons/apple-touch-icon_72x72.png" />
    <link rel="apple-touch-icon" sizes="57x57"   href="projects/checkliste/templates/_resources/images/icons/apple-touch-icon_57x57.png" />
    <link rel="apple-touch-icon" sizes="76x76"   href="projects/checkliste/templates/_resources/images/icons/apple-touch-icon_76x76.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="projects/checkliste/templates/_resources/images/icons/apple-touch-icon_120x120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="projects/checkliste/templates/_resources/images/icons/apple-touch-icon_152x152.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="projects/checkliste/templates/_resources/images/icons/apple-touch-icon_144x144.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="projects/checkliste/templates/_resources/images/icons/apple-touch-icon_114x114.png" />
    <link rel="apple-touch-icon"                 href="projects/checkliste/templates/_resources/images/icons/apple-touch-icon-precomposed.png"/>



    <title>Checkliste</title>
    {block name=scripts_top}
        {$bootstrap_css}
        {$bootstrap_datatables_css}
        {$swipe_css}
        <link href="projects/checkliste/templates/_resources/css/style.css" type="text/css" rel="stylesheet">
    {/block}
</head>
<body>
{block name=navigation_top}
    {include "projects/checkliste/templates/_elements/navigation_top.tpl"}
{/block}

<div class="container">
    {$success}
    {$message}
    {$error}
    {block name=content}
    {/block}
</div>
{block name=scripts_bottom}
    {$jquery}
    {$bootstrap_js}
    {$bootstrap_datatables_js}
    {$swipe_js}
{/block}
</body>
</html>