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

</div>
    {block name=content}
<div class="row row-fullscreen">
    <div class="col-xs-4 halfscreen-left">
        <div class="alert alert-info">
            <input id="timestamp" type="hidden">
            <input id="timestamp_phase" type="hidden">
            <input id="timestamp_turns" type="hidden">
            <input id="timestamp_map" type="hidden">
            <input id="timestamp_pointers" type="hidden">
            <input id="currentuser" value="{$currentuser['id']}" type="hidden">
            <input id="userlevel" value="{$currentuser['userlevel']}" type="hidden">
            <input id="playable" type="hidden">
                <h2>aktiver Spieler:</h2>
                <input disabled="disabled" value="" id="currentplayer" class="disabled form-control" type="text">
                <h2>Phase:</h2>
                <input disabled="disabled" value="" id="currentphase" class="disabled form-control" type="text">
                <div class="row">
                    <div class="col-sm-12"><p>&nbsp;</p></div>
                </div>
                {if $isadmin}
                    <div class="row">
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-warning form-control" onclick="setPhase('Initiative')">Initiativ-Phase</button>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-warning form-control disabled" onclick="startInitiative()">Initiativ-Automatik</button>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-danger form-control" onclick="setPhase('Kampf-Phase')">Kampf-Phase</button>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-info form-control" onclick="setPhase('frei')">frei</button>
                        </div>
                    </div>
                {/if}
            </div>
        {if !$isadmin}
            <div class="alert alert-info" id="charinfo">
            </div>
        {/if}
        <div class="alert alert-info">
            <h2>Würfel</h2>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">
                        <input class="btn btn-default form-control disabled dicebutton" name="w4" id="btn-w4" value="W4" type="button">
                    </div>
                    <div class="col-xs-9">
                        <input class="form-control" disabled="disabled" id="w4" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">
                        <input class="btn btn-default form-control disabled dicebutton" name="w6" id="btn-w6" value="w6" type="button">
                    </div>
                    <div class="col-xs-9">
                        <input class="form-control" disabled="disabled" id="w6" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">
                        <input class="btn btn-default form-control disabled dicebutton" name="w8" id="btn-w8" value="w8" type="button">
                    </div>
                    <div class="col-xs-9">
                        <input class="form-control" disabled="disabled" id="w8" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">
                        <input class="btn btn-default form-control disabled dicebutton" name="w10" id="btn-w10" value="w10" type="button">
                    </div>
                    <div class="col-xs-9">
                        <input class="form-control" disabled="disabled" id="w10" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">
                        <input class="btn btn-default form-control disabled dicebutton" name="w12" id="btn-w12" value="w12" type="button">
                    </div>
                    <div class="col-xs-9">
                        <input class="form-control" disabled="disabled" id="w12" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">
                        <input class="btn btn-default form-control disabled dicebutton" name="w20" id="btn-w20" value="w20" type="button">
                    </div>
                    <div class="col-xs-9">
                        <input class="form-control" disabled="disabled" id="w20" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">
                        <input class="btn btn-default form-control disabled dicebutton" name="w100" id="btn-w100" value="w100" type="button">
                    </div>
                    <div class="col-xs-9">
                        <input class="form-control" disabled="disabled" id="w100" type="text">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-4">
        <div class="alert alert-info">
            <h1>Karte</h1>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">
                        <label for="name" class="form-control">Spieler</label>
                    </div>
                    <div class="col-xs-9">
                        <select id="name" name="name" class="form-control">
                            {foreach item=user from=$users}
                                <option value="{$user['id]']}">{$user['id]']}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <label for="color" class="form-control">Farbe</label>
                    </div>
                    <div class="col-xs-9">
                        <select id="color" name="color" class="form-control"><option value="">Farbe beibehalten</option><option value="000" style="background:#000;">000</option><option value="006" style="background:#006;">006</option><option value="00a" style="background:#00a;">00a</option><option value="00f" style="background:#00f;">00f</option><option value="060" style="background:#060;">060</option><option value="066" style="background:#066;">066</option><option value="06f" style="background:#06f;">06f</option><option value="0a0" style="background:#0a0;">0a0</option><option value="0f0" style="background:#0f0;">0f0</option><option value="0f6" style="background:#0f6;">0f6</option><option value="0fa" style="background:#0fa;">0fa</option><option value="0ff" style="background:#0ff;">0ff</option><option value="600" style="background:#600;">600</option><option value="606" style="background:#606;">606</option><option value="60f" style="background:#60f;">60f</option><option value="660" style="background:#660;">660</option><option value="666" style="background:#666;">666</option><option value="6a0" style="background:#6a0;">6a0</option><option value="6f0" style="background:#6f0;">6f0</option><option value="a00" style="background:#a00;">a00</option><option value="a06" style="background:#a06;">a06</option><option value="a0a" style="background:#a0a;">a0a</option><option value="a0f" style="background:#a0f;">a0f</option><option value="a60" style="background:#a60;">a60</option><option value="aa0" style="background:#aa0;">aa0</option><option value="aaa" style="background:#aaa;">aaa</option><option value="af0" style="background:#af0;">af0</option><option value="afa" style="background:#afa;">afa</option><option value="f00" style="background:#f00;">f00</option><option value="f06" style="background:#f06;">f06</option><option value="f0a" style="background:#f0a;">f0a</option><option value="f0f" style="background:#f0f;">f0f</option><option value="f60" style="background:#f60;">f60</option><option value="fa0" style="background:#fa0;">fa0</option><option value="faa" style="background:#faa;">faa</option><option value="ff0" style="background:#ff0;">ff0</option><option value="ffa" style="background:#ffa;">ffa</option><option value="fff" style="background:#fff;">fff</option><option value="xxx" style="background:#xxx;">xxx</option></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-9">
                        <input type="button" class="btn btn-default form-control" id="btn-deletemarker" value="Marker von Karte entfernen">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-9">
                        <input type="button" class="btn btn-default form-control" id="btn-deleteallmarkers" value="Alle Marker löschen">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-4 halfscreen-right">
        <div class="alert alert-info" id="turns">
        </div>
        {if !$isadmin}
            <div class="alert alert-info" id="charinfo">
            </div>
        {/if}
    </div>
</div>
    {/block}
<div class="container">
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
    <script src="templates/pathfinder/_resources/js/functions.js"></script>
    <script src="templates/pathfinder/_resources/js/combi.js"></script>
{/block}
</body>
</html>