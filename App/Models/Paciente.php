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
class Paciente extends Generic
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->tablename = "Paciente";
        $this->pkey = "paciente_id";
        $this->ativokey = "paciente_ativo";
        $this->searchkey = "paciente_nome";
    }
    
    function selectCPF($cpf)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE paciente_cpf=?",[$cpf])->fetch();
        return $row;
    }
    
    function searchFiltroAtivo($nome = "", $ativo = 1)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->ativokey."=? AND ".$this->searchkey." LIKE ?",[$ativo,"%".$nome."%"])->fetchAll();
        return $stmt;
    }
    
    function resetSenha($id)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->pkey."=?",[$id])->fetch();
        if(isset($row['paciente_dataNascimento']))
        {
            $dataNasc = $row['paciente_dataNascimento'];
            $stmt = $mypdo->run("UPDATE ".$this->tablename." SET paciente_senha=? WHERE ".$this->pkey."=?",[$dataNasc, $id]);
            return $stmt->rowCount();
        }
        else return 0;
    }
    
    function trocaSenha($id, $antiga, $nova)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->pkey."=? AND paciente_senha=?",[$id,$antiga])->fetch();
        if(isset($row['paciente_id']))
        {
            $stmt = $mypdo->run("UPDATE ".$this->tablename." SET paciente_senha=? WHERE ".$this->pkey."=?",[$nova, $id]);
            return $stmt->rowCount();
        }
        else return 0;
    }
    
    function logar($cpf, $senha)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->ativokey."=1 AND paciente_cpf=? AND paciente_senha=?",[$cpf,$senha])->fetch();
        return $row;
    }
    
    
    function buscaCompleta($busca) //Nome, CPF, SUS, RG
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE paciente_nome LIKE ? OR paciente_cpf LIKE ? OR paciente_rg LIKE ? OR paciente_cartaoSus LIKE ?",["%".$busca."%","%".$busca."%","%".$busca."%","%".$busca."%"])->fetchAll();
        return $stmt;
    }
}