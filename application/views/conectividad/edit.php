<section class="content-header">
    <h1>
      Edición Conectividad
    </h1>
    <ol class="breadcrumb">
       <div>
	      <button type="button" class="btn-primary btn-lg" onclick="history.back()">
	        <span class="glyphicon glyphicon-circle-arrow-left" widht="30" height="30"></span> 
	      </button>
</button>
      </div>
    </ol>
    </br><br>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div>
                <div class="box-body" class="detalle_conectividad">

	                <form action="#" id="form_show" class="form-horizontal">
	                    <div class="form-body">
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Clave CT: </label>
	                            <div class="col-md-3">
	                                <span><?php echo $conectividad['claveCT']; ?></span>
	                            </div>
	                            <label class="control-label col-md-3">Status: </label>
	                            <div class="col-md-3">
	                                <span>
	                                	<?php if($conectividad['statusServicio'] === 1)
	                                     echo '<button class="btn btn-xs btn-success">Conectado</button>';
	                                 else
	                                     echo '<button class="btn btn-xs btn-danger ">No Conectado</button>' ?>	
	                                </span>

	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="control-label col-md-3">Nombre CT: </label>
	                            <div class="col-md-6">
	                                <span><?php echo $conectividad['nombreCT']; ?></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Municipio: </label>
	                            <div class="col-md-3">
	                                <span><?php echo $conectividad['municipio']; ?>	</span>
	                            </div>
	                            <label class="control-label col-md-3">Localidad: </label>
	                            <div class="col-md-3">
	                                <span><?php echo $conectividad['localidad']; ?>	</span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Colonia: </label>
	                            <div class="col-md-3">
	                                <span><?php echo $conectividad['colonia']; ?></span>
	                            </div>
	                            <label class="control-label col-md-3">Nivel Educativo:</label>
	                            <div class="col-md-3">
	                                <span><?php echo $conectividad['nivelEducativo']; ?></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Turno</label>
	                            <div class="col-md-3">
	                                <span><?php echo $conectividad['turno']; ?>	</span>
	                            </div>
	                            <label class="control-label col-md-3">Modalidad:</label>
	                            <div class="col-md-3">
	                                <span><?php echo $conectividad['modalidad']; ?></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Latitud: </label>
	                            <div class="col-md-3">
	                                <span"><?php echo $conectividad['latitud']; ?></span>
	                            </div>
	                            
	                            <label class="control-label col-md-3">Longitud:</label>
	                            <div class="col-md-3">
	                                <span><?php echo $conectividad['longitud']; ?></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Responsable sitio: </label>
	                            <div class="col-md-6">
	                                <input value="<?php echo $conectividad['nombreRespSitio']; ?>" size="50" placeholder="Nombre Responsable Sitio"></input>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Responsable Inventario: </label>
	                            <div class="col-md-6">
	                                <input value="<?php echo $conectividad['nombreRespInventario']; ?>" size="50" placeholder="Nombre Responsable Inventario"></input>
	                            </div>
	                        </div>
	                    </div>
	                    
	                    <span id="idConectividad" name="idConectividad" style="display:none"><?php echo $conectividad['idConectividad']; ?></span>
                	</form>

                	<div class="form-group">
                        <div class="form-footer">
	                    	<div class="col-md-12">
	                            <div class="col-md-12">

	                            <div>
	                            <div class="col-md-12">
	                            	<div class="col-md-2">
		                            	<button type="button" class="btn btn-success" onclick="mostrarModal('crear')">
							                Agregar programa
							            </button>
		                            </div>  
		                            <div class="col-md-10">
		                            	
		                            </div>
		                            
	                            </div>
	                        </div>
	                     </div>
	                </div>

	                <?php if($programas){ ?>
	                	<div class="col-sm-12">
		                	<br><br><br>                	
		                	<table class="table table-bordered">
		                		<thead>
		                			<tr>
					                  <th style="width: 10px">Programa</th>
					                  <th style="width: 40px">GID</th>
					                  <th style="width: 40px">VSATID</th>
					                  <th style="width: 40px">Tipo Programa</th>
					                  <th style="width: 40px">Proveedor</th>
					                  <th style="width: 40px">Acciones</th>
	                				</tr>
	                			</thead>
	                			</tbody>
	                			    <?php 
	                			    	foreach ($programas as $programa) {
	                			    ?>
					                <tr>
					                  <td><?php echo $programa['programa']; ?></td>
					                  <td><?php if($programa['gid'])
					                  				echo $programa['gid'];
					                  			else 
					                  				echo 'N/A'
					                  		?></td>
					                  <td><?php if($programa['vsatid'])
					                  				echo $programa['vsatid']; 
					                  			else 
					                  				echo 'N/A'
					                  	    ?></td>
					                  <td><?php echo $programa['tipoprograma']; ?></td>
					                  <td><?php echo $programa['proveedor']; ?></td>
					                  <td>
					                  	<a class="btn btn-xs btn-success" href = "<?php echo base_url() . 'programa/show/' . $programa['idPrograma']?>" style="font-weight: bold">Detalle</a>
					                  	<a class="btn btn-xs btn-info" href = "<?php echo base_url() . 'programa/show/' . $programa['idPrograma']?>" style="font-weight: bold">Edición</a>
					                  </td>
					                  
					                </tr>
					                <?php 
					                }
					                ?>
					            </tbody>
	                		</table>
						</div>
	                <?php 
	                 }
	                 if($articulos){ ?>	
		                <div class="col-sm-12">
		                <br><br><br>
		                
		                	<table class="table table-bordered">
		                		<thead>
		                			<tr>
					                  <th style="width: 10px">Descripción</th>
					                  <th style="width: 40px">Marca</th>
					                  <th style="width: 40px">Modelo</th>
					                  <th style="width: 40px">Serie</th>
					                  <th style="width: 40px">Estatus</th>
					                  <th style="width: 40px">Acciones</th>
	                				</tr>
	                			</thead>
	                			</tbody>
	                			    <?php 
	                			    	foreach ($articulos as $articulo) {
	                			    ?>
					                <tr>
					                  <td><?php echo $articulo['descripcion']; ?></td>
					                  <td><?php echo $articulo['marca']; ?></td>
					                  <td><?php echo $articulo['modelo']; ?></td>
					                  <td><?php echo $articulo['serie']; ?></td>
					                  <td><?php echo $articulo['estatus']; ?></td>
					                  
					                </tr>
					                <?php 
					                }
					                ?>
					            </tbody>
	                		</table>
		                </div>
	                <?php 
	                		}
	                ?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->  
    </div>
    <!-- /.row -->
</section>

<div class="modal modal-default fade" id="modal_programa">
	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		      <span aria-hidden="true">&times;</span></button>
		    <h4 class="modal-title">Nuevo Programa</h4>
		  </div>

		  <div class="modal-body">
		   	 <form action="#" id="form_programa_add" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                    	<div class="form-group" id="select_programa">
                            <label class="control-label col-md-3">Programa: </label>
                            <div class="col-md-9">
                                <select id="programa" name="programa" class="form-control" onchange="mostrarElementos()">
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="div_gid" style="display: none;">
                            <label class="control-label col-md-3">GID: </label>
                            <div class="col-md-9">
                                <input name="gid" id="gid" placeholder="GID" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="div_vsatid" style="display: none;">
                            <label class="control-label col-md-3">VSATID: </label>
                            <div class="col-md-9">
                                <input name="vsatid" id="vsatid" placeholder="VSATID" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">IP Modem: </label>
                            <div class="col-md-9">
                                <input name="ipModem" id="ipModem" placeholder="IP Modem" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">IP Telefonía: </label>
                            <div class="col-md-9">
                                <input name="ipTelefonia" id="ipTelefonia" placeholder="IP Telefonía" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Proveedor: </label>
                            <div class="col-md-9">
                                <select id="proveedor" name="proveedor" class="form-control">
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                        	<div class="col-sm-12">
		                	<br><br><br>                	
						</div>
                        </div>
                    </div>
                </form>
		   	 
		   	 
		  </div>
		  <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="limpiarFormModal()">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarPrograma()">Guardar</button>
          </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


<script type="text/javascript">

	function limpiarFormModal(){
		$('#form_programa_add')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('select').empty();

	}

	function mostrarModal(opcion){
		//alert($('#claveCT_buscar').val());
		if(opcion == "edición"){

			$.ajax({
				url : "<?php echo site_url('conectividad/ajax_buscarConectividad/')?>" + $('#claveCT_buscar').val(),
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
			        {
			            
			            
			     
			        },
			        error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error get data from ajax');
			        } 
	         
	    	}); 

		}else{



			$.ajax({
				url : "<?php echo site_url('programa/getListasCatalogos/')?>",
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
			        {
						        	
		                for(var i=0;i<data['programas'].length;i++)
		                {
		                    $("<option />").val(data['programas'][i].idCatPrograma)
		                                   .text(data['programas'][i].nombre)
		                                   .appendTo($('select#programa'));
		                }  

		                for(var i=0;i<data['proveedores'].length;i++)
		                {
		                    $("<option />").val(data['proveedores'][i].idCatProveedor)
		                                   .text(data['proveedores'][i].nombre)
		                                   .appendTo($('select#proveedor'));
		                }  
			            
			           $('#modal_programa').modal('show');  


			     
			        }, 
			        error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error get data from ajax');
			        } 
	         
	    	});


		

		}
		  
	}

	function guardarPrograma(){

		var valoresForm = $('#form_programa_add').serialize() + "&idConectividad=" + $('#idConectividad').html() + "&idCatPrograma=" + $( "#programa option:selected" ).val() + "&idCatProveedor=" + $( "#proveedor option:selected" ).val() ;
			alert(valoresForm);
		$.ajax({
	        url : "<?php echo site_url('programa/guardarPrograma/')?>",
	        type: "POST",
	        data: valoresForm,
	        dataType: "JSON",
	        success: function(data)
	        {
	 		//	$('#modal_programa').modal('hidden'); 
	 		if(data.status === true){
	 			$('#modal_programa').modal('hide');
	 			recargarPagina();
 

	 		}else{
	 			
	 		    for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                } 
	 		}
	 			
	
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data'); 
	 
	        }
	    });   
	}

	function recargarPagina(){
		alert("entra");
	    $.ajax({
	        url : "<?php echo site_url('conectividad/edit/')?>",
	        type: "POST"
	    });
	}


</script>