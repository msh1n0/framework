<div class="navbar navbar-default navbar-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigation umschalten</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {if $isLoggedIn}
                <a class="navbar-brand" href="{$page}?site=statistics">Startseite</a>
            {else}
                <a class="navbar-brand" href="{$page}?site=login">Einloggen</a>
            {/if}
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                {if $isLoggedIn}
                    <li><a href="{$page}?site=statistics">Übersicht</a></li>
                    <li><a href="{$page}?site=checklist">Meine Checkliste</a></li>
                    <li><a href="{$page}?site=tasks">Aufgaben</a></li>
                    <li><a href="">Hallenplan</a></li>
                    <li><a data-toggle="dropdown" href="#">Mein Status</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="{$page}"><span class="glyphicon glyphicon-briefcase" title="Aufgabe abschließen"></span>&nbsp;&nbsp;beschäftigt</a></li>
                            <li><a href="{$page}"><span class="glyphicon glyphicon-refresh" title="Aufgabe abschließen"></span>&nbsp;&nbsp;suche Aufgabe</a></li>
                            <li><a href="{$page}"><span class="glyphicon glyphicon-cutlery" title="Aufgabe abschließen"></span>&nbsp;&nbsp;Pause</a></li>
                            <li><a href="{$page}?site=logout"><span class="glyphicon glyphicon-log-out" title="Aufgabe abschließen"></span>&nbsp;&nbsp;ABMELDEN</a></li>
                        </ul>
                    </li>
                {/if}
                {if $isAdmin}
                    <li><a data-toggle="dropdown" href="#">Benutzeradministration</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="{$page}?site=useradmin_summary">Benutzer verwalten</a></li>
                            <li><a href="{$page}?site=useradmin_usergroups">Benutzergruppen verwalten</a></li>
                        </ul>
                    </li>
                {/if}
            </ul>
        </div>
    </div>
</div>