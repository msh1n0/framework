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
$content='';


/*   ZUM TESTEN DEAKTIVIERT
switch($_GET['site']){
    case 'checklist':
        $framework->template->setTemplateFile('checklist');
        break;
    case 'login':
        $framework->template->setTemplateFile('login');
        if($_POST){
            if($framework->users->logIn($_POST['username'],$_POST['password'])){
                $_SESSION['message']='Einloggen erfolgreich';
                header('Location:index.php?site=statistics');
                exit;
            }
            $framework->template->setTemplateVariables(array('error','has-error'));
        }
        break;
    case 'logout':
        $framework->template->setTemplateFile('logout');
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
    default:
        $framework->template->setTemplateFile('index');
        break;
}

*/







/*
 * Abschluss
 * */
$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();  //BEI PRODUKTIVNUTZUNG ENTFERNEN
$framework->template->display();