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
            $input['password']=md5($input['password']);
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
    public function deleteElement($value){
        if($this->config['db_mode']){
            $this->database->delete('id',$value);
        }
        else{
            $output=array();
            foreach($this->elements as $element){
                if($value!==$element['elementname']) $output[]=$element;
            }
            $this->elements=$output;
            $this->saveDB();
        }
    }
    public function editElement($new=array()){
        $output=array();
        foreach($this->elements as $element){
            if($new['elementname']===$element['elementname']) $output[]=$new;
            else $output[]=$element;
        }
        $this->elements=$output;
        $this->saveDB();
    }
    public function getAllElements(){
        return $this->elements;
    }
    public function currentElement($attribute){
        foreach($this->elements as $element){
            if($element['elementname']==$_SESSION['elementname']){
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
    public function setDBTable($db_table){
        $this->database->setTable($db_table);
    }
    public function setFile($filename){
        $this->config['elementfile']=$filename;
    }
    public function setupDatabase($db_table,$attributes= array()){
        $this->setAttributes($attributes);
        $this->database->setTable($db_table);
        $this->importElementData();
    }
    protected function setAttributes($attributes){
        if(is_array($attributes)){
            $newattributes='';
            $first=true;
            foreach($attributes as $attribute){
                if($first===false)$newattributes.=$attribute;
                else $newattributes.=','.$attribute;
            }
            $attributes=$newattributes;
        }
        $output=array('elementname');
        $split= explode(',',$attributes);
        foreach($split as $element){
            $output[]=$element;
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
    /**
     * @param $elementname
     * @return bool
     */
    protected function checkForDupe($elementname){
        $this->importElementData();
        if($elementname=='')return false;
        foreach($this->elements as $element){
            if($elementname===$element['elementname']) return true;
        }
        return false;
    }
}