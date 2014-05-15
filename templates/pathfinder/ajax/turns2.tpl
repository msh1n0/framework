<h2>Runden</h2>
<table class="table table-responsive">
    <tr>
        <th></th>
        <th>Spieler</th>
        <th>TP</th>
        <th>Schaden tödlich</th>
        <th>Schaden nicht tödlich</th>
        <th>Initiative</th>
        <th></th>
    </tr>
{foreach item=user from=$users}
    {if $user['hidden']=='false'}
        <tr>
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
            <td>{$user['id']}</td>
            <td>{$user['tp']}</td>
            <td>{$user['dmgd']}</td>
            <td>{$user['dmgnd']}</td>
            <td>{$user['initiative']}</td>
            <td>
                {if $user['playable']=='false'}
                    <a href="#" onclick="monsterMarker('{$user['id']}','000')"><span class="glyphicon glyphicon-stop" title="tot"></span></a>&nbsp;
                    <a href="#" onclick="monsterMarker('{$user['id']}','600')"><span class="glyphicon glyphicon-play" title="stark angeschlagen"></span></a>&nbsp;
                    <a href="#" onclick="monsterMarker('{$user['id']}','a00')"><span class="glyphicon glyphicon-forward" title="leicht angeschlagen"></span></a>&nbsp;
                    <a href="#" onclick="monsterMarker('{$user['id']}','f00')"><span class="glyphicon glyphicon-fast-forward" title="fit"></span></a>&nbsp;
                {/if}
            </td>
        </tr>
    {/if}
{/foreach}
    <tr>
        <td>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>