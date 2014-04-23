{extends "templates/checkliste/index.tpl"}
{block name=content}
    <h1>Benutzergruppe bearbeiten</h1>
    <form action="{$page}?site=useradmin_usergroups_edit&confirm=true" method="post">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="name" class="label-default form-control">Gruppenname</label>
                </div>
                <div class="col-md-9">
                    <input type="hidden" id="id" name="id" value="{$id}">
                    <input type="text" id="name" name="name" class="form-control" value="{$name}">
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