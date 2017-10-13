  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  //EVENTO para mostrar pantalla de password olvidada
  $('#btn_passwordOlvidada').click(function(){
    alert('asd');
  });

  $('#btn_passwordOlvidada').click(function(){
  	alert('111');
    $.ajax({
		  url : "nuevoRegistro",
		  type: "POST",
		  dataType: "JSON",
		  async: false,
		  success: function(response) {
		   // data = response;
		    //$('#tCatProgramas').bootstrapTable('load', data);
		  }
      });   
  });