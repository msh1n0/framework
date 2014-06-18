{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    <h3>Aufgabe zuteilen: ("{$taskheadline}")</h3>
    <form action="{$page}" method="get">
        <input type="hidden" name="site" value="tasks_give_user">
        <input type="hidden" name="taskid" value="{$taskid}">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="user" class="label-default form-control">Benutzer</label>
                </div>
                <div class="col-md-9">
                    {$allusers}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <input type="submit" class="form-control btn btn-default" value="Aufgabe zuweisen">
                </div>
            </div>
        </div>
    </form>
{/block}