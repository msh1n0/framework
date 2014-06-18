<?php

/**
 * Class log
 */
class log extends collection{
    /** Für die Initialisierung einen Dateipfad angeben
     * @param $file
     */
    function __construct($file){
        $this->setupFile($file,array('action','actor','information'));
    }

    /** Anlegen eines Eintrags
     * @param string $action Was wurde gemacht
     * @param string $actor Wer hat es gemacht
     * @param string $information Zusätzliche Informationen
     */
    public function add($action,$actor,$information=''){
        $newElement=array('id'=>time(),'action'=>$action,'actor'=>$actor,'information'=>$information);
        $this->createElement($newElement);
    }

    /** Das Anlegen doppelter Einträge muss nicht verhinter werden
     * @return bool immer false, da im Log doppelte Einträge erlaubt sind
     */
    protected function checkForDupe(){
        return false;
    }


}