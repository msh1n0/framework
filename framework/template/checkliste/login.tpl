{extends "framework/template/checkliste/index.tpl"}
{block name=content}
    <div class="alert">
        <form action="index.php?site=login" method="post">
            <div class="row">
                <div class="form-group {$has-error}">
                    <div class="col-md-2">
                        <label for="username" class="form-control">Benutzername:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group {$has-error}">
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
    </div>
{/block}