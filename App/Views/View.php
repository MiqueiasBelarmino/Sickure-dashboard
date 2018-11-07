<?php



class View {
                               
    public static function exibirMensagem ( $mensagem , $tipo = "sucesso"){
        
        if($tipo == "sucesso"){
             echo "<div class='msg_sucesso'> $mensagem </div>";   
        } else{
            echo "<div class='msg_erro'> $mensagem </div>";   
        }
        
    }
    
    public static function includeHeader($title = "Página") {
        include "App/Views/templates/header.php";
        include "App/Views/templates/menu.php";
    }

    public static function includeFooter() {
        include "App/Views/templates/footer.php";
    }
    
    public static function funcTrocaSenhaForm($id)
    {
        ?>
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Alterar senha</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="?pag=funcionario&acao=trocasenha&id=<?php print($_SESSION['usuario_logado']['funcionario_id']);?>" method="post" role="form">
                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="novaSenha">Nova senha</label>
                        <input type="password" class="form-control" name="novaSenha" id="novaSenha"  placeholder="Nova senha" required>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="novaSenha2">Confirmar senha</label>
                        <input type="password" class="form-control" name="novaSenha2" id="novaSenha2"  placeholder="Confirmar senha" required>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="atualSenha">Senha atual</label>
                        <input type="password" class="form-control" name="atualSenha" id="atualSenha"  placeholder="Senha atual" required>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                <a href="index.php" onClick="history.go(-1)" class='btn btn-flat btn-default pull-left'>Voltar</a>
                <?php
                
                    if(isset($dados['funcionario_id'])) print("<input type='hidden' name='funcionario_id' value='".$dados['medicamento_id']."'>");
                     print("<input type='submit' name='submit' value='Salvar' class='btn btn-flat btn-success pull-right'>");
                    ?>
                </div>
            </form>
        </div>
        <!-- /.box -->
    <?php
    }
    
    
    public static function formFuncionario($dados = null, $editable = true)
    {
        /*
         *  funcionario_id INT PRIMARY KEY AUTO_INCREMENT,
            funcionario_nome VARCHAR(40) NOT NULL,**
            funcionario_cpf CHAR(14) UNIQUE NOT NULL,**
            funcionario_senha VARCHAR(25),
            funcionario_cargo INT DEFAULT 1,
            funcionario_rg VARCHAR(14) NOT NULL,**
            funcionario_dataNascimento DATE NOT NULL,**
            funcionario_sexo CHAR(1) NOT NULL,**
            funcionario_logradouro VARCHAR(50) NOT NULL,
            funcionario_numero VARCHAR(6) NOT NULL,
            funcionario_bairro VARCHAR(20) NOT NULL,
            funcionario_cidade VARCHAR(40) NOT NULL,
            funcionario_cep VARCHAR(11) NOT NULL,
            funcionario_telefone VARCHAR(14) NOT NULL,
            funcionario_celular VARCHAR(14) NOT NULL,
            funcionario_ativo BOOLEAN DEFAULT TRUE
         */
        $action = 'inserir';
        if(isset($dados)) $action = 'alterar'
        ?>

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Adicionar Funcionário</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="?pag=funcionario&acao=<?php print($action)?>" method="post" role="form" onsubmit="return validateForm()" name="myForm">
                    <div class="box-body row">
                        <div class="form-group col-xs-12">
                        <label for="funcionario_nome">Nome completo</label>
                        <input type="text" class="form-control" name="funcionario_nome" id="funcionario_nome"  placeholder="Nome completo" <?php if(isset($dados['funcionario_nome'])) print('value="'.$dados['funcionario_nome'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                        <div class="form-group col-xs-7">
                        <label for="funcionario_cpf">CPF</label>
                        <input type="text" class="form-control" name="funcionario_cpf" id="funcionario_cpf" placeholder="Informe o cpf" <?php if(isset($dados['funcionario_cpf'])) print('value="'.$dados['funcionario_cpf'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-5">
                            <label for="funcionario_rg">RG</label>
                            <input type="text" class="form-control" name="funcionario_rg" id="funcionario_rg" placeholder="Informe o RG" <?php if(isset($dados['funcionario_rg'])) print('value="'.$dados['funcionario_rg'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group col-xs-9">
                        <label>Data de Nascimento</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control" name="funcionario_dataNascimento" <?php if(isset($dados['funcionario_dataNascimento'])) print('value="'.$dados['funcionario_dataNascimento'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group col-xs-3">
                            <label for="">Genero</label>
                            <div class="row">
                            <div class="col-xs-6">
                            <input type="radio" name="funcionario_sexo" value="F" class="minimal" <?php if($dados['funcionario_sexo']=="F") print("checked"); else if(!$editable) print("disabled");?> >
                                Feminino
                            </div class="col-xs-6">
                                <input type="radio" name="funcionario_sexo" value="M" class="minimal" <?php if($dados['funcionario_sexo']=="M") print("checked"); else if(!$editable) print("disabled"); ?>>
                                Masculino
                            </div>
                        </div>
                        <div class="form-group col-xs-8">
                            <label for="funcionario_logradouro">Logradouro</label>
                            <input type="text" class="form-control" name="funcionario_logradouro" id="funcionario_logradouro" placeholder="Informe o logradouro" <?php if(isset($dados['funcionario_logradouro'])) print('value="'.$dados['funcionario_logradouro'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-4">
                            <label for="funcionario_numero">Numero</label>
                            <input type="text" class="form-control" name="funcionario_numero" id="funcionario_numero" placeholder="Informe o numero" <?php if(isset($dados['funcionario_numero'])) print('value="'.$dados['funcionario_numero'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="funcionario_bairro">Bairro</label>
                            <input type="text" class="form-control" name="funcionario_bairro" id="funcionario_bairro" placeholder="Informe o bairro" <?php if(isset($dados['funcionario_bairro'])) print('value="'.$dados['funcionario_bairro'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="funcionario_cidade">Cidade</label>
                            <input type="text" class="form-control" name="funcionario_cidade" id="funcionario_cidade" placeholder="Informe a cidade" <?php if(isset($dados['funcionario_cidade'])) print('value="'.$dados['funcionario_cidade'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="funcionario_cep">CEP</label>
                            <input type="text" class="form-control" name="funcionario_cep" id="funcionario_cep" placeholder="Informe o CEP" <?php if(isset($dados['funcionario_cep'])) print('value="'.$dados['funcionario_cep'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="funcionario_telefone">Telefone</label>
                            <input type="text" class="form-control" name="funcionario_telefone" id="funcionario_telefone" placeholder="Informe o telefone" <?php if(isset($dados['funcionario_telefone'])) print('value="'.$dados['funcionario_telefone'].'"'); if(!$editable) print("disabled") ?>>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="funcionario_celular">Celular</label>
                            <input type="text" class="form-control" name="funcionario_celular" id="funcionario_celular" placeholder="Informe o celular" <?php if(isset($dados['funcionario_celular'])) print('value="'.$dados['funcionario_celular'].'"'); if(!$editable) print("disabled") ?>>
                        </div>
                        <?php
							if($_SESSION['usuario_logado']['funcionario_id']!=$dados['funcionario_id'])
							{
						?>
                        <div class="form-group col-xs-6">
                        <label>Cargo</label>
                        <select class="form-control select2" style="width: 100%;" id="crm" name="func_cargo" <?php if(!$editable) print("disabled"); ?>>
                            <option <?php if(isset($dados['atendente_ativo']) && $dados['atendente_ativo']=1) print("selected='selected'"); ?> value="0">Atendente</option>
                            <option <?php if(isset($dados['medico_ativo']) && $dados['medico_ativo']=1) print("selected='selected'"); ?> value="1">Médico</option>
							<!-- <option <?php if(isset($dados['administrador_ativo']) && $dados['administrador_ativo']=1) print("selected='selected'"); ?> value="2">Administrador</option> -->
                        </select>
                        </div>
                        <div id="hidden_crm" class="form-group col-xs-6" <?php if(!(isset($dados['medico_ativo']) && $dados['medico_ativo']==1)) print("style='display:none'"); ?>>
                            <label for="medico_crm">CRM</label>
                            <input type="text" class="form-control" name="medico_crm" id="medico_crm" placeholder="Informe o CRM" <?php if(isset($dados['medico_crm'])) print('value="'.$dados['medico_crm'].'"'); if(!$editable) print("disabled") ?>>
                        </div>
						<?php
							}
						?>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                    <a href="?pag=funcionario&acao=listar" class='btn btn-flat btn-default pull-left'>Voltar</a>
                    <?php
                    
                        if(isset($dados['funcionario_id'])) print("<input type='hidden' name='funcionario_id' value='".$dados['funcionario_id']."'>");
                        if($editable) print("<input type='submit' name='submit' value='Salvar' class='btn btn-flat btn-success pull-right '>");
                        if(!$editable){
                        ?>
                        <div id="editar">
                            <a href='?pag=funcionario&acao=resetarsenha&id=<?php print($_GET['id'])?>' class='btn btn-flat btn-default pull-right '>Resetar Senha</a>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        <?php
    }
    
    
    
    public static function formPaciente($dados = null, $editable = true)
    {
        /*
         paciente_id INT PRIMARY KEY AUTO_INCREMENT,
        paciente_nome VARCHAR(40) NOT NULL,*
        paciente_cpf CHAR(14) UNIQUE NOT NULL,*
        paciente_senha VARCHAR(25),
        paciente_rg VARCHAR(14) NOT NULL,*
        paciente_dataNascimento DATE NOT NULL,*
        paciente_sexo CHAR(1) NOT NULL,*
        paciente_logradouro VARCHAR(50) NOT NULL,
        paciente_numero VARCHAR(6) NOT NULL,
        paciente_bairro VARCHAR(20) NOT NULL,
        paciente_cidade VARCHAR(40) NOT NULL,
        paciente_cep VARCHAR(11) NOT NULL,
        paciente_telefone VARCHAR(14) NOT NULL,
        paciente_celular VARCHAR(14) NOT NULL,
        paciente_nomeMae VARCHAR(50) NOT NULL,
        paciente_nomePai VARCHAR(50),
        paciente_cartaoSus VARCHAR(30) NOT NULL,
        paciente_ativo BOOLEAN DEFAULT TRUE
         */
        $action = 'inserir';
        if(isset($dados)) $action = 'alterar'
        ?>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Paciente</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="?pag=paciente&acao=<?php print($action)?>" method="post" role="form" onsubmit="return validateForm()" name="myForm">
                    <div class="box-body row">
                        <div class="form-group col-xs-12">
                        <label for="paciente_nome">Nome completo</label>
                        <input type="text" class="form-control" name="paciente_nome" id="paciente_nome"  placeholder="Nome completo" <?php if(isset($dados['paciente_nome'])) print('value="'.$dados['paciente_nome'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                        <div class="form-group col-xs-7">
                        <label for="paciente_cpf">CPF</label>
                        <input type="text" class="form-control" name="paciente_cpf" id="paciente_cpf" placeholder="Informe o cpf" <?php if(isset($dados['paciente_cpf'])) print('value="'.$dados['paciente_cpf'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-5">
                            <label for="paciente_rg">RG</label>
                            <input type="text" class="form-control" name="paciente_rg" id="paciente_rg" placeholder="Informe o RG" <?php if(isset($dados['paciente_rg'])) print('value="'.$dados['paciente_rg'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group col-xs-9">
                        <label>Data de Nascimento</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control" name="paciente_dataNascimento" <?php if(isset($dados['paciente_dataNascimento'])) print('value="'.$dados['paciente_dataNascimento'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group col-xs-3">
                            <label for="">Genero</label>
                            <div class="row">
                            <div class="col-xs-6">
                            <input type="radio" name="paciente_sexo" value="F" class="minimal" <?php if($dados['paciente_sexo']=="F") print("checked"); else if(!$editable) print("disabled");?>>
                                Feminino
                            </div class="col-xs-6">
                                <input type="radio" name="paciente_sexo" value="M" class="minimal" <?php if($dados['paciente_sexo']=="M") print("checked"); else if(!$editable) print("disabled"); ?>>
                                Masculino
                            </div>
                        </div>
                        <div class="form-group col-xs-8">
                            <label for="paciente_logradouro">Logradouro</label>
                            <input type="text" class="form-control" name="paciente_logradouro" id="paciente_logradouro" placeholder="Informe o logradouro" <?php if(isset($dados['paciente_logradouro'])) print('value="'.$dados['paciente_logradouro'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-4">
                            <label for="paciente_numero">Numero</label>
                            <input type="text" class="form-control" name="paciente_numero" id="paciente_numero" placeholder="Informe o numero" <?php if(isset($dados['paciente_numero'])) print('value="'.$dados['paciente_numero'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="paciente_bairro">Bairro</label>
                            <input type="text" class="form-control" name="paciente_bairro" id="paciente_bairro" placeholder="Informe o bairro" <?php if(isset($dados['paciente_bairro'])) print('value="'.$dados['paciente_bairro'].'"'); if(!$editable) print("disabled") ?> required> 
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="paciente_cidade">Cidade</label>
                            <input type="text" class="form-control" name="paciente_cidade" id="paciente_cidade" placeholder="Informe a cidade" <?php if(isset($dados['paciente_cidade'])) print('value="'.$dados['paciente_cidade'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="paciente_cep">CEP</label>
                            <input type="text" class="form-control" name="paciente_cep" id="paciente_cep" placeholder="Informe o CEP" <?php if(isset($dados['paciente_cep'])) print('value="'.$dados['paciente_cep'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="paciente_telefone">Telefone</label>
                            <input type="text" class="form-control" name="paciente_telefone" id="paciente_telefone" placeholder="Informe o telefone" <?php if(isset($dados['paciente_telefone'])) print('value="'.$dados['paciente_telefone'].'"'); if(!$editable) print("disabled") ?>>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="paciente_celular">Celular</label>
                            <input type="text" class="form-control" name="paciente_celular" id="paciente_celular" placeholder="Informe o celular" <?php if(isset($dados['paciente_celular'])) print('value="'.$dados['paciente_celular'].'"'); if(!$editable) print("disabled") ?>>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="paciente_nomeMae">Nome da Mae</label>
                            <input type="text" class="form-control" name="paciente_nomeMae" id="paciente_nomeMae" placeholder="Informe o nome da mae" <?php if(isset($dados['paciente_nomeMae'])) print('value="'.$dados['paciente_nomeMae'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="paciente_nomePai">Nome do Pai</label>
                            <input type="text" class="form-control" name="paciente_nomePai" id="paciente_nomePai" placeholder="Informe o nome do pai" <?php if(isset($dados['paciente_nomePai'])) print('value="'.$dados['paciente_nomePai'].'"'); if(!$editable) print("disabled") ?>>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="paciente_cartaoSus">Cartão SUS</label>
                            <input type="text" class="form-control" name="paciente_cartaoSus" id="paciente_cartaoSus" placeholder="Informe o numero do cartão SUS" <?php if(isset($dados['paciente_cartaoSus'])) print('value="'.$dados['paciente_cartaoSus'].'"'); if(!$editable) print("disabled") ?> required>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                    <a href="?pag=paciente&acao=listar" class='btn btn-flat btn-default  pull-left'>Voltar</a>
                    <?php
                    
                        if(isset($dados['paciente_id'])) print("<input type='hidden' name='paciente_id' value='".$dados['paciente_id']."'>");
                        if($editable) print("<input type='submit' name='submit' value='Salvar' class='btn btn-flat btn-success pull-right '>");
                        if(!$editable){
                        ?>
                        <div id="editar">
                            <a href='?pag=paciente&acao=trocasenha&id=<?php print($_GET['id'])?>' class='btn btn-flat btn-default pull-right ' style="margin-left:5px">Alterar Senha</a>
                            <a href='?pag=paciente&acao=resetarsenha&id=<?php print($_GET['id'])?>' class='btn btn-flat btn-default pull-right '>Resetar Senha</a>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        <?php
    }
    
    
    public static function formMedicamento($dados = null, $editable = true)
    {
        /*
         medicamento_id INT PRIMARY KEY AUTO_INCREMENT,
        medicamento_nome VARCHAR(40) NOT NULL,
        medicamento_ativo BOOLEAN DEFAULT TRUE
         */
        $action = 'inserir';
        if(isset($dados)) $action = 'alterar'
        ?>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Medicamento</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="?pag=medicamento&acao=<?php print($action)?>" method="post" role="form">
                    <div class="box-body row">
                        <div class="form-group col-xs-12">
                            <label for="medicamento_nome">Descrição</label>
                            <input type="text" class="form-control" name="medicamento_nome" id="medicamento_nome"  placeholder="Nome medicamento" <?php if(isset($dados['medicamento_nome'])) print('value="'.$dados['medicamento_nome'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                    <a href="?pag=medicamento&acao=listar" class='btn btn-flat btn-default pull-left'>Voltar</a>
                    <?php
                    
                        if(isset($dados['medicamento_id'])) print("<input type='hidden' name='medicamento_id' value='".$dados['medicamento_id']."'>");
                        if($editable) print("<input type='submit' name='submit' value='Salvar' class='btn btn-flat btn-success pull-right'>");
                        ?>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        <?php
    }
    
    public static function formLoteMedicamento($medicamento_id, $dados = null, $editable = true)
    {
        /*
         medicamento_id INT PRIMARY KEY AUTO_INCREMENT,
        medicamento_nome VARCHAR(40) NOT NULL,
        medicamento_ativo BOOLEAN DEFAULT TRUE
         */
        $action = 'inserirlote';
        if(isset($dados)) $action = 'alterarlote'
        ?>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Adicionar Lote</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="?pag=medicamento&acao=<?php print($action."&medicamento_id=".$medicamento_id)?>" method="post" role="form">
                    <div class="box-body row">
                        <div class="form-group col-xs-12">
                            <label for="mlote_codigo">Código</label>
                            <input type="text" class="form-control" name="mlote_codigo" id="mlote_codigo"  placeholder="Código do lote" <?php if(isset($dados['mlote_codigo'])) print('value="'.$dados['mlote_codigo'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="mlote_chegada">Chegada</label>
                            <input type="date" class="form-control" name="mlote_chegada" id="mlote_chegada"  <?php if(isset($dados['mlote_chegada'])) print('value="'.$dados['mlote_chegada'].'"'); else print('value="'.date('Y-m-d', time()).'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="mlote_vencimento">Vencimento</label>
                            <input type="date" class="form-control" name="mlote_vencimento" id="mlote_vencimento"   <?php if(isset($dados['mlote_vencimento'])) print('value="'.$dados['mlote_vencimento'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="mlote_qtd">Quantidade</label>
                            <input type="text" class="form-control" name="mlote_qtd" id="mlote_qtd"  placeholder="Quantidade" <?php if(isset($dados['mlote_qtd'])) print('value="'.$dados['mlote_qtd'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                    <a onClick="history.go(-1)" class='btn btn-flat btn-default pull-left'>Voltar</a>
                    <?php
                    
                        if(isset($dados['medicamento_id'])) print("<input type='hidden' name='medicamento_id' value='".$dados['medicamento_id']."'>");
                        if($editable) print("<input type='submit' name='submit' value='salvar' class='btn btn-flat btn-success pull-right'>");
                        ?>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        <?php
    }
    
    
    

    public static function formVacina($dados = null, $editable = true)
    {
        /*
         vacina_id INT PRIMARY KEY AUTO_INCREMENT,
        vacina_nome VARCHAR(40) NOT NULL,
        vacina_ativo BOOLEAN DEFAULT TRUE
         */
        $action = 'inserir';
        if(isset($dados)) $action = 'alterar'
        ?>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Vacina</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="?pag=vacina&acao=<?php print($action)?>" method="post" role="form">
                    <div class="box-body row">
                        <div class="form-group col-xs-12">
                            <label for="vacina_nome">Nome vacina</label>
                            <input type="text" class="form-control" name="vacina_nome" id="vacina_nome"  placeholder="Nome vacina" <?php if(isset($dados['vacina_nome'])) print('value="'.$dados['vacina_nome'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                    <a href="?pag=vacina&acao=listar" class='btn btn-flat btn-default pull-left'>Voltar</a>
                    <?php
                    
                        if(isset($dados['vacina_id'])) print("<input type='hidden' name='vacina_id' value='".$dados['vacina_id']."'>");
                        if($editable) print("<input type='submit' name='submit' value='Salvar' class='btn btn-flat btn-success pull-right'>");
                        ?>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        <?php
    }
    
    public static function formLoteVacina($vacina_id, $dados = null, $editable = true)
    {
        /*
         vacina_id INT PRIMARY KEY AUTO_INCREMENT,
        vacina_nome VARCHAR(40) NOT NULL,
        vacina_ativo BOOLEAN DEFAULT TRUE
         */
        $action = 'inserirlote';
        if(isset($dados)) $action = 'alterarlote'
        ?>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Adicionar Lote</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="?pag=vacina&acao=<?php print($action."&vacina_id=".$vacina_id)?>" method="post" role="form">
                    <div class="box-body row">
                        <div class="form-group col-xs-12">
                            <label for="vlote_codigo">Código</label>
                            <input type="text" class="form-control" name="vlote_codigo" id="vlote_codigo"  placeholder="Código do lote" <?php if(isset($dados['vlote_codigo'])) print('value="'.$dados['vlote_codigo'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="vlote_chegada">Chegada</label>
                            <input type="date" class="form-control" name="vlote_chegada" id="vlote_chegada"  <?php if(isset($dados['vlote_chegada'])) print('value="'.$dados['vlote_chegada'].'"'); else print('value="'.date('Y-m-d', time()).'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="vlote_vencimento">Vencimento</label>
                            <input type="date" class="form-control" name="vlote_vencimento" id="vlote_vencimento"   <?php if(isset($dados['vlote_vencimento'])) print('value="'.$dados['vlote_vencimento'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="vlote_qtd">Quantidade</label>
                            <input type="text" class="form-control" name="vlote_qtd" id="vlote_qtd"  placeholder="Quantidade" <?php if(isset($dados['vlote_qtd'])) print('value="'.$dados['vlote_qtd'].'"'); if(!$editable) print("disabled"); ?> required>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                    <a onClick="history.go(-1)" class='btn btn-flat btn-default pull-left'>Voltar</a>
                    <?php
                    
                        if(isset($dados['vacina_id'])) print("<input type='hidden' name='vacina_id' value='".$dados['vacina_id']."'>");
                        if($editable) print("<input type='submit' name='submit' value='Salvar' class='btn btn-flat btn-success pull-right'>");
                        ?>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        <?php
    }

    public static function montarTabelaCategorias($dados)
    {
        //print_r($_SERVER['REQUEST_URI']);
        //echo('<a href="'.$_SERVER['REQUEST_URI'].'">Teste</a>');
        //echo('<a href="?pag=categoria&acao=listar">Teste</a>');

        echo("<table><tr><th>Categoria</th><th>Opções</th></tr>");
        foreach($dados as $cat)
        {
            echo("<tr><td>".$cat['descricao']."<td>");
            echo('<td><a href="?pag=categoria&acao=alterar&cod='.$cat["codCategoria"].'">Alterar</a>');
            echo(' <a href="?pag=categoria&acao=excluir&cod='.$cat["codCategoria"].'">Excluir</a></td></tr>');
        }
        echo("</table>");
    }
    
    public static function montarFormAlterarCat($dados)
    {
        $cod = $dados['codCategoria'];
        $descricao = $dados['descricao'];
        ?>
        <form action="?pag=categoria&acao=confirmalt" method="post">
            <input type='text' name='descricao' value='<?php echo($descricao) ?>'>
            <input type='hidden' name='cod' value='<?php echo($cod) ?>'>
            
            <input type='submit' name='submit' value='Submit'>
        </form>
        <?php
    }
    
    
    public static function formNovoFunc()
    {
        ?>
        <form action="?pag=funcionario&acao=inserir" method="post">
            <table>
                <tr>
                    <th><label for="nome">Nome Completo</label></th>
                    <td><input type="text" name="nome"></td>
                </tr>
                <tr>
                    <th><label for="cargo">Cargo</label></th>
                    <td>
                        <select name="cargo">
                            <option value="Bibliotecário">Bibliotecário</option>
                            <option value="Atendente">Atendente</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="email">E-mail</label></th>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <th><label for="senha">Senha</label></th>
                    <td><input type="password" name="senha"></td>
                </tr>
            </table>
            <br>
            <input type='submit' name='submit' value='Submit'>
        </form>
        <?php
    }
    
    public static function formFuncLogin()
    {
        ?>
        <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>Sic</b>Kure</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Entre para iniciar sua sessão</p>

            <form action="?pag=login&acao=validarlogin" method="post">
            <div class="form-group has-feedback">
                <input type="cpf" class="form-control" name="cpf" placeholder="Informe o CPF">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="senha" placeholder="senha">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                <button type="submit" class="btn btn-flat btn-primary btn-block  pull-right" name='submit'>Entrar</button>
                </div>
                <!-- /.col -->
            </div>
            </form>


        </div>
        <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <?php
    }
    
    public static function formAlteraUser($dados)
    {
        ?>
        <form action="?pag=usuario&acao=alteraconfirm" method="post">
            <b>
            <?php echo("Alteração de dados básicos - Prontuário: ".$dados['prontuario']);?>
            </b>
            <br><br><br>
            <table>
                <tr>
                    <th><label for="nome">Nome Completo</label></th>
                    <td><input type="text" name="nome" value="<?php echo($dados['nomeCompleto']);?>"></td>
                </tr>
                <tr>
                    <th><label for="email">E-mail</label></th>
                    <td><input type="text" name="email" value="<?php echo($dados['email']);?>"></td>
                </tr>
            </table>
            <br>
            <input type="hidden" name="cod" value="<?php echo($dados['codUsuario'])?>">
            <input type='submit' name='submit' value='Alterar'>
        </form>
        <?php
    }
    
    public static function consultaAgendarForm($id)
    {
        ?>
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Agendar Consulta</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="?pag=consulta&acao=agendarconsultar&paciente_id=<?php print($id);?>" method="post" role="form">
                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="consulta_data">Data</label>
                        <input type="date" class="form-control" name="consulta_data" id="consulta_data"  <?php if(isset($dados['consulta_data'])) print('value="'.$dados['consulta_data'].'"'); else print('value="'.date('Y-m-d', time()).'"');?> required>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="consulta_desc">Descrição</label>
                        <input type="text" class="form-control" name="consulta_desc" id="consulta_desc"  placeholder="Descrição" <?php if(isset($dados['consulta_desc'])) print('value="'.$dados['consulta_desc'].'"');?> required>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="consulta_funcionario">Medico</label>
                        <select name="funcionario_id" class="form-control select2">
                        <option value="-1">INDEFINIDO</option>
                            <?php
                            $useDB = new Funcionario();
                            $medicos = $useDB->searchMedicos();
                            foreach($medicos as $med)
                            {
                                print("<option value='".$med['funcionario_id']."'>".$med['funcionario_nome']."</option>");
                            }
                            ?>
                        </select>   
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a onClick="history.go(-1)" class='btn btn-flat btn-default pull-left'>Voltar</a>
                    <input type="submit" name="submit" value="Salvar" class='btn btn-flat btn-success pull-right'>
                    </form>
                </div>
        </div>
        <!-- /.box -->
    <?php
    }

    public static function relatorioVacinacao()
    {
        $comando = "";
        if(isset($_POST['submit'])) $comando = $_POST['submit'];
        if($comando=="Buscar")
        {
            if(isset($_POST['datainicio']) && isset($_POST['datafim']))
            {
                $inicio = str_replace("T", " ", $_POST['datainicio']);
                $inicio = $inicio.":00";
                $fim = str_replace("T", " ", $_POST['datafim']);
                $fim = $fim.":59";
                $total = 0;
                $useDB = new CarteiraVacinacao();
                $vacinas = $useDB->searchPorPeriodo(1, $inicio, $fim);
                
                
                ?>
                 <div class="invoice row no-print container-fluid bg-navy" style="padding: 10px">
                        <div class="col-xs-12">
                        <a href="?pag=relatorios&acao=relatoriovacinacao"  class="btn btn-flat btn-default  pull-left" ><i class="fa fa-step-backward"></i> Voltar</a>
                        <a href="#"  class="btn btn-flat btn-default  pull-right" onclick="window.print()"><i class="fa fa-print"></i> Imprimir</a>
                        </div>
                    </div>
                <section class="invoice">
                <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                            <i class="fa fa-heartbeat"></i><strong> Sic</strong>Kure, Vacinas aplicadas.
                            <small class="pull-right" style="margin-top:-5px">Periodo: <?php print("<b>".$inicio."</b> até <b>".$fim."</b>"); ?><br>Gerado em: <?php print("<b>".date('Y-m-d H:i:s')."</b>"); ?></small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">

                    <!-- Table row -->
                    <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Dia</th>
                            <th>Hora</th>
                            <th>Paciente</th>
                            <th>Vacina</th>
                            <th>Lote</th>
                            <th>Funcionário</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($vacinas as $vac)
                            {
                                $total++;
                                $pieces = explode(" ", $vac['cvac_data']);
                                print("<tr>");
                                print("<td>".$pieces[0]."</td>");
                                print("<td>".$pieces[1]."</td>");
                                print("<td>".$vac['paciente_nome']."</td>");
                                print("<td>".$vac['vacina_nome']."</td>");
                                print("<td>".$vac['vlote_codigo']."</td>");
                                print("<td>".$vac['funcionario_nome']."</td>");
                                print("</tr>");
                            }
                            ?>
                        </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                    
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12" >
                            <p class="pull-right" style="margin-right: 8px; text-transform: uppercase">
                             <strong>
                                <?php  print("Total de vacinas: ".$total); ?>
                             </strong>
                            </p>
                        </div>
                    </div>
                    
                   
                </section>
                <!-- /.content -->
                <?php
            }
        }
        else if($comando=="Dia")
        {
            $hojedia = date("Y-m-d");
            $horainicio = "00:00";
            $horafim = "23:59";
            $tempoInicial = $hojedia."T".$horainicio;
            $tempoFinal = $hojedia."T".$horafim;
        }
        else if($comando=="Semana")
        {
            
            $day = date('w');
            $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
            $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
            $horainicio = "00:00";
            $horafim = "23:59";
            $tempoInicial = $week_start."T".$horainicio;
            $tempoFinal = $week_end."T".$horafim;
             
        }
        else if($comando=="Mes")
        {
            
            $week_start = date('Y-m-01');
            $week_end = date('Y-m-t');
            $horainicio = "00:00";
            $horafim = "23:59";
            $tempoInicial = $week_start."T".$horainicio;
            $tempoFinal = $week_end."T".$horafim;
             
        }
        if($comando!="Buscar")
        {
            ?>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Relátorio vacinação</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="" method="post" role="form">
                    <div class="box-body row">
                        <div class="form-group col-xs-6">
                            <label for="datainicio">Data Inicio</label>
                            <input type="datetime-local" class="form-control" name="datainicio" id="datainicio"  <?php if(isset($tempoInicial)) print("value='".$tempoInicial."'") ?>>
                        </div>
    
                        <div class="form-group col-xs-6">
                            <label for="datafim">Data Fim</label>
                            <input type="datetime-local" class="form-control" name="datafim" id="datafim"  <?php if(isset($tempoFinal)) print("value='".$tempoFinal."'") ?>>
                        </div>
                        <div class="form-group col-xs-6">
                        <div class="btn btn-flat-group pull-left">
                            <input type="submit" name="submit" value="Dia" class='btn btn-flat bg-navy '>
                            <input type="submit" name="submit" value="Semana" class='btn btn-flat bg-navy '>
                            <input type="submit" name="submit" value="Mes" class='btn btn-flat bg-navy '>
                        </div>   
                        
                        </div>
                    </div>
                    <!-- /.box-body -->
    
                    <div class="box-footer">
                        <a onClick="history.go(-1)" class='btn btn-flat btn-default pull-left '>Voltar</a>
                        <input type="submit" name="submit" value="Buscar"  class='btn btn-flat btn-success pull-right '>
              
                    </form>
                    </div>
            </div>
            <!-- /.box -->
        <?php   
        }
    }
    
    
    public static function relatorioEstoqueMed()
    {
        ?>
            <div class="invoice row no-print container-fluid bg-navy" style="padding: 10px">
                <div class="col-xs-12">
                <a href="?pag=relatorios&acao=relatoriovacinacao"  class="btn btn-flat btn-default  pull-left" ><i class="fa fa-step-backward"></i> Voltar</a>
                <a href="#"  class="btn btn-flat btn-default  pull-right" onclick="window.print()"><i class="fa fa-print"></i> Imprimir</a>
                </div>
            </div>
        <section class="invoice">
        <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                    <i class="fa fa-heartbeat"></i><strong> Sic</strong>Kure, Estoque de Medicamentos.
                    <small class="pull-right" style="margin-top:-5px">Gerado em: <?php print("<b>".date('Y-m-d H:i:s')."</b>"); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
            <?php
            $dataagora = date_create(date('Y-m-d', time()));
            $medsDB = new Medicamento();
            $meds = $medsDB->search();
            foreach($meds as $med)
            {
                if($med['medicamento_ativo']==1)
                {
                    $total = 0;
                    $total_venc = 0;
                    print("<h2>Medicamento: ".$med['medicamento_nome']."</h2>");
                    $lotesDB = new LoteMedicamento();
                    $lotes = $lotesDB->searchPorMedicamentos($med['medicamento_id']);
            ?>
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Estoque</th>
                        <th>Chegada</th>
                        <th>Vencimento</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($lotes as $lote)
                        {
                            $total += $lote['mlote_qtd'];
                            
                            print("<tr><td>".$lote['mlote_codigo']."</td>");
                            print("<td>".$lote['mlote_qtd']."</td>");
                            print("<td>".$lote['mlote_chegada']."</td>");
                            print("<td>");
                            $venc = date_create($lote['mlote_vencimento']);
                            $diff=date_diff($dataagora,$venc);
                            $diffDias = $diff->format("%R%a");
                            if($diffDias<0)
                            {
                                $total_venc += $lote['mlote_qtd'];
                                print('<font color="red">');
                            }
                            else
                            {
                                if($diffDias==0) print('<font color="yellow">');
                                else print('<font color="green">');
                            }
                            print($lote['mlote_vencimento']."</font></td></tr>");
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Total</th>
                        <th>Não Vencidas</th>
                        <th>Vencidas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        print("<td>".$total."</td>");
                        print("<td>".($total-$total_venc)."</td>");
                        print("<td>".$total_venc."</td>");
                    ?> 
                    </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <?php
                }
            }
            ?>
            
        </section>
        <!-- /.content -->
        <?php
    }
    
}
