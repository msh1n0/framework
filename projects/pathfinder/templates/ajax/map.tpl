<h1>Karte</h1>
{if $isadmin}
    <div class="form-group">
        <div class="row">
            <div class="col-xs-3">
                <label for="name" class="form-control">Spieler</label>
            </div>
            <div class="col-xs-9">
                <select id="name" name="name" class="form-control">
                    <option value="#">*aktiver Spieler*</option>
                    {foreach item=user from=$users}
                        <option value="{$user['id']}">{$user['id']}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
            </div>
            <div class="col-xs-9">
                <input type="button" onclick="resetPointer('ZIEL')" class="btn btn-default form-control" value="Zielmarker entfernen">
            </div>
        </div>
    </div>
{/if}
<div id="mappointers">
{$pointers}
</div>
{$map}
