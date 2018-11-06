<?php

session_start();    // habilitando uso de sessao

// controllers
require_once './App/Controllers/controleGeral.php';
require_once './App/Controllers/controleFuncionario.php';
require_once './App/Controllers/controlePaciente.php';
require_once './App/Controllers/controleVacina.php';
require_once './App/Controllers/controleMedicamento.php';
require_once './App/Controllers/controleVacinacao.php';
require_once './App/Controllers/controleConsulta.php';
require_once './App/Controllers/controleRelatorios.php';
require_once './App/Controllers/controleLogin.php';

// models
require_once './App/Models/MyPDO.php';
require_once './App/Models/Generic.php';
require_once './App/Models/Funcionario.php';
require_once './App/Models/Paciente.php';
require_once './App/Models/Vacina.php';
require_once './App/Models/LoteVacina.php';
require_once './App/Models/Medicamento.php';
require_once './App/Models/LoteMedicamento.php';
require_once './App/Models/CarteiraVacinacao.php';
require_once './App/Models/Consulta.php';

// views
require_once './App/Views/View.php';

// http://localhost/BibDW2/index.php
// http://localhost/BibDW2/?pag=categoria&acao=incluir
// http://localhost/BibDW2/?pag=categoria&acao=pesquisar&cod=1234

if( ! isset($_REQUEST['pag']) ){  // Ex:  http://localhost/BibDW2/index.php
    $nome_ctrl = "controleGeral";        
} else {    
    //Ex:  http://localhost/BibDW2/?pag=categoria
    $nome_ctrl = "controle". ucfirst(htmlspecialchars(trim($_REQUEST["pag"]))); // Ex: controleCategoria
}

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
//echo "Nome do controle a ser chamado: $nome_ctrl <br>";
$obj = new $nome_ctrl();


// testes
// $obj1 =  new Categoria();
// $obj1 -> conectarBanco();


