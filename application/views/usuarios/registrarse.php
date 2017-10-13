<?php $this->layout('usuarios', ['title'=>'Usuarios'])?>
<?php $this->start('extra_style')?>

<?php $this->stop()?>
<?php $this->start('page')?>

<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="../../index2.html" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me fgfdgdggffgfgf
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a  href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <a id="btn_passwordOlvidada" class="btn btn-block" href="#">I forgot my password</a>
    <a id="btn_registrarse" class="btn btn-block" href="#">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<?php $this->stop()?>
<?php $this->start('extra_js')?>

  <script src="<?php echo base_url('assets/js/usuarios.js');?>"></script>

  
<?php $this->stop()?>
