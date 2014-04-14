<?php
include 'framework/framework.php';

$framework = new framework();
$content='';

$framework->template->setTemplate('custom');
$framework->template->setupMapGrip('testfiles/varisia.jpg',800,480,20,10);
$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setupScript('bootstrap');

$framework->template->disableCaching();
$framework->template->display();