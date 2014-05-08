{extends "templates/checkliste/index.tpl"}
{block name=content}
<div class="alert alert-info">
    <h1>Benutzeradministration</h1>
    <table class="table table-responsive">
        <tr>
            <th class="visible-md visible-lg">Login-Name</th>
            <th>Vorname</th>
            <th class="visible-md visible-lg">Nachname</th>
            <th class="visible-md visible-lg">E-Mail</th>
            <th>Telefon</th>
            <th>Status</th>
            <th>Gruppe</th>
            <th></th>
        </tr>
        {foreach item=user from=$userlist}
            <tr>
                <td class="visible-md visible-lg">{$user['id']}</td>
                <td>{$user['firstname']}</td>
                <td class="visible-md visible-lg">{$user['surname']}</td>
                <td class="visible-md visible-lg">{$user['email']}</td>
                <td>{$user['phone']}</td>
                <td>{if $user['status']=='0'}frei{elseif $user['status']=='1'}beschäftigt{elseif $user['status']=='2'}Pause{elseif $user['status']=='3'}<span class="disabled">abgemeldet</span>{/if}</td>
                <td>{$user['group']}</td>
                <td>
                    <!--<a href="{$page}?site=useradmin_task"><span class="glyphicon glyphicon-tag" title="Aufgabe zuteilen"></span></a>-->
                    <a href="{$page}?site=statistics&mode=admin&user={$user['id']}"><span class="glyphicon glyphicon-list-alt" title="Aufgaben betrachten"></span></a>
                    <!--<a href="tel:{$user['phone']}"><span class="glyphicon glyphicon-earphone" title="anrufen"></span></a>-->
                    <!--<a href="tel:{$user['email']}"><span class="glyphicon glyphicon-comment" title="E-Mail schreiben"></span></a>-->
                    <!--<a href="#"><span class="glyphicon glyphicon-retweet" title="{$user['firstname']} soll sich bei mir melden"></span></a>-->
                    <!--<a href="{$page}?site=map&search={$user['id']}"><span class="glyphicon glyphicon-picture" title="Position auf Karte"></span></a>-->
                    <a href="{$page}?site=useradmin_edit&id={$user['id']}"><span class="glyphicon glyphicon-pencil" title="User bearbeiten"></span></a>
                    <a href="{$page}?site=useradmin_delete&id={$user['id']}"><span class="glyphicon glyphicon-remove" title="User entfernen"></span></a>
                </td>
            </tr>
        {/foreach}
        <tr>
            <td class="visible-md visible-lg"></td>
            <td></td>
            <td class="visible-md visible-lg"></td>
            <td class="visible-md visible-lg"></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="{$page}?site=useradmin_create"><span class="glyphicon glyphicon-plus" title="Neuen Nutzer anlegen"></span></a>
            </td>
    </tr></table>
</div>
{/block}