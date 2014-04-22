<?php

class database {
    private $config;
    private $sqlLink;
    private $db_server;
    private $db_name;
    private $db_table;
    private $db_login;
    private $db_password;
    private $attributes = array();

    function __construct(){
        $this->config=configuration::loadConfig('database');
        $this->db_server=$this->config['db_server'];
        $this->db_name=$this->config['db_name'];
        $this->db_login=$this->config['db_login'];
        $this->db_password=$this->config['db_password'];
    }
    public function setTable($table){
        $this->db_table=$table;
    }
    public function setAttributes($attributes){
        $this->attributes=$attributes;
    }
    public function save($data){
        $this->connect();
        $this->insert($data);
        $this->disconnect();
    }
    public function get($identifier,$value,$returnvalue){
        $this->connect();
        $result=$this->select($identifier.'='.$value);
        $this->disconnect();
        return $result[0][$returnvalue];
    }
    public function getAll(){
        $this->connect();
        $result=$this->select('');
        $this->disconnect();
        return $result;
    }
    public function delete($attribute,$value){
        $this->connect();
        $sql='DELETE FROM `'.$this->db_name.'`.`'.$this->db_table.'` WHERE `'.$this->db_table.'`.`'.$attribute.'` = \''.$value.'\'';
        $db_erg = mysqli_query( $this->sqlLink, $sql );
        if ( ! $db_erg )
        {
            throw new mysqli_sql_exception('Ungültige Abfrage: ' . mysqli_error($this->sqlLink));
        }
        $this->disconnect();
    }
    private function connect(){
        $this->sqlLink = mysqli_connect($this->db_server, $this->db_login, $this->db_password,$this->db_name);
    }
    private function select($where){
        if($where!='')$where=' WHERE '.$where;
        $sql = "SELECT * FROM ".$this->db_table.$where.";";

        $db_erg = mysqli_query( $this->sqlLink, $sql );
        if ( ! $db_erg )
        {
            throw new mysqli_sql_exception('Ungültige Abfrage: ' . mysqli_error($this->sqlLink));
        }
        $output=array();
        while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
        {
           $output[]=$zeile;
        }
        return $output;
    }
    private function insert($data =array()){
        $part1='INSERT INTO `'.$this->db_name.'`.`'.$this->db_table.'` ';
        $part2='(';
        $part3=' VALUES (';
        $first=true;
        foreach($this->attributes as $element){
            if($first===false){
                $part2.=', ';
                $part3.=', ';
            }
            $part2.="`$element`";
            $part3.="'$data[$element]'";
            $first=false;
        }
        $part2.=') ';
        $part3.=');';

        $sql = $part1.$part2.$part3;
        $db_erg = mysqli_query( $this->sqlLink, $sql );
        if ( ! $db_erg )
        {
            throw new mysqli_sql_exception('Ungültige Abfrage: ' . mysqli_error($this->sqlLink));
        }
    }
    public function edit($input=array()){
        $this->connect();
        $sql='UPDATE `'.$this->db_name.'`.`'.$this->db_table.'` SET ';
        $first=true;
        foreach($this->attributes as $attribute){
            if($first===false) $sql.=', ';
            $sql.='`'.$attribute.'` = \''.$input[$attribute].'\'';
            $first=false;
        }
        $sql.=' WHERE `'.$this->db_table.'`.`id` = \''.$input['id'].'\';';
        $db_erg = mysqli_query( $this->sqlLink, $sql );
        if ( ! $db_erg )
        {
            throw new mysqli_sql_exception('Ungültige Abfrage: ' . mysqli_error($this->sqlLink));
        }
        $this->disconnect();
    }
    private function disconnect(){
        mysqli_close($this->sqlLink);
    }

} 