{extends "templates/checkliste/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h2>Details: {$headline} <a href="{$page}?site=tasks_edit&id={$id}"><span class="glyphicon glyphicon-pencil"></span></a></h2>
        <p>{$task}</p>
        <p>&nbsp;</p>
        {if $place}
            <h4>Ort:</h4>
            <p>{$place}</p>
            <p>&nbsp;</p>
        {/if}
            <h4>Freigegeben für:</h4>
            <p>{$suitable_groups}</p>
            <p>&nbsp;</p>
            <h4>Zugeteilte Nutzer:</h4>
            <p>{$setusers}</p>
            <p><a href="{$page}?site=tasks_give_user&id={$id}"><span class="glyphicon glyphicon-plus"></span></a></p>
            <p>&nbsp;</p>
        {if $deadline}
            <h4>Deadline:</h4>
            <p>{$deadline}</p>
            <p>&nbsp;</p>
        {/if}
        {if $finished_by}
            <h4>Abgeschlossen von:</h4>
            <p>{$finished_by}</p>
            <p>&nbsp;</p>
        {/if}
        {if $time_finished}
            <h4>Abgeschlossen:</h4>
            <p>{$time_finished}</p>
            <p>&nbsp;</p>
        {/if}
        <p>&nbsp;</p>
        <a href="{$page}?site=tasks_summary"><p><span class="glyphicon glyphicon-arrow-left"></span> Zurück</p></a>
    </div>
{/block}