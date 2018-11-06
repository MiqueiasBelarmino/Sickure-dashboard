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
	
	function selectComCargos($id)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." NATURAL LEFT OUTER JOIN Administrador NATURAL LEFT OUTER JOIN Medico NATURAL LEFT OUTER JOIN Atendente WHERE funcionario_id=?",[$id])->fetch();
        return $row;
    }
	
	function selectCPFComCargos($cpf)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." NATURAL LEFT OUTER JOIN Administrador NATURAL LEFT OUTER JOIN Medico NATURAL LEFT OUTER JOIN Atendente WHERE funcionario_cpf=?",[$cpf])->fetch();
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

    function searchMedicos($nome = "", $ativo = 1)
    {
        $mypdo = new MyPDO();
        $stmt = $mypdo->run("SELECT * FROM ".$this->tablename." NATURAL JOIN Medico WHERE ".$this->ativokey."=? AND ".$this->searchkey." LIKE ?",[$ativo,"%".$nome."%"])->fetchAll();
        return $stmt;
    }

    function logar($cpf, $senha)
    {
        $mypdo = new MyPDO();
        $row = $mypdo->run("SELECT * FROM ".$this->tablename." NATURAL LEFT OUTER JOIN Administrador NATURAL LEFT OUTER JOIN Medico NATURAL LEFT OUTER JOIN Atendente WHERE ".$this->ativokey."=1 AND funcionario_cpf=? AND funcionario_senha=? AND funcionario_ativo=1",[$cpf,$senha])->fetch();
        return $row;
    }
	
	function setCargo($funcionario_id, $cargo) //$cargo['cargo'] = "medico"; $cargo['crm'] = 432423;
	{
		$mypdocargs = new MyPDO();
        $atual = $mypdocargs->run("SELECT * FROM ".$this->tablename." NATURAL LEFT OUTER JOIN Administrador NATURAL LEFT OUTER JOIN Medico NATURAL LEFT OUTER JOIN Atendente WHERE funcionario_id=?",[$funcionario_id])->fetch();
		if(isset($atual['administrador_ativo']) && $cargo['cargo']!="administrador")
		{
			$sql = "UPDATE Administrador SET administrador_ativo=0 WHERE funcionario_id=?";
			$stmt = $mypdocargs->run($sql,[$funcionario_id]);
		}
		if(isset($atual['medico_ativo']) && $cargo['cargo']!="medico")
		{
			$sql = "UPDATE Medico SET medico_ativo=0 WHERE funcionario_id=?";
			$stmt = $mypdocargs->run($sql,[$funcionario_id]);
		}
		if(isset($atual['atendente_ativo']) && $cargo['cargo']!="atendente")
		{
			$sql = "UPDATE Atendente SET atendente_ativo=0 WHERE funcionario_id=?";
			$stmt = $mypdocargs->run($sql,[$funcionario_id]);
		}
		if($cargo['cargo']=="administrador")
		{
			if(isset($atual['administrador_ativo']))
			{
				$sql = "UPDATE Administrador SET administrador_ativo=1, administrador_nivel=3 WHERE funcionario_id=?";
				$stmt = $mypdocargs->run($sql,[$funcionario_id]);
			}
			else
			{
				$sql = "INSERT INTO Administrador (funcionario_id, administrador_ativo, administrador_nivel) VALUES (?,1,3)";
				$stmt = $mypdocargs->run($sql,[$funcionario_id]);
			}
		}
		
		if($cargo['cargo']=="medico")
		{
			if(isset($atual['medico_ativo']))
			{
				$sql = "UPDATE Medico SET medico_ativo=1, medico_crm=? WHERE funcionario_id=?";
				$stmt = $mypdocargs->run($sql,[$cargo['crm'],$funcionario_id]);
			}
			else
			{
				$sql = "INSERT INTO Medico (funcionario_id, medico_ativo, medico_crm) VALUES (?,1,?)";
				$stmt = $mypdocargs->run($sql,[$funcionario_id,$cargo['crm']]);
			}
		}
		
		if($cargo['cargo']=="atendente")
		{
			if(isset($atual['atendente_ativo']))
			{
				$sql = "UPDATE Atendente SET atendente_ativo=1 WHERE funcionario_id=?";
				$stmt = $mypdocargs->run($sql,[$funcionario_id]);
			}
			else
			{
				$sql = "INSERT INTO Atendente (funcionario_id, atendente_ativo) VALUES (?,1)";
				$stmt = $mypdocargs->run($sql,[$funcionario_id]);
			}
		}
		return $stmt->rowCount();
	}
}