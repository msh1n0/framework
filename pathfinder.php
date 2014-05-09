<?php
include 'framework/framework.php';
/*
 * TODO: Map auf Divs mit absoluten Positionen umstellen
 * TODO: Wuerfel - phasenblock - Buttons für Phasenwechsel
 * TODO: Wuerfel - Rundenblock - Würfelrechte geben
 * TODO: Wuerfel - Rundenblock - Würfelrechte entziehen
 * TODO: Wuerfel - Eigene Stats anzeigen (nur Spieler)
 * TODO: Karte - Phasenanzeige
 * TODO: Karte - karte fixen
 * TODO: Karte - Spielerposition und Markerfarbe im User speichern
 * TODO: Kartenverwaltung - Funktion wie vorher
 * TODO: Useradmin - Übersicht reduzieren
 * TODO: Useradmin - Batch-anlegen
 * TODO: Useradmin - Create braucht alle Optionen
 * TODO: Useradmin - Create und Edit - Markerfarbe direkt bei Charerstellung
 * TODO: Karte - Farbauswahl auf Rot, Dunkelrot und schwarz eingrenzen
 * TODO: Karte - NPCs mit anderen Markern
 * TODO: Javascript - Timestamp-Funktionen
 * TODO:
 * */


$framework = new framework('pathfinder');
$content='';
$framework->template->setTemplate('pathfinder');

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
}
if(isset($_GET['site'])) $site=$_GET['site'];
else $site='login';

$page='pathfinder.php';


/*
 * Datenobjekte
 * */
$saveGame = new collection(false);
$saveGame->setupFile('data/pathfinder_game.db',array('currentplayer','phase','map'));

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
        case 'pulse':
            $save=$saveGame->getElementByAttribute('id','1');
            echo $save['timestamp'];
            break;
        case 'phase':
            $save=$saveGame->getElementByAttribute('id','1');
            echo $save['currentplayer'].'|'.$save['phase'];
            break;
        case 'turns':
            $framework->users->sort('id');
            $framework->template->setTemplateFile('ajax/turns');
            $framework->template->setTemplateVariables(array('users',$framework->users->getAllElements()));
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
                        header('Location:'.$page.'?site=wuerfel');
                    }
                    else{
                        $framework->users->editUser($_POST['user']);
                        header('Location:'.$page.'?site=useradmin');
                    }
                }
                elseif($_GET['action']=='createuser'){
                    $framework->users->createUser($_POST);
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
            elseif($_GET['action']=='deleteuser'){
                $framework->users->deleteUser($_GET['user']);
                header('Location:'.$page.'?site=useradmin');
            }
        }
        else $framework->template->setTemplateArray('users',$framework->users->getAllUsers());
        break;
    case 'combatadmin':

        break;
    case 'wuerfel':
        $framework->template->setTemplateFile('wuerfel/index');
        break;
    case 'karte':
        $framework->template->setTemplateFile('map/index');

        break;
    case 'mapadmin':
        break;
    default:
        $framework->template->setTemplateFile('index');
        break;
}


$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setTemplateVariables(array('index','pathfinder.php'));

$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();