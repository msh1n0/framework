<?php

include 'ext/smarty/Smarty.class.php';


class template {
    public $smarty;
    private $templatePath='framework/template';
    private $templateFile='index';
    private $template='system';
    private $systemTemplate='system';

    function __construct(){
        $this->smarty = new Smarty();
        $this->smarty->setCacheDir('framework/cache/smarty');
        $this->smarty->setCompileDir('framework/cache/smarty/compile');
        $this->smarty->caching = true;
        $this->smarty->cache_lifetime = 120;
    }
    public function display(){
        $this->smarty->display($this->templatePath.'/'.$this->template.'/'.$this->templateFile.'.tpl');
    }
    public function disableCaching(){
        $this->smarty->caching=false;
    }
    public function setTemplate($newTemplate){
        $this->template=$newTemplate;
    }
    public function setTemplateFile($newFile){
        $this->templateFile=$newFile;
    }


} 