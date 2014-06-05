<?php

/**
 * Class configuration
 */
class configuration{
    /**
     * @param $class
     * @param $project
     * @return array
     */
    static public function loadConfig($class,$project){
        if(is_file("projects/".$project."/".$project.".ini")){
            $ini_array = parse_ini_file("projects/".$project."/".$project.".ini", TRUE);
            return $ini_array[$class];
        }
        else return false;
    }
}