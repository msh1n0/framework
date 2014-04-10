<?php

class contentpool{
    private $sourceType='tpl';
    private $document;
    private $dataDirectory;

    function __construct(){
        $this->document=new document();
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
                $this->document->setDocument($this->dataDirectory.'/'.$element.'.'.$this->sourceType);
                return $this->document->getFileAsString();
                break;
            default:
                return '';
        }
    }
}