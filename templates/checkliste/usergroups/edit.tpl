{extends "templates/checkliste/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Benutzergruppe bearbeiten</h1>
        <form action="{$page}?site=useradmin_usergroups_edit&confirm=true" method="post">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="name" class="label-default form-control">Gruppenname</label>
                    </div>
                    <div class="col-md-9">
                        <input type="hidden" id="id" name="id" value="{$group['id']}">
                        <input type="text" id="name" name="name" class="form-control" value="{$group['name']}">
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
    </div>
{/block}