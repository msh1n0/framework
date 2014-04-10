<?php

class contents{
    private $sourceType;
    private $document;

    function __construct(){
        $this->document=new document();
    }
    function setSourceType($sourceType){
        switch($sourceType){
            case 'html':
                $this->sourceType=$sourceType;
                break;
            default:
                $this->sourceType='html';
        }

    }
    function getPage($site){
        switch($site){
            case 'html':
                return $this->document->getFileAsString();
                break;
            default:
                return '';
        }
    }
}