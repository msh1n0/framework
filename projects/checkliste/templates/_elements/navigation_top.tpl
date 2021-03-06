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
                <a class="navbar-brand" href="{$page}?site=statistics">{$currentuser['firstname']} {$currentuser['surname']}</a>
            {else}
                <a class="navbar-brand" href="{$page}?site=login">Einloggen</a>
            {/if}
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                {if $isLoggedIn}
                    <li><a data-toggle="dropdown" href="#">Aufgaben</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="{$page}?site=statistics"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Übersicht</a></li>
                            <li><a href="{$page}?site=tasks_create"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Aufgabe anlegen</a></li>
                            <li><a href="{$page}?site=tasks_summary&filter=finish_status&value=1&mode=own"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;&nbsp;fertige Aufgaben</a></li>
                            {if $isadmin}
                                <li><hr></li>
                                <li><a href="{$page}?site=tasks_summary&filter=finish_status&value=0&mode=all"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;offene Aufgaben Gesamt</a></li>
                                <li><a href="{$page}?site=tasks_summary&filter=finish_status&value=1&mode=all"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;&nbsp;fertige Aufgaben Gesamt</a></li>
                                <li><a href="{$page}?site=tasks_summary&filter=finish_status&value=2&mode=all"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;gelöschte Aufgaben</a></li>
                            {/if}
                        </ul>
                    </li>
                    {$count=0}
                    {foreach item=item from=$maps}
                        {if $item['active']=='true'}{math assign="count" equation=$count+1}{/if}
                    {/foreach}
                    {if $count==0}
                    {else}
                        <li><a data-toggle="dropdown" href="#">Dateien</a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        {foreach item=map from=$maps}
                            <li><a href="projects/checkliste/contents/images/media/{$map['id']}" target="_blank">
                                {$map['id']}
                            </a></li>
                        {/foreach}
                            </ul>
                        </li>
                    {/if}
                    <li><a href="{$page}?site=users">Mitarbeiter</a></li>
                    {if $isadmin}
                        <li><a data-toggle="dropdown" href="#">Administration</a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="{$page}?site=useradmin_summary">Benutzer verwalten</a></li>
                                <li><a href="{$page}?site=useradmin_usergroups_summary">Benutzergruppen verwalten</a></li>
                                <li><a href="{$page}?site=map_admin">Dateien verwalten</a></li>
                                <li><a href="{$page}?site=force_logout">Alle Benutzer abmelden</a></li>
                                <li><a href="{$page}?site=log">Log-Datei ansehen</a></li>
                            </ul>
                        </li>
                    {/if}
                    <li><a data-toggle="dropdown" href="#">Mein Status</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="{$page}?site=status&status=0"><span class="glyphicon glyphicon-user" title="Aufgabe abschließen"></span>&nbsp;&nbsp;frei</a></li>
                            <li><a href="{$page}?site=status&status=1"><span class="glyphicon glyphicon-briefcase" title="Aufgabe abschließen"></span>&nbsp;&nbsp;beschäftigt</a></li>
                            <li><a href="{$page}?site=status&status=2"><span class="glyphicon glyphicon-cutlery" title="Aufgabe abschließen"></span>&nbsp;&nbsp;Pause</a></li>
                            <li><a href="{$page}?site=logout"><span class="glyphicon glyphicon-log-out" title="Aufgabe abschließen"></span>&nbsp;&nbsp;ABMELDEN</a></li>
                        </ul>
                    </li>
                    <li><a href=""><span class="glyphicon glyphicon-refresh" onclick="window.location.reload()"></span></a></li>
                    <li><a href="{$page}?site=switchtheme"><span class="glyphicon glyphicon-adjust"></span></a></li>
                {/if}
            </ul>
        </div>
    </div>
</div>