{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h2>Details: {$task['headline']} {if $task['finish_status']!=1 && $task['finish_status']!=2}<a href="{$page}?site=tasks_edit&id={$task['id']}"><span class="glyphicon glyphicon-pencil"></span></a>{/if}</h2>
        <h4>{$task['task']}</h4>
        <p>&nbsp;</p>
        <h4>Status:</h4>
        <p>{if $task['finish_status']==0}
                <span class="glyphicon glyphicon-search"></span> Offen
            {elseif $task['finish_status']==1}
                <span class="glyphicon glyphicon-lock"></span> Abgeschlossen
            {elseif $task['finish_status']==2}
                <span class="glyphicon glyphicon-trash"></span> Gelöscht
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
            <h4>Zugeteilt an:</h4>
            <p>{foreach item=user from=$setusers}
                    {$user['firstname']} {$user['surname']}
                    {if $task['finish_status']!=1 && $task['finish_status']!=2}
                        {if $isadmin || $currentuser['id']==$user['id']}
                            <a href="{$page}?site=tasks_resign&task={$task['id']}&user={$user['id']}&fromsite=tasks_details"><span class="glyphicon glyphicon-minus"></span></a>
                        {/if}
                    {/if}
                    <br>
            {/foreach}</p>

        {if $isadmin}
            {if $task['finish_status']!=1 && $task['finish_status']!=2}<p><a href="{$page}?site=tasks_give_user&id={$task['id']}"><span class="glyphicon glyphicon-plus"></span></a></p>{/if}
        {/if}

        <p>&nbsp;</p>
        <h4>Anzahl benötigte Personen:</h4>
        <p>{if $task['participants_min']==0}keine Angabe{else}{$task['participants_min']}{/if}</p>
            <p>&nbsp;</p>
        {if $task['deadline']}
            <h4>Deadline:</h4>
            <p>{$task['deadline']}</p>
            <p>&nbsp;</p>
        {/if}
        {if $task['finished_by']}
            <h4>Abgeschlossen von:</h4>
            {foreach item=user from=$users}
                {if $task['finished_by']==$user['id']}
                    <p>{$user['firstname']} {$user['surname']}</p>
                {/if}
            {/foreach}
            <p>&nbsp;</p>
        {/if}
        {if $task['time_finished']}
            <h4>Abgeschlossen:</h4>
            <p>{$task['time_finished']}</p>
            <p>&nbsp;</p>
        {/if}
        <p>&nbsp;</p>
        <a href="{$backlink}"><p><span class="glyphicon glyphicon-arrow-left"></span> Zurück</p></a>
    </div>
{/block}