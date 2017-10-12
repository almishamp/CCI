

<?php $this->layout('main', ['title'=>'Conectividad'])?>
<?php $this->start('extra_style')?>
<?php $this->stop()?>
<?php $this->start('page')?>

<div id="toolbar">
    <button type="button" class="btn btn-primary" id="btnMostrar">Detalles</button>
    <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
</div>

<section class="content-header">
    <h1>
      Lista Conectividad
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  

                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="col-md-9">
                        <button type="button" class="btn btn-success" id="btnAgregarCentro">Agregar centro</button>
                        <button type="button" class="btn btn-primary" id="btn_modal_filtros">Filtros</button> 
                    </div>
                    <div class="btn-group-vertical col-md-3">
                      <button class="btn btn-default" type="button" id="btn_conConexion">Conectados</button>
                      <button class="btn btn-default" type="button" id="btn_sinConexion">No conectados  </button>
                      <button class="btn btn-default" type="button" id="btn_con_sin_Conexion">Con y sin conexión</button>
                    </div> 

                    <br><br>
                    <div class="collapse" id="collapseExample">
                      <p>
                        <button class="btn btn-primary" type="button" id="btn_modal_filtros_modalidad">Modalidad</button>
                        <button class="btn btn-primary" type="button" id="btn_modal_filtros_municipio">Municipio</button>

                      </p>
                    </div >  
                  
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="tConectividad"></table>
                      </div>
                    </div>  
                  </div>
                <!-- /.box-body -->
                </div> 
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->  
    </div>
    <!-- /.row -->
</section>

<!--MODAL CONECTIVIDAD EDICION, Y DETALLE-->
  <div class="modal fade" id="modal_conectividad">
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
                            <input id="claveCT_buscar" placeholder="Clave CT" class="form-control mayusculas" type="text" maxlength="10" size="10">
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
                        <input class="mayusculas" type="text" name="latitud" id="latitudInput" size="20" placeholder="Latitud">
                        <span class="help-block" id="latitud"></span>
                    </div>
                    <label class="control-label col-md-3">Longitud:</label>
                    <div class="col-md-3">
                        <input class="mayusculas" type="text" name="longitud" id="longitudInput" size="20" placeholder="Longitud">
                        <span class="help-block" id="longitud"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Responsable sitio:</label>
                    <div class="col-md-6" id="div_rsitio">
                        <span class="help-block" id="respSitio"></span>
                    </div>
                    <div class="col-md-6" id="divSitio">
                        <input class="mayusculas" type="text" name="rsitio" id="rsitio" size="50" placeholder="Nombre Responsable Sitio">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Responsable Inventario:</label>
                    <div class="col-md-6" id="div_rinventario">
                        <span class="help-block" id="respInventario"></span>
                    </div>
                    <div class="col-md-6" id="divInventario">
                        <input class="mayusculas" type="text" name="rinventario" id="rinventario" size="50" placeholder="Nombre Responsable Inventario">
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
          </form>       
        </div>
        <div class="modal-footer">
        <br><br>
           <input type="button" value="Cancelar" id="btn_cancelar_con" class="btn btn-default pull-left" data-dismiss="modal">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

    <!--MODAL PROGRAMA-->
  <div class="modal modal-default fade" id="modal_programa">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" id="btn_cerrar_modalPrograma">
            <span aria-hidden="true">&times;</span></button>
          <h4 id="pDetalle" class="modal-title">Detalle programa</h4>
          <h4 id="pEdicion" class="modal-title">Edición programa</h4>
          <h4 id="pNuevo" class="modal-title">Nuevo programa</h4>
        </div>

        <div class="modal-body"> 
          <form action="#" id="form_programa" class="form-horizontal">
            <div class="form-body">
              <div class="form-group">
                  <label class="control-label col-md-3">Programa: </label>
                    <span class="help-block" id="idCatPrograma"></span>

                  <div class="col-md-3">
                      <span class="help-block" id="programa"></span>
                      <select id="select_programas" name="select_programas" class="form-control">
                      </select>
                      <span class="help-block"></span>
                  </div>
                  <label class="control-label col-md-3">Tipo Programa: </label>
                  <div class="col-md-3">
                      <span class="help-block" id="tipoPrograma"></span>
                      <select class="form-control xs" id="selectTipoPrograma" name="selectTipoPrograma">
                        <option value="1">Estatal</option>
                        <option value="2">Federal</option>
                        <span class="help-block"></span>
                      </select>
                      <span class="help-block"></span>

                  </div>
              </div>
              <div class="form-group" id="div_gid_vsatid">
                  <label class="control-label col-md-3">GID: </label>
                  <div class="col-md-3">
                      <span class="help-block" id="gid"></span>
                      <input class="input-number" type="text" name="gid_input" id="gid_input" size="6" placeholder="GID" maxlength="6">
                      <span class="help-block"></span>
                  </div>
                  <label class="control-label col-md-3">VSATID: </label>
                  <div class="col-md-3">
                      <span class="help-block" id="vsatid"></span>
                      <input class="mayusculas" type="text" name="vsatid_input" id="vsatid_input" size="6" placeholder="VSATID" maxlength="9">
                      <span class="help-block"></span>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3">Ip Modem: </label>
                  <div class="col-md-3" id="div_ipModem">
                      <span class="help-block" id="ipModem"></span>
                      <input type="text" name="ipModem_input" id="ipModem_input" size="11" placeholder="IP Modem" maxlength="14">
                      <span class="help-block"></span>
                  </div>
                  <label class="control-label col-md-3">IP Telefonía: </label>
                  <div class="col-md-3" id="div_ipTelefonia" >
                      <span class="help-block" id="ipTelefonia"></span>
                      <input type="text" name="ipTelefonia_input" id="ipTelefonia_input" size="11" placeholder="IP Telefonía" maxlength="14">
                      <span class="help-block"></span>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3">Status: </label>
                  <div class="col-md-3" id="div_status">
                    <span class="help-block" id="statusPrograma"></span>
                      <select class="form-control xs" id="selectStatusP" ip="selectStatusP">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                      </select>
                      <span class="help-block"></span>
                  </div>
                  <label class="control-label col-md-3">Proveedor: </label>
                  <div class="col-md-3">
                    <span class="help-block" id="proveedor"></span>
                    <select id="select_proveedores" name="select_proveedores" class="form-control"></select>
                    <span class="help-block"></span>                     
                  </div>
                  
              </div>
            </div>
          </form>    
        </div>
        <div class="modal-footer">
          <input type="button" id="btn_cancelar_modalPrograma" value="Cancelar" class="btn btn-default pull-left">
          <button type="button" id="edicionProgramaB" class="btn btn-success btn-sm">Guardar cambios</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal_articulo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="btn_close_Articulo" class="close" aria-label="Close">
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
                        <textarea class="form-control mayusculas" rows="5" name="descripcion_area" id="descripcion_area"></textarea>
                        <span class="help-block"></span>
                    </div>
                    <label class="control-label col-md-3">Marca* : </label>
                    <div class="col-md-3">
                        <span class="help-block" id="marca"></span>
                        <input type="text" class="mayusculas" name="marca_input" id="marca_input">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Modelo* : </label>
                    <div class="col-md-3">
                        <span class="help-block" id="modelo"></span>
                        <input type="text" class="mayusculas" name="modelo_input" id="modelo_input">
                        <span class="help-block"></span>
                    </div>
                    <label class="control-label col-md-3">Serie: </label>
                    <div class="col-md-3">
                        <span class="help-block" id="serie"></span>
                        <input type="text" class="mayusculas" name="serie_input" id="serie_input">
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
           <input type="button" value="Cancelar" id="btn_cancelar_art" class="btn btn-default pull-left">
           <input type="button" value="Guardar Artículo" id="btnSaveArticulo" class="btn btn-success">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal_filtrar">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="btn_close_Articulo" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 id="aDetalleFiltros" class="modal-title">Filtrar</h4>
        </div>
           
          <form id="form_articulo" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">Descripción* : </label>
                    <div class="col-md-3">
                        <span class="help-block" id="descripcion"></span>
                        <textarea class="form-control mayusculas" rows="5" name="descripcion_area" id="descripcion_area"></textarea>
                        <span class="help-block"></span>
                    </div>
                    <label class="control-label col-md-3">Marca* : </label>
                    <div class="col-md-3">
                        <span class="help-block" id="marca"></span>
                        <input type="text" class="mayusculas" name="marca_input" id="marca_input">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Modelo* : </label>
                    <div class="col-md-3">
                        <span class="help-block" id="modelo"></span>
                        <input type="text" class="mayusculas" name="modelo_input" id="modelo_input">
                        <span class="help-block"></span>
                    </div>
                    <label class="control-label col-md-3">Serie: </label>
                    <div class="col-md-3">
                        <span class="help-block" id="serie"></span>
                        <input type="text" class="mayusculas" name="serie_input" id="serie_input">
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

<?php $this->stop()?>
<?php $this->start('extra_js')?>
<script src="<?php echo base_url('assets/js/conectividad.js');?>"></script>
<?php $this->stop()?>

