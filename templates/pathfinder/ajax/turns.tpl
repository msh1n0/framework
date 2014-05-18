<h2>Runden</h2>
{foreach item=user from=$users}
    {if $user['hidden']=='false'}
        <form action="{$page}?site=useradmin&action=edituser&user={$user['id']}&from=wuerfel" method="post">
            <input type="hidden" value="{$user['id']}" id="user[id]" name="user[id]" >
            <div class="row{if $activeplayer['id']==$user['id']} has-error{/if}"{if !$isadmin && $user['mapvisible']!='true'} style="display:none;"{/if}>
                <div class="col-lg-2">
                    <label for="user[id]" class="form-control">Spieler:</label>
                </div>
                <div class="col-lg-3">
                    <input type="text" disabled="disabled" class="form-control" id="user[id]" value="{$user['id']} {if $user['playable']=='false'}(NPC){/if}">
                </div>
            </div>
            {if $isadmin}
                <div class="row{if $activeplayer['id']==$user['id']} has-error{/if}"{if !$isadmin && $user['mapvisible']!='true'} style="display:none;"{/if}>
                    <div class="col-lg-2">
                        <label for="user[tp]" class="form-control">TP:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[tp]" name="user[tp]" value="{$user['tp']}">
                    </div>
                    <div class="col-lg-2">
                        <label for="user[rk]" class="form-control">Rüstungsklasse:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[rk]" name="user[rk]" value="{$user['rk']}">
                    </div>
                    <div class="col-lg-2">
                        <label for="user[gab]" class="form-control">GAB:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[gab]" name="user[gab]" value="{$user['gab']}">
                    </div>
                    <div class="col-lg-2">
                        <label for="user[init]" class="form-control">Initiativbonus:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[init]" name="user[init]" value="{$user['init']}">
                    </div>
                </div>
                <div class="row{if $activeplayer['id']==$user['id']} has-error{/if}"{if !$isadmin && $user['mapvisible']!='true'} style="display:none;"{/if}>
                    <div class="col-lg-2">
                        <label for="user[initiative]" class="form-control">Initiative:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[initiative]" name="user[initiative]" value="{$user['initiative']}">
                    </div>
                    <div class="col-lg-2">
                        <label for="user[dmgd]" class="form-control">tdl. Schaden:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[dmgd]" name="user[dmgd]" value="{$user['dmgd']}">
                    </div>
                    <div class="col-lg-2">
                        <label for="user[dmgnd]" class="form-control">Schaden:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[dmgnd]" name="user[dmgnd]" value="{$user['dmgnd']}">
                    </div>
                </div>
                <div class="col-lg-3" style="display:none">
                    <input type="submit" class="btn form-control">
                </div>
                {if $user['playable']=='true'}
                    <div class="row{if $activeplayer['id']==$user['id']} has-error{/if}"{if !$isadmin && $user['mapvisible']!='true'} style="display:none;"{/if}>
                        <div class="col-lg-2">
                            <label for="user[w4]" class="form-control">Würfe w4:</label>
                        </div>
                        <div class="col-lg-1">
                            <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w4]" name="user[w4]" value="{$user['w4']}">
                        </div>
                        <div class="col-lg-2">
                            <label for="user[w6]" class="form-control">Würfe w6:</label>
                        </div>
                        <div class="col-lg-1">
                            <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w6]" name="user[w6]" value="{$user['w6']}">
                        </div>
                        <div class="col-lg-2">
                            <label for="user[w8]" class="form-control">Würfe w8:</label>
                        </div>
                        <div class="col-lg-1">
                            <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w8]" name="user[w8]" value="{$user['w8']}">
                        </div>
                        <div class="col-lg-2">
                            <label for="user[w10]" class="form-control">Würfe w10:</label>
                        </div>
                        <div class="col-lg-1">
                            <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w10]" name="user[w10]" value="{$user['w10']}">
                        </div>
                    </div>
                    <div class="row{if $activeplayer['id']==$user['id']} has-error{/if}"{if !$isadmin && $user['mapvisible']!='true'} style="display:none;"{/if}>
                        <div class="col-lg-2">
                            <label for="user[w12]" class="form-control">Würfe w12:</label>
                        </div>
                        <div class="col-lg-1">
                            <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w12]" name="user[w12]" value="{$user['w12']}">
                        </div>
                        <div class="col-lg-2">
                            <label for="user[w20]" class="form-control">Würfe w20:</label>
                        </div>
                        <div class="col-lg-1">
                            <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w20]" name="user[w20]" value="{$user['w20']}">
                        </div>
                        <div class="col-lg-2">
                            <label for="user[w100]" class="form-control">Würfe w100:</label>
                        </div>
                        <div class="col-lg-1">
                            <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[w100]" name="user[w100]" value="{$user['w100']}">
                        </div>
                    {/if}
                </div>
                {if $isadmin}
                    <div class="row"{if !$isadmin && $user['mapvisible']!='true'} style="display:none;"{/if}>
                        <div class="col-lg-3">
                            <input type="button" class="btn btn-warning form-control" value="Kampf-Würfel geben" onclick="setCombat('{$user['id']}')">
                        </div>
                        <div class="col-lg-3">
                            <input type="button" class="btn btn-success form-control" value="Würfel geben" onclick="setTurn('{$user['id']}')">
                        </div>
                        <div class="col-lg-3">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success form-control" data-toggle="dropdown">
                                    Einzelner-Würfel
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" onclick="setSingleDice(4,'{$user['id']}')">W4</a></li>
                                    <li><a href="#" onclick="setSingleDice(6,'{$user['id']}')">W6</a></li>
                                    <li><a href="#" onclick="setSingleDice(8,'{$user['id']}')">W8</a></li>
                                    <li><a href="#" onclick="setSingleDice(10,'{$user['id']}')">W10</a></li>
                                    <li><a href="#" onclick="setSingleDice(12,'{$user['id']}')">W12</a></li>
                                    <li><a href="#" onclick="setSingleDice(20,'{$user['id']}')">W20</a></li>
                                    <li><a href="#" onclick="setSingleDice(100,'{$user['id']}')">W100</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <input type="button" class="btn btn-danger form-control" value="Würfel wegnehmen" onclick="setTurn('')">
                        </div>
                    </div>
                {/if}
            {else}
                <div class="row{if $activeplayer['id']==$user['id']} has-error{/if}"{if !$isadmin && $user['mapvisible']!='true'} style="display:none;"{/if}>
                    <div class="col-lg-2">
                        <label for="user[tp]" class="form-control">TP:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[tp]" name="user[tp]" value="{if $user['playable']=='false'}?{else}{$user['tp']}{/if}">
                    </div>
                    <div class="col-lg-2">
                        <label for="user[dmgd]" class="form-control">tdl. Schaden:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[dmgd]" name="user[dmgd]" value="{if $user['playable']=='false'}?{else}{$user['dmgd']}{/if}">
                    </div>
                    <div class="col-lg-2">
                        <label for="user[dmgnd]" class="form-control">Schaden:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[dmgnd]" name="user[dmgnd]" value="{if $user['playable']=='false'}?{else}{$user['dmgnd']}{/if}">
                    </div>
                    <div class="col-lg-2">
                        <label for="user[initiative]" class="form-control">Initiative:</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="text"{if !$isadmin} disabled="disabled"{/if} class="form-control" id="user[initiative]" name="user[initiative]" value="{$user['initiative']}">
                    </div>
                </div>
            {/if}
        </form>
    <div class="row"{if !$isadmin && $user['mapvisible']!='true'} style="display:none;"{/if}>
        <div class="col-xs-12">
            <hr>
        </div>
    </div>
    {/if}
{/foreach}