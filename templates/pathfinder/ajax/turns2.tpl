<h2>Runden</h2>
<table class="table table-responsive">
    <tr>
        {if $isadmin}
        <th></th>
        {/if}
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
        <tr>
            {if $isadmin}
                <td>
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
                </td>
            {/if}
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
                        <a onclick="expandView('{$user['id']}',2)">x2</a>&nbsp;
                        <a onclick="expandView('{$user['id']}',4)">x4</a>&nbsp;
                        <a onclick="expandView('{$user['id']}',8)">x8</a>&nbsp;
                        <a onclick="expandView('{$user['id']}',16)">x16</a>&nbsp;
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