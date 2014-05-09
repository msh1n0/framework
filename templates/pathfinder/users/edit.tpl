{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>{$user['id']} bearbeiten</h1>
        <form action="{$index}?site=useradmin&action=edituser" method="post">
        <div class="form-group disabled">
            <input type="hidden" name="user[id]" id="id" value="{$user['id']}" class="form-control">
        <div class="form-group">
            <label for="userlevel">Userlevel:</label>
            <input type="text" name="user[userlevel]" id="userlevel" value="{$user['userlevel']}" class="form-control">
        </div>
        <div class="form-group">
            <label for="gab">Grundangriffsbonus:</label>
            <input type="text" name="user[gab]" id="gab" value="{$user['gab']}" class="form-control">
        </div>
        <div class="form-group">
            <label for="init">Initiativ-Bonus:</label>
            <input type="text" name="user[init]" id="init" value="{$user['init']}" class="form-control">
        </div>
        <div class="form-group">
            <label for="rk">Rüstungsklasse:</label>
            <input type="text" name="user[rk]" id="rk" value="{$user['rk']}" class="form-control">
        </div>
        <div class="form-group">
            <label for="tp">Trefferpunkte:</label>
            <input type="text" name="user[tp]" id="tp" value="{$user['tp']}" class="form-control">
        </div>
        <div class="form-group">
            <input type="radio" name="user[playable]" id="playabletrue" value="true"{if $user['playable']=='true'} checked="checked"{/if}>
            <label for="playabletrue">Spieler</label>
            <input type="radio" name="user[playable]" id="playablefalse" value="false"{if $user['playable']=='false'} checked="checked"{/if}>
            <label for="playablefalse">Monster</label>
        </div>
        <div class="form-group">
            <input type="radio" name="user[hidden]" id="hiddentrue" value="true"{if $user['hidden']=='true'} checked="checked"{/if}>
            <label for="hiddentrue">verstecken</label>
            <input type="radio" name="user[hidden]" id="hiddenfalse" value="false"{if $user['hidden']=='false'} checked="checked"{/if}>
            <label for="hiddenfalse">anzeigen</label>
        </div>
        <div class="form-group">
            <input type="submit" value="speichern" class="form-control">
        </div>
        </form>
    </div>
{/block}