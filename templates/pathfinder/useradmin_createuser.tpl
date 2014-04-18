{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Spieler anlegen</h1>
        <form action="{$index}?site=useradmin&action=createuser" method="post">
        <div class="form-group">
            <label for="username">Spielername:</label>
            <input type="text" name="username" id="username" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="userlevel">Userlevel:</label>
            <input type="text" name="userlevel" id="userlevel" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="gab">Grundangriffsbonus:</label>
            <input type="text" name="gab" id="gab" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="init">Initiativ-Bonus:</label>
            <input type="text" name="init" id="init" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="rk">Rüstungsklasse:</label>
            <input type="text" name="rk" id="rk" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="tp">Trefferpunkte:</label>
            <input type="text" name="tp" id="tp" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="dmgd">tödlicher Schaden:</label>
            <input type="text" name="dmgd" id="dmgd" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="dmgnd">nicht-tödlicher Schaden:</label>
            <input type="text" name="dmgnd" id="dmgnd" value="" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="speichern" class="form-control">
        </div>
        </form>
    </div>
{/block}