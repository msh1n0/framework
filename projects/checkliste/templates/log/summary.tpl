{extends "projects/checkliste/templates/index.tpl"}
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
                        <option {if $filter=='eingeloggt'}selected="selected" {/if}value="eingeloggt">eingeloggt</option>
                        <option {if $filter=='ausgeloggt'}selected="selected" {/if}value="ausgeloggt">ausgeloggt</option>
                        <option {if $filter=='Status geändert'}selected="selected" {/if}value="Status geändert">Status geändert</option>
                        <option {if $filter=='Aufgabe erstellt'}selected="selected" {/if}value="Aufgabe erstellt">Aufgabe erstellt</option>
                        <option {if $filter=='Aufgabe bearbeitet'}selected="selected" {/if}value="Aufgabe bearbeitet">Aufgabe bearbeitet</option>
                        <option {if $filter=='Aufgabe zugewiesen'}selected="selected" {/if}value="Aufgabe zugewiesen">Aufgabe zugewiesen</option>
                        <option {if $filter=='Aufgabe geschlossen'}selected="selected" {/if}value="Aufgabe geschlossen">Aufgabe geschlossen</option>
                        <option {if $filter=='Aufgabe abgebrochen'}selected="selected" {/if}value="Aufgabe abgebrochen">Aufgabe abgebrochen</option>
                        <option {if $filter=='Aufgabe zurückgesetzt'}selected="selected" {/if}value="Aufgabe zurückgesetzt">Aufgabe zurückgesetzt</option>
                        <option {if $filter=='Aufgabe angenommen'}selected="selected" {/if}value="Aufgabe angenommen">Aufgabe angenommen</option>
                        <option {if $filter=='Aufgabenzuordnung gelöscht'}selected="selected" {/if}value="Aufgabenzuordnung gelöscht">Aufgabenzuordnung gelöscht</option>
                        <option {if $filter=='Rückruf erfragt'}selected="selected" {/if}value="Rückruf erfragt">Rückruf erfragt</option>
                        <option {if $filter=='Benutzer angelegt'}selected="selected" {/if}value="Benutzer angelegt">Benutzer angelegt</option>
                        <option {if $filter=='Benutzer gelöscht'}selected="selected" {/if}value="Benutzer gelöscht">Benutzer gelöscht</option>
                        <option {if $filter=='Benutzer editiert'}selected="selected" {/if}value="Benutzer editiert">Benutzer editiert</option>
                        <option {if $filter=='Benutzergruppe erstellt'}selected="selected" {/if}value="Benutzergruppe erstellt">Benutzergruppe erstellt</option>
                        <option {if $filter=='Benutzergruppe gelöscht'}selected="selected" {/if}value="Benutzergruppe gelöscht">Benutzergruppe gelöscht</option>
                        <option {if $filter=='Benutzergruppe geändert'}selected="selected" {/if}value="Benutzergruppe geändert">Benutzergruppe geändert</option>
                        <option {if $filter=='Karte hochgeladen'}selected="selected" {/if}value="Karte hochgeladen">Karte hochgeladen</option>
                        <option {if $filter=='Karte gelöscht'}selected="selected" {/if}value="Karte gelöscht">Karte gelöscht</option>
                        <option {if $filter=='Karte aktiviert'}selected="selected" {/if}value="Karte aktiviert">Karte aktiviert</option>
                        <option {if $filter=='Karte deaktiviert'}selected="selected" {/if}value="Karte deaktiviert">Karte deaktiviert</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="submit" class="btn btn-default form-control" value="Ergebnisse filtern">
                </div>
            </form>
        </div>
        <h4>&nbsp;</h4>
        <div class="row hidden-xs">
            <div class="col-sm-2">
                <b>Zeitstempel</b>
            </div>
            <div class="col-sm-3">
                <b>Aktion</b>
            </div>
            <div class="col-sm-2">
                <b>Ausführender</b>
            </div>
            <div class="col-sm-5">
                <b>Details</b>
            </div>
        </div>
        {$count=0}
        {foreach item=item from=$log}
            {math assign="count" equation=$count+1}
            <div class="row row-activehover">
                <div class="col-sm-2">
                    {$item['id']|date_format:"%d. %m. - %H:%M:%S"}
                </div>
                <div class="col-sm-3 hidden-xs">
                    {$item['action']}
                </div>
                <div class="col-sm-2 visible-xs">
                    <b>{$item['action']}</b>
                </div>
                <div class="col-sm-2">
                    {$item['actor']}
                </div>
                <div class="col-sm-5">
                    {$item['information']}
                </div>
            </div>
            <p class="visible-xs">&nbsp;</p>
            {if $count>=20}{break}{/if}
        {/foreach}
    </div>
{/block}