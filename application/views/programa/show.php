
<section class="content-header">
    <h1>
      Detalle Programa
    </h1>
    <ol class="breadcrumb">
      <div>

	      <button type="button" class="btn-primary btn-lg" onclick="history.back()">
	        <span class="glyphicon glyphicon-circle-arrow-left"></span> 
	      </button>

      </div>
    </ol>
    <br>	
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                	<form action="#" id="form_show" class="form-horizontal">
	                    <div class="form-body">
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Clave CT: </label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $conectividad['claveCT']; ?></span>
	                            </div>
	                            <label class="control-label col-md-3">Status: </label>
	                            <div class="col-md-3">
	                                <span class="help-block">
	                                	<?php if($conectividad['statusServicio'] === 1)
	                                     echo '<button class="btn btn-xs btn-success">Conectado</button>';
	                                 else
	                                     echo '<button class="btn btn-xs btn-danger ">No Conectado</button>' ?>	
	                                </span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Programa: </label>
	                            <div class="col-md-6">
	                                <span class="help-block"><?php echo $programa['programa']; ?></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Tipo Programa: </label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $programa['tipoprograma']; ?></span>
	                            </div>
	                        </div>
							<div class="form-group">
	                            <label class="control-label col-md-3">Ip Modem: </label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $programa['ipModem']; ?></span>
	                            </div>
	                            <label class="control-label col-md-3">IP Telefonía: </label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $programa['ipTelefonia']; ?></span>
	                            </div>
	                        </div>
	                    </div>
	                </form>
                	
                    <div class="col-sm-12">
                    <div class="col-sm-2">
                    
                    </div>
                    <div class="col-sm-8">
	                <br><br><br>
	                	<table class="table table-bordered">
	                		<thead>
	                			<tr>
				                  <th style="width: 10px">Proveedor</th>
				                  <th style="width: 40px">Acciones</th>
                				</tr>
                			</thead>
                			</tbody>
                			    <?php 
                			    	foreach ($listaProveedores as $proveedor) {
                			    ?>
				                <tr>
				                  <td><?php echo $proveedor['nombreProveedor']; ?></td>
				                  <td>
								      <button type="button" class="btn btn-info" data-toggle="modal" onclick="show_proveedor('<?php echo $proveedor['idProveedor']?>')">
						                Detalle proveedor
						              </button>
				                  </td>
				                  
				                </tr>
				                <?php 
				                }
				                ?>
				            </tbody>
                		</table>
                    <div class="col-sm-2">
                    
                    </div>
                    </div>
	                
	                </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->  
    </div>
    <!-- /.row -->
</section>


<div class="modal modal-info fade" id="modal_showProveedor">
	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		      <span aria-hidden="true">&times;</span></button>
		    <h4 class="modal-title">Detalle proveedor</h4>
		  </div>

		  <div class="modal-body">
		   	 
		   	    <form action="#" id="form_showP" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Programa: </label>
                            <div class="col-md-6">
                                <span class="help-block" id="programa"></span>
                            </div>
                            <label class="control-label col-md-3">Tipo Programa: </label>
                            <div class="col-md-6">
                                <span class="help-block" id="tipoPrograma"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">GID: </label>
                            <div class="col-md-3">
                                <span class="help-block" id="gid"></span>
                            </div>
                            <label class="control-label col-md-3">VSATID: </label>
                            <div class="col-md-3">
                                <span class="help-block" id="vsatid"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Ip Modem: </label>
                            <div class="col-md-3">
                                <span class="help-block" id="ipModem"></span>
                            </div>
                            <label class="control-label col-md-3">IP Telefonía: </label>
                            <div class="col-md-3">
                                <span class="help-block" id="ipTelefonia"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Status: </label>
                            <div class="col-md-3">
                                <span class="help-block" id="statusPrograma"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
              
                    </div>
	            </form>        
		  </div>
		  <div class="modal-footer">
		  <br><br>
		    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
		    
		  </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
	
	function show_proveedor(id){
	  $.ajax({
        url : "<?php echo site_url('programa/ajax_showProveedor/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('#descripcion').html(data.proveedor);
            $('#nomContacto').html(data.nombreContacto);
            $('#telContacto').html(data.telefonoContacto);
            $('#modal_showProveedor').modal('show'); // show bootstrap modal when complete loaded 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    }); 
}

</script>