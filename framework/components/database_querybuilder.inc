<?php

/**
 * Class database
 */
class databaseQuerybuilder {
    private $table;
    private $command;
    private $where=false;
    private $set=false;
    private $db_name;

    function __construct($db_name){
        $this->db_name=$db_name;
    }
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
        $this->command='SELECT '.$getcolumns.' FROM `'.$this->table.'`';
    }
    public function whereIs($filter,$value){
        $this->whereOrAnd();
        $this->command.=' '.$filter.'=\''.$value.'\'';
    }
    public function whereIsNot($filter,$value){
        $this->whereOrAnd();
        $this->command.=' '.$filter.'!=\''.$value.'\'';
    }
    public function limit($limit){
        $this->command.=' LIMIT '.$limit;
    }
    public function generate(){
        $this->where=false;
        $this->set=false;
        return $this->command;
    }
    public function delete(){
        $this->command='DELETE FROM `'.$this->db_name.'`.`'.$this->table.'`';
    }
    public function update($attributes, $values){
        $this->command='UPDATE `'.$this->db_name.'`.`'.$this->table.'`';

        $count=0;
        foreach($attributes as $attribute){
            $this->set($attribute,$values[$count]);
            $count++;
        }
    }
    public function insert($columns,$values){
        $this->command='INSERT INTO `'.$this->db_name.'`.`'.$this->table.'`';
        $this->command.=' (';
        $first=true;
        foreach($columns as $column){
            if(!$first) $this->command.=', ';
            $this->command.='`'.$column.'`';
            $first=false;
        }
        $this->command.=')';
        $first=true;
        $this->command.=' VALUES (';
        foreach($values as $value){
            if(!$first) $this->command.=', ';
            $this->command.='\''.$value.'\'';
            $first=false;
        }
        $this->command.=')';
    }
    private function set($attribute,$value){
        if($this->set==false) $this->command.=' SET';
        else{
            $this->command.=', ';
            $this->set=true;
        }
        $this->command.='`'.$attribute.'` = \''.$value.'\'';
    }
    private function whereOrAnd(){
        if($this->where==true) $this->command.=' AND';
        else{
            $this->command.=' WHERE';
            $this->where=true;
        }
    }
} 