<?php

/**
 * Class users
 */
class users extends element{
    /**
     * @var array
     */
    private $users = array();
    private $userconfig=array();

    /**
     *
     */
    function __construct(){
        $this->config=configuration::loadConfig('users');
        parent::__construct($this->config['db_mode']);
        if($this->config['db_mode']){
            $this->setupDatabase($this->config['db_table'],$this->config['attributes']);
        }
    }


    public function createUser($input=array()){
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

    public function logIn($username,$password){
        $this->importElementData();
        foreach($this->users as $user){
            if($user['username']==$username){
                if($user['password']==md5($password)){
                    session_start();
                    $_SESSION['username']=$user['username'];
                    return true;
                }
            }
        }
        return false;
    }

    /**
     *
     */
    public function logOut(){
        session_destroy();
    }

    /**
     * @return bool
     */
    public function isLoggedIn(){
        if(empty($_SESSION['username'])){
            return false;
        }
        else {
            return true;
        }
    }
    protected function setAttributes($attributes){
        $output=array('id','password');
        $split= explode(',',$attributes);
        foreach($split as $element){
            $output[]=$element;
        }
        $this->attributes=$output;
        if($this->config['db_mode']) $this->database->setAttributes($this->attributes);
    }
    public function deleteUser($value){
        parent::deleteElement($value);
    }
    public function editUser($new=array()){
        if($this->config['db_mode']){
            $this->database->edit($new);
        }else{
            $output=array();
            foreach($this->elements as $element){
                if($new['elementname']===$element['elementname']){
                    if(empty($new['password']))$new['password']=$element['password'];
                    $output[]=$new;
                }
                else $output[]=$element;
            }
            $this->elements=$output;
            $this->saveDB();
        }

    }
    public function getAllUsers(){
        return parent::getAllElements();
    }
    public function currentUser($attribute){
         return parent::currentElement($attribute);
    }
    public function getUser($username){
        return parent::getElementByAttribute('username',$username);
    }
    public function getUserByAttribute($attribute,$value){
        return parent::getElementByAttribute($attribute,$value);
    }
}