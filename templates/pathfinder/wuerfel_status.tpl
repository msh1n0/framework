{extends "templates/pathfinder/index.tpl"}
{block name=content}
    <div class="alert alert-danger" id="tässt">

    </div>
    <div class="alert alert-danger">
        <a href="#" onclick="test()">figgityfuck</a>
    </div>

    <div class="alert alert-info">
        <h1>Würfel</h1>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w4" id="btn-w4" value="W4">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w4">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w6" id="btn-w6" value="w6">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w6">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w8" id="btn-w8" value="w8">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w10" id="btn-w10" value="w10">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w10">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w12" id="btn-w12" value="w12">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w12">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w20" id="btn-w20" value="w20">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w20">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <input type="button" class="btn btn-default form-control" name="w100" id="btn-w100" value="w100">
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control" disabled="disabled" id="w100">
                </div>
            </div>
        </div>
    </div>
{/block}
{block name=scriptblock_unten append}
    <script src="templates/pathfinder/_resources/js/wuerfel.js"></script>
{/block}