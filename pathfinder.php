<?php
include './framework/framework.php';
/*
 * Zum Spielstart alle Spieler ausblenden, mit Anmeldung werden die Spieler eingeblendet
 * Bei neuer Wahrnehmung neues Sichtfeld
 * Würfel beeinflussen
 * */
error_reporting(1);
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
$saveGame->setupFile('projects/pathfinder/data/game.db',array('currentplayer','phase','timestamp','timestamp_phase','timestamp_turns','timestamp_dice','timestamp_map','timestamp_pointers','auto','map','mapcols','dicemode','mapwidth','mapheight'));
$save=$saveGame->getElementByAttribute('id','1');

$mapDirectory=new filemanager();
$maps=$mapDirectory->DirectoryContents('projects/pathfinder/contents/images/maps');
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
        case 'expandview':
            $currentUser=$framework->users->getElementByAttribute('id',$_GET['user']);
            $currentUser['mapsight']=$_GET['value'];
            $save['timestamp_pointers']=time();
            $save['timestamp_turns']=time();
            $saveGame->editElement($save);
            $framework->users->editElement($currentUser);
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
            echo $user['w4'].'|'.$user['w6'].'|'.$user['w8'].'|'.$user['w10'].'|'.$user['w12'].'|'.$user['w20'].'|'.$user['w100'];
            break;
        case 'getdice':
            echo $save['w4'].'|'.$save['w6'].'|'.$save['w8'].'|'.$save['w10'].'|'.$save['w12'].'|'.$save['w20'].'|'.$save['w100'];
            break;
        case 'getpointers':
            $user=$framework->users->getElementByAttribute('id',$_SESSION['user_id']);
            $map = new map('projects/pathfinder/contents/images/maps/'.$save['map']);
            $map->resizeMap(970);
            $map->setCols($save['mapcols']);
            if($user['userlevel']<50){
                echo $map->generatePointers($framework->users->getElementsByAttribute('mapvisible','true'));
            }
            else{
                echo $map->generatePointers($framework->users->getAllUsers());
            }
            break;
        case 'hideplayer':
            $user=$framework->users->getElementByAttribute('id',$_GET['value']);
            $user['hidden']='true';
            $framework->users->editElement($user);
            $save['timestamp_turns']=time();
            $saveGame->editElement($save);
            header('Location:'.$page.'?site=useradmin');
            break;
        case 'manipulatedice':
            $save['dicemode']=$_GET['value'];
            $saveGame->editElement($save);
            break;
        case 'mapvisible':
            $user=$framework->users->getElementByAttribute('id',$_GET['value']);
            $user['mapvisible']='true';
            $framework->users->editElement($user);
            $save['timestamp_turns']=time();
            $save['timestamp_pointers']=time();
            $saveGame->editElement($save);
            break;
        case 'mapinvisible':
            $user=$framework->users->getElementByAttribute('id',$_GET['value']);
            $user['mapvisible']='false';
            $framework->users->editElement($user);
            $save['timestamp_turns']=time();
            $save['timestamp_pointers']=time();
            $saveGame->editElement($save);
            break;
        case 'map':
            $framework->template->setTemplateFile('ajax/map');
            $framework->template->setTemplateVariables(array('currentplayer',$framework->users->getElementByAttribute('id',$_SESSION['user_id'])));
            $user=$framework->users->getElementByAttribute('id',$_SESSION['user_id']);
            $map = new map('projects/pathfinder/contents/images/maps/'.$save['map']);
            $map->resizeMap(970);
            $map->setCols($save['mapcols']);
            if($user['userlevel']<50)
                $map->setHiddenMode(true);
            $framework->template->setTemplateVariables(array('map',$map->getMap()));
            $framework->template->setTemplateArray('users',$framework->users->getElementsByAttribute('hidden','false'));
            $framework->template->disableCaching();
            $framework->template->display();
            $save['timestamp_pointers']=time();
            $saveGame->editElement($save);
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
        case 'resetpointer':
            $user=$framework->users->getElementByAttribute('id',$_GET['value']);
            $user['pointerx']='';
            $user['pointery']='';
            $save['timestamp_pointers']=time();
            $saveGame->editElement($save);
            $framework->users->editUser($user);
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
            $save['timestamp_dice']=time();
            $save['timestamp_turns']=time();
            $saveGame->editElement($save);
            break;
        case 'setdice':
            $value=$_GET['value'];
            $dice=$_GET['dice'];

            $max=str_replace('w','',$dice);
            switch($save['dicemode']){
                case '1':
                    $value='1';
                    break;
                case '2':
                    if($max=='10')$value=rand(0,round($max/2));
                    elseif($max=='100')$value=rand(1,5)*10;
                    else $value=rand(1,round($max/2));
                    break;
                case '3':
                    if($max=='100')$value=rand(5,10)*10;
                    else $value=rand(round($max/2),$max);
                    break;
                case '4':
                    if($value=$max){
                        if($max=='10')$value=rand(0,9);
                        elseif($max=='100')$value=rand(1,9)*10;
                        else $value=rand(1,round($max-1));
                        break;
                    }
                    break;
            }
            /*
             * Hier kommt die Abfrage nach Würfelmoduse hin
             *
             * */

                if(empty($save[$dice])) $save[$dice]=$value;
                else $save[$dice]=$save[$dice].', '.$value;
                $user=$framework->users->getElementByAttribute('id',$_SESSION['user_id']);
                $user[$dice]=$user[$dice]-1;
                if($save['auto']==true){
                    $user['initiative']=$user['init']+$value;
                    $user['auto']=false;
                }
                $framework->users->editElement($user);
                if($save['auto']==true){
                    $user['initiative']=$user['init']+$value;
                    $user['auto']=false;
                    $currentPlayer=$save['currentplayer'];
                    foreach($framework->users->getElementsByAttribute('mapvisible','true') as $element){
                        if($element['auto']=='true' && $element['playable']=='true' && $element['userlevel']!='99'){
                            $save['currentplayer']=$element['id'];
                        }
                    }
                    if($save['currentplayer']==$currentPlayer){
                        $save['auto']=false;
                        $save['currentplayer']='';
                        $save['phase']='Kampf-Phase';
                    }
                }
                $framework->users->editElement($user);
                $save['timestamp_turns']=time();
                $save['timestamp_dice']=time();
                $save['timestamp_phase']=time();
                $saveGame->editElement($save);
            break;
        case 'setmarker':
            $user=$framework->users->getElementByAttribute('id',$_GET['player']);
            $user['color']=$_GET['color'];
            $framework->users->editElement($user);
            $save['timestamp_pointers']=time();
            $saveGame->editElement($save);
            break;
        case 'setphase':
            $save['auto']=false;
            $save['phase']=$_GET['value'];
            $save['timestamp_phase']=time();
            $saveGame->editElement($save);
            break;
        case 'setpointer':
            $user=$framework->users->getElementByAttribute('id',$_GET['value']);
            $user['pointerx']=$_GET['x'];
            $user['pointery']=$_GET['y'];
            $framework->users->editElement($user);
            $save['timestamp_pointers']=time();
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
            $save['timestamp_phase']=time();
            $save['timestamp_dice']=time();
            $save['timestamp_turns']=time();
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
            $save['timestamp_phase']=time();
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
            $save['timestamp_phase']=time();
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
        case 'startautoinitiative':
            foreach($framework->users->getAllUsers() as $user){
                $user['auto']=true;
                $user['w4']='';
                $user['w6']='';
                $user['w8']='';
                $user['w10']='';
                $user['w12']='';
                $user['w20']='1';
                $user['w100']='';
                $user['initiative']='';
                $framework->users->editElement($user);
            }
            $framework->users->sort('id',true);
            foreach($framework->users->getElementsByAttribute('mapvisible','true') as $user){
                if($user['playable']!='true') $user['initiative']=$user['init']+rand(1,20);
                elseif($user['userlevel']==20)$save['currentplayer']=$user['id'];
                $framework->users->editElement($user);
            }
            $save['phase']="Initiative";
            $save['auto']=true;
            $save['w4']='';
            $save['w6']='';
            $save['w8']='';
            $save['w10']='';
            $save['w12']='';
            $save['w20']='';
            $save['w100']='';
            $save['timestamp_turns']=time();
            $save['timestamp_phase']=time();
            $save['timestamp_dice']=time();
            $saveGame->editElement($save);
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
            $target=$framework->users->getElementByAttribute('id',$_POST['id']);
            if($target['playable']=='true'){
                if($framework->users->logIn($_POST['id'],$_POST['password'])){
                    $_SESSION['success']='Du bist jetzt eingeloggt';
                    header('Location:'.$page.'?site=wuerfel');
                }
                else{
                    header('Location:'.$page);
                }
            }
            else{
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
                        $save['timestamp_turns']=time();
                        $saveGame->editElement($save);
                        header('Location:'.$page.'?site=wuerfel#'.$_POST['user']['id']);
                    }
                    else{
                        $framework->users->editUser($_POST['user']);
                        $save['timestamp_turns']=time();
                        $saveGame->editElement($save);
                        header('Location:'.$page.'?site=useradmin');
                    }
                }
                elseif($_GET['action']=='createuser'){
                    $framework->users->createUser($_POST['user']);
                    $save['timestamp_turns']=time();
                    $saveGame->editElement($save);
                    header('Location:'.$page.'?site=useradmin');
                }
                elseif($_GET['action']=='batchcreateuser'){
                    $newuser=$_POST['user'];
                    for($i=1;$i<=$_POST['count'];$i++){
                        $newuser['id']=$_POST['user']['id'].$i;
                        $framework->users->createUser($newuser);
                    }
                    $save['timestamp_turns']=time();
                    $saveGame->editElement($save);
                    header('Location:'.$page.'?site=useradmin');
                }
                elseif($_GET['action']=='changepw'){
                    $newuser=$_POST['user'];
                    $newuser['password']=md5($newuser['password']);
                    $framework->users->editElement($newuser);
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
            elseif($_GET['action']=='changepw'){
                $framework->template->setTemplateArray('user',$framework->users->getElementByAttribute('id',$_GET['value']));
                $framework->template->setTemplateFile('users/changepw');
            }
            elseif($_GET['action']=='deleteuser'){
                $framework->users->deleteUser($_GET['user']);
                $save['timestamp']=time();
                $saveGame->editElement($save);
                header('Location:'.$page.'?site=useradmin');
            }
        }
        else{
            $framework->users->sort('userlevel',true);
            $framework->template->setTemplateArray('users',$framework->users->getAllUsers());
        }
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
                    $uploaddir = 'projects/pathfinder/contents/images/maps/';
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
                unlink('projects/pathfinder/contents/images/maps/'.$_GET['map']);
                header('Location:'.$page.'?site=mapadmin');
            }
        }
        else{
            $mapDirectory=new filemanager();
            $framework->template->setTemplateArray('maps',$mapDirectory->DirectoryContents('projects/pathfinder/contents/images/maps'));
            $framework->template->setTemplateVariables(array('activemap',$save['map']));
            $framework->template->setTemplateFile('map/admin');
        }
        break;
    case 'combi':
        $framework->template->setTemplateFile('combi/index');
        break;
    default:
        $framework->template->setTemplateFile('index');
        break;
}


$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();