<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <!--Jquery-iu autocomplete>

  <!--CSS para cambiar los textos a mayusculas-->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/aplicacion.css'); ?>"
  >
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                        <img src="<?php echo base_url('assets/dist/img/user.jpg'); ?>" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <!-- The message -->
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo base_url('assets/dist/img/user.jpg'); ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/dist/img/user.jpg'); ?>" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/user.jpg'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?php echo base_url('conectividad/home')?>"><i class="fa fa-rss"></i> <span>Lista Conectividad</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Catalogos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('catalogos/listProgramas/')?>">Programas</a></li>
            <li><a href="<?php echo base_url('catalogos/listProveedores/')?>">Proveedores</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Contenido dinamico de la pagina!-->
    <?php echo $this->section('page')?>

  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

  

  <!--MODAL CONECTIVIDAD EDICION, Y DETALLE-->
  <!--div class="modal fade" id="modal_conectividad">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="btn_close_Con" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 id="tDetalle" class="modal-title">Detalle conectividad</h4>
          <h4 id="tEdicion" class="modal-title">Edición conectividad</h4>
          <h4 id="tBusquedaConect" class="modal-title">Agregar centro a lista conectividad</h4>
        </div>

        <div class="modal-body">
          <form id="form_busqueda" class="form-horizontal">
              <div class="form-group">
                  <label class="control-label col-md-3">Ingresa Clave CT: </label>
                    <div class="col-md-3">
                            <input id="claveCT_buscar" placeholder="Clave CT" class="form-control" type="text" maxlength="10">
                            <span class="help-block"></span>
                     </div>
                    <div class="col-md-6">
                            <button type="button" id="btnBuscarConectividad" class="btn btn-info">
                        Buscar
                    </button>
                    </div>
              </div>
          </form>
           
          <form id="form_show" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">Clave CT: </label>
                    <div class="col-md-3">
                        <span class="help-block" id="claveCT"></span>
                    </div>
                    <label class="control-label col-md-3">Status: </label>
                    <div class="col-md-3">
                        <span class="help-block" id="statusConectividad"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Nombre CT: </label>
                    <div class="col-md-6">
                        <span class="help-block" id="nombreCT"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Municipio: </label>
                    <div class="col-md-3">
                        <span class="help-block" id="municipio"></span>
                    </div>
                    <label class="control-label col-md-3">Localidad: </label>
                    <div class="col-md-3">
                        <span class="help-block" id="localidad"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Colonia: </label>
                    <div class="col-md-3">
                        <span class="help-block" id="colonia"></span>
                    </div>
                    <label class="control-label col-md-3">Nivel Educativo:</label>
                    <div class="col-md-3">
                        <span class="help-block" id="nivelEducativo"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Turno</label>
                    <div class="col-md-3">
                        <span class="help-block" id="turno"></span>
                    </div>
                    <label class="control-label col-md-3">Modalidad:</label>
                    <div class="col-md-3">
                        <span class="help-block" id="modalidad"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Latitud: </label>
                    <div class="col-md-3">
                        <input class="" type="text" name="latitud" id="latitudInput" size="20" placeholder="Latitud">
                        <span class="help-block" id="latitud"></span>
                    </div>
                    <label class="control-label col-md-3">Longitud:</label>
                    <div class="col-md-3">
                        <input class="" type="text" name="longitud" id="longitudInput" size="20" placeholder="Longitud">
                        <span class="help-block" id="longitud"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Responsable sitio:</label>
                    <div class="col-md-6" id="div_rsitio">
                        <span class="help-block" id="respSitio"></span>
                    </div>
                    <div class="col-md-6" id="divSitio">
                        <input class="letras" type="text" name="rsitio" id="rsitio" size="50" placeholder="Nombre Responsable Sitio">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Responsable Inventario:</label>
                    <div class="col-md-6" id="div_rinventario">
                        <span class="help-block" id="respInventario"></span>
                    </div>
                    <div class="col-md-6" id="divInventario">
                        <input class="letras" type="text" name="rinventario" id="rinventario" size="50" placeholder="Nombre Responsable Inventario">
                    </div>
                    <div class="col-md-3" id="saveConectividadB">
                        <input type="button" value="Editar" ="" id="edicionConectividadB" class="btn btn-success">
                    </div>
                </div>

                <div class="form-group">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <div id="toolbarP">
                      <button type="button" class="btn btn-primary" id="btnMostrarPrograma">Detalles</button>
                      <button type="button" class="btn btn-primary" id="btnEditarPrograma">Editar</button>
                      <button type="button" class="btn btn-primary" id="btnAgregarPrograma">Agregar programa</button>
                    </div>
                    <table id="tProgramas"></table>
                  </div>
                  <div class="col-md-2"></div>
                </div>
                <div class="form-group">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <div id="toolbarA">
                      <button type="button" class="btn btn-primary" id="btnMostrarArticulo">Detalles</button>
                      <button type="button" class="btn btn-primary" id="btnEditarArticulo">Editar</button>
                      <button type="button" class="btn btn-primary" id="btnAgregarArticulo">Agregar artículo</button>
                    </div>
                    <table id="tArticulos"></table>
                  </div>
                  <div class="col-md-2"></div>
                </div>
            </div>
          </form>       
        </div>
        <div class="modal-footer">
        <br><br>
           <input type="button" value="Cancelar" id="btn_cancelar_con" class="btn btn-default pull-left" data-dismiss="modal">
        </div>
      </div>
      <!-- /.modal-content >
    </div>
    <!-- /.modal-dialog >
  </div-->

  

  <div class="modal fade" id="modal_articulo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="btn_close_Articulo" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 id="aDetalle" class="modal-title">Detalle artículo</h4>
          <h4 id="aEdicion" class="modal-title">Edición artículo</h4>
          <h4 id="aNuevo" class="modal-title">Agregar artículo</h4>
        </div>
           
          <form id="form_articulo" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">Descripción* : </label>
                    <div class="col-md-3">
                        <span class="help-block" id="descripcion"></span>
                        <textarea class="form-control" rows="5" name="descripcion_area" id="descripcion_area"></textarea>
                        <span class="help-block"></span>
                    </div>
                    <label class="control-label col-md-3">Marca* : </label>
                    <div class="col-md-3">
                        <span class="help-block" id="marca"></span>
                        <input type="text" name="marca_input" id="marca_input">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Modelo* : </label>
                    <div class="col-md-3">
                        <span class="help-block" id="modelo"></span>
                        <input type="text" name="modelo_input" id="modelo_input">
                        <span class="help-block"></span>
                    </div>
                    <label class="control-label col-md-3">Serie: </label>
                    <div class="col-md-3">
                        <span class="help-block" id="serie"></span>
                        <input type="text" name="serie_input" id="serie_input">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Status: </label>
                    <div class="col-md-3">
                        <span class="help-block" id="statusArticulo"></span>
                        <select class="form-control xs" id="selectArticulo">
                          <option value="1">Activo</option>
                          <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>
          </form>       
        <div class="modal-footer">
           <input type="button" value="Cancelar" id="btn_cancelar_art" class="btn btn-default pull-left" data-dismiss="modal">
           <input type="button" value="Guardar Artículo" id="btnSaveArticulo" class="btn btn-success">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>  

      <!--MODAL filtros-->
  <div class="modal fade" id="modal_filtros">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="btn_close_Filtros" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Filtros</h4>
        </div>

        <div class="modal-body" >


          <form id="form_articulo" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-1">Filtro : </label>
                    <div class="btn-group-vertical col-md-3">
                      <button class="btn btn-default" type="button" id="btn_filtro_nivelEduc">Nivel Educativo</button>
                      <button class="btn btn-default" type="button" id="btn_filtro_nivelCT">  NivelCT  </button>
                      <button class="btn btn-default" type="button" id="btn_filtro_modalidad">Modalidad</button>
                      <button class="btn btn-default" type="button" id="btn_filtro_turno">Turno</button>
                      <button class="btn btn-default" type="button" id="btn_filtro_municipio">Municipio</button>
                      <button class="btn btn-default" type="button" id="btn_filtro_localidad">Localidad</button>
                      <button class="btn btn-default" type="button" id="btn_filtro_programa">Programa</button>
                      <button class="btn btn-default" type="button" id="btn_filtro_proveedor">Proveedor</button>
                      <!--button class="btn btn-default" type="button" id="btn_filtro_municipio">Municipio</button-->
                    </div>
                    <div class="col-md-6">
                        <table id="CA_Modalidad"></table>
                        <table id="CA_RegionMunicipio"></table>
                        <table id="CA_NivelEducativo"></table>
                        <table id="CA_Turno"></table>
                        <table id="CA_Programa"></table>
                        <table id="CA_Proveedor"></table>
                        <table id="CA_NivelCT"></table>
                        <table id="CA_Localidad"></table>
                    </div>
                    
                </div>
                <!--div class="form-group">
                  <div class="col-md-8">
                        <table id="CA_Modalidad"></table>
                        <table id="CA_RegionMunicipio"></table>
                        <table id="CA_NivelEducativo"></table>
                        <table id="CA_Turno"></table>
                    </div>
                </div-->
            </div>
          </form>
        </div>
          
        <div class="modal-footer">
           <input type="button" value="Cancelar" id="btn_cancelar_filtros" class="btn btn-default pull-left" data-dismiss="modal">
           <input type="button" value="Filtrar" id="btnFiltrar" class="btn btn-success">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Modal para bloquear la vista mientras se realizan peticiones ajax al servidor -->
  <div class="modal modal-info fade" id="modalAlertInfo">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Información del sistema</h4>
        </div>
        <div class="modal-body">
            <strong id="msjAlertI"></strong>
        </div>
        <div class="modal-footer">
          <div class="col-md-4"></div>
          <div class="col-md-4">
                <button type="button" class="btn btn-outline pull-left btn-xm" data-dismiss="modal">Cerrar</button>
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- Modal Alertas de exito-->
  <div class="modal modal-success fade" id="modalAlertSuccess">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Información del sistema</h4>
        </div>
        <div class="modal-body">
            <strong id="msjAlertS"></strong>
        </div>
        <div class="modal-footer">
          <div class="col-md-4"></div>
          <div class="col-md-4">
                <button type="button" class="btn btn-outline pull-left btn-xm" data-dismiss="modal">Cerrar</button>
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

   <!-- Modal Alertas de peligro-->
  <div class="modal modal-danger fade" id="modalAlertDanger">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Información del sistema</h4>
        </div>
        <div class="modal-body">
            <strong id="msjAlertD"></strong>
        </div>
        <div class="modal-footer" align->
          <div class="col-md-4"></div>
          <div class="col-md-4">
                <button type="button" class="btn btn-outline pull-left btn-xm" data-dismiss="modal">Cerrar</button>
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
<!-- SlimScroll -->
<!--script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<!--script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.js"></script>
<script src="<?php echo base_url('assets/js/validaciones.js');?>"></script>

<?php echo $this->section('extra_js')?>
</body>
</html>