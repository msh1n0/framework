<?php

/**
 * Class session
 */
class session {
    private $project;
    private $variables=array();
    function __construct($project){
        $this->project=$project;
        session_start();
    }
    public function set($var,$value){
        $this->variables[]=$var;
        $_SESSION[$this->project.'_'.$var]=$value;
    }
    public function get($var){
        return $_SESSION[$this->project.'_'.$var];
    }
    public function delete($var){
        unset($this->variables[$var]);
        unset($_SESSION[$this->project.'_'.$var]);
    }
    public function flush(){
        foreach($this->variables as $variable){
            $this->delete($variable);
        }
    }
} 