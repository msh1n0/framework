{block name=content}
    <h3>{$headline}:</h3>
    {foreach key=id item=task from=$overview}
    <div class="row">
        <div class="{if $task['finish_status']!=0}col-md-2 col-sm-3{else}col-md-3 col-sm-4{/if}">
            <b>Aufgabe</b><br>
            {$task['headline']}
        </div>
        <div class="col-md-2 col-lg-3 hidden-sm">
            <b>Ort</b><br>
            {$task['place']}
        </div>
        <div class="col-sm-2">
            <b>Deadline</b><br>
            {$task['deadline']}
        </div>
        <div class="col-md-2 col-sm-2">
            <b>Besetzung</b><br>
            {$usercount=0}
            {foreach item=link from=$user_tasks}
                {if $link['taskid']==$task['id']}
                    {math assign="usercount" equation=$usercount+1}
                {/if}
            {/foreach}
            {if $usercount==0}-{else}{$usercount}{/if}/{if $task['participants_min']==0}-{else}{$task['participants_min']}{/if}
        </div>
        {if $task['finish_status']!=0}
            <div class="col-sm-2">
                {if $task['finish_status']==1}
                    abgeschlossen
                {/if}
                {if $task['finish_status']==2}
                    gelöscht
                {/if}
                {$task['time_finished']} von {$task['finished_by']}
            </div>
        {/if}
        <div class="{if $task['finish_status']!=0}col-lg-1 col-md-2 col-sm-3{else}col-lg-2 col-md-3 col-sm-4{/if} text-right">
            {if $adminmode}
                {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode=='outlook'}
                    <a href="{$page}?site=tasks_give_user&mode=admin&taskid={$task['id']}&user={$originaluser}"><span class="glyphicon glyphicon-save" title="Aufgabe annehmen"></span></a>&nbsp;&nbsp;
                {/if}
                {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode=='own'}
                    <a href="{$page}?site=tasks_resign&mode=admin&taskid={$task['id']}&user={$originaluser}"><span class="glyphicon glyphicon-export" title="Aufgabe abweisen"></span></a>&nbsp;&nbsp;
                {/if}
            {else}
                {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode!='outlook' || $isadmin}
                    <a href="{$page}?site=tasks_edit&id={$task['id']}"><span class="glyphicon glyphicon-pencil" title="Aufgabe bearbeiten"></span></a>&nbsp;&nbsp;
                {/if}

                <a href="{$page}?site=tasks_details&id={$task['id']}"><span class="glyphicon glyphicon-list-alt" title="Details anzeigen"></span></a>&nbsp;&nbsp;
                {if $task['finish_status']!=0}
                    <a href="{$page}?site=tasks_restart&id={$task['id']}"><span class="glyphicon glyphicon-retweet" title="Aufgabe erneut starten"></span></a>&nbsp;&nbsp;
                {/if}
                {if $isadmin}
                    {if $task['finish_status']!=1 && $task['finish_status']!=2} <a href="{$page}?site=tasks_give_user&id={$task['id']}">
                        <span class="glyphicon glyphicon-transfer" title="Aufgabe zuteilen"></span></a>&nbsp;&nbsp;
                    {/if}
                {/if}
                {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode!='own'}
                    <a href="{$page}?site=tasks_give_user&mode=summary&taskid={$task['id']}&user={$user['id']}"><span class="glyphicon glyphicon-save" title="Aufgabe annehmen"></span></a>&nbsp;&nbsp;
                {/if}
                {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode=='own'}
                    <a href="{$page}?site=tasks_resign&taskid={$task['id']}&user={$user['id']}&fromsite=statistics"><span class="glyphicon glyphicon-export" title="Aufgabe abweisen"></span></a>&nbsp;&nbsp;
                {/if}
                {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode!='outlook'} <a href="{$page}?site=tasks_close&id={$task['id']}">
                    <span class="glyphicon glyphicon-saved" title="Aufgabe abschließen"></span></a>&nbsp;&nbsp;
                {/if}
                {if $task['finish_status']!=1 && $task['finish_status']!=2 && $mode!='outlook'} <a href="{$page}?site=tasks_cancel&id={$task['id']}">
                    <span class="glyphicon glyphicon-trash" title="Aufgabe entfernen"></span></a>&nbsp;&nbsp;
                {/if}
            {/if}
        </div>
    </div>
        <hr class="visible-xs">
        {/foreach}
        {if $task['finish_status']==0}
            <div class="row">
                <div class="col-xs-12">
                    {if $mode=='outlook' && !$adminmode}
                        <a href="{$page}?site=tasks_create"><button class="btn btn-default form-control text-center"><span class="glyphicon glyphicon-plus" title="Aufgabe anlegen"></span></button></a>&nbsp;&nbsp;
                    {/if}
                </div>
            </div>
        {/if}
{/block}