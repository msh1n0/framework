{extends "templates/checkliste/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h2>Details: {$task['headline']} <a href="{$page}?site=tasks_edit&id={$task['id']}"><span class="glyphicon glyphicon-pencil"></span></a></h2>
        <p>{$task['task']}</p>
        <p>&nbsp;</p>
        <h4>Status:</h4>
        <p>{if $task['finish_status']==0}
                <span class="glyphicon glyphicon-refresh"></span> Offen
            {elseif $task['finish_status']==1}
                <span class="glyphicon glyphicon-lock"></span> Abgeschlossen
            {elseif $task['finish_status']==2}
                <span class="glyphicon glyphicon-trash"></span> Abgebrochen
            {/if}
        </p>
        <p>&nbsp;</p>
        {if $task['place']}
            <h4>Ort:</h4>
            <p>{$task['place']}</p>
            <p>&nbsp;</p>
        {/if}
            <h4>Freigegeben für:</h4>
            <p>{$groups}</p>
            <p>&nbsp;</p>
            <h4>Zugeteilte Nutzer:</h4>
            <p>{$setusers}</p>
            <p><a href="{$page}?site=tasks_give_user&id={$task['id']}"><span class="glyphicon glyphicon-plus"></span></a></p>
            <p>&nbsp;</p>
        {if $task['deadline']}
            <h4>Deadline:</h4>
            <p>{$task['deadline']}</p>
            <p>&nbsp;</p>
        {/if}
        {if $task['finished_by']}
            <h4>Abgeschlossen von:</h4>
            <p>{$task['finished_by']}</p>
            <p>&nbsp;</p>
        {/if}
        {if $task['time_finished']}
            <h4>Abgeschlossen:</h4>
            <p>{$task['time_finished']}</p>
            <p>&nbsp;</p>
        {/if}
        <p>&nbsp;</p>
        <a href="{$page}?site=tasks_summary"><p><span class="glyphicon glyphicon-arrow-left"></span> Zurück</p></a>
    </div>
{/block}