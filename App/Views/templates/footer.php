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

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                    "emptyTable"  :"Nenhum registro encontrado",
                    "search"      : "Buscar:",
                    "lengthMenu"  : "_MENU_ resultados por página",
                    "info"        : "Mostrando de _START_ a _END_ de _TOTAL_ registro(s)",
                    "infoEmpty"   : "Mostrando 0 até 0 de 0 registros",
                    "infoFiltered": "(Filtrados de _MAX_ registros)",
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
                    "emptyTable"  :"Nenhum registro encontrado",
                    "search"      : "Buscar:",
                    "lengthMenu"  : "_MENU_ resultados por página",
                    "info"        : "Mostrando de _START_ a _END_ de _TOTAL_ registro(s)",
                    "infoEmpty"   : "Mostrando 0 até 0 de 0 registros",
                    "infoFiltered": "(Filtrados de _MAX_ registros)",
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
            $("input[id*='mask_cpf']").inputmask({
                mask: ['999.999.999-99'],
                keepStatic: true
            });
        });

        function validateFormFuncionario()
        {
            var x = document.forms["myForm"]["funcionario_cpf"].value;
            var res = x.replace(".","");
            var res = res.replace(".","");
            var res = res.replace("-","");
            if (isNaN(res))
            {
                alert("CPF incompleto, informe 11 digitos numéricos.");
                return false;
            }

        }

        function validateFormPaciente()
        {
            var x = document.forms["myForm"]["paciente_cpf"].value;
            if (x.length!=14)
            {
                alert("CPF incompleto, informe 11 digitos numéricos.");
                return false;
            }

        }
        
    $( function() {
      function log( ui ) {
        //$( "<div>" ).text( message ).prependTo( "#log" );
        //$( "#log" ).scrollTop( 0 );
        $("#paciente_nome").val("oi");
        $("#paciente_cpf").val(ui.item.paciente_cpf);
        $("#paciente_contato").val(ui.item.paciente_telefone);
      }

      $( "#paciente_nome" ).autocomplete({
        source: "./App/Requests/autocompletePaciente.php",
        minLength: 2,
        select: function( event, ui ) {
          log( ui );
        }
      });
    } );
    
    function monkeyPatchAutocomplete() {

          // Don't really need to save the old fn, 
          // but I could chain if I wanted to
          var oldFn = $.ui.autocomplete.prototype._renderItem;

          $.ui.autocomplete.prototype._renderItem = function( ul, item) {
              var re = new RegExp(this.term, "i") ;
              var t = item.label.replace(re,"<span style='font-weight:bold;color:Blue;'>" + this.term + "</span>");
              return $( "<li></li>" )
                  .data( "item.autocomplete", item )
                  .append( "<a>" + t + "</a>" )
                  .appendTo( ul );
          };
      }


      $(document).ready(function() {

          monkeyPatchAutocomplete();

          $("#input1").autocomplete({
              // The source option can be an array of terms.  In this case, if
              // the typed characters appear in any position in a term, then the
              // term is included in the autocomplete list.
              // The source option can also be a function that performs the search,
              // and calls a response function with the matched entries.
              source: function(req, responseFn) {
                  addMessage("search on: '" + req.term + "'<br/>");
                  var re = $.ui.autocomplete.escapeRegex(req.term);
                  var matcher = new RegExp( "^" + re, "i" );
                  var a = $.grep( wordlist, function(item,index){
                      //addMessage("&nbsp;&nbsp;sniffing: '" + item + "'<br/>");
                      return matcher.test(item);
                  });
                  addMessage("Result: " + a.length + " items<br/>");
                  responseFn( a );
              },

              select: function(value, data){
                  if (typeof data == "undefined") {
                      addMessage('You selected: ' + value + "<br/>");
                  }else {
                      addMessage('You selected: ' + data.item.value + "<br/>");
                  }
              }
          });
      });

    </script>
</body>
</html>