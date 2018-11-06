<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MyPDO extends PDO
{
    /*
    public $servername = "localhost";
    public $username = "root";
    public $password = "ifsp";
    public $dbname = "SicKure";
    */
    public function __construct($options = [])
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "SicKure";
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_merge($default_options, $options);
        parent::__construct("mysql:host=$servername;dbname=$dbname", $username, $password, $options);
    }
    public function run($sql, $args = NULL)
    {
        if (!$args)
        {
            return $this->query($sql);
        }
        $stmt = $this->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}