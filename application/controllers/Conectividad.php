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
		if($statusServicio == 1){
			$data = $this->conectividad_model->getListConectividad();
			$bandera = 1;

			$dataFiltrado = array();
			$arrayTemporalProgramas = array();
			$arrayTemporalProveedores = array();

			for($i=0; $i<count($data); $i++){
			   if($i == 0){
					array_push($arrayTemporalProgramas, $data[$i]['programa']);
					$data[$i]['programas'] = $arrayTemporalProgramas;
					$arrayTemporalProgramas = [];
					array_push($arrayTemporalProveedores, $data[$i]['nombreProveedor']);
					$data[$i]['proveedores'] = $arrayTemporalProveedores;
					$arrayTemporalProveedores = [];
					array_push($dataFiltrado, $data[$i]);
				}else{
					$posicion = $this->buscarCentro($dataFiltrado, $data[$i]['idConectividad']);
					if($posicion >= 0){
						array_push($dataFiltrado[$posicion]['programas'], $data[$i]['programa']);
						array_push($dataFiltrado[$posicion]['proveedores'], $data[$i]['nombreProveedor']);
					}
					else{
						array_push($arrayTemporalProgramas, $data[$i]['programa']);
						$data[$i]['programas'] = $arrayTemporalProgramas;
						$arrayTemporalProgramas = [];
						array_push($arrayTemporalProveedores, $data[$i]['nombreProveedor']);
						$data[$i]['proveedores'] = $arrayTemporalProveedores;
						$arrayTemporalProveedores = [];
						array_push($dataFiltrado, $data[$i]);
					}
				}  		   
			}

		}
		if($statusServicio == 2){
			$dataFiltrado = $this->conectividad_model->getListaSinConexion();
			$bandera = 2;
		}
		if($statusServicio == 3){
			$dataFiltrado = $this->conectividad_model->getListaConSinConexion();
		    $bandera = 3;
		}
		echo json_encode(array("bandera" => $bandera, "lista" => $dataFiltrado)); 
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
		$data['nivelCT'] = $this->catalogos_model->getListaNivelCT();
		$data['programas'] = $this->catalogos_model->getListaCatalogoProgramas();
		$data['proveedores'] = $this->catalogos_model->getListaCatalogoProveedores();
		$data['localidad'] = $this->catalogos_model->getListaLocalidades();
		echo json_encode($data);
	}

	public function filtrarDatos(){
    	
    	$idsModalidad = array();
    	$idsMunicipio = array();
    	$idsNivelEducativo = array();
    	$idsNivelCT = array();
    	$idsTurno = array();
    	$idsProveedores = array();
		$idsProgramas = array();
		$localidades = array();
		$opcionConectividad = $_POST['opcionConectividad'];

    	if(isset($_POST['filtrosMod'])){
    		$modalidad = $_POST['filtrosMod'];
    		foreach ($modalidad as $mod) {
    			array_push($idsModalidad, $mod['idModalidad']);
    		}
    	}
    	if(isset($_POST['filtrosMunicipio'])){
    		$municipio = $_POST['filtrosMunicipio'];
    		foreach ($municipio as $mun) {
    			array_push($idsMunicipio, $mun['idMunicipio']);
    		}
    	}

    	if(isset($_POST['filtrosLocalidad'])){
    		$localidadesList = $_POST['filtrosLocalidad'];
    		foreach ($localidadesList as $localidad) {
    			array_push($localidades, $localidad['localidad']);
    		}
    	}

    	if(isset($_POST['filtrosNivelEduc'])){
    		$nivelEducativo = $_POST['filtrosNivelEduc'];
    		foreach ($nivelEducativo as $nivel) {
    			array_push($idsNivelEducativo, $nivel['idNivelEducativo']);
    		}
    	}

    	if(isset($_POST['filtrosNivelCT'])){
    		$nivelCT = $_POST['filtrosNivelCT'];
    		foreach ($nivelCT as $nivelct) {
    			array_push($idsNivelCT, $nivelct['idNivelCT']);
    		}
    	}

    	if(isset($_POST['filtrosTurno'])){
    		$dataTurno = $_POST['filtrosTurno'];
    		foreach ($dataTurno as $turno) {
    			array_push($idsTurno, $turno['idTurno']);
    		}
    	}

    	if(isset($_POST['filtrosProgramas'])){
    		$dataProgramas = $_POST['filtrosProgramas'];
    		foreach ($dataProgramas as $programa) {
    			array_push($idsProgramas, $programa['idCatPrograma']);
    		}
    	}

    	if(isset($_POST['filtrosProveedores'])){
    		$dataProveedores = $_POST['filtrosProveedores'];
    		foreach ($dataProveedores as $proveedores) {
    			array_push($idsProveedores, $proveedores['idCatProveedor']);
    		}
    	}

		$dataResultado = array();

		if($opcionConectividad == 1){
			$data = $this->conectividad_model->getListConectividadFiltros($idsModalidad, $idsMunicipio, $idsNivelEducativo, $idsNivelCT, $idsTurno, $idsProgramas, $idsProveedores, $localidades);

			$dataFiltrado = array();
			$arrayTemporalProgramas = array();
			$arrayTemporalProveedores = array();

			for($i=0; $i<count($data); $i++){
			   if($i == 0){
					array_push($arrayTemporalProgramas, $data[$i]['programa']);
					$data[$i]['programas'] = $arrayTemporalProgramas;
					$arrayTemporalProgramas = [];
					array_push($arrayTemporalProveedores, $data[$i]['nombreProveedor']);
					$data[$i]['proveedores'] = $arrayTemporalProveedores;
					$arrayTemporalProveedores = [];
					array_push($dataFiltrado, $data[$i]);
				}else{
					$posicion = $this->buscarCentro($dataFiltrado, $data[$i]['idConectividad']);
					if($posicion >= 0){
						array_push($dataFiltrado[$posicion]['programas'], $data[$i]['programa']);
						array_push($dataFiltrado[$posicion]['proveedores'], $data[$i]['nombreProveedor']);
					}
					else{
						array_push($arrayTemporalProgramas, $data[$i]['programa']);
						$data[$i]['programas'] = $arrayTemporalProgramas;
						$arrayTemporalProgramas = [];
						array_push($arrayTemporalProveedores, $data[$i]['nombreProveedor']);
						$data[$i]['proveedores'] = $arrayTemporalProveedores;
						$arrayTemporalProveedores = [];
						array_push($dataFiltrado, $data[$i]);
					}
				}  		   
			}
		}

		if($opcionConectividad == 2 || $opcionConectividad == 3){
			$data = $this->conectividad_model->getListConectividadFiltrosConSinConexion($idsModalidad, $idsMunicipio, $idsNivelEducativo, $idsNivelCT, $idsTurno, $opcionConectividad, $localidades);
		}
		
		echo json_encode($dataFiltrado);
	}

	function buscarCentro($dataFiltrado, $idCentro){
		$posicion = -1;
		for ($i=0; $i<count($dataFiltrado); $i++) {
			if($dataFiltrado[$i]['idConectividad'] == $idCentro){
				$posicion = $i;
				break;
			}
		}

		return $posicion;
	}

	public function getCatalogo(){
		$catalogo = $_POST['catalogo'];
		echo json_encode($this->catalogos_model->getCatalogo($catalogo));
	}	

}

?>