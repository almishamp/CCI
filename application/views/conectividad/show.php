<section class="content-header">
    <h1>
      Detalle Conectividad
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
	                            <label class="control-label col-md-3">Nombre CT: </label>
	                            <div class="col-md-6">
	                                <span class="help-block"><?php echo $conectividad['nombreCT']; ?></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Municipio: </label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $conectividad['municipio']; ?>	</span>
	                            </div>
	                            <label class="control-label col-md-3">Localidad: </label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $conectividad['localidad']; ?>	</span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Colonia: </label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $conectividad['colonia']; ?></span>
	                            </div>
	                            <label class="control-label col-md-3">Nivel Educativo:</label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $conectividad['nivelEducativo']; ?></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Turno</label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $conectividad['turno']; ?>	</span>
	                            </div>
	                            <label class="control-label col-md-3">Modalidad:</label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $conectividad['modalidad']; ?></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Latitud: </label>
	                            <div class="col-md-3">
	                                <span class="help-block"><div class="col-md-3">
	                                <span class="help-block"><?php echo $conectividad['latitud']; ?></span>
	                            </div></span>
	                            </div>
	                            <label class="control-label col-md-3">Longitud:</label>
	                            <div class="col-md-3">
	                                <span class="help-block"><?php echo $conectividad['longitud']; ?></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Responsable sitio</label>
	                            <div class="col-md-6">
	                                <span class="help-block"><?php echo $conectividad['nombreRespSitio']; ?></span>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="control-label col-md-3">Responsable Inventario</label>
	                            <div class="col-md-6">
	                                <span class="help-block"><?php echo $conectividad['nombreRespInventario']; ?></span>
	                            </div>
	                        </div>
	                    </div>
                	</form>

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
