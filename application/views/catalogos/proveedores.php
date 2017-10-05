

<?php $this->layout('main', ['title'=>'Catalogos'])?>
<?php $this->start('extra_style')?>
<?php $this->stop()?>
<?php $this->start('page')?>

<div id="toolbarCatProveedores">
    <button type="button" class="btn btn-primary" id="btnMostrarCprov">Detalles</button>
    <button type="button" class="btn btn-primary" id="btnEditarCprov">Editar</button>
    <button type="button" class="btn btn-primary" id="btnAgregarCprov">Agregar proveedor</button>
</div>

<section class="content-header">
    <h1>
      Catalogo proveedores
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
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
                          <table id="tCatProveedores"></table>

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
  <div class="modal modal-default fade" id="modal_CProveedores">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_close_catPrograma">
            <span aria-hidden="true">&times;</span></button>
          <h4 id="CPVDetalle" class="modal-title">Detalle proveedor</h4>
          <h4 id="CPVEdicion" class="modal-title">Edición proveedor</h4>
          <h4 id="CPVNuevo" class="modal-title">Nuevo proveedor</h4>
        </div>

        <div class="modal-body"> 
          <form action="#" id="form_cproveedores" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-3">Proveedor: </label>
                  <div class="col-md-6">
                      <span class="help-block" id="nombreCPV"></span>
                      <input type="text" name="nombrecpv_input" id="nombrecpv_input" size="60" class="mayusculas">
                      <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Status: </label>
                  <div class="col-md-3">
                      <span class="help-block" id="statusCPV"></span>
                      <select class="form-control xs" id="select_statusCPV" ip="select_statusCPV">
                          <option value="1">Activo</option>
                          <option value="0">Inactivo</option>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Nombre contacto: </label>
                  <div class="col-md-6">
                      <span class="help-block" id="nombreContacto"></span>
                      <input type="text" name="nombreContacto_input" id="nombreContacto_input" size="60" class="mayusculas" >
                      <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Teléono contacto: </label>
                  <div class="col-md-6">
                      <span class="help-block" id="telefonoContacto"></span>
                      <input type="text" name="telefonoContacto_input" id="telefonoContacto_input" size="60">
                      <span class="help-block"></span>
                  </div>
                </div>
            </div>
          </form>    
        </div>
        <div class="modal-footer">
          <input type="button" id="btn_cancelar_cproveedor" value="Cancelar" class="btn btn-default pull-left" data-dismiss="modal">
          <button type="button" id="btnSaveCProveedor" class="btn btn-success btn-sm">Guardar cambios</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<?php $this->stop()?>
<?php $this->start('extra_js')?>
  <script src="<?php echo base_url('assets/js/catalogoProveedores.js');?>"></script>
<?php $this->stop()?>
