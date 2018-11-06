<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generic
 *
 * @author Calmf
 */
class Generic
{
    
    public $tablename = NULL;
    
    public $pkey = NULL;
    public $ativokey = NULL;
    public $searchkey = NULL;
    
    
    public function __construct()
    {
        /*
        $tablename = "Funcionario";
        $pkey = "";
        $ativokey = "";
        $searchkey = "";
        echo("teste");
         * */
    }
    
    public function insert($dados)
    {
        $mypdo = new MyPDO();
        
        $keys = [];
        $values = [];
        $gambiarra = []; //Achar uma maneira mais eficiente...
        
        foreach($dados as $key => $value)
        {
            $keys[] = $key;
            $values[] = $value;
            $gambiarra[] = "?";
        }
        $sql = "INSERT INTO ".$this->tablename." (".implode(",",$keys).") VALUES (".implode(",",$gambiarra).")";
        //print($sql);
        $stmt = $mypdo->run($sql,$values);
        //print("<br>.");
        //print_r($stmt->errorInfo());
        //print(".<br>");
        if($stmt->rowCount()>0)
        {
            return $mypdo->lastInsertId();
        }
        else return -1;
    }
    
    function select($id)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->pkey."=?",[$id])->fetch();
        return $row;
    }
    
    function search($nome = "")
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->searchkey." LIKE ?",["%".$nome."%"])->fetchAll();
        return $stmt;
    }
    
    function setActive($id, $ativo = 1)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("UPDATE ".$this->tablename." SET ".$this->ativokey."=? WHERE ".$this->pkey."=?",[$ativo, $id]);
        return $stmt->rowCount();
    }
    
    function update($id, $dados)
    {
        $mypdo = new MyPDO();
        
        $pairs = [];
        $values = [];
        foreach($dados as $key => $value)
        {
            if($key!=$this->pkey)
            {
                $pairs[] = $key."=?";
                $values[] = $value;
            }
        }
        $sql = "UPDATE ".$this->tablename." SET ".implode(",",$pairs)." WHERE ".$this->pkey."=?";
        $values[] = $id;
        $stmt = $mypdo->run($sql,$values);
        return $stmt->rowCount();
    }
    
    function delete($id)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("DELETE FROM ".$this->tablename." WHERE ".$this->pkey."=?",[$id]);
        return $stmt->rowCount();
    }
}
