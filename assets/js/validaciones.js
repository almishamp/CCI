
$( ".mayusculas" ).keyup(function() {
  this.value=this.value.toUpperCase();
 }); 

function soloNumeros(e){
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
}