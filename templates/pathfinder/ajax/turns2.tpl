<h2>Runden</h2>
<table class="table table-responsive">
    <tr>
        <th></th>
        <th>Spieler</th>
        <th>TP</th>
        <th>Schaden tödlich</th>
        <th>Schaden nicht tödlich</th>
        <th>Initiative</th>
        {if $isadmin}
            <th></th>
        {/if}
    </tr>
{foreach item=user from=$users}
    {if $user['hidden']=='false'}
        <tr{if !$isadmin && $user['mapvisible']!='true'} style="display:none;"{/if}>
            <td>
            {if $isadmin}
                {if $activeplayer['id']==$user['id']}
                    <a onclick="setTurn2('')"><span class="glyphicon glyphicon-play"></span></a>&nbsp;
                {else}
                    <a onclick="setTurn2('{$user['id']}')"><span class="glyphicon glyphicon-stop"></span></a>&nbsp;
                {/if}
                {if $user['mapvisible']=='true'}
                    <a onclick="mapInvisible('{$user['id']}')"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;
                {else}
                    <a onclick="mapVisible('{$user['id']}')"><span class="glyphicon glyphicon-eye-close"></span></a>&nbsp;
                {/if}
            {else}
                {if $activeplayer['id']==$user['id']}
                    <span class="glyphicon glyphicon-play"></span>&nbsp;
                {else}
                    <span class="glyphicon glyphicon-stop"></span>&nbsp;
                {/if}
            {/if}
            </td>
            <td>{$user['id']}</td>
            <td>{$user['tp']}</td>
            <td>{$user['dmgd']}</td>
            <td>{$user['dmgnd']}</td>
            <td>{$user['initiative']}</td>
            {if $isadmin}
                <td class="text-right">
                    {if $user['playable']=='false'}
                        <a onclick="setMarker('{$user['id']}','000')"><span class="glyphicon glyphicon-stop text-success" title="tot"></span></a>&nbsp;
                        <a onclick="setMarker('{$user['id']}','600')"><span class="glyphicon glyphicon-play text-warning" title="stark angeschlagen"></span></a>&nbsp;
                        <a onclick="setMarker('{$user['id']}','a00')"><span class="glyphicon glyphicon-forward text-warning" title="leicht angeschlagen"></span></a>&nbsp;
                        <a onclick="setMarker('{$user['id']}','f00')"><span class="glyphicon glyphicon-fast-forward text-danger" title="fit"></span></a>&nbsp;
                    {else}
                        Sichweite {if $user['mapsight']}(aktuell {$user['mapsight']}){/if}:
                        <select>
                            <option onclick="expandView('{$user['id']}',2)" value="2"{if $user['mapsight']=='2'} selected="selected"{$user['mapsight']}{/if}>2</option>
                            <option onclick="expandView('{$user['id']}',4)" value="4"{if $user['mapsight']=='4'} selected="selected"{$user['mapsight']}{/if}>4</option>
                            <option onclick="expandView('{$user['id']}',6)" value="6"{if $user['mapsight']=='6'} selected="selected"{$user['mapsight']}{/if}>6</option>
                            <option onclick="expandView('{$user['id']}',8)" value="8"{if $user['mapsight']=='8'} selected="selected"{$user['mapsight']}{/if}>8</option>
                            <option onclick="expandView('{$user['id']}',10)" value="10"{if $user['mapsight']=='10'} selected="selected"{$user['mapsight']}{/if}>10</option>
                            <option onclick="expandView('{$user['id']}',12)" value="12"{if $user['mapsight']=='12'} selected="selected"{$user['mapsight']}{/if}>12</option>
                            <option onclick="expandView('{$user['id']}',14)" value="14"{if $user['mapsight']=='14'} selected="selected"{$user['mapsight']}{/if}>14</option>
                            <option onclick="expandView('{$user['id']}',16)" value="16"{if $user['mapsight']=='16'} selected="selected"{$user['mapsight']}{/if}>16</option>
                            <option onclick="expandView('{$user['id']}',18)" value="18"{if $user['mapsight']=='18'} selected="selected"{$user['mapsight']}{/if}>18</option>
                            <option onclick="expandView('{$user['id']}',20)" value="20"{if $user['mapsight']=='20'} selected="selected"{$user['mapsight']}{/if}>20</option>
                        </select>
                    {/if}
                </td>
            {/if}
        </tr>
    {/if}
{/foreach}
    <tr>
        {if $isadmin}
            <td></td>
        {/if}
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        {if $isadmin}
            <td></td>
        {/if}
    </tr>
</table>