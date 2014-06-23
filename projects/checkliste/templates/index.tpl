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
    {if $isMobile}
        {literal}
            <style>.glyphicon{font-size:2.0em;margin:0 0.4em 0 0;}</style>
        {/literal}
    {else}
        {literal}
            <style>.glyphicon{font-size:1.4em;}</style>
        {/literal}
    {/if}

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
<h3>&nbsp;</h3>
<div class="navbar-default navbar-bottom">
    <div class="container">
                    <a class="navbar-brand" href="javascript:history.back()">&lt;&nbsp;&nbsp;Zurück</a>
    </div>
</div>
{block name=scripts_bottom}
    {$jquery}
    {$bootstrap_js}
    {$bootstrap_datatables_js}
    {$swipe_js}
    <script src="projects/checkliste/templates/_resources/js/linkfix.js" type="text/javascript"></script>
    <script src="projects/checkliste/templates/_resources/js/swipeevents.js" type="text/javascript"></script>
{/block}
</body>
</html>