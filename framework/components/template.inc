<?php

include 'ext/smarty/Smarty.class.php';


/**
 * Class template
 */
class template{
    /**
     * @var Smarty
     */
    private $smarty;
    /**
     * @var string
     */
    private $templatePath='templates';
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
    private $document;
    /**
     * @var array
     */
    private $files;
    /**
     * @var array
     */
    private $swipeDirectory;
    /**
     * @var array
     */
    private $bootstrap=array(
        array('framework/components/ext/bootstrap/glyphicons.css'),
        array('framework/components/ext/bootstrap/bootstrap.min.js')
    );
    private $swipe=array(
        array('framework/components/ext/swipe/swipe.css'),
        array('framework/components/ext/swipe/swipe.js',
            'framework/components/ext/swipe/swipe-start.js')
    );
    /**
     * @var
     */
    private $jqueryNeeded;
    private $config;

    /**
     *
     */
    function __construct(){
        $this->document= new document();
        $this->files= new files();
        $this->config=configuration::loadConfig('template');
        $this->setTemplate($this->config['template']);
        $this->smarty = new Smarty();
        $this->smarty->setCacheDir('framework/cache/smarty');
        $this->smarty->setCompileDir('framework/cache/smarty/compile');
        $this->smarty->caching = true;
        $this->smarty->cache_lifetime = 120;
        $this->smarty->assign('metaCharset','utf-8');
        $this->bootstrap[0][]='framework/components/ext/bootstrap/themes/'.$this->config['bootstrap_theme'].'.css';
        $this->smarty->assign('templateDirectory',$this->templatePath.'/');
        $this->smarty->assign('index',$this->getIndex());
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
                $this->jqueryNeeded=true;
                break;
            case 'swipe';
                $input=$this->swipe;
                $this->jqueryNeeded=true;
                if(is_file($this->templatePath.'/'.$this->template.'/elements/swipe_nav.tpl')){
                    $this->document->setDocument($this->templatePath.'/'.$this->template.'/elements/swipe_nav.tpl');
                    $this->smarty->assign('swipe_nav',$this->document->getFileAsString());
                }
                else{
                    $this->document->setDocument($this->templatePath.'/system/elements/swipe_nav.tpl');
                    $this->smarty->assign('swipe_nav',$this->document->getFileAsString());
                }
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
    }

    public function setSwipeDirectory($swipeDirectory){
        $this->swipeDirectory=$swipeDirectory;
        $this->generateSwipe();
    }
    /**
     * Letzter Check vor der Initialisierung
     */
    private function lastCheck(){
        if($this->jqueryNeeded===true){
            $this->smarty->assign('jquery','<script src="framework/components/ext/jquery/jquery.js"></script>');
        }
    }
    private function generateSwipe(){
        if(empty($this->swipeDirectory))throw new ConfigurationException('Das SwipeDirectory ist nicht eingerichtet');
        $galleryElements=$this->files->DirectoryContents($this->swipeDirectory);
        $output='<div id="slider"><ul>';

        foreach($galleryElements as $element){
            $output.='<li style="display:none"><img src="'.$this->swipeDirectory.'/'.$element.'"></a></li>';
        }
        $output.='</ul></div>';
        $this->smarty->assign('swipe',$output);
    }
    private function getIndex(){
        $index=$_SERVER['PHP_SELF'];
        $index=substr($index,(strrpos($index,'/')+1));
        return $index;
    }
} 