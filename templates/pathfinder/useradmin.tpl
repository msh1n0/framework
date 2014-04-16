{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Useradmin</h1>
    </div>
    {if isset($error)}
        <div class="alert alert-danger">
            {$error}
        </div>
    {/if}
    {if isset($message)}
        <div class="alert alert-success">
            {$message}
        </div>
    {/if}
    <div class="alert alert-info">
        {$usertable}
    </div>
    <div class="alert alert-info">
        <h3>Spieler anlegen</h3>
        <form action="index.php?site=useradmin" method="post">
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
                <div class="col-xs-3">
                    <label for="pass" class="control-label">Userlevel</label>
                </div>
                <div class="col-xs-9">
                    <input name="userlevel" type="text" value="" maxlength="2" class="form-control">
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