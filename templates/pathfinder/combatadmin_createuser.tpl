{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Spieler anlegen</h1>
        <form action="{$index}?site=combatadmin&action=createuser" method="post">
        <div class="form-group">
            <label for="playername">Spielername:</label>
            <input type="text" name="playername" id="playername" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="initiative">Initiative:</label>
            <input type="text" name="initiative" id="initiative" value="" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="speichern" class="form-control">
        </div>
        </form>
    </div>
{/block}