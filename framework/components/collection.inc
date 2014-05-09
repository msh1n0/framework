<?php
include 'collections/users.inc';

/**
 * Class elements
 */
class collection{
    /**
     * @var array
     */
    protected $elements = array();
    /**
     * @var document
     */
    protected $document;
    /**
     * @var array
     */
    protected $config=array();
    /**
     * @var database
     */
    protected $database;
    /**
     * @var
     */
    protected $attributes;

    /**
     * Beim DB Modus muss
     */
    function __construct($db_mode){
        $this->config['db_mode']=$db_mode;
        if($this->config['db_mode']){
            $this->database = new database();
        }else{ //Datei-Modus
            $this->document = new document();
        }
    }


    /**
     * Legt ein neues Element an
     * @param array $input
     * @throws ElementDupeException
     * @throws InputErrorException
     */
    public function createElement($input=array()){
        if(!is_array($input)) throw new InputErrorException('Das Feld ist kein Array');
        elseif($this->checkForDupe($input))throw new ElementDupeException("Das Element existiert bereits");
        else{
            if($this->config['db_mode']){
                try{
                    $this->database->save($input);
                }catch (mysqli_sql_exception $e){
                    $_SESSION['error']=$e->getMessage();
                }
            }
            else{
                $this->elements[]=$input;
                $this->saveDB();
            }
        }
    }
    /**
     * Gibt die eingerichteten Attribute zurück
     */
    public function getAttributes(){
        return $this->attributes;
    }

    /**
     * Löscht das Element anhand der ID
     * @param $id
     */
    public function deleteElement($id){
        if($this->config['db_mode']){
            $this->database->delete('id',$id);
        }
        else{
            $output=array();
            foreach($this->elements as $element){
                if($id!==$element['id']) $output[]=$element;
            }
            $this->elements=$output;
            $this->saveDB();
        }
    }

    /**
     * Ändert ein Element, identifiziert an der ID
     * @param array $new
     */
    public function editElement($new=array()){
        if($this->config['db_mode']){
            $this->database->edit($new);
        }
        else{
            $output=array();
            foreach($this->elements as $element){
                if($new['id']===$element['id']){
                    foreach($this->attributes as $attribute){
                        if(!isset($new[$attribute]))$new[$attribute]=$element[$attribute];
                    }
                    $output[]=$new;
                }
                else $output[]=$element;
            }
            $this->elements=$output;
            $this->saveDB();
        }
    }

    /**
     * Gibt alle Datensätze zurück
     * @return array
     */
    public function getAllElements(){
        return $this->elements;
    }

    /**
     * Gib ein Element zurück, auf das das Kriterium zutrifft
     * @param $attribute
     * @param $value
     * @return string
     */
    public function getElementByAttribute($attribute,$value){
        if(!empty($this->elements))
        foreach($this->elements as $element){
            if($element[$attribute]==$value){
                return $element;
            }
        }
        return false;
    }

    /**
     * Gibt alle Datensätze, zurück auf die das Kriterium zutrifft
     * @param $attribute
     * @param $value
     * @return array
     */
    public function getElementsByAttribute($attribute,$value){
        $output=array();
        foreach($this->elements as $element){
           if($element[$attribute]==$value){
                $output[]=$element;
           }
        }
        return $output;
    }

    /**
     * richtet die Datenbanktabelle ein,
     * @param $db_table
     */
    public function setDBTable($db_table){
        $this->database->setTable($db_table);
        $this->importElementData();
    }

    /**
     * konfiguriert die Datei und liest den aktuellen Stand ein
     * @param $filename
     * @param $attributes
     */
    public function setupFile($filename,$attributes=array()){
        $this->document->setDocument($filename);
        $this->setAttributes($attributes);
        $this->importElementData();
    }

    /**
     * konfiguriert die Datenbank
     * @param $db_table
     * @param array $attributes
     */
    public function setupDatabase($db_table,$attributes=array()){
        $this->setAttributes($attributes);
        $this->database->setAttributes($this->attributes);
        $this->database->setTable($db_table);
        $this->importElementData();
    }

    /**
     * Sortiert das Collection-Array nach einem Attribut
     * @param string $attribute Attribut, nach dem sortiert werden soll
     */
    public function sort($attribute){
        $sort=array();
        foreach($this->elements as $task){ //Liste anlegen
            $sort[]=$task[$attribute];
        }
        $sort=array_unique($sort); //Doppelte Einträge beseitigen
        natcasesort($sort);


        $temp=array();
        foreach($sort as $element){
            foreach($this->getElementsByAttribute($attribute,$element) as $item){
                $temp[]=$item;
            }
        }
        unset($this->elements);
        $this->elements=$temp;
    }

    /**
     * Attribute einrichten
     * @param $attributes
     */
    protected function setAttributes($attributes){
        $output=array('id');
        if(is_array($attributes)) $this->attributes=$attributes;
        else {
            $split= explode(',',$attributes);
            foreach($split as $element){
                $output[]=$element;
            }
            $this->attributes=$output;
        }
    }

    /**
     * Kompletten Datenbestand einlesen
     */
    protected function importElementData(){
        if(!$this->config['db_mode'])$this->elements=unserialize($this->document->getFileAsString());
        else{
           $this->elements=$this->database->getAll();
        }
    }

    /**
     * Datei-basierte Datenbank speichern
     */
    protected function saveDB(){
        $this->document->writeDB(serialize($this->elements));
    }

    /**
     * Anhand der ID prüfen, ob der Datensatz bereits existiert
     * @param $input
     * @return bool
     */
    protected function checkForDupe($input){
        $this->importElementData();
        if($this->getElementByAttribute('id',$input['id'])) return true;
        return false;
    }
}