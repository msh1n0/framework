{block name=content}
    <div class="alert alert-info">
        <h2>{$headline}:</h2>
        <table class="table table-responsive"><tr>
            <th>Aufgabe</th>
            <th>Ort</th>
            <th>Deadline</th>
            <th></th>
            {if $task['finish_status']!=0}
                <th></th>
                <th></th>
            {/if}
        </tr>
        {foreach key=id item=task from=$overview}
            <tr>
                <td>{$task['headline']}</td>
                <td>{$task['place']}</td>
                <td>{$task['deadline']}</td>
                {if $task['finish_status']!=0}
                <td>
                    {if $task['finish_status']==1}
                        abgeschlossen
                    {/if}
                    {if $task['finish_status']==2}
                        entfernt
                    {/if}
                    {$task['time_finished']} von {$task['finished_by']}
                </td>
                {/if}
                <td class="text-right">
                    {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode!='outlook'}
                        <a href="{$page}?site=tasks_edit&id={$task['id']}"><span class="glyphicon glyphicon-pencil" title="Aufgabe bearbeiten"></span></a>&nbsp;&nbsp;
                    {/if}

                    <a href="{$page}?site=tasks_details&id={$task['id']}&backlink={$backlink}"><span class="glyphicon glyphicon-list" title="Details anzeigen"></span></a>&nbsp;&nbsp;
                    {if $task['finish_status']!=0}
                        <a href="{$page}?site=tasks_restart&id={$task['id']}"><span class="glyphicon glyphicon-retweet" title="Aufgabe erneut starten"></span></a>&nbsp;&nbsp;
                    {/if}
                    {if $isadmin}
                        {if $task['finish_status']!=1 && $task['finish_status']!=2} <a href="{$page}?site=tasks_give_user&id={$task['id']}">
                            <span class="glyphicon glyphicon-send" title="Aufgabe zuteilen"></span></a>&nbsp;&nbsp;
                        {/if}
                    {/if}
                    {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode!='own'}
                        <a href="{$page}?site=tasks_take&id={$task['id']}"><span class="glyphicon glyphicon-link" title="Aufgabe annehmen"></span></a>&nbsp;&nbsp;
                    {/if}
                    {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode!='outlook'} <a href="{$page}?site=tasks_close&id={$task['id']}">
                        <span class="glyphicon glyphicon-ok-circle green" title="Aufgabe abschließen"></span></a>&nbsp;&nbsp;
                    {/if}
                    {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode!='outlook'} <a href="{$page}?site=tasks_cancel&id={$task['id']}">
                        <span class="glyphicon glyphicon-trash red" title="Aufgabe entfernen"></span></a>&nbsp;&nbsp;
                    {/if}
                </td>
            </tr>
        {/foreach}
        {if $finishstatus==0}
            <tr>
                <td></td>
                <td></td>
                <td></td>
            {if $task['finish_status']!=0}
                <td></td>
            {/if}
                <td class="text-right">
                    {if $mode!='outlook'}
                    <a href="checkliste.php?site=tasks_create"><span class="glyphicon glyphicon-plus" title="Aufgabe anlegen"></span></a>
                    {/if}
                </td>
        </tr>{/if}
        </table>
    </div>
{/block}