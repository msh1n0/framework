<?php
session_start();
include 'images.inc';
include 'users.inc';
include 'document.inc';
include 'files.inc';
include 'template.inc';
include 'ext/mobile-detect/mobile_detect.php';

include 'exceptions.inc';

/**
 * Class framework Sammlung Funktionen
 *
 * TODO Datenbankhandler: Datenbank auswählen, auslesen, schreiben, bearbeiten, tabellen anlegen, tabellen löschen
 * TODO ContentHandler: mit oder ohne Datenbank inklusive Caching-System, auslesen von Typo3-Seiten, Erkennung der Sitemap, Navigation, etc.
 * TODO StyleHandler: Modulares Zusammensetzen und verkleinern der CSS-Datei
 * TODO FormHandler: erstellen von Formularen und annehmen der Daten
 * TODO EmailHandler: senden von Emails
 * TODO UserHandler: Anmeldemöglichkeiten mit Berechtigungsstufen
 * TODO Framework: Vererbungsmöglichkeit, um Funktionen zu überschreiben
 * TODO DocumentHandler: Erstellung von PDF, RSS, etc.
 * TODO ImportHandler: Import und Export der Datenbank bzw. der Dateien
 * TODO NewsHandler: News/Blog schreiben
 * TODO ChatHandler: WebChat oder Newsticker-Funktion
 */
class framework{
     public $currentPage='index';
    /**
     *
     */
    public function __construct(){
        $this->images = new images();
        $this->files = new files();
        $this->documents = new document();
        $this->users = new users();
        $this->template = new template();
        $this->mobileDetect = new Mobile_Detect();
    }
    public function getCurrentPage(){
        return $this->currentPage;
    }
    public function setCurrentPage($site){
        $this->currentPage=$site;
    }
}