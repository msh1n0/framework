{extends "projects/pathfinder/templates/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Useradmin</h1>

        <table class="table table-responsive">
            <tr>
                <th>Name</th>
                <th>Userlevel</th>
                <th>Grundangriffsbonus</th>
                <th>Initiativ-Bonus</th>
                <th>Rüstungsklasse</th>
                <th>TP</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        {foreach item=user from=$users}
            {if $user['id']=='Spielleiter'}
            {elseif $user['id']=='ZIEL'}
            {else}
            <tr>
                <td>{$user['id']}</td>
                <td>{$user['userlevel']}</td>
                <td>{$user['gab']}</td>
                <td>{$user['init']}</td>
                <td>{$user['rk']}</td>
                <td>{$user['tp']}</td>
                <td>{if $user['playable']=='true'}<span class="glyphicon glyphicon-user"></span>{else}<span class="glyphicon glyphicon-tower"></span>{/if}</td>
                <td>{if $user['hidden']=='true'}<a href="{$page}?site=ajax&action=showplayer&value={$user['id']}"><span class="glyphicon glyphicon-eye-close"></span></a>{else}<a href="{$page}?site=ajax&action=hideplayer&value={$user['id']}"><span class="glyphicon glyphicon-eye-open"></span></a>{/if}</td>
                <td>
                    <a href="{$page}?site=useradmin&action=edituser&id={$user['id']}"><span class="glyphicon glyphicon-pencil" title="Spieler bearbeiten"></span></a>
                    <a href="{$page}?site=useradmin&action=deleteuser&user={$user['id']}"><span class="glyphicon glyphicon-remove" title="Spieler löschen"></span></a>
                </td>
            </tr>
        {/if}
        {/foreach}
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="{$page}?site=useradmin&action=batchcreateuser"><span class="glyphicon glyphicon-flash" title="Mehrere Nutzer anlegen"></span></a>
                </td>
                <td>
                    <a href="{$page}?site=useradmin&action=createuser"><span class="glyphicon glyphicon-plus" title="Neuen Nutzer anlegen"></span></a>
                </td>
            </tr></table>
    </div>
{/block}