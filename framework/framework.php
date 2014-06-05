<?php
session_start();
include 'components/collection.inc';
include 'components/configuration.inc';
include 'components/database.inc';
include 'components/document.inc';
include 'components/exceptions.inc';
include 'components/ext/mobile-detect/mobile_detect.php';
include 'components/externalcontent.inc';
include 'components/filemanager.inc';
include 'components/image.inc';
include 'components/map.inc';
include 'components/session.inc';
include 'components/template.inc';

/**
 * Framework Version 0.1
 *
 * Class framework
 * TODO: Collection: Export und Import-Funktionen (über document) als CSV, JSON
 * TODO: Datenbank-Manager: Datenbank auswählen, auslesen, schreiben, bearbeiten, tabellen anlegen, tabellen löschen, Import, Export
 * TODO: Datenbank-QueryBuilder: Erzeugt mit verketteten Funktionen Datenbank-Abfragen, die vom db-adapter ausgeführt werden
 * TODO: Email: senden von Emails
 * TODO: ExternalContent: Auslesen externer Dateien und URLs
 * TODO: Document: Erstellung von RSS,
 * TODO: Chat: WebChat oder Newsticker-Funktion
 * TODO: Media: Musik, Video, Streaming und so
 * TODO: Kalender: Allgemeiner Kalender mit Terminen, Erinnerungen per Mail
 * TODO: Cronjob: Bezug auf eine Datei im Framework, damit er leicht erweiterbar ist, Newsletter-Funktion
 */
class framework{
    /**
     * @var
     */
    private $config;

    /**
     * @param $name
     */
    public function __construct($name){
        $this->session=new session($name);
        $this->config=configuration::loadConfig('framework',$name);
        if($this->config['enable_users']==1) $this->users = new users($name);
        if($this->config['enable_externalhtml']==1) $this->externalcontent = new externalContent();
        if($this->config['enable_template']==1) $this->template = new template($name);
        if($this->config['enable_mobiledetect']==1) $this->mobileDetect = new Mobile_Detect();
    }
}