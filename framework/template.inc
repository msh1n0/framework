<?php

include 'ext/smarty/Smarty.class.php';


/**
 * Class template
 */
class template {
    /**
     * @var Smarty
     */
    private $smarty;
    /**
     * @var string
     */
    private $templatePath='framework/template';
    /**
     * @var string
     */
    private $templateFile='index';
    /**
     * @var
     */
    private $template;
    /**
     * @var string
     */
    private $systemTemplate='system';
    /**
     * @var array
     */
    private $bootstrap=array(
        array('framework/ext/bootstrap/bootstrap.min.css',
            'framework/ext/bootstrap/bootstrap-theme.min.css',
            'framework/ext/bootstrap/bootstrap.custom.css'),
        array('framework/ext/bootstrap/bootstrap.min.js')
    );
    /**
     * @var
     */
    private $jqueryNeeded;

    /**
     *
     */
    function __construct(){
        $this->smarty = new Smarty();
        $this->smarty->setCacheDir('framework/cache/smarty');
        $this->smarty->setCompileDir('framework/cache/smarty/compile');
        $this->smarty->caching = true;
        $this->smarty->cache_lifetime = 120;
        $this->smarty->assign('metaCharset','utf-8');
    }

    /**
     * Anzeigen der Seite mit dem eingestellten Template
     */
    public function display(){
        $this->lastCheck();
        if(is_file($this->templatePath.'/'.$this->template.'/'.$this->templateFile.'.tpl')) $this->smarty->display($this->templatePath.'/'.$this->template.'/'.$this->templateFile.'.tpl');
        elseif(is_file($this->templatePath.'/system/'.$this->templateFile.'.tpl')) $this->smarty->display($this->templatePath.'/'.$this->systemTemplate.'/'.$this->templateFile.'.tpl');
    }

    /**
     * Setzen der Templatevariablen in Arrayform
     * @param array $variables entweder Array eines Wertes oder Array aus mehreren Werte-Arrays
     */
    public function setTemplateVariables($variables){
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

    /**
     * @param $scriptname
     */
    public function setupScript($scriptname){
        $values=array();
        $input=array();
        switch($scriptname){
            case 'bootstrap';
                $input=$this->bootstrap;
                break;
        }
        for($i=0;$i<=1;$i++){
            foreach($input[$i] as $element){
                if($i=='0') $values[$i].='<link href="'.$element.'" rel="stylesheet">';
                if($i=='1') $values[$i].='<script src="'.$element.'"></script>';
            }
        }
        $this->smarty->assign($scriptname.'_css',$values[0]);
        $this->smarty->assign($scriptname.'_js',$values[1]);
        $this->jqueryNeeded=true;
    }

    /**
     * Letzter Check vor der Initialisierung
     */
    public function lastCheck(){
        if($this->jqueryNeeded===true){
            $this->smarty->assign('jquery','<script src="framework/ext/jquery/jquery.js"></script>');
        }
    }
} 