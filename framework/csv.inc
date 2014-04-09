<?php

/**
 * Class csv
 * Für die Vereinfachte Abfrage von Dateien
 */
class csv{
    /**
     * @param string $file Pfad zur Datei
     * @return array
     */
    public function getFileAsArray($file){
        return file($file);
    }

    /**
     * @param string $file Pfad zur Datei
     * @return string
     */
    public function getFileAsString($file){
        $content = file($file);
        $text='';
        foreach($content as $element){
            $text.=$element;
        }
        return $text;
    }

    /**
     * @param string $file Pfad zur Datei
     * @param string $needle Zu suchender Text
     * @param bool $wanted bei true werden nur Zeilen mit und bei false nur Zeilen ohne den text gesucht
     * @return array
     */
    public function getFileAsArrayFiltered($file,$needle,$wanted=true){
        $haystack = file($file);
        $output= array();
        if($wanted){
            foreach($haystack as $element){
                if(strpos($element,$needle)) $output[].=$element;
            }
        }
        else{
            foreach($haystack as $element){
                if(!strpos($element,$needle)) $output[].=$element;
            }
        }
        return $output;
    }

    /**
     * @param string $file Pfad zur Datei
     * @param array $content Zu schreibender Inhalt, auch als string übergebbar
     * @param bool $expand standardmäßig false, bei true wird die Datei nur erweitert
     */
    public function writeFile($file,$content,$expand=false){
        if(!is_array($content))$content = array($content);
        if($expand==true) $text = $this->getFileAsString($file)."\n";
        else $text='';
        foreach($content as $element){
            $text.=$element;
        }
        $filehandle = fopen($file, 'w');
        fwrite($filehandle,$text);
        fclose($filehandle);
    }

}