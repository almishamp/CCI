
  var edicion = false;
  var opcionConectividad = 1;
  var mostrarElemnetos = 0;
  var filtrosArray = [];
  var busquedaActual = 0;
  var busquedaAnterior = 0;
  var numVeces = 0;
  var filtros = false;

  $(document).ready(function(){

    //getCatalogos();

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

  //  $('.select2').select2();

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

    //TABLA para mostrar Conectividad (Centros)
    $('#tConectividad').bootstrapTable({
      data: getData(),
      pagination: true,
      sidePagination: 'client',
      pageList: [10, 20, 50, 100],
      search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      toolbar: '#toolbar',
      iconSize: 'btn-sm',
      clickToSelect: true,
      showRefresh: true,
      showFooter: true,
      columns: [
        {radio: true},
        {field: 'idConectividad', title: '·.', visible: false},
        {field: 'claveCT', title: 'ClaveCT', sortable: true, align: 'center'},
        {field: 'nombreCT', title: 'NombreCT', sortable: true, align: 'center'},
        {field: 'nivelEducativo', title: 'Nivel educativo', sortable: true, align: 'center'},
        {field: 'modalidad', title: 'Modalidad', sortable: true, align: 'center'},
        {field: 'turno', title: 'Turno', sortable: true, align: 'center'},
        {field: 'municipio', title: 'Municipio', sortable: true, align: 'center'},
        {field: 'localidad', title: 'Localidad', sortable: true, align: 'center'}, 
        {field: 'colonia', title: 'Colonia', sortable: true, align: 'center', visible: false}, 
        {field: 'programas', title: 'Programas', sortable: true, align: 'height', formatter: function (value, row, index) {
                string = '';
                $.each( value, function( key, value ) {
                    string += '<li style = "font-size:12px">'+value+'</li>';
                }); 
                return string;                 
        }},
        {field: 'proveedores', title: 'proveedores', sortable: true, align: 'height', formatter: function (value, row, index) {
                string = '';
                $.each( value, function( key, value ) {
                    string += '<li style = "font-size:12px">'+value+'</li>';
                }); 
                return string;                 
        }}        

      /*  {field: 'programas', title: 'Programas', sortable: true, align: 'center'},       
        {field: 'statusServicio', title: 'Status', align: 'center', sortable: true, formatter: function(value, row, index){
          string = value == 1 ? "<span class='btn btn-xs btn-success'>Conectividad</span>" : "<span class='btn btn-xs btn-warning'>Sin Conectividad</span>"
        return string;
        }} */
      ],
      onClickRow: function(row, $element, field){
        window.idConectividadSeleccionado = row.idConectividad;
      },
      onCheck: function(row, $element, field){
        window.idConectividadSeleccionado = row.idConectividad;
      }, 

    });

    //TABLA para mostrar programas
    $('#tProgramas').bootstrapTable({
      data: [],
      pagination: false,
      //sidePagination: 'client',
     // pageList: [10, 20, 50, 100],
      //search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      toolbar: '#toolbarP',
      iconSize: 'btn-sm',
      clickToSelect: true,
      columns: [
        {radio: true},
        {field: 'idPrograma', title: '', visible: false},
        {field: 'idCatProveedor', title: '', visible: false},
        {field: 'programa', title: 'Programa', align: 'center'},
        {field: 'gid', title: 'GID', align: 'center'},
        {field: 'vsatid', title: 'VSATID', align: 'center'},
        {field: 'tipoprograma', title: 'Tipo Programa', align: 'center'}, 
        {field: 'proveedor', title: 'Proveedor', align: 'center'}, 
        {field: 'status', title: 'Status', align: 'center', formatter: function(value, row, index){
          string = value == 1 ? "<span class='btn btn-xs btn-success'>Activo</span>" : "<span class='btn btn-xs btn-warning'>Inactivo</span>"
        return string;
        }}
      ],
      onClickRow: function(row, $element, field){
        window.idProgramaSeleccionado = row.idPrograma;
      } 

    });

    //TABLA para mostrar articulos
    $('#tArticulos').bootstrapTable({
      data: [],
      pagination: false,
      //sidePagination: 'client',
     // pageList: [10, 20, 50, 100],
      //search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      toolbar: '#toolbarA',
      iconSize: 'btn-sm',
      clickToSelect: true,
      //showRefresh: true,
      //showFooter: true,
      columns: [
        {radio: true},
        {field: 'idArticulo', title: '', visible: false},
        {field: 'idConectividad', title: '', visible: false},
        {field: 'descripcion', title: 'Descripción', align: 'center'},
        {field: 'marca', title: 'Marca', align: 'center'},
        {field: 'modelo', title: 'Modelo', align: 'center'}, 
        {field: 'serie', title: 'Serie', align: 'center'}, 
        {field: 'status', title: 'Status', align: 'center', formatter: function(value, row, index){
          string = value == 1 ? "<span class='btn btn-xs btn-success'>Activo</span>" : "<span class='btn btn-xs btn-danger'>Inactivo</span>"
        return string;
        }}
      ],
      onClickRow: function(row, $element, field){
        window.idArticuloSeleccionado = row.idArticulo;
      } 

    });

    $('#CA_Modalidad').bootstrapTable({
      data: [],
      pagination: false,
      //sidePagination: 'client',
     // pageList: [10, 20, 50, 100],
      //search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      //toolbar: '#toolbarA',
      iconSize: 'btn-sm',
      clickToSelect: true,
      //showRefresh: true,
      //showFooter: true,
      columns: [
        {checkbox: true},
        {field: 'idModalidad', title: '', visible: false},
        {field: 'nombre', title: 'Modalidad', align: 'center'}
      ]
    });

    $('#CA_RegionMunicipio').bootstrapTable({
      data: [],
      pagination: false,
      //sidePagination: 'client',
     // pageList: [10, 20, 50, 100],
      //search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      //toolbar: '#toolbarA',
      iconSize: 'btn-sm',
      clickToSelect: true,
      //showRefresh: true,
      //showFooter: true,
      columns: [
        {checkbox: true},
        {field: 'idMunicipio', title: '', visible: false},
        {field: 'nombreMunicipio', title: 'Municipio', align: 'center'}
      ]
    });

    $('#CA_NivelEducativo').bootstrapTable({
      data: [],
      pagination: false,
      //sidePagination: 'client',
     // pageList: [10, 20, 50, 100],
      //search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      //toolbar: '#toolbarA',
      iconSize: 'btn-sm',
      clickToSelect: true,
      //showRefresh: true,
      //showFooter: true,
      columns: [
        {checkbox: true},
        {field: 'idNivelEducativo', title: '', visible: false},
        {field: 'nombre', title: 'Nivel Educativo', align: 'center'}
      ]
    });

    $('#CA_Turno').bootstrapTable({
      data: [],
      pagination: false,
      //sidePagination: 'client',
     // pageList: [10, 20, 50, 100],
      //search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      //toolbar: '#toolbarA',
      iconSize: 'btn-sm',
      clickToSelect: true,
      //showRefresh: true,
      //showFooter: true,
      columns: [
        {checkbox: true},
        {field: 'idTurno', title: '', visible: false},
        {field: 'nombre', title: 'Turno', align: 'center'}
      ]
    });

    $('#CA_Programa').bootstrapTable({
      data: [],
      pagination: false,
      //sidePagination: 'client',
     // pageList: [10, 20, 50, 100],
      //search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      //toolbar: '#toolbarA',
      iconSize: 'btn-sm',
      clickToSelect: true,
      //showRefresh: true,
      //showFooter: true,
      columns: [
        {checkbox: true},
        {field: 'idCatPrograma', title: '', visible: false},
        {field: 'nombre', title: 'Programa', align: 'center'}
      ]
    });

    $('#CA_Proveedor').bootstrapTable({
      data: [],
      pagination: false,
      //sidePagination: 'client',
     // pageList: [10, 20, 50, 100],
      //search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      //toolbar: '#toolbarA',
      iconSize: 'btn-sm',
      clickToSelect: true,
      //showRefresh: true,
      //showFooter: true,
      columns: [
        {checkbox: true},
        {field: 'idCatProveedor', title: '', visible: false},
        {field: 'nombre', title: 'Proveedor', align: 'center'}
      ]
    });

    $('#CA_NivelCT').bootstrapTable({
      data: [],
      pagination: false,
      //sidePagination: 'client',
     // pageList: [10, 20, 50, 100],
      //search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      //toolbar: '#toolbarA',
      iconSize: 'btn-sm',
      clickToSelect: true,
      //showRefresh: true,
      //showFooter: true,
      columns: [
        {checkbox: true},
        {field: 'idNivelCT', title: '', visible: false},
        {field: 'nombre', title: 'Nivel CT', align: 'center'}
      ]
    });

    $('#CA_Localidad').bootstrapTable({
      data: [],
      pagination: false,
      //sidePagination: 'client',
     // pageList: [10, 20, 50, 100],
      //search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      //toolbar: '#toolbarA',
      iconSize: 'btn-sm',
      clickToSelect: true,
      //showRefresh: true,
      //showFooter: true,
      columns: [
        {checkbox: true},
        {field: 'localidad', title: 'Localidad', align: 'center'}
      ]
    });

  });

 //EVENTO para mostrar modal de detalles de conectividad
  $('#btnMostrar').click(function(){
    if(window.idConectividadSeleccionado){
      edicion = false;
      obtenerDetalles();
    }else{
      $('#msjAlertD').html("Seleccione un Centro");
      modalAlertDanger.modal('show'); 
    }
  });
  
  //EVENTO para mostrar modal de detalles de programa
  $('#btnEditar').click(function(){
    if(window.idConectividadSeleccionado){
        edicion = true;
        obtenerDetalles();
    }else{
      $('#msjAlertD').html("Seleccione un Centro");
      modalAlertDanger.modal('show'); 
    } 
  });

//EVENTO para recargar tabla de conectividad con el botón cancelar
  $('#btn_cancelar_con').click(function(){
    limpiarElementosConectividad();
  });

  $('#btn_close_Con').click(function(){
    limpiarElementosConectividad();
  });
//EVENTO para editar datos de centro, solo los datos pertenecientes a conectividad
  $('#edicionConectividadB').click(function(){
     edicionConectividad();
  });

  $('#btnAgregarCentro').click(function(){
    if(window.idConectividadSeleccionado)
      window.idConectividadSeleccionado = null;
      obtenerDetalles();
  });

  $('#btnBuscarConectividad').click(function(){
    if($('#claveCT_buscar').val()){
      buscarCentro();
    }else{
      $('#msjAlertD').html("Agregue la clave del centro");
      modalAlertDanger.modal('show'); 
    }
  });

  //EVENTOS para mostrar las listas de conectividad con los distintos estatus de conexión
  $('#btn_conConexion').click(function() {
    opcionConectividad = 1;
    recargarConectividad();
  });

  $('#btn_sinConexion').click(function() {
    opcionConectividad = 2;
    recargarConectividad();
  });

  $('#btn_con_sin_Conexion').click(function() {
    opcionConectividad = 3;
    recargarConectividad();
  });



   //EVENTO para mostrar modal de detalles de programa
  $('#btnMostrarPrograma').click(function(){
    if(window.idProgramaSeleccionado){
      edicion = false;
      obtenerDetallesPrograma();
    }else{
      $('#msjAlertD').html("Seleccione un programa");
      modalAlertDanger.modal('show'); 
    }
  });
  
  $('#btnEditarPrograma').click(function(){
    if(window.idProgramaSeleccionado){
      edicion = true;
      obtenerDetallesPrograma();
    }else{
      $('#msjAlertD').html("Seleccione un programa");
      modalAlertDanger.modal('show'); 
    }
  });

  $('#btnAgregarPrograma').click(function(){
    if(window.idProgramaSeleccionado){
        window.idProgramaSeleccionado = null;
        
    }else{
      obtenerDetallesPrograma(); 
    }  
  });

  $('#select_programas').change(function(){
    var idPrograma = $('#programas').val();
    if(idPrograma < 5){
      $('#selectTipoPrograma').val(1);
      $('#selectTipoPrograma').prop('disabled', 'disabled');
    }
    else{
      $('#selectTipoPrograma').val(2);
      $('#selectTipoPrograma').prop('disabled', 'disabled');
    }
  });

  $('#edicionProgramaB').click(function(){
    guardarPrograma();
  });

  $('#editarProveedor').click(function(){
    edicionProveedor();
  });

  //EVENTO boton cancelar modal programa, limpia el contenido del modal
  $('#btn_cancelar_modalPrograma').click(function(){
    $('#form_programa')[0].reset(); // reset form on modals
    $('#form_programa .form-group').removeClass('has-error'); // clear error class
    $('#form_programa .form-group .help-block').empty(); // clear error string
    getDataProgramas();
    window.idProgramaSeleccionado = null;
   // $('#proveedores').empty();
    $('#modal_programa').modal('hide');
   });

  //EVENTO boton cerrar modal programa, limpia el contenido del modal
  $('#btn_cerrar_modalPrograma').click(function(){
    $('#form_programa')[0].reset(); // reset form on modals
    $('#form_programa .form-group').removeClass('has-error'); // clear error class
    $('#form_programa .form-group .help-block').empty(); // clear error string
    getDataProgramas();
    window.idProgramaSeleccionado = null;
   // $('#proveedores').empty();
    $('#modal_programa').modal('hide');
   });

  //EVENTO para mostrar modal de detalles de artículo
  $('#btnMostrarArticulo').click(function(){
    if(window.idArticuloSeleccionado){
      edicion = false;
      obtenerDetallesArticulo();
    }else{
      $('#msjAlertD').html("Seleccione un artículo");
      modalAlertDanger.modal('show'); 
    }
  });
  
  $('#btnEditarArticulo').click(function(){
    if(window.idArticuloSeleccionado){
      edicion = true;
      obtenerDetallesArticulo();
    }else{
      $('#msjAlertD').html("Seleccione un artículo");
      modalAlertDanger.modal('show'); 
    }
  });

  $('#btnAgregarArticulo').click(function(){
    if(window.idArticuloSeleccionado){
        window.idArticuloSeleccionado = null;
    }else{
      obtenerDetallesArticulo(); 
    }  
  });

  $('#btnSaveArticulo').click(function(){
    guardarArticulo();
  });

   //EVENTO para mostrar modal de detalles proveedor
  $('#btnMostrarProveedor').click(function(){
    obtenerDetallesProveedor();
  });
  
  $('#btnEditarEditarArticulo').click(function(){

  });

  $('#btn_cancelar_art').click(function(){
    limpiarModalArticulo();
  });

  $('#btn_close_Articulo').click(function(){
    limpiarModalArticulo();
  });
  
  //EVENTOS para filtros de busqueda

  $('#btnFiltrar').click(function(){
      filtrarDatos();
  }); 

 $('#btn_modal_filtros_modalidad').click(function(){
    getCatalogo('CA_Modalidad');
  });


 $('#btn_modal_filtros_municipio').click(function(){
    getCatalogo('CA_RegionMunicipio');
  });

 $('#btn_modal_filtros').click(function(){
    //getCatalogo('CA_Modalidad');
    getCatalogos();
  });

 $('#exportButton').click(function(){
   exportarExcel();
 });  

 //EVENTOS FILTROS
 $('#btn_filtro_nivelEduc').click(function(){
    $('#CA_Modalidad').hide();
    $('#CA_RegionMunicipio').hide();
    $('#CA_Turno').hide();
    $('#CA_NivelCT').hide();
    $('#CA_Proveedor').hide();
    $('#CA_Programa').hide();
    $('#CA_NivelEducativo').show();
    $('#CA_Localidad').hide();
    comprobarFiltrosSeleccionados();
 });

 $('#btn_filtro_modalidad').click(function(){
    $('#CA_RegionMunicipio').hide();
    $('#CA_Turno').hide();
    $('#CA_NivelEducativo').hide();
    $('#CA_NivelCT').hide();
    $('#CA_Proveedor').hide();
    $('#CA_Programa').hide();
    $('#CA_Modalidad').show();
    $('#CA_Localidad').hide();
    comprobarFiltrosSeleccionados();
 });

 $('#btn_filtro_turno').click(function(){
    $('#CA_Modalidad').hide();
    $('#CA_RegionMunicipio').hide();
    $('#CA_NivelCT').hide();
    $('#CA_Proveedor').hide();
    $('#CA_Programa').hide();
    $('#CA_NivelEducativo').hide();
    $('#CA_Turno').show();
    $('#CA_Localidad').hide();
    comprobarFiltrosSeleccionados();
 });

 $('#btn_filtro_municipio').click(function(){
    $('#CA_Modalidad').hide();
    $('#CA_Turno').hide();
    $('#CA_NivelEducativo').hide();
    $('#CA_NivelCT').hide();
    $('#CA_Proveedor').hide();
    $('#CA_Programa').hide();
    $('#CA_Localidad').hide();
    $('#CA_RegionMunicipio').show();
    comprobarFiltrosSeleccionados();
 });

 $('#btn_filtro_nivelCT').click(function(){
    $('#CA_Modalidad').hide();
    $('#CA_Turno').hide();
    $('#CA_NivelEducativo').hide();
    $('#CA_Proveedor').hide();
    $('#CA_Programa').hide();
    $('#CA_RegionMunicipio').hide();
    $('#CA_NivelCT').show();
    comprobarFiltrosSeleccionados();
 });

 $('#btn_filtro_programa').click(function(){
    $('#CA_Modalidad').hide();
    $('#CA_Turno').hide();
    $('#CA_NivelEducativo').hide();
    $('#CA_NivelCT').hide();
    $('#CA_Proveedor').hide();
    $('#CA_RegionMunicipio').hide();
    $('#CA_Localidad').hide();
    $('#CA_Programa').show();
    comprobarFiltrosSeleccionados();
 });

 $('#btn_filtro_proveedor').click(function(){
    $('#CA_Modalidad').hide();
    $('#CA_Turno').hide();
    $('#CA_NivelEducativo').hide();
    $('#CA_NivelCT').hide();
    $('#CA_Programa').hide();
    $('#CA_RegionMunicipio').hide();
    $('#CA_Localidad').hide();
    $('#CA_Proveedor').show();
    comprobarFiltrosSeleccionados();
 });

 $('#btn_filtro_localidad').click(function(){
    $('#CA_Modalidad').hide();
    $('#CA_Turno').hide();
    $('#CA_NivelEducativo').hide();
    $('#CA_NivelCT').hide();
    $('#CA_Programa').hide();
    $('#CA_RegionMunicipio').hide();
    $('#CA_Proveedor').hide();
    $('#CA_Localidad').show();
    comprobarFiltrosSeleccionados();
 });
  
  //FUNCIÓN para limpiar elementos de modal de conectividad
  var limpiarElementosConectividad = function(){
   // window.idConectividadSeleccionado = null;
    $('#form_busqueda')[0].reset(); // reset form on modals
    $('#form_show')[0].reset(); // reset form on modals
    $('#form_show .form-group').removeClass('has-error'); // clear error class
    $('#form_show .form-group .help-block').empty(); // clear error string
    if(filtros != true){
       recargarConectividad();
    }
  }

  //JSON para obtener valores de la lista de conectividad
  var getData = function(){
    data = [];
    $.ajax({
          url : "getListaConectividad",
          type: "POST",
          dataType: "JSON",
          data: {statusServicio: opcionConectividad},
          async: false,
          beforeSend: function(){
              $('#msjAlertI').html('Cargando información, por favor espere...');
              modalAlertInfo.modal('show');
          },
          success: function(response) {
            data = response;

            $('#btn_conConexion').addClass('btn-primary').removeClass('btn-default'); 
            $('#btn_sinConexion').addClass('btn-default').removeClass('btn-primary');
            $('#btn_con_sin_Conexion').addClass('btn-default').removeClass('btn-primary');
            $('#tConectividad').bootstrapTable('showColumn', 'programas');
            $('#tConectividad').bootstrapTable('showColumn', 'proveedores');
            $('#userNameSpan1').html(data.user.nombreUsuario);
            $('#userNameSpan2').html(data.user.nombreUsuario);


            $('#tConectividad').bootstrapTable('showColumn', 'nombre_proveedor');
            modalAlertInfo.modal('hide');
          }
      }); 
    return data.lista;
  }

  var getDataProgramas = function(){
    data = [];
    var idConectividadS = window.idConectividadSeleccionado;
    $.ajax({
          url : "getListaProgramas",
          type: "POST",
          dataType: "JSON",
          data: {idConectividad: idConectividadS},
          async: false,
          success: function(response) {
            data = response;
            $('#tProgramas').bootstrapTable('load', data);
          }
      }); 
    return data;
  }

  var recargarConectividad = function(){
    data = [];
    $.ajax({
          url : "getListaConectividad",
          type: "POST",
          dataType: "JSON",
          data: {statusServicio: opcionConectividad},
          async: false,
          beforeSend: function(){
              $('#msjAlertI').html('Cargando información...');
              modalAlertInfo.addClass("modal-info");
              modalAlertInfo.modal('show');
          },
          success: function(response) {
              data = response;
              if(data){
                modalAlertInfo.modal('hide');
                if(data.bandera === 1){
                  $('#btn_conConexion').addClass('btn-primary').removeClass('btn-default'); 
                  $('#btn_sinConexion').addClass('btn-default').removeClass('btn-primary');
                  $('#btn_con_sin_Conexion').addClass('btn-default').removeClass('btn-primary');
                  $('#tConectividad').bootstrapTable('showColumn', 'programas');
                  $('#tConectividad').bootstrapTable('showColumn', 'proveedores');
                }
                if(data.bandera === 2){
                  $('#btn_sinConexion').addClass('btn-primary').removeClass('btn-default'); 
                  $('#btn_conConexion').addClass('btn-default').removeClass('btn-primary');
                  $('#btn_con_sin_Conexion').addClass('btn-default').removeClass('btn-primary');
                  $('#tConectividad').bootstrapTable('hideColumn', 'programas');
                  $('#tConectividad').bootstrapTable('hideColumn', 'proveedores');
                }
                if(data.bandera === 3){
                  $('#btn_con_sin_Conexion').addClass('btn-primary').removeClass('btn-default'); 
                  $('#btn_conConexion').addClass('btn-default').removeClass('btn-primary');
                  $('#btn_sinConexion').addClass('btn-default').removeClass('btn-primary');
                  $('#tConectividad').bootstrapTable('hideColumn', 'programas');
                  $('#tConectividad').bootstrapTable('hideColumn', 'proveedores');
                }
                $('#tConectividad').bootstrapTable('load', data.lista);
              }else{
                modalAlertInfo.modal('hide');
                $('#msjAlertD').html(data.msj);
                modalAlertDanger.modal('show'); 
              }               
            }
      }); 
    return data;
  }

  var recargarArticulos = function(){
    data = [];
    var idConectividadS = window.idConectividadSeleccionado;
    $.ajax({
          url : "../articulo/getLista",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {idConectividad: idConectividadS},
          success: function(response) {
            data = response;
            $('#tArticulos').bootstrapTable('load', data);
          }
      }); 
    return data;
  }

  var getCatProgramas = function(){
    data = [];
    $.ajax({
          url : "catalogos/getList",
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

  var buscarCentro = function(){
    data = [];
      var claveCTB = $('#claveCT_buscar').val();
      $.ajax({
            url : "buscarConectividad",
            type: "POST",
            dataType: "JSON",
            async: false,
            data: {claveCT: claveCTB},
            beforeSend: function(){
              $('#msjAlertI').html('Buscando CLAVECT, por favor espere...');
              modalAlertInfo.addClass("modal-info");
              modalAlertInfo.modal('show');
            },
            success: function(response) {
              data = response;
              if(data.bandera == 1){
                window.idConectividadSeleccionado = data.conectividad.idConectividad;
                $('#msjAlertD').html(data.msj);
                modalAlertInfo.modal('hide');
                modalAlertDanger.modal('show'); 
                edicion = false;
                obtenerDetalles(); 
              }
              if(data.bandera == 2){
                $('#msjAlertS').html(data.msj);
                modalAlertInfo.modal('hide');
                $("#tBusquedaConect").hide();
                $('#claveCT').html(data.conectividad.CLAVECCT);
                $('#nombreCT').html(data.conectividad.NOMBRECT);
                $('#colonia').html(data.conectividad.NOMBRECOL);
                $('#municipio').html(data.conectividad.NOMBREMUN);
                $('#localidad').html(data.conectividad.NOMBRELOC);
                $('#turno').html(data.conectividad.TUR_DES);
                $('#nivelEducativo').html(data.conectividad.nivelEducativo);
                $('#modalidad').html(data.conectividad.SOS_DES);
                $('#latitud').html(data.conectividad.latitud);
                $('#longitud').html(data.conectividad.longitud);
                $('#divInventario').show();
                $('#divSitio').show();
                $("#tEdicion").show();
                $("#saveConectividadB").show();
                $('#div_rinventario').hide();
                $('#div_rsitio').hide();
                $("#tDetalle").hide();
                $('#form_show').show();
                $('#form-busqueda').hide();
                modalAlertSuccess.modal('show'); 

              }
              if(data.bandera == 3){
                $('#msjAlertD').html(data.msj);
                modalAlertInfo.modal('hide');
                modalAlertDanger.modal('show'); 
              }             
            }
        });  
      return data;
  }

  //FUNCIÓN para obtener datos de modal de detalles de conectividad
  var obtenerDetalles = function(){
    data = [];
    var idConectividadS = null;

    if(window.idConectividadSeleccionado){
      idConectividadS = window.idConectividadSeleccionado;
      $('#form_busqueda').hide();
    }

    if(idConectividadS != null){
        $.ajax({
          url : "show",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {idConectividad: idConectividadS},
          success: function(response) {
            data = response;
              $("#tBusquedaConect").hide();
              $('#claveCT').html(data.conectividad.claveCT);
              $('#nombreCT').html(data.conectividad.nombreCT);
              if(data.conectividad.statusServicio === 1){
                $('#statusConectividad').addClass("btn-success").removeClass('btn-danger');
                $('#statusConectividad').html("Conectado");
              }else{
                $('#statusConectividad').addClass("btn-danger").removeClass('btn-success');
                $('#statusConectividad').html("No Conectado");
              }
             // $('#statusConectividad').html(data.conectividad.statusServicio);
              $('#colonia').html(data.conectividad.colonia);
              $('#municipio').html(data.conectividad.municipio);
              $('#localidad').html(data.conectividad.localidad);
              $('#turno').html(data.conectividad.turno);
              $('#nivelEducativo').html(data.conectividad.nivelEducativo);
              $('#modalidad').html(data.conectividad.modalidad);
              $('#latitud').html(data.conectividad.latitud);
              $('#longitud').html(data.conectividad.longitud);
              $('#rsitio').val(data.conectividad.nombreRespSitio);
              $('#rinventario').val(data.conectividad.nombreRespInventario);
              $('#latitudInput').hide();
              $('#longitudInput').hide();
              if(edicion == true){
                $('#divInventario').show();
                $('#divSitio').show();
                $("#tEdicion").show();
                $("#saveConectividadB").show();
                $('#div_rinventario').hide();
                $('#div_rsitio').hide();
                $("#tDetalle").hide();
                $('#input_telContacto').show();
                $('#telefonoContacto').hide();
              }else{
                $('#respSitio').html(data.conectividad.nombreRespSitio);
                $('#respInventario').html(data.conectividad.nombreRespInventario);
                $('#telefonoContacto').html(data.conectividad.telefonoContacto);
                $('#div_rinventario').show();
                $('#div_rsitio').show();
                $("#tDetalle").show();
                $('#divInventario').hide();
                $('#divSitio').hide();
                $('#tEdicion').hide();
                $('#input_telContacto').hide();

                $('#saveConectividadB').hide();
              }
              $('#tProgramas').bootstrapTable('load', data.programas);
              $('#tArticulos').bootstrapTable('load', data.articulos);
              if($('#modal_conectividad').modal('show')){
                $('#form_show').show();
                $('#form-busqueda').hide();
              }else{
                $('#modal_conectividad').modal('show'); 
              }
          }
      }); 
    
    }else{
      $('#form_show').hide();
      $('#form_busqueda').show();
      $('#modal_conectividad').modal('show'); 
      $("#tDetalle").hide();
      $("#tEdicion").hide();
      $("#tBusquedaConect").show();
    }
    return data;
  }

  //FUNCIÓN para obtener datos de modal de detalles de conectividad
  var obtenerDetallesPrograma = function(){
    data = [];
    var idProgramaS = window.idProgramaSeleccionado;
    
    if(idProgramaS){
       $.ajax({
          url : "../programa/show",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {idPrograma: idProgramaS},
          success: function(response) {
            data = response;

            $('#idPrograma').html(data.programa.idPrograma);
            $('#programa').html(data.programa.programa);
            $('#tipoPrograma').html(data.programa.tipoprograma);
            $('#idCatPrograma').html(data.programa.idCatPrograma);
            $('#idCatPrograma').hide();
            if(edicion == true){
              $('#ipModem_input').val(data.programa.ipModem);
              $('#ipTelefonia_input').val(data.programa.ipTelefonia);
              for(var i=0;i<data.proveedores.length;i++){
                        $("<option />").val(data['proveedores'][i].idCatProveedor)
                                       .text(data['proveedores'][i].nombre)
                                       .appendTo($('select#select_proveedores'));
              }
              $('#select_proveedores').val(data.programa.idCatProveedor);
              if(data.programa.tipoprograma == 'FEDERAL'){
                $('#gid_input').val(data.programa.gid);
                $('#vsatid_input').val(data.programa.vsatid);
                $('#selectStatusP').val(data.programa.status);
                $('#gid_input').show();
                $('#vsatid_input').show();
                $('#ipTelefonia_input').show();
                $('#ipModem_input').show();
                $('#div_gid_vsatid').show();
              }else{
                $('#div_gid_vsatid').hide();
              }

              $('#selectStatusP').show();
              $('#select_proveedores').show();
              $('#select_programas').hide();

              $('#selectTipoPrograma').hide();
              $('#statusPrograma').hide();
              $('#gid').hide();
              $('#vsatid').hide();    
              $('#ipModem').hide();
              $('#ipTelefonia').hide();
              $('#proveedor').hide();
              $('#pDetalle').hide();
              $('#pEdicion').show();
              $('#edicionProgramaB').show();
              $('#pNuevo').hide();
            }else{
              $('#gid').html(data.programa.gid);
              $('#vsatid').html(data.programa.vsatid);
              $('#ipModem').html(data.programa.ipModem);
              $('#ipTelefonia').html(data.programa.ipTelefonia);
              $('#proveedor').html(data.programa.proveedor);
              $('#tipoPrograma').html(data.programa.tipoPrograma);
              if(data.programa.status === 1){
                $('#statusPrograma').addClass("btn btn-xs btn-success");
                $('#statusPrograma').html("Activo");
              }else{
                $('#statusPrograma').addClass("btn btn-xs btn-danger");
                $('#statusPrograma').html("Inactivo");
              }
              if(data.programa.tipoprograma == 'FEDERAL')
                $('#div_gid_vsatid').show();
              else
                $('#div_gid_vsatid').hide();


              $("#btn_cancelar_modalPrograma").attr("value","Cerrar");
              $('#gid').show();
              $('#vsatid').show();    
              $('#ipModem').show();
              $('#ipTelefonia').show();
              $('#proveedor').show();
              $('#pDetalle').show();
              $('#statusPrograma').show();
              $('#form_busqueda').hide();
              $('#selectStatusP').hide();
              $('#select_programas').hide();
              $('#selectTipoPrograma').hide();
              $('#select_proveedores').hide();
              $('#ipModem_input').hide();
              $('#ipTelefonia_input').hide();
              $('#gid_input').hide();
              $('#vsatid_input').hide();
              $('#pEdicion').hide();
              $('#pNuevo').hide();
              $('#edicionProgramaB').hide();
            }
            $('#modal_programa').modal('show'); 
          }
      }); 

    }else{
        $.ajax({
            url : "../programa/getListasCatalogos",
            type: "POST",
            dataType: "JSON",
            async: false,
            beforeSend: function(){
                $('#msjAlertI').html('Cargando información, por favor espere...');
                 modalAlertInfo.modal('show');
              },
            success: function(response) {
              data = response;
              if(data){
                for(var i=0;i<data.proveedores.length;i++){
                        $("<option />").val(data['proveedores'][i].idCatProveedor)
                                       .text(data['proveedores'][i].nombre)
                                       .appendTo($('select#select_proveedores'));
                } 
                for(var i=0;i<data.programas.length;i++){
                        $("<option />").val(data['programas'][i].idCatPrograma)
                                       .text(data['programas'][i].nombre)
                                       .appendTo($('select#select_programas'));
                }

                $('#gid').hide();
                $('#vsatid').hide();  
                $('#proveedor').hide();
                $('#pDetalle').hide();
                $('#ipTelefonia').hide();
                $('#ipModem').hide();
                $('#pEdicion').hide();
                $('#pDetalle').hide();
                $('#pNuevo').show();
                $('#selectTipoPrograma').val(1);
                $('#selectTipoPrograma').prop('disabled', 'disabled');
                $('#select_programas').val(1);
                modalAlertInfo.modal('hide');
                $('#modal_programa').modal('show');
              }else{
                modalAlertInfo.modal('hide');
              }
            }
        }); 
    }
  }

  var obtenerDetallesProveedor = function(){
    data = [];
    var idCatProveedorS = window.idCatProveedorSeleccionado;
    $.ajax({
          url : "../catalogos/getProvedorCAT",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {idCatProveedor: idCatProveedorS},
          success: function(response) {
            data = response;
              $('#proveedorName').html(data.nombre);
              $('#nomContacto').html(data.nombreContacto);
              $('#telContacto').html(data.telContacto);
              if(data.status == 1){
                $('#statusProveedor').addClass("btn btn-xs btn-success");
                $('#statusProveedor').html("Activo");
              }else{
                $('#statusProveedor').addClass("btn btn-xs btn-danger");
                $('#statusProveedor').html("Inactivo");
              }

            $('#form_proveedor').show(); 
          }
      }); 
    return data;
  }

  var edicionConectividad = function(){
     data = [];
      var idConectividadS = window.idConectividadSeleccionado;
      var valoresForm = "&respSitio=" + $('#rsitio').val() + 
                        "&respInventario=" + $('#rinventario').val() +
                        "&telefonoContacto=" + $('#input_telContacto') +
                        "&idConectividad=" + idConectividadS;
      $.ajax({
            url : "editar",
            type: "POST",
            dataType: "JSON",
            async: false,
            data: valoresForm,
            beforeSend: function(){
              $('#msjAlertI').html('ACTUALIZANDO, ESPERA POR FAVOR...');
               modalAlertInfo.addClass("modal-info");
              modalAlert.modal('show');
            },
            success: function(response) {
              data = response;
              if(data.status = true){
                $('#modal_conectividad').modal('hide');
                $('#msjAlertS').html(data.msj);
                modalAlertSuccess.modal('show'); 
              }else{
                $('#msjAlertD').html(data.msj);
                modalAlertDanger.modal('show'); 
              }               
            }
        });  
      return data; 
  }

//Funciòn para guardar Programa, creación y edición
  var guardarPrograma = function(){
     data = [];
      var idProgramaS = window.idProgramaSeleccionado;
      if(idProgramaS){
        var metodo = '../programa/edicion';
        var idCatPrograma = $('#idCatPrograma').html();
      }else{
        var metodo = '../programa/nuevo';
        var idCatPrograma = $('#select_programas').val();
      }

      var idConectividadS = window.idConectividadSeleccionado;
      var valoresForm = "&gid=" + $('#gid_input').val() +
                        "&vsatid=" + $('#vsatid_input').val() +
                        "&ipModem=" + $('#ipModem_input').val() +
                        "&ipTelefonia=" + $('#ipTelefonia_input').val() + 
                        "&programa=" + $('#programa').html() + 
                        "&idConectividad=" + idConectividadS +
                        "&idPrograma=" + idProgramaS +
                        "&idCatProveedor=" + $('#select_proveedores').val() +
                        "&status=" + $('#selectStatusP').val() +
                        "&idCatPrograma=" + idCatPrograma +
                        "&idTipoPrograma=" + $('#selectTipoPrograma').val();
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
            if(data.status === true){
              modalAlertInfo.modal('hide');
              limpiarModalPrograma(); 
              $('#modal_programa').modal('hide');
              $('#msjAlertS').html(data.msj);
              $('#tProgramas').bootstrapTable('load', data.programas);
              modalAlertSuccess.modal('show');

            }else{
              if(data.inputerror === undefined){
                  $('#msjAlertD').html(data.msj);
                  modalAlertDanger.modal('show'); 
              }else{
                modalAlertInfo.modal('hide');
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                } 
                    $('#msjAlertD').html('¡Por favor ingrese los valores de los campos correctamente!');
                    modalAlertDanger.modal('show');
              }
            }               
          }
        }); 
      
      return data; 
  }

//Funciòn para editar un proveedor
  var edicionProveedor = function(){
    data = [];
      var idCatProveedorS = window.idCatProveedorSeleccionado;
      var idProgramaS = window.idProgramaSeleccionado;
      var valoresFormPv = "&idCatProveedor=" + $('#proveedor').val() +
                        "&status=" + $('#statusPvr').val() +
                        "&idPrograma=" + idProgramaS +
                        "&idCatProveedorAnterior=" + idCatProveedorS;
      $.ajax({
            url : "../programa/edicionProveedor",
            type: "POST",
            dataType: "JSON",
            async: false,
            data: valoresFormPv,
            beforeSend: function(){
              $('#msjAlertI').html('Actualizando, espere por favor...');
               modalAlertInfo.modal('show');
            },
            success: function(response) {
              data = response;
              if(data.status === true){
                 alert(data.idPrograma);

                 $('#form_proveedor').hide();
                 $('#msjAlertS').html(data.msj);
                 modalAlertInfo.modal('hide');
                 $('#tProveedores').bootstrapTable('load', data.proveedores);
                 modalAlertSuccess.modal('show'); 
                 
              }else{
                $('#msjAlertD').html(data.msj);
                    modalAlertDanger.modal('show'); 
              }          
            },
        });  
      return data;
  }

  var limpiarModalPrograma = function(){
    $('#proveedores').empty();
    $('#form_programa')[0].reset(); // reset form on modals
    $('#form_programa .form-group').removeClass('has-error'); // clear error class
    $('#form_programa .form-group .help-block').empty(); // 
    window.idProgramaSeleccionado = null;
  }

  //FUNCIONES DE CRUD ARTÍCULO
  var obtenerDetallesArticulo = function(){
    data = [];
    var idArticuloS = window.idArticuloSeleccionado;
    if(idArticuloS){
       $.ajax({
          url : "../articulo/show",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {idArticulo: idArticuloS},
          success: function(response) {

            data = response;
            if(edicion === true){
              $('#descripcion_area').val(data.descripcion);
              $('#marca_input').val(data.marca);
              $('#modelo_input').val(data.modelo);
              $('#serie_input').val(data.serie);
              $('#selectArticulo').val(data.status);
              $('#descripcion').hide();
              $('#marca').hide();
              $('#modelo').hide();
              $('#serie').hide();
              $('#statusArticulo').hide();
              $('#descripcion_area').show();
              $('#marca_input').show();
              $('#modelo_input').show();
              $('#serie_input').show();
              $('#selectArticulo').show();
              $("#btnSaveArticulo").attr("value","Editar artículo");
              $('#btnSaveArticulo').show();
              $("#btn_cancelar_art").attr("value","Cancelar");
            }else{
              $('#descripcion').html(data.descripcion);
              $('#marca').html(data.marca);
              $('#modelo').html(data.modelo);
              $('#serie').html(data.serie);
              $('#statusArticulo').html(data.status);
              $('#descripcion_area').hide();
              $('#marca_input').hide();
              $('#modelo_input').hide();
              $('#serie_input').hide();
              $('#selectArticulo').hide();
              $('#descripcion').show();
              $('#marca').show();
              $('#modelo').show();
              $('#serie').show();
              if(data.status === 1){
                $('#statusArticulo').addClass("btn btn-xs btn-success");
                $('#statusArticulo').html("value","Activo");
              }else{
                $('#statusArticulo').addClass("btn btn-xs btn-danger");
                $('#statusArticulo').html("Inactivo");
              }
              $('#statusArticulo').show();
              $('#btnSaveArticulo').hide();
              $("#btn_cancelar_art").attr("value","Cerrar");
            }
            $('#aNuevo').hide();
            $('#aDetalle').show();
            $('#aEdicion').hide();
            $('#modal_articulo').modal('show'); 
          }
      }); 

    }else{
      $('#aNuevo').show();
      $('#aDetalle').hide();
      $('#aEdicion').hide();
      $("#btnSaveArticulo").attr("value","Guardar artículo");
      $('#btnSaveArticulo').show();
      $("#btn_cancelar_art").attr("value","Cancelar");
      $('#modal_articulo').modal('show'); 
    }
   
  }

  //Función para guardar Artículo, creación y edición
  var guardarArticulo = function(){
     data = [];
      var idArticuloS = window.idArticuloSeleccionado;
      var idConectividadS = window.idConectividadSeleccionado;
      var valoresForm = "&descripcion=" + $('#descripcion_area').val() +
                        "&marca=" + $('#marca_input').val() +
                        "&modelo=" + $('#modelo_input').val() +
                        "&serie=" + $('#serie_input').val() + 
                        "&statusArticulo=" + $('#selectArticulo').val() +
                        "&idConectividad=" + idConectividadS +
                        "&idArticulo=" + idArticuloS;
      if(idArticuloS){
        var metodo = '../articulo/edicion';
      }else{
        var metodo = '../articulo/nuevo';
      }

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
            if(data.status === true){
              modalAlertInfo.modal('hide');
              $('#modal_articulo').modal('hide');
              $('#msjAlertS').html(data.msj);
              $('#tArticulos').bootstrapTable('load', data.articulos);
              modalAlertSuccess.modal('show');
              limpiarModalArticulo(); 
            }else{
              if(data.inputerror === undefined){
                  $('#msjAlertD').html(data.msj);
                  modalAlertDanger.modal('show'); 
              }else{
                modalAlertInfo.modal('hide');
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('#'+data.inputerror[i]).parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('#'+data.inputerror[i]).next().text(data.error_string[i]); //select span help-block class set text error string
                } 
                    $('#msjAlertD').html('¡Por favor verifique el valor de los campos!');
                    modalAlertDanger.modal('show');
              }
            }               
          }
        }); 
      
     // return data; 
  }

  var limpiarModalArticulo = function(){
    $('#proveedores').empty();
    $('#form_articulo')[0].reset(); // reset form on modals
    $('#form_articulo .form-group').removeClass('has-error'); // clear error class
    $('#form_articulo .form-group .help-block').empty(); // 
    window.idProgramaSeleccionado = null;
    recargarArticulos();
    $('#modal_articulo').modal('hide');
  } 

  //FUNCIONES PARA FILTROS DE BUSQUEDA
  var getCatalogo = function(catalogo){
    data = [];
    $("#CA_Modalidad").hide();
    $("#CA_RegionMunicipio").hide();
    $("#CA_Turno").hide();
    $("#CA_NivelEducativo").hide();
    $.ajax({
          url : "getCatalogo",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {catalogo: catalogo},
          success: function(response) {
            data = response;

            if(data){
              $('#'+catalogo).bootstrapTable('load', data);
              $('#'+catalogo).show();
              $('#modal_filtros').modal('show');
            }
        }
    }); 
  }

  var filtrarDatos = function(dataFiltro){
    data = [];
    var modalidadSeleccionadas = $('#CA_Modalidad').bootstrapTable('getSelections');
    var municipioSeleccionadas = $('#CA_RegionMunicipio').bootstrapTable('getSelections');
    var nivelEducSeleccionadas = $('#CA_NivelEducativo').bootstrapTable('getSelections');
    var turnoSeleccionadas = $('#CA_Turno').bootstrapTable('getSelections');
    var nivelCTSeleccionadas = $('#CA_NivelCT').bootstrapTable('getSelections');
    var programaSeleccionadas = $('#CA_Programa').bootstrapTable('getSelections');
    var proveedorSeleccionadas = $('#CA_Proveedor').bootstrapTable('getSelections');
    var localidadSeleccionadas = $('#CA_Localidad').bootstrapTable('getSelections');

    if(modalidadSeleccionadas.length > 0 || municipioSeleccionadas.length > 0 || nivelEducSeleccionadas.length > 0 || turnoSeleccionadas.length > 0 ||
      nivelCTSeleccionadas.length > 0 || programaSeleccionadas.length > 0 || proveedorSeleccionadas.length > 0 || localidadSeleccionadas.length > 0){

      $.ajax({
          url : 'filtrarDatos',
          type: "POST",
          dataType: "JSON", 
          async: false,
          data: {filtrosMod: modalidadSeleccionadas, 
                 filtrosMunicipio: municipioSeleccionadas, 
                 filtrosNivelEduc: nivelEducSeleccionadas,
                 filtrosTurno: turnoSeleccionadas, 
                 filtrosNivelCT: nivelCTSeleccionadas, 
                 filtrosProgramas: programaSeleccionadas,
                 filtrosProveedores: proveedorSeleccionadas,
                 opcionConectividad: opcionConectividad,
                 filtrosLocalidad: localidadSeleccionadas},
          success: function(response) {
            data = response;
            filtros = true;
            console.log(data.programas);
            "<?php $data = data;?>"
            $('#tConectividad').bootstrapTable('load', data);
            $('#modal_filtros').modal('hide');
          // busquedaAnterior = busquedaActual;
          },
          error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
      });  


    }else{
      $('#msjAlertD').html('Debe seleccionar por lo menos un filtro de busqueda');
      modalAlertDanger.modal('show'); 
    }
  }

  var getCatalogos = function(){
    $.ajax({
          url : "getCatalogos",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {opcionConectividad: opcionConectividad},
          success: function(response) {
            data = response;

            if(data){
              $('#CA_Modalidad').bootstrapTable('load', data.modalidad);
              $('#CA_RegionMunicipio').bootstrapTable('load', data.municipios);
              $('#CA_NivelEducativo').bootstrapTable('load', data.nivelEducativo);
              $('#CA_Turno').bootstrapTable('load', data.turno);
              $('#CA_NivelCT').bootstrapTable('load', data.nivelCT);
              $('#CA_Programa').bootstrapTable('load', data.programas);
              $('#CA_Proveedor').bootstrapTable('load', data.proveedores);
              $('#CA_Localidad').bootstrapTable('load', data.localidad);

              $('#CA_Modalidad').hide();
              $('#CA_RegionMunicipio').hide();
              $('#CA_Turno').hide();
              $('#CA_NivelEducativo').show();
              $('#CA_NivelCT').hide();
              $('#CA_Proveedor').hide();
              $('#CA_Programa').hide();
              $('#CA_Localidad').hide();

              $('#btn_filtro_modalidad').addClass('btn-default').removeClass('btn-primary');
              $('#btn_filtro_municipio').addClass('btn-default').removeClass('btn-primary'); 
              $('#btn_filtro_nivelEduc').addClass('btn-default').removeClass('btn-primary');
              $('#btn_filtro_nivelCT').addClass('btn-default').removeClass('btn-primary');
              $('#btn_filtro_turno').addClass('btn-default').removeClass('btn-primary');
              $('#btn_filtro_programa').addClass('btn-default').removeClass('btn-primary');
              $('#btn_filtro_proveedor').addClass('btn-default').removeClass('btn-primary'); 
              $('#btn_filtro_localidad').addClass('btn-default').removeClass('btn-primary'); 

              if(opcionConectividad == 1){
                $('#btn_filtro_programa').show();
                $('#btn_filtro_programa').show();
              }
              if(opcionConectividad == 2 || opcionConectividad == 3){
                $('#btn_filtro_programa').hide();
                $('#btn_filtro_proveedor').hide();
              }

              $('#modal_filtros').modal('show');
            }
        }
    });   
  }

  var comprobarFiltrosSeleccionados = function(){
    var modalidadSeleccionadas = $('#CA_Modalidad').bootstrapTable('getSelections');
    var municipioSeleccionadas = $('#CA_RegionMunicipio').bootstrapTable('getSelections');
    var nivelEducSeleccionadas = $('#CA_NivelEducativo').bootstrapTable('getSelections');
    var turnoSeleccionadas = $('#CA_Turno').bootstrapTable('getSelections');
    var nivelCTSeleccionadas = $('#CA_NivelCT').bootstrapTable('getSelections');
    var programaSeleccionadas = $('#CA_Programa').bootstrapTable('getSelections');
    var proveedorSeleccionadas = $('#CA_Proveedor').bootstrapTable('getSelections');
    var localidadSeleccionadas = $('#CA_Localidad').bootstrapTable('getSelections');


    if(modalidadSeleccionadas.length > 0)
     $('#btn_filtro_modalidad').addClass('btn-primary').removeClass('btn-default');
     else 
     $('#btn_filtro_modalidad').addClass('btn-default').removeClass('btn-primary');

    if(municipioSeleccionadas.length > 0)
      $('#btn_filtro_municipio').addClass('btn-primary').removeClass('btn-default');
    else 
      $('#btn_filtro_municipio').addClass('btn-default').removeClass('btn-primary');

    if(nivelEducSeleccionadas.length > 0)
      $('#btn_filtro_nivelEduc').addClass('btn-primary').removeClass('btn-default');
    else 
      $('#btn_filtro_nivelEduc').addClass('btn-default').removeClass('btn-primary');

    if(nivelCTSeleccionadas.length > 0)
      $('#btn_filtro_nivelCT').addClass('btn-primary').removeClass('btn-default');
    else 
      $('#btn_filtro_nivelCT').addClass('btn-default').removeClass('btn-primary');

     if(turnoSeleccionadas.length > 0)
      $('#btn_filtro_turno').addClass('btn-primary').removeClass('btn-default');
    else 
      $('#btn_filtro_turno').addClass('btn-default').removeClass('btn-primary');

     if(programaSeleccionadas.length > 0)
      $('#btn_filtro_programa').addClass('btn-primary').removeClass('btn-default');
    else 
      $('#btn_filtro_programa').addClass('btn-default').removeClass('btn-primary');

     if(proveedorSeleccionadas.length > 0)
      $('#btn_filtro_proveedor').addClass('btn-primary').removeClass('btn-default');
    else 
      $('#btn_filtro_proveedor').addClass('btn-default').removeClass('btn-primary'); 

    if(localidadSeleccionadas.length > 0)
      $('#btn_filtro_localidad').addClass('btn-primary').removeClass('btn-default');
    else 
      $('#btn_filtro_localidad').addClass('btn-default').removeClass('btn-primary'); 

  }

  var exportarExcel = function(){
    var dataInfo = $('#tConectividad').bootstrapTable('getData');
    alert(dataInfo);
    $.ajax({
          url : "exportarExcel",
          type: "POST",
          dataType: "JSON",
          data: {dataInfo: dataInfo},
          async: false,
          beforeSend: function(){
            $('#msjAlertI').html('Actualizando, espere por favor...');
             modalAlertInfo.modal('show');
          },
          success: function(response) {
            data = response;
            alert(data);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error deleting data');
          }
      }); 
  } 





