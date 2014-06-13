{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    {foreach key=id item=task from=$overview}
        <div class="row">
            <div class="col-md-2 col-sm-3">
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
        </div>
    {/foreach}
{/block}