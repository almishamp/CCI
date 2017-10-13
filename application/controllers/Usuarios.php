<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends Main_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->library('form_validation');

	}

	public function login(){
		echo $this->templates->render('usuarios/login');
	}


	public function nuevoRegistro($idProveedor){
		echo $this->templates->render('usuarios/registrarse');
	}

/*
	public function getListasCatalogos(){
		$programas = $this->catalogos_model->getListaCatalogoProgramas();
		$proveedores = $this->catalogos_model->getListaCatalogoProveedores();
		echo json_encode(array("proveedores" => $proveedores, "programas" => $programas)); 
	}

	public function nuevo(){
		$this->validarPrograma($_POST['idCatPrograma'], $_POST['idCatProveedor'], $_POST['ipModem'], $_POST['ipTelefonia'], $_POST['status']);
		if($_POST['idCatPrograma'] < 5){
			$gid = null;
			$vsatid = null;
		}
		else{
			$gid = $_POST['gid'];
			$vsatid = $_POST['vsatid'];
		}
		$dataPrograma = array('idCatPrograma' => $_POST['idCatPrograma'],
						'idConectividad' => $_POST['idConectividad'],
						'gid' => $gid,
						'vsatid' => $vsatid,
						'ipModem' => $_POST['ipModem'] ,
						'ipTelefonia' => $_POST['ipTelefonia'],
						'idCatTipoPrograma' => $_POST['idTipoPrograma'],
						'idCatProveedor' => $_POST['idCatProveedor'],
						'status' => 1
						);
	
		$idPrograma = $this->programa_model->savePrograma($dataPrograma);

		if($idPrograma){
			$idConectividad = $_POST['idConectividad'];
			$programas = $this->conectividad_model->getProgramas($idConectividad);
			foreach ($programas as $programa) {
				if($programa['status'] == 1){
					$data = array('statusServicio' => $programa['status']);
					$fila_afectada = $this->conectividad_model->updateConectividad($data, $idConectividad);
					if($fila_afectada)
					  break;
				}
			}
			$status = TRUE;
			$msj = 'Programa guardado con exito';
		}else{
			$status = FALSE;
			$msj = 'ERROR al guardar programa';
		} 

		echo json_encode(array("status" => $status, "msj"=> $msj, "programas" => $programas)); 
	}

	public function edicion(){
		$catPrograma = $this->catalogos_model->getProgramaCat($_POST['programa']);

		$this->validarPrograma($catPrograma['idCatPrograma'], $_POST['idCatProveedor'], $_POST['ipModem'], $_POST['ipTelefonia'], $_POST['status']);

		if($_POST['gid'] == '')
			$gid = null;
		else
			$gid = $_POST['gid'];

		if($_POST['vsatid'] == '')
			$vsatid = null;
		else
			$vsatid = $_POST['vsatid'];


		$dataPrograma = array('GID' => $gid,
						'VSATID' => $vsatid,
						'ipModem' => $_POST['ipModem'],
						'ipTelefonia' => $_POST['ipTelefonia'],
						'status' => $_POST['status'],
						'idCatProveedor' => $_POST['idCatProveedor']
						);

		$idPrograma = $_POST['idPrograma'];
		$filas_afectadas = $this->programa_model->updatePrograma($dataPrograma, $idPrograma);		

		if($filas_afectadas){
			$idConectividad = $_POST['idConectividad'];
			$programas = $this->conectividad_model->getProgramas($idConectividad);

			foreach ($programas as $programa) {
				if($programa['status'] == 1){
					$data = array('statusServicio' => $programa['status']);
					$fila_afectada = $this->conectividad_model->updateConectividad($data, $idConectividad);
					if($fila_afectada)
					  break;
				}
			}

			$status = TRUE;
			$msj = 'ACTUALIZACIÓN REALIZADA CON EXITO';
		}else{
			$status = FALSE;
			$msj = 'ERROR AL ACTUALIZAR DATOS';
		}

	    echo json_encode(array("status" => $status, "msj"=> $msj, "programas" => $programas));
	}

	private function validarPrograma($idPrograma, $idCatProveedor, $ipModem, $ipTelefonia, $status){

		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

		if(!$idPrograma)
        {
            $data['inputerror'][] = 'select_programas';
            $data['error_string'][] = 'Por favor eliga un programa';
            $data['status'] = FALSE;
        }

        if(!$idCatProveedor)
        {
            $data['inputerror'][] = 'proveedor';
            $data['error_string'][] = 'Por favor eliga un provedor';
            $data['status'] = FALSE;
        }

        if($ipModem != null){

        	if (!filter_var($ipModem, FILTER_VALIDATE_IP)) {
			    $data['inputerror'][] = 'ipModem_input';
	            $data['error_string'][] = 'Por favor agregue una ip con el formato correspondiente';
	            $data['status'] = FALSE;
			} 
       		
        }

        if($ipTelefonia != null){

        	if (!filter_var($ipTelefonia, FILTER_VALIDATE_IP)) {
			    $data['inputerror'][] = 'ipTelefonia_input';
	            $data['error_string'][] = 'Por favor agregue una ip con el formato correspondiente';
	            $data['status'] = FALSE;
			} 
       		
        }
		
       if($data['status'] === FALSE){ 
            echo json_encode($data);
            exit();
       }

    } */

}