{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    <form action="{$page}?site=login" method="post">
        <div class="row">
            <div class="form-group {$has_error}">
                <div class="col-md-2">
                    <label for="id" class="form-control">Benutzername:</label>
                </div>
                <div class="col-md-10">
                    <input type="text" name="id" id="id" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {$has_error}">
                <div class="col-md-2">
                    <label for="password" class="form-control">Password:</label>
                </div>
                <div class="col-md-10">
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-2">
                </div>
                <div class="col-md-10">
                    <input type="submit" name="submit" id="submit" class="btn btn-default form-control">
                </div>
            </div>
        </div>
    </form>
{/block}