{extends "projects/pathfinder/templates/index.tpl"}
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
    <div class="alert alert-info map-container" id="turns2">
    </div>
    {if !$isadmin}
        <div class="alert alert-info map-container" id="charinfo">
        </div>
    {/if}
    <div class="alert alert-info map-container" id="map-container">
    </div>
{/block}
{block name="scriptblock_unten" append}
    <script src="projects/pathfinder/templates/_resources/js/karte.js"></script>
{/block}