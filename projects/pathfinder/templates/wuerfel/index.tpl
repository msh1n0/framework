{extends "projects/pathfinder/templates/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <input id="timestamp" type="hidden">
        <input id="timestamp_phase" type="hidden">
        <input id="timestamp_turns" type="hidden">
        <input id="timestamp_dice" type="hidden">
        <input id="timestamp_map" type="hidden">
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
            <div class="row form-group">
                <div class="col-sm-3">
                    <button type="button" class="btn btn-warning form-control" onclick="setPhase('Initiative')">Initiativ-Phase</button>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-warning form-control" onclick="startInitiative()">Initiativ-Automatik</button>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-danger form-control" onclick="setPhase('Kampf-Phase')">Kampf-Phase</button>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-info form-control" onclick="setPhase('frei')">frei</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <button type="button" class="btn btn-default form-control" onclick="manipulateDice('1')">Niete</button>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-default form-control" onclick="manipulateDice('2')">Schlechter Wurf</button>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-default form-control" onclick="manipulateDice('3')">Guter Wurf</button>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-default form-control" onclick="manipulateDice('4')">Kein Crit</button>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-default form-control" onclick="manipulateDice('5')">Nur Crit</button>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-default form-control" onclick="manipulateDice('6')">Standard</button>
                </div>
            </div>
        {/if}
        </div>
    <div class="alert alert-info" id="turns">
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
{/block}
{block name="scriptblock_unten" append}
    <script src="projects/pathfinder/templates/_resources/js/wuerfel.js"></script>
{/block}