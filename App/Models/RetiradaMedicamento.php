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
class RetiradaMedicamento extends Generic
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->tablename = "RetiradaMedicamento";
        $this->pkey = "rmedicamento_id";
        $this->ativokey = "rmedicamento_ativo";
        $this->searchkey = "medicamento_id";
    }
    
}