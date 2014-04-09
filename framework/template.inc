<?php

include 'ext/smarty/Smarty.class.php';


class template {
    private $smarty;
    private $templatePath='framework/template';
    private $templateFile='index';
    private $template;
    private $systemTemplate='system';

    /**
     *
     */
    function __construct(){
        $this->smarty = new Smarty();
        $this->smarty->setCacheDir('framework/cache/smarty');
        $this->smarty->setCompileDir('framework/cache/smarty/compile');
        $this->smarty->caching = true;
        $this->smarty->cache_lifetime = 120;
    }

    /**
     * Anzeigen der Seite mit dem eingestellten Template
     */
    public function display(){
        if(is_file($this->templatePath.'/'.$this->template.'/'.$this->templateFile.'.tpl')) $this->smarty->display($this->templatePath.'/'.$this->template.'/'.$this->templateFile.'.tpl');
        elseif(is_file($this->templatePath.'/system/'.$this->templateFile.'.tpl')) $this->smarty->display($this->templatePath.'/'.$this->systemTemplate.'/'.$this->templateFile.'.tpl');
    }

    /**
     * Setzen der Templatevariablen in Arrayform
     * @param array $variables entweder Array eines Wertes oder Array aus mehreren Werte-Arrays
     */
    public function setTemplateVaiables($variables){
        if(is_array($variables[0])){
            foreach($variables as $element){
                $this->smarty->assign($element[0],$element[1]);
            }
        }else{
            $this->smarty->assign($variables[0],$variables[1]);
        }
    }

    /**
     * Caching deaktivieren
     */
    public function disableCaching(){
        $this->smarty->caching=false;
    }

    /**
     * @param string $newTemplate Name des Neuen Templates(Muss im Templateverzeichnis liegen)
     */
    public function setTemplate($newTemplate){
        $this->template=$newTemplate;
    }

    /**
     * @param string $newFile Template-Datei, die verwendet werden soll
     */
    public function setTemplateFile($newFile){
        $this->templateFile=$newFile;
    }


} 