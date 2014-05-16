<?php

class log extends collection{
    function add($action,$actor,$information=''){
        $newElement=array('id'=>time(),'action'=>$action,'actor'=>$actor,'information'=>$information);
        $this->createElement($newElement);
    }
    function checkForDupe(){
        return false;
    }


}