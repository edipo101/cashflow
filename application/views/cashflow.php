  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php
    $nombre_profesion = "Sin profesion";
    $salario = 0;
    $ahorro = 0;
    $cant_hijos = 0;
    $gastos_hijo = 0;
    if (!is_null($profesion)) {
      $nombre_profesion = $profesion->profesion;
      $salario = $profesion->salario; 
      $ahorro = $profesion->ahorro; 
      $cant_hijos = $profesion->cant_hijos; 
      $gastos_hijo = $profesion->gastos_hijo; 
    }
      // var_dump($gastos_hijo);
    ?>

    <!-- Main content -->
    <section class="content container-fluid">      
      <div class="row">
        <div class="col-md-4 col-xs-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="<?= base_url() ?>/dist/img/user7-128x128.jpg" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?= $nombre_profesion ?></h3>
              <h5 class="widget-user-desc"><?= $this->session->userdata('nombre') ?></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Salario <span class="pull-right badge bg-blue"><?= $salario ?></span></a></li>
                <li><a href="#">Ahorro <span class="pull-right badge bg-aqua"><?= $ahorro ?></span></a></li>
                <li><a href="#">Cantidad de hijos <span class="pull-right badge bg-green"><?= $cant_hijos ?></span></a></li>
                <li><a href="#">Gastos por hijo <span class="pull-right badge bg-red"><?= $gastos_hijo ?></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>

        <div class="col-md-8 col-xs-12">
          <div class="row">
            <!-- Ingreso pasivo -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Ingreso pasivo</span>
                  <span class="info-box-number"><?= $total_ingreso_pasivo ?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>  

            <!-- Gastos totales -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Gastos totales</span>
                  <span class="info-box-number"><?= $total_gastos ?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>

          <div class="row">
            <!-- Cashflow   -->
            <div class="col-md-3"></div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-purple">
                <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Cashflow</span>
                  <span class="info-box-number">0</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>
        </div>
      </div>

      <h2 class="page-header">Declaración de ingresos</h2>

      <div class="row">
        <!-- Tabla Ingresos -->
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Ingresos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Descripción</th>
                    <th>Barra</th>
                    <th style="width: 40px">Cantidad</th>
                  </tr>  
                </thead>
                <tbody id="tb_ingresos"></tbody>
                <tfooter>
                  <tr>
                    <td colspan="3">TOTAL INGRESO PASIVO</td>
                    <td><?= $total_ingreso_pasivo ?></td>
                  </tr>
                  <tr>
                    <td colspan="3">INGRESO TOTAL (Salario + Total Ingreso Pasivo)</td>
                    <td><?= $salario + $total_ingreso_pasivo ?></td>
                  </tr>
                </tfooter> 
              </table>
            </div>
            <!-- /.box-body -->            
          </div>
          <!-- /.box -->        
        </div>
        <!-- col -->

        <!-- Tabla Gastos -->
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Gastos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Descripción</th>
                    <th>Barra</th>
                    <th style="width: 40px">Cantidad</th>
                  </tr>  
                </thead>
                <tbody id="tb_gastos">
                  
                </tbody>
                <tfooter>
                  <tr>
                    <td colspan="3">GASTOS TOTALES</td>
                    <td><?= $total_gastos ?></td>
                  </tr>
                </tfooter>                       
              </table>                
            </div>            
            <!-- /.box-body -->                        

            <div class="box-footer">
              <button type="button" id="okey" class="btn btn-danger pull-right"><i class="fa fa-user"></i> Actualizar hijos
              </button>
            </div>
          </div>
          <!-- /.box -->                  
        </div>
        <!-- col -->
      </div>
      <!-- row -->

      <h2 class="page-header">Balance general</h2>

      <div class="row">
        <!-- Tabla Activos -->
        <div class="col-md-10 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Activos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Descripción</th>
                    <th style="color: blue; ">Cantidad</th>
                    <th style="color: blue; ">Costo acción</th>
                    <th>Depósito</th>
                    <th>Costo Inmueble</th>
                    <th>Barra</th>
                    <th style="width: 100px;">Total</th>
                  </tr>  
                </thead>
                <tbody id="tb_activos">
                  
                </tbody>
              </table>  
            </div>
            <!-- /.box-body -->  
            <div class="box-footer">
                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="" style="margin-left: 8px;"><i class="fa fa-user"></i> Comprar bienes</button> 
                <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#modal-acciones"><i class="fa fa-user"></i> Comprar acciones</button> 
              </button>
            </div>          
          </div>
          <!-- /.box -->        
        </div>
        <!-- col -->
        
        <!-- Tabla Pasivos -->
        <div class="col-md-6 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Pasivos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Descripción</th>
                    <th>Barra</th>
                    <th style="width: 40px">Cantidad</th>
                  </tr>  
                </thead>
                <tbody id="tb_pasivos">
                  
                </tbody>
                <tfooter>
                  <tr>
                    <td colspan="3">TOTAL PASIVOS</td>
                    <td><?= $total_pasivos ?></td>
                  </tr>
                </tfooter>
              </table>  
            </div>
            <!-- /.box-body -->            
          </div>
          <!-- /.box -->        
        </div>
        <!-- col -->
      </div>
      <!-- row -->

      <!-- Modal acciones -->
      <div class="modal fade in" id="modal-acciones" style="display: none; padding-right: 17px;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Comprar acciones</h4>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger alert-dismissible" id="modal-message" style="display: none">
              </div>
              <form id="modal-form">
                <div class="form-group">
                  <label for="descripcion">Nombre compañia</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="">
                </div>
                <div class="form-group">
                  <label for="cant_acciones">Cantidad</label>
                  <input type="number" class="form-control" id="cant_acciones" name="cant_acciones" placeholder="">
                </div>
                <div class="form-group">
                  <label for="costo_accion">Costo x accion</label>
                  <input type="number" class="form-control" id="costo_accion" name="costo_accion" placeholder="">
                </div>
                <div class="form-group">
                  <label for="total_acciones">Costo total</label>
                  <input type="number" class="form-control" id="total_acciones" name="total_acciones" placeholder="" disabled="">
                </div>
              </form>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
              <button type="button" id="comprar_acciones" class="btn btn-primary">Comprar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->