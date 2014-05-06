{extends "templates/checkliste/index.tpl"}
{block name=content}
<div class="alert alert-info">
    <h1>Benutzer anlegen</h1>
    <form action="{$page}?site=useradmin_create" method="post">
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="id" class="form-control label-default">Login*</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="id" id="id" value="{$user['id']}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row {$has_error}">
                <div class="col-md-3">
                    <label for="password" class="form-control label-default">Password*</label>
                </div>
                <div class="col-md-9">
                    <input type="password" class="form-control" name="password" id="password" value="">
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
</div>
{/block}