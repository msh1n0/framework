<?php
include 'framework/framework.php';


/*
 * Basis-Definitionen
 * */
$framework = new framework('checkliste');
$framework->template->setTemplate('checkliste');
if(!empty($_SESSION['error'])){
    $framework->template->setTemplateVariables(array('error','<div class="alert alert-danger">'.$_SESSION['error']));
    unset($_SESSION['error']);
}
if(!empty($_SESSION['message'])){
    $framework->template->setTemplateVariables(array('error','<div class="alert alert-info">'.$_SESSION['message']));
    unset($_SESSION['message']);
}
/*
 * Basis-Definitionen Ende
 * */

$source=new externalContent();
$source->setURL('');
$images=$source->danbooru('yande.re');
var_dump($images);
foreach($images as $image){
    str_replace('%20',' ',$image);
    echo '<img src="'.$image.'">';
}


/*
 * Abschluss
 * */
$framework->template->setTemplate('danbooru');
$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();  //BEI PRODUKTIVNUTZUNG ENTFERNEN
$framework->template->display();