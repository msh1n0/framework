{extends "templates/checkliste/index.tpl"}

{block name=content}
    <div class="alert alert-info">
        <h2>Aktueller Status:
            {if $status==0}<span class="glyphicon glyphicon-refresh"></span>&nbsp;frei{/if}
            {if $status==1}<span class="glyphicon glyphicon-briefcase"></span>&nbsp;beschäftigt{/if}
            {if $status==2}<span class="glyphicon glyphicon-cutlery"></span>&nbsp;Pause{/if}
        </h2>
    </div>
    <div class="alert alert-info">
        <h2>Meine Aufgaben:</h2>
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
                    <a href="checkliste.php?site=tasks_details&amp;id={$task['id']}"><span class="glyphicon glyphicon-list" title="Details anzeigen"></span></a>&nbsp;
                </td>
            </tr>
        {/foreach}
        </table>
    </div>
    <div class="alert alert-info">
        <h2>Offene Aufgaben:</h2>
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
                    <a href="checkliste.php?site=tasks_details&amp;id={$task['id']}"><span class="glyphicon glyphicon-list" title="Details anzeigen"></span></a>&nbsp;
                </td>
            </tr>
        {/foreach}
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="checkliste.php?site=tasks_create"><span class="glyphicon glyphicon-plus" title="Aufgabe anlegen"></span></a>
            </td>
        </tr></table>
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