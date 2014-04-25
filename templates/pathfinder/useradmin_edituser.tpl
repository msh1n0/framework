{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>{$playerid} bearbeiten</h1>
        <form action="{$index}?site=useradmin&action=edituser" method="post">
        <div class="form-group disabled">
            <input type="hidden" name="id" id="id" value="{$playerid}" class="form-control">
            <input type="hidden" name="password" id="password" value="{$password}" class="form-control">
        <div class="form-group">
            <label for="userlevel">Userlevel:</label>
            <input type="text" name="userlevel" id="userlevel" value="{$playerlevel}" class="form-control">
        </div>
        <div class="form-group">
            <label for="gab">Grundangriffsbonus:</label>
            <input type="text" name="gab" id="gab" value="{$gab}" class="form-control">
        </div>
        <div class="form-group">
            <label for="init">Initiativ-Bonus:</label>
            <input type="text" name="init" id="init" value="{$init}" class="form-control">
        </div>
        <div class="form-group">
            <label for="rk">Rüstungsklasse:</label>
            <input type="text" name="rk" id="rk" value="{$rk}" class="form-control">
        </div>
        <div class="form-group">
            <label for="tp">Trefferpunkte:</label>
            <input type="text" name="tp" id="tp" value="{$tp}" class="form-control">
        </div>
        <div class="form-group">
            <label for="dmgd">tödlicher Schaden:</label>
            <input type="text" name="dmgd" id="dmgd" value="{$dmgd}" class="form-control">
        </div>
        <div class="form-group">
            <label for="dmgnd">nicht-tödlicher Schaden:</label>
            <input type="text" name="dmgnd" id="dmgnd" value="{$dmgnd}" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="speichern" class="form-control">
        </div>
        </form>
    </div>
{/block}