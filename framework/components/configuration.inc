<?php

class configuration{
    static public function loadConfig($class){
        $ini_array = parse_ini_file("framework/data/".$_SESSION['project'].".ini", TRUE);
        return $ini_array[$class];
    }
}