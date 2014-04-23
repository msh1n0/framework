{extends "templates/checkliste/index.tpl"}
{block name=content}
    {if $overview}
        <div class="alert alert-info">

        </div>
    {/if}
    <h1>Aufgabe zuteilen: ("{$taskheadline}")</h1>
    <form action="{$page}?site=tasks_give_user&id={$taskid}" method="post">
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