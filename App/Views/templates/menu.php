<?php
if(isset($_SESSION['usuario_logado'])):
            $perm_administrador = 0;
            $perm_atendente = 0;
            $perm_medico = 0;
            $perm_paciente = 0;
            
            if(isset($_SESSION['usuario_logado']['administrador_ativo'])) $perm_administrador = 1;
            if(isset($_SESSION['usuario_logado']['atendente_ativo'])) $perm_atendente = 1;
            if(isset($_SESSION['usuario_logado']['medico_ativo'])) $perm_medico = 1;
            if(isset($_SESSION['usuario_logado']['paciente_id'])) $perm_paciente = 1;

?>
<!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>K</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sic</b>Kure</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          
            <!-- Menu Toggle Button -->
            
              <!-- The user image in the navbar-->
              <!-- <img src="layout/dist/img/avatar.jpg" class="user-image" alt="User Image"> -->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <?php
              
              if(isset($_SESSION['usuario_logado']['funcionario_id']))
              {
                  if(isset($_SESSION['usuario_paciente']))
                  {
                      ?>
                      <li class="dropdown user user-menu">
                      <a href="?pag=login&acao=trocaracesso">
                        <!-- The user image in the navbar-->
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">Acessar como Paciente</span>
                      </a>
                      </li>
                    <?php
                  }
              }
              else if(isset($_SESSION['usuario_logado']['paciente_id']))
              {
                  if(isset($_SESSION['usuario_funcionario']))
                  {
                      ?>
                      <li class="dropdown user user-menu">
                      <a href="?pag=login&acao=trocaracesso">
                        <!-- The user image in the navbar-->
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">Acessar como Funcionario</span>
                      </a>
                      </li>
                    <?php
                  }
              }
              
                ?>
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="layout/dist/img/avatar.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php if(isset($_SESSION['usuario_logado']['funcionario_id'])) print($_SESSION['usuario_logado']['funcionario_nome']); else if(isset($_SESSION['usuario_logado']['paciente_id'])) print($_SESSION['usuario_logado']['paciente_nome']); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="layout/dist/img/avatar.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php
                  if(isset($_SESSION['usuario_logado']['funcionario_id'])) print($_SESSION['usuario_logado']['funcionario_nome']);
                  else if(isset($_SESSION['usuario_logado']['paciente_id'])) print($_SESSION['usuario_logado']['paciente_nome']);
                  
                  ?>
                  <small>
                   
                  </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                    <?php
                    if(isset($_SESSION['usuario_logado']['funcionario_id']))
                    {
                    ?>
                  <a href="?pag=funcionario&acao=editar&id=<?php print($_SESSION['usuario_logado']['funcionario_id']) ?>" class="btn btn-default btn-flat">Perfil</a>
                  <a href='?pag=funcionario&acao=trocasenha&id=<?php print($_SESSION['usuario_logado']['funcionario_id'])?>' class='btn btn-flat btn-default'>Alterar Senha</a>
                  <?php
                    }
                    else if(isset($_SESSION['usuario_logado']['paciente_id']))
                    {
                  ?>
                    <a href="?pag=paciente&acao=editar&id=<?php print($_SESSION['usuario_logado']['paciente_id']) ?>" class="btn btn-default btn-flat">Perfil</a>
                    <a href='?pag=paciente&acao=trocasenha&id=<?php print($_SESSION['usuario_logado']['paciente_id'])?>' class='btn btn-flat btn-default'>Alterar Senha</a>
                  
                  <?php
                    }
                  ?>
                </div>
                <div class="pull-right">
                  <a href="?pag=login&acao=logout" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="index.php"><i class="fa fa-dashboard "></i> <span>DASHBOARD</span></a></li>
         <?php
       
            
            if($perm_administrador>0)
                print('<li><a href="?pag=funcionario&acao=listar"><i class="fa fa-user"></i> <span>Funcionário</span></a></li>');
            if($perm_atendente>0)
            {
                print('<li><a href="?pag=paciente&acao=listar"><i class="fa fa-group"></i> <span>Paciente</span></a></li>');
                print('<li><a href="?pag=vacina&acao=listar"><i class="fa fa-eyedropper"></i> <span>Vacina</span></a></li>');
                print('<li><a href="?pag=medicamento&acao=listar"><i class="fa fa-medkit"></i> <span>Medicamento</span></a></li>');
                print('<li><a href="?pag=consulta&acao=listarpacientes"><i class="fa fa-list-alt"></i> <span>Consulta</span></a></li>');
            }
            if($perm_paciente!=1)print('<li><a href="?pag=vacinacao&acao=listarpacientes"><i class="fa fa-table"></i> <span>Vacinação</span></a></li>');
            if($perm_paciente==1)
            {
                print('<li><a href="?pag=vacinacao&acao=visualizarpaciente&paciente_id='.$_SESSION['usuario_logado']['paciente_id'].'"><i class="fa fa-eyedropper"></i> <span>Vacinação</span></a></li>');
                print('<li><a href="?pag=consulta&acao=visualizarpaciente&paciente_id='.$_SESSION['usuario_logado']['paciente_id'].'"><i class="fa fa-list-alt"></i> <span>Consultas</span></a></li>');
            }
            if($perm_atendente>0 || $perm_medico>0 || $perm_administrador>0):
          ?>  
          <li class="treeview">
            <a href="#"><i class="fa fa-file-pdf-o"></i> <span>Relátorios</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?pag=relatorios&acao=relatoriovacinacao">Vacinação</a></li>
              <li><a href="?pag=relatorios&acao=relatorioestoquemed">Estoque de Medicamento</a></li>
            </ul>
          </li>
            <?php endif; ?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Main content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header)
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>
     -->
     <!-- Main content -->
     <section class="content container-fluid">
  <?php
    endif;
  ?>  