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


    /**
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
     *
     */
    public function getAttributes(){
        return $this->attributes;
    }

    /**
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
     * @param array $new
     */
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

    /**
     * @return array
     */
    public function getAllElements(){
        return $this->elements;
    }

    /**
     * @param $attribute
     * @return bool
     */
    public function currentElement($attribute){
        foreach($this->elements as $element){
            if($element['id']==$_SESSION['id']){
                return $element[$attribute];
            }
        }
        return false;
    }

    /**
     * @param $attribute
     * @param $value
     * @return string
     */
    public function getElementByAttribute($attribute,$value){
        foreach($this->elements as $element){
            if($element[$attribute]==$value){
                return $element;
            }
        }
        return '';
    }

    /**
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
     * @param $db_table
     */
    public function setDBTable($db_table){
        $this->database->setTable($db_table);
    }

    /**
     * @param $filename
     */
    public function setFile($filename){
        $this->config['file']=$filename;
    }

    /**
     * @param $db_table
     * @param array $attributes
     */
    public function setupDatabase($db_table,$attributes= array()){
        $this->setAttributes($attributes);
        $this->database->setAttributes($this->attributes);
        $this->database->setTable($db_table);
        $this->importElementData();
    }

    /**
     *
     */
    public function sort(){
        sort($this->elements);
    }

    /**
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
     *
     */
    protected function importElementData(){
        if(!$this->config['db_mode'])$this->elements=unserialize($this->document->getFileAsString());
        else{
           $this->elements=$this->database->getAll();
        }
    }

    /**
     *
     */
    protected function saveDB(){
        $this->document->writeDB(serialize($this->elements));
    }

    /**
     * @param $input
     * @return bool
     */
    protected function checkForDupe($input){
        $this->importElementData();
        foreach($this->elements as $element){
            $found=true;
            if($input['id']==$element['id']) return true;
            foreach($this->attributes as $attribute){
                if($attribute=='id')break;
                if($element[$attribute]!=$input[$attribute])$found=false;
            }
            if($found==true)return true;
        }
        return false;
    }
}