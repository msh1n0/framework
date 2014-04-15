<?php

class database {
    private $config;
    private $db_server;
    private $db_name;
    private $db_table;
    private $db_login;
    private $db_password;

    function __construct($table){
        $this->config=configuration::loadConfig('framework');
        $this->setTable($table);
    }
    function setTable($table){
        $this->db_table=$table;
    }
} 