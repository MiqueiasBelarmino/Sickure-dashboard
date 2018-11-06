?>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Medicamento</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="?pag=funcionario&acao=trocasenha&id=<?php print($_SESSION['usuario_logado']['funcionario_id']);?>" method="post" role="form">
                    <div class="box-body row">
                        <div class="form-group col-xs-12">
                            <label for="novaSenha">Nova senha</label>
                            <input type="passowrd" class="form-control" name="novaSenha" id="novaSenha"  placeholder="Nome medicamento" required>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="novaSenha2">Confirmar senha</label>
                            <input type="passowrd" class="form-control" name="novaSenha2" id="novaSenha2"  placeholder="Nome medicamento" required>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="atualSenha">Senha atual</label>
                            <input type="passowrd" class="form-control" name="atualSenha" id="atualSenha"  placeholder="Nome medicamento" required>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                    <a href="index.php" onClick="history.go(-1)" class='btn btn-flat btn-default pull-left'>Voltar</a>
                    <?php
                    
                        if(isset($dados['medicamento_id'])) print("<input type='hidden' name='medicamento_id' value='".$_SESSION['usuario_logado']['funcionario_id']."'>");
                        if($editable) print("<input type='submit' name='submit' value='Salvar' class='btn btn-flat btn-success pull-right'>");
                        ?>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        <?php