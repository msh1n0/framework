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
     * @var
     */
    private $storagePath;
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
        }else{ //Datenbankodus
            echo 'DATABASEMODE';
        }
    }

    /**
     * @param $file
     */
    public function loadFromFile($file){
        $data=$this->document->getCSVAsArray($file);
        foreach($data as $element){
            $split=explode(';',$element);
            $this->users[]=array('username'=>$split[0],'password'=>$split[1], 'userlevel'=>$split[2]);
        }
        $this->storagePath=$file;
    }

    /**
     * @param $username
     * @return string
     */
    public function getUserRights($username){
        $output='';
        foreach($this->users as $user){
            if($user['username']==$username){
                $output=$user['userlevel'];
                break;
            }
        }
        return $output;
    }

    /**
     * @param $username
     * @param $password
     * @param $level
     * @throws UserDupeException
     * @throws InputErrorException
     */
    public function createUser($username,$password,$level){
        if(strpos($username,' ')!=='') throw new InputErrorException('Benutzernamen dürfen keine Leereichen enthalten');
        elseif(!$this->checkForDupe($username)) $this->document->writeCSV($this->storagePath,$username.';'.md5($password).';'.$level,true);
        else throw new UserDupeException("Der Nutzer existiert bereits");
    }

    /**
     * @param $username
     * @param $pass
     * @return int
     */
    public function logIn($username,$pass){
        $this->logOut();
        $filteredUsers=$this->document->getCSVAsArray();
        foreach($filteredUsers as $user){
            $split=explode(';',$user);
            if($split[0]===$username){
                if($split[1]===md5($pass)){
                    session_start();
                    $_SESSION['username']=$split[0];
                    $_SESSION['userlevel']=$split[2];
                    return 0;
                }
                else return 1;
            }
        }
        return 2;
    }

    /**
     *
     */
    public function logOut(){
        session_destroy();
    }

    /**
     *
     */
    public function getUserlevel(){
        $this->verifyLogin();
        $_SESSION['userlevel'];
    }

    /**
     * @return bool
     */
    public function isLoggedIn(){
        if(empty($_SESSION['username'])) return false;
        else {
            $this->verifyLogin();
            return true;
        }
    }

    /**
     * @return array
     */
    private function getAllUsers(){
        $output=array();
        foreach($this->users as $user){
            $output[]=$user['username'];
        }
        return $output;

    }

    /**
     * @param $username
     * @return bool
     */
    private function checkForDupe($username){
        $dupe=false;
        $allUsers=$this->getAllUsers();
        foreach($allUsers as $user){
            if($user===$username){
                $dupe=true;
                break;
            }
        }
        return $dupe;
    }
    /**
     * Prüft, ob der Userlevel noch stimmt
     */
    private function verifyLogin(){
        $filteredUsers=$this->document->getCSVAsArray();
        foreach($filteredUsers as $user){
            $split=explode(';',$user);
            if($split[0]===$_SESSION['username']){
                $_SESSION['userlevel']=$split[2];
            }
        }
    }
}