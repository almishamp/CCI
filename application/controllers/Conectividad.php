<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conectividad extends Main_Controller {

	private $idConectividad;

	public function __construct(){

		parent::__construct();
		$this->load->model('conectividad_model');
		$this->load->model('catalogos_model');
	}

	
	public function home(){
		echo $this->templates->render('conectividad/index');
	}

	public function getListaConectividad(){
		$statusServicio = $_POST['statusServicio'];
		echo json_encode($this->conectividad_model->getListConectividad($statusServicio));
	}

	public function getListaProgramas(){
		$idConectividad = $_POST['idConectividad'];
		echo json_encode($this->conectividad_model->getProgramas($idConectividad));
	}


	public function show(){
		$idConectividad = $_POST['idConectividad'];
		$data['conectividad'] = $this->conectividad_model->getCentro($idConectividad);
		$data['programas'] = $this->conectividad_model->getProgramas($idConectividad);
		$data['articulos'] = $this->conectividad_model->getArticulos($idConectividad);
		echo json_encode($data);
	}

	public function editar(){
		$data = array('nombreRespSitio' => $_POST['respSitio'],
					  'nombreRespInventario' => $_POST['respInventario']);
		$idConectividad = $_POST['idConectividad'];
		$conectividad_response = $this->conectividad_model->updateConectividad($data, $idConectividad);
		$conectividad = $this->conectividad_model->getCentro($idConectividad);
		if($conectividad['nombreRespSitio'] == $_POST['respSitio'] OR $conectividad['nombreRespInventario'] == $_POST['respInventario']){
			$status = TRUE;
			$msj = 'ACTUALIZACIÓN REALIZADA CON EXITO';
		}else{
			$status = FALSE;
			$msj = 'ERROR AL ACTUALIZAR DATOS';
		}
		echo json_encode(array("status" => $status, "msj"=> $msj)); 
	}

	public function agregarCentro(){
		$municipioRegion = $this->catalogos_model->getMunicipioByNombre($_POST['municipio']);
		$nivelEducativo = $this->catalogos_model->getNivelEducativoByNombre($_POST['nivelEducativo']);
		$turno = $this->catalogos_model->getTurnoByNombre($_POST['turno']);
		$modalidad = $this->catalogos_model->getModalidadByNombre($_POST['modalidad']);
		$nivelCT = $this->catalogos_model->getNivelCTByNombre(substr ( $_POST['claveCT'] , 2, -5));	
		$data = array(
			    'claveCT' => $_POST['CLAVECCT'],
			    'nombreCT' => $_POST['nombreCT'],
                'idMunicipio' => $municipioRegion['idMunicipio'],
                'idNivelEducativo' => $nivelEducativo['idNivelEducativo'],
                'idTurno' => $turno['idTurno'],
                'idModalidad' => $modalidad['idModalidad'],
                'idNivelCT' => $nivelCT['idNivelCT'],
                'latitud' => $_POST['latitud'],
                'longitud' => $_POST['longitud'],
                'localidad' => $_POST['localidad'],
                'nombreRespSitio' => $_POST['respSitio'],
                'nombreRespInventario' => $_POST['respInventario']
            );
        echo json_encode(array("status" => TRUE, "arreglo" => $data)); 
	}

    //Buscar nueva conectividad para agregar a bd conectividad en SAGA Y/O EN A_CTBA
	public function buscarConectividad(){
	//	$claveCT = '22FUA0044P';  clavecct de ejemplo
	//	$claveCT = '22FUA0044P';
		$claveCT = $_POST['claveCT'];
		$conectividad = $this->conectividad_model->getCentroByClave($claveCT);
		if($conectividad){
			$bandera = 1;
			if($conectividad['statusServicio'] == 1){
				$status = "Conectado";
			}else{
				$status = "No conectado";
			}
			$msj = "Este clave ya se encuentra agregada con un estatus de " . $status;
		}else{
		    $conectividad = $this->conectividad_model->getCentroByClaveCTCTBA($claveCT);
			if($conectividad){
				$bandera = 2;
				$msj = "Clave encontrada";
			}else{
				$conectividad = NULL;
				$bandera = 3;
				$msj="Clave no encontrada";
			}
		} 
		echo json_encode(array("bandera" => $bandera, "msj"=> $msj, "conectividad" => $conectividad)); 
	}

	public function getCatalogos(){
		$data['municipios'] = $this->catalogos_model->getListaMunicipios();
		$data['modalidad'] = $this->catalogos_model->getListaModalidad();
		$data['nivelEducativo'] = $this->catalogos_model->getListaNivelEducativo();
		$data['turno'] = $this->catalogos_model->getListaTurno();

		echo json_encode($data);
	}

	public function filtrar(){
    	$modalidad = $_POST['dataFiltro'];
    	

		//if(count($modalidad) > 0){
		//   print_r($_POST['dataMod']);
			
		//}
		$dataResultado = array();
		$data = $this->conectividad_model->getListConectividadFiltros();
		foreach ($data as $conectividad) {

			if(count($modalidad) <8 AND count($modalidad) > 0){
				foreach ($modalidad as $mod) {
					if($mod['idModalidad'] == $conectividad['idModalidad'])
						array_push($dataResultado, $conectividad);
				}
			}
			
		}
		//print_r(count($dataResultado));
		echo json_encode($dataResultado);
	}

	public function getCatalogo(){
		$catalogo = $_POST['catalogo'];
		echo json_encode($this->catalogos_model->getCatalogo($catalogo));
	}

	

}

?>