<?php

/**
 * Class configuration
 */
class configuration{
    /**
     * @param $class
     * @return array
     */
    static public function loadConfig($class){
        $ini_array = parse_ini_file("data/".$_SESSION['project'].".ini", TRUE);
        return $ini_array[$class];
    }
}