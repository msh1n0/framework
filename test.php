<?php
include 'framework/framework.php';

include 'framework/components/tests/session.inc';

/*
 * Sammlung von Testcases mit Tabellarischer Auflistung
 * */

$framework = new framework('test');

$testcases=array();
############################################################
## Framework-Aufruf
############################################################

$sessiontest = new sessiontest();
$framework->template->setTemplateArray('results_session',$sessiontest->run());

$testcollection = new collection(true,'test');
$testcollection->setupDatabase('test',array('vorname','nachname'));


var_dump($testcollection->getAllElements());




############################################################
## Initialisierung der Anzeige
############################################################

$framework->template->setTemplate('test');
$framework->template->setTemplateFile('index');
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();