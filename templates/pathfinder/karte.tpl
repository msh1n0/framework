{extends "templates/pathfinder/index.tpl"}
{block name=content}
    {if isset($error)}
        <div class="alert alert-danger">
            {$error}
        </div>
    {else}
        <div class="alert alert-info">
            <h2>aktiver Spieler:</h2>
            <input type="text" disabled="disabled" value="" id="currentplayer_headline" class="disabled form-control">
            <h2>Phase:</h2>
            <input type="text" disabled="disabled" value="" id="currentphase" class="disabled form-control">
            <input type="hidden" value="{$isadmin}" id="isadmin">
            <input type="hidden" value="{$activeplayer}" id="activeplayer">
        </div>
        {if $isadmin}
            <div class="alert alert-info">
                <h3>Runde</h3>
                {$combatoverview}
            </div>
        {/if}
        <div id="styleblock">
        </div>
        <div class="alert alert-info">
            <h1>Karte</h1>
            <div class="form-group">
                {if $isadmin}
                <div class="row">
                    <div class="col-xs-3">
                        <label for="name" class="form-control">Spieler</label>
                    </div>
                    <div class="col-xs-9">
                        {$players}
                    </div>
                </div>
                {else}
                    <input type="hidden" value="{$activeplayer}" id="name" name="name">
                {/if}
        {if $isadmin}
                <div class="row">
                    <div class="col-xs-3">
                        <label for="color" class="form-control">Farbe</label>
                    </div>
                    <div class="col-xs-9">
                        {$markers}
                    </div>
                </div>
                {/if}
                {if $isadmin}
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
                {/if}
            </div>
            {$mapboard}
            {$mapboard_css}
        </div>
    {/if}
{/block}
{block name=scriptblock_unten append}
    <script src="templates/pathfinder/_resources/js/karte.js"></script>
{/block}