<?php
include 'framework/framework.php';

$framework = new framework();
$content='';


$map=new map('testfiles/hallenplan.jpg');

$framework->template->setTemplate('custom');
$framework->template->setTemplateVariables($map->prepareMap('40','20'));
$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setupScript('bootstrap');

$framework->template->disableCaching();
$framework->template->display();