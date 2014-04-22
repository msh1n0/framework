<?php
include 'framework/framework.php';


/*
 * Basis-Definitionen
 * */
$framework = new framework('checkliste');
$framework->template->setTemplate('checkliste');
if(!empty($_SESSION['error'])){
    $framework->template->setTemplateVariables(array('error','<div class="alert alert-danger">'.$_SESSION['error'].'</div>'));
    $framework->template->setTemplateVariables(array('has-error','has-error'));
    unset($_SESSION['error']);
}
if(!empty($_SESSION['message'])){
    $framework->template->setTemplateVariables(array('error','<div class="alert alert-info">'.$_SESSION['message'].'</div>'));
    unset($_SESSION['message']);
}
if($framework->users->isLoggedIn()){
    $framework->template->setTemplateVariables(array('isLoggedIn',true));
    if($framework->users->currentUser('group'))$framework->template->setTemplateVariables(array('isAdmin',true));
}
$page='checkliste.php';
$framework->template->setTemplateVariables(array('page',$page));

$usergroups=new element(true);
$usergroups->setupDatabase('usergroups',$framework->users->getAttributes());
$allUsers=$framework->users->getAllUsers();

/*
 * Basis-Definitionen Ende
 * */



$content='';

switch($_GET['site']){
    case 'checklist':
        $framework->template->setTemplateFile('checklist/index');
        break;
    case 'login':
        $framework->template->setTemplateFile('login');
        if($_POST){
            if($framework->users->logIn($_POST['username'],$_POST['password'])=='1'){
                $_SESSION['message']='Einloggen erfolgreich';
                header('Location:'.$page.'?site=statistics');
                exit;
            }
            $framework->template->setTemplateVariables(array('error','<div class="alert alert-danger">Einloggen fehlgeschlagen</div>'));
            $framework->template->setTemplateVariables(array('has_error','has-error'));
        }
        break;
    case 'logout':
        $framework->users->logOut();
        header('Location:'.$page);
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
    case 'useradmin':
        header('Location:'.$page.'?site=useradmin_summary');
        break;
        break;
    case 'useradmin_summary':
        $framework->template->setTemplateFile('users/summary');
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
            foreach($usergroups->getAllElements() as $group){
                if($group['id']==$user['group']) $user['group']=$group['name'];
            }

            $userOverview.='
            <tr>
                <td class="visible-md visible-lg">'.$user['id'].'</td>
                <td>'.$user['firstname'].'</td>
                <td class="visible-md visible-lg">'.$user['surname'].'</td>
                <td class="visible-md visible-lg">'.$user['email'].'</td>
                <td>'.$user['phone'].'</td>
                <td>'.$user['status'].'</td>
                <td>'.$user['group'].'</td>
                <td>
                    <!--<a href="'.$page.'?site=useradmin_task"><span class="glyphicon glyphicon-tag" title="Aufgabe zuteilen"></span></a>-->
                    <!--<a href="'.$page.'?site=useradmin_userinformaion"><span class="glyphicon glyphicon-list-alt" title="Aufgaben betrachten"></span></a>-->
                    <!--<a href="tel:'.$user['phone'].'"><span class="glyphicon glyphicon-earphone" title="anrufen"></span></a>-->
                    <!--<a href="tel:'.$user['email'].'"><span class="glyphicon glyphicon-comment" title="E-Mail schreiben"></span></a>-->
                    <!--<a href="#"><span class="glyphicon glyphicon-retweet" title="'.$user['firstname'].' soll sich bei mir melden"></span></a>-->
                    <!--<a href="'.$page.'?site=map&search='.$user['id'].'"><span class="glyphicon glyphicon-picture" title="Position auf Karte"></span></a>-->
                    <a href="'.$page.'?site=useradmin_edit&id='.$user['id'].'"><span class="glyphicon glyphicon-pencil" title="User bearbeiten"></span></a>
                    <a href="'.$page.'?site=useradmin_delete&id='.$user['id'].'"><span class="glyphicon glyphicon-remove" title="User entfernen"></span></a>
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
                    <a href="'.$page.'?site=useradmin_create"><span class="glyphicon glyphicon-plus" title="Neuen Nutzer anlegen"></span></a>
                </td>
            </tr></table>';
        $framework->template->setTemplateVariables(array('overview',$userOverview));
        break;
    case 'useradmin_edit':
        if($_POST){
            $framework->template->setTemplateVariables(array('id',$_POST['id']));
            $framework->template->setTemplateVariables(array('password',$_POST['password']));
            $framework->template->setTemplateVariables(array('firstname',$_POST['firstname']));
            $framework->template->setTemplateVariables(array('surname',$_POST['surname']));
            $framework->template->setTemplateVariables(array('email',$_POST['email']));
            $framework->template->setTemplateVariables(array('phone',$_POST['phone']));
            $framework->template->setTemplateVariables(array('group',$_POST['group']));

            $template_groups='';
            foreach($usergroups->getAllElements() as $group){
                $template_groups.='<option class="form-control" value="'.$group['id'].'"';
                if($_POST['group']==$group['id'])$template_groups.=' selected="selected"';
                $template_groups.='>'.$group['name'].'</option>';
            }
            $framework->template->setTemplateVariables(array('groups',$template_groups));
            try{
                $framework->users->editUser(array(
                    'id'=> $_POST['id'],
                    'password'=> $_POST['password'],
                    'firstname'=> $_POST['firstname'],
                    'surname'=> $_POST['surname'],
                    'email'=> $_POST['email'],
                    'phone'=> $_POST['phone'],
                    'group'=> $_POST['group']
                ));
            }
            catch(InputErrorException $e){
                $_SESSION['error']=$e->getMessage();
                header('Location:'.$page.'?site=useradmin_edit');
            }
            $_SESSION['message']='Benutzer wurde erfolgreich bearbeitet';
            header('Location:'.$page.'?site=useradmin_summary');


        }
        else{
            foreach($allUsers as $user){
                if($user['id']==$_GET['id']){
                    $framework->template->setTemplateVariables(array('id',$user['id']));
                    $framework->template->setTemplateVariables(array('password',$user['password']));
                    $framework->template->setTemplateVariables(array('firstname',$user['firstname']));
                    $framework->template->setTemplateVariables(array('surname',$user['surname']));
                    $framework->template->setTemplateVariables(array('email',$user['email']));
                    $framework->template->setTemplateVariables(array('phone',$user['phone']));
                    $framework->template->setTemplateVariables(array('group',$user['group']));

                    $template_groups='';
                    foreach($usergroups->getAllElements() as $group){
                        $template_groups.='<option class="form-control" value="'.$group['id'].'"';
                        if($user['group']==$group['id'])$template_groups.=' selected="selected"';
                        $template_groups.='>'.$group['name'].'</option>';
                    }
                    $framework->template->setTemplateVariables(array('groups',$template_groups));
                }
            }
        }

        $framework->template->setTemplateFile('users/edit');
        break;
    case 'useradmin_create':
        if($_POST){
            $framework->template->setTemplateVariables(array('id',$_POST['id']));
            $framework->template->setTemplateVariables(array('password',$_POST['password']));
            $framework->template->setTemplateVariables(array('firstname',$_POST['firstname']));
            $framework->template->setTemplateVariables(array('surname',$_POST['surname']));
            $framework->template->setTemplateVariables(array('email',$_POST['email']));
            $framework->template->setTemplateVariables(array('phone',$_POST['phone']));
            $framework->template->setTemplateVariables(array('group',$_POST['group']));

            //Login existiert bereits
            if(!$framework->users->getUser($_POST['id'])==''){
                $framework->template->setTemplateVariables(array('error','<div class="alert alert-danger">Benutzer existiert bereits</div>'));
            }
            elseif(empty($_POST['password'])){
                $framework->template->setTemplateVariables(array('error','<div class="alert alert-danger">kein Password eingegeben</div>'));
            }
            else{
                try{
                    $framework->users->createUser(array(
                        'id'=> $_POST['id'],
                        'password'=> $_POST['password'],
                        'firstname'=> $_POST['firstname'],
                        'surname'=> $_POST['surname'],
                        'email'=> $_POST['email'],
                        'phone'=> $_POST['phone'],
                        'group'=> $_POST['group']
                    ));
                }
                catch(InputErrorException $e){
                    $_SESSION['error']=$e->getMessage();
                    header('Location:'.$page.'?site=useradmin_create');
                }
                $_SESSION['message']='Benutzer wurde erfolgreich angelegt';
                header('Location:'.$page.'?site=useradmin_summary');
            }
        }
        $template_groups='';
        foreach($usergroups->getAllElements() as $group){
            $template_groups.='<option class="form-control" value="'.$group['id'].'">'.$group['name'].'</option>';
        }
        $framework->template->setTemplateVariables(array('groups',$template_groups));
        $framework->template->setTemplateFile('users/create');
        break;
    case 'useradmin_delete':
        try{
            $framework->users->deleteUser($_GET['id']);
        }catch(mysqli_sql_exception $e){
            $_SESSION['error']='Datenbankabfrage fehlgeschlagen';
            header('Location:'.$page.'?site=useradmin_summary');
        }
        $_SESSION['message']='Benutzer wurde gelöscht';
        header('Location:'.$page.'?site=useradmin_summary');
        break;
    case 'useradmin_usergroups':
        header('Location:'.$page.'?site=useradmin_usergroups_summary');
        break;
    case 'useradmin_usergroups_summary':
        $overview='<table class="table table-responsive">';
        foreach($usergroups->getAllElements() as $group){
            $overview.='
            <tr>
                <td class="visible-md visible-lg">'.$group['name'].'</td>
                <td>
                    <a href="'.$page.'?site=useradmin_usergroups_edit&id='.$group['id'].'"><span class="glyphicon glyphicon-pencil" title="Gruppe bearbeiten"></span></a>
                    <a href="'.$page.'?site=useradmin_usergroups_delete&id='.$group['id'].'"><span class="glyphicon glyphicon-remove" title="Gruppe entfernen"></span></a>
                </td>
            </tr>
            ';
        }
        $overview.='
            <tr>
                <td></td>
                <td>
                    <a href="'.$page.'?site=useradmin_usergroups_create"><span class="glyphicon glyphicon-plus" title="Neue Gruppe anlegen"></span></a>
                </td>
            </tr></table>';
        $framework->template->setTemplateVariables(array('overview',$overview));
        $framework->template->setTemplateFile('usergroups/summary');
        break;
    case 'useradmin_usergroups_create':
        if($_POST){
            $usergroups->createElement(array('name'=>$_POST['name']));
        }
        $framework->template->setTemplateFile('usergroups/create');
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