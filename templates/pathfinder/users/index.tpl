{extends "templates/pathfinder/index.tpl"}
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
                <th>Schaden tödlich</th>
                <th>Schaden nicht-tödlich</th>
                <th></th>
            </tr>
        {foreach item=user from=$users}
            <tr>
                <td>{$user['id']}</td>
                <td>{$user['userlevel']}</td>
                <td>{$user['gab']}</td>
                <td>{$user['init']}</td>
                <td>{$user['rk']}</td>
                <td>{$user['tp']}</td>
                <td>{$user['dmgd']}</td>
                <td>{$user['dmgnd']}</td>
                <td>
                    <a href="{$page}?site=useradmin&action=edituser&id={$user['id']}"><span class="glyphicon glyphicon-pencil" title="Spieler bearbeiten"></span></a>
                    <a href="{$page}?site=useradmin&action=deleteuser&user={$user['id']}"><span class="glyphicon glyphicon-remove" title="Spieler löschen"></span></a>
                </td>
            </tr>
        {/foreach}
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="{$page}?site=useradmin&action=createuser"><span class="glyphicon glyphicon-plus" title="Neuen Nutzer anlegen"></span></a>
                </td>
            </tr></table>
    </div>
{/block}