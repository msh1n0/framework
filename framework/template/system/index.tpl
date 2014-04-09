<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Testumgebung</title>
    {$bootstrap_css}
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            {block name=headline}
                <div class="alert alert-info">
                    <h1>Willkommen</h1>
                </div>
            {/block}
        </div>
        <div class="col-lg-3 text-right">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            {block name=content}
                <div class="alert alert-danger">
                    Standardtemplate geladen
                </div>
            {/block}
        </div>
        <div class="col-lg-3 text-right">
        </div>
    </div>
</div>
{$jquery}
{$bootstrap_js}
</body>
</html>

