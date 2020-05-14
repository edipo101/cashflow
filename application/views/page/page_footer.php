  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?= base_url() ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>

<!-- My script -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#tb_ingresos').load("<?= base_url() ?>home/load_ingresos");
    $('#tb_gastos').load("<?= base_url() ?>home/load_gastos");
    $('#tb_activos').load("<?= base_url() ?>home/load_activos");
    $('#tb_pasivos').load("<?= base_url() ?>home/load_pasivos");

    //Costo total acciones
    $('#cant_acciones').keyup(function(){
      $('#total_acciones').val(this.value * $('#costo_accion').val());
    });
    
    $('#costo_accion').keyup(function(){
      $('#total_acciones').val($('#cant_acciones').val() * this.value);
    });

    $("#modal-acciones").on('hidden.bs.modal', function() {
      $('#modal-message').html('');
      $('#modal-message').hide();
      $('#modal-form')[0].reset();
    });

    //Comprar acciones
    $('#comprar_acciones').click(function(){
      var descripcion = $('#descripcion').val();
      var cant_acciones = $('#cant_acciones').val();
      var costo_accion = $('#costo_accion').val();
      console.log($('#descripcion').val());
      console.log(cant_acciones);
      console.log(costo_accion);

      if (descripcion == "") {
        $('#modal-message').html('El nombre de la compañia es nulo.');
        $('#modal-message').show();
        console.log('Error: descripcion is null');
        return false;
      }

      if (cant_acciones == "") {
        $('#modal-message').html('La cantidad es nula.');
        $('#modal-message').show();
        console.log('Error: cant_acciones is null');
        return false;
      }

      if (costo_accion == "") {
        $('#modal-message').html('El costo x accion es nulo.');
        $('#modal-message').show();
        console.log('Error: costo_accion is null');
        return false;
      }

      $.ajax({
        url: "<?= base_url() ?>home/comprar_acciones",
        method: "post",
        data: {descripcion: descripcion, cant_acciones: cant_acciones, costo_accion: costo_accion},
        success: function(data){
          $('#tb_activos').load("<?= base_url() ?>home/load_activos");
          console.log(data);
        }      
      });

      $('#modal-acciones').modal('hide');
      return true;
    });

    $('#comprar_acciones2').click(function(){
      $('#modal-acciones').modal('hide');
    });

  });
</script>
</body>
</html>
