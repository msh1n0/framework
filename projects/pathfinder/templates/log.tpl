{extends "projects/pathfinder/templates/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h2>Log</h2>
        <h4>&nbsp;</h4>
        <h4><label for="filter">Filter:</label></h4>
        <div class="row">
            <form method="post">
                <div class="col-sm-4">
                    <select id="filter" name="filter" class="form-control">
                        <option {if $filter==''}selected="selected" {/if}value="">alle anzeigen</option>
                        <option {if $filter=='Autoinitiative gestartet'}selected="selected" {/if}value="Autoinitiative gestartet">Autoinitiative gestartet</option>
                        <option {if $filter=='ausgeloggt'}selected="selected" {/if}value="ausgeloggt">ausgeloggt</option>
                        <option {if $filter=='Benutzer angelegt'}selected="selected" {/if}value="Benutzer angelegt">Benutzer angelegt</option>
                        <option {if $filter=='Benutzer editiert'}selected="selected" {/if}value="Benutzer editiert">Benutzer editiert</option>
                        <option {if $filter=='eingeloggt'}selected="selected" {/if}value="eingeloggt">eingeloggt</option>
                        <option {if $filter=='Einzelner Würfel gegeben'}selected="selected" {/if}value="Einzelner Würfel gegeben">Einzelner Würfel gegeben</option>
                        <option {if $filter=='gewürfelt'}selected="selected" {/if}value="gewürfelt">gewürfelt</option>
                        <option {if $filter=='Kampfwürfel gegeben'}selected="selected" {/if}value="Kampfwürfel gegeben">Kampfwürfel gegeben</option>
                        <option {if $filter=='Karte aktiviert'}selected="selected" {/if}value="Karte aktiviert">Karte aktiviert</option>
                        <option {if $filter=='Karte gelöscht'}selected="selected" {/if}value="Karte gelöscht">Karte gelöscht</option>
                        <option {if $filter=='Karte hochgeladen'}selected="selected" {/if}value="Karte hochgeladen">Karte hochgeladen</option>
                        <option {if $filter=='Marker eingestellt'}selected="selected" {/if}value="Marker eingestellt">Marker eingestellt</option>
                        <option {if $filter=='Password geändert'}selected="selected" {/if}value="Password geändert">Password geändert</option>
                        <option {if $filter=='Phase gesetzt'}selected="selected" {/if}value="Phase gesetzt">Phase gesetzt</option>
                        <option {if $filter=='Pointer gesetzt'}selected="selected" {/if}value="Pointer gesetzt">Pointer gesetzt</option>
                        <option {if $filter=='Pointer Zurückgesetzt'}selected="selected" {/if}value="Pointer Zurückgesetzt">Pointer Zurückgesetzt</option>
                        <option {if $filter=='Runde erteilt'}selected="selected" {/if}value="Runde erteilt">Runde erteilt</option>
                        <option {if $filter=='Runde frei'}selected="selected" {/if}value="Runde frei">Runde frei</option>
                        <option {if $filter=='Sichtweite verändert'}selected="selected" {/if}value="Sichtweite verändert">Sichtweite verändert</option>
                        <option {if $filter=='Spieler auf Karte eingeblendet'}selected="selected" {/if}value="Spieler auf Karte eingeblendet">Spieler auf Karte eingeblendet</option>
                        <option {if $filter=='Spieler auf Karte ausgeblendet'}selected="selected" {/if}value="Spieler auf Karte ausgeblendet">Spieler auf Karte ausgeblendet</option>
                        <option {if $filter=='Spieler ausgeblendet'}selected="selected" {/if}value="Spieler ausgeblendet">Spieler ausgeblendet</option>
                        <option {if $filter=='Spieler eingeblendet'}selected="selected" {/if}value="Spieler eingeblendet">Spieler eingeblendet</option>
                        <option {if $filter=='Würfelmodus geändert'}selected="selected" {/if}value="Würfelmodus geändert">Würfelmodus geändert</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="submit" class="btn btn-default form-control" value="Ergebnisse filtern">
                </div>
            </form>
        </div>
        <h4>&nbsp;</h4>
        <table class="table table-responsive" id="log">
        <thead>
        <tr>
            <th>Zeitstempel</th>
            <th>Aktion</th>
            <th>Ausführender</th>
            <th>Details</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Zeitstempel</th>
            <th>Aktion</th>
            <th>Ausführender</th>
            <th>Details</th>
        </tr>
        </tfoot>
        {$count=0}
        {foreach item=item from=$log}
            {math assign="count" equation=$count+1}
            <tr>
                <td>
                    {$item['id']|date_format:"%d. %m. - %H:%M:%S"}
                </td>
                <td>
                    {$item['action']}
                </td>
                <td>
                    <b>{$item['actor']}</b>
                </td>
                <td>
                    {$item['information']}
                </td>
            </tr>
            {*if $count>=30}{break}{/if*}
        {/foreach}
        </table>
    </div>
{/block}
{block name="scriptblock_unten" append}
    <link rel="stylesheet" type="text/css" href="projects/pathfinder/templates/_resources/css/datatables.css">
    <script src="projects/pathfinder/templates/_resources/js/datatables.js"></script>
    <script>
        {literal}
        $(document).ready(function() {
            $('#log').dataTable( {
                "order": [[ 0, "desc" ]],
                "searching":   false,
                "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Alle ({/literal}{$count}{literal})"]],
                "language": {
                    "lengthMenu": "Zeige _MENU_ Einträge pro Seite",
                    "zeroRecords": "Nichts gefunden",
                    "info": "Zeige Seite _PAGE_ von _PAGES_",
                    "infoEmpty": "Keine Einträge",
                    "infoFiltered": "(gefiltert aus insgesamt _MAX_ Einträgen)",
                    "search": "Suche"
                }
            } );
        } );
        {/literal}
    </script>
{/block}