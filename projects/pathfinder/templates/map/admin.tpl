{extends "projects/pathfinder/templates/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Kartenverwaltung</h1>

        <table class="table table-responsive">
            <tr>
                <th>Dateiname</th>
                <th></th>
            </tr>
        {foreach item=map from=$maps}
            <tr>
                <td>{if $map==$activemap}<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;{/if}{$map}</td>
                <td class="text-right">
                    <a href="{$page}?site=mapadmin&action=activatemap&map={$map}"><span class="glyphicon glyphicon-cog" title="Karte aktivieren"></span></a>
                    &nbsp;&nbsp;
                    <a href="{$page}?site=mapadmin&action=deletefile&map={$map}"><span class="glyphicon glyphicon-remove" title="Karte löschen"></span></a>
                </td>
            </tr>
        {/foreach}
            <tr>
                <td></td>
                <td class="text-right">
                    <a href="{$page}?site=mapadmin&action=uploadfile"><span class="glyphicon glyphicon-plus" title="Neue Karte hochladen"></span></a>
                </td>
            </tr></table>
    </div>
{/block}