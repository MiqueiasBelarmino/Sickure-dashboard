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
                $_SESSION['usuario_logado'] = null; 
                View::includeHeader();
                View::formFuncLogin();
                View::includeFooter();
            }
            else if($acao=="validarlogin")
            {
                $cpf = $_POST['cpf'];
                $senha = $_POST['senha'];
                $obj = new Funcionario();
                $dados = $obj->logar($cpf, $senha);
                View::includeHeader();
                if(isset($dados['funcionario_id']))
                {
                    $_SESSION['usuario_logado'] = $dados;
                    print("<script>location.href='index.php';</script>");
                }
                else
                {
                    $_SESSION['usuario_logado'] = null;
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