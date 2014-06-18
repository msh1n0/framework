<?php

abstract class test {
    private $framework;

    function __construct(){
        $this->framework=new framework('sessiontest');
    }

    public function run(){
    }
}