<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos extends Main_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model('catalogos_model');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');

	}

	public function listProgramas(){
		if ($this->session->userdata() && $this->session->userdata('logueado') == true) {
			echo $this->templates->render('catalogos/programas');
		} else{
			echo $this->templates->render('usuario/login');
		}
	}

	public function listProveedores(){
		if ($this->session->userdata() && $this->session->userdata('logueado') == true) {
			echo $this->templates->render('catalogos/proveedores');
		} else{
			echo $this->templates->render('usuario/login');
		}
	}

	public function showPrograma(){
		$idCatPrograma = $_POST['idCatPrograma'];
		echo json_encode($this->catalogos_model->getPrograma($idCatPrograma));
	}

	public function showProveedor(){
		$idCatProveedor = $_POST['idCatProveedor'];
		echo json_encode($this->catalogos_model->getProveedor($idCatProveedor));
	}

	public function getListProgramas(){
		$programas = $this->catalogos_model->getListaCatalogoProgramas();
	    $user = $this->session->userdata();
		echo json_encode(array("programas" => $programas, "user" => $user)); 
	}

	public function getListProveedores(){
		$proveedores = $this->catalogos_model->getListaCatalogoProveedores();
	    $user = $this->session->userdata();
		echo json_encode(array("proveedores" => $proveedores, "user" => $user)); 
	}

	public function getProvedorCAT(){
		$idCatProveedor = $_POST['idCatProveedor'];
		echo json_encode($this->catalogos_model->getProveedorCat($idCatProveedor));
	}

	public function nuevoPrograma(){
       if($_POST['nombre']){
			$dataPrograma = array('nombre' => $_POST['nombre'],
						'status' => $_POST['status']
						);
			$idPrograma = $this->catalogos_model->savePrograma($dataPrograma);
			if($idPrograma){
				$status = 1;
				$msj = 'Programa guardado con exito';
			}else{
				$status = 2;
				$msj = 'ERROR al guardar programa';
			} 
			echo json_encode(array("status" => $status, "msj"=> $msj)); 	
		}
		else{
			$msj = "Agregue un nombre al programa";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
       }


				
	}

	public function editarPrograma(){
		if($_POST['nombre']){
			$dataPrograma = array('nombre' => $_POST['nombre'],
						'status' => $_POST['status']
						);
			$idCatPrograma = $_POST['idCatPrograma'];
			$filas_afectadas = $this->catalogos_model->updatePrograma($dataPrograma, $idCatPrograma);		

			if($filas_afectadas){
				$status = 1;
				$msj = 'Programa guardado con exito';
			}else{
				$status = 2;
				$msj = 'ERROR al guardar programa';
			} 
			echo json_encode(array("status" => $status, "msj"=> $msj)); 
		}
		else{
			$msj = "Agregue un nombre al programa";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
       }		
	}

	public function nuevoProveedor(){

       if($_POST['nombre']){
       		$nombreProveedor = $_POST['nombre'];
       		$proveedorEncontrado = $this->catalogos_model->getProveedorByName($nombreProveedor);
       		if($proveedorEncontrado){
       			$status = 4;
				$msj = 'El proveedor ya se encuentra en el catalogo';
       			echo json_encode(array("status" => $status, "msj"=> $msj)); 
       		}
			else{
				$dataProveedor = array('nombre' => $_POST['nombre'],
								   'nombreContacto' => $_POST['nombreContacto'],
								   'telefonoContacto' => $_POST['telefonoContacto'],
						'status' => $_POST['status'],

						);
				$idCatProveedor = $this->catalogos_model->saveProveedor($dataProveedor);
				if($idCatProveedor){
					$status = 1;
					$msj = 'Proveedor guardado con exito';
				}else{
					$status = 2;
					$msj = 'ERROR al guardar proveedor';
				} 
				echo json_encode(array("status" => $status, "msj"=> $msj)); 
			}	
		}
		else{
			$msj = "Agregue un nombre al proveedor";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
       }			
	}

	public function editarProveedor(){
		if($_POST['nombre']){
			$nombreProveedor = $_POST['nombre'];
       		$proveedorEncontrado = $this->catalogos_model->getProveedorByName($nombreProveedor);
       		if($proveedorEncontrado['idCatProveedor'] != $_POST['idCatProveedor']){
       			$status = 4;
				$msj = 'El proveedor ya se encuentra en el catalogo';
       			echo json_encode(array("status" => $status, "msj"=> $msj)); 
       		}
			else{
				$dataProveedor = array('nombre' => $_POST['nombre'],
									   'nombreContacto' => $_POST['nombreContacto'],
									   'telefonoContacto' => $_POST['telefonoContacto'],
									   'status' => $_POST['status'],
							);
				$idCatProveedor = $_POST['idCatProveedor'];
				$filas_afectadas = $this->catalogos_model->updateProveedor($dataProveedor, $idCatProveedor);		

				if($filas_afectadas){
					$status = 1;
					$msj = 'Proveedor guardado con exito';
				}else{
					$status = 2;
					$msj = 'ERROR al guardar proveedor';
				} 
				echo json_encode(array("status" => $status, "msj"=> $msj)); 
			}	
		}
		else{
			$msj = "Agregue un nombre al proveedor";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
       }		
	}

	

}