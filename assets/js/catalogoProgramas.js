 var edicion = false;

  $(document).ready(function(){

    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    $("#form_proveedor").hide();

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

    //TABLA para mostrar Catalogo de Programas 
    $('#tCatProgramas').bootstrapTable({
      data: recargarCProgramas(),
      pagination: true,
      sidePagination: 'client',
      pageList: [10, 20, 50, 100],
      search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      toolbar: '#toolbarCatProgramas',
      iconSize: 'btn-sm',
      clickToSelect: true,
      showRefresh: true,
      showFooter: true,
      columns: [
        {radio: true},
        {field: 'idCatPrograma', title: '·.', visible: false},
        {field: 'nombre', title: 'Nombre', sortable: true, align: 'center'},    
        {field: 'status', title: 'Status', align: 'center', sortable: true, formatter: function(value, row, index){
          string = value == 1 ? "<span class='btn btn-xs btn-success'>Activo</span>" : "<span class='btn btn-xs btn-warning'>Inactivo</span>"
        return string;
        }}
      ],
      onClickRow: function(row, $element, field){
        window.idCatProgramaSeleccionado = row.idCatPrograma;
      }

    });

  });

 //EVENTO para mostrar modal de detalles del catálogo programa
  $('#btnMostrarCprog').click(function(){
    if(window.idCatProgramaSeleccionado){
      edicion = false;
      obtenerDetallesCPrograma();
    }else{
      $('#msjAlertD').html("Seleccione un programa");
      modalAlertDanger.modal('show'); 
    }
  });
  
  //EVENTO para mostrar modal de detalles del catálogo programa
  $('#btnEditarCprog').click(function(){
    if(window.idCatProgramaSeleccionado){
        edicion = true;
        obtenerDetallesCPrograma();
    }else{
      $('#msjAlertD').html("Seleccione un Centro");
      modalAlertDanger.modal('show'); 
    } 
  });

  $('#btnAgregarCprog').click(function(){
    if(window.idCatProgramaSeleccionado)
        window.idCatProgramaSeleccionado = null;
    obtenerDetallesCPrograma(); 
  });

//EVENTO para limpiar modal
  $('#btn_cancelar_cprograma').click(function(){
    limpiarModalCPrograma(); 
  });

  $('#btn_close_catPrograma').click(function(){
    limpiarModalCPrograma();
  });

  $('#btnSaveCPrograma').click(function(){
    guardarCPrograma();
  });

  var recargarCProgramas = function(){
    data = [];
    $.ajax({
          url : "../getListProgramas",
          type: "POST",
          dataType: "JSON",
          async: false,
          success: function(response) {
            data = response;
            $('#tCatProgramas').bootstrapTable('load', data);
          }
      }); 
    return data;
  }


  //FUNCIONES DE CRUD CPROGRAMAS
  var obtenerDetallesCPrograma = function(){
    data = [];
    var idCatProgramaS = window.idCatProgramaSeleccionado;
    if(idCatProgramaS){
       $.ajax({
          url : "../showPrograma",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {idCatPrograma: idCatProgramaS},
          success: function(response) {

            data = response;
            if(edicion === true){
              $('#select_statusCP').val(data.status);
              $('#nombrecp_input').val(data.nombre);
              $('#nombreCP').hide();
              $('#statusCP').hide();
              $('#selectCP').hide();
              $("#btnSaveCPrograma").attr("value","Editar programa");
              $('#btnSaveCPrograma').show();
              $("#btn_cancelar_cprograma").attr("value","Cancelar");
              $('#nombrecp_input').show();
              $('#CPNuevo').hide();
              $('#CPDetalle').hide();
              $('#CPEdicion').show();
              $('#select_statusCP').show();
            }else{
              $('#nombreCP').html(data.nombre);
              if(data.status === 1){
                $('#statusCP').addClass("btn btn-xs btn-success");
                $('#statusCP').html("Activo");
              }else{
                $('#statusCP').addClass("btn btn-xs btn-danger");
                $('#statusCP').html("Inactivo");
              }
              $('#nombreCP').show();
              $('#statusCP').show();
              $('#btnSaveCPrograma').hide();
              $("#btn_cancelar_cprograma").attr("value","Cerrar");
              $('#nombrecp_input').hide();
              $('#select_statusCP').hide();
              $('#CPNuevo').hide();
              $('#CPDetalle').show();
              $('#CPEdicion').hide();
            }
            
            $('#modal_CProgramas').modal('show'); 
          }
      }); 

    }else{
      $('#nombrecp_input').show();
      $('#select_statusCP').show();
      $('#selectCP').hide();
      $('#CPNuevo').show();
      $('#CPDetalle').hide();
      $('#CPEdicion').hide();
      $("#btnSaveCPrograma").attr("value","Guardar programa");
      $('#btnSaveCPrograma').show();
      $("#btn_cancelar_cprograma").attr("value","Cancelar");
      $('#modal_CProgramas').modal('show'); 
    }
   
  }

  //Función para guardar Artículo, creación y edición
  var guardarCPrograma = function(){
     data = [];
      var idCatProgramaS = window.idCatProgramaSeleccionado;
      if(idCatProgramaS){
        var metodo = '../editarPrograma';
      }else{
        var metodo = '../nuevoPrograma';
      }
      var valoresForm = "&nombre=" + $('#nombrecp_input').val() + 
                        "&status=" + $('#select_statusCP').val() + 
                        "&idCatPrograma=" + idCatProgramaS;
                        alert(valoresForm);
      $.ajax({
          url : metodo,
          type: "POST",
          dataType: "JSON",
          async: false,
          data: valoresForm,
          beforeSend: function(){
            $('#msjAlertI').html('Actualizando, espere por favor...');
             modalAlertInfo.modal('show');
          },
          success: function(response) {
            data = response;
            if(data.status === 1){
              modalAlertInfo.modal('hide');
              $('#modal_CProgramas').modal('hide');
              $('#msjAlertS').html(data.msj);
              modalAlertSuccess.modal('show');
              limpiarModalCPrograma(); 
            }
            if(data.status === 2){
                $('#msjAlertD').html(data.msj);
                modalAlertDanger.modal('show'); 
            }
            if(data.status === 3){
                modalAlertInfo.modal('hide');
                $('#nombrecp_input').parent().parent().addClass('has-error');
                $('#nombrecp_input').next().text(data.msj);
                $('#msjAlertD').html('¡Por favor verifique el valor de los campos!');
                modalAlertDanger.modal('show');
            }
          }               
        }); 
      
     // return data; 
  }

  var limpiarModalCPrograma = function(){
    $('#form_cprogramas')[0].reset(); // reset form on modals
    $('#form_cprogramas .form-group').removeClass('has-error'); // clear error class
    $('#form_cprogramas .form-group .help-block').empty(); // 
    window.idCatProgramaSeleccionado = null;
    recargarCProgramas();
  }



