<h1>Runden</h1>
{foreach item=user from=$users}
    {if $user['hidden']=='false'}
        <form action="{$page}?site=useradmin&action=edituser&user={$user['id']}&from=wuerfel" method="post">
            <input type="hidden" value="{$user['id']}" id="user[id]" name="user[id]" >
            <div class="row">
                <div class="col-lg-2">
                    <label class="form-control">Spieler:</label>
                </div>
                <div class="col-lg-3">
                    <input type="text" disabled="disabled" class="form-control" value="{$user['id']} {if $user['playable']=='false'}(NPC){/if}">
                </div>
            </div>
            {if $isadmin}
                <div class="row">
                    <div class="col-lg-2">
                        <label class="form-control">TP:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[tp]" name="user[tp]" value="{$user['tp']}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Rüstungsklasse:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[rk]" name="user[rk]" value="{$user['rk']}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">GAB:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[gab]" name="user[gab]" value="{$user['gab']}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Initiativbonus:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[init]" name="user[init]" value="{$user['init']}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <label class="form-control">Initiative:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[initiative]" name="user[initiative]" value="{$user['initiative']}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Schaden tödlich:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[dmgd]" name="user[dmgd]" value="{$user['dmgd']}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Schaden normal:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[dmgnd]" name="user[dmgnd]" value="{$user['dmgnd']}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <label class="form-control">Kontingent w4:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w4]" name="user[w4]" value="{$user['w4']}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Kontingent w6:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w6]" name="user[w6]" value="{$user['w6']}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Kontingent w8:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w8]" name="user[w8]" value="{$user['w8']}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Kontingent w10:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w10]" name="user[w10]" value="{$user['w10']}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <label class="form-control">Kontingent w12:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w12]" name="user[w12]" value="{$user['w12']}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Kontingent w20:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w20]" name="user[w20]" value="{$user['w20']}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Kontingent w100:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w100]" name="user[w100]" value="{$user['w100']}">
                    </div>
                    <div class="col-lg-3">
                        <input type="submit" class="btn btn-default form-control">
                    </div>
                </div>
            {else}
                <div class="row">
                    <div class="col-lg-2">
                        <label class="form-control">TP:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[tp]" name="user[tp]" value="{if $user['playable']=='false'}?{else}{$user['tp']}{/if}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Schaden tödlich:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[dmgd]" name="user[dmgd]" value="{if $user['playable']=='false'}?{else}{$user['dmgd']}{/if}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Schaden normal:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[dmgnd]" name="user[dmgnd]" value="{if $user['playable']=='false'}?{else}{$user['dmgnd']}{/if}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control">Initiative:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[initiative]" name="user[initiative]" value="{$user['initiative']}">
                    </div>
                </div>
            {/if}
        </form>
    <div class="row">
        <div class="col-xs-12">
            <hr>
        </div>
    </div>
    {/if}
{/foreach}