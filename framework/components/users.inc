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
        $this->userconfig=configuration::loadConfig('users');
        parent::__construct($this->userconfig['db_mode']);
        if($this->userconfig['db_mode']){
            $this->setAttributes($this->config['attributes']);
            $this->database->setTable($this->userconfig['db_table']);
            $this->database->setAttributes($this->config['attributes']);
            $this->importElementData();
        }
    }


    public function createUser($input=array()){
        parent::createElement($input);
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
        $output=array('elementname','password');
        $split= explode(',',$attributes);
        foreach($split as $element){
            $output[]=$element;
        }
        $this->attributes=$output;
    }
    public function deleteUser($value){
        parent::deleteElement($value);
    }
    public function editUser($new=array()){
        parent::editElement($new);
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