{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    <h3>Benutzergruppe erstellen</h3>
    <form action="{$page}?site=useradmin_usergroups_create" method="post">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="name" class="label-default form-control">Gruppenname</label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="name" name="name" class="form-control" value="{$name}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="admin" class="label-default form-control">Verwaltungsrecht</label>
                </div>
                <div class="col-md-9">
                    <input type="checkbox" id="admin" name="admin" class="checkbox form-control"{if $group['admin']==true} checked="checked"{/if} value="1">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <input type="submit" class="btn btn-default form-control" value="speichern">
                </div>
            </div>
        </div>
    </form>
{/block}