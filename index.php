<?php
include 'framework/framework.php';

$framework = new framework();
$content='';

$framework->template->setTemplate('custom');
$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();