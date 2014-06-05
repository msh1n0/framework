<?php

/**
 * Class sessiontest
 */
class sessiontest {
    private $framework;
    function __construct(){
        $this->framework=new framework('sessiontest');
    }
    public function run(){
        $this->framework->session->set('vartest','testcontent');
        $testcases[]=array('Framework->session->set()',($_SESSION['sessiontest_vartest']=='testcontent'));
        $testcases[]=array('Framework->session->get()',($_SESSION['sessiontest_vartest']==$this->framework->session->get('vartest')));
        $this->framework->session->set('deleteme','testcontent');
        $this->framework->session->delete('deleteme');
        $testcases[]=array('Framework->session->delete()',!isset($_SESSION['sessiontest_deleteme']));
        $this->framework->session->set('flushme1','testcontent');
        $this->framework->session->set('flushme2','testcontent');
        $this->framework->session->flush();
        $testcases[]=array('Framework->session->flush()',(!isset($_SESSION['sessiontest_flushme1']) && !isset($_SESSION['sessiontest_flushme1'])));
        return $testcases;
    }
}