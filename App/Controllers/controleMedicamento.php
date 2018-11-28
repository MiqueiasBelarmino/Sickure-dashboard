<?php


class controleMedicamento extends controleGeral
{
    function __construct()
    {
        if(isset($_REQUEST['acao']))
        {
            $acao = $this->sanitizarString($_REQUEST['acao']);
            if($acao=="novo")
            {
                View::includeHeader();
                View::formMedicamento(null, true);
                View::includeFooter();
            }
            else if($acao=="inserir")
            {
                $dados = Array();
                
                foreach($_REQUEST as $key => $val)
                {
                    
                    if(strpos($key,"medicamento_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $funcDB = new Medicamento();
                $res = $funcDB->insert($dados);
                View::includeHeader();
                if($res==-1)
                {
                    print("<script>alert('Falha');history.go(-2);</script>");
                }
                else  print("<script>history.go(-2);</script>");
                View::includeFooter();
            }
            else if($acao=="alterar")
            {
                $dados = Array();
                
                foreach($_REQUEST as $key => $val)
                {
                    
                    if(strpos($key,"medicamento_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $funcDB = new Medicamento();
                $res = $funcDB->update($dados['medicamento_id'], $dados);
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
            
            else if($acao=="inserirlote")
            {
                $dados = Array();
                
                foreach($_REQUEST as $key => $val)
                {
                    
                    if(strpos($key,"mlote_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                    
                }
                $dados['medicamento_id'] = $_REQUEST['medicamento_id']; 
                $loteDB = new LoteMedicamento();
                $res = $loteDB->insert($dados);
                
                View::includeHeader();
                if($res==-1)
                {
                     print("<script>alert('Falha');history.go(-2);</script>");
                }
                    else  print("<script>history.go(-2);</script>");
                View::includeFooter();
            }
            else if($acao=="alterarlote")
            {
                $dados = Array();
                
                foreach($_REQUEST as $key => $val)
                {
                    
                    if(strpos($key,"mlote_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $dados['medicamento_id'] = $_REQUEST['medicamento_id']; 
                $loteDB = new LoteMedicamento();
                $res = $loteDB->updateLote($dados['medicamento_id'], $_GET['cod'],$dados);
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
                <div class="box box-default">
                    <div class="box-body">
                    <a href="?pag=medicamento&acao=novo" class="btn btn-flat btn-info pull-left">Adicionar Medicamento</a>
                    <form action='?pag=medicamento&acao=listar' method='post' class="pull-right">
                        <input type="hidden" name='busca' <?php if(isset($_POST['busca'])) print("value='".$_POST['busca']."'"); ?>>
                        <input type='radio' name='ativo' value='1' <?php if(!isset($_POST['ativo']) || $_POST['ativo']==1 ) print("checked"); ?>> Ativo 
                        <input type='radio' name='ativo' value='0' <?php if(isset($_POST['ativo']) && $_POST['ativo']==0 ) print("checked"); ?> style="margin-left: 10px"> Inativo
                        <input type="submit" name='buscar' value='Filtrar' class="btn btn-flat btn-flat btn-default" style="margin-left:10px">
                    </form>
                    </div>
                </div>

                <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Lista de Medicamentos</h3>
                </div>
                    <!-- /.-header -->
                    <div class="box-body">
                        
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                           $funcDB = new Medicamento();
                           if(isset($_POST['busca'])) $res = $funcDB->searchFiltroAtivo($_POST['busca'], $_POST['ativo']);
                           else $res = $funcDB->searchFiltroAtivo();
                           foreach($res as $func)
                            {
                                ?>
                                <tr>
                                    <td><a href="?pag=medicamento&acao=visualizar&id=<?php print($func['medicamento_id']) ?>" style="color: green !important;"><?php print($func['medicamento_nome']) ?></a></td>
                                    <td>
                                        <a href="?pag=medicamento&acao=editar&id=<?php print($func['medicamento_id']) ?>" class="btn btn-flat bg-orange btn-flat"><i class="fa fa-pencil"></i> Editar</a>
                                        <a href="?pag=medicamento&acao=visualizar&id=<?php print($func['medicamento_id']) ?>" class="btn btn-flat btn-primary btn-flat"><i class="fa fa-eye"> Visualizar</i></a>
                                        <?php
                                            if($func['medicamento_ativo']==1):
                                        ?>
                                        <a href="?pag=medicamento&acao=desativar&id=<?php print($func['medicamento_id']); ?>" class="btn btn-flat btn-danger btn-flat"><i class="fa fa-power-off"> Inativar</i></a>
                                        <?php
                                            else:
                                        ?>
                                            <a href="?pag=medicamento&acao=ativar&id=<?php print($func['medicamento_id']); ?>" class="btn btn-flat btn-success btn-flat"><i class="fa fa-power-off"> Ativar</i></a>
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
                            <th>Descrição</th>
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
            else if($acao=="novolote")
            {
                View::includeHeader();
                $funcDB = new Medicamento();
                $res = $funcDB->select($_GET['medicamento_id']);
                View::formLoteMedicamento($_GET['medicamento_id'],null, true);
                View::includeFooter();
            }
            
            else if($acao=="visualizar")
            {
                View::includeHeader();
                $funcDB = new Medicamento();
                $res = $funcDB->select($_GET['id']);
                View::formMedicamento($res, false);
                ?>

                <div class="box">
                    <div class="box-body">
                    <a href="?pag=medicamento&acao=novolote&medicamento_id=<?php print($_GET['id']); ?>" class="btn btn-flat btn-info pull-left">Adicionar lote</a>
                    <form action='' method='post' class="pull-right">
                        <input type="hidden" name='busca' <?php if(isset($_POST['busca'])) print("value='".$_POST['busca']."'"); ?>>
                        <input type='radio' name='ativo' value='1' <?php if(!isset($_POST['ativo']) || $_POST['ativo']==1 ) print("checked"); ?>> Ativo 
                        <input type='radio' name='ativo' value='0' <?php if(isset($_POST['ativo']) && $_POST['ativo']==0 ) print("checked"); ?> style="margin-left: 10px"> Inativo
                        <input type="submit" name='buscar' value='Filtrar' class="btn btn-flat btn-default" style="margin-left:10px">
                    </form>
                    </div>
                </div>

                <div class="box box-default">
     
                <div class="box-header">
                    <h3 class="box-title">Lote</h3>
                </div>
                    <!-- /.-header -->
                    <div class="box-body">
                        
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Estoque</th>
                            <th>Vencimento</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $dataagora = date_create(date('Y-m-d', time()));
                            $loteVaDB = new LoteMedicamento();
                            $ativo = 1;
                            if(isset($_POST['ativo'])) $ativo = $_POST['ativo'];
                            $res = $loteVaDB->searchPorMedicamentos($_GET['id'], $ativo);
                            foreach($res as $vaclot)
                            {

                                ?>
                                <tr>
                                    <td><a href="?pag=medicamento&acao=visualizarlote&id=<?php print($vaclot['medicamento_id']."&cod=".$vaclot['mlote_codigo']) ?>"><?php print($vaclot['mlote_codigo']) ?></a></td>
                                    <td><?php print($vaclot['mlote_qtd']) ?></td>
                                    <td>
                                        <?php
                                            $venc = date_create($vaclot['mlote_vencimento']);
                                            $diff=date_diff($dataagora,$venc);
                                            $diffDias = $diff->format("%R%a");
                                            if($diffDias<0) print('<font color="red">');
                                            else if($diffDias==0) print('<font color="yellow">');
                                            else print('<font color="green">');
                                            print($vaclot['mlote_vencimento']."</font>");
                                        ?>
                                    </td>
                                    <td>
                                        <a href="?pag=medicamento&acao=retirada&medicamento_id=<?php print($vaclot['medicamento_id']."&mlote_codigo=".$vaclot['mlote_codigo']) ?>" class="btn btn-flat bg-orange btn-flat"><i class="fa fa-pencil"></i> Retirar</a>
                                        <a href="?pag=medicamento&acao=editarlote&id=<?php print($vaclot['medicamento_id']."&cod=".$vaclot['mlote_codigo']) ?>" class="btn btn-flat bg-orange btn-flat"><i class="fa fa-pencil"></i> Editar</a>
                                        <a href="?pag=medicamento&acao=visualizarlote&id=<?php print($vaclot['medicamento_id']."&cod=".$vaclot['mlote_codigo']) ?>" class="btn btn-flat btn-primary btn-flat"><i class="fa fa-eye"> Visualizar</i></a>
                                        
                                        <?php
                                            if($vaclot['mlote_ativo']==1):
                                        ?>
                                        <a href="?pag=medicamento&acao=desativarlote&id=<?php print($vaclot['medicamento_id']."&cod=".$vaclot['mlote_codigo']) ?>" class="btn btn-flat btn-danger btn-flat"><i class="fa fa-power-off"> Inativar</i></a>
                                        <?php
                                            else:
                                        ?>
                                            <a href="?pag=medicamento&acao=ativarlote&id=<?php print($vaclot['medicamento_id']."&cod=".$vaclot['mlote_codigo']) ?>" class="btn btn-flat btn-success btn-flat"><i class="fa fa-power-off"> Ativar</i></a>
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
                            <th>Código</th>
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
            
            
            
            
            else if($acao=="visualizarlote")
            {
                View::includeHeader();
                $useDB = new LoteMedicamento();
                $res = $useDB->selectLote($_GET['id'],$_GET['cod']);
                View::formLoteMedicamento($_GET['id'], $res, false);
                ?>
                <table>
                    <tr>
                        <td><a href="?pag=medicamento&acao=editarlote&id=<?php print($_GET['id'].'&cod='.$_GET['cod'])?>">Editar</a></td>
                        <?php 
                        if($res['mlote_ativo']==1) print('<td><a href="?pag=medicamento&acao=desativarlote&id='.$_GET['id'].'&cod='.$_GET['cod'].'">Desativar</a></td>');
                        else print('<td><a href="?pag=medicamento&acao=ativarlote&id='.$_GET['id'].'&cod='.$_GET['cod'].'">Reativar</a></td>');
                        ?>
                    </tr>
                </table>
                <?php
                View::includeFooter();
                print("</table>");
            }
            
            else if($acao=="editarlote")
            {
                View::includeHeader();
                $useDB = new LoteMedicamento();
                $res = $useDB->selectLote($_GET['id'],$_GET['cod']);
                View::formLoteMedicamento($_GET['id'], $res, true);
                ?>
                    <a href="?pag=medicamento&acao=visualizarlote&id=<?php print($_GET['id'].'&cod='.$_GET['cod'])?>">Cancelar</a>
                <?php
                View::includeFooter();
            }
            
            
            else if($acao=="desativar")
            {
                View::includeHeader();
                $funcDB = new Medicamento();
                $res = $funcDB->setActive($_GET['id'],0);
                print('<script> location.replace("?pag=medicamento&acao=listar"); </script>');
                View::includeFooter();
            }
            
            else if($acao=="desativarlote")
            {
                View::includeHeader();
                $useDB = new LoteMedicamento();
                $res = $useDB->setActiveLote($_GET['id'],$_GET['cod'],0);
                print("<script> location.replace('?pag=medicamento&acao=visualizar&id=".$_GET['id']."'); </script>");
                View::includeFooter();
            }
            
            else if($acao=="ativar")
            {
                View::includeHeader();
                $funcDB = new Medicamento();
                $res = $funcDB->setActive($_GET['id'],1);
                print('<script> location.replace("?pag=medicamento&acao=listar"); </script>');
                View::includeFooter();
            }
            else if($acao=="editar")
            {
                View::includeHeader();
                $funcDB = new Medicamento();
                $res = $funcDB->select($_GET['id']);
                View::formMedicamento($res, true);
                ?>
                    <a href="?pag=medicamento&acao=visualizar&id=<?php print($_GET['id'])?>">Cancelar</a>
                <?php
                View::includeFooter();
            }
            else if($acao=="retiradaconfirma")
            {
                View::includeHeader();
                $mlote_codigo = $_REQUEST['mlote_codigo'];
                $medicamento_id = $_REQUEST['medicamento_id'];
                $funcionario_id = $_SESSION['usuario_logado']['funcionario_id'];
                
                $validos = Array(
                    "rmedicamento_id",
                    "mlote_codigo",
                    "medicamento_id",
                    "funcionario_id",
                    "rmedicamento_data",
                    "rmedicamento_medicoCRM",
                    "rmedicamento_pacienteNome",
                    "rmedicamento_pacienteCPF",
                    "rmedicamento_pacienteContato",
                    "rmedicamento_identificadorReceita"
                );
                $dados = Array();
                
                foreach ($_REQUEST as $key => $value)
                {
                    if (in_array($key, $validos)) $dados[$key] = $value;
                }
                $dados['funcionario_id'] = $funcionario_id;
                $useDB = new RetiradaMedicamento();
                $res = $useDB->insert($dados);
                if($res!="-1")
                {
                    print("Sucesso.");
                }
                else print("Fracassado, nunca vai ser nada na vida. ");
                View::includeFooter();
            }
            else if($acao=="retirada")
            {
                View::includeHeader();
                $mlote_codigo = $_REQUEST['mlote_codigo'];
                $medicamento_id = $_REQUEST['medicamento_id'];
                //$funcionario_id = $_SESSION['usuario_logado']['funcionario_id'];
                //print("<br>$mlote_codigo <br> $medicamento_id");
                
                
                ?>
                    <form action="?pag=medicamento&acao=retiradaconfirma&medicamento_id=<?php print($medicamento_id."&mlote_codigo=".$mlote_codigo);?>" method="POST">
                        <div class="ui-widget">
                        <br><label for="rmedicamento_pacienteNome">*Paciente</label>                 
                        <input type="text" id="paciente_nome" name="rmedicamento_pacienteNome">
                        </div>
                        
                        <br><label for="rmedicamento_pacienteCPF">rmedicamento_pacienteCPF</label>
                        <input type="text" id="paciente_cpf" name="rmedicamento_pacienteCPF">
                        
                        <br><label for="rmedicamento_pacienteContato">rmedicamento_pacienteContato</label>
                        <input type="text" id="paciente_contato" name="rmedicamento_pacienteContato">
                        <br>
                        
                        <br><label for="rmedicamento_medicoCRM">*rmedicamento_medicoCRM</label>
                        <input type="text" name="rmedicamento_medicoCRM">
                        

                        <br><label for="rmedicamento_identificadorReceita">rmedicamento_identificadorReceita</label>
                        <input type="text" name="rmedicamento_identificadorReceita">
                        
                        <br><br><input type="submit" value="Confirmar" name="submit">
                        
                        
                    </form>
                    
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