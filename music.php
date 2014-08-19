<?php

include 'framework/framework.php';

/** Musikplattform
 * TODO: Dateibrowser bauen
 * TODO: Dynamischen Einstiegspunkt einrichten
 * TODO: Speicherfunktion für verschiedene Einstiegspunkte
 * TODO: Auslesen von ID3 Tags
 * TODO: Abspielen von Musik mit dem HTML5 Player
 * TODO: Anspielen von Musik unabhängig vom anderen Player
 * TODO: Abspielen von Musik in einer Playlist
 * TODO: Abspeichern der Playlist
 * TODO: Login einrichten
 * TODO: Playlists den Logins zuordnen bzw. Freigeben lassen
 * TODO: Logging einrichten
 * TODO: Index einrichten
 * TODO: Suche einrichten
 * */


############################################################
## Basis-Seitenaufbau
############################################################
$framework = new framework('music');
$framework->template->setTemplate('music');
$framework->template->setupScript('bootstrap');

############################################################
## Haupt-Funktionsweiche
############################################################

switch($_GET['site']){
    default:
        $framework->template->setTemplateFile('pages/start');
        break;
}



############################################################
## Seitenabschluss
############################################################
$framework->template->disableCaching();
$framework->template->display();