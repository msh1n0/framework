<?php

/** Connector zur Datenbank, enthält vereinfachte Datenbank-Befehle
 * Class db_adapter
 */
class db_adapter {
    /** Verweis auf die CConfig-Datei
     * @var array
     */
    private $config;
    /** Verbindung zur Datenbank
     * @var
     */
    private $sqlLink;
    /** Name des Datenbank-Servers
     * @var
     */
    private $db_server;
    /** Name der Datenbank
     * @var
     */
    private $db_name;
    /** Benutzername für die Datenbank
     * @var
     */
    private $db_login;
    /** Password für die Datenbank
     * @var
     */
    private $db_password;
    /** Attributsliste, die für das Einspielen von Daten notwendig ist
     * @var
     */
    private $attributes;
    /** Trigger für den Debug-Modus (SQL-Abfragen werdne beim durchführen gleichzeitig ausgegeben
     * @var
     */
    private $debug=false;
    /**
     * Querybuilder-Objekt, das die Befehle generiert
     * @var db_querybuilder
     */
    private $queryBuilder;

    /** Bei der Erstellungung der Datenbank wird ein Projektname benötigt, damit aus der Config die Login-Daten gelesen werden können
     */
    function __construct($project){
        $this->config=configuration::loadConfig('db_adapter',$project);
        $this->db_server=$this->config['db_server'];
        $this->db_name=$this->config['db_name'];
        $this->db_login=$this->config['db_login'];
        $this->db_password=$this->config['db_password'];
        $this->queryBuilder = new db_querybuilder($this->db_name);
    }

    /** Debugging Modus ein-/ausschalten
     * @param boolean $enable True=On, False=Off
     */
    public function debugging($enable){
        $this->debug=$enable;
    }

    /** Setzen der Tabelle, notwendig für die Verwendung
     * @param string $table Tabellenname
     */
    public function setTable($table){
        $this->queryBuilder->setTable($table);
    }


    /** Aufrufen eines SQL-Syntaxes
     * @param string $sql SQL-Befehl in String-Form
     * @return array sofern die Abfrage ein Ergebnis hatte, wird sie als Array ausgegeben
     * @throws mysqli_sql_exception
     */
    private function query($sql){
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

    /** Befehl zum Löschen eines Datensatzes
     * @param string $identifier Identifikationsmerkmal, nach dem der Datensatz gefunden werden soll
     * @param string $value Identifikationsmerkmal, nach dem der Datensatz gefunden werden soll
     */
    public function delete($identifier,$value){
        $this->queryBuilder->delete();
        $this->queryBuilder->whereIs($identifier,$value);
        $this->query($this->queryBuilder->generate());
    }

    /** Bearbeiten eines Datensatzer, die Identifizierung erfolgt über die ID
     * @param array $editAttributes Attribute, die durchlaufen werdne sollen
     * @param array $editValues Werte des Datensatzers in gleicher Reihenfolge wie die Attribute
     * @param array $filters Attribute, mit denen die Bearbeitung eingeschränkt werden soll
     * @param array $filtervalues Werte, mit denen die Bearbeitung eingeschränkt werdne soll, in gleicher Reihenfolge wie die Attribute
     */
    public function edit($editAttributes=array(),$editValues=array(),$filters=array(),$filtervalues=array()){
        $this->queryBuilder->update($editAttributes,$editValues);
        $count=0;
        foreach($filters as $filter){
            $this->queryBuilder->whereIs($filter,$filtervalues[$count]);
            $count++;
        }
        $this->query($this->queryBuilder->generate());
    }
    /** Speichern eines Datensatzes
     * @param array $data Datensatz als Array(attr=>val,attr=>val)
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

    /** Vorbereiten eines Selects
     * @param string $columns Spalten, die angezeigt werden sollen, mit Komma getrennt oder direkt als Array
     * @param null $includes Attribute, mit denen die Suche eingeschränkt werden soll
     * @param null $includeValues Werte zu den Attributen, die zutreffen müssen
     * @param null $excludes Attribute, die das Suchergebnis einschränken
     * @param null $excludeValues Werte zu den Attributen, die NICHT zutreffen sollen
     * @param null $limit Einschränkung de Ergebnismenge
     * @return array Ergebnisse als Array
     */
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

    /** Attribute, die das Speichern der Datensätze betrifft. Muss einmal zu Beginn deklariert werden
     * @param array $attributes Attribute in Array-Form oder auch Komma-separiert
     */
    public function setAttributes($attributes){
        if(is_array($attributes)) $this->attributes=$attributes;
        else $this->attributes=explode(',',$attributes);
    }

    /** Verbindung zur Datenbank aufbauen
     */
    private function connect(){
        $this->sqlLink = mysqli_connect($this->db_server, $this->db_login, $this->db_password,$this->db_name);
    }

    /** Verbindung zur Datenbank trennen
     */
    private function disconnect(){
        mysqli_close($this->sqlLink);
    }
} 