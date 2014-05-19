<?php
session_start();
include 'components/collection.inc';
include 'components/configuration.inc';
include 'components/contentpool.inc';
include 'components/database.inc';
include 'components/document.inc';
include 'components/exceptions.inc';
include 'components/ext/mobile-detect/mobile_detect.php';
include 'components/externalcontent.inc';
include 'components/filemanager.inc';
include 'components/image.inc';
include 'components/map.inc';
include 'components/template.inc';

/**
 * Framework Version 0.1
 *
 * Class framework Sammlung Funktionen
 * TODO: Collection/Document: Verschiedene Dateimodi - Serialisiert (Standard), CSV, JSON
 * TODO: Datenbank (einsetzen in document): Datenbank auswählen, auslesen, schreiben, bearbeiten, tabellen anlegen, tabellen löschen, Import, Export
 * TODO: Contents: mit oder ohne Datenbank
 * TODO: Email: senden von Emails, Newsletter
 * TODO: ExternalContent: Funktioniert noch nicht
 * TODO: Document: Erstellung von RSS, etc.
 * TODO: Chat: WebChat oder Newsticker-Funktion
 * TODO: Media: Musik, Video, Streaming und so
 * TODO: Kalender: Allgemeiner Kalender mit Terminen, Erinnerungen per Mail
 * TODO: Cronjob: Bezug auf eine Datei im Framework, damit er leicht erweiterbar ist
 */
class framework{
    /**
     * @var
     */
    private $config;
    /**
     *
     */
    public function __construct($name){
        $_SESSION['project']=$name;
        $this->config=configuration::loadConfig('framework');
        if($this->config['enable_users']==1) $this->users = new users();
        if($this->config['enable_contentpool']==1) $this->contentpool = new contentpool();
        if($this->config['enable_externalhtml']==1) $this->externalcontent = new externalContent();
        if($this->config['enable_template']==1) $this->template = new template('projects/'.$name.'/templates');
        if($this->config['enable_mobiledetect']==1) $this->mobileDetect = new Mobile_Detect();
    }
}