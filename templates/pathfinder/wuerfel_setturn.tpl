{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>{$user} die Würfel geben</h1>
        <div class="row">
            <div class="col-xs-1">
                <h4>W4</h4>
            </div>
            <div class="col-xs-1">
                <h4>W6</h4>
            </div>
            <div class="col-xs-1">
                <h4>W8</h4>
            </div>
            <div class="col-xs-1">
                <h4>W10</h4>
            </div>
            <div class="col-xs-1">
                <h4>W12</h4>
            </div>
            <div class="col-xs-1">
                <h4>W20</h4>
            </div>
            <div class="col-xs-1">
                <h4>W100</h4>
            </div>
        </div>
        <form action="{$index}?site=wuerfel&action=setturn&user={$user}&confirm=true" method="post">
            <div class="row">
                <div class="col-xs-1">
                    <input type="text" class="form-control" maxlength="2" name="w4" id="w4">
                </div>
                <div class="col-xs-1">
                    <input type="text" class="form-control" maxlength="2" name="w6" id="w6">
                </div>
                <div class="col-xs-1">
                    <input type="text" class="form-control" maxlength="2" name="w8" id="w8">
                </div>
                <div class="col-xs-1">
                    <input type="text" class="form-control" maxlength="2" name="w10" id="w10">
                </div>
                <div class="col-xs-1">
                    <input type="text" class="form-control" maxlength="2" name="w12" id="w12">
                </div>
                <div class="col-xs-1">
                    <input type="text" class="form-control" maxlength="2" name="w20" id="w20">
                </div>
                <div class="col-xs-1">
                    <input type="text" class="form-control" maxlength="2" name="w100" id="w100">
                </div>
                <div class="col-xs-1">

                </div>
                <div class="col-xs-4">
                   <input type="submit" class="form-control" value="speichern">
                </div>
            </div>
        </form>
    </div>
{/block}