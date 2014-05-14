<?php

/**
 * Class contentpool Verwaltung der Inhalte
 */
class contentpool{
    /**
     * @var string Dateityp der Inhalte (Standard .tpl)
     */
    private $sourceType;
    /**
     * @var document internes document-Objekt für Dateibasierte Zugriffe
     */
    private $document;
    /**
     * @var string Basis-Arbeitsverzeichnis
     */
    private $dataDirectory;
    /**
     * @var array alle gefundenen Seiten
     */
    private $pages = array();
    /**
     * @var files
     */
    private $files;
    /**
     * @var array
     */
    private $config;

    /**
     *
     */
    function __construct(){
        $this->config=configuration::loadConfig('contentpool');
        $this->sourceType=$this->config['sourcetype'];
        $this->document=new document();
        $this->files= new filemanager();
    }

    /**
     * @param $directory
     * @throws DirectoryNotFoundException
     * @throws ConfigurationException
     */
    public function setDataDirectory($directory){
        if($this->sourceType==='mySQL') throw new ConfigurationException("Einrichtung eines Verzeichnisses nicht notwendig");
        if(!isset($directory) || !empty($directory)){
            if(!is_dir($directory)) throw new DirectoryNotFoundException("das Verzeichnis konnte nicht geladen werden");
            $this->dataDirectory=$directory;
        }
    }

    /**
     * @param $sourceType
     */
    public function setSourceType($sourceType){
        switch($sourceType){
            default:
                $this->sourceType='tpl';
        }
    }

    /**
     * @param $element
     * @return string
     * @throws TemplateNotFoundException
     */
    public function getContent($element){
        switch($this->sourceType){
            case 'tpl':
                if(!is_file($this->dataDirectory.'/'.$element.'.'.$this->sourceType))throw new TemplateNotFoundException("Template-Datei konte nicht gefunden werden");
                $this->document->setDocument($this->dataDirectory.'/'.$element.'.'.$this->sourceType);
                $this->getPages();
                return $this->document->getFileAsString();
                break;
            default:
                return '';
        }
    }

    /**
     * Einlesen des Arrays für die interne Seitenübersicht
     */
    private function getPages(){
        switch($this->sourceType){
            default:
                $this->pages=$this->files->DirectoryContents($this->dataDirectory);
                unset($this->files);
            break;
        }
    }
}