{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <input id="timestamp" type="hidden">
        <input id="timestamp_phase" type="hidden">
        <input id="timestamp_turns" type="hidden">
        <input id="timestamp_dice" type="hidden">
        <input id="timestamp_map" type="hidden">
        <h2>aktiver Spieler:</h2>
        <input disabled="disabled" value="" id="currentplayer" class="disabled form-control" type="text">
        <h2>Phase:</h2>
        <input disabled="disabled" value="" id="currentphase" class="disabled form-control" type="text">
    </div>
    <div class="alert alert-info" id="turns">
    </div>
    <div class="alert alert-info">
        <h1>Würfel</h1>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="btn btn-default form-control" name="w4" id="btn-w4" value="W4" type="button"{if !$isadmin} disabled="disabled"{/if}>
                </div>
                <div class="col-xs-9">
                    <input class="form-control" disabled="disabled" id="w4" type="text">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="btn btn-default form-control" name="w6" id="btn-w6" value="w6" type="button"{if !$isadmin} disabled="disabled"{/if}>
                </div>
                <div class="col-xs-9">
                    <input class="form-control" disabled="disabled" id="w6" type="text">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="btn btn-default form-control" name="w8" id="btn-w8" value="w8" type="button"{if !$isadmin} disabled="disabled"{/if}>
                </div>
                <div class="col-xs-9">
                    <input class="form-control" disabled="disabled" id="w8" type="text">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="btn btn-default form-control" name="w10" id="btn-w10" value="w10" type="button"{if !$isadmin} disabled="disabled"{/if}>
                </div>
                <div class="col-xs-9">
                    <input class="form-control" disabled="disabled" id="w10" type="text">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="btn btn-default form-control" name="w12" id="btn-w12" value="w12" type="button"{if !$isadmin} disabled="disabled"{/if}>
                </div>
                <div class="col-xs-9">
                    <input class="form-control" disabled="disabled" id="w12" type="text">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="btn btn-default form-control" name="w20" id="btn-w20" value="w20" type="button"{if !$isadmin} disabled="disabled"{/if}>
                </div>
                <div class="col-xs-9">
                    <input class="form-control" disabled="disabled" id="w20" type="text">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input class="btn btn-default form-control" name="w100" id="btn-w100" value="w100" type="button"{if !$isadmin} disabled="disabled"{/if}>
                </div>
                <div class="col-xs-9">
                    <input class="form-control" disabled="disabled" id="w100" type="text">
                </div>
            </div>
        </div>
    </div>
{/block}
{block name="scriptblock_unten" append}
    <script src="templates/pathfinder/_resources/js/wuerfel.js"></script>
{/block}