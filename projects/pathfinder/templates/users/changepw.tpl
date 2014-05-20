{extends "projects/pathfinder/templates/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Password für {$user['id']} setzen</h1>
        <form action="{$index}?site=useradmin&action=changepw" method="post">
            <div class="row form-group">
                <div class="col-xs-12">
                    <h4>Password</h4>
                    <input type="hidden" id="user[id]" name="user[id]" value="{$user['id']}">
                    <input type="password" id="user[password]" name="user[password]" class="form-control">
                </div>
            </div>
        </form>
    </div>
{/block}