<div class="navbar navbar-inverse navbar-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigation umschalten</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{$index}">{$username}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                {if !isset($username)}
                    <li><a href="{$index}?site=login">Anmelden</a></li>
                {/if}
                {if $player}
                    <li><a href="{$index}?site=wuerfel">Würfeln</a></li>
                    <li><a href="{$index}?site=karte">Karte</a></li>
                {/if}
                {if $admin}
                    <li><a href="{$index}?site=mapadmin">Karte setzen</a></li>
                    <li><a href="{$index}?site=useradmin">User-Admin</a></li>
                {/if}
                {if isset($username)}
                    <li><a href="{$index}?site=logout">Abmelden</a></li>
                {/if}
            </ul>
        </div>
    </div>
</div>