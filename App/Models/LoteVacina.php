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
class LoteVacina extends Generic
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->tablename = "LoteVacina";
        $this->pkey = "vlote_codigo";
        $this->ativokey = "vlote_ativo";
        $this->searchkey = "vacina_id";
    }
    
    
    function searchPorVacinas($vacina_id, $ativo = 1)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->ativokey."=? AND ".$this->searchkey."=? ORDER BY vlote_vencimento",[$ativo,$vacina_id])->fetchAll();
        return $stmt;
    }
    
    function selectLote($vacina_id, $vlote_codigo)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->pkey."=? AND vacina_id=?",[$vlote_codigo,$vacina_id])->fetch();
        return $row;
    }
    
    function setActiveLote($vacina_id, $vlote_cod, $ativo = 1)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("UPDATE ".$this->tablename." SET ".$this->ativokey."=? WHERE ".$this->pkey."=? AND vacina_id=?",[$ativo, $vlote_cod,$vacina_id]);
        return $stmt->rowCount();
    }
    
    function mudaEstoque($vacina_id, $vlote_codigo, $diff)
    {
        $sql = "UPDATE ".$this->tablename." SET vlote_qtd=vlote_qtd+? WHERE ".$this->pkey."=? AND vacina_id=?";
        $stmt = $mypdo->run($sql,[$diff,$vlote_codigo,$vacina_id]);
        return $stmt->rowCount();
    }
    
    function updateLote($vacina_id, $cod, $dados)
    {
        $mypdo = new MyPDO();
        
        $pairs = [];
        $values = [];
        foreach($dados as $key => $value)
        {
            //if($key!=$this->pkey)
            //{
                $pairs[] = $key."=?";
                $values[] = $value;
            //}
        }
        $sql = "UPDATE ".$this->tablename." SET ".implode(",",$pairs)." WHERE ".$this->pkey."=? AND vacina_id=?";
        $values[] = $cod;
        $values[] = $vacina_id;
        $stmt = $mypdo->run($sql,$values);
        return $stmt->rowCount();
    }
}