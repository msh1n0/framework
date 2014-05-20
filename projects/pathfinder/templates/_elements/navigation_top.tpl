<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigation umschalten</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{$index}?site=wuerfel">{$currentuser['id']}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                {if !$isLoggedIn}
                    <li><a href="{$index}?site=login">Anmelden</a></li>
                {/if}
                {if $isLoggedIn}
                    <li><a href="{$index}?site=wuerfel">Würfeln</a></li>
                    <li><a href="{$index}?site=karte">Karte</a></li>
                    {if $isadmin}
                        <li><a href="{$index}?site=mapadmin">Karten verwalten</a></li>
                        <li><a href="{$index}?site=useradmin">User-Admin</a></li>
                    {/if}
                    <li><a href="{$index}?site=logout">Abmelden</a></li>
                {/if}
                <li><a href="" onclick="window.body.reload();"><span class="glyphicon glyphicon-refresh"></span></a></li>
            </ul>
        </div>
    </div>
</div>
<div style="width:100%;height:80px;"></div>