<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Paciente
 *
 * @author Aluno
 */
class Vacina extends Generic
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->tablename = "Vacina";
        $this->pkey = "vacina_id";
        $this->ativokey = "vacina_ativo";
        $this->searchkey = "vacina_nome";
    }
    
    
    function searchFiltroAtivo($nome = "", $ativo = 1)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->ativokey."=? AND ".$this->searchkey." LIKE ?",[$ativo,"%".$nome."%"])->fetchAll();
        return $stmt;
    }
}