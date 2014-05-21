<?php

/**
 * Class log
 */
class log extends collection{
    /**
     * @param $action
     * @param $actor
     * @param string $information
     */
    function add($action,$actor,$information=''){
        $newElement=array('id'=>time(),'action'=>$action,'actor'=>$actor,'information'=>$information);
        $this->createElement($newElement);
    }

    /**
     * @return bool
     */
    function checkForDupe(){
        return false;
    }


}