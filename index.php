<?php
include 'framework/framework.php';

$framework = new framework();
$content='';
$framework->users->createUser(array('username'=>'Hallo','password'=>'1234','Initiative'=>'5'));
$framework->template->setTemplate('custom');
$framework->template->setupMapGrip('testfiles/varisia.jpg',800,480,60,30);
$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setupScript('bootstrap');

$framework->template->disableCaching();
$framework->template->display();