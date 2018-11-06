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
class Medicamento extends Generic
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->tablename = "Medicamento";
        $this->pkey = "medicamento_id";
        $this->ativokey = "medicamento_ativo";
        $this->searchkey = "medicamento_nome";
    }
    
    
    function searchFiltroAtivo($nome = "", $ativo = 1)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->ativokey."=? AND ".$this->searchkey." LIKE ?",[$ativo,"%".$nome."%"])->fetchAll();
        return $stmt;
    }
}