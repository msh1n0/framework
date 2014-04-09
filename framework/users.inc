<?php

/**
 * Class users
 */
class users{
    private $users = array();
    private $storagePath;

    /**
     *
     */
    function __construct(){
        $this->csv = new csv();
    }

    /**
     * @param $file
     */
    public function loadFromFile($file){
        $data=$this->csv->getFileAsArray($file);
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
        elseif(!$this->checkForDupe($username)) $this->csv->writeFile($this->storagePath,$username.';'.md5($password).';'.$level,true);
        else throw new UserDupeException("Der Nutzer existiert bereits");
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
}