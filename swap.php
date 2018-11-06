?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Adicionar Lote</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="" method="post" role="form">
                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="datainicio">Data Inicio</label>
                        <input type="datetime-local" class="form-control" name="datainicio" id="datainicio"  <?php if(isset($tempoInicial)) print("value='".$tempoInicial."'") ?> required>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="datafim">Data< Fim</label>
                        <input type="datetime-local" class="form-control" name="datafim" id="datafim"  <?php if(isset($tempoFinal)) print("value='".$tempoFinal."'") ?> required>
                    </div>
                    <div class="form-group col-xs-6">
                    <input type="submit" name="submit" value="Buscar">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a onClick="history.go(-1)" class='btn btn-default pull-left'>Voltar</a>
                    <input type="submit" name="submit" value="Dia" class='btn btn-success pull-right'>
                    <input type="submit" name="submit" value="Semana" class='btn btn-success pull-right'>
                    <input type="submit" name="submit" value="Mes" class='btn btn-success pull-right'>    
                </form>
                </div>
        </div>
        <!-- /.box -->
    <?php