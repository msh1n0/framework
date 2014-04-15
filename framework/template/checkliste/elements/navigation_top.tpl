<div class="navbar navbar-default navbar-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigation umschalten</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {if $loggedIn}
                <a class="navbar-brand" href="index.php?site=statistics">Startseite</a>
            {else}
                <a class="navbar-brand" href="index.php?site=login">Einloggen</a>
            {/if}
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                {if $loggedIn}
                    <li><a href="index.php?site=statistics">Übersicht</a></li>
                    <li><a href="index.php?site=checklist">Meine Checkliste</a></li>
                    <li><a data-toggle="dropdown" href="#">Aufgaben</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="index.php?site=checklist">Hilfe benötigt</a></li>
                            <li><a href="index.php?site=checklist">Alle Aufgaben</a></li>
                        </ul>
                    </li>
                    <li><a href="">Hallenplan</a></li>
                    <li><a data-toggle="dropdown" href="#">Mein Status</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="index.php">beschäftigt</a></li>
                            <li><a href="index.php"></a></li>
                            <li><a href="index.php">Pause</a></li>
                            <li><a href="index.php">ABMELDEN</a></li>
                        </ul>
                    </li>
                {/if}
                {if $isAdmin}
                    <li><a data-toggle="dropdown" href="#">Benutzeradministration</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="index.php?site=useradmin_summary">Benutzerübersicht</a></li>
                            <li><a href="index.php?site=useradmin_users">Benutzer verwalten</a></li>
                            <li><a href="index.php?site=useradmin_usergroups">Benutzergruppen verwalten</a></li>
                        </ul>
                    </li>
                {/if}
            </ul>
        </div>
    </div>
</div>