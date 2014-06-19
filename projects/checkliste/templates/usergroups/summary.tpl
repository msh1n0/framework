{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    <h3>Benutzergruppen verwalten</h3>
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
    </table>

    <div class="row">
        <div class="col-xs-12">
            <a href="{$page}?site=useradmin_usergroups_create"><button class="btn btn-default form-control text-center"><span class="glyphicon glyphicon-plus" title="Neue Gruppe anlegen"></span></button></a>
        </div>
    </div>
{/block}