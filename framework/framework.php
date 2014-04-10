<?php
session_start();
include 'contentpool.inc';
include 'document.inc';
include 'exceptions.inc';
include 'ext/mobile-detect/mobile_detect.php';
include 'files.inc';
include 'images.inc';
include 'template.inc';
include 'users.inc';


/**
 * Class framework Sammlung Funktionen
 *
 * TODO Datenbankhandler(einsetzen in document): Datenbank auswählen, auslesen, schreiben, bearbeiten, tabellen anlegen, tabellen löschen, Import, Export
 * TODO ContentHandler: mit oder ohne Datenbank inklusive Caching-System, auslesen von Typo3-Seiten, Erkennung der Sitemap, etc.
 * TODO FormHandler: erstellen von Formularen und annehmen der Daten
 * TODO EmailHandler: senden von Emails
 * TODO Framework: Vererbungsmöglichkeit, um Funktionen zu überschreiben
 * TODO DocumentHandler: Erstellung von RSS, etc.
 * TODO NewsHandler: News/Blog schreiben
 * TODO ChatHandler: WebChat oder Newsticker-Funktion
 */
class framework{
    /**
     * @var string
     */
    /**
     *
     */
    public function __construct(){
        $this->images = new images();
        $this->files = new files();
        $this->users = new users();
        $this->contentpool = new contentpool();
        $this->template = new template();
        $this->mobileDetect = new Mobile_Detect();
    }
}