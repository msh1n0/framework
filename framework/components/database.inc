<?php

/**
 * Class database
 */
class database {
    /**
     * @var array
     */
    private $config;
    /**
     * @var
     */
    private $sqlLink;
    /**
     * @var
     */
    private $db_server;
    /**
     * @var
     */
    private $db_name;
    /**
     * @var
     */
    private $db_table;
    /**
     * @var
     */
    private $db_login;
    /**
     * @var
     */
    private $db_password;
    /**
     * @var
     */
    private $attributes;
    /**
     * @var
     */
    private $debug=false;

    /**
     *
     */
    function __construct(){
        $this->config=configuration::loadConfig('database');
        $this->db_server=$this->config['db_server'];
        $this->db_name=$this->config['db_name'];
        $this->db_login=$this->config['db_login'];
        $this->db_password=$this->config['db_password'];
    }

    /**
     * @param $table
     */
    public function setTable($table){
        $this->db_table=$table;
    }

    /**
     * @param $attributes
     */
    public function setAttributes($attributes){
        if(is_array($attributes)) $this->attributes=$attributes;
        else $this->attributes=explode(',',$attributes);
    }

    /**
     * @param $data
     */
    public function save($data){
        $this->connect();
        $this->insert($data);
        $this->disconnect();
    }

    /**
     * @param $identifier
     * @param $value
     * @param $returnvalue
     * @return mixed
     */
    public function get($identifier,$value,$returnvalue){
        $this->connect();
        $result=$this->select($identifier.'='.$value);
        $this->disconnect();
        return $result[0][$returnvalue];
    }

    /**
     * @return array
     */
    public function getAll(){
        $this->connect();
        $result=$this->select('');
        $this->disconnect();
        return $result;
    }

    /**
     * @param $attribute
     * @param $value
     * @throws mysqli_sql_exception
     */
    public function delete($attribute,$value){
        $this->connect();
        $sql='DELETE FROM `'.$this->db_name.'`.`'.$this->db_table.'` WHERE `'.$this->db_table.'`.`'.$attribute.'` = \''.$value.'\'';

        if($this->debug)echo $sql;

        $db_erg = mysqli_query( $this->sqlLink, $sql );
        if ( ! $db_erg )
        {
            throw new mysqli_sql_exception('Ungültige Abfrage: ' . mysqli_error($this->sqlLink));
        }
        $this->disconnect();
    }

    /**
     * @param array $input
     * @throws mysqli_sql_exception
     */
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

        if($this->debug)echo $sql;

        $db_erg = mysqli_query( $this->sqlLink, $sql );
        if ( ! $db_erg )
        {
            throw new mysqli_sql_exception('Ungültige Abfrage: ' . mysqli_error($this->sqlLink));
        }
        $this->disconnect();
    }

    public function debugging($enable){
        if($enable===true)$this->debug=true;
        else $this->debug=false;
    }

    /**
     *
     */
    private function connect(){
        $this->sqlLink = mysqli_connect($this->db_server, $this->db_login, $this->db_password,$this->db_name);
    }

    /**
     * @param $where
     * @return array
     * @throws mysqli_sql_exception
     */
    private function select($where){
        if($where!='')$where=' WHERE '.$where;
        $sql = "SELECT * FROM ".$this->db_table.$where.";";

        if($this->debug)echo $sql;

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

    /**
     * @param array $data
     * @throws mysqli_sql_exception
     */
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

        if($this->debug)echo $sql;

        $db_erg = mysqli_query( $this->sqlLink, $sql );
        if ( ! $db_erg )
        {
            throw new mysqli_sql_exception('Ungültige Abfrage: ' . mysqli_error($this->sqlLink));
        }
    }

    /**
     *
     */
    private function disconnect(){
        mysqli_close($this->sqlLink);
    }

} 