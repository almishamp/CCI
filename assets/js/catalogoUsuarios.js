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

    //TABLA para mostrar Catalogo de Usuarios 
    $('#tUsuarios').bootstrapTable({
      data: recargarCUsuarios(),
      pagination: true,
      sidePagination: 'client',
      pageList: [10, 20, 50, 100],
      search: true,
      locale: 'es-MX',
      classes: 'table table-hover table-condensed',
      striped: true,
      toolbar: '#toolbarUsuarios',
      iconSize: 'btn-sm',
      clickToSelect: true,
      showRefresh: true,
      showFooter: true,
      columns: [
        {radio: true},
        {field: 'idUsuario', title: '·.', visible: false},
        {field: 'nombreUsuario', title: 'Nombre', sortable: true, align: 'center'}, 
        {field: 'contrasenia', title: 'Password', sortable: true, align: 'center'}, 
        {field: 'email', title: 'email', sortable: true, align: 'center'}, 
        {field: 'role', title: 'role', sortable: true, align: 'center'},    
        {field: 'estatus', title: 'Status', align: 'center', sortable: true, formatter: function(value, row, index){
          string = value == 1 ? "<span class='btn btn-xs btn-success'>Activo</span>" : "<span class='btn btn-xs btn-warning'>Inactivo</span>"
        return string;
        }}
      ],
      onClickRow: function(row, $element, field){
        window.idUsuarioSeleccionado = row.idUsuario;
      },
      onCheck: function(row, $element, field){
        window.idUsuarioSeleccionado = row.idUsuario;
      }, 

    });

  });

 //EVENTO para mostrar modal de detalles del catálogo Usuario
  $('#btnMostrarUsuario').click(function(){
    if(window.idUsuarioSeleccionado){
      edicion = false;
      obtenerDetalleCUsuario();
    }else{
      $('#msjAlertD').html("Seleccione un Usuario");
      modalAlertDanger.modal('show'); 
    }
  });
  
  //EVENTO para mostrar modal de detalles del catálogo Usuario
  $('#btnEditarUsuario').click(function(){
    if(window.idUsuarioSeleccionado){
        edicion = true;
        obtenerDetallesCUsuario();
    }else{
      $('#msjAlertD').html("Seleccione un Centro");
      modalAlertDanger.modal('show'); 
    } 
  });

  $('#btnAgregarUsuario').click(function(){
    if(window.idUsuarioSeleccionado)
        window.idUsuarioSeleccionado = null;
    obtenerDetalleUsuario(); 
  });

//EVENTO para limpiar modal
  $('#btn_cancelar_cUsuario').click(function(){
    limpiarModalCUsuario(); 
  });

  $('#btn_close_catUsuario').click(function(){
    limpiarModalCUsuario();
  });

  $('#btnSaveCUsuario').click(function(){
    guardarCUsuario();
  });

  var recargarCUsuarios = function(){
    data = [];
    $.ajax({
          url : "../getListUsuarios",
          type: "POST",
          dataType: "JSON",
          async: false,
          success: function(response) {
            data = response;
            $('#tUsuarios').bootstrapTable('load', data.Usuarios);
            $('#userNameSpan1').html(data.user.nombreUsuario);
            $('#userNameSpan2').html(data.user.nombreUsuario);
          }
      }); 
    return data.usuarios;
  }


  //FUNCIONES DE CRUD CUsuarios
  var obtenerDetalleCUsuario = function(){
    data = [];
    var idUsuarioS = window.idUsuarioSeleccionado;
    if(idUsuarioS){
       $.ajax({
          url : "../showUsuario",
          type: "POST",
          dataType: "JSON",
          async: false,
          data: {idUsuario: idUsuarioS},
          success: function(response) {

            data = response;
            if(edicion === true){
              $('#select_statusUsuario').val(data.status);
              $('#select_rolUsuario').val(data.role);
              $('#nombreUsuario_input').val(data.nombreUsuario);
              $('#password_input').val(data.contrasenia);
              $('#email_input').val(data.email);
              $('#nombreUsuario').hide();
              $('#statusUsuario').hide();
              $('#password').hide();
              $('#rol').hide();
              $('#email').hide();
              $("#btnSaveUsuario").attr("value","Editar Usuario");
              $('#btnSaveUsuario').show();
              $("#btn_cancelar_usuario").attr("value","Cancelar");
              $('#nombreUsuario_input').show();
              $('#UsuarioDetalle').hide();
              $('#UsuarioEdicion').show();
              $('#UsuarioNuevo').hide();
              $('#select_statusCP').show();
            }else{
              $('#nombreUsuario').html(data.nombreUsuario);
              if(data.estatus === 1){
                $('#statusUsuario').addClass("btn btn-xs btn-success");
                $('#statusUsuario').html("Activo");
              }else{
                $('#statusUsuario').addClass("btn btn-xs btn-danger");
                $('#statusUsuario').html("Inactivo");
              }
              $('#nombreUsuario').show();
              $('#statusUsuario').show();
              $('#btnSaveUsuario').hide();
              $("#btn_cancelar_Usuario").attr("value","Cerrar");
              $('#nombreUsuario_input').hide();
              $('#select_statusUsuario').hide();
              $('#select_rolUsuario').hide();
              $('#UsuarioDetalle').show();
              $('#UsuarioEdicion').hide();
              $('#UsuarioNuevo').hide();
            }
            
            $('#modal_usuario').modal('show'); 
          }
      }); 

    }else{
      $('#nombreUsuario_input').show();
      $('#select_statusUsuario').show();
      $('#select_rolUsuario').show();
      $('#select_statusUsuario').hide();
      $('#select_rolUsuario').hide();
      $('#CPNuevo').show();
      $('#CPDetalle').hide();
      $('#CPEdicion').hide();
      $("#btnSaveUsuario").attr("value","Guardar usuario");
      $('#btnSaveUsuario').show();
      $("#btn_cancelar_cUsuario").attr("value","Cancelar");
      $('#modal_usuario').modal('show'); 
    }
   
  }

  //Función para guardar Artículo, creación y edición
  var guardarCUsuario = function(){
     data = [];
      var idCatUsuarioS = window.idCatUsuarioSeleccionado;
      if(idCatUsuarioS){
        var metodo = '../editarUsuario';
      }else{
        var metodo = '../nuevoUsuario';
      }
      var valoresForm = "&nombre=" + $('#nombrecp_input').val() + 
                        "&status=" + $('#select_statusCP').val() + 
                        "&idCatUsuario=" + idCatUsuarioS;
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
              $('#modal_CUsuarios').modal('hide');
              $('#msjAlertS').html(data.msj);
              modalAlertSuccess.modal('show');
              limpiarModalCUsuario(); 
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

  var limpiarModalCUsuario = function(){
    $('#form_cUsuarios')[0].reset(); // reset form on modals
    $('#form_cUsuarios .form-group').removeClass('has-error'); // clear error class
    $('#form_cUsuarios .form-group .help-block').empty(); // 
    window.idCatUsuarioSeleccionado = null;
    recargarCUsuarios();
  }


