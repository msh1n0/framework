<?php

/**
 * Class files
 * Verwaltungsklasse für Ordner und Dateien
 * TODO Zip-Handling
 */
class files{
    /**
     * @param string $directory Pfad
     * @return array
     */
    public function DirectoryContents($directory){
        $handle=opendir ($directory);
        $contents = array();
        while ($element = readdir ($handle)) {
            if($element!=='.' && $element!=='..')
            $contents[]=$element;
        }
        closedir($handle);
        return $contents;
    }

    /**
     * @param string $directory Pfad
     * @param bool $recursive bei true werden alle ben�tigten Ordner automatisch angelegt
     */
    public function createDirectory($directory, $recursive=true){
        if(!$recursive)mkdir($directory);
        else{
            $directories=$this->pathAsArray($directory);
            $fullpath='';
            foreach($directories as $element){
                $fullpath.=$element;
                if(!is_dir($fullpath))mkdir($fullpath);
                $fullpath.='/';
                echo $fullpath;
            }
        }
    }

    /**
     * @param string $directory Pfad
     * @return array
     */
    private function pathAsArray($directory){
        if(strpos($directory,'/')===0) $directory=substr($directory,1);
        if(strpos($directory,'./')===0) $directory=substr($directory,2);
        return explode('/',$directory);
    }
}