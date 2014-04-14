<?php

/**
 * Class users
 */
class users{
    /**
     * @var array
     */
    private $users = array();
    /**
     * @var document
     */
    private $document;
    private $db_table;
    private $config;

    /**
     *
     */
    function __construct(){
        $this->config=configuration::loadConfig('users');
        if(!$this->config['db_mode']){ //Datei-Modus
            $this->document = new document();
            $this->document->setDocument($this->config['userfile']);
            $this->importUserData();
        }else{ //Datenbankodus
            echo 'DATABASEMODE';
        }
    }


    public function createUser($input=array()){
        if(!is_array($input)) throw new InputErrorException('Das Feld ist kein Array');
        if(empty($input['username'])) throw new InputErrorException('Der Benutzername darf nicht leer sein');
        elseif(empty($input['password'])) throw new InputErrorException('Das Password darf nicht leer sein');
        elseif($this->checkForDupe($input['username']))throw new UserDupeException("Der Nutzer existiert bereits");
        else{
            $input['password']=md5($input['password']);
            $this->users[]=$input;
            $this->saveDB();
        }

    }

    public function logIn($username,$password){
        $this->importUserData();

        foreach($this->users as $user){
            if($user['username']===$username){
                if($user['password']===md5($password)){
                    session_start();
                    $_SESSION['username']=$user['username'];
                    $_SESSION['userlevel']=$user['password'];
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
        $this->verifyLogin();
        if(empty($_SESSION['username'])){
            return false;
        }
        else {
            return true;
        }
    }
    public function deleteUser($username){
        $output=array();
        foreach($this->users as $user){
            if($username!==$user['username']) $output[]=$user;
        }
        $this->users=$output;
        $this->saveDB();
    }
    public function editUser($new=array()){
        $output=array();
        $new['password']=md5($new['password']);
        foreach($this->users as $user){
            if($new['username']===$user['username']) $output[]=$new;
            else $output[]=$user;
        }
        $this->users=$output;
        $this->saveDB();
    }
    public function getAllUsers(){
        return $this->users;
    }

    private function importUserData(){
        $this->users=unserialize($this->document->getFileAsString());
    }

    private function saveDB(){
        $this->document->writeDB(serialize($this->users));
    }
    /**
     * @param $username
     * @return bool
     */
    private function checkForDupe($username){
        $this->importUserData();
        foreach($this->users as $user){
            if($username===$user['username']) return true;
        }
        return false;
    }
    /**
     * Prüft, ob der Userlevel noch stimmt
     */
    private function verifyLogin(){
        $this->importUserData();
        foreach($this->users as $user){
            if($_SESSION['username']===$user['username']) return true;
        }
        return false;
    }
}