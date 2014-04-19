{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h2>aktiver Spieler:</h2>
        <input type="text" disabled="disabled" value="{$currentplayer}" id="currentplayer_headline" class="disabled form-control">
        <h2>Phase:</h2>
        <input type="text" disabled="disabled" value="" id="currentphase" class="disabled form-control">
    </div>
    {if $isadmin}
        <div class="alert alert-info">
            <h3>Alle Spieler</h3>
            {$overview}
        </div>
    {/if}
    <div class="alert alert-info">
        <h3>Runden</h3>
        {$combatoverview}
    </div>
    {if !$isadmin}
        <div class="alert alert-info">
            <h3 class="text-center">{$username}</h3>
            <table class="table">
                <tr>
                    <td class="text-center">Grundangriffsbonus: </td>
                    <td class="text-center">Initiativ-Bonus: </td>
                    <td class="text-center">Rüstungsklasse: </td>
                    <td class="text-center">TP: </td>
                    <td class="text-center">Schaden tödlich: </td>
                    <td class="text-center">Schaden nicht-tödlich: </td>
                </tr>
                <tr>
                    <td class="text-center">{$gab}</td>
                    <td class="text-center">{$init}</td>
                    <td class="text-center">{$rk}</td>
                    <td class="text-center">{$tp}</td>
                    <td class="text-center">{$dmgd}</td>
                    <td class="text-center">{$dmgnd}</td>
                </tr>
            </table>
        </div>
    {/if}
    <input type="hidden" value="" id="currentplayer">
    <input type="hidden" value="{$activeplayer}" id="activeplayer">



    <div class="alert alert-info">
        <h1>Würfel</h1>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w4" id="btn-w4" value="W4">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w4">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w6" id="btn-w6" value="w6">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w6">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w8" id="btn-w8" value="w8">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w10" id="btn-w10" value="w10">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w10">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w12" id="btn-w12" value="w12">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w12">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w20" id="btn-w20" value="w20">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w20">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w100" id="btn-w100" value="w100">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w100">
                </div>
            </div>
        </div>
    </div>
{/block}
{block name=scriptblock_unten append}
    <script src="templates/pathfinder/_resources/js/wuerfel.js"></script>
{/block}