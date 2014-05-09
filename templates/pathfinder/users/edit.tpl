{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>{$user['id']} bearbeiten</h1>
        <form action="{$index}?site=useradmin&action=edituser" method="post">
        <div class="form-group disabled">
            <input type="hidden" name="id" id="id" value="{$user['id']}" class="form-control">
        <div class="form-group">
            <label for="userlevel">Userlevel:</label>
            <input type="text" name="userlevel" id="userlevel" value="{$user['userlevel']}" class="form-control">
        </div>
        <div class="form-group">
            <label for="gab">Grundangriffsbonus:</label>
            <input type="text" name="gab" id="gab" value="{$user['gab']}" class="form-control">
        </div>
        <div class="form-group">
            <label for="init">Initiativ-Bonus:</label>
            <input type="text" name="init" id="init" value="{$user['init']}" class="form-control">
        </div>
        <div class="form-group">
            <label for="rk">Rüstungsklasse:</label>
            <input type="text" name="rk" id="rk" value="{$user['rk']}" class="form-control">
        </div>
        <div class="form-group">
            <label for="tp">Trefferpunkte:</label>
            <input type="text" name="tp" id="tp" value="{$user['tp']}" class="form-control">
        </div>
        <div class="form-group">
            <input type="radio" name="playable" id="playable" value="true"{if $user['playable']} checked="checked"{/if}>
            <input type="radio" name="playable" id="playable" value="true"{if !$user['playable']} checked="checked"{/if}>
            <label for="playable">Spieler</label>
        </div>
        <div class="form-group">
            <input type="radio" name="hidden" id="hidden" value="true"{if !$user['hidden']} checked="checked"{/if}>ja
            <input type="radio" name="hidden" id="hidden" value="false"{if $user['hidden']} checked="checked"{/if}>nein
            <label for="hidden">versteckt</label>
        </div>
        <div class="form-group">
            <input type="submit" value="speichern" class="form-control">
        </div>
        </form>
    </div>
{/block}