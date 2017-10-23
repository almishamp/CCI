  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  var logeo = true;

  $('#div_nombreUsuario').hide();
  $('#div_contraseniaRepeat').hide();
  $('#p_registrar').hide();
  $('#p_logear').show();
  $('#btn_registrarse').show();
  $('#btn_guardarRegistro').hide();


  $(document).ready(function() {

	$("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    modalAlertDanger = $('#modalAlertDanger').modal({
      backdrop: 'static',
      keyboard: false,
      show: false
    });

    modalAlertSuccess = $('#modalAlertSuccessUser').modal({
      backdrop: 'static',
      keyboard: false,
      show: false
    });

    modalAlertInfo = $('#modalAlertDangerUser').modal({
      backdrop: 'static',
      keyboard: false,
      show: false
    }); 

  });

  //EVENTO para mostrar pantalla de password olvidada
  $('#btn_acceder').click(function(){
   logeo = true;
   logearse();
  });
 //Evento para agregar un nuevo usuario
  $('#btn_guardarRegistro').click(function(){
   nuevoUsuario();
  });

  $('#btn_registrarse').click(function(){
  	$('#div_nombreUsuario').show();
  	$('#div_contraseniaRepeat').show();
  	$('#p_registrar').show();
  	$('#p_logear').hide();
  	$('#btn_logearse').hide();
  	$('#btn_registrarse').hide();
  	$('#btn_guardarRegistro').show();
  	$('#btn_acceder').hide();
    logeo = false;

  });

  var logearse = function(){
  	data = [];
  	var valoresForm = "&nombreUsuario=" + $('#nombreUsuario').val() +
                      "&email=" + $('#email').val() +
                      "&contrasenia=" + $('#contrasenia').val() +
                      "&contraseniaRepeat=" + $('#contraseniaRepeat').val();
    $.ajax({
          url : "usuario/acceder",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: valoresForm,
          beforeSend: function(){
            $('#msjAlertIU').html('Actualizando, espere por favor...');
             modalAlertInfo.modal('show');
          },
          success: function(response) {
            data = response;
           	if(data.status == 1){
              modalAlertInfo.modal('hide');
           		document.location.href = data.redirect;
            }if(data.status == 2){
            	modalAlertInfo.modal('hide');
                for (var i = 0; i < data.data.inputerror.length; i++) {
                    $('[name="'+data.data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.data.inputerror[i]+'"]').next().text(data.data.error_string[i]); //select span help-block class set text error string
                } 
                $('#msjAlertU').html('¡Por favor verifique el valor de los campos!');
                modalAlertDanger.modal('show');
            }if(data.status == 3){
            	$('#msjAlertDU').html(data.msj);
                modalAlertDanger.modal('show');
            }
          }, error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
      }); 
    //return data;
  }

  var nuevoUsuario = function(){
  	data = [];
  	var valoresForm = "&nombreUsuario=" + $('#nombreUsuario').val() +
                      "&email=" + $('#email').val() +
                      "&contrasenia=" + $('#contrasenia').val() +
                      "&contraseniaRepeat=" + $('#contraseniaRepeat').val();
    $.ajax({
          url : "usuario/nuevoRegistro",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: valoresForm,
          beforeSend: function(){
            $('#msjAlertIU').html('Actualizando, espere por favor...');
             modalAlertInfo.modal('show');
          },
          success: function(response) {
            data = response;
           	if(data.status == 1){
           		modalAlertInfo.modal('hide');
           		$('#msjAlertSU').html(data.msj);
           		  limpiarFormUser();
                modalAlertSuccess.modal('show');
            }if(data.status == 2){
            	modalAlertInfo.modal('hide');
                for (var i = 0; i < data.data.inputerror.length; i++) {
                    $('[name="'+data.data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.data.inputerror[i]+'"]').next().text(data.data.error_string[i]); //select span help-block class set text error string
                } 
                $('#msjAlertU').html('¡Por favor verifique el valor de los campos!');
                modalAlertDanger.modal('show');
            }if(data.status == 3){
            	$('#msjAlertDU').html(data.msj);
                modalAlertDanger.modal('show');
            }
          }, error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
      }); 
    //return data;
  }

  var limpiarFormUser = function(){
  	$('#form_login')[0].reset(); // reset form on modals
    $('#form_login .form-group').removeClass('has-error'); // clear error class
    $('#form_login .form-group .help-block').empty(); // clear error string
    $('#div_nombreUsuario').hide();
  	$('#div_contraseniaRepeat').hide();
  	$('#p_registrar').hide();
  	$('#p_logear').show();
  	$('#btn_registrarse').hide();
  	$('#btn_guardarRegistro').hide();
    $('#btn_acceder').show();

  }