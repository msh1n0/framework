<?php

class contents{
    private $sourceType;
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
    public function getContent(){
        switch($this->sourceType){
            case 'html':
                return $this->document->getFileAsString();
                break;
            default:
                return '';
        }
    }
}