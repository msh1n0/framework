<?php
session_start();
include 'configuration.inc';
include 'contentpool.inc';
include 'document.inc';
include 'exceptions.inc';
include 'ext/mobile-detect/mobile_detect.php';
include 'externalcontent.inc';
include 'files.inc';
include 'images.inc';
include 'template.inc';
include 'users.inc';

/**
 * Class framework Sammlung Funktionen
 * TODO User: Benutzer bearbeiten, löschen noch checken, Freie Attribute über Array
 * TODO Template: CSS-Anmeldung bei Smarty
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
    /**
     * @var
     */
    private $config;
    /**
     *
     */
    public function __construct(){
        $this->config=configuration::loadConfig('framework');
        if($this->config['enable_images']==1) $this->images = new images();
        if($this->config['enable_users']==1) $this->users = new users();
        if($this->config['enable_contentpool']==1) $this->contentpool = new contentpool();
        if($this->config['enable_externalhtml']==1) $this->externalcontent = new externalContent();
        if($this->config['enable_template']==1) $this->template = new template();
        if($this->config['enable_mobiledetect']==1) $this->mobileDetect = new Mobile_Detect();
    }
}