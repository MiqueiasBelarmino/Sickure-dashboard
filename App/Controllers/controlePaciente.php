<?php


class controlePaciente extends controleGeral {
        
    function __construct()
    {
        if(isset($_REQUEST['acao']))
        {
            $acao = $this->sanitizarString($_REQUEST['acao']);
            if($acao=="novo")
            {
                View::includeHeader();
                View::formPaciente(null, true);
                View::includeFooter();
            }
            else if($acao=="inserir")
            {
                $dados = Array();
                
                foreach($_REQUEST as $key => $val)
                {
                    
                    if(strpos($key,"paciente_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $funcDB = new Paciente();
                $res = $funcDB->insert($dados);
                View::includeHeader();
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
                    
                    if(strpos($key,"paciente_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $funcDB = new Paciente();
                $res = $funcDB->update($dados['paciente_id'], $dados);
                View::includeHeader();
                /*
                if($res==-1)
                {
                    print("Falha.");
                }
                else print("Alterado.");
                 * */
                View::includeFooter();
            }
            else if($acao=="listar")
            {
                View::includeHeader();
                ?>
                <div class="box no-print ">
                    <div class="box-body">
                    <a href="?pag=paciente&acao=novo" class="btn btn-info pull-left btn-flat">Adicionar Paciente</a>
                    <form action='?pag=paciente&acao=listar' method='post' class="pull-right">
                        <input type="hidden" name='busca' <?php if(isset($_POST['busca'])) print("value='".$_POST['busca']."'"); ?>>
                        <input type='radio' name='ativo' value='1' <?php if(!isset($_POST['ativo']) || $_POST['ativo']==1 ) print("checked"); ?>> Ativo <input type='radio' name='ativo' value='0' <?php if(isset($_POST['ativo']) && $_POST['ativo']==0 ) print("checked"); ?> style="margin-left: 10px"> Inativo
                        <input type="submit" name='buscar' value='Filtrar' class="btn btn-default btn-flat"  style="margin-left:10px">
                    </form>
                    </div>
                </div>

                <div class="box box-default">

                <div class="box-header">
                    <h3 class="box-title">Lista de Pacientes</h3>
                </div>
                    <!-- /.-header -->
                    <div class="box-body">
                        
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Genero</th>
                            <th>Idade</th>
                            <th>Ações</th>  
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $funcDB = new Paciente();
                            if(isset($_POST['busca'])) $res = $funcDB->searchFiltroAtivo($_POST['busca'], $_POST['ativo']);
                            else $res = $funcDB->searchFiltroAtivo();
                            foreach($res as $func)
                            {
                                ?>
                                <tr>
                                    <td style="text-transform: uppercase;"><a href="?pag=paciente&acao=visualizar&id=<?php print($func['paciente_id']) ?>" style="color: green !important;"><?php print($func['paciente_nome']) ?></a></td>
                                    <td><?php print($func['paciente_sexo']) ?></td>
                                    <td>
                                        <?php
                                        $tz  = new DateTimeZone('Europe/Brussels');
                                        $age = DateTime::createFromFormat('Y-m-d', $func['paciente_dataNascimento'], $tz)
                                                ->diff(new DateTime('now', $tz))
                                                ->y;
                                        print($age);
                                        ?>
                                    </td>
                                    <td>
                                        <a href="?pag=paciente&acao=editar&id=<?php print($func['paciente_id']) ?>" class="btn bg-orange btn-flat"><i class="fa fa-pencil"></i> Editar</a>
                                        <a href="?pag=paciente&acao=visualizar&id=<?php print($func['paciente_id']) ?>" class="btn btn-primary btn-flat"><i class="fa fa-eye"> Visualizar</i></a>
                                        <a href="?pag=paciente&acao=desativar&id=<?php print($func['paciente_id']) ?>" class="btn btn-danger btn-flat"><i class="fa fa-power-off"> Inativar</i></a>
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
                            <th>Idade</th>
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
                View::includeHeader();
                $funcDB = new Paciente();
                $res = $funcDB->select($_GET['id']);
                View::formPaciente($res, false);
               
                View::includeFooter();
            }
            else if($acao=="resetarsenha")
            {
                View::includeHeader();
                $funcDB = new Paciente();
                $res = $funcDB->resetSenha($_GET['id']);
                print("A senha do Paciente foi foi resetada.<br><br>Padrão de senha: data de nascimento, no seguinte formato 'AAAA-MM-DD'.");
                View::includeFooter();
            }
            else if($acao=="trocasenha")
            {
                View::includeHeader();
                if(isset($_POST['submit']))
                {
                    if(isset($_POST['novaSenha']) && isset($_POST['novaSenha2']) && isset($_POST['atualSenha']))
                    {
                        if($_POST['novaSenha']==$_POST['novaSenha2'])
                        {
                            $funcDB = new Paciente();
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
                View::includeHeader();
                $funcDB = new Paciente();
                $res = $funcDB->setActive($_GET['id'],0);
                print('<script> location.replace("?pag=paciente&acao=listar"); </script>');
                View::includeFooter();
            }
            else if($acao=="ativar")
            {
                View::includeHeader();
                $funcDB = new Paciente();
                $res = $funcDB->setActive($_GET['id'],1);
                print('<script> location.replace("?pag=paciente&acao=listar"); </script>');
                View::includeFooter();
            }
            else if($acao=="trocasenha")
            {
                
            }
            else if($acao=="editar")
            {
                View::includeHeader();
                $funcDB = new Paciente();
                $res = $funcDB->select($_GET['id']);
                View::formPaciente($res, true);
                ?>
                    <a href="?pag=paciente&acao=visualizar&id=<?php print($_GET['id'])?>">Cancelar</a>
                <?php
                View::includeFooter();
            }
            
            
            
            else if($acao=="login")
            {
                View::includeHeader();
                View::formFuncLogin();
                View::includeFooter();
            }
            else if($acao=="validarlogin")
            {
                $email = $_REQUEST['email'];
                $senha = $_REQUEST['senha'];
                $obj = new Paciente();
                $dados = $obj->logar($email, $senha);
                View::includeHeader();
                if($dados[1]==1) echo("Logado.");
                else echo("Credenciais Inválidas.");
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