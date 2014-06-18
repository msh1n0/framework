<?php
include 'framework/framework.php';
include 'framework/components/tests/test.inc';

############################################################
## Basis-Seitenaufbau
############################################################
$framework = new framework('test');
$framework->template->setTemplate('test');
$framework->template->setTemplateFile('top');
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();

############################################################
## Starten der Tests
############################################################



############################################################
## Seitenabschluss
############################################################
$framework->template->setTemplateFile('bottom');
$framework->template->display();