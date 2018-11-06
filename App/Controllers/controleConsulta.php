<?php


class controleConsulta extends controleGeral {
        
    function __construct()
    {
        if(isset($_REQUEST['acao']))
        {
            $acao = $this->sanitizarString($_REQUEST['acao']);
            
            if($acao=="novo")
            {
                View::includeHeader();
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
                    
                    if(strpos($key,"funcionario_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $funcDB = new Funcionario();
                $res = $funcDB->update($dados['funcionario_id'], $dados);
                View::includeHeader();
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
            else if($acao=="listarpacientes")
            {
                View::includeHeader();
                ?>
                <div class="box box-primary">
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
                            <th>Ação</th>  
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
                                    <td style="text-transform: uppercase;"><a href="?pag=consulta&acao=visualizarpaciente&paciente_id=<?php print($func['paciente_id']) ?>" style="color: green !important;"><?php print($func['paciente_nome']) ?></a></td>
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
                                        <a href="?pag=consulta&acao=visualizarpaciente&paciente_id=<?php print($func['paciente_id']) ?>" class="btn btn-primary btn-flat"><i class="fa fa-arrow-right"></i></a>
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
                            <th>Ação</th>
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
            
            else if($acao=="excluir")
            {
                if(isset($_GET['consulta_id']))
                {
                    $useDB = new Consulta();
                    $res = $useDB->delete($_GET['consulta_id']);
                    Header('location: '.$_SESSION['return_url']);
                }
            }
            
            else if($acao=="visualizarpaciente")
            {
                View::includeHeader();
                ?>
                <div class="box box-default  box-solid" data-widget="box-widget">
                <div class="box-header">
                    <h3 class="box-title">
                        <?php
                            $funcDB = new Paciente();
                            $res = $funcDB->select($_GET['paciente_id']);
                            print("Paciente: " . $res['paciente_nome']);
                        ?>
                    </h3>
                    <div class="box-tools">
                    <!-- This will cause the box to be removed when clicked -->
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    <!-- This will cause the box to collapse when clicked -->
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <a href="?pag=consulta&acao=agendarconsultar&paciente_id=<?php print($_GET['paciente_id'])?>" class="btn btn-info">Agendar consulta</a>
                </div>
                </div>

                <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Consultas</h3>
                </div>
                    <!-- /.-header -->
                    <div class="box-body">
                        
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Medico</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $_SESSION['return_url'] = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
                            $funcDBConsultas = new Consulta();
                            $consultas = $funcDBConsultas->searchPorPaciente($_GET['paciente_id']);
                            foreach($consultas as $cons)
                            {
                                $tipo = $cons['consulta_tipo'];
                                if($tipo==2)
                                {
                                    print("<tr>");
                                    print("<td>".$cons['consulta_data']."</td>");
                                    print("<td>".$cons['consulta_desc']."</td>");
                                    print("<td>".$cons['funcionario_nome']."</td>");
                                    print("<td><table><tr>");
                                    //print("<td><a href=''>Vacinar</a></td>"); http://localhost/cesar/?pag=consulta&acao=vacinar&vacina_id=1&paciente_id=1
                                    print("<td><a href='?pag=consulta&acao=consultar&consulta_id=".$cons['consulta_id']."'>Confirmar</a></td>");
                                    print("<td><a href='?pag=consulta&acao=excluir&consulta_id=".$cons['consulta_id']."'>Cancelar</a></td>");
                                    print("</tr></table>");
                                    print("</tr>");
                                }
                            }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Medico</th>
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
            else if($acao=="agendarconsultar")
            {
                View::includeHeader();
                if(isset($_POST['submit']))
                {
                    $dados = [];
                    if(isset($_GET['paciente_id']))
                    {
                        $dados['paciente_id'] = $_GET['paciente_id'];
                        if(isset($_POST['consulta_data']))
                        {
                            $dados['consulta_data'] = $_POST['consulta_data'];
                            if(isset($_POST['funcionario_id']))
                            {
                                if($_POST['funcionario_id']!=-1) $dados['funcionario_id'] = $_POST['funcionario_id'];
                                if(isset($_POST['consulta_desc']))
                                {
                                    $dados['consulta_desc'] = $_POST['consulta_desc'];
                                    $dados['consulta_tipo'] = 2;
                                    $useDB = new Consulta();
                                    $res = $useDB->insert($dados);
                                    Header('location: '.$_SESSION['return_url']);
                                }
                            }
                        }
                    }
                }
                else
                {
                    View::consultaAgendarForm($_GET['paciente_id']);
                    print("Hello!");
                }
                
                View::includeFooter();
            }
            else if($acao=="consultar")
            {
                View::includeHeader();
                print("Função não implementada.");
                View::includeFooter();
            }
            
            
            else if($acao=="editar")
            {
                View::includeHeader();
                $funcDB = new Funcionario();
                $res = $funcDB->select($_GET['id']);
                View::formFuncionario($res, true);
                ?>
                    <a href="?pag=funcionario&acao=visualizar&id=<?php print($_GET['id'])?>">Cancelar</a>
                <?php
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