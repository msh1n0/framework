<?php
include 'framework/framework.php';
/*
 * TODO: Hallenplan
 * TODO: Navipunkt Mitarbeiter für alle, nur mit eigener Gruppe, bei Admins alle online-Mitarbeiter
 * TODO: Plattform auf Dateien umstellen
 * TODO: Aufgaben-Details: fertige Aufgaben nicht editierbar machen
 * TODO: Aufgaben-Details: Zugeteilte Nutzer, Admin soll Nutzer entfernen können, ansonsten jeder sich selbst
 * TODO: Aufgaben-Details: geplante Anzahl Personen anzeigen
 * TODO: Administration: Feierabend
 * TODO: Aufgaben-Übersicht: Schließen und entfernen nur bei mode "own"
 * TODO: Aufgaben-Übersicht: Bei mode "own" Aufgaben zurückweisen
 * TODO: Aufgaben-Übersicht: Bei nicht abgeschlossenen Aufgaben Hilfegesuch mit Bestätigung
 * TODO: Task-Detail, dann Nutzer zuweisen, abbrechen -> falsche Fehlermeldung
 * */

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
if(!empty($_SESSION['success'])){
    $framework->template->setTemplateVariables(array('success','<div class="alert alert-success">'.$_SESSION['success'].'</div>'));
    unset($_SESSION['success']);
}
if(!empty($_SESSION['message'])){
    $framework->template->setTemplateVariables(array('message','<div class="alert alert-info">'.$_SESSION['message'].'</div>'));
    unset($_SESSION['message']);
}
if($framework->users->isLoggedIn()){
    $framework->template->setTemplateVariables(array('isLoggedIn',true));
    $currentUser= $framework->users->getUserByAttribute('id',$_SESSION['user_id']);
    $framework->template->setTemplateArray('currentuser',$currentUser);
    if($currentUser['group']=='27'){
        $framework->template->setTemplateVariables(array('isadmin',true));
        $_SESSION['admin']=true;
    }
    else{
        $framework->template->setTemplateVariables(array('isadmin',false));
        $_SESSION['admin']=false;
    }
}
$page='checkliste.php';
$framework->template->setTemplateVariables(array('page',$page));

if($framework->users->isLoggedIn()) $currentUser=$framework->users->getUser($_SESSION['user_id']);
else  $currentUser='';


$usergroups=new collection(true);
$usergroups->setupDatabase('usergroups',array('name','admin'));
#$usergroups->setupFile('data/checkliste_usergroups.db',array('name','admin'));

$tasks = new collection(true);
$tasks->setupDatabase('tasks',array('headline','task','place','map_pointer','suitable_groups','finished_by','deadline','time_finished','finish_status','participants_min'));
#$tasks->setupFile('data/checkliste_tasks.db',array('headline','task','place','map_pointer','suitable_groups','finished_by','deadline','time_finished','finish_status'));

$task_Users = new collection(true);
$task_Users->setupDatabase('tasks_users',array('taskid','userid'));
#$task_Users->setupFile('data/checkliste_tasks_users.db',array('taskid','userid'));

$log = new log(false);
$log->setupFile('data/checkliste_log.db',array('action','actor','information'));

$maps=new collection(false);
$maps->setupFile('data/checkliste_maps.db',array('active'));
$framework->template->setTemplateArray('maps',$maps->getAllElements());

/*
 * Basis-Definitionen Ende
 * */

if(empty($_GET['site'])) $site='login';
elseif(!$framework->users->isLoggedIn() && $_GET['site'] != 'login') $site='login';
else $site=$_GET['site'];

if(!empty($currentUser['callback'])){
    $site='notification';
}

switch($site){
    case 'log':
        if(!isset($_POST['filter'])) $framework->template->setTemplateArray('log',array_reverse($log->getAllElements()));
            elseif($_POST['filter']=='') $framework->template->setTemplateArray('log',array_reverse($log->getAllElements()));
        else{
            $framework->template->setTemplateArray('log',array_reverse($log->getElementsByAttribute('action',$_POST['filter'])));
            $framework->template->setTemplateVariables(array('filter',$_POST['filter']));
        }
        $framework->template->setTemplateFile('log/summary');
        break;
    case 'login':
        $framework->template->setTemplateFile('login');
        if($_POST){
            if($framework->users->logIn($_POST['id'],$_POST['password'])=='1'){
                $temp=$framework->users->getUserByAttribute('id',$_POST['id']);
                $temp['status']='0';
                $framework->users->editUser($temp);
                $_SESSION['success']='Einloggen erfolgreich';
                $log->add('eingeloggt',$_POST['id']);
                header('Location:'.$page.'?site=statistics');
                exit;
            }
            $framework->template->setTemplateVariables(array('error','Einloggen fehlgeschlagen'));
            $framework->template->setTemplateVariables(array('has_error','has-error'));
        }
        if($framework->users->isLoggedIn()) header('Location:'.$page.'?site=statistics');
        break;
    case 'logout':
        $temp=$framework->users->getUserByAttribute('id',$_SESSION['user_id']);
        $temp['status']='3';
        $framework->users->editUser($temp);
        $log->add('ausgeloggt',$_SESSION['user_id']);
        $framework->users->logOut();
        header('Location:'.$page);
        break;
    case 'map':
        if(!isset($_GET['map'])) $framework->template->setTemplateArray('map',$maps->getElementByAttribute('active','true'));
        else $framework->template->setTemplateVariables(array('map',$_GET['map']));
        $framework->template->setTemplateFile('map/index');
        break;
    case 'map_admin':
        $framework->template->setTemplateVariables(array('mapsave',$maps->getAllElements()));
        if(!empty($_GET['action'])){
            if($_GET['action']=='activatemap'){
                $map=$maps->getElementByAttribute('id',$_GET['map']);
                if($map['active']=='false'){
                    $log->add('Karte aktiviert',$_SESSION['user_id'],'Bild '.$_FILES['userfile']['name']);
                    $map['active']='true';
                }
                else{
                    $log->add('Karte deaktiviert',$_SESSION['user_id'],'Bild '.$_FILES['userfile']['name']);
                    $map['active']='false';
                }
                $maps->editElement($map);
                header('Location:'.$page.'?site=map_admin');
            }elseif($_GET['action']=='uploadfile'){
                if($_GET['confirm']==true){
                    $uploaddir = 'contents/checkliste/images/maps/';
                    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
                    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                        try{
                            $maps->createElement(array('id'=>$_FILES['userfile']['name'],'active'=>'false'));
                        }catch(ElementDupeException $e){
                        }
                        $log->add('Karte hochgeladen',$_SESSION['user_id'],'Bild '.$_FILES['userfile']['name']);
                        $_SESSION['message']='Datei-Upload erfolgreich';
                    } else {
                        $_SESSION['error']='Datei-Upload fehlgeschlagen';
                    }
                    header('Location:'.$page.'?site=map_admin');
                }
                else{
                    $framework->template->setTemplateFile('map/upload');

                }
            }elseif($_GET['action']=='deletefile'){
                $_SESSION['message']='Datei gelöscht';
                $maps->deleteElement($_GET['map']);
                $log->add('Karte gelöscht',$_SESSION['user_id'],'Bild '.$_FILES['userfile']['name']);
                unlink('contents/checkliste/images/maps/'.$_GET['map']);
                header('Location:'.$page.'?site=map_admin');
            }
        }
        else{
            $mapDirectory=new filemanager();
            $framework->template->setTemplateVariables(array('mapsave',$maps->getAllElements()));
            $framework->template->setTemplateArray('allmaps',$mapDirectory->DirectoryContents('contents/checkliste/images/maps'));
            $framework->template->setTemplateFile('map/admin');
        }
        break;
    case 'notification':
        if(!empty($_GET['action']) && $_GET['action']=='close'){
            unset($currentUser['callback']);
            $framework->users->editUser($currentUser);
            header('Location:'.$page.'?site=statistics');
        }

        $framework->template->setTemplateArray('callback',$framework->users->getElementByAttribute('id',$currentUser['callback']));
        $framework->template->setTemplateFile('notification');
        break;
    case 'statistics':
        $framework->template->setTemplateFile('statistics');
        if($_GET['mode']=='admin'){
            $currentUser=$framework->users->getElementByAttribute('id',$_GET['user']);
            $framework->template->setTemplateVariables(array('adminmode',true));
        }
        else{
            $currentUser=$framework->users->getElementByAttribute('id',$_SESSION['user_id']);
            $framework->template->setTemplateVariables(array('adminmode',false));
        }

        $openTasks=array();
        foreach($tasks->getAllElements() as $task){
            $show=false;
            $own=false;
            $groups=explode(',',$task['suitable_groups']);
            foreach($groups as $group){
                if($group==$currentUser['group'])$show=true;
            }
            if($show===true){
                foreach($task_Users->getElementsByAttribute('taskid',$task['id']) as $element){
                    if($element['userid']==$currentUser['id']) $own=true;
                }
            }

            if($task['finish_status']!=0)$show=false;
            if($show===true && $own ===false)$openTasks[]=$task;
        }

        $closedTasks=array();
        foreach($tasks->getAllElements() as $task){
            $show=false;
            $groups=explode(',',$task['suitable_groups']);
            foreach($groups as $group){
                if($group==$currentUser['group'])$show=true;
            }

            if($task['finish_status']==0)$show=false;
            if($show===true)$closedTasks[]=$task;
        }

        $myTasks=array();
        foreach($tasks->getAllElements() as $task){
            $own=false;
            $groups=explode(',',$task['suitable_groups']);
            foreach($groups as $group){
                if($group==$currentUser['group'])$show=true;
            }
            foreach($task_Users->getElementsByAttribute('taskid',$task['id']) as $element){
                if($element['userid']==$currentUser['id']) $own=true;
            }

            if($task['finish_status']!=0)$show=false;
            if($own===true && $task['finish_status']==0)$myTasks[]=$task;
        }

        $framework->template->setTemplateVariables(array('backlink','statistics'));
        $framework->template->setTemplateArray('mytasks',$myTasks);
        $framework->template->setTemplateArray('closedtasks',$closedTasks);
        $framework->template->setTemplateArray('opentasks',$openTasks);
        $framework->template->setTemplateArray('user',$currentUser);
        unset($currentUser);
        break;
    case 'status':
        if(isset($_GET['status'])){
            $currentUser=$framework->users->getElementByAttribute('id',$_SESSION['user_id']);
            $currentUser['status']=$_GET['status'];
            $framework->users->editElement($currentUser);
            $status=array('frei','beschäftigt','Pause');
            $log->add('Status geändert',$_SESSION['user_id'],$status[$_GET['status']]);
            header('Location:'.$page.'?site=statistics');
        }
        break;
    case 'tasks':
        header('Location:'.$page.'?site=statistics');
        break;
    case 'tasks_cancel':
        $currentTask=$tasks->getElementByAttribute('id',$_GET['id']);
        $currentTask['finish_status']=2;
        $currentTask{'time_finished'}=date('d.m. H:i',time());
        $currentTask{'finished_by'}=$_SESSION['user_id'];
        $tasks->editElement($currentTask);
        $_SESSION['success']='Die Aufgabe wurde abgebrochen';
        $log->add('Aufgabe abgebrochen',$_SESSION['user_id'],'Aufgabe: '.$currentTask['headline']);
        header('Location:'.$page.'?site=statistics');
        break;
    case 'tasks_close':
        $currentTask=$tasks->getElementByAttribute('id',$_GET['id']);
        $currentTask['finish_status']=1;
        $currentTask{'time_finished'}=date('d.m. H:i',time());
        $currentTask{'finished_by'}=$_SESSION['user_id'];
        $tasks->editElement($currentTask);
        $_SESSION['success']='Die Aufgabe wurde abgeschlossen';
        $log->add('Aufgabe geschlossen',$_SESSION['user_id'],'Aufgabe: '.$currentTask['headline']);
        header('Location:'.$page.'?site=statistics');
        break;
    case 'tasks_create':
        if($_POST){
            $suitable_groups_new='';
            $first=true;
            if(!empty($_POST['suitable_groups'])){
                foreach($_POST['suitable_groups'] as $element){
                    if($first===false)$suitable_groups_new.=$element;
                    else $suitable_groups_new.=','.$element;
                }
            }
            $newtask=array(
                'headline'=>$_POST['headline'],
                'task'=>$_POST['task'],
                'place'=>$_POST['place'],
                'participants_min'=>$_POST['participants_min'],
                'suitable_groups'=>$suitable_groups_new,
                'deadline'=>$_POST['deadline']
            );
            if($newtask['headline']==''){
                $_SESSION['error']='Es muss eine Überschrift angegeben werden';
                $framework->template->setTemplateArray('suitable_groups',explode(',',$suitable_groups_new));
                $framework->template->setTemplateArray('task',$newtask);
            }
            else{
                $tasks->createElement($newtask);
                $log->add('Aufgabe erstellt',$_SESSION['user_id'],$_POST['headline']);
                header('Location:'.$page.'?site=statistics');
            }
        }


        $framework->template->setTemplateArray('user',$framework->users->getElementByAttribute('id',$_SESSION['user_id']));
        $framework->template->setTemplateVariables(array('usergroups',$usergroups->getAllElements()));
        $framework->template->setTemplateFile('tasks/create');
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
        $setUsers='';
        foreach($task_Users->getAllElements() as $element){
            if($element['taskid']==$_GET['id']){
                foreach($framework->users->getAllUsers() as $user){
                    if($user['id']==$element['userid']) $setUsers.=$user['firstname'].' '.$user['surname'].'<br>';
                }
            }
        }
        if($task['finished_by']=='0')$task['finished_by']='';
        if($task['deadline']=='0')$task['deadline']='';
        if($task['time_finished']=='0')$task['time_finished']='';

        $framework->template->setTemplateArray('setusers',$setUsers);
        $framework->template->setTemplateArray('groups',$groups);
        $framework->template->setTemplateArray('task',$task);
        if($_GET['backlink']=='')$framework->template->setTemplateVariables(array('backlink',$page.'?site=statistics'));
        elseif($_GET['backlink']=='summary') $framework->template->setTemplateVariables(array('backlink',$page.'?site=statistics'));
        else $framework->template->setTemplateVariables(array('backlink',$page.'?site='.$_GET['backlink']));
        $framework->template->setTemplateFile('tasks/details');
        break;
    case 'tasks_edit':

        if($_POST){
            $newtask=$tasks->getElementByAttribute('id',$_POST['id']);
            $suitable_groups_new='';
            $first=true;
            if(!empty($_POST['suitable_groups'])){
                foreach($_POST['suitable_groups'] as $element){
                    if($first===false)$suitable_groups_new.=$element;
                    else $suitable_groups_new.=','.$element;
                }
            }

            $newtask['headline']=$_POST['headline'];
            $newtask['task']=$_POST['task'];
            $newtask['place']=$_POST['place'];
            $newtask['participants_min']=$_POST['participants_min'];
            $newtask['suitable_groups']=$suitable_groups_new;
            $newtask['deadline']=$_POST['deadline'];

            if($newtask['headline']==''){
                $_SESSION['error']='Es muss eine Überschrift angegeben werden';
                $framework->template->setTemplateArray('suitable_groups',explode(',',$suitable_groups_new));
                $framework->template->setTemplateArray('task',$newtask);
            }
            else{
                $tasks->editElement($newtask);
                $_SESSION['success']='Aufgabe erfolgreich geändert';
                $log->add('Aufgabe bearbeitet',$_SESSION['user_id'],$newtask['headline']);
                header('Location:'.$page.'?site=statistics');
            }
        }else{
            $newtask=$tasks->getElementByAttribute('id',$_GET['id']);
        }


        $framework->template->setTemplateArray('task',$newtask);
        $framework->template->setTemplateArray('user',$framework->users->getElementByAttribute('id',$_SESSION['user_id']));
        $framework->template->setTemplateVariables(array('usergroups',$usergroups->getAllElements()));
        $framework->template->setTemplateFile('tasks/edit');
        break;
    case 'tasks_give_user':
        if($_POST){
            $newEntry=array('taskid'=>$_POST['taskid'],'userid'=>$_POST['user']);
            $success=true;

            foreach($task_Users->getElementsByAttribute('taskid',$newEntry['taskid']) as $task){
                if($task['userid']==$newEntry['userid']){
                    $success=false;
                    break;
                }
            }
            $task=$tasks->getElementByAttribute('id',$_POST['taskid']);
            if($success){
                $task_Users->createElement($newEntry);
                $_SESSION['success']='Die Aufgabe "'.$task['headline'].'" wurde dem Benutzer "'.$newEntry['userid'].'" zugewiesen.';
                $log->add('Aufgabe zugewiesen',$_SESSION['user_id'],'Aufgabe: '.$task['headline'].', Benutzer: '.$newEntry['userid']);
            }
            else $_SESSION['error']='Die Aufgabe wurde dem Nutzer bereits zugewiesen';
            header('Location:'.$page.'?site=tasks_details&id='.$_POST['taskid']);
        }
        else{
            $framework->template->setTemplateVariables(array('taskid',$_GET['id']));
            $_SESSION['error']='Die Aufgabe wurde bereits angenommen';
        }
        $users='<select class="form-control" name="user" >';
        foreach($framework->users->getAllUsers() as $user){
            $users.='<option value="'.$user['id'].'">'.$user['firstname'].' '.$user['surname'].'</option>';
        }
        $users.='</select>';
        $task=$tasks->getElementByAttribute('id',$_GET['id']);
        $framework->template->setTemplateVariables(array('allusers',$users));
        $framework->template->setTemplateVariables(array('taskheadline',$task['headline']));;
        $framework->template->setTemplateFile('tasks/give_user');
        break;
    case 'tasks_restart':
        $currentTask=$tasks->getElementByAttribute('id',$_GET['id']);
        $currentTask['finish_status']=0;
        $tasks->editElement($currentTask);
        $_SESSION['message']='Die Aufgabe wurde zurückgesetzt';
        $log->add('Aufgabe zurückgesetzt',$_SESSION['user_id'],'Aufgabe: '.$currentTask['headline']);
        header('Location:'.$page.'?site=statistics');
        break;
    case 'tasks_summary':
        $framework->template->setTemplateFile('tasks/summary');
        if(isset($_GET['filter'])) $task_summary_filter =$_GET['filter'];
        else $task_summary_filter ='finish_status';

        if(isset($_GET['value'])) $task_summary_value=$_GET['value'];
        else $task_summary_value ='0';

        if(isset($_GET['mode'])) $task_summary_mode=$_GET['mode'];
        else $task_summary_mode ='own';

        $currentUser=$framework->users->getElementByAttribute('id',$_SESSION['user_id']);

        $overview=array();
        $tasks->sort('headline');

        foreach($tasks->getElementsByAttribute($task_summary_filter, $task_summary_value) as $task){
            if($task_summary_mode=='group'){
                foreach(explode(',',$task['suitable_groups']) as $group){
                    if($group==$currentUser['group']){
                        $found=false;
                        foreach($task_Users->getElementsByAttribute('userid',$_SESSION['user_id']) as $element){
                            if($element['taskid']==$task['id'])$found=true;
                        }
                        if($found==false)$overview[]=$task;
                    }
                }
            }
            elseif($task_summary_mode=='own'){
                $found=false;
                foreach($task_Users->getElementsByAttribute('userid',$_SESSION['user_id']) as $element){
                    if($element['taskid']==$task['id'])$found=true;
                }
                if($found==true)$overview[]=$task;
            }
            elseif($task_summary_mode=='all')$overview[]=$task;
        }

        if($task_summary_filter=='finish_status'){
            if($task_summary_value==0){
                $headline.='Offene Aufgaben';
            }
            elseif($task_summary_value==1){
                $headline.='Fertige Aufgaben';
            }
            elseif($task_summary_value==2){
                $headline.='Gelöschte Aufgaben';
            }
        }

        if($task_summary_mode=='all') $headline.=' Gesamt';

        $framework->template->setTemplateVariables(array('backlink','summary'));
        $framework->template->setTemplateVariables(array('headline',$headline));
        $framework->template->setTemplateArray('finish_status',$task_summary_value);
        $framework->template->setTemplateArray('user_tasks',$task_Users->getAllElements());
        $framework->template->setTemplateArray('mode',$task_summary_mode);
        $framework->template->setTemplateArray('overview',$overview);
        $framework->template->setTemplateVariables(array('finishstatus',$task_summary_value));

        break;
    case 'tasks_take':
        $newEntry=array('taskid'=>$_GET['id'],'userid'=>$_SESSION['user_id']);
        $success=true;

        foreach($task_Users->getElementsByAttribute('taskid',$newEntry['taskid']) as $task){
            if($task['userid']==$newEntry['userid']){
                $success=false;
                break;
            }
        }

        if($success){
            $task_Users->createElement($newEntry);
            $task=$tasks->getElementByAttribute('id',$newEntry['taskid']);
            $_SESSION['message']='Die Aufgabe wurde angenommen';
            $log->add('Aufgabe angenommen',$_SESSION['user_id'],'Aufgabe: '.$task['headline']);
        }
        else{
            $_SESSION['error']='Die Aufgabe wurde bereits angenommen';
        }
        header('Location:'.$page.'?site=statistics');
        break;
    case 'useradmin':
        header('Location:'.$page.'?site=useradmin_summary');
        break;
    case 'useradmin_callback':
        $user=$framework->users->getElementByAttribute('id',$_GET['id']);
        $user['callback']=$_SESSION['user_id'];
        $framework->users->editUser($user);
        $_SESSION['Benachrichtigung erfolgreich gesetzt'];
        $log->add('Rückruf erfragt',$_SESSION['user_id'],'Anfrage an: '.$_GET['id']);
        header('Location:'.$page.'?site=useradmin_summary');
        break;
    case 'useradmin_create':
        if($_POST){
            $newUser=array(
                'id'=> $_POST['id'],
                'password'=> $_POST['password'],
                'firstname'=> $_POST['firstname'],
                'surname'=> $_POST['surname'],
                'email'=> $_POST['email'],
                'phone'=> $_POST['phone'],
                'group'=> $_POST['group'],
                'status'=> $_POST['status']
            );

            if(empty($newUser['id'])){
                $framework->template->setTemplateVariables(array('error','<div class="alert alert-danger">keinen Login eingegeben</div>'));
            }
            elseif(!$framework->users->getUser($newUser['id'])==''){
                $framework->template->setTemplateVariables(array('error','<div class="alert alert-danger">Benutzer existiert bereits</div>'));
            }
            elseif(empty($_POST['password'])){
                $framework->template->setTemplateVariables(array('error','<div class="alert alert-danger">kein Password eingegeben</div>'));
            }
            else{
                try{
                    $framework->users->createUser($newUser);
                }
                catch(InputErrorException $e){
                    $_SESSION['error']=$e->getMessage();
                    header('Location:'.$page.'?site=useradmin_create');
                    exit;
                }
                catch(ElementDupeException $e){
                    $_SESSION['error']='Benutzer existiert bereits';
                    header('Location:'.$page.'?site=useradmin_create');
                    exit;
                }
                $_SESSION['success']='Benutzer wurde erfolgreich angelegt';
                $log->add('Benutzer angelegt',$_SESSION['user_id'],$newUser['id']);
                header('Location:'.$page.'?site=useradmin_summary');
                exit;
            }
        }

        $framework->template->setTemplateArray('user',$newUser);
        $framework->template->setTemplateArray('groups',$usergroups->getAllElements());
        $framework->template->setTemplateFile('users/create');
        break;
    case 'useradmin_delete':
        try{
            $framework->users->deleteUser($_GET['id']);
        }catch(mysqli_sql_exception $e){
            $_SESSION['error']='Löschen fehlgeschlagen';
            header('Location:'.$page.'?site=useradmin_summary');
        }
        $_SESSION['success']='Benutzer wurde gelöscht';
        $log->add('Benutzer gelöscht',$_SESSION['user_id'],$_GET['id']);
        header('Location:'.$page.'?site=useradmin_summary');
        break;
    case 'useradmin_edit':
        if($_POST){
            try{
                $framework->users->editUser(array(
                    'id'=> $_POST['id'],
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
            $_SESSION['success']='Benutzer \''.$_POST['id'].'\' wurde erfolgreich bearbeitet';
            $log->add('Benutzer editiert',$_SESSION['user_id'],$_POST['id']);
            header('Location:'.$page.'?site=useradmin_summary');
        }
        else{
            $user=$framework->users->getElementByAttribute('id',$_GET['id']);
            $framework->template->setTemplateArray('groups',$usergroups->getAllElements());
            $framework->template->setTemplateArray('user',$user);
        }
        $framework->template->setTemplateFile('users/edit');
        break;
    case 'useradmin_summary':
        $userlist=array();
        foreach($framework->users->getAllUsers() as $user){
            $group=$usergroups->getElementByAttribute('id',$user['group']);
            $user['group']=$group['name'];
            $userlist[]=$user;
        }

        $framework->template->setTemplateFile('users/summary');
        $framework->template->setTemplateArray('userlist',$userlist);
        break;
    case 'useradmin_usergroups':
        header('Location:'.$page.'?site=useradmin_usergroups_summary');
        break;
    case 'useradmin_usergroups_create':
        if($_POST){
            $usergroups->createElement(array('name'=>$_POST['name'],'admin'=>$_POST['admin']));
            $_SESSION['message']='Die Benutzergruppe wurde erfolgreich angelegt';
            $log->add('Benutzergruppe erstellt',$_SESSION['user_id'],$_POST['name']);
            header('Location:'.$page.'?site=useradmin_usergroups_summary');
        }
        $framework->template->setTemplateFile('usergroups/create');
        break;
    case 'useradmin_usergroups_delete':
        $usergroups->deleteElement($_GET['id']);
        $_SESSION['message']='Die Benutzergruppe wurde gelöscht';
        $log->add('Benutzergruppe gelöscht',$_SESSION['user_id'],$_POST['name']);
        header('Location:'.$page.'?site=useradmin_usergroups_summary');
        break;
    case 'useradmin_usergroups_edit':
        if($_POST){
            $newgroup=$usergroups->getElementByAttribute('id',$_POST['id']);
            $newgroup['name']=$_POST['name'];
            $newgroup['admin']=$_POST['admin'];
            $usergroups->editElement($newgroup);
        }
        if($_GET['confirm']==true){
            $_SESSION['message']='Die Benutzergruppe wurde geändert';
            $log->add('Benutzergruppe geändert',$_SESSION['user_id'],$_POST['name']);
            header('Location:'.$page.'?site=useradmin_usergroups');
        }
        $framework->template->setTemplateArray('group',$usergroups->getElementByAttribute('id',$_GET['id']));
        $framework->template->setTemplateFile('usergroups/edit');
        break;
    case 'useradmin_usergroups_summary':
        $framework->template->setTemplateArray('usergroups',$usergroups->getAllElements());
        $framework->template->setTemplateFile('usergroups/summary');
        break;
    default:
        $framework->template->setTemplateFile('index');
        break;
}


/*
 * Abschluss
 * */
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();