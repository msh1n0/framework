{extends "templates/checkliste/index.tpl"}
{block name=content}
    <h1>Benutzer bearbeiten</h1>
    <form action="{$page}?site=useradmin_edit" method="post">
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label class="form-control label-default">Login</label>
                </div>
                <div class="col-md-9">
                    <input type="text" disabled="disabled" class="disabled form-control" value="{$id}">
                    <input type="hidden" id="id" name="id" value="{$id}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="firstname" class="form-control label-default">Vorname</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="firstname" id="firstname" value="{$firstname}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="surname" class="form-control label-default">Nachname</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="surname" id="surname" value="{$surname}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="email" class="form-control label-default">E-Mail</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="email" id="email" value="{$email}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="phone" class="form-control label-default">Telefon</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="phone" id="phone" value="{$phone}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="group" class="form-control label-default">Benutzergruppe</label>
                </div>
                <div class="col-md-9">
                    <select class="form-control" id="group" name="group">
                    {$groups}
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <input type="submit" class="form-control btn btn-default" value="speichern">
                </div>
            </div>
        </div>
    </form>
{/block}