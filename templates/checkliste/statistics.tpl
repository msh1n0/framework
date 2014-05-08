{extends "templates/checkliste/index.tpl"}

{block name=content}
    <div class="alert alert-info">
        {if $adminmode}
            <h2>{$user['firstname']} {$user['surname']}</h2>
        {/if}
            <h2>Aktueller Status:
            {if $user['status']==0}<span class="glyphicon glyphicon-user"></span>&nbsp;frei{/if}
            {if $user['status']==1}<span class="glyphicon glyphicon-briefcase"></span>&nbsp;beschäftigt{/if}
            {if $user['status']==2}<span class="glyphicon glyphicon-cutlery"></span>&nbsp;Pause{/if}
            {if $user['status']==3}<span class="glyphicon glyphicon-log-out"></span>&nbsp;Abgemeldet{/if}
        </h2>
    </div>
    <div class="alert alert-info">
        <h2>Aktuelle Aufgaben:</h2>
        <table class="table table-responsive"><tr>
            <th>Aufgabe</th>
            <th>Freigegeben für</th>
            <th>Deadline</th>
            <th></th>
        </tr>
        {foreach key=id item=task from=$mytasks}
            <tr>
                <td>{$task['headline']}</td>
                <td>{$suitablegroups}</td>
                <td>{$task['deadline']}</td>
                <td>
                    <!--<a href="checkliste.php?site=tasks_details&amp;id={$task['id']}"><span class="glyphicon glyphicon-list" title="Aufgabe abgeben"></span></a>&nbsp;-->
                    <a href="checkliste.php?site=tasks_details&amp;id={$task['id']}"><span class="glyphicon glyphicon-list" title="Details anzeigen"></span></a>&nbsp;
                </td>
            </tr>
        {/foreach}
        </table>
    </div>
    <div class="alert alert-info">
        <h2>Verfügbare Aufgaben:</h2>
        <table class="table table-responsive"><tr>
            <th>Aufgabe</th>
            <th>Freigegeben für</th>
            <th>Deadline</th>
            <th></th>
        </tr>
        {foreach key=id item=task from=$opentasks}
            <tr>
                <td>{$task['headline']}</td>
                <td>{$suitablegroups}</td>
                <td>{$task['deadline']}</td>
                <td>
                    <!--<a href="checkliste.php?site=tasks_details&amp;id={$task['id']}"><span class="glyphicon glyphicon-list" title="Aufgabe annehmen"></span></a>&nbsp;-->
                    <a href="checkliste.php?site=tasks_details&amp;id={$task['id']}"><span class="glyphicon glyphicon-list" title="Details anzeigen"></span></a>&nbsp;
                </td>
            </tr>
        {/foreach}
        </table>
    </div>
    <div class="alert alert-info">
        <h2>Abgeschlossene Aufgaben:</h2>
        <table class="table table-responsive"><tr>
                <th>Aufgabe</th>
                <th>Freigegeben für</th>
                <th>Abgeschlossen</th>
                <th></th>
            </tr>
            {foreach key=id item=task from=$closedtasks}
                <tr>
                    <td>{$task['headline']}</td>
                    <td>{$suitablegroups}</td>
                    <td>{$task['time_finished']}</td>
                    <td>
                        <a href="checkliste.php?site=tasks_details&amp;id={$task['id']}"><span class="glyphicon glyphicon-list" title="Details anzeigen"></span></a>&nbsp;
                    </td>
                </tr>
            {/foreach}
            </table>
    </div>
{/block}