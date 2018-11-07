?>

                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">Escolha o horario</h3>
                    </div>
                        <!-- /.-header -->
                        <div class="box-body">
                            
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>Nome</th>
                            <th>Genero</th>
                            <th>Função</th>
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
                                        <?php
											if(isset($func['administrador_ativo']) && $func['administrador_ativo']!=0) print("<td>Administrador</td>");
											else if(isset($func['medico_ativo']) && $func['medico_ativo']!=0) print("<td>Medico</td>");
											else if(isset($func['atendente_ativo']) && $func['atendente_ativo']!=0) print("<td>Atendente</td>");
											else print("<td>-</td>");
										?>
                                        <td>
                                            
                                        <a href="?pag=funcionario&acao=editar&id=<?php print($func['funcionario_id']) ?>" class="btn bg-orange btn-flat"><i class="fa fa-pencil"></i> Editar</a>
                                        <a href="?pag=funcionario&acao=visualizar&id=<?php print($func['funcionario_id']) ?>" class="btn btn-primary btn-flat"><i class="fa fa-eye"> Visualizar</i></a>
                                         <?php
                                            if($func['funcionario_ativo']==1):
                                        ?>
                                            <a href="?pag=funcionario&acao=desativar&id=<?php print($func['funcionario_id']) ?>" class="btn btn-danger btn-flat"><i class="fa fa-power-off"> Inativar</i></a>
                                        <?php
                                            else:
                                        ?>
                                            <a href="?pag=funcionario&acao=ativar&id=<?php print($func['funcionario_id']) ?>" class="btn btn-flat btn-success btn-flat"><i class="fa fa-power-off"> Ativar</i></a>
                                        <?php
                                            endif;
                                        ?>       
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
                            <th>Função</th>
                            <th>Ações</th>
                            </tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- /.-body -->
                    </div>
                <?php