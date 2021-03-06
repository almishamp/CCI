<?php $this->layout('usuarios', ['title'=>'Usuarios'])?>
<?php $this->start('extra_style')?>

<?php $this->stop()?>
<?php $this->start('page')?>

<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg" id="p_logear">Ingrese usuario y contraseña para acceder</p>
    <p class="login-box-msg" id="p_registrar">Ingrese la información correspondiente</p>


    <form action="usuario/acceder" method="post" class="login-form" id="form_login">
      <div class="form-group has-feedback" id="div_nombreUsuario">
        <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control mayusculas" placeholder="Nombre completo">
        <span class="help-block"></span>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
        <span class="help-block"></span>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="contrasenia" id="contrasenia" class="form-control" placeholder="Password">
        <span class="help-block"></span>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" id="div_contraseniaRepeat">
        <input type="password" name="contraseniaRepeat" id="contraseniaRepeat" class="form-control" placeholder="Repetir password">
        <span class="help-block"></span>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>

      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <div class="col-xs-3"></div>
          <div class="col-xs-6">
            <button type="button" id="btn_acceder" name="btn_acceder" class="btn btn-primary btn-block btn-flat">Acceder</button>
            <button type="button" id="btn_guardarRegistro" name="btn_guardarRegistro" class="btn btn-primary btn-block btn-flat">Registrarse</button>
          </div>
          <div class="col-xs-3"></div>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--div class="social-auth-links text-center">
      <p>- OR -</p>
      <a  href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <!--a id="btn_passwordOlvidada" class="btn btn-block" href="#">I forgot my passwor</a-->
    <a id="btn_registrarse" class="btn btn-block" href="#">Registrarse</a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

  <!-- Modal para bloquear la vista mientras se realizan peticiones ajax al servidor -->
  <div class="modal modal-info fade" id="modalAlertInfoUser">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Información del sistema</h4>
        </div>
        <div class="modal-body">
            <strong id="msjAlertIU"></strong>
        </div>
        <div class="modal-footer">
          <div class="col-md-4"></div>
          <div class="col-md-4">
                <!--button type="button" class="btn btn-outline pull-left btn-xm" data-dismiss="modal">Cerrar</button-->
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- Modal Alertas de exito-->
  <div class="modal modal-success fade" id="modalAlertSuccessUser">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Información del sistema</h4>
        </div>
        <div class="modal-body">
            <strong id="msjAlertSU"></strong>
        </div>
        <div class="modal-footer">
          <div class="col-md-4"></div>
          <div class="col-md-4">
                <button type="button" class="btn btn-outline pull-left btn-xm" data-dismiss="modal">Cerrar</button>
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

   <!-- Modal Alertas de peligro-->
  <div class="modal modal-danger fade" id="modalAlertDangerUser">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Información del sistema</h4>
        </div>
        <div class="modal-body">
            <strong id="msjAlertDU"></strong>
        </div>
        <div class="modal-footer" align->
          <div class="col-md-4"></div>
          <div class="col-md-4">
                <button type="button" class="btn btn-outline pull-left btn-xm" data-dismiss="modal">Cerrar</button>
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<?php $this->stop()?>
<?php $this->start('extra_js')?>

  <script src="<?php echo base_url('assets/js/usuarios.js');?>"></script>

  
<?php $this->stop()?>
