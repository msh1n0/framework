{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    <h3>Benutzer bearbeiten</h3>
    <form action="{$page}?site=useradmin_edit" method="post">
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label class="form-control label-default">Login</label>
                </div>
                <div class="col-md-9">
                    <input type="text" disabled="disabled" class="disabled form-control" value="{$user['id']}">
                    <input type="hidden" id="id" name="id" value="{$user['id']}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="firstname" class="form-control label-default">Vorname</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="firstname" id="firstname" value="{$user['firstname']}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="surname" class="form-control label-default">Nachname</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="surname" id="surname" value="{$user['surname']}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="email" class="form-control label-default">E-Mail</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="email" id="email" value="{$user['email']}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="phone" class="form-control label-default">Telefon</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="phone" id="phone" value="{$user['phone']}">
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
                        {foreach item=group from=$groups}
                            <option value="{$group['id']}"{if $group['id']==$user['group']} selected="selected" {/if}>{$group['name']}</option>
                        {/foreach}
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