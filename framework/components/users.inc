<?php

/**
 * Klasse zur Benutzerverwaltung
 * Class users
 */
class users extends collection{
    private $project;

    /**
     * vereinfachter Konstuktor; ruft die config auf
     */
    function __construct($project){
        $this->config=configuration::loadConfig('users',$project);
        $this->project=$project;
        if($this->config['db_mode']){
            $this->setAttributes($this->config['attributes']);
            $this->setupDatabase($this->config['db_table'],$this->attributes);
        }else{
            $this->setupFile($this->config['userfile'],$this->config['attributes']);
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
     * Einloggen - Setzen des Cookies mit Hash des Logins
     * @param $id
     * @param $password
     * @return bool
     */
    public function logIn($id,$password){
        $this->importElementData();
        foreach($this->elements as $user){
            if($user['id']==$id){
                if($user['password']==md5($password)){
                    setcookie($this->project."_user_id", $user['id'], time()+(60*60*24*2));
                    setcookie($this->project."_user_login", md5($password.$user['id']), time()+(60*60*24*2));
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * löscht das Cookie
     */
    public function logOut(){
        setcookie($this->project."_user_id", '', (time()-1));
        setcookie($this->project."_user_login", '', (time()-1));
    }

    /**
     * prüft anhand des Cookies, ob ein Nutzer eingeloggt ist
     * @return bool
     */
    public function isLoggedIn(){
        if(empty($_COOKIE[$this->project.'_user_id'])){
            return false;
        }
        else {
            if($this->getUser($_COOKIE[$this->project.'_user_id'])==false){
                $this->logOut();
                return false;
            };
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
                    foreach($this->attributes as $attribute){
                        if(empty($new['password']))$new['password']=$element['password'];
                        if(!isset($new[$attribute]))$new[$attribute]=$element[$attribute];
                    }
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
            if($user['id']==$_COOKIE[$this->project.'_user_id']){
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