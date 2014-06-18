{extends "projects/checkliste/templates/index.tpl"}
{block name=content}
        <h3>Kartenverwaltung</h3>

        <table class="table table-responsive">
            <tr>
                <th>Dateiname</th>
                <th></th>
            </tr>
            {foreach item=map from=$allmaps}
                {$visibility='eye-close'}
                {$activate=''}
                {foreach item=item from=$mapsave}
                    {if $item['id']==$map && $item['active']=='true'}
                        {$visibility='eye-open'}
                        {$activate='de'}
                    {/if}
                {/foreach}
                <tr>
                    <td>{$map}</td>
                    <td class="text-right">
                        <a href="{$page}?site=map_admin&action=activatemap&map={$map}"><span class="glyphicon glyphicon-{$visibility}" title="Karte {$activate}aktivieren"></span></a>
                        &nbsp;&nbsp;
                        <a href="{$page}?site=map_admin&action=deletefile&map={$map}"><span class="glyphicon glyphicon-remove" title="Karte löschen"></span></a>
                    </td>
                </tr>
            {/foreach}
            <tr>
                <td></td>
                <td class="text-right">
                    <a href="{$page}?site=map_admin&action=uploadfile"><span class="glyphicon glyphicon-plus" title="Neue Karte hochladen"></span></a>
                </td>
            </tr></table>
{/block}