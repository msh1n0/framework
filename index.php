<?php
include 'framework/framework.php';


/*
 * Basis-Definitionen
 * */
$framework = new framework();
$framework->template->setTemplate('checkliste');
if(!empty($_SESSION['error'])){
    $framework->template->setTemplateVariables(array('error','<div class="alert alert-danger">'.$_SESSION['error']));
    unset($_SESSION['error']);
}
if(!empty($_SESSION['message'])){
    $framework->template->setTemplateVariables(array('error','<div class="alert alert-info">'.$_SESSION['message']));
    unset($_SESSION['message']);
}

if($framework->users->isLoggedIn()){
    $framework->template->setTemplateVariables(array('isLoggedIn',true));
    if($framework->users->currentUser('group'))$framework->template->setTemplateVariables(array('isAdmin',true));
}
/*
 * Basis-Definitionen Ende
 * */

$content='';

switch($_GET['site']){
    case 'checklist':
        $framework->template->setTemplateFile('checklist');
        break;
    case 'login':
        $framework->template->setTemplateFile('login');
        if($_POST){
            if($framework->users->logIn($_POST['username'],$_POST['password'])=='1'){
                $_SESSION['message']='Einloggen erfolgreich';
                header('Location:index.php?site=statistics');
                exit;
            }
            $framework->template->setTemplateVariables(array('has-error','has-error'));
        }
        break;
    case 'logout':
        $framework->users->logOut();
        header('Location:index.php');
        break;
    case 'map':
        $framework->template->setTemplateFile('map');
        $map=new map('testfiles/hallenplan.jpg');
        $framework->template->setTemplateVariables($map->prepareMap('40',''));
        break;
    case 'statistics':
        $framework->template->setTemplateFile('statistics');
        break;
    case 'summary':
        $framework->template->setTemplateFile('summary');
        break;
    case 'useradmin_summary':
        $framework->template->setTemplateFile('useradmin_summary');
        $db_usergroups=new database();
        $db_usergroups->setTable('usergroups');
        $db_usergroups->setAttributes($framework->users->getAttributes());
        $usergroups=$db_usergroups->getAll();
        $allUsers=$framework->users->getAllUsers();
        $userOverview='<table class="table table-responsive">
            <tr>
                <th class="visible-md visible-lg">Login-Name</th>
                <th>Vorname</th>
                <th class="visible-md visible-lg">Nachname</th>
                <th class="visible-md visible-lg">E-Mail</th>
                <th>Telefon</th>
                <th>Status</th>
                <th>Gruppe</th>
                <th></th>
            </tr>';
        foreach($allUsers as $user){
            foreach($usergroups as $group){
                if($group['id']==$user['group'])
                    $user['group']=$group['name'];
            }

            $userOverview.='
            <tr>
                <td class="visible-md visible-lg">'.$user['username'].'</td>
                <td>'.$user['firstname'].'</td>
                <td class="visible-md visible-lg">'.$user['surname'].'</td>
                <td class="visible-md visible-lg">'.$user['email'].'</td>
                <td>'.$user['phone'].'</td>
                <td>'.$user['status'].'</td>
                <td>'.$user['group'].'</td>
                <td>
                    <a href="index.php?site=useradmin_task"><span class="glyphicon glyphicon-tag" title="Aufgabe zuteilen"></span></a>
                    <a href="index.php?site=useradmin_userinformaion"><span class="glyphicon glyphicon-list-alt" title="Aufgaben betrachten"></span></a>
                    <a href="tel:'.$user['phone'].'"><span class="glyphicon glyphicon-earphone" title="anrufen"></span></a>
                    <a href="tel:'.$user['email'].'"><span class="glyphicon glyphicon-comment" title="E-Mail schreiben"></span></a>
                    <a href="#"><span class="glyphicon glyphicon-retweet" title="'.$user['firstname'].' soll sich bei mir melden"></span></a>
                    <a href="index.php?site=map&search='.$user['username'].'"><span class="glyphicon glyphicon-picture" title="Position auf Karte"></span></a>
                    <a href="index.php?site=useradmin_edit&user='.$user['username'].'"><span class="glyphicon glyphicon-pencil" title="User bearbeiten"></span></a>
                    <a href="index.php?site=useradmin_delete&user='.$user['username'].'"><span class="glyphicon glyphicon-remove" title="User entfernen"></span></a>
                </td>
            </tr>
            ';
        }
        $userOverview.='
            <tr>
                <td class="visible-md visible-lg"></td>
                <td></td>
                <td class="visible-md visible-lg"></td>
                <td class="visible-md visible-lg"></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="index.php?site=useradmin_edit"><span class="glyphicon glyphicon-plus" title="Neuen Nutzer anlegen"></span></a>
                </td>
            </tr></table>';
        $framework->template->setTemplateVariables(array('overview',$userOverview));
        break;
    default:
        $framework->template->setTemplateFile('index');
        break;
}







/*
 * Abschluss
 * */
$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();  //BEI PRODUKTIVNUTZUNG ENTFERNEN
$framework->template->display();