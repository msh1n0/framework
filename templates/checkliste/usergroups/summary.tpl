{extends "templates/checkliste/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Benutzergruppen verwalten</h1>
        <table class="table table-responsive">
            {foreach item=group from=$usergroups}
                <tr>
                    <td class="visible-md visible-lg">{$group['name']}</td>
                    <td>
                        <a href="{$page}?site=useradmin_usergroups_edit&id={$group['id']}"><span class="glyphicon glyphicon-pencil" title="Gruppe bearbeiten"></span></a>
                        <a href="{$page}?site=useradmin_usergroups_delete&id={$group['id']}"><span class="glyphicon glyphicon-remove" title="Gruppe entfernen"></span></a>
                    </td>
                </tr>
            {/foreach}
            <tr>
                <td></td>
                <td>
                    <a href="{$page}?site=useradmin_usergroups_create"><span class="glyphicon glyphicon-plus" title="Neue Gruppe anlegen"></span></a>
                </td>
            </tr></table>
    </div>
{/block}