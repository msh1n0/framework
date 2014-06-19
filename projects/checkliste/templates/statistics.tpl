{extends "projects/checkliste/templates/index.tpl"}

{block name=content}
    {if $adminmode}
        <h3>{$user['firstname']} {$user['surname']}</h3>
        <hr>
    {/if}
        <div class="row">
            <div class="col-xs-4 text-center"><a href="{$page}?site=status&status=0"><span class="glyphicon glyphicon-user {if $user['status']==0}text-danger{else}text-primary{/if}"></span></a></div>
            <div class="col-xs-4 text-center"><a href="{$page}?site=status&status=1"><span class="glyphicon glyphicon-briefcase {if $user['status']==1}text-danger{else}text-primary{/if}"></span></a></div>
            <div class="col-xs-4 text-center"><a href="{$page}?site=status&status=2"><span class="glyphicon glyphicon-cutlery {if $user['status']==2}text-danger{else}text-primary{/if}"></span></a></div>
        </div>
    <hr>
    {include 'projects/checkliste/templates/_elements/tasksummary.tpl' overview=$mytasks headline='Aktuelle Aufgaben' mode='own'}
    <hr>
    {include 'projects/checkliste/templates/_elements/tasksummary.tpl' overview=$opentasks headline='Verfügbare Aufgaben' mode='outlook'}
{/block}