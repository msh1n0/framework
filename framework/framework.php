<?php
session_start();
include 'components/collection.inc';
include 'components/configuration.inc';
include 'components/db_adapter.inc';
include 'components/db_querybuilder.inc';
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
 * MS Framework
 * Schritt 1: allgemein geschriebene Klassen sammeln, die wiederverwendet werden können.
 * Schritt 2: für die bisher aufgetretenen Probleme Klassen zur Verfügung stellen, um die Probleme in Zukunft zu vermeiden.
 * Schritt 3: Vorbereitungen für Sonderanwendungen treffen, um eine Spezialanwendung schneller entwickeln zu können
 * Schritt 4: fertig geschriebene Sonderanwendungen
 * Schritt 5: CMS inkl. Basis-Sicherheitsfunktionen mit Zuschaltbaren Sonderanwendungen
 *
 * Class framework
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