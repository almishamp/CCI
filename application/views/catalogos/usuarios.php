

<?php $this->layout('main', ['title'=>'Catalogos'])?>
<?php $this->start('extra_style')?>
<?php $this->stop()?>
<?php $this->start('page')?>

<div id="toolbarUsuarios">
    <button type="button" class="btn btn-primary" id="btnMostrarUsuario">Detalles</button>
    <button type="button" class="btn btn-primary" id="btnEditarUsuario">Editar</button>
    <button type="button" class="btn btn-primary" id="btnAgregarUsuario">Agregar uauario</button>
</div>

<section class="content-header">
    <h1>
      Catalogo proveedores
    </h1>
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
                        <div class="col-sm-12">
                          <table id="tUsuarios"></table>

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
  <div class="modal modal-default fade" id="modal_usuario">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_close_catPrograma">
            <span aria-hidden="true">&times;</span></button>
          <h4 id="UsuarioDetalle" class="modal-title">Detalle usuario</h4>
          <h4 id="UsuarioEdicion" class="modal-title">Edición usuario</h4>
          <h4 id="UsuarioNuevo" class="modal-title">Nuevo usuario</h4>
        </div>

        <div class="modal-body"> 
          <form action="#" id="form_cproveedores" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-3">Nombre usuario: </label>
                  <div class="col-md-6">
                      <span class="help-block" id="nombreUsuario"></span>
                      <input type="text" name="nombreUsuario_input" id="nombreUsuario_input" size="60" class="mayusculas">
                      <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Status: </label>
                  <div class="col-md-3">
                      <span class="help-block" id="statusUsuario"></span>
                      <select class="form-control xs" id="select_statusUsuario" ip="select_statusUsuario">
                          <option value="1">Activo</option>
                          <option value="0">Inactivo</option>
                      </select>
                  </div>
                  <label class="control-label col-md-3">Rol: </label>
                  <div class="col-md-3">
                      <span class="help-block" id="rol"></span>
                      <select class="form-control xs" id="select_rolUsuario" ip="select_rolUsuario">
                          <option value="1">Admin</option>
                          <option value="2">Normal</option>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Password: </label>
                  <div class="col-md-6">
                      <span class="help-block" id="password"></span>
                      <input type="text" name="password_input" id="password_input" size="60" class="mayusculas" >
                      <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Email: </label>
                  <div class="col-md-6">
                      <span class="help-block" id="email"></span>
                      <input type="text" name="email_input" id="email_input" size="60">
                      <span class="help-block"></span>
                  </div>
                </div>
            </div>
          </form>    
        </div>
        <div class="modal-footer">
          <input type="button" id="btn_cancelar_usuario" value="Cancelar" class="btn btn-default pull-left" data-dismiss="modal">
          <button type="button" id="btnSaveUsuario" class="btn btn-success btn-sm">Guardar cambios</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<?php $this->stop()?>
<?php $this->start('extra_js')?>
  <script src="<?php echo base_url('assets/js/catalogoUsuarios.js');?>"></script>
<?php $this->stop()?>
