<div class="navbar navbar-inverse navbar-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigation umschalten</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">{$username}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                {if !isset($userlevel)}
                    <li><a href="index.php?site=login">Anmelden</a></li>
                {/if}
                {if $player}
                    <li><a href="index.php?site=wuerfel">Würfeln</a></li>
                    <li><a href="index.php?site=karte">Karte</a></li>
                {/if}
                {if $admin}
                    <li><a href="index.php?site=useradmin">User-Admin</a></li>
                    <li><a href="index.php?site=mapadmin">Karte setzen</a></li>
                {/if}
                {if isset($userlevel)}
                    <li><a href="index.php?site=logout">Abmelden</a></li>
                {/if}
            </ul>
        </div>
    </div>
</div>