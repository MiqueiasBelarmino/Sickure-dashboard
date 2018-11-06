<?php


class controleFuncionario extends controleGeral {
        
    function __construct()
    {
        if(isset($_REQUEST['acao']))
        {
            $acao = $this->sanitizarString($_REQUEST['acao']);
            
            if($acao=="teste")
            {
                View::includeHeader("Funcionário");
                $funcDB = new Funcionario();
                
                $dados = Array(
                    "funcionario_nome" => "Cesar",
                    "funcionario_cpf" => "33207152866",
                    "funcionario_senha" => "123",
                    "funcionario_rg" => "321",
                    "funcionario_dataNascimento" => "1994-06-11",
                    "funcionario_sexo" => "M",
                    "funcionario_logradouro" => "seila",
                    "funcionario_numero" => "32",
                    "funcionario_bairro" => "Cent",
                    "funcionario_cidade" => "Pep",
                    "funcionario_cep" => "19470000",
                    "funcionario_telefone" => "997721106",
                    "funcionario_celular" => "997721106"
                    
                );
                
                $res = $funcDB->insert($dados);
                
                print_r($res);
                View::includeFooter();
            }
            

            else if($acao=="novo")
            {
                View::includeHeader("Funcionário");
                View::formFuncionario(null, true);
                View::includeFooter();
            }
            else if($acao=="inserir")
            {
                $dados = Array();
                
                foreach($_REQUEST as $key => $val)
                {
                    
                    if(strpos($key,"funcionario_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $funcDB = new Funcionario();
                $res = $funcDB->insert($dados);
                View::includeHeader("Funcionário");
                if($res==-1)
                {
                    print("Falha.");
                }
                else print("Inserido.");
                View::includeFooter();
            }
            else if($acao=="alterar")
            {
                $dados = Array();
                
                foreach($_REQUEST as $key => $val)
                {
                    
                    if(strpos($key,"funcionario_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $funcDB = new Funcionario();
                $res = $funcDB->update($dados['funcionario_id'], $dados);
                View::includeHeader("Funcionário");
                /*
                if($res==-1)
                {
                    print("Falha.");
                }
                else print("Alterado.");
                 * */
                 print_r($res);
                View::includeFooter();
            }
            else if($acao=="listar")
            {
                View::includeHeader("Funcionário");
                ?>
               <div class="box no-print bg-navy">
                    <div class="box-body">
                    <a href="?pag=funcionario&acao=novo" class="btn btn-success btn-flat pull-left">Adicionar Funcionário</a>
                    <form action='?pag=funcionario&acao=listar' method='post' class="pull-right">
                        <input type="hidden" name='busca' <?php if(isset($_POST['busca'])) print("value='".$_POST['busca']."'"); ?>>
                        <input type='radio' name='ativo' value='1' <?php if(!isset($_POST['ativo']) || $_POST['ativo']==1 ) print("checked"); ?>> Ativo 
                        <input type='radio' name='ativo' value='0' <?php if(isset($_POST['ativo']) && $_POST['ativo']==0 ) print("checked"); ?> style="margin-left: 10px"> Inativo
                        <input type="submit" name='buscar' value='Filtrar' class="btn btn-flat btn-default" style="margin-left:10px">
                    </form>
                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">Lista de Funcionários</h3>
                    </div>
                        <!-- /.-header -->
                        <div class="box-body">
                            
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>Nome</th>
                            <th>Genero</th>
                            <th>Atendente</th>
                            <th>Médico</th>
                            <th>Administrador</th>  
                            <th>Ações</th>  
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $funcDB = new Funcionario();
                                if(isset($_POST['busca'])) $res = $funcDB->searchComCargos("",$_POST['ativo']);
                                else $res = $funcDB->searchComCargos();
                                foreach($res as $func)
                                {
                                    ?>
                                    <tr>
                                        <td style="text-transform: uppercase;"><a href="?pag=funcionario&acao=visualizar&id=<?php print($func['funcionario_id']) ?>" style="color: green !important;"><?php print($func['funcionario_nome']) ?></a></td>
                                        <td><?php print($func['funcionario_sexo']) ?></td>
                                        <td><?php if(isset($func['atendente_ativo'])) print("Sim"); else print("Não");?></td>
                                        <td><?php if(isset($func['medico_ativo'])) print("Sim"); else print("Não");?></td>
                                        <td><?php if(isset($func['administrador_ativo'])) print("Sim"); else print("Não");?></td>
                                        <td>
                                            
                                        <a href="?pag=funcionario&acao=editar&id=<?php print($func['funcionario_id']) ?>" class="btn bg-orange btn-flat"><i class="fa fa-pencil"></i></a>
                                        <a href="?pag=funcionario&acao=desativar&id=<?php print($func['funcionario_id']) ?>" class="btn btn-danger btn-flat"><i class="fa fa-power-off"></i></a>
                                        <a href="?pag=funcionario&acao=visualizar&id=<?php print($func['funcionario_id']) ?>" class="btn btn-primary btn-flat"><i class="fa fa-eye"></i></a>
                                            
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>Nome</th>
                            <th>Genero</th>
                            <th>Atendente</th>
                            <th>Médico</th>
                            <th>Administrador</th>
                            <th>Ações</th>
                            </tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- /.-body -->
                    </div>
                </table>
                <?php
                 View::includeFooter();
            }
            
            else if($acao=="visualizar")
            {
                View::includeHeader("Funcionário");
                $funcDB = new Funcionario();
                $res = $funcDB->select($_GET['id']);
                View::formFuncionario($res, false);
                View::includeFooter();
            }
            else if($acao=="resetarsenha")
            {
                View::includeHeader("Funcionário");
                $funcDB = new Funcionario();
                $res = $funcDB->resetSenha($_GET['id']);
                print("A senha do Funcionario foi foi resetada.<br><br>Padrão de senha: data de nascimento, no seguinte formato 'AAAA-MM-DD'.");
                View::includeFooter();
            }
            else if($acao=="trocasenha")
            {
                View::includeHeader("Funcionário");
                if(isset($_POST['submit']))
                {
                    if(isset($_POST['novaSenha']) && isset($_POST['novaSenha2']) && isset($_POST['atualSenha']))
                    {
                        if($_POST['novaSenha']==$_POST['novaSenha2'])
                        {
                            $funcDB = new Funcionario();
                            $res = $funcDB->trocaSenha($_GET['id'],$_POST['atualSenha'],$_POST['novaSenha']);
                            if($res==0) print("Senha atual incorreta.");
                            else print("Senha trocada com sucesso.");
                        }
                        else print("As senhas não são iguais.");
                    }
                    
                }
                else
                {
                    View::funcTrocaSenhaForm($_GET['id']);
                }
                View::includeFooter();
                
            }
            else if($acao=="desativar")
            {
                View::includeHeader("Funcionário");
                $funcDB = new Funcionario();
                $res = $funcDB->setActive($_GET['id'],0);
                header('Location: '.$_SERVER['PHP_SELF']."?pag=funcionario&acao=listar");
                View::includeFooter();
            }
            else if($acao=="ativar")
            {
                View::includeHeader("Funcionário");
                $funcDB = new Funcionario();
                $res = $funcDB->setActive($_GET['id'],1);
                header('Location: '.$_SERVER['PHP_SELF']."?pag=funcionario&acao=listar");
                View::includeFooter();
            }
            else if($acao=="trocasenha")
            {
                
            }
            else if($acao=="editar")
            {
                View::includeHeader("Funcionário");
                $funcDB = new Funcionario();
                $res = $funcDB->select($_GET['id']);
                View::formFuncionario($res, true);
                View::includeFooter();
            }
            
            
            
            else if($acao=="login")
            {
                View::includeHeader("Funcionário");
                View::formFuncLogin();
                View::includeFooter();
            }
            else if($acao=="validarlogin")
            {
                $email = $_REQUEST['email'];
                $senha = $_REQUEST['senha'];
                $obj = new Funcionario();
                $dados = $obj->logar($email, $senha);
                View::includeHeader("Funcionário");
                if($dados[1]==1) echo("Logado.");
                else echo("Credenciais Inválidas.");
                View::includeFooter();
            }
            else
            {
                View::includeHeader("Funcionário");
                echo "acao nao encontrada na categoria";
                View::includeFooter();
            }                                  
        }
        else
        {
            View::includeHeader("Funcionário");
            echo "Ação não escolhida";
            View::includeFooter();
            
            
        }        
        
    } // fim do construtor
    
}