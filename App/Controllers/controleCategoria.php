<?php


class controleCategoria extends controleGeral {
        
    function __construct() {
    
        if(isset($_REQUEST['acao'])){
            $acao = $this->sanitizarString($_REQUEST['acao']);
            
            if($acao == "listar"){
                //echo("Em desevenvolvimento");  
                //print_r($_SERVER);
                $obj = new Categoria();
                if (isset($_REQUEST['cat']))
                {
                    $dados = $obj->listar($_REQUEST['cat']);
                }
                else
                {
                    $dados = $obj->listar('');
                }
                View::includeHeader();
                ?>
                <form action='?pag=categoria' method='post'>
                    <label for="categoria">Categoria</label>
                    <input type="text" name='cat' value=''>
                    <button type="submit" name="acao" value="listar" > Buscar</button>
                    <button type="submit" name="acao" value="inserir" > Novo </button>
                </form>
                <?php
                View::montarTabelaCategorias($dados);
                View::includeFooter();
                /*
                foreach($dados as $indice => $val)
                {
                    echo("<br><br> $indice = ");
                    print_r($val);
                }
                 * */
                 
                //print_r($dados);
                
            } else if ($acao == "pesquisar"){
                
                
            } else if ($acao == "excluir"){
                $cod = $_REQUEST['cod'];
                $obj = new Categoria();
                $dados = $obj->deletar($cod);
                $redirect = "?pag=categoria&acao=listar";
                header("location:$redirect");
                
            } else if ($acao == "inserir"){
                $desc = $_REQUEST['cat'];
                $obj = new Categoria();
                $dados = $obj->inserir($desc);
                $redirect = "?pag=categoria&acao=listar";
                header("location:$redirect");
                
            } else if ($acao == "novo"){
                // exibir formulario para preenchimento de nova categoria
                
            } else if ($acao == "alterar") {
                $cod = $_REQUEST['cod'];
                $obj = new Categoria();
                $dados = $obj->selecionar($cod);
                View::includeHeader();
                View::montarFormAlterarCat($dados);
                View::includeFooter();
                
            } else if ($acao == "confirmalt"){
                $cod = $_REQUEST['cod'];
                $descricao = $_REQUEST['descricao'];
                $obj = new Categoria();
                $dados = $obj->alterar($cod,$descricao);
                $redirect = "?pag=categoria&acao=listar";
                header("location:$redirect");
                
            } else if ($acao == "seila") {
                
            } else if ($acao == "incluir"){
                // fazer a insercao no banco
                
                
            } else{                
              echo "acao nao encontrada na categoria";              
              // ..
              
            }                                  
        } else{
            $redirect = "?pag=categoria&acao=listar";
                header("location:$redirect");
            
        }        
        
    } // fim do construtor
    
}