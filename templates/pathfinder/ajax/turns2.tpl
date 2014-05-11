<h2>Runden</h2>
<table class="table table-responsive">
    <tr>
        <th></th>
        <th>Spieler</th>
        <th>TP</th>
        <th>Schaden tödlich</th>
        <th>Schaden nicht tödlich</th>
        <th>Initiative</th>
    </tr>
{foreach item=user from=$users}
    {if $user['hidden']=='false'}
        <tr>
            <td>
                {if $activeplayer['id']==$user['id']}
                    <a href="#" onclick="setTurn2('')"><span class="glyphicon glyphicon-play"></span></a>
                {else}
                    <a href="#" onclick="setTurn2('{$user['id']}')"><span class="glyphicon glyphicon-stop"></span></a>
                {/if}
            </td>
            <td>{$user['id']}</td>
            <td>{$user['tp']}</td>
            <td>{$user['dmgd']}</td>
            <td>{$user['dmgnd']}</td>
            <td>{$user['initiative']}</td>
        </tr>
    {/if}
{/foreach}
</table>