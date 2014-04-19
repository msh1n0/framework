{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>{$playername} bearbeiten</h1>
        <form action="{$index}?site=combatadmin&action=edituser" method="post">
        <div class="form-group disabled">
            <input type="hidden" name="playername" id="playername" value="{$playername}" class="form-control">
        <div class="form-group">
            <label for="init">Initiative:</label>
            <input type="text" name="initiative" id="initiative" value="{$initiative}" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="speichern" class="form-control">
        </div>
        </form>
    </div>
{/block}