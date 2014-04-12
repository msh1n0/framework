<?php
include 'framework/framework.php';

$framework = new framework();
$content='';
$framework->users->logIn('User22','pass');
if($framework->users->isLoggedIn())$framework->template->setTemplate('custom');
else $framework->template->setTemplate('system');

$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setTemplateVariables(array('username',$_SESSION['username']));
$framework->template->setTemplateVariables(array('userlevel',$_SESSION['userlevel']));
$framework->template->setupScript('bootstrap');

$framework->template->disableCaching();
$framework->template->display();