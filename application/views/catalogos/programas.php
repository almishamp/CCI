

<?php $this->layout('main', ['title'=>'Catalogos'])?>
<?php $this->start('extra_style')?>

<?php $this->stop()?>
<?php $this->start('page')?>



<div id="toolbarCatProgramas">
    <button type="button" class="btn btn-primary" id="btnMostrarCprog">Detalles</button>
    <button type="button" class="btn btn-primary" id="btnEditarCprog">Editar</button>
    <button type="button" class="btn btn-primary" id="btnAgregarCprog">Agregar programa</button>
</div>

<section class="content-header">
    <h1>
      Catalogo programas
    </h1>
    <ol class="breadcrumb">
      <!--li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li-->
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                 <br><br>
                  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="dataTables_length" id="example1_length">

                          </div>
                        </div> 
                        <div class="col-sm-6">
                          <div id="example1_filter" class="dataTables_filter">
                            
                          </div>
                        </div> 
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="tCatProgramas"></table>

                        </div>
                      </div>
                  </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->  
    </div>
    <!-- /.row -->
</section>

  <!--MODAL CATALOGO PROGRAMA-->
  <div class="modal modal-default fade" id="modal_CProgramas">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_close_catPrograma">
            <span aria-hidden="true">&times;</span></button>
          <h4 id="CPDetalle" class="modal-title">Detalle programa</h4>
          <h4 id="CPEdicion" class="modal-title">Edición programa</h4>
          <h4 id="CPNuevo" class="modal-title">Nuevo programa</h4>
        </div>

        <div class="modal-body"> 
          <form action="#" id="form_cprogramas" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-3">Programa: </label>
                  <div class="col-md-6">
                      <span class="help-block" id="nombreCP"></span>
                      <input type="text" name="nombrecp_input" id="nombrecp_input" size="60" class="mayusculas">
                      <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Status: </label>
                  <div class="col-md-3">
                      <span class="help-block" id="statusCP"></span>
                      <select class="form-control xs" id="select_statusCP">
                          <option value="1">Activo</option>
                          <option value="0">Inactivo</option>
                      </select>
                  </div>
                </div>
                
            </div>
          </form>    
        </div>
        <div class="modal-footer">
          <input type="button" id="btn_cancelar_cprograma" value="Cancelar" class="btn btn-default pull-left" data-dismiss="modal">
          <button type="button" id="btnSaveCPrograma" class="btn btn-success btn-sm">Guardar cambios</button>

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<?php $this->stop()?>
<?php $this->start('extra_js')?>

  <script src="<?php echo base_url('assets/js/catalogoProgramas.js');?>"></script>

  
<?php $this->stop()?>
