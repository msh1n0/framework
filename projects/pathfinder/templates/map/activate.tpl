{extends "projects/pathfinder/templates/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>{$map} einrichten</h1>
        <form action="{$index}?site=mapadmin&action=activatemap&confirm=true&mapname={$map}" method="post">
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-3">
                        <label for="cols" class="form-control">Spalten</label>
                    </div>
                    <div class="col-xs-9">
                        <input type="text" name="cols" id="cols" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="submit" value="Mapdaten speichern" class="form-control">
                    </div>
                </div>
            </div>
        </form>
    </div>
{/block}