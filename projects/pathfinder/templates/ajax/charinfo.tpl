<h2>{$currentuser['id']}</h2>
<table class="table table-responsive">
    <tr>
        <th class="text-center">Grundangriffsbonus</th>
        <th class="text-center">Initiativbonus</th>
        <th class="text-center">Rüstungsklasse</th>
        <th class="text-center">TP</th>
        <th class="text-center">Schaden tödlich</th>
        <th class="text-center">Schaden normal</th>
    </tr>
    <tr>
        <td class="text-center">{$currentuser['gab']}</td>
        <td class="text-center">{$currentuser['init']}</td>
        <td class="text-center">{$currentuser['rk']}</td>
        <td class="text-center">{$currentuser['tp']}</td>
        <td class="text-center">{$currentuser['dmgd']}</td>
        <td class="text-center">{$currentuser['dmgnd']}</td>
    </tr>
</table>