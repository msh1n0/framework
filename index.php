<?php
include 'framework/framework.php';

$framework = new framework();

$framework->documents->setDocument('framework/template/system/index.tpl');
$framework->documents->createPDF();



$content='';
$framework->template->setTemplate('custom');
$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();