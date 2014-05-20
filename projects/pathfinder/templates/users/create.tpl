{extends "projects/pathfinder/templates/index.tpl"}
{block name=content}
    <div class="alert alert-info">
        <h1>Spieler anlegen</h1>
        <form action="{$index}?site=useradmin&action=createuser" method="post">
            <div class="form-group disabled">
                <div class="form-group">
                    <label for="userid">Name:</label>
                    <input type="text" name="user[id]" id="userid" value="{$user['id']}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="userpassword">Password:</label>
                    <input type="password" name="user[password]" id="userpassword" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="userlevel">Userlevel:</label>
                    <select name="user[userlevel]" id="userlevel" class="form-control">
                        <option value="10" {if $user['userlevel']==10}selected="selected"{/if}>Monster</option>
                        <option value="20" {if $user['userlevel']==20}selected="selected"{/if}>Spieler</option>
                        <option value="99" {if $user['userlevel']==99}selected="selected"{/if}>Spielleiter</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gab">Grundangriffsbonus:</label>
                    <input type="text" name="user[gab]" id="gab" value="{$user['gab']}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="init">Initiativ-Bonus:</label>
                    <input type="text" name="user[init]" id="init" value="{$user['init']}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="rk">Rüstungsklasse:</label>
                    <input type="text" name="user[rk]" id="rk" value="{$user['rk']}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tp">Trefferpunkte:</label>
                    <input type="text" name="user[tp]" id="tp" value="{$user['tp']}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="color">Farbe</label>
                    <select id="color" name="user[color]" class="form-control">
                        <option value=""></option>
                        <option value="006" style="background:#006;"{if $user['color']=='006'} selected="selected"{/if}>006</option>
                        <option value="00a" style="background:#00a;"{if $user['color']=='00a'} selected="selected"{/if}>00a</option>
                        <option value="00f" style="background:#00f;"{if $user['color']=='00f'} selected="selected"{/if}>00f</option>
                        <option value="060" style="background:#060;"{if $user['color']=='060'} selected="selected"{/if}>060</option>
                        <option value="066" style="background:#066;"{if $user['color']=='066'} selected="selected"{/if}>066</option>
                        <option value="06f" style="background:#06f;"{if $user['color']=='06f'} selected="selected"{/if}>06f</option>
                        <option value="0a0" style="background:#0a0;"{if $user['color']=='0a0'} selected="selected"{/if}>0a0</option>
                        <option value="0f0" style="background:#0f0;"{if $user['color']=='0f0'} selected="selected"{/if}>0f0</option>
                        <option value="0f6" style="background:#0f6;"{if $user['color']=='0f6'} selected="selected"{/if}>0f6</option>
                        <option value="0fa" style="background:#0fa;"{if $user['color']=='0fa'} selected="selected"{/if}>0fa</option>
                        <option value="0ff" style="background:#0ff;"{if $user['color']=='0ff'} selected="selected"{/if}>0ff</option>
                        <option value="606" style="background:#606;"{if $user['color']=='606'} selected="selected"{/if}>606</option>
                        <option value="60f" style="background:#60f;"{if $user['color']=='60f'} selected="selected"{/if}>60f</option>
                        <option value="660" style="background:#660;"{if $user['color']=='660'} selected="selected"{/if}>660</option>
                        <option value="666" style="background:#666;"{if $user['color']=='666'} selected="selected"{/if}>666</option>
                        <option value="6a0" style="background:#6a0;"{if $user['color']=='6a0'} selected="selected"{/if}>6a0</option>
                        <option value="6f0" style="background:#6f0;"{if $user['color']=='6f0'} selected="selected"{/if}>6f0</option>
                        <option value="a06" style="background:#a06;"{if $user['color']=='a06'} selected="selected"{/if}>a06</option>
                        <option value="a0a" style="background:#a0a;"{if $user['color']=='a0a'} selected="selected"{/if}>a0a</option>
                        <option value="a0f" style="background:#a0f;"{if $user['color']=='a0f'} selected="selected"{/if}>a0f</option>
                        <option value="a60" style="background:#a60;"{if $user['color']=='a60'} selected="selected"{/if}>a60</option>
                        <option value="aa0" style="background:#aa0;"{if $user['color']=='aa0'} selected="selected"{/if}>aa0</option>
                        <option value="aaa" style="background:#aaa;"{if $user['color']=='aaa'} selected="selected"{/if}>aaa</option>
                        <option value="af0" style="background:#af0;"{if $user['color']=='af0'} selected="selected"{/if}>af0</option>
                        <option value="afa" style="background:#afa;"{if $user['color']=='afa'} selected="selected"{/if}>afa</option>
                        <option value="f06" style="background:#f06;"{if $user['color']=='f06'} selected="selected"{/if}>f06</option>
                        <option value="f0a" style="background:#f0a;"{if $user['color']=='f0a'} selected="selected"{/if}>f0a</option>
                        <option value="f0f" style="background:#f0f;"{if $user['color']=='f0f'} selected="selected"{/if}>f0f</option>
                        <option value="f60" style="background:#f60;"{if $user['color']=='f60'} selected="selected"{/if}>f60</option>
                        <option value="fa0" style="background:#fa0;"{if $user['color']=='fa0'} selected="selected"{/if}>fa0</option>
                        <option value="faa" style="background:#faa;"{if $user['color']=='faa'} selected="selected"{/if}>faa</option>
                        <option value="ff0" style="background:#ff0;"{if $user['color']=='ff0'} selected="selected"{/if}>ff0</option>
                        <option value="ffa" style="background:#ffa;"{if $user['color']=='ffa'} selected="selected"{/if}>ffa</option>
                        <option value="fff" style="background:#fff;"{if $user['color']=='fff'} selected="selected"{/if}>fff</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="radio" name="user[playable]" id="playabletrue" value="true"{if $user['playable']=='true'} checked="checked"{/if}>
                    <label for="playabletrue">Spieler</label>
                    <input type="radio" name="user[playable]" id="playablefalse" value="false"{if $user['playable']=='false'} checked="checked"{/if}>
                    <label for="playablefalse">Monster</label>
                </div>
                <div class="form-group">
                    <input type="radio" name="user[hidden]" id="hiddentrue" value="true"{if $user['hidden']=='true'} checked="checked"{/if}>
                    <label for="hiddentrue">verstecken</label>
                    <input type="radio" name="user[hidden]" id="hiddenfalse" value="false"{if $user['hidden']=='false'} checked="checked"{/if}>
                    <label for="hiddenfalse">anzeigen</label>
                </div>
                <div class="form-group">
                    <input type="submit" value="speichern" class="form-control">
                </div>
        </form>
    </div>
{/block}