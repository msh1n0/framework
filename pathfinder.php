<?php
include 'framework/framework.php';
/*
 * TODO: Map auf Divs mit absoluten Positionen umstellen
 * TODO: Karte - Farbauswahl auf Rot, Dunkelrot und schwarz eingrenzen
 * TODO: Karte - NPCs mit anderen Markern
 * TODO: Karte - Pointer ändern in Pfeile mit Blickrichtungen
 * TODO: Karte - Monster mit speziellen Boss-Pointern
 * TODO: Karte - Karte verdunkeln, was man nicht sehen kann (Idee:Spieler kriegen eine Sichweite, je nach Wahrnehmung/Skill wird sie größer, div mit der Karte als Hintergrund, angepasst an position)
 * TODO: Würfel - Initiative nach würfeln automatisch eintragen
 * TODO: Würfel - Automatikwürfeln
 * TODO: MAPADMIN - width und height in die config schreiben
 * TODO: Useradmin - Password ändern
 * TODO:
 * */


$framework = new framework('pathfinder');
$content='';
$framework->template->setTemplate('pathfinder');
$framework->template->setTemplateVariables(array('index','pathfinder.php'));

if($framework->users->isLoggedIn()){
    $framework->template->setTemplateVariables(array('isLoggedIn',true));
    $currentUser= $framework->users->getUserByAttribute('id',$_SESSION['user_id']);
    $framework->template->setTemplateArray('currentuser',$currentUser);

    if($currentUser['userlevel']>50){
        $framework->template->setTemplateVariables(array('isadmin',true));
        $_SESSION['admin']=true;
    }
    else{
        $framework->template->setTemplateVariables(array('isadmin',false));
        $_SESSION['admin']=false;
    }
    if(isset($_GET['site'])) $site=$_GET['site'];
}else $site='login';


$page='pathfinder.php';


/*
 * Datenobjekte
 * */
$saveGame = new collection(false);
$saveGame->setupFile('data/pathfinder_game.db',array('currentplayer','phase','timestamp','timestamp_phase','timestamp_turns','timestamp_dice','timestamp_map','timestamp_pointers','auto','map','mapcols','mapwidth','mapheight'));
$save=$saveGame->getElementByAttribute('id','1');

$mapDirectory=new files();
$maps=$mapDirectory->DirectoryContents('contents/pathfinder/images/maps');
/*
 * Datenobjekte
 * */

#$saveGame->createElement(array('id'=>'1','currentplayer'=>'Sumomo','phase'=>'frei','timestamp'=>time(),'timestamp_phase'=>time(),'timestamp_turns'=>time(),'timestamp_dice'=>time(),'timestamp_map'=>time()));

/*
 * AJAX
 * */
if(!empty($_GET['site']) && $_GET['site']=='ajax'){
    switch($_GET['action']){
        case 'charinfo':
            $framework->template->setTemplateFile('ajax/charinfo');
            $framework->template->setTemplateVariables(array('users',$framework->users->getElementByAttribute('currentuser',$_SESSION['user_id'])));
            $framework->template->disableCaching();
            $framework->template->display();
            break;
        case 'flushdice':
            $save['w4']='';
            $save['w6']='';
            $save['w8']='';
            $save['w10']='';
            $save['w12']='';
            $save['w20']='';
            $save['w100']='';
            $save['timestamp_dice']=time();
            $saveGame->editElement($save);
            break;
        case 'getcontingent':
            $user=$framework->users->getElementByAttribute('id',$_SESSION['user_id']);
            echo $user['w4'];
            echo '|';
            echo $user['w6'];
            echo '|';
            echo $user['w8'];
            echo '|';
            echo $user['w10'];
            echo '|';
            echo $user['w12'];
            echo '|';
            echo $user['w20'];
            echo '|';
            echo $user['w100'];
            break;
        case 'getdice':
            echo $save['w4'];
            echo '|';
            echo $save['w6'];
            echo '|';
            echo $save['w8'];
            echo '|';
            echo $save['w10'];
            echo '|';
            echo $save['w12'];
            echo '|';
            echo $save['w20'];
            echo '|';
            echo $save['w100'];
            break;
        case 'hideplayer':
            $user=$framework->users->getElementByAttribute('id',$_GET['value']);
            $user['hidden']='true';
            $framework->users->editElement($user);
            $save['timestamp_turns']=time();
            $saveGame->editElement($save);
            header('Location:'.$page.'?site=useradmin');
            break;
        case 'phase':
            $user=$framework->users->getElementByAttribute('id',$save['currentplayer']);
            echo $save['currentplayer'].'|'.$save['phase'].'|'.$user['playable'];
            break;
        case 'pulse':
            echo $save['timestamp'];
            echo '|';
            echo $save['timestamp_phase'];
            echo '|';
            echo $save['timestamp_turns'];
            echo '|';
            echo $save['timestamp_dice'];
            echo '|';
            echo $save['timestamp_map'];
            echo '|';
            echo $save['timestamp_pointers'];
            break;
        case 'setcombat':
            $user=$framework->users->getElementByAttribute('id',$_GET['value']);
            $save['w4']='';
            $save['w6']='';
            $save['w8']='';
            $save['w10']='';
            $save['w12']='';
            $save['w20']='';
            $save['w100']='';
            $user['w4']=$user['cw4'];
            $user['w6']=$user['cw6'];
            $user['w8']=$user['cw8'];
            $user['w10']=$user['cw10'];
            $user['w12']=$user['cw12'];
            $user['w20']=$user['cw20'];
            $user['w100']=$user['cw100'];
            $framework->users->editUser($user);
            $save['currentplayer']=$_GET['value'];
            $save['timestamp']=time();
            $saveGame->editElement($save);
            break;
        case 'setdice':
            if(empty($save[$_GET['dice']])) $save[$_GET['dice']]=$_GET['value'];
            else $save[$_GET['dice']]=$save[$_GET['dice']].', '.$_GET['value'];
            $user=$framework->users->getElementByAttribute('id',$_SESSION['user_id']);
            $user[$_GET['dice']]=$user[$_GET['dice']]-1;
            $framework->users->editElement($user);

            $save['timestamp_dice']=time();
            $save['timestamp_turns']=time();
            $saveGame->editElement($save);
            break;
        case 'setphase':
            $save['phase']=$_GET['value'];
            $save['timestamp_phase']=time();
            $saveGame->editElement($save);
            break;
        case 'setsingledice':
            $user=$framework->users->getElementByAttribute('id',$_GET['user']);
            $save['w4']='';
            $save['w6']='';
            $save['w8']='';
            $save['w10']='';
            $save['w12']='';
            $save['w20']='';
            $save['w100']='';
            $save['timestamp_dice']=time();
            $user['w4']='';
            $user['w6']='';
            $user['w8']='';
            $user['w10']='';
            $user['w12']='';
            $user['w20']='';
            $user['w100']='';
            $user['w'.$_GET['value']]=1;
            $framework->users->editUser($user);
            $save['currentplayer']=$_GET['user'];
            $save['timestamp']=time();
            $saveGame->editElement($save);
            break;
        case 'setturn':
            $save['w4']='';
            $save['w6']='';
            $save['w8']='';
            $save['w10']='';
            $save['w12']='';
            $save['w20']='';
            $save['w100']='';
            $save['timestamp_dice']=time();
            $save['currentplayer']=$_GET['value'];
            $save['timestamp_turns']=time();
            $saveGame->editElement($save);
            break;
        case 'setturn2':
            $user=$framework->users->getElementByAttribute('id',$_GET['value']);
            $save['w4']='';
            $save['w6']='';
            $save['w8']='';
            $save['w10']='';
            $save['w12']='';
            $save['w20']='';
            $save['w100']='';
            $user['w4']='';
            $user['w6']='';
            $user['w8']='';
            $user['w10']='';
            $user['w12']='';
            $user['w20']='';
            $user['w100']='';
            $save['timestamp_dice']=time();
            $save['currentplayer']=$_GET['value'];
            $save['timestamp_turns']=time();
            $saveGame->editElement($save);
            break;
        case 'showplayer':
            $user=$framework->users->getElementByAttribute('id',$_GET['value']);
            $user['hidden']='false';
            $framework->users->editElement($user);
            $save['timestamp_turns']=time();
            $saveGame->editElement($save);
            header('Location:'.$page.'?site=useradmin');
            break;
        case 'startautoinitiative':  //#############################################  TODO
            $save['phase']="Initiativ-Phase";
            foreach($framework->users->getAllUsers() as $user){
                $user['auto']=true;
            }
            $user=$framework->users->getElementByAttribute('auto',true);
            break;
        case 'turns':
            $framework->users->sort('id');
            $framework->template->setTemplateFile('ajax/turns');
            $framework->users->sort('initiative',true);
            $framework->template->setTemplateVariables(array('users',$framework->users->getAllElements()));
            $framework->template->setTemplateVariables(array('activeplayer',$framework->users->getElementByAttribute('id',$save['currentplayer'])));
            $framework->template->disableCaching();
            $framework->template->display();
            break;
        case 'turns2':
            $framework->users->sort('id');
            $framework->template->setTemplateFile('ajax/turns2');
            $framework->users->sort('initiative',true);
            $framework->template->setTemplateVariables(array('users',$framework->users->getAllElements()));
            $framework->template->setTemplateVariables(array('activeplayer',$framework->users->getElementByAttribute('id',$save['currentplayer'])));
            $framework->template->disableCaching();
            $framework->template->display();
            break;
    }
    exit;
}

/*
 * AJAX
 * */


/*
 * Basisdefinitionen für gewöhnlichen Seitenaufruf
 * */
if(!empty($_SESSION['error'])){
    $framework->template->setTemplateVariables(array('error','<div class="alert alert-danger">'.$_SESSION['error'].'</div>'));
    $framework->template->setTemplateVariables(array('has-error','has-error'));
    unset($_SESSION['error']);
}
if(!empty($_SESSION['success'])){
    $framework->template->setTemplateVariables(array('success','<div class="alert alert-success">'.$_SESSION['success'].'</div>'));
    unset($_SESSION['success']);
}
if(!empty($_SESSION['message'])){
    $framework->template->setTemplateVariables(array('error','<div class="alert alert-info">'.$_SESSION['message'].'</div>'));
    unset($_SESSION['message']);
}

/*
 * Basisdefinitionen für gewöhnlichen Seitenaufruf
 * */

switch($site){
    case 'login':
        $framework->template->setTemplateFile('login');
        if(!empty($_POST)){
            if($framework->users->logIn($_POST['id'],$_POST['password'])){
                $_SESSION['success']='Du bist jetzt eingeloggt';
                header('Location:'.$page.'?site=wuerfel');
            }
            else{
                $_SESSION['warning']='Fehler beim Einloggen. Versuche es nochmal plx :3';
                header('Location:'.$page);
            }
        }
        break;
    case 'logout':
        $_SESSION['message']='Du bist jetzt ausgeloggt';
        $framework->users->logOut();
        header('Location:'.$page);
        break;
    case 'useradmin':
        $framework->template->setTemplateFile('users/index');
        $success=true;
        if(!empty($_GET['action'])){
            if($_POST){
                if($_GET['action']=='edituser'){
                    if(isset($_GET['from']) && $_GET['from']=='wuerfel'){
                        $framework->users->editUser($_POST['user']);
                        $save['timestamp']=time();
                        $saveGame->editElement($save);
                        header('Location:'.$page.'?site=wuerfel#'.$_POST['user']['id']);
                    }
                    else{
                        $framework->users->editUser($_POST['user']);
                        $save['timestamp']=time();
                        $saveGame->editElement($save);
                        header('Location:'.$page.'?site=useradmin');
                    }
                }
                elseif($_GET['action']=='createuser'){
                    $framework->users->createUser($_POST['user']);
                    $save['timestamp']=time();
                    $saveGame->editElement($save);
                    header('Location:'.$page.'?site=useradmin');
                }
                elseif($_GET['action']=='batchcreateuser'){
                    $newuser=$_POST['user'];
                    for($i=1;$i<=$_POST['count'];$i++){
                        $newuser['id']=$_POST['user']['id'].$i;
                        $framework->users->createUser($newuser);
                    }
                    $save['timestamp']=time();
                    $saveGame->editElement($save);
                    header('Location:'.$page.'?site=useradmin');
                }
            }
            elseif($_GET['action']=='edituser'){
                $framework->template->setTemplateFile('users/edit');
                $framework->template->setTemplateArray('user',$framework->users->getElementByAttribute('id',$_GET['id']));
            }
            elseif($_GET['action']=='createuser'){
                $framework->template->setTemplateFile('users/create');
            }
            elseif($_GET['action']=='batchcreateuser'){
                $framework->template->setTemplateFile('users/batchcreate');
            }
            elseif($_GET['action']=='deleteuser'){
                $framework->users->deleteUser($_GET['user']);
                $save['timestamp']=time();
                $saveGame->editElement($save);
                header('Location:'.$page.'?site=useradmin');
            }
        }
        else $framework->template->setTemplateArray('users',$framework->users->getAllUsers());
        break;
    case 'wuerfel':
        $framework->template->setTemplateFile('wuerfel/index');
        break;
    case 'karte':
        $framework->template->setTemplateFile('map/index');
        break;
    case 'mapadmin':
        if(!empty($_GET['action'])){
            if($_GET['action']=='activatemap'){
                if($_GET['confirm']=="true"){
                    $save['map']=$_GET['mapname'];
                    $save['mapcols']=$_POST['cols'];
                    $save['timestamp_map']=time();
                    $saveGame->editElement($save);
                    header('Location:'.$page.'?site=mapadmin');
                }else{
                    $framework->template->setTemplateVariables(array('map',$_GET['map']));
                    $framework->template->setTemplateFile('map/activate');
                }
            }elseif($_GET['action']=='uploadfile'){
                if($_GET['confirm']==true){
                    $uploaddir = 'contents/pathfinder/images/maps/';
                    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
                    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                        $_SESSION['message']='Datei-Upload erfolgreich';
                    } else {
                        $_SESSION['error']='Datei-Upload fehlgeschlagen';
                    }
                    header('Location:'.$page.'?site=mapadmin');
                }
                else{
                    $framework->template->setTemplateFile('map/upload');
                }
            }elseif($_GET['action']=='deletefile'){
                unlink('contents/pathfinder/images/maps/'.$_GET['map']);
                header('Location:'.$page.'?site=mapadmin');
            }
        }
        else{
            $mapDirectory=new files();
            $framework->template->setTemplateArray('maps',$mapDirectory->DirectoryContents('contents/pathfinder/images/maps'));
            $framework->template->setTemplateVariables(array('activemap',$save['map']));
            $framework->template->setTemplateFile('map/admin');
        }
        break;
    default:
        $framework->template->setTemplateFile('index');
        break;
}


$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();


/*

        case 'activatemap':
            if($_GET['confirm']==true){
                $mapSave['mapname']=$_GET['mapname'];
                $mapSave['cols']=$_POST['cols'];
                $mapSave['rows']=$_POST['rows'];
                $mapSaveFile->writeDB(serialize($mapSave));
                header('Location:'.$page.'?site=mapadmin');
            }
            else{
                $framework->template->setTemplateVariables(array('mapname',$_GET['mapname']));
                $framework->template->setTemplateFile('mapadmin_activate');
            }
            break;
        case 'deletefile':
            unlink('content/pathfinder/images/maps/'.$_GET['value']);
            $save['timestamp_map']=time();
            $saveGame->editElement($save);
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


 */