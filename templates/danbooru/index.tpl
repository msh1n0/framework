<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Danbooru</title>
    {$bootstrap_css}
    {$swipe_css}
</head>
<body>
<div class="container">
    {$content}
    <div class="alert alert-info">
        {$mapboard}
        {$mapboard_css}
    </div>

</div>
{$jquery}
{$bootstrap_js}
{$swipe_js}
</body>
</html>