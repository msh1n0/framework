<?php

/** Klasse zur Vorgenerierung von Datenbankabfragen, gebaut für mySQL 5.1.41
 * Class db_querybuilder
 */
class db_querybuilder {
    /**
     * @var string Angabe der Datenbanktabelle
     */
    private $table;
    /**
     * @var string Der Befehl, der am Ende ausgegeben wird
     */
    private $command;
    /**
     * @var bool Flag, ob WHERE bereits im Befehl vorhanden ist
     */
    private $where=false;
    /**
     * @var bool Flag, ob SET bereits im Befehl vorhanden ist
     */
    private $set=false;
    /**
     * @var string Datenbankname
     */
    private $db_name;

    /** der Konstruktor benötigt die Angabe der Datenbank
     * @param string $db_name Datenbankname
     */
    function __construct($db_name){
        $this->db_name=$db_name;
    }

    /** Setzen der Datenbanktabelle
     * @param string $table Tabellenname
     */
    public function setTable($table){
        $this->table=$table;
    }

    /** Generieren des SELECT-Befehls
     * @param mixed $columns Angabe der Spalten, entweder *, eine Array der Spalten, oder die Spaltenliste Kommasepariert
     */
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

    /** Generieren der WHERE-Klausel, diese Angaben müssen im Datensatz vorhanden sein
     * @param string $filter Such-Attribut
     * @param string $value Wert, den das Such-Attribut haben soll
     */
    public function whereIs($filter,$value){
        $this->whereOrAnd();
        $this->command.=' '.$filter.'=\''.$value.'\'';
    }

    /** Generieren der WHERE-Klausel, diese Angaben dürfen im Datensatz nicht vorhanden sein
     * @param string $filter Such-Attribut
     * @param string $value Wert, den das Such-Attribut NICHT haben darf
     */
    public function whereIsNot($filter,$value){
        $this->whereOrAnd();
        $this->command.=' '.$filter.'!=\''.$value.'\'';
    }

    /** Eingrenzen des Ergebnisses
     * @param int $limit Anzahl der Einträge, die ausgegeben werden sollen
     */
    public function limit($limit){
        $this->command.=' LIMIT '.$limit;
    }

    /** Generieren des Befehls
     * @return string fertiger SQL-Befehl
     */
    public function generate(){
        $this->where=false;
        $this->set=false;
        $output=$this->command;
        $this->command='';
        return $output;
    }

    /** Generieren DELETE FROM - Befehls
     */
    public function delete(){
        $this->command='DELETE FROM `'.$this->db_name.'`.`'.$this->table.'`';
    }

    /** Generieren des UPDATE-Befehls
     * @param array $attributes Attribute, die im entsprechenden Datensatz geändert werden sollen
     * @param array $values Werte der Attribute, die geändert werden sollen
     */
    public function update($attributes, $values){
        $this->command='UPDATE `'.$this->db_name.'`.`'.$this->table.'`';

        $count=0;
        foreach($attributes as $attribute){
            $this->set($attribute,$values[$count]);
            $count++;
        }
    }

    /** Generieren des INSERT INTO - Befehls
     * @param array $columns Attribute
     * @param array $values einzufügende Werte der Attribute
     */
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

    /** Bestandteil des UPDATE-Commands
     * @param string $attribute Attribut, das gesetzt werden soll
     * @param string $value Wert, der dem Attribut gegeben werden soll
     */
    private function set($attribute,$value){
        if($this->set==false) $this->command.=' SET';
        else{
            $this->command.=', ';
        }
        $this->set=true;
        $this->command.='`'.$attribute.'` = \''.$value.'\'';
    }

    /** Fügt dem Command je nach Bedarf WHERE oder AND hinzu
     */
    private function whereOrAnd(){
        if($this->where==true) $this->command.=' AND';
        else{
            $this->command.=' WHERE';
            $this->where=true;
        }
    }
} 