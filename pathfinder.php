<?php
include 'framework/framework.php';

/*
 * Basis
 * */
$framework = new framework('pathfinder');
$content='';
$framework->template->setTemplate('pathfinder');
if(!empty($_SESSION['message'])){
    $message=$_SESSION['message'];
    $framework->template->setTemplateVariables(array('message',$message));
    $_SESSION['message']='';
}
if(!empty($_SESSION['warning'])){
    $message=$_SESSION['warning'];
    $framework->template->setTemplateVariables(array('warning',$message));
    $_SESSION['warning']='';
}
$page='pathfinder.php';
/*
 * Basis
 * */
/*
 * Objekte für mehrere Seiten
 * */

if($framework->users->currentUser('userlevel')>60){
    $framework->template->setTemplateVariables(array('isadmin',true));
    $isadmin=true;
}
else $isadmin=false;
$mapSaveFile= new element(false);
$mapSaveFile->setupFile('data/pathfinder_map.db',array('mapname','cols','rows'));
$mapSave=$mapSaveFile->getAllElements();
$mapDirectory=new files();
$maps=$mapDirectory->DirectoryContents('content/pathfinder/images/maps');
/*
 * Objekte für mehrere Seiten
 * */

switch($_GET['site']){
    case 'login':
        $framework->template->setTemplateFile('login');
        if(!empty($_POST)){
            if($framework->users->logIn($_POST['id'],$_POST['password'])){
                $_SESSION['message']='Du bist jetzt eingeloggt';
            }
            else{
                $_SESSION['warning']='Fehler beim Einloggen. Versuche es nochmal plx :3';
            }
            #header('Location:'.$page);
        }
        break;
    case 'logout':
        $_SESSION['message']='Du bist jetzt ausgeloggt';
        $framework->users->logOut();
        header('Location:'.$page);
        break;
    case 'useradmin':
        $framework->template->setTemplateFile('useradmin');
        $success=true;
        if(!empty($_GET['action'])){
            if($_POST){
                if($_GET['action']=='edituser'){
                    $framework->users->editUser($_POST);
                    header('Location:'.$page.'?site=useradmin');

                }
                elseif($_GET['action']=='createuser'){
                    $framework->users->createUser($_POST);
                    header('Location:'.$page.'?site=useradmin');
                }
            }
            elseif($_GET['action']=='edituser'){
                $framework->template->setTemplateFile('useradmin_edituser');
                $user=$framework->users->getElementByAttribute('id',$_GET['id']);
                $framework->template->setTemplateVariables(array('playerid',$user['id']));
                $framework->template->setTemplateVariables(array('password',$user['password']));
                $framework->template->setTemplateVariables(array('playerlevel',$user['userlevel']));
                $framework->template->setTemplateVariables(array('gab',$user['gab']));
                $framework->template->setTemplateVariables(array('init',$user['init']));
                $framework->template->setTemplateVariables(array('rk',$user['rk']));
                $framework->template->setTemplateVariables(array('tp',$user['tp']));
                $framework->template->setTemplateVariables(array('dmgd',$user['dmgd']));
                $framework->template->setTemplateVariables(array('dmgnd',$user['dmgnd']));
                $framework->template->setTemplateVariables(array('w4',$user['w4']));
                $framework->template->setTemplateVariables(array('w6',$user['w6']));
                $framework->template->setTemplateVariables(array('w8',$user['w8']));
                $framework->template->setTemplateVariables(array('w10',$user['w10']));
                $framework->template->setTemplateVariables(array('w12',$user['w12']));
                $framework->template->setTemplateVariables(array('w20',$user['w20']));
                $framework->template->setTemplateVariables(array('w100',$user['w100']));
            }
            elseif($_GET['action']=='createuser'){
                $framework->template->setTemplateFile('useradmin_createuser');
            }
            elseif($_GET['action']=='deleteuser'){
                $framework->users->deleteUser($_GET['user']);
                header('Location:'.$page.'?site=useradmin');
            }
        }
        else{
            $allUsers=$framework->users->getAllUsers();
            $userOverview='<table class="table table-responsive">
            <tr>
                <th>Name</th>
                <th>Userlevel</th>
                <th>Grundangriffsbonus</th>
                <th>Initiativ-Bonus</th>
                <th>Rüstungsklasse</th>
                <th>TP</th>
                <th>Schaden tödlich</th>
                <th>Schaden nicht-tödlich</th>
                <th></th>
            </tr>';
            foreach($allUsers as $user){
                $userOverview.='
            <tr>
                <td>'.$user['id'].'</td>
                <td>'.$user['userlevel'].'</td>
                <td>'.$user['gab'].'</td>
                <td>'.$user['init'].'</td>
                <td>'.$user['rk'].'</td>
                <td>'.$user['tp'].'</td>
                <td>'.$user['dmgd'].'</td>
                <td>'.$user['dmgnd'].'</td>
                <td>
                     <a href="'.$page.'?site=useradmin&action=edituser&id='.$user['id'].'"><span class="glyphicon glyphicon-pencil" title="Spieler bearbeiten"></span></a>
                     <a href="'.$page.'?site=useradmin&action=deleteuser&user='.$user['id'].'"><span class="glyphicon glyphicon-remove" title="Spieler löschen"></span></a>
                </td>
            </tr>
            ';
            }
            $userOverview.='
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="'.$page.'?site=useradmin&action=createuser"><span class="glyphicon glyphicon-plus" title="Neuen Nutzer anlegen"></span></a>
                </td>
            </tr></table>';
            $framework->template->setTemplateVariables(array('overview',$userOverview));
        }
        break;
    case 'combatadmin':
        $framework->template->setTemplateFile('combatadmin');
        $combat=new document();
        $combat->setDocument('data/pathfinder_combat.db');
        $combatusers=unserialize($combat->getFileAsString());
        $success=true;
        if(!empty($_GET['action'])){
            if($_POST){
                if($_GET['action']=='edituser'){
                    $newcombat=array();
                    foreach($combatusers as $user){
                        if($user['playername']==$_POST['playername']){
                            $user['initiative']=$_POST['initiative'];
                            $user['active']=$_POST['active'];
                        }
                        $newcombat[]=$user;
                    }
                    $combat->writeDB(serialize($newcombat));
                    header('Location:'.$page.'?site=wuerfel');
                }
                if($_GET['action']=='createuser'){
                    $user=array();
                    $user['playername']=$_POST['playername'];
                    $user['initiative']=$_POST['initiative'];
                    $user['active']=$_POST['active'];
                    $combatusers[]=$user;
                    $combat->writeDB(serialize($combatusers));
                    header('Location:'.$page.'?site=wuerfel');
                }
            }
            if($_GET['action']=='edituser'){
                $framework->template->setTemplateFile('combatadmin_edituser');
                foreach($combatusers as $user){
                    if($user['playername']==$_GET['user']){
                        $framework->template->setTemplateVariables(array('active',$user['active']));
                        $framework->template->setTemplateVariables(array('playername',$user['playername']));
                        $framework->template->setTemplateVariables(array('initiative',$user['initiative']));
                    }
                }
            }
            elseif($_GET['action']=='createuser'){
                $framework->template->setTemplateFile('combatadmin_createuser');
            }
            elseif($_GET['action']=='deleteuser'){
                $newcombat=array();
                foreach($combatusers as $user){
                    if($user['playername']==$_GET['user']){}
                    else $newcombat[]=$user;
                }
                $combat->writeDB(serialize($newcombat));
                header('Location:'.$page.'?site=wuerfel');
            }
        }
        break;
    case 'wuerfel':
        $framework->template->setTemplateFile('wuerfel');


        $framework->template->setTemplateVariables(array('gab',$framework->users->currentUser('gab')));
        $framework->template->setTemplateVariables(array('init',$framework->users->currentUser('init')));
        $framework->template->setTemplateVariables(array('rk',$framework->users->currentUser('rk')));
        $framework->template->setTemplateVariables(array('tp',$framework->users->currentUser('tp')));
        $framework->template->setTemplateVariables(array('dmgd',$framework->users->currentUser('dmgd')));
        $framework->template->setTemplateVariables(array('dmgnd',$framework->users->currentUser('dmgnd')));

        $combat=new document();
        $combat->setDocument('data/pathfinder_combat.db');
        $combatusers=unserialize($combat->getFileAsString());

        $round= new document();
        $round->setDocument('data/pathfinder_runde.db');
        $roundsavegame=unserialize($round->getFileAsString());
        if(empty($roundsavegame['w4']))$roundsavegame['w4']='0';
        if(empty($roundsavegame['w6']))$roundsavegame['w6']='0';
        if(empty($roundsavegame['w8']))$roundsavegame['w8']='0';
        if(empty($roundsavegame['w10']))$roundsavegame['w10']='0';
        if(empty($roundsavegame['w12']))$roundsavegame['w12']='0';
        if(empty($roundsavegame['w20']))$roundsavegame['w20']='0';
        if(empty($roundsavegame['w100']))$roundsavegame['w100']='0';
        $framework->template->setTemplateVariables(array('w4',$roundsavegame['w4']));
        $framework->template->setTemplateVariables(array('w6',$roundsavegame['w6']));
        $framework->template->setTemplateVariables(array('w8',$roundsavegame['w8']));
        $framework->template->setTemplateVariables(array('w10',$roundsavegame['w10']));
        $framework->template->setTemplateVariables(array('w12',$roundsavegame['w12']));
        $framework->template->setTemplateVariables(array('w20',$roundsavegame['w20']));
        $framework->template->setTemplateVariables(array('w100',$roundsavegame['w100']));
        $framework->template->setTemplateVariables(array('currentplayer',$roundsavegame['user']));

        if($_GET['action']=='getdice'){
            $savegame=new document();
            $savegame->setDocument('data/pathfinder_wuerfel.db');
            $db=unserialize($savegame->getFileAsString());
            echo $db['w4'].'|'.$db['w6'].'|'.$db['w8'].'|'.$db['w10'].'|'.$db['w12'].'|'.$db['w20'].'|'.$db['w100'];
            exit;
        }
        if($_GET['action']=='setdice'){
            $savegame=new document();
            $savegame->setDocument('data/pathfinder_wuerfel.db');
            $db=unserialize($savegame->getFileAsString());
            $db['w'.$_GET['slot']]=$_GET['value'];
            $savegame->writeDB(serialize($db));
            $roundsavegame['w'.$_GET['slot']]--;
            $round->writeDB(serialize($roundsavegame));
            exit;
        }
        elseif($_GET['action']=='flushdice'){
            $savegame=new document();
            $savegame->setDocument('data/pathfinder_wuerfel.db');
            $savegame->writeDB('');
            exit;
        }
        elseif($_GET['action']=='setturn'){
            if($_GET['confirm']=='true'){
                $savegame=new document();
                $savegame->setDocument('data/pathfinder_runde.db');
                $roundsavegame['user']=$_GET['user'];
                $roundsavegame['w4']=$_POST['w4'];
                $roundsavegame['w6']=$_POST['w6'];
                $roundsavegame['w8']=$_POST['w8'];
                $roundsavegame['w10']=$_POST['w10'];
                $roundsavegame['w12']=$_POST['w12'];
                $roundsavegame['w20']=$_POST['w20'];
                $roundsavegame['w100']=$_POST['w100'];
                $savegame->writeDB(serialize($roundsavegame));
                $savegame=new document();
                $savegame->setDocument('data/pathfinder_wuerfel.db');
                $savegame->writeDB('');
                if($_GET['js']=='true')exit;
                else header('Location:'.$page.'?site=wuerfel');
            }


            $framework->template->setTemplateVariables(array('user',$_GET['user']));
            $framework->template->setTemplateFile('wuerfel_setturn');


        }
        elseif($_GET['action']=='getturn'){
            echo $roundsavegame['user'].'|'.$roundsavegame['w4'].'|'.$roundsavegame['w6'].'|'.$roundsavegame['w8'].'|'.$roundsavegame['w10'].'|'.$roundsavegame['w12'].'|'.$roundsavegame['w20'].'|'.$roundsavegame['w100'].'|'.$roundsavegame['phase'];
            exit;
        }
        elseif($_GET['action']=='setphase'){
            $savegame=new document();
            $savegame->setDocument('data/pathfinder_runde.db');
            $roundsavegame=unserialize($savegame->getFileAsString());
            $roundsavegame['phase']=$_GET['phase'];
            $savegame->writeDB(serialize($roundsavegame));
            exit;
        }


        $combatoverview='<table class="table table-responsive">
            <tr>
                <th>Aktiv</th>
                <th>Name</th>
                <th>Initiative</th>
                <th></th>
            </tr>';
        $temparray=array();
        foreach($combatusers as $user){
            if($user['active']=='on')$temp=' checked="checked"';
            else $temp='';
            if(!$isadmin===true){
                $disableCheckbox=' disabled="disabled"';
            }
            else{
                $buttons='
                     <a href="'.$page.'?site=combatadmin&action=edituser&user='.$user['playername'].'"><span class="glyphicon glyphicon-pencil" title="Spieler bearbeiten"></span></a>
                     <a href="'.$page.'?site=combatadmin&action=deleteuser&user='.$user['playername'].'"><span class="glyphicon glyphicon-remove" title="Spieler löschen"></span></a>';
            }

            $temparray[]='<!-- '.$user['initiative'].' -->
            <tr>
                <td><input type="checkbox"'.$temp.' onclick="setTurn(\''.$user['playername'].'\')"'.$disableCheckbox.' id="status-'.$user['playername'].'"></span></td>
                <td>'.$user['playername'].'</td>
                <td>'.$user['initiative'].'</td>
                <td>'.$buttons.'
                </td>
            </tr>
            ';
        }
        sort($temparray);
        foreach ($temparray as $element){
            $combatoverview.=$element;
        }
        if($isadmin===true){
        $combatoverview.='
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="'.$page.'?site=combatadmin&action=createuser"><span class="glyphicon glyphicon-plus" title="Neuen Nutzer anlegen"></span></a>
                </td>
            </tr>';
        }
        $combatoverview.='</table>';
        $framework->template->setTemplateVariables(array('combatoverview',$combatoverview));





        $allUsers=$framework->users->getAllUsers();
        $userOverview='<table class="table table-responsive">
            <tr>
                <th>Name</th>
                <th>GAB</th>
                <th>Init-Bonus</th>
                <th>Rüstungsklasse</th>
                <th>TP</th>
                <th>Schaden tödlich</th>
                <th>Schaden nicht-tödlich</th>
                <th></th>
            </tr>';
        foreach($allUsers as $user){
            $userOverview.='
            <tr>
                <td>'.$user['id'].'</td>
                <td>'.$user['gab'].'</td>
                <td>'.$user['init'].'</td>
                <td>'.$user['rk'].'</td>
                <td>'.$user['tp'].'</td>
                <td>'.$user['dmgd'].'</td>
                <td>'.$user['dmgnd'].'</td>
                <td>
                     <a href="'.$page.'?site=useradmin&action=edituser&user='.$user['id'].'"><span class="glyphicon glyphicon-pencil" title="Spieler bearbeiten"></span></a>&nbsp;&nbsp;&nbsp;
                     <a href="'.$page.'?site=wuerfel&action=setturn&user='.$user['id'].'"><span class="glyphicon glyphicon-share-alt" title="Spieler Würfel geben"></span></a>
                </td>
            </tr>
            ';
        }
        $userOverview.='</table>
            <div class="row">
                <div class="col-xs-4">
                    <input type="button" class="form-control" onclick="setphase(\'Initiativ-Phase\')" value="Initiativ-Phase">
                </div>
                <div class="col-xs-4">
                    <input type="button" class="form-control" onclick="setphase(\'Kampf-Phase\')" value="Kampf-Phase">
                </div>
                <div class="col-xs-4">
                    <input type="button" class="form-control" onclick="setphase(\'Frei\')" value="Frei">
                </div>
            </div>

            ';
        $framework->template->setTemplateVariables(array('overview',$userOverview));
        $framework->template->setTemplateVariables(array('activeplayer',$framework->users->currentUser('id')));



        break;
    case 'karte':
        $combat=new document();
        $combat->setDocument('data/pathfinder_combat.db');
        $combatusers=unserialize($combat->getFileAsString());
        $mappointersave=new document();
        $mappointersave->setDocument('data/pathfinder_mappointers.db');
        $mapPointers=unserialize($mappointersave->getFileAsString());
        if(empty($mapPointers))$mapPointers= array();
        $framework->template->setTemplateVariables(array('activeplayer',$framework->users->currentUser('id')));

        $combatoverview='<table class="table table-responsive">
            <tr>
                <th>Aktiv</th>
                <th>Name</th>
                <th>Initiative</th>
                <th></th>
            </tr>';
        $temparray=array();
        foreach($combatusers as $user){
            if($user['active']=='on')$temp=' checked="checked"';
            else $temp='';
            if(!$isadmin===true){
                $disableCheckbox=' disabled="disabled"';
            }
            else{
                $buttons='
                     <a href="'.$page.'?site=combatadmin&action=edituser&user='.$user['playername'].'"><span class="glyphicon glyphicon-pencil" title="Spieler bearbeiten"></span></a>
                     <a href="'.$page.'?site=combatadmin&action=deleteuser&user='.$user['playername'].'"><span class="glyphicon glyphicon-remove" title="Spieler löschen"></span></a>';
            }

            $temparray[]='<!-- '.$user['initiative'].' -->
            <tr>
                <td><input type="checkbox"'.$temp.' onclick="setTurn(\''.$user['playername'].'\')"'.$disableCheckbox.' id="status-'.$user['playername'].'"></span></td>
                <td>'.$user['playername'].'</td>
                <td>'.$user['initiative'].'</td>
                <td>'.$buttons.'
                </td>
            </tr>
            ';
        }
        sort($temparray);
        foreach ($temparray as $element){
            $combatoverview.=$element;
        }
        if($isadmin===true){
            $combatoverview.='
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="'.$page.'?site=combatadmin&action=createuser"><span class="glyphicon glyphicon-plus" title="Neuen Nutzer anlegen"></span></a>
                </td>
            </tr>';
        }
        $combatoverview.='</table>';
        $framework->template->setTemplateVariables(array('combatoverview',$combatoverview));



        if($_GET['action']=='getpointers'){
            $mapcss='';
            foreach($mapPointers as $pointer){
                $mapcss.='<style>
                #cell_'.$pointer['col'].'_'.$pointer['row'].'{background:url(templates/system/_resources/images/map/marker_'.$pointer['color'].'.png) center center no-repeat;background-size:contain;}
                #cell_'.$pointer['col'].'_'.$pointer['row'].' div:after{content:\''.$pointer['name'].'\';}
                #cell_'.$pointer['col'].'_'.$pointer['row'].':hover div{display:block;}
                </style>
                ';
            }
            echo $mapcss;
            exit;
        }
        if($_GET['action']=='flushpointers'){
                $mappointersave->writeDB('');
            exit;
        }
        elseif($_GET['action']=='setpointer'){
            $newpointers=array();
            foreach($mapPointers as $pointer){
                if($pointer['name']!=='Ziel'){
                    $newpointers[]=$pointer;
                }
            }
            $mapPointers=$newpointers;
            $duplicate=false;
            $newpointers=array();
            foreach($mapPointers as $pointer){
                if($pointer['name']==$_GET['name']){
                    if($_GET['color'])$color=$_GET['color'];
                    else $color= $pointer['color'];
                    $newpointers[]=array('name'=>$_GET['name'],'col'=>$_GET['col'],'row'=>$_GET['row'],'color'=>$color);
                    $duplicate=true;
                }
                else $newpointers[]=$pointer;
            }
            if($duplicate===true){
                $mapPointers=$newpointers;
                $mappointersave->writeDB(serialize($mapPointers));
            }
            else{
                $newpointer= array('name'=>$_GET['name'],'col'=>$_GET['col'],'row'=>$_GET['row'],'color'=>$_GET['color']);
                $mapPointers[]=$newpointer;
                $mappointersave->writeDB(serialize($mapPointers));
            }
            exit;
        }
        elseif($_GET['action']=='deletepointer'){
            $duplicate=false;
            $newpointers=array();
            foreach($mapPointers as $pointer){
                if($pointer['name']!==$_GET['name']){
                    $newpointers[]=$pointer;
                }
            }
            $mappointersave->writeDB(serialize($newpointers));
            exit;
        }
        else{
            $framework->template->setTemplateFile('karte');
            if(is_file('content/pathfinder/images/maps/'.$mapSave['mapname'])){
                $map= new map('content/pathfinder/images/maps/'.$mapSave['mapname']);
                $framework->template->setTemplateVariables($map->prepareMap($mapSave['cols'],$mapSave['rows']));
            }
            else{
                $framework->template->setTemplateVariables(array('error','Aktuell ist keine Karte aktiv'));
            }
        }
        $markerDirectory= new files();
        $allmarkers=$markerDirectory->DirectoryContents('templates/system/_resources/images/map');
        $markers='<select id="color" name="color" class="form-control"><option value="">Farbe beibehalten</option>';
        foreach($allmarkers as $element){
            $plit=explode('_',$element);
            $markers.='<option value="'.substr($plit[1],0,3).'" style="background:#'.substr($plit[1],0,3).';">'.substr($plit[1],0,3).'</option>';
        }
        $markers.='</select>';
        $framework->template->setTemplateVariables(array('markers',$markers));

        $players='<select id="name" name="name" class="form-control">';
        foreach($combatusers as $player){
            $players.='<option value="'.$player['playername'].'">'.$player['playername'].'</option>';
        }
        $players.='</select>';
        $framework->template->setTemplateVariables(array('players',$players));
        break;
    case 'mapadmin':


        $framework->template->setTemplateFile('mapadmin');
        $mapoverview='<table class="table table-responsive">';
        foreach($maps as $element){
            if($mapSave['mapname']==$element)$active='AKTIV';
            else $active=false;
            $mapoverview.='<tr>
            <td>'.$active.'</td>
            <td>'.$element.'</td>
            <td>
                <a href="'.$page.'?site=mapadmin&action=activatemap&mapname='.$element.'" title="Karte aktivieren"><span class="glyphicon glyphicon-asterisk"></span></a>
                &nbsp;&nbsp;
                <a href="'.$page.'?site=mapadmin&action=deletefile&mapname='.$element.'" title="Datei löschen"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
            </tr>';
        }
        $mapoverview.='<tr>
            <td></td>
            <td></td>
            <td>
                <a href="'.$page.'?site=mapadmin&action=uploadmap" title="Karte aktivieren"><span class="glyphicon glyphicon-plus"></span></a>
            </td>
            </tr></table>';
        $framework->template->setTemplateVariables(array('mapoverview',$mapoverview));


        switch($_GET['action']){
            case 'activatemap':
                if($_GET['confirm']==true){
                    $mapSave['mapname']=$_GET['mapname'];
                    $mapSave['cols']=$_POST['cols'];
                    $mapSave['rows']=$_POST['rows'];
                    $mapSaveFile->deleteElements();
                    $mapSaveFile->createElement($mapSave);
                    header('Location:'.$page.'?site=mapadmin');
                }
                else{
                    $framework->template->setTemplateVariables(array('mapname',$_GET['mapname']));
                    $framework->template->setTemplateFile('mapadmin_activate');
                }
                break;
            case 'deletefile':
                unlink('content/pathfinder/images/maps/'.$_GET['mapname']);
                header('Location:'.$page.'?site=mapadmin');
                break;
            case 'uploadmap':
                if($_GET['confirm']==true){
                    $uploaddir = 'content/pathfinder/images/maps/';
                    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
                    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                        $_SESSION['message']='Datei-Upload erfolgreich';
                    } else {
                        $_SESSION['error']='Datei-Upload fehlgeschlagen';
                    }
                    header('Location:'.$page.'?site=mapadmin');
                }
                else{
                    $framework->template->setTemplateFile('mapadmin_upload');
                }
                break;
        }

        break;
    default:
        $framework->template->setTemplateFile('index');
        break;
}


$framework->template->setTemplateVariables(array('content',$content));
if(!$framework->users->isLoggedIn()){

}
else{
    $framework->template->setTemplateVariables(array('id',$_SESSION['id']));
    $framework->template->setTemplateVariables(array('player',true));
    $framework->template->setTemplateVariables(array('admin',true));
}
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();