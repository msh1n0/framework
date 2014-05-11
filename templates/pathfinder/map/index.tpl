{extends "templates/pathfinder/index.tpl"}
{block name=content}
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
    </div>
    <div class="alert alert-info" id="turns">
    </div>
    {if !$isadmin}
        <div class="alert alert-info" id="charinfo">
        </div>
    {/if}
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
{/block}
{block name="scriptblock_unten" append}
    <script src="templates/pathfinder/_resources/js/karte.js"></script>
{/block}