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

switch($_GET['site']){
    case 'login':
        $framework->template->setTemplateFile('login');
        if(!empty($_POST)){
            if($framework->users->logIn($_POST['username'],$_POST['password'])){
                $_SESSION['message']='Du bist jetzt eingeloggt';
            }
            else{
                $_SESSION['warning']='Fehler beim Einloggen. Versuche es nochmal plx :3';
            }
            header('Location:'.$page);
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
                if($_GET['action']=='createuser'){
                    $framework->users->createUser($_POST);
                    header('Location:'.$page.'?site=useradmin');
                }
            }
            if($_GET['action']=='edituser'){
                $framework->template->setTemplateFile('useradmin_edituser');
                $user=$framework->users->getUser($_GET['user']);
                $framework->template->setTemplateVariables(array('playername',$user['username']));
                $framework->template->setTemplateVariables(array('password',$user['password']));
                $framework->template->setTemplateVariables(array('playerlevel',$user['userlevel']));
                $framework->template->setTemplateVariables(array('gab',$user['gab']));
                $framework->template->setTemplateVariables(array('init',$user['init']));
                $framework->template->setTemplateVariables(array('rk',$user['rk']));
                $framework->template->setTemplateVariables(array('tp',$user['tp']));
                $framework->template->setTemplateVariables(array('dmgd',$user['dmgd']));
                $framework->template->setTemplateVariables(array('dmgnd',$user['dmgnd']));
            }
            elseif($_GET['action']=='createuser'){
                $framework->template->setTemplateFile('useradmin_createuser');
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
                <td>'.$user['username'].'</td>
                <td>'.$user['userlevel'].'</td>
                <td>'.$user['gab'].'</td>
                <td>'.$user['init'].'</td>
                <td>'.$user['rk'].'</td>
                <td>'.$user['tp'].'</td>
                <td>'.$user['dmgd'].'</td>
                <td>'.$user['dmgnd'].'</td>
                <td>
                     <a href="'.$page.'?site=useradmin&action=edituser&user='.$user['username'].'"><span class="glyphicon glyphicon-pencil" title="Spieler bearbeiten"></span></a>
                     <a href="'.$page.'?site=useradmin&action=deleteuser&user='.$user['username'].'"><span class="glyphicon glyphicon-remove" title="Spieler löschen"></span></a>
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

}
else{
    $framework->template->setTemplateVariables(array('username',$_SESSION['username']));
    $framework->template->setTemplateVariables(array('player',true));
    $framework->template->setTemplateVariables(array('admin',true));
}
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();