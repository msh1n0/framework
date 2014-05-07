<?php

/**
 * Class users
 */
class users extends collection{

    /**
     *
     */
    function __construct(){
        $this->config=configuration::loadConfig('users');
        parent::__construct($this->config['db_mode']);
        if($this->config['db_mode']){
            $this->setAttributes($this->config['attributes']);
            $this->setupDatabase($this->config['db_table'],$this->attributes);
        }else{
            $this->setAttributes($this->config['attributes']);
            $this->document->setDocument($this->config['userfile']);
            $this->elements=$this->document->getSerializedFile();
        }
    }


    /**
     * @param array $input
     * @throws ElementDupeException
     * @throws InputErrorException
     */
    public function createUser($input=array()){
        if(!is_array($input)) throw new InputErrorException('Das Feld ist kein Array');
        elseif($this->checkForDupe($input)){
            throw new ElementDupeException("Das Element existiert bereits");
        }
        $input['password']=md5($input['password']);
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

    /**
     * @param $id
     * @param $password
     * @return bool
     */
    public function logIn($id,$password){
        $this->importElementData();
        foreach($this->elements as $user){
            if($user['id']==$id){
                if($user['password']==md5($password)){
                    session_start();
                    foreach($this->attributes as $attribute){
                        if($attribute!='password') $_SESSION['user_'.$attribute]=$user[$attribute];
                    }
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
        if(empty($_SESSION['user_id'])){
            return false;
        }
        else {
            return true;
        }
    }

    /**
     * @param $value
     */
    public function deleteUser($value){
        parent::deleteElement($value);
    }

    /**
     * @param array $new
     */
    public function editUser($new=array()){
        if($this->config['db_mode']){
            $old=$this->getElementByAttribute('id',$new['id']);
            foreach($this->attributes as $attribute){
                if($attribute=='password') $new['password']=$old['password'];
            }

            $this->database->edit($new);
        }else{
            $output=array();
            foreach($this->elements as $element){
                if($new['id']===$element['id']){
                    if(empty($new['password']))$new['password']=$element['password'];
                    $output[]=$new;
                }
                else $output[]=$element;
            }
            $this->elements=$output;
            $this->saveDB();
        }

    }

    /**
     * @return array
     */
    public function getAllUsers(){
        return parent::getAllElements();
    }

    /**
     * @param $attribute
     * @return bool
     */
    public function currentUser($attribute){
        foreach($this->elements as $user){
            if($user['id']==$_SESSION['user_id']){
                return $user[$attribute];
            }
        }
        return false;
    }

    /**
     * @param $username
     * @return string
     */
    public function getUser($username){
        return parent::getElementByAttribute('id',$username);
    }

    /**
     * @param $attribute
     * @param $value
     * @return string
     */
    public function getUserByAttribute($attribute,$value){
        return parent::getElementByAttribute($attribute,$value);
    }
}