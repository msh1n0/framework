<table class="table table-responsive">
    <tr>
        <th colspan="2">
            {$headline}
        </th>
    </tr>
    {foreach item=testcase from=$elements}
        <tr>
            <td>
                {$testcase[0]}
            </td>
            <td>
                {if $testcase[1]==true}
                    <span class="text-success">erfolgreich</span>
                {else}
                    <span class="text-danger">fehlgeschlagen</span>
                {/if}
            </td>
        </tr>
    {/foreach}
</table>