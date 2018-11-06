</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php if(isset($_SESSION['usuario_logado'])): ?>
  <!-- Main Footer -->
  <footer class="main-footer no-print">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
     <!-- Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">Cézinha, Hudson e MiGuéias</a>.</strong> Todos os direitos reservados.
  </footer>
  <?php endif ?>
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="layout/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="layout/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="layout/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="layout/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Select2 -->
<script src="layout/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="layout/dist/js/adminlte.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<!-- SlimScroll -->
<script src="layout/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="layout/fastclick/lib/fastclick.js"></script>
<!-- InputMask -->
<script src="layout/input-mask/jquery.inputmask.js"></script>
<script src="layout/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="layout/input-mask/jquery.inputmask.extensions.js"></script>

 <script>
        $(function () {
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            $('[data-mask]').inputmask()
            $('#example1').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                "scrollX"     : true,
                "order"       : [[ 0, "desc" ]],
                'language'    : {
                    "emptyTable"  :"Sem dados disponíveis na tabela",
                    "search"      : "Buscar:",
                    "lengthMenu"  : "Mostrar _MENU_ Registros",
                    "info"        : "Mostrando de _START_ a _END_ de _TOTAL_ registro(s)",
                    "infoEmpty"   : "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered": "(filtrado de um total de _MAX_ registros)",
                    "paginate"    : {
                            "first"   :"Primeiro",
                            "last"    :"Último",
                            "next"    :"Próximo",
                            "previous":"Anterior"
                    }
                }
            });
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                "scrollX"     : true,
                "order"       : [[ 0, "desc" ]],
                'language'    : {
                    "emptyTable"  :"Sem dados disponíveis na tabela",
                    "search"      : "Buscar:",
                    "lengthMenu"  : "Mostrar _MENU_ Registros",
                    "info"        : "Mostrando de _START_ a _END_ de _TOTAL_ registro(s)",
                    "infoEmpty"   : "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered": "(filtrado de um total de _MAX_ registros)",
                    "paginate"    : {
                            "first"   :"Primeiro",
                            "last"    :"Último",
                            "next"    :"Próximo",
                            "previous":"Anterior"
                    }
                }
            });
            $('.select2').select2();
            
        });
        
        

        $(function() {
            $('#crm').change(function(){
                if($(this).val() == 0)
                    $('#hidden_crm').hide();
                else
                    $('#hidden_crm').show();
            });
        });
    </script>
</body>
</html>