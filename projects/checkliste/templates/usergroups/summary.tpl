{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    <h1>Benutzergruppen verwalten</h1>
    <table class="table table-responsive">
        {foreach item=group from=$usergroups}
            <tr>
                <td>{$group['name']}{if $group['admin']=='1'} <span class="glyphicon glyphicon-warning-sign" title="Verwaltungsrecht"></span>{/if}</td>
                <td class="text-right">
                    {if $group['id']!=$currentuser['group']}
                    <a href="{$page}?site=useradmin_usergroups_edit&id={$group['id']}"><span class="glyphicon glyphicon-pencil" title="Gruppe bearbeiten"></span></a>&nbsp;&nbsp;
                        <a href="{$page}?site=useradmin_usergroups_delete&id={$group['id']}"><span class="glyphicon glyphicon-remove" title="Gruppe entfernen"></span></a>
                    {/if}
                </td>
            </tr>
        {/foreach}
        <tr>
            <td></td>
            <td class="text-right">
                <a href="{$page}?site=useradmin_usergroups_create"><span class="glyphicon glyphicon-plus" title="Neue Gruppe anlegen"></span></a>
            </td>
        </tr></table>
{/block}