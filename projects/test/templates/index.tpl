<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Framework</title>
    {block name="scriptblock_unten"}
        {$bootstrap_css}
    {/block}
</head>
<body>
<div id="fullscreenEffect"></div>

<div class="container">
    {block name=content}
        {include 'projects/test/templates/_elements/testblock.tpl' headline='Framework -> Session' elements=$results_session}
    {/block}
</div>

{block name="scriptblock_unten"}
    {$jquery}
    {$bootstrap_js}
{/block}
</body>
</html>