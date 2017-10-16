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

    modalAlertSuccess = $('#modalAlertSuccess').modal({
      backdrop: 'static',
      keyboard: false,
      show: false
    });

    modalAlertInfo = $('#modalAlertInfo').modal({
      backdrop: 'static',
      keyboard: false,
      show: false
    }); 

  });

  //EVENTO para mostrar pantalla de password olvidada
  $('#btn_acceder').click(function(){
   // alert('asd');
   logearse();
  });

  $('#btn_registrarse').click(function(){
  	$('#div_nombreUsuario').show();
  	$('#div_contraseniaRepeat').show();
  	$('#p_registrar').show();
  	$('#p_logear').hide();
    logeo = false;

  });

  var logearse = function(){
  	data = [];
  	if(logeo == true){
  		var url = "usuario/acceder";
  	}else{
  		var url = "usuario/nuevoRegistro";
  	}
  	var valoresForm = "&nombreUsuario=" + $('#nombreUsuario').val() +
                      "&email=" + $('#email').val() +
                      "&contrasenia=" + $('#contrasenia').val() +
                      "&contraseniaRepeat=" + $('#contraseniaRepeat').val();
    $.ajax({
          url : url,
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {valoresForm},
          beforeSend: function(){
            $('#msjAlertI').html('Actualizando, espere por favor...');
             modalAlertInfo.modal('show');
          },
          success: function(response) {
            data = response;
            alert(data.redirect);
           // console.log(data);
           // $('#tProgramas').bootstrapTable('load', data);
                          document.location.href = data.redirect;

           if(data.status === true){
            }
            if(data.status === 2){
                
            }
            if(data.status === 3){
            	modalAlertInfo.modal('hide');
                for (var i = 0; i < data.data.inputerror.length; i++) {
                    $('[name="'+data.data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.data.inputerror[i]+'"]').next().text(data.data.error_string[i]); //select span help-block class set text error string
                } 
                $('#msjAlertD').html('¡Por favor verifique el valor de los campos!');
                modalAlertDanger.modal('show');
            }
          }, error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
      }); 
    //return data;
  }