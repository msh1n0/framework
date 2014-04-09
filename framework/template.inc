<?php

include 'ext/smarty/Smarty.class.php';


class template {
    public $smarty;

    function __construct(){
        $this->smarty = new Smarty();
        $this->smarty->setCacheDir('framework/cache/smarty');
        $this->smarty->caching = true;
        $this->smarty->cache_lifetime = 120;
    }
    public function display(){
        $this->smarty->display('framework/template/system/detail.tpl');
    }
    public function disableCaching(){
        $this->smarty->caching=false;
    }


} 