<?php
include 'users.inc';
include 'log.inc';

/**
 * Class elements
 */
class collection{
    /**
     * @var array
     */
    protected $elements = array();
    /**
     * @var array
     */
    protected $mergedElements = array();
    /**
     * @var document
     */
    protected $document;
    /**
     * @var array
     */
    protected $config=array();
    /**
     * @var db_adapter
     */
    protected $database;
    /**
     * @var
     */
    protected $attributes;

    /**
     * Beim DB Modus muss
     */
    function __construct($db_mode,$db_configname=NULL){
        $this->config['db_mode']=$db_mode;
        if($this->config['db_mode']){
            $this->database = new db_adapter($db_configname);
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
        if($this->config['db_mode']){
            try{
                $this->database->save($input);
            }catch (mysqli_sql_exception $e){
                $_SESSION['error']=$e->getMessage();
            }
        }
        else{
            if(!is_array($input)) throw new InputErrorException('Das Feld ist kein Array');
            elseif($this->checkForDupe($input))throw new ElementDupeException("Das Element existiert bereits");
            else{
                if(empty($input['id'])){
                    $newid='';
                    foreach($this->attributes as $attribute){
                        $newid.=$input[$attribute];
                    }
                    $input['id']=md5($newid);
                    if($this->checkForDupe($input))throw new ElementDupeException("Das Element existiert bereits");
                }
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
        $this->database->debugging(true);
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
            $values=array();
            foreach($this->attributes as $attribute){
                $values[]=$new[$attribute];
            }
            $this->database->edit($this->attributes,$values,array('id'),array($new['id']));
        }
        else{
            $output=array();
            if($this->elements!=false){
                foreach($this->elements as $element){
                    if($new['id']===$element['id']){
                        foreach($this->attributes as $attribute){
                            if(!isset($new[$attribute]))$new[$attribute]=$element[$attribute];
                        }
                        $output[]=$new;
                    }
                    else $output[]=$element;
                }
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
        $this->importElementData();
        if($this->elements!=false){
            return $this->elements;
        }
        return array();
    }

    /**
     * Gib ein Element zurück, auf das das Kriterium zutrifft
     * @param $attribute
     * @param $value
     * @return string
     */
    public function getElementByAttribute($attribute,$value){
        if($this->config['db_mode']){
            $result= $this->database->get('*',array($attribute),array($value),NULL,NULL,1);
            return $result[0];
        }
        else{
            if($this->elements!=false){
                foreach($this->elements as $element){
                    if($element[$attribute]==$value){
                        return $element;
                    }
                }
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
        if($this->config['db_mode']){
            $output=$this->elements=$this->database->get('*',array($attribute),array($value));
        }
        else{
            if($this->elements!=false){
                foreach($this->elements as $element){
                    if($element[$attribute]==$value){
                        $output[]=$element;
                    }
                }
            }
        }
        return $output;
    }
    /**
     * Gibt alle Datensätze, zurück auf die das Kriterium nicht zutrifft
     * @param $attribute
     * @param $value
     * @return array
     */
    public function getElementsWithout($attribute,$value){
        $output=array();
        if($this->config['db_mode']){
            $output=$this->elements=$this->database->get('*',NULL,NULL,array($attribute),array($value));
        }
        else{
            if($this->elements!=false){
                foreach($this->elements as $element){
                    if($element[$attribute]!=$value){
                        $output[]=$element;
                    }
                }
            }
        }
        return $output;
    }

    public function getElementsFiltered($includeAttributes=array(),$includeValues=array(), $excludeAttributes=array(),$excludeValues=array()){
        $output=array();
        if($this->config['db_mode']){
            $output=$this->elements=$this->database->get('*',$includeAttributes,$includeValues,$excludeAttributes,$excludeValues);
        }
        else{
            if($this->elements!=false){
                foreach($this->elements as $element){
                    $count=0;
                    foreach($includeAttributes as $includeAttribute){
                        if($element[$includeAttribute]==$includeValues[$count]){
                            $innercount=0;
                            foreach($excludeAttributes as $excludeAttribute){
                                if($element[$excludeAttribute]!=$excludeValues[$innercount]){
                                    $output[]=$element;
                                }
                                $innercount++;
                            }
                        }
                        $count++;
                    }
                }
            }
        }
        return $output;
    }

    /**
     * Die Collection wird mit einer anderen collection temporär gekoppelt
     * @param collection $collection Zielcollection
     * @param string $joinOriginal Identifizierung des Originals (z.B. Usergroup-ID)
     * @param string $joinTarget Identifizierung des Ziels (z.B. ID)
     * @param string $outputvalue Feldname, der den Bezugspunkt ersetzen soll
     * @return array Verbunde Elemente
     */
    public function mergeWithCollection(collection $collection,$joinOriginal,$joinTarget,$outputvalue){
        if(false!=$this->elements){}
        if(empty($this->mergedElements)) $this->mergedElements=$this->elements;
        $newElements=array();
        foreach($this->mergedElements as $element){
            $temp=$collection->getElementByAttribute($joinTarget,$element[$joinOriginal]);
            $element[$joinOriginal]=$temp[$outputvalue];
            $newElements[]=$element;
        }
        $this->mergedElements=$newElements;
        return $this->mergedElements;
    }

    /**
     * Liefert das Ergebnis der Collection-Verbindung
     * @return array
     * @throws BadFunctionCallException
     */
    public function getMergedResults(){
        if(empty($this->mergedElements)) throw new BadFunctionCallException('Es hat noch kein Verbund stattgefunden');
        else return $this->mergedElements;
    }

    /**
     * konfiguriert die Datei und liest den aktuellen Stand ein
     * @param $filename
     * @param $attributes
     * @throws ConfigurationException
     */
    public function setupFile($filename,$attributes=array()){
        if($this->config['db_mode']) throw new ConfigurationException('Im Datenbankmodus kann keine Datei eingerichtet werden');
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
    }

    /**
     * @param $attribute
     * @param bool $reverse
     */
    public function sort($attribute,$reverse=false){
        if($this->elements !=false){
            $sort=array();
            foreach($this->elements as $task){ //Liste anlegen
                $sort[]=$task[$attribute];
            }
            $sort=array_unique($sort); //Doppelte Einträge beseitigen
            natcasesort($sort);
            if($reverse)$sort=array_reverse($sort);
            $temp=array();
            foreach($sort as $element){
                foreach($this->getElementsByAttribute($attribute,$element) as $item){
                    $temp[]=$item;
                }
            }
            unset($this->elements);
            $this->elements=$temp;
        }
    }

    /**
     * @param bool $status
     */
    public function debugging($status){
        $this->database->debugging($status);
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
        if($this->config['db_mode']){
            $this->elements=$this->database->get();
        }
        else $this->elements=unserialize($this->document->getFileAsString());
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