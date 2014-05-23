<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="{$metaCharset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Pathfinder</title>
    <link rel="stylesheet" type="text/css" href="projects/pathfinder/templates/_resources/css/style.css">
    <link rel="stylesheet" type="text/css" href="projects/pathfinder/templates/_resources/css/combi.css">
    {block name="scriptblock_unten"}
        {$bootstrap_css}
        {$swipe_css}
    {/block}
</head>
<body>
<div id="fullscreenEffect"></div>
{block name=navigation_top}
    {include "projects/pathfinder/templates/_elements/navigation_top.tpl"}
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

<div class="container">
    {block name=content}
        <div class="row form-group">
            <div class="col-xs-4">
                <input type="button" onclick="activateBox(1)" value="Würfel" class="btn btn-default form-control">
            </div>
            <div class="col-xs-4">
                <input type="button" onclick="activateBox(2)" value="Karte" class="btn btn-default form-control">
            </div>
            <div class="col-xs-4">
                <input type="button" onclick="activateBox(3)" value="Rundeninfo" class="btn btn-default form-control">
            </div>
        </div>
        <input id="status_box1" type="hidden" value="left">
        <input id="status_box2" type="hidden" value="active">
        <input id="status_box3" type="hidden" value="right">

        <div class="alert alert-info content-box1 shift_left" onclick="activateBox(1)">
            <input id="timestamp" type="hidden">
            <input id="timestamp_phase" type="hidden">
            <input id="timestamp_turns" type="hidden">
            <input id="timestamp_dice" type="hidden">
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
            {if !$isadmin}
                <div id="charinfo">
                </div>
            {/if}

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
        <div class="alert alert-info map-container content-box2 shift_active" onclick="activateBox(2)">
            <div id="turns2">
            </div>
            <div id="map-container">
            </div>
        </div>
        <div class="alert alert-info content-box3 shift_right" onclick="activateBox(3)">
            <div id="turns">
            </div>
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
    <script src="projects/pathfinder/templates/_resources/js/functions.js"></script>
    <script src="projects/pathfinder/templates/_resources/js/combi.js"></script>
{/block}
</body>
</html>