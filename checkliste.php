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
$usergroups->setupDatabase('usergroups',array('id','name'));
$framework->users->sort();
$allUsers=$framework->users->getAllUsers();

$tasks = new element(true);
$tasks->setupDatabase('tasks',array('id','headline','task','place','map_pointer','suitable_groups','finished_by','deadline','time_finished'));

$task_Users = new element(true);
$task_Users->setupDatabase('tasks_users',array('id','taskid','userid'));


/*
 * Basis-Definitionen Ende
 * */



$content='';

switch($_GET['site']){
    case 'login':
        $framework->template->setTemplateFile('login');
        if($_POST){
            if($framework->users->logIn($_POST['id'],$_POST['password'])=='1'){
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
    case 'tasks':
        header('Location:'.$page.'?site=tasks_summary');
        break;
    case 'tasks_create':
        $suitable_groups='';
        foreach($usergroups->getAllElements() as $group){
            $checked='';
            if($_POST['suitable_groups']){
                foreach($_POST['suitable_groups'] as $element){
                    if($element==$group['id']) $checked=' checked="checked"';
                }
            }
            $suitable_groups.='
            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="suitable_groups[]" value="'.$group['id'].'"'.$checked.'>
                    '.$group['name'].'
                </label>
            </div>
            ';
        }

        if($_POST){
            $suitable_groups_new='';
            $first=true;
            foreach($_POST['suitable_groups'] as $element){
                if($first===false)$suitable_groups_new.=$element;
                else $suitable_groups_new.=','.$element;
            }
            $newtask=array(
                'headline'=>$_POST['headline'],
                'task'=>$_POST['task'],
                'place'=>$_POST['place'],
                'suitable_groups'=>$suitable_groups_new,
                'deadline'=>$_POST['deadline']
            );
            $tasks->createElement($newtask);
            header('Location:'.$page.'?site=tasks_summary');
        }

        foreach($suitable_groups as $lement){
        }

        $framework->template->setTemplateVariables(array('suitable_groups',$suitable_groups));
        $framework->template->setTemplateFile('tasks/create');
        break;
    case 'tasks_summary':
        $framework->template->setTemplateFile('tasks/summary');
        $overview='<table cellpadding="0" cellspacing="0" class="table table-responsive"><tr>
                <td>Aufgabe</td>
                <td>Erstellt</td>
                <td>Deadline</td>
                <td></td>
            </tr>';
        foreach($tasks->getAllElements() as $task){
            $overview.='
            <tr>
            <td>'.$task['headline'].'</td>
            <td>'.$task['time_created'].'</td>
            <td>'.$task['deadline'].'</td>
            <td>
                <a href="'.$page.'?site=tasks_details&id='.$task['id'].'"><span class="glyphicon glyphicon-list" title="Details anzeigen"></span></a>
                <a href="'.$page.'?site=tasks_give_user&id='.$task['id'].'"><span class="glyphicon glyphicon-send" title="Aufgabe zuteilen"></span></a>
                <a href="'.$page.'?site=tasks&id='.$task['id'].'"><span class="glyphicon glyphicon-ok" title="Aufgabe annehmen"></span></a>
                <a href="'.$page.'?site=tasks&id='.$task['id'].'"><span class="glyphicon glyphicon-floppy-save" title="Aufgabe abschließen"></span></a>
            </td>
            </tr>
            ';
        }
        $overview.='<tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="'.$page.'?site=tasks_create"><span class="glyphicon glyphicon-plus" title="Aufgabe anlegen"></span></a>
            </td>
            </tr></table>';
        $framework->template->setTemplateVariables(array('overview',$overview));
        break;
    case 'tasks_give_user':
        if($_POST){
            $task_Users->createElement(array(
                'taskid'=>$_POST['taskid'],
                'userid'=>$_POST['user']
            ));

            header('Location:'.$page.'?site=tasks_details&id='.$_POST['taskid']);
        }
        else{
            $framework->template->setTemplateVariables(array('taskid',$_GET['id']));

        }
        $users='<select class="form-control" name="user" >';
        foreach($allUsers as $user){
            $users.='<option value="'.$user['id'].'">'.$user['firstname'].' '.$user['surname'].'</option>'
;        }
        $users.='</select>';
        $task=$tasks->getElementByAttribute('id',$_GET['id']);
        $framework->template->setTemplateVariables(array('overview',$overview));
        $framework->template->setTemplateVariables(array('allusers',$users));
        $framework->template->setTemplateVariables(array('taskheadline',$task['headline']));;
        $framework->template->setTemplateFile('tasks/give_user');
        break;
    case 'tasks_details':
        $task=$tasks->getElementByAttribute('id',$_GET['id']);
        $groups='';
        $first=true;
        foreach(explode(',',$task['suitable_groups']) as $suitable_group){
            foreach($usergroups->getAllElements() as $element){
                if($element['id']==$suitable_group){
                    if($first===false)$groups .=', ';
                    $groups.=$element['name'];
                    $first=false;
                }
            }
        }
        if($task['finished_by']=='0')$task['finished_by']='';
        if($task['deadline']=='0')$task['deadline']='';
        if($task['time_finished']=='0')$task['time_finished']='';
        $framework->template->setTemplateVariables(array('headline',$task['headline']));
        $framework->template->setTemplateVariables(array('task',$task['task']));
        $framework->template->setTemplateVariables(array('place',$task['place']));
        $framework->template->setTemplateVariables(array('suitable_groups',$groups));
        $framework->template->setTemplateVariables(array('finished_by',$task['finished_by']));
        $framework->template->setTemplateVariables(array('deadline',$task['deadline']));
        $framework->template->setTemplateVariables(array('time_finished',$task['time_finished']));
        $framework->template->setTemplateFile('tasks/details');
        break;
    case 'useradmin':
        header('Location:'.$page.'?site=useradmin_summary');
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
                    <!--<a href="'.$page.'?site=tasks_summary&user="><span class="glyphicon glyphicon-list-alt" title="Aufgaben betrachten"></span></a>-->
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
                catch(ElementDupeException $e){
                    $_SESSION['error']='Benutzer existiert bereits';
                    header('Location:'.$page.'?site=useradmin_create');
                    exit;
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
            header('Location:'.$page.'?site=useradmin_usergroups_summary');
        }
        $framework->template->setTemplateFile('usergroups/create');
        break;
    case 'useradmin_usergroups_delete':
        $usergroups->deleteElement($_GET['id']);
        header('Location:'.$page.'?site=useradmin_usergroups_summary');
        break;
    case 'useradmin_usergroups_edit':
        if($_POST){
            $usergroups->editElement(array('id'=>$_POST['id'],'name'=>$_POST['name']));
        }
        if($_GET['confirm']==true){
            header('Location:'.$page.'?site=useradmin_usergroups');
        }
        $element=$usergroups->getElementByAttribute('id',$_GET['id']);
        $framework->template->setTemplateVariables(array('id',$element['id']));
        $framework->template->setTemplateVariables(array('name',$element['name']));

        $framework->template->setTemplateFile('usergroups/edit');
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