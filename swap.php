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
<?php