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

    $('.mayusculas').val (function () {
    return this.value.toUpperCase();
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

    //TABLA para mostrar Catalogo de Programas 
    $('#tCatProveedores').bootstrapTable({
      data: recargarCProveedores(),
      pagination: true,
      sidePagination: 'client',
      pageList: [10, 20, 50, 100],
      search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      toolbar: '#toolbarCatProveedores',
      iconSize: 'btn-sm',
      clickToSelect: true,
      showRefresh: true,
      showFooter: true,
      columns: [
        {radio: true},
        {field: 'idCatProveedor', title: '·.', visible: false},
        {field: 'nombre', title: 'Nombre', sortable: true, align: 'center'}, 
        {field: 'nombreContacto', title: 'Nombre Contacto', sortable: true, align: 'center'},
        {field: 'telefonoContacto', title: 'Teléfono Contacto', sortable: true, align: 'center'},   
        {field: 'status', title: 'Status', align: 'center', sortable: true, formatter: function(value, row, index){
          string = value == 1 ? "<span class='btn btn-xs btn-success'>Activo</span>" : "<span class='btn btn-xs btn-warning'>Inactivo</span>"
        return string;
        }}
      ],
      onClickRow: function(row, $element, field){
        window.idCatProveedorSeleccionado = row.idCatProveedor;
      }

    });

  });

 //EVENTO para mostrar modal de detalles del catálogo programa
  $('#btnMostrarCprov').click(function(){
    if(window.idCatProveedorSeleccionado){
      edicion = false;
      obtenerDetallesCProveedor();
    }else{
      $('#msjAlertD').html("Seleccione un proveedor");
      modalAlertDanger.modal('show'); 
    }
  });
  
  //EVENTO para mostrar modal de detalles del catálogo programa
  $('#btnEditarCprov').click(function(){
    if(window.idCatProveedorSeleccionado){
        edicion = true;
        obtenerDetallesCProveedor();
    }else{
      $('#msjAlertD').html("Seleccione un proveedor");
      modalAlertDanger.modal('show'); 
    } 
  });

  $('#btnAgregarCprov').click(function(){
    if(window.idCatProveedorSeleccionado)
        window.idCatProveedorSeleccionado = null;
    obtenerDetallesCProveedor(); 
  });

//EVENTO para limpiar modal
  $('#btn_cancelar_cproveedor').click(function(){
    limpiarModalCProveedor(); 
  });

  $('#btn_close_catPrograma').click(function(){
    limpiarModalCProveedor();
  });

  $('#btnSaveCProveedor').click(function(){
    guardarCProveedor();
  });

  var recargarCProveedores = function(){
    data = [];
    $.ajax({
          url : "../getListProveedores",
          type: "POST",
          dataType: "JSON",
          async: false,
          success: function(response) {
            data = response;
            $('#tCatProveedores').bootstrapTable('load', data);
          }
      }); 
    return data;
  }


  //FUNCIONES DE CRUD CPROGRAMAS
  var obtenerDetallesCProveedor = function(){
    data = [];
    var idCatProveedorS = window.idCatProveedorSeleccionado;
    if(idCatProveedorS){
       $.ajax({
          url : "../showProveedor",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {idCatProveedor: idCatProveedorS},
          success: function(response) {

            data = response;
            if(edicion === true){
              $('#select_statusCPV').val(data.status);
              $('#nombrecpv_input').val(data.nombre);
              $('#nombreContacto_input').val(data.nombreContacto);
              $('#telefonoContacto_input').val(data.telefonoContacto);
              $('#nombreContacto').val(data.nombreContacto);
              $('#telefonoContacto').val(data.telefonoContacto);
              $('#nombreContacto_input').show();
              $('#telefonoContacto_input').show();
              $('#nombreContacto').hide();
              $('#telefonoContacto').hide();
              $('#nombreCPV').hide();
              $('#statusCPV').hide();
              $('#selectCPV').hide();
              $('#select_statusCPV').show();
              $("#btnSaveCPro").attr("value","Editar proveedor");
              $('#btnSaveCProveedor').show();
              $("#btn_cancelar_cproveedor").attr("value","Cancelar");
              $('#nombrecpv_input').show();
            }else{
              $('#nombreCPV').html(data.nombre);
              if(data.status === 1){
                $('#statusCPV').addClass("btn btn-xs btn-success");
                $('#statusCPV').html("Activo");
              }else{
                $('#statusCPV').addClass("btn btn-xs btn-danger");
                $('#statusCPV').html("Inactivo");
              }
              $('#nombreCPV').show();
              $('#statusCPV').show();
              $('#btnSaveCProveedor').hide();
              $("#btn_cancelar_cproveedor").attr("value","Cerrar");
              $('#nombrecpv_input').hide();
              $('#select_statusCPV').hide();
              $('#nombreContacto_input').hide();
              $('#telefonoContacto_input').hide();
              $('#nombreContacto').show();
              $('#telefonoContacto').show();
            }
            $('#CPVNuevo').hide();
            $('#CPVDetalle').show();
            $('#CPVEdicion').hide();
            $('#modal_CProveedores').modal('show'); 
          }
      }); 

    }else{
      $('#nombrecpv_input').show();
      $('#select_statusCPV').show();
      $('#selectCP').hide();
      $('#CPVNuevo').show();
      $('#CPVDetalle').hide();
      $('#CPVEdicion').hide();
      $("#btnSaveCProveedor").attr("value","Guardar proveedor");
      $('#btnSaveCProveedor').show();
      $("#btn_cancelar_cproveedor").attr("value","Cancelar");
      $('#modal_CProveedores').modal('show'); 
      $('#nombreContacto_input').show();
      $('#telefonoContacto_input').show();
      $('#nombreContacto').hide();
      $('#telefonoContacto').hide();
    }
   
  }

  //Función para guardar Artículo, creación y edición
  var guardarCProveedor = function(){
     data = [];
      var idCatProveedorS = window.idCatProveedorSeleccionado;
      if(idCatProveedorS){
        var metodo = '../editarProveedor';
      }else{
        var metodo = '../nuevoProveedor';
      }
      var valoresForm = "&nombre=" + $('#nombrecpv_input').val() + 
                        "&status=" + $('#select_statusCPV').val() + 
                        "&nombreContacto=" + $('#nombreContacto_input').val() + 
                        "&telefonoContacto=" + $('#telefonoContacto_input').val() + 
                        "&idCatProveedor=" + idCatProveedorS;
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
            alert(data);
            if(data.status === 1){
              modalAlertInfo.modal('hide');
              $('#modal_CProveedores').modal('hide');
              $('#msjAlertS').html(data.msj);
              modalAlertSuccess.modal('show');
              limpiarModalCProveedor(); 
            }
            if(data.status === 2 || data.status === 4){
                $('#msjAlertD').html(data.msj);
                modalAlertInfo.modal('hide');
                modalAlertDanger.modal('show'); 
            }
            if(data.status === 3){
                modalAlertInfo.modal('hide');
                $('#nombrecpv_input').parent().parent().addClass('has-error');
                $('#nombrecpv_input').next().text(data.msj);
                $('#msjAlertD').html('¡Por favor verifique el valor de los campos!');
                modalAlertDanger.modal('show');
            }
          }               
        }); 
      
     // return data; 
  }

  var limpiarModalCProveedor = function(){
    $('#form_cproveedores')[0].reset(); // reset form on modals
    $('#form_cproveedores .form-group').removeClass('has-error'); // clear error class
    $('#form_cproveedores .form-group .help-block').empty(); // 
    window.idCatProveedorSeleccionado = null;
    recargarCProveedores();
  }



