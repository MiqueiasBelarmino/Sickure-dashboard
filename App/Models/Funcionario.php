<?php

class Funcionario extends Generic
{
    
    function __construct()
    {
        parent::__construct();
        $this->tablename = "Funcionario";
        $this->pkey = "funcionario_id";
        $this->ativokey = "funcionario_ativo";
        $this->searchkey = "funcionario_nome";
    }
    
    function selectCPF($cpf)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE funcionario_cpf=?",[$cpf])->fetch();
        return $row;
    }
    
    function searchComCargos($nome = "", $ativo = 1)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("SELECT * FROM ".$this->tablename." NATURAL LEFT OUTER JOIN Administrador NATURAL LEFT OUTER JOIN Medico NATURAL LEFT OUTER JOIN Atendente WHERE ".$this->ativokey."=? AND ".$this->searchkey." LIKE ?",[$ativo,"%".$nome."%"])->fetchAll();
        return $stmt;
    }
    
    function resetSenha($id)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->pkey."=?",[$id])->fetch();
        if(isset($row['funcionario_dataNascimento']))
        {
            $dataNasc = $row['funcionario_dataNascimento'];
            $stmt = $mypdo->run("UPDATE ".$this->tablename." SET funcionario_senha=? WHERE ".$this->pkey."=?",[$dataNasc, $id]);
            return $stmt->rowCount();
        }
        else return 0;
    }
    
    function trocaSenha($id, $antiga, $nova)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." WHERE ".$this->pkey."=? AND funcionario_senha=?",[$id,$antiga])->fetch();
        if(isset($row['funcionario_id']))
        {
            $stmt = $mypdo->run("UPDATE ".$this->tablename." SET funcionario_senha=? WHERE ".$this->pkey."=?",[$nova, $id]);
            return $stmt->rowCount();
        }
        else return 0;
    }
}