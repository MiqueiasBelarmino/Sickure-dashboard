<?php


class controleUsuario extends controleGeral {
        
    function __construct()
    {
        if(isset($_REQUEST['acao']))
        {
            $acao = $this->sanitizarString($_REQUEST['acao']);
            
            if($acao=="alterar")
            {
                View::includeHeader();
                if(isset($_REQUEST['cod']))
                {
                    $cod = $_REQUEST['cod'];
                    $obj = new Usuario();
                    $dados = $obj->selecionar($cod);
                    View::formAlteraUser($dados);
                }
                else
                {
                    echo("Codigo não informado.");
                }
                View::includeFooter();
            }
            else if($acao=="alteraconfirm")
            {
                $nome = $_REQUEST['nome'];
                $email = $_REQUEST['email'];
                $cod = $_REQUEST['cod'];
                $obj = new Usuario();
                $dados = $obj->alterar($cod, $nome, $email);
                View::includeHeader();
                if($dados==1) echo("Usuário alterado.");
                else echo("Não foi possivel alterar o Usuário.");
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