<?php


class controleVacina extends controleGeral
{
    function __construct()
    {
        if(isset($_REQUEST['acao']))
        {
            $acao = $this->sanitizarString($_REQUEST['acao']);
            if($acao=="novo")
            {
                View::includeHeader();
                View::formVacina(null, true);
                View::includeFooter();
            }
            else if($acao=="inserir")
            {
                $dados = Array();
                
                foreach($_REQUEST as $key => $val)
                {
                    
                    if(strpos($key,"vacina_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $funcDB = new Vacina();
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
                    
                    if(strpos($key,"vacina_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $funcDB = new Vacina();
                $res = $funcDB->update($dados['vacina_id'], $dados);
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
                    
                    if(strpos($key,"vlote_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                    
                }
                $dados['vacina_id'] = $_REQUEST['vacina_id']; 
                $loteDB = new LoteVacina();
                $res = $loteDB->insert($dados);
                
                View::includeHeader();
                if($res==-1)
                {
                    print("Falha.");
                }
                else print("Inserido.");
                View::includeFooter();
            }
            else if($acao=="alterarlote")
            {
                $dados = Array();
                
                foreach($_REQUEST as $key => $val)
                {
                    
                    if(strpos($key,"vlote_")!==false) //!== (não for falso, quando resposta pode ou não ser inteiro)
                    {
                        $dados[$key] = $val;
                    }
                }
                $dados['vacina_id'] = $_REQUEST['vacina_id']; 
                $loteDB = new LoteVacina();
                $res = $loteDB->updateLote($dados['vacina_id'], $_GET['cod'],$dados);
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
                    <a href="?pag=vacina&acao=novo" class="btn btn-flat btn-info pull-left">Adicionar Vacina</a>
                    <form action='?pag=vacina&acao=listar' method='post' class="pull-right">
                        <input type="hidden" name='busca' <?php if(isset($_POST['busca'])) print("value='".$_POST['busca']."'"); ?>>
                        <input type='radio' name='ativo' value='1' <?php if(!isset($_POST['ativo']) || $_POST['ativo']==1 ) print("checked"); ?>> Ativo 
                        <input type='radio' name='ativo' value='0' <?php if(isset($_POST['ativo']) && $_POST['ativo']==0 ) print("checked"); ?> style="margin-left: 10px"> Inativo
                        <input type="submit" name='buscar' value='Filtrar' class="btn btn-flat btn-default" style="margin-left:10px">
                    </form>
                    </div>
                </div>

                <div class="box box-default">

                <div class="box-header">
                    <h3 class="box-title">Lista de Vacinas</h3>
                    <br>
                    
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
                           $funcDB = new Vacina();
                           if(isset($_POST['busca'])) $res = $funcDB->searchFiltroAtivo($_POST['busca'], $_POST['ativo']);
                           else $res = $funcDB->searchFiltroAtivo();
                           foreach($res as $func)
                            {
                                ?>
                                <tr>
                                    <td><a href="?pag=vacina&acao=visualizar&id=<?php print($func['vacina_id']) ?>" style="color: green !important;"><?php print($func['vacina_nome']) ?></a></td>
                                    <td>
                                        <a href="?pag=vacina&acao=editar&id=<?php print($func['vacina_id']) ?>" class="btn btn-flat bg-orange btn-flat"><i class="fa fa-pencil"></i></a>
                                        <a href="?pag=vacina&acao=visualizar&id=<?php print($func['vacina_id']) ?>" class="btn btn-flat btn-primary btn-flat"><i class="fa fa-eye"></i></a>
                                        <a href="?pag=vacina&acao=desativar&id=<?php print($func['vacina_id']) ?>" class="btn btn-flat btn-danger btn-flat"><i class="fa fa-power-off"></i></a>
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
                $funcDB = new Vacina();
                $res = $funcDB->select($_GET['vacina_id']);
                View::formLoteVacina($_GET['vacina_id'],null, true);
                View::includeFooter();
            }
            
            else if($acao=="visualizar")
            {
                View::includeHeader();
                $funcDB = new Vacina();
                $res = $funcDB->select($_GET['id']);
                View::formVacina($res, false);
                ?>
                <div class="box">
                    <div class="box-body">
                    <a href="?pag=vacina&acao=novolote&vacina_id=<?php print($_GET['id']); ?>" class="btn btn-flat btn-info pull-left">Adicionar lote</a>
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
                    <h3 class="box-title">Lotes</h3>
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
                            $loteVaDB = new LoteVacina();
                            $ativo = 1;
                            if(isset($_POST['ativo'])) $ativo = $_POST['ativo'];
                            $res = $loteVaDB->searchPorVacinas($_GET['id'], $ativo);
                            foreach($res as $vaclot)
                            {

                                ?>
                                <tr>
                                    <td><a href="?pag=vacina&acao=visualizarlote&id=<?php print($vaclot['vacina_id']."&cod=".$vaclot['vlote_codigo']) ?>"><?php print($vaclot['vlote_codigo']) ?></a></td>
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
                                    <td>
                                        <a href="?pag=vacina&acao=editarlote&id=<?php print($vaclot['vacina_id']."&cod=".$vaclot['vlote_codigo']) ?>" class="btn btn-flat bg-orange btn-flat"><i class="fa fa-pencil"></i></a>
                                        <a href="?pag=vacina&acao=visualizarlote&id=<?php print($vaclot['vacina_id']."&cod=".$vaclot['vlote_codigo']) ?>" class="btn btn-flat btn-primary btn-flat"><i class="fa fa-eye"></i></a>
                                        
                                        <?php
                                            if($vaclot['vlote_ativo']==1):
                                        ?>
                                        <a href="?pag=vacina&acao=desativarlote&id=<?php print($vaclot['vacina_id']."&cod=".$vaclot['vlote_codigo']) ?>" class="btn btn-flat btn-danger btn-flat"><i class="fa fa-power-off"></i></a>
                                        <?php
                                            else:
                                        ?>
                                            <a href="?pag=vacina&acao=ativarlote&id=<?php print($vaclot['vacina_id']."&cod=".$vaclot['vlote_codigo']) ?>" class="btn btn-flat btn-success btn-flat"><i class="fa fa-power-off"></i></a>
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
                $useDB = new LoteVacina();
                $res = $useDB->selectLote($_GET['id'],$_GET['cod']);
                View::formLoteVacina($_GET['id'], $res, false);
                View::includeFooter();
                print("</table>");
            }
            
            else if($acao=="editarlote")
            {
                View::includeHeader();
                $useDB = new LoteVacina();
                $res = $useDB->selectLote($_GET['id'],$_GET['cod']);
                View::formLoteVacina($_GET['id'], $res, true);
                ?>
                    <a href="?pag=vacina&acao=visualizarlote&id=<?php print($_GET['id'].'&cod='.$_GET['cod'])?>">Cancelar</a>
                <?php
                View::includeFooter();
            }
            
            
            else if($acao=="desativar")
            {
                View::includeHeader();
                $funcDB = new Vacina();
                $res = $funcDB->setActive($_GET['id'],0);
                header('Location: '.$_SERVER['PHP_SELF']."?pag=vacina&acao=listar");
                View::includeFooter();
            }
            
            else if($acao=="desativarlote")
            {
                View::includeHeader();
                $useDB = new LoteVacina();
                $res = $useDB->setActiveLote($_GET['id'],$_GET['cod'],0);
                header('Location: '.$_SERVER['PHP_SELF']."?pag=vacina&acao=visualizar&id=".$_GET['id']);
                View::includeFooter();
            }
            else if($acao=="ativarlote")
            {
                View::includeHeader();
                $useDB = new LoteVacina();
                $res = $useDB->setActiveLote($_GET['id'],$_GET['cod'],1);
                header('Location: '.$_SERVER['PHP_SELF']."?pag=vacina&acao=visualizar&id=".$_GET['id']);
                View::includeFooter();
            }
            
            else if($acao=="ativar")
            {
                View::includeHeader();
                $funcDB = new Vacina();
                $res = $funcDB->setActive($_GET['id'],1);
                header('Location: '.$_SERVER['PHP_SELF']."?pag=vacina&acao=listar");
                View::includeFooter();
            }
            else if($acao=="editar")
            {
                View::includeHeader();
                $funcDB = new Vacina();
                $res = $funcDB->select($_GET['id']);
                View::formVacina($res, true);
                ?>
                    <a href="?pag=vacina&acao=visualizar&id=<?php print($_GET['id'])?>">Cancelar</a>
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