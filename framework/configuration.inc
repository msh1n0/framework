<?php

class configuration{
    static public function loadConfig($class){
        $ini_array = parse_ini_file("data/config.ini", TRUE);
        return $ini_array[$class];
    }
}