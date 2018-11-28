<?php


class controleLogin extends controleGeral {
        
    function __construct()
    {
        if(isset($_REQUEST['acao']))
        {
            $acao = $this->sanitizarString($_REQUEST['acao']);
            
            if($acao=="login")
            {
                View::includeHeader();
                if(isset($_SESSION['usuario_logado']))
                {
                    print("Logado como: ".$_SESSION['usuario_logado']['funcionario_nome']);
                    print("<br><a href='?pag=login&acao=logout'>Logout</a>");
                }
                else
                {
                    View::formFuncLogin();
                }
                View::includeFooter();
            }
            else if($acao=="logout")
            {
                $_SESSION['usuario_funcionario'] = null; 
                $_SESSION['usuario_paciente'] = null; 
                $_SESSION['usuario_logado'] = null; 
                View::includeHeader();
                View::formFuncLogin();
                View::includeFooter();
            }
            else if($acao=="trocaracesso")
            {
                if(isset($_SESSION['usuario_logado']['funcionario_id']))
                {
                    if(isset($_SESSION['usuario_paciente']))
                    {
                        $_SESSION['usuario_logado'] = $_SESSION['usuario_paciente'];
                        header("Location: index.php");
                    }
                }
                else if(isset($_SESSION['usuario_logado']['paciente_id']))
                {
                    if(isset($_SESSION['usuario_funcionario']))
                    {
                        $_SESSION['usuario_logado'] = $_SESSION['usuario_funcionario'];
                        header("Location: index.php");
                    }
                }
            }
            else if($acao=="validarlogin")
            {
                $cpf = $_POST['cpf'];
                $senha = $_POST['senha'];
                
                $objFunc = new Funcionario();
                $dadosFunc = $objFunc->logar($cpf, $senha);
                
                $objPaci = new Paciente();
                $dadosPaci = $objPaci->logar($cpf, $senha);
                
                $_SESSION['usuario_logado'] = null;
                
                if(isset($dadosPaci['paciente_id']))
                {
                    $_SESSION['usuario_paciente'] = $dadosPaci;
                    $_SESSION['usuario_logado'] = $dadosPaci;
                }
                
                if(isset($dadosFunc['funcionario_id']))
                {
                    $_SESSION['usuario_funcionario'] = $dadosFunc;
                    $_SESSION['usuario_logado'] = $dadosFunc;
                }
                
                
                View::includeHeader();
                if(isset($_SESSION['usuario_logado']))
                {
                    print("<script>location.href='index.php';</script>");
                }
                else
                {
                    print("<script>alert('Credenciais invalidas.'); history.go(-1);</script>");
                }
                View::includeFooter();
            }
            else
            {
                View::includeHeader();
                echo "acao nao encontrada na categoria";
                View::includeFooter();
            }                                  
        }
        else
        {
            View::includeHeader();
            echo "Ação não escolhida";
            View::includeFooter();
            
            
        }        
        
    } // fim do construtor
    
}