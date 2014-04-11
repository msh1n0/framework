<?php
include 'framework/framework.php';

$framework = new framework();
$framework->externalcontent->setURL('http://v8wsp/testarea/soschniok/hannover96vereint/ems.registration.club.php?l=de&xid=g32dpp37t3mcbq40v74hdloq06&s=manageclub&s=teams');
$framework->externalcontent->cropContent('<h1>Mannschaften</h1>',true,'</table>', true);
$framework->externalcontent->localise();
$content=$framework->externalcontent->getContent();

$framework->template->setTemplate('custom');
$framework->template->setTemplateVariables(array('content',$content));
$framework->template->setupScript('bootstrap');
$framework->template->disableCaching();
$framework->template->display();