<h1>Karte</h1>
{if $isadmin}
    <div class="form-group">
        <div class="row">
            <div class="col-xs-3">
                <label for="name" class="form-control">Spieler</label>
            </div>
            <div class="col-xs-9">
                <select id="name" name="name" class="form-control">
                    {foreach item=user from=$users}
                        <option value="{$user['id']}">{$user['id']}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    </div>
{/if}
{$pointers}

{$map}
