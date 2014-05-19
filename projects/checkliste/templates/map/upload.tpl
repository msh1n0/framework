{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Karte hochladen</h1>
        <form action="{$index}?site=map_admin&action=uploadfile&confirm=true" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="file" name="userfile" id="userfile">
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