
$( ".mayusculas" ).keyup(function() {
  this.value=this.value.toUpperCase();
 }); 

function soloNumeros(e){
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
}


/*$('#btnCerrarSession').click(function(){
   cerrarSession();
 });*/

var cerrarSession = function(){
    $.ajax({
          url : "../usuario/salir",
          type: "POST",
          dataType: "JSON",
          async: false,
          beforeSend: function(){
            $('#msjAlertI').html('Actualizando, espere por favor...');
             modalAlertInfo.modal('show');
          },
          success: function(response) {
            data = response;
            modalAlertInfo.modal('hide');
            document.location.href = data.redirect;
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error deleting data');
          }
      }); 
  }
