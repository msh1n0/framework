<?php

/** Das db_object ist nur auf das Zusammensetzen und Ausgeben von Tabellenübergreifenden Datensätzen ausgelegt
 * Class db_object
 */
class db_object{
    /**
     * @var db_adapter
     */
    private $db;
    /**
     * @var array
     */
    private $tables=array();
    /**
     * @var array
     */
    private $connectors=array();
    /**
     * @var array
     */
    private $columns=array();

    /**
     * @param string $configname der Configname ist wichtig für den Datenbank-Login
     */
    function __construct($configname){
        $this->db = new db_adapter($configname);
    }

    /** Anmelden der Tabellen, die in die Suche eingeschlossen werden sollen
     * @param $tables
     */
    public function addTables($tables){
        if(is_array($tables)){
            foreach($tables as $table){
                $this->tables[]=$table;
            }
        }
        else $this->tables[]=$tables;
    }

    /** Verbinden der Tabellen
     * @param string $tableA
     * @param string $identifierA
     * @param string $tableB
     * @param string $identifierB
     */
    public function connectTables($tableA,$identifierA, $tableB,$identifierB){
        $this->connectors[]=array($tableA,$identifierA, $tableB,$identifierB);
    }

    /** Angabe der aufzurufenden Spalten
     * @param array $columns
     */
    public function addColumns($columns=array()){
        foreach($columns as $column){
            $this->columns[]=$column;
        }
    }

    /** Generieren der Ausgabe
     * @return array
     */
    public function generate(){
        return $this->db->mergeLoad($this->columns,$this->tables,$this->connectors);
    }
}