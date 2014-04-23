<?php
include 'element/tasks.inc';
include 'element/users.inc';

/**
 * Class elements
 */
class element{
    protected $elements = array();
    protected $document;
    protected $config=array();
    protected $database;
    protected $attributes;

    /**
     *
     */
    function __construct($db_mode){
        $this->config['db_mode']=$db_mode;
        if(!$this->config['db_mode']){ //Datei-Modus
            $this->document = new document();
            $this->importElementData();
        }else{
            $this->database = new database();
        }
    }


    public function createElement($input=array()){
        if(!is_array($input)) throw new InputErrorException('Das Feld ist kein Array');
        elseif($this->checkForDupe($input['id']))throw new ElementDupeException("Das Element existiert bereits");
        else{
            if(!$this->config['db_mode']){
                $this->elements[]=$input;
                $this->saveDB();
            }
            else{
                try{
                    $this->database->save($input);
                }catch (mysqli_sql_exception $e){
                    $_SESSION['error']=$e->getMessage();
                }
            }
        }
    }
    /**
     *
     */
    public function getAttributes(){
        return $this->attributes;
    }
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
    public function editElement($new=array()){
        if($this->config['db_mode']){
            $this->database->edit($new);
        }
        else{
            $output=array();
            foreach($this->elements as $element){
                if($new['id']===$element['id']) $output[]=$new;
                else $output[]=$element;
            }
            $this->elements=$output;
            $this->saveDB();
        }
    }
    public function getAllElements(){
        return $this->elements;
    }
    public function currentElement($attribute){
        foreach($this->elements as $element){
            if($element['id']==$_SESSION['id']){
                return $element[$attribute];
            }
        }
        return false;
    }
    public function getElementByAttribute($attribute,$value){
        foreach($this->elements as $element){
            if($element[$attribute]==$value){
                return $element;
            }
        }
        return '';
    }
    public function getElementsByAttribute($attribute,$value){
        $output=array();
        foreach($this->elements as $element){
            if($element[$attribute]==$value){
                return $output[]=$element;
            }
        }
        return $output;
    }
    public function setDBTable($db_table){
        $this->database->setTable($db_table);
    }
    public function setFile($filename){
        $this->config['file']=$filename;
    }
    public function setupDatabase($db_table,$attributes= array()){
        $this->setAttributes($attributes);
        $this->database->setAttributes($attributes);
        $this->database->setTable($db_table);
        $this->importElementData();
    }
    public function sort(){
        sort($this->elements);
    }
    protected function setAttributes($attributes){
        $output=array('id');
        if(is_array($attributes)) $this->attributes=$attributes;
        else {
            $split= explode(',',$attributes);
            foreach($split as $element){
                $output[]=$element;
            }
        }
        $this->attributes=$output;
    }
    protected function importElementData(){
        if(!$this->config['db_mode'])$this->elements=unserialize($this->document->getFileAsString());
        else{
           $this->elements=$this->database->getAll();
        }
    }

    protected function saveDB(){
        $this->document->writeDB(serialize($this->elements));
    }
    protected function checkForDupe($id){
        $this->importElementData();
        if($id=='')return false;
        foreach($this->elements as $element){
            if($id==$element['id']) return true;
        }
        return false;
    }
}