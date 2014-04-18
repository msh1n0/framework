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

        if($framework->users->currentUser('userlevel')>60)$framework->template->setTemplateVariables(array('isadmin',true));
        $framework->template->setTemplateVariables(array('gab',$framework->users->currentUser('gab')));
        $framework->template->setTemplateVariables(array('init',$framework->users->currentUser('init')));
        $framework->template->setTemplateVariables(array('rk',$framework->users->currentUser('rk')));
        $framework->template->setTemplateVariables(array('tp',$framework->users->currentUser('tp')));
        $framework->template->setTemplateVariables(array('dmgd',$framework->users->currentUser('dmgd')));
        $framework->template->setTemplateVariables(array('dmgnd',$framework->users->currentUser('dmgnd')));

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
        elseif($_GET['action']=='setdice'){
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
                header('Location:'.$page.'?site=wuerfel');
            }


            $framework->template->setTemplateVariables(array('user',$_GET['user']));
            $framework->template->setTemplateFile('wuerfel_setturn');


        }
        elseif($_GET['action']=='getturn'){
            echo $roundsavegame['user'].'|'.$roundsavegame['w4'].'|'.$roundsavegame['w6'].'|'.$roundsavegame['w8'].'|'.$roundsavegame['w10'].'|'.$roundsavegame['w12'].'|'.$roundsavegame['w20'].'|'.$roundsavegame['w100'];
            exit;
        }


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
                <td>'.$user['username'].'</td>
                <td>'.$user['gab'].'</td>
                <td>'.$user['init'].'</td>
                <td>'.$user['rk'].'</td>
                <td>'.$user['tp'].'</td>
                <td>'.$user['dmgd'].'</td>
                <td>'.$user['dmgnd'].'</td>
                <td>
                     <a href="'.$page.'?site=wuerfel&action=setturn&user='.$user['username'].'"><span class="glyphicon glyphicon-retweet" title="Spieler Würfel geben"></span></a>
                </td>
            </tr>
            ';
        }
        $userOverview.='</table>';
        $framework->template->setTemplateVariables(array('overview',$userOverview));



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