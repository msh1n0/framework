<?php

/**
 * Class database
 */
class databaseQuerybuilder {
    private $table;
    private $command = array();

    public function setTable($table){
        $this->table=$table;
    }
    public function select($columns){
        if($columns=='*') $getcolumns='*';
        else{
            $getcolumns='';
            if(!is_array($columns)){
                $columns=explode(',',$columns);
            }
            foreach($columns as $column){
                $getcolumns='\''.$column.'\'';
            }
        }
        $this->command[0]='SELECT '.$getcolumns.' FROM '.$this->table;
    }
    public function generate(){
        $string='';
        foreach($this->command as $element){
            $string.=$element;
        }
        return $string;
    }
} 