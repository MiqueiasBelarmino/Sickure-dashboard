?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Adicionar Vacina</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="" method="post" role="form">
                    <div class="box-body row">
                        <div class="form-group col-xs-12">
                            <label for="datavac">Data</label>
                            <input type="text" class="form-control" name="datavac" id="datavac"  placeholder="Nome vacina" <?php if(isset($dados['datavac'])) print('value="'.$dados['datavac'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                    <a href="?pag=vacina&acao=listar" class='btn btn-primary pull-left'>Voltar</a>
                    <input type="submit" name="submit" value="Confirmar" class='btn btn-primary pull-right'>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        <?php