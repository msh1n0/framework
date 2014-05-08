{extends "templates/checkliste/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h2>{$headline}:</h2>
        <table class="table table-responsive"><tr>
            <th>Aufgabe</th>
            <th>Freigegeben für</th>
            <th>Deadline</th>
            <th></th>
        </tr>
        {foreach key=id item=task from=$overview}
            <tr>
                <td>{$task['headline']}</td>
                <td>{$suitablegroups}</td>
                <td>{$task['deadline']}</td>
                <td>
                    {if $task['finish_status']!=1 && $task['finish_status']!=2}
                        <a href="{$page}?site=tasks_edit&id={$task['id']}"><span class="glyphicon glyphicon-pencil" title="Aufgabe bearbeiten"></span></a>&nbsp;
                    {/if}
                    <a href="{$page}?site=tasks_details&id={$task['id']}"><span class="glyphicon glyphicon-list" title="Details anzeigen"></span></a>&nbsp;
                    {if $task['finish_status']!=1 && $task['finish_status']!=2} <a href="{$page}?site=tasks_give_user&id={$task['id']}">
                        <span class="glyphicon glyphicon-send" title="Aufgabe zuteilen"></span></a>&nbsp;
                    {/if}
                    {if $task['finish_status']!=1 && $task['finish_status']!=2} <a href="{$page}?site=tasks_take&id={$task['id']}">
                        <span class="glyphicon glyphicon-link" title="Aufgabe annehmen"></span></a>&nbsp;
                    {/if}
                    {if $task['finish_status']!=1 && $task['finish_status']!=2} <a href="{$page}?site=tasks_close&id={$task['id']}">
                        <span class="glyphicon glyphicon-ok-circle green" title="Aufgabe abschließen"></span></a>&nbsp;
                    {/if}
                    {if $task['finish_status']!=1 && $task['finish_status']!=2} <a href="{$page}?site=tasks_cancel&id={$task['id']}">
                        <span class="glyphicon glyphicon-trash red" title="Aufgabe entfernen"></span></a>&nbsp;
                    {/if}
                </td>
            </tr>
        {/foreach}
        {if $finishstatus==0}
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="checkliste.php?site=tasks_create"><span class="glyphicon glyphicon-plus" title="Aufgabe anlegen"></span></a>
                </td>
        </tr>{/if}
        </table>
    </div>
{/block}