{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h2>Würfel bei: {$currentplayer}</h2>
    </div>
    <div class="alert alert-info">
        <h3>Alle Spieler</h3>
        {$overview}
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
        <input type="hidden" value="{$currentplayer}" id="currentplayer">
        <input type="hidden" value="{$w4}" id="contingent-w4">
        <input type="hidden" value="{$w6}" id="contingent-w6">
        <input type="hidden" value="{$w8}" id="contingent-w8">
        <input type="hidden" value="{$w10}" id="contingent-w10">
        <input type="hidden" value="{$w12}" id="contingent-w12">
        <input type="hidden" value="{$w20}" id="contingent-w20">
        <input type="hidden" value="{$w100}" id="contingent-w100">
    {/if}



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
        {if $isadmin}
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                </div>
                <div class="col-xs-9">
                    <input type="button" class="btn btn-default form-control" id="btn-clean-all" value="Alle Felder löschen">
                </div>
            </div>
        </div>
        {/if}
    </div>
{/block}
{block name=scriptblock_unten append}
    <script src="templates/pathfinder/_resources/js/wuerfel.js"></script>
{/block}