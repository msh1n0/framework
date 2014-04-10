<?php

class contentpool{
    private $sourceType='tpl';
    private $document;
    private $dataDirectory;
    private $pages = array();
    private $files;

    function __construct(){
        $this->document=new document();
        $this->files= new files();
    }
    public function setDataDirectory($directory){
        if($this->sourceType==='mySQL') throw new ConfigurationException("Einrichtung eines Verzeichnisses nicht notwendig");
        if(!isset($directory) || !empty($directory)){
            if(!is_dir($directory)) throw new DirectoryNotFoundException("das Verzeichnis konnte nicht geladen werden");
            $this->dataDirectory=$directory;
        }
    }
    public function setSourceType($sourceType){
        switch($sourceType){
            default:
                $this->sourceType='tpl';
        }
    }
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
    private function getPages(){
        switch($this->sourceType){
            default:
                $this->pages=$this->files->DirectoryContents($this->dataDirectory);
                unset($this->files);
            break;
        }
    }
}