<?php
include 'framework/framework.php';

$framework = new framework();

//$framework->users->loadFromFile('framework/data/users.db');
//$framework->users->createUser('User_neu','neues Password','99');
#LOGIN, LOGOUT

echo'####';

$framework->template->setTemplate('custom');
$framework->template->disableCaching();
$framework->template->display();
echo'####';