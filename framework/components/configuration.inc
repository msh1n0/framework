<?php

class configuration{
    static public function loadConfig($class){
        $ini_array = parse_ini_file("framework/data/config.ini", TRUE);
        return $ini_array[$class];
    }
}