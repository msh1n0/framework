<?php

/**
 * Klasse zur Benutzerverwaltung
 * Class users
 */
class users extends collection{

    /**
     * vereinfachter Konstuktor; ruft die config auf
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
     * Legt einen neuen Nutzer an. Konvention: array('id'=>id,'attribut'=>attribute)
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
     * Startet die Session und erstellt die Session-Attribute
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
                    $_SESSION['user_id']=$user['id'];
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * löscht die Session
     */
    public function logOut(){
        session_destroy();
    }

    /**
     * prüft anhand der Session, ob ei Nutzer eingeloggt ist
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
     *  Löscht einen Nutzer
     * @param $value
     */
    public function deleteUser($value){
        parent::deleteElement($value);
    }

    /**
     * Ändert einen Nutzen und speichert die Änderungen ab
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
     * Gibt alle Nutzer als Aray zurück
     * @return array
     */
    public function getAllUsers(){
        return parent::getAllElements();
    }

    /**
     * Ruft ein Attribut das aktuell eingeloggten Nutzers ab
     * @param string $attribute
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
     * Gibt das Element mit der entsprechenden ID zurück
     * @param string $username Benutzername(interne ID)
     * @return array
     */
    public function getUser($username){
        return parent::getElementByAttribute('id',$username);
    }

    /**
     * Gibt das erstbeste Element zurück, auf das die Kriterien zutreffen
     * @param string $attribute Such-Attribut
     * @param string $value
     * @return array
     */
    public function getUserByAttribute($attribute,$value){
        return parent::getElementByAttribute($attribute,$value);
    }
}