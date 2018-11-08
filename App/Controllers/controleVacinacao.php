<?php


class controleVacinacao extends controleGeral {
        
    function __construct()
    {
        if(isset($_REQUEST['acao']))
        {
            $acao = $this->sanitizarString($_REQUEST['acao']);
            
            if($acao=="teste")
            {
                View::includeHeader();
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
                    print("<script>alert('Falha.');setTimeout(function(){history.go(-2);}, 0);</script>");
                }
                else print("<script>setTimeout(function(){history.go(-1);}, 0);</script>");
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
                                    <td style="text-transform: uppercase;"><a href="?pag=vacinacao&acao=visualizarpaciente&paciente_id=<?php print($func['paciente_id']) ?>" style="color: green !important;"><?php print($func['paciente_nome']) ?></a></td>
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
                                        <a href="?pag=vacinacao&acao=visualizarpaciente&paciente_id=<?php print($func['paciente_id']) ?>" class="btn btn-flat btn-primary btn-flat"><i class="fa fa-arrow-right"></i> Selecionar</a>
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
                if(isset($_GET['paciente_id']))
                {
                    if(isset($_GET['vacina_id']))
                    {
                        if(isset($_GET['cvac_data']))
                        {
                            $funcDBVacinas = new CarteiraVacinacao();
                            $vacinas = $funcDBVacinas->deleteCarteira($_GET['paciente_id'], $_GET['vacina_id'], $_GET['cvac_data']);
                            print("<script> location.replace('?pag=vacinacao&acao=visualizarpaciente&paciente_id=".$_GET['paciente_id']."'); </script>");
                        }
                    }
                }
            }
            
            else if($acao=="visualizarpaciente")
            {
                View::includeHeader();
                //View::formPaciente($res, false);
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
                    <button class="btn btn-flat btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    <!-- This will cause the box to collapse when clicked -->
                    <button class="btn btn-flat btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <a href="?pag=vacinacao&acao=vacinar&paciente_id=<?php print($_GET['paciente_id'])?>" class="btn btn-flat btn-info">Aplicar vacina</a>
                    <a href="?pag=vacinacao&acao=agendarvacinar&paciente_id=<?php print($_GET['paciente_id'])?>" class="btn btn-flat btn-info">Agendar vacina</a>
                    <a href="?pag=vacinacao&acao=registrarvacinar&paciente_id=<?php print($_GET['paciente_id'])?>" class="btn btn-flat btn-info">Registrar vacina</a>
                </div>
                </div>

                <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Agendamentos</h3>
                </div>
                    <!-- /.-header -->
                    <div class="box-body">
                        
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Vacina</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $funcDBVacinas = new CarteiraVacinacao();
                        $vacinas = $funcDBVacinas->searchPorPaciente($_GET['paciente_id']);
                        foreach($vacinas as $vacinada)
                        {
                            $tipo = $vacinada['cvac_tipo'];
                            if($tipo==2)
                            {
                                print("<tr>");
                                print("<td>".$vacinada['cvac_data']."</td>");
                                print("<td>".$vacinada['vacina_nome']."</td>");
                                print("<td><table><tr>");
                                //print("<td><a href=''>Vacinar</a></td>"); http://localhost/cesar/?pag=vacinacao&acao=vacinar&vacina_id=1&paciente_id=1
                                print("<td><a href='?pag=vacinacao&acao=vacinar&vacina_id=".$vacinada['vacina_id']."&paciente_id=".$vacinada['paciente_id']."&cvac_data=".$vacinada['cvac_data']."'class='btn btn-flat btn-primary'><i class='fa fa-eyedropper'></i>  Vacinar</a>");
                                print(" <a href='?pag=vacinacao&acao=excluir&vacina_id=".$vacinada['vacina_id']."&paciente_id=".$vacinada['paciente_id']."&cvac_data=".$vacinada['cvac_data']."'class='btn btn-flat btn-danger'><i class='fa fa-close'></i> Cancelar</a></td>");
                                print("</tr></table>");
                                print("</tr>");
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Data</th>
                            <th>Vacina</th>
                            <th>Ações</th>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                    <!-- /.-body -->
                </div>
                </table>

                <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Carteira de Vacinação</h3>
                </div>
                    <!-- /.-header -->
                    <div class="box-body">
					
					<?php
                        $funcDBVacinas = new CarteiraVacinacao();
                        $vacinas = $funcDBVacinas->searchPorPaciente($_GET['paciente_id']);
						$idcheck = -1;
                        foreach($vacinas as $vacinada)
                        {
                            $tipo = $vacinada['cvac_tipo'];
                            if($tipo!=2)
                            {
								if($vacinada['vacina_id']!=$idcheck)
								{
									if($idcheck!=-1) print("<tbody></table>");
									$idcheck = $vacinada['vacina_id'];
									print("<br><br><p><strong><font size='+2'>".$vacinada['vacina_nome']."</font></strong></p>");
									print("<table class='table table-bordered table-striped'>");
									?>
										<thead>
										<tr>
											<th>Data</th>
											<th>Lote</th>
											<th>Tipo</th>
											<th>Resposavel</th>
											<th>Ações</th>
										</tr>
										</thead>
										<tbody>
									<?php
								}
								
                                print("<tr>");
                                print("<td>".$vacinada['cvac_data']."</td>");
                                print("<td>".$vacinada['vlote_codigo']."</td>");
                                if($vacinada['cvac_tipo']==0) print("<td>Faltou</td>");
                                else if($vacinada['cvac_tipo']==1) print("<td>Realizado</td>");
                                else if($vacinada['cvac_tipo']==2) print("<td><a href=''>Agendamento</a></td>");
                                else if($vacinada['cvac_tipo']==3) print("<td>Preenchimento</td>");
                                else print("<td>???</td>");
                                print("<td>".$vacinada['funcionario_nome']."</td>");
                                print("<td><a href='?pag=vacinacao&acao=excluir&vacina_id=".$vacinada['vacina_id']."&paciente_id=".$vacinada['paciente_id']."&cvac_data=".$vacinada['cvac_data']."'class='btn btn-flat btn-danger'><i class='fa fa-trash'></i> Excluir</a></td>");
                                print("</tr>");
                            }
                        }
					?>
					
                </div>
                </table>
                <?php
                View::includeFooter();
            }
            else if($acao=="vacinar" || $acao=="agendarvacinar" || $acao=="registrarvacinar")
            {
                View::includeHeader();
                if(!isset($_GET['vacina_id']))
                {
                    ?>
                    <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">Vacinas</h3>
                    </div>
                        <!-- /.-header -->
                        <div class="box-body">
                            
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Vacina</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $funcDB = new Vacina();
                            if(isset($_POST['busca'])) $res = $funcDB->searchFiltroAtivo($_POST['busca'], 1);
                            else $res = $funcDB->searchFiltroAtivo();
                            foreach($res as $func)
                            {
                                ?>
                                <tr>
                                    <td><a href="?pag=vacinacao&acao=<?php print($acao); ?>&vacina_id=<?php print($func['vacina_id'].'&paciente_id='.$_GET['paciente_id']) ?>"><?php print($func['vacina_nome']) ?></a></td>
                                    <td><a href="?pag=vacinacao&acao=<?php print($acao); ?>&vacina_id=<?php print($func['vacina_id'].'&paciente_id='.$_GET['paciente_id']) ?>" class="btn btn-flat btn-primary btn-flat"><i class="fa fa-arrow-right"></i> Selecionar</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Vacina</th>
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
                else if(!isset ($_GET['vlote_codigo']) && $acao=="vacinar")
                {
                    
                    
                    
                    $dataagora = date_create(date('Y-m-d', time()));
                    $loteVaDB = new LoteVacina();
                    $res = $loteVaDB->searchPorVacinas($_GET['vacina_id']);
                    ?>
                    <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">Consultas</h3>
                    </div>
                        <!-- /.-header -->
                        <div class="box-body">
                            
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Estoque</th>
                                <th>Vencimento</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($res as $vaclot)
                            {
                                ?>
                                <tr>
                                    <?php
                                    if(isset($_GET['cvac_data']))
                                    {
                                        ?> 
                                        <td><a href="?pag=vacinacao&acao=<?php print($acao); ?>&vacina_id=<?php print($_GET['vacina_id'].'&paciente_id='.$_GET['paciente_id']."&vlote_codigo=".$vaclot['vlote_codigo']."&cvac_data=".$_GET['cvac_data']) ?>"><?php print($vaclot['vlote_codigo']) ?></a></td>
                                        <?php
                                    }
                                    else
                                    {
                                        ?> 
                                        <td><a href="?pag=vacinacao&acao=<?php print($acao); ?>&vacina_id=<?php print($_GET['vacina_id'].'&paciente_id='.$_GET['paciente_id']."&vlote_codigo=".$vaclot['vlote_codigo']) ?>"><?php print($vaclot['vlote_codigo']) ?></a></td>
                                        <?php
                                    }
                                    ?>
                                    
                                    <td><?php print($vaclot['vlote_qtd']) ?></td>
                                    <td>
                                        <?php
                                            $venc = date_create($vaclot['vlote_vencimento']);
                                            $diff=date_diff($dataagora,$venc);
                                            $diffDias = $diff->format("%R%a");
                                            if($diffDias<0) print('<font color="red">');
                                            else if($diffDias==0) print('<font color="yellow">');
                                            else print('<font color="green">');
                                            print($vaclot['vlote_vencimento']."</font>");
                                        ?>
                                    </td>
                                    <?php
                                    if(isset($_GET['cvac_data']))
                                    {
                                        ?> 
                                        <td><a href="?pag=vacinacao&acao=<?php print($acao); ?>&vacina_id=<?php print($_GET['vacina_id'].'&paciente_id='.$_GET['paciente_id']."&vlote_codigo=".$vaclot['vlote_codigo']."&cvac_data=".$_GET['cvac_data']) ?>" class="btn btn-flat btn-primary btn-flat"><i class="fa fa-arrow-right"></i> Selecionar</a></td>
                                        <?php
                                    }
                                    else
                                    {
                                        ?> 
                                        <td><a href="?pag=vacinacao&acao=<?php print($acao); ?>&vacina_id=<?php print($_GET['vacina_id'].'&paciente_id='.$_GET['paciente_id']."&vlote_codigo=".$vaclot['vlote_codigo']) ?>" class="btn btn-flat btn-primary btn-flat"><i class="fa fa-arrow-right"></i> Selecionar</a></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                                ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Codigo</th>
                                <th>Estoque</th>
                                <th>Vencimento</th>
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
                else
                {
                    
                    
                    //pag=vacinacao&acao=vacinar&vacina_id=1&paciente_id=1&vlote_codigo=124
                    $dados = Array();
                    if(isset($_GET['paciente_id']))
                    {
                        $dados['paciente_id'] = $_GET['paciente_id'];
                        if(isset($_GET['vacina_id']))
                        {
                            $dados['vacina_id'] = $_GET['vacina_id'];
                            if($acao=="vacinar")
                            {
                                if(isset($_GET['vlote_codigo']))
                                {
                                    if(isset($_GET['vlote_codigo'])) $dados['vlote_codigo'] = $_GET['vlote_codigo'];
                                    $dados['funcionario_id'] = $_SESSION['usuario_logado']['funcionario_id']; //FUNCIONARIO LOGADO
                                    if($acao=="vacinar") $dados['cvac_tipo'] = 1;
                                    else if($acao=="agendarvacinar") $dados['cvac_tipo'] = 2;
                                    else if($acao=="registrarvacinar") $dados['cvac_tipo'] = 3;
                                    $funcDB = new CarteiraVacinacao();
                                    if(isset($_GET['cvac_data']))
                                    {
                                        $dados['cvac_data'] = $_GET['cvac_data'];
                                        $res = $funcDB->updateCarteira($_GET['paciente_id'], $_GET['vacina_id'], $_GET['cvac_data'], $dados);
                                    }
                                    else $res = $funcDB->insert($dados);
                                    if($res==-1)
                                    {
                                        //print("Falha.");
                                        print("<script> location.replace('?pag=vacinacao&acao=visualizarpaciente&paciente_id=".$_GET['paciente_id']."'); </script>");
                                    }
                                    else
                                    {
                                        //print("Inserido.");
                                        print("<script> location.replace('?pag=vacinacao&acao=visualizarpaciente&paciente_id=".$_GET['paciente_id']."'); </script>");
                                    }
                                }
                            }
                            else
                            {
								if(isset($_GET['horario']))
								{
									$tempo = $_GET['horario'];
									//$createdate = "1971-01-01 00:00:01";
									//$createdate = strtotime($_POST['datavac']);
									//$createdate = new DateTime($_POST['datavac']);
									//print($createdate."<br>");
									if($acao=="vacinar") $dados['cvac_tipo'] = 1;
									else if($acao=="agendarvacinar") $dados['cvac_tipo'] = 2;
									else if($acao=="registrarvacinar") $dados['cvac_tipo'] = 3;
									$dados['cvac_data'] = $tempo;
									$dados['funcionario_id'] = 1; //FUNCIONARIO LOGADO
									$funcDB = new CarteiraVacinacao();
									$res = $funcDB->insert($dados);
									if($res==-1)
									{
										print("Falha.");
									}
									else 
										print("<script> location.replace('?pag=vacinacao&acao=visualizarpaciente&paciente_id=".$_GET['paciente_id']."'); </script>");
								}
                                else if(isset($_POST['submit']))
                                {
									if($acao=="agendarvacinar")
									{
										$dia = $_POST['datavac'];
										//$createdate = str_replace("T", " ", $_POST['datavac']);
										//print($createdate);
										$tempoInicial = $dia." 00:00:00";
										$tempoFinal = $dia." 23:59:59";
										?>
                                        <div class="box box-default">
                                            <div class="box-header">
                                                <h3 class="box-title">Escolha o horario</h3>
                                            </div>
                                                <!-- /.-header -->
                                                <div class="box-body">
                                        <?php
										$useDB = new CarteiraVacinacao();
										$vacinas = $useDB->searchPorPeriodo(2, $tempoInicial, $tempoFinal);
										$horarios = Array();
										foreach($vacinas as $vac)
										{
											$horarios[$vac['cvac_data']] = $vac;
										}
										print('<div class="col-xs-12 table-responsive">');
										print("<table class='table table-bordered table-striped'>");
										for($hora=6;$hora<19;$hora++)
										{
											
											$formatHora = $hora;
											print("<td><table><tr><th>".$formatHora."</th></tr>");
											if($hora<10) $formatHora = "0".$hora;
											for($min=0;$min<60;$min=$min+10)
											{
												$formatMin = $min;
												if($min<10) $formatMin = "0".$min;
												$tempo = $dia." ".$formatHora.":".$formatMin.":00";
												
												if(isset($horarios[$tempo])) print("<tr><td>-</td></tr>");
												else
												{
												?>
												<tr><td><a href="?pag=vacinacao&acao=agendarvacinar&vacina_id=<?php print($_REQUEST['vacina_id']); ?>&paciente_id=<?php print($_REQUEST['paciente_id']); ?>&horario=<?php print($tempo); ?>"><?php print($formatHora.":".$formatMin); ?></a></td></tr>
												<?php
												}
											}
											print("</table></td>");
										}
                                        print("<table></div>");
                                        ?>
                                                </div>
                                            <!-- /.-body -->
											<a href="" onClick="history.go(-1)" class='btn btn-flat btn-default pull-left'>Voltar</a>
                                        </div>
                                    <?php
									}
									else if($acao=="registrarvacinar")
									{
										$dia = $_POST['datavac'];
										$tempo = $dia." 00:00:00";
										//$createdate = "1971-01-01 00:00:01";
										//$createdate = strtotime($_POST['datavac']);
										//$createdate = new DateTime($_POST['datavac']);
										//print($createdate."<br>");
										if($acao=="vacinar") $dados['cvac_tipo'] = 1;
										else if($acao=="agendarvacinar") $dados['cvac_tipo'] = 2;
										else if($acao=="registrarvacinar") $dados['cvac_tipo'] = 3;
										$dados['cvac_data'] = $tempo;
										$dados['funcionario_id'] = 1; //FUNCIONARIO LOGADO
										$funcDB = new CarteiraVacinacao();
										$res = $funcDB->insert($dados);
										if($res==-1)
										{
											print("Falha.");
										}
										else 
											print("<script> location.replace('?pag=vacinacao&acao=visualizarpaciente&paciente_id=".$_GET['paciente_id']."'); </script>");
									}

                                }
                                else
                                {
                                    ?>
                                        <div class="box box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Registrar Vacina</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <!-- form start -->
                                            <form action="" method="post" role="form">
                                                <div class="box-body row">
                                                    <div class="form-group col-xs-12">
                                                        <label for="datavac">Data</label>
                                                        <input type="date" class="form-control" name="datavac" id="datavac"  placeholder="Nome vacina" <?php if(isset($dados['datavac'])) print('value="'.$dados['datavac'].'"'); ?> required>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->

                                                <div class="box-footer">
                                                <a href="?pag=vacina&acao=listar" class='btn btn-flat btn-default pull-left'>Voltar</a>
                                                <input type="submit" name="submit" value="Checar horarios" class='btn btn-flat btn-primary pull-right'>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.box -->
                                    <?php
                                }
                            }
                        }
                    }
                }
               // View::includeFooter();
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