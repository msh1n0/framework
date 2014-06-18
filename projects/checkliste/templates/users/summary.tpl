{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    {if isset($online_only) && $online_only==true}
        <h2>Mitarbeiterübersicht</h2>
    {else}
        <h2>Benutzeradministration</h2>
    {/if}
    <table class="table table-responsive">
        <tr>
            <th class="visible-lg">Login-Name</th>
            <th>Name</th>
            <th class="visible-md visible-lg">E-Mail</th>
            <th class="visible-md visible-lg">Telefon</th>
            <th>Status</th>
            {if $isadmin}<th>letzte Statusänderung</th>{/if}
            <th class="visible-md visible-lg">Gruppe</th>
            <th></th>
        </tr>
        {foreach item=user from=$userlist}
            {if isset($online_only) && $online_only==true && $user['status']==3}
            {else}

            <tr>
                <td class="visible-lg">{$user['id']}</td>
                <td>{$user['firstname']} {$user['surname']}</td>
                <td class="visible-md visible-lg">{$user['email']}</td>
                <td class="visible-md visible-lg">{$user['phone']}</td>
                <td>
                    {if $user['status']=='0'}
                        frei
                    {elseif $user['status']=='1'}
                        beschäftigt
                    {elseif $user['status']=='2'}
                        Pause
                    {elseif $user['status']=='3'}
                        abgemeldet
                    {/if}
                </td>
                {if $isadmin}<td>
                    {$user['status_since']}
                </td>{/if}
                <td class="visible-md visible-lg">{$user['group']}</td>
                <td class="text-right">
                    {if $currentuser['id']!=$user['id']}
                        {if $isadmin}
                            <a href="{$page}?site=statistics&mode=admin&user={$user['id']}"><span class="glyphicon glyphicon-list-alt" title="Aufgaben betrachten"></span></a>&nbsp;
                        {/if}
                            <a href="tel:{$user['phone']}"><span class="glyphicon glyphicon-earphone" title="anrufen"></span></a>&nbsp;
                            <a href="mailto:{$user['email']}"><span class="glyphicon glyphicon-comment" title="E-Mail schreiben"></span></a>&nbsp;
                        {if $isadmin}
                            <a href="{$page}?site=useradmin_callback&id={$user['id']}&fromsite={$fromsite}"><span class="glyphicon glyphicon-bell" title="{$user['firstname']} soll sich bei mir melden"></span></a>&nbsp;
                            <a href="{$page}?site=useradmin_edit&id={$user['id']}"><span class="glyphicon glyphicon-pencil" title="User bearbeiten"></span></a>&nbsp;
                            <a href="{$page}?site=useradmin_delete&id={$user['id']}&fromsite={$fromsite}"><span class="glyphicon glyphicon-remove" title="User entfernen"></span></a>
                        {/if}
                    {/if}
                </td>
            </tr>

            {/if}
        {/foreach}
        {if $isadmin}
            <tr>
                <td class="visible-lg"></td>
                <td></td>
                <td class="visible-md visible-lg"></td>
                <td class="visible-md visible-lg"></td>
                <td></td>
                <td class="visible-md visible-lg"></td>
                <td class="text-right">
                    <a href="{$page}?site=useradmin_create"><span class="glyphicon glyphicon-plus" title="Neuen Nutzer anlegen"></span></a>
                </td>
            </tr>
        {/if}</table>
{/block}