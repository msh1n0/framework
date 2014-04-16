<?php
include 'framework/framework.php';

$framework = new framework('pathfinder');
$content='';


$framework->template->setTemplate('pathfinder');


switch($_GET['site']){
    case 'login':
        $framework->template->setTemplateFile('login');
        if(!empty($_POST)){
            $framework->users->logIn($_POST['username'],$_POST['password']);
        }
        break;
    case 'logout':
        $framework->users->logOut();
        header('Location:index.php');
        break;
    case 'useradmin':
        $framework->template->setTemplateFile('useradmin');
        $success=true;
        if(!empty($_POST)){
            try{
                $framework->users->createUser($_POST['username'],$_POST['password'],$_POST['userlevel']);
            }catch (userDupeException $e){
                $framework->template->setTemplateVariables(array('error',$e->getMessage()));
                $success=false;
            }
            if($success===true) $framework->template->setTemplateVariables(array('message','Spieler '.$_POST['username'].' angelegt'));
        }
        else{
            $allUsers=$framework->users->getAllUsers();
            $usertable='<table class="table table-responsive">';
            foreach($allUsers as $user){

                $split=explode(';',$user);
                $usertable.='<tr><td>'.$split[0].'</td><td>'.$split[2].'</td></tr>';
            }
            $usertable.='</table>';
            $framework->template->setTemplateVariables(array('usertable',$usertable));
        }
        break;
    case 'wuerfel':
        $framework->template->setTemplateFile('wuerfel');
        break;
    case 'karte':
        $framework->template->setTemplateFile('karte');
        $map= new map('images/maps/map.jpg');
        $framework->template->setTemplateVariables($map->prepareMap(10,''));
        break;
    default:
        $framework->template->setTemplateFile('index');
        break;
}


$framework->template->setTemplateVariables(array('content',$content));
if(!$framework->users->isLoggedIn()){
    $framework->template->setTemplateVariables(array('welcome','Zum Mitspielen bitte <a href="index.php?site=login">anmelden</a>'));
}
else{
    $framework->template->setTemplateVariables(array('welcome','Du bist eingeloggt. Wähle in der Navigation die gewünschte Seite.'));
    $framework->template->setTemplateVariables(array('username',$_SESSION['username']));
    $framework->template->setTemplateVariables(array('userlevel',$_SESSION['userlevel']));
    $framework->template->setTemplateVariables(array('player',true));
    $framework->template->setTemplateVariables(array('admin',true));
}
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();