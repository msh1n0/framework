{extends "framework/template/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Login</h1>
        <form action="index.php?site=login" method="post">
            <div class="row">
                <div class="col-xs-3">
                    <label for="pass" class="control-label">Benutzername</label>
                </div>
                <div class="col-xs-9">
                    <input name="username" type="text" value="" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <label for="pass" class="control-label">Password</label>
                </div>
                <div class="col-xs-9">
                    <input name="password" type="password" value="" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-9">
                    <input type="submit" class="form-control">
                </div>
            </div>
        </form>
    </div>
{/block}