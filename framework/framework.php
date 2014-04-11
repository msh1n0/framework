<?php
session_start();
include 'configuration.inc';
include 'contentpool.inc';
include 'document.inc';
include 'exceptions.inc';
include 'ext/mobile-detect/mobile_detect.php';
include 'externalhtml.inc';
include 'files.inc';
include 'images.inc';
include 'template.inc';
include 'users.inc';


global $CONFIG;

/**
 * Class framework Sammlung Funktionen
 *
 * TODO Datenbank (einsetzen in document): Datenbank auswählen, auslesen, schreiben, bearbeiten, tabellen anlegen, tabellen löschen, Import, Export
 * TODO Contents: mit oder ohne Datenbank
 * TODO Formulare: erstellen von Formularen und annehmen der Daten
 * TODO Email: senden von Emails
 * TODO Framework: Vererbungsmöglichkeit, um Funktionen zu überschreiben
 * TODO Document: Erstellung von RSS, etc.
 * TODO News: News/Blog schreiben
 * TODO Chat: WebChat oder Newsticker-Funktion
 * TODO Media: Musik, Video, Streaming und so
 * TODO Kalender: Allgemeiner Kalender mit Terminen, Erinnerungen per Mail
 * TODO Cronjob: Bezug auf eine Datei im Framework, damit er leicht erweiterbar ist
 * TODO Einfaches Newsletter-System mit eigener User-Datenbank,
 */
class framework{
    public $config;
    /**
     *
     */
    public function __construct(){
        $this->config=configuration::loadConfig('framework');
        $this->images = new images();
        $this->users = new users();
        $this->contentpool = new contentpool();
        $this->externalcontent = new externalHTML();
        $this->template = new template();
        $this->mobileDetect = new Mobile_Detect();
    }
}