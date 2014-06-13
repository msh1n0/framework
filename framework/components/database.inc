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
    private $queryBuilder;

    /**
     *
     */
    function __construct($project){
        $this->config=configuration::loadConfig('database',$project);
        $this->db_server=$this->config['db_server'];
        $this->db_name=$this->config['db_name'];
        $this->db_login=$this->config['db_login'];
        $this->db_password=$this->config['db_password'];
        $this->queryBuilder = new databaseQuerybuilder($this->db_name);
    }

    /**
     * @param $enable
     */
    public function debugging($enable){
        $this->debug=$enable;
    }

    /**
     * @param $table
     */
    public function setTable($table){
        $this->queryBuilder->setTable($table);
    }


    public function query($sql){
        $this->connect();

        if($this->debug)echo $sql;

        $db_erg = mysqli_query( $this->sqlLink, $sql );
        $output=array();
        if (!$db_erg) throw new mysqli_sql_exception('Ungültige Abfrage: ' . mysqli_error($this->sqlLink));
        else{
            if($db_erg!==true && $db_erg!==false){
                while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC))
                {
                    $output[]=$zeile;
                }
            }
        }
        $this->disconnect();
        return $output;
    }

    public function delete($identifier,$value){
        $this->queryBuilder->delete();
        $this->queryBuilder->whereIs($identifier,$value);
        $this->query($this->queryBuilder->generate());
    }
    public function edit($editAttributes=array(),$editValues=array(),$filters=array(),$filtervalues=array()){
        $this->debugging(true);
        var_dump($editAttributes);
        $this->queryBuilder->update($editAttributes,$editValues);
        $count=0;
        foreach($filters as $filter){
            $this->queryBuilder->whereIs($filter,$filtervalues[$count]);
            $count++;
        }
    }
    /**
     * @param $data
     */
    public function save($data){
        $values=array();
        foreach($this->attributes as $attribute){
            $values[]=$data[$attribute];
        }
        $this->connect();
        $this->queryBuilder->insert($this->attributes,$values);
        $this->query($this->queryBuilder->generate());
        $this->disconnect();
    }

    public function get($columns='*',$includes = NULL,$includeValues = NULL,$excludes = NULL,$excludeValues = NULL,$limit=NULL){
        $this->queryBuilder->select($columns);
        if(!empty($includes)){
            $count=0;
            foreach($includes as $filter){
                $this->queryBuilder->whereIs($filter,$includeValues[$count]);
                $count++;
            }
        }
        if(!empty($excludes)){
            $count=0;
            foreach($excludes as $filter){
                $this->queryBuilder->whereIsNot($filter,$excludeValues[$count]);
                $count++;
            }
        }
        if(!empty($limit)){
            $this->queryBuilder->limit($limit);
        }
        return $this->query($this->queryBuilder->generate());
    }

    /**
     * @param $attributes
     */
    public function setAttributes($attributes){
        if(is_array($attributes)) $this->attributes=$attributes;
        else $this->attributes=explode(',',$attributes);
    }

    /**
     *
     */
    private function connect(){
        $this->sqlLink = mysqli_connect($this->db_server, $this->db_login, $this->db_password,$this->db_name);
    }

    /**
     *
     */
    private function disconnect(){
        mysqli_close($this->sqlLink);
    }
} 