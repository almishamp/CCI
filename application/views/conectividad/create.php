
<section class="content-header">
    <h1>
      Agregar Centro
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
                  <br><br>
                  
                <div class="box-body">
                    <form class="form-horizontal">
                    	<div class="form-group">
		                    <label class="control-label col-md-3">Ingresa Clave CT: </label>
	                        <div class="col-md-3">
	                                <input id="claveCT_buscar" placeholder="Clave CT" class="form-control" type="text">
	                                <span class="help-block"></span>
	                        </div>
	                        <div class="col-md-6">
	                                <button type="button" class="btn btn-info" onclick="buscarCentro()">
						         		Buscar
						    		</button>
	                        </div>
		                </div>
                    </form>
	                <form action="#" id="form_create_edit" class="form-horizontal" style="display: none">
	                    <div class="form-body">
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Clave CT: </label>
	                            <div class="col-md-3">
	                                <span class="help-block" id="claveCT"></span>
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
	                                <span class="help-block" id="municipio" name="municipio"></span>
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
	                                <input name="latitud" placeholder="Latitud" class="form-control" type="text">
	                                <span class="help-block"></span>
	                            </div>
	                            <label class="control-label col-md-3">Longitud:</label>
	                            <div class="col-md-3">
	                                <input name="longitud" placeholder="Longitud" class="form-control" type="text">
	                                <span class="help-block"></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Responsable sitio</label>
	                            <div class="col-md-6">
	                                <input name="respSitio" placeholder="Responsable sitio" class="form-control" type="text">
	                                <span class="help-block"></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Responsable Inventario</label>
	                            <div class="col-md-6">
	                                <input name="respInventario" placeholder="Responsable Inventario" class="form-control" type="text">
	                                <span class="help-block"></span>
	                            </div>
	                        </div>

	                    </div>
	                    <div class="form-footer">
	                    	<div class="col-md-12">
	                            <div class="col-md-12">

	                            <div>
	                            <div class="col-md-12">
		                            <div class="col-md-10">
		                            	
		                            </div>
		                            <div class="col-md-2">
		                            	<button type="button" id="btnSave" onclick="guardarCentro()" class="btn btn-success">Agregar nuevo centro</button>
		                                <span class="help-block"></span>
		                            </div>  
	                            </div>
	                        </div>
	                     </div>

                	</form>


	                <br><br><br>
	                	
                    
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
		   	 
		   	 El centro con Clave CCT: &nbsp;&nbsp;&nbsp;<strong><span id="claveCT1"></span></strong>&nbsp;&nbsp;&nbsp;   ya se encuentra agreado y tiene un estatus de &nbsp;&nbsp;&nbsp;
		   	 <strong><span id="statusC"></span></strong>.
		   	 
		  </div>
		  <div class="modal-footer">
		    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
		    
		  </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
	
	function buscarCentro(){
		//alert($('#claveCT_buscar').val());
		  $.ajax({
	        url : "<?php echo site_url('conectividad/ajax_buscarConectividad/')?>" + $('#claveCT_buscar').val(),
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	            if(data[0]){
	            	$('#claveCT1').html(data[0].claveCT);

	            	if(data[0].statusServicio === 1)
	            		$('#statusC').html('Conectado');
	            	else 
	            		$('#statusC').html('No Conectado');

	            	$('#modal_showProveedor').modal('show');
	            	
	            }else{

	            	 $('#claveCT').html(data[1].CLAVECCT);
	            	 $('#nombreCT').html(data[1].NOMBRECT);
	            	 $('#colonia').html(data[1].NOMBRECOL);
	            	 $('#municipio').html(data[1].NOMBREMUN);
	            	 $('#colonia').html(data[1].NOMBRECOL);
	            	 $('#localidad').html(data[1].NOMBRELOC);
	            	 $('#turno').html(data[1].TUR_DES);
	            	 $('#nivelEducativo').html(data[1].SER_DES);
	            	 $('#modalidad').html(data[1].SOS_DES);

	            	 $('#form_create_edit').css("display", "block");

	            }
	            
	     
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }  
	    }); 
	}


	function guardarCentro()
	{
		var valoresForm = $('#form_create_edit').serialize() + "&municipio=" + $('#municipio').html() +"&claveCT=" + $('#claveCT').html() + "&nombreCT=" + $('#nombreCT').html()+ "&localidad=" + $('#localidad').html()  + "&colonia=" + $('#colonia').html()+ "&nivelEducativo=" + $('#nivelEducativo').html()  + "&turno=" + $('#turno').html()+ "&modalidad=" + $('#modalidad').html()  + "&latitud=" + $('#latitud').html()+"&longitud=" + $('#longitud').html()  + "&respSitio=" + $('#respSitio').html() +"&respInventario=" + $('#respInventario').html();

	    $.ajax({
	        url : "<?php echo site_url('conectividad/agregarCentro/')?>",
	        type: "POST",
	        data: valoresForm,
	        dataType: "JSON",
	        success: function(data)
	        {
	 
	           if(data.status) //if success close modal and reload ajax table
	            {

	            	alert (data.arreglo.idMunicipio);	
	     /*          $('#modal_form').modal('hide');
	                reload_table();   */
	            }
	            else
	            {
	       /*         for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }    */
	            }
	     //       $('#btnSave').text('save'); //change button text
	     //       $('#btnSave').attr('disabled',false); //set button enable 
	 
	
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable   
	 
	        }
	    });  
	}
 



</script>