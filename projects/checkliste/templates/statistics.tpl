{extends "projects/checkliste/templates/index.tpl"}

{block name=content}
    {if $adminmode}
        <h2>{$user['firstname']} {$user['surname']}</h2>
        <hr>
    {/if}
        <h2>Status:
        {if $user['status']==0}<span class="glyphicon glyphicon-user"></span>&nbsp;frei{/if}
        {if $user['status']==1}<span class="glyphicon glyphicon-briefcase"></span>&nbsp;beschäftigt{/if}
        {if $user['status']==2}<span class="glyphicon glyphicon-cutlery"></span>&nbsp;Pause{/if}
        {if $user['status']==3}<span class="glyphicon glyphicon-log-out"></span>&nbsp;Abgemeldet{/if}
    </h2>
    <hr>
    {include 'projects/checkliste/templates/_elements/tasksummary.tpl' overview=$mytasks headline='Aktuelle Aufgaben' mode='own'}
    <hr>
    {include 'projects/checkliste/templates/_elements/tasksummary.tpl' overview=$opentasks headline='Verfügbare Aufgaben' mode='outlook'}
{/block}