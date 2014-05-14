{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info map-container">
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
    </div>
    <div class="alert alert-info map-container" id="turns">
    </div>
    {if !$isadmin}
        <div class="alert alert-info map-container" id="charinfo">
        </div>
    {/if}
    <div class="alert alert-info map-container">
        <h1>Karte</h1>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <label for="name" class="form-control">Spieler</label>
                </div>
                <div class="col-xs-9">
                    <select id="name" name="name" class="form-control">
                        {foreach item=user from=$users}
                        <option value="{$user['id']}">{$user['id']}</option>
                        {/foreach}
                    </select>
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
        {$map}
    </div>
{/block}
{block name="scriptblock_unten" append}
    <script src="templates/pathfinder/_resources/js/karte.js"></script>
{/block}