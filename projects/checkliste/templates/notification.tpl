{extends "projects/checkliste/templates/index.tpl"}

{block name=content}
    <div class="alert alert-danger">
        <h2>{$callback['firstname']} bittet um Rückmeldung</h2>
        <h4>Telefon: <a href="tel:{$callback['phone']}">{$callback['phone']}</a></h4>
        <h4>Email: <a href="mailto:{$callback['email']}">{$callback['email']}</a></h4>
        <div class="row">
            <div class="col-xs-12">
                <a href="{$page}?site=noification&action=close"><div class="btn btn-default form-control">OK</div></a>
            </div>
        </div>
    </div>
{/block}