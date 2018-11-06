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
class LoteMedicamento extends Generic
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->tablename = "LoteMedicamento";
        $this->pkey = "mlote_codigo";
        $this->ativokey = "mlote_ativo";
        $this->searchkey = "medicamento_id";
    }
    
    
    function searchPorMedicamentos($medicamento_id, $ativo = 1)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->ativokey."=? AND ".$this->searchkey."=? ORDER BY mlote_vencimento",[$ativo,$medicamento_id])->fetchAll();
        return $stmt;
    }
    
    function selectLote($medicamento_id, $mlote_codigo)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->pkey."=? AND medicamento_id=?",[$mlote_codigo,$medicamento_id])->fetch();
        return $row;
    }
    
    function setActiveLote($medicamento_id, $mlote_cod, $ativo = 1)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("UPDATE ".$this->tablename." SET ".$this->ativokey."=? WHERE ".$this->pkey."=? AND medicamento_id=?",[$ativo, $mlote_cod,$medicamento_id]);
        return $stmt->rowCount();
    }
    
    function mudaEstoque($medicamento_id, $mlote_codigo, $diff)
    {
        $sql = "UPDATE ".$this->tablename." SET mlote_qtd=mlote_qtd+? WHERE ".$this->pkey."=? AND medicamento_id=?";
        $stmt = $mypdo->run($sql,[$diff,$mlote_codigo,$medicamento_id]);
        return $stmt->rowCount();
    }
    
    function updateLote($medicamento_id, $cod, $dados)
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
        $sql = "UPDATE ".$this->tablename." SET ".implode(",",$pairs)." WHERE ".$this->pkey."=? AND medicamento_id=?";
        $values[] = $cod;
        $values[] = $medicamento_id;
        $stmt = $mypdo->run($sql,$values);
        return $stmt->rowCount();
    }
}