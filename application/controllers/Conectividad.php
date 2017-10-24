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
		if ($this->session->userdata() && $this->session->userdata('logueado') == true) {
			echo $this->templates->render('conectividad/index');
		} else{
			redirect('/');
		}
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
		$this->session->set_userdata('conectividad', $dataFiltrado);
		$user = $this->session->userdata();
		echo json_encode(array("bandera" => $bandera, "lista" => $dataFiltrado, "user" => $user)); 
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
		$data['user'] = $this->session->userdata();
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
                'nombreRespInventario' => $_POST['respInventario'],
                'telefonoContacto' => $_POST['telefonoContacto']
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
		if($_POST['opcionConectividad'] == 1){
			$data['localidad'] = $this->catalogos_model->getListaLocalidadesConectados();
		}
		if($_POST['opcionConectividad'] == 2){
			$data['localidad'] = $this->catalogos_model->getListaLocalidadesNoConectados();
		}
		if($_POST['opcionConectividad'] == 3){
			$data['localidad'] = $this->catalogos_model->getListaLocalidades();
		}

		$data['municipios'] = $this->catalogos_model->getListaMunicipios();
		$data['modalidad'] = $this->catalogos_model->getListaModalidad();
		$data['nivelEducativo'] = $this->catalogos_model->getListaNivelEducativo();
		$data['turno'] = $this->catalogos_model->getListaTurno();
		$data['nivelCT'] = $this->catalogos_model->getListaNivelCT();
		$data['programas'] = $this->catalogos_model->getListaCatalogoProgramas();
		$data['proveedores'] = $this->catalogos_model->getListaCatalogoProveedores();
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
			$dataFiltrado = $this->conectividad_model->getListConectividadFiltrosConSinConexion($idsModalidad, $idsMunicipio, $idsNivelEducativo, $idsNivelCT, $idsTurno, $opcionConectividad, $localidades);
		}
		$this->session->set_userdata('conectividad', $dataFiltrado);
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

	public function exportarExcel(){
		$centros = array();
		$centros = $this->session->userdata('conectividad');
		if(count($centros) > 0){
    		$this->load->library('excel');
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->
				getProperties()
						->setCreator("Conectividad")
						->setLastModifiedBy("Usuario")
						->setTitle("Conectividad_lista")
						->setSubject("Reporte")
						->setDescription('Lista de Centros')
						->setKeywords("conectividad")
						->setCategory("reportes");
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'CLAVECT')
						->setCellValue('B1', 'NOMBRE CT')
						->setCellValue('C1', 'NIVEL CT')
						->setCellValue('D1', 'MODALIDAD')
						->setCellValue('E1', 'MUNICIPIO')
						->setCellValue('F1', 'LOCALIDAD')
						->setCellValue('G1', 'COLONIA')
						->setCellValue('H1', 'NIVEL EDUCATIVO')
						->setCellValue('I1', 'TURNO')
						->setCellValue('J1', 'PROGRAMAS')
						->setCellValue('K1', 'PROVEEDORES')
						->setCellValue('L1', 'ESTATUS')
						;

			$styleArray = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => 'FFFFFF'),
			        'size'  => 11,
			        'name'  => 'Calibri'
			    ),
				'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => '2F75B5')
		        ),
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
			);

			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('H1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('I1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('J1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('K1')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('L1')->applyFromArray($styleArray)
						;

			$x = 2;
			foreach ($centros as $item) {
				$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A'.$x, $item['claveCT'])
								->setCellValue('B'.$x, $item['nombreCT'])
								->setCellValue('C'.$x, $item['nivelCT'])
								->setCellValue('D'.$x, $item['modalidad'])
								->setCellValue('E'.$x, $item['municipio'])
								->setCellValue('F'.$x, $item['localidad'])
								->setCellValue('G'.$x, $item['colonia'])
								->setCellValue('H'.$x, $item['nivelEducativo'])
								->setCellValue('I'.$x, $item['turno'])
								;
					$arrayName = "";
					foreach ($item['programas'] as $programa) {
						$arrayName = $arrayName. $programa."\n";
					}
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$x, $arrayName);
					$objPHPExcel->setActiveSheetIndex(0)->getStyle('J'.$x)->getAlignment()->setWrapText(true); 
					$arrayName = "";
					foreach ($item['proveedores'] as $proveedor) {	
						$arrayName = $arrayName. $proveedor."\n";
					}
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$x, $arrayName);
				    $objPHPExcel->setActiveSheetIndex(0)->getStyle('K'.$x)->getAlignment()->setWrapText(true); 

				   	if($item['statusServicio'] == 1)
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$x, 'CON CONECTIVIDAD');
					if($item['statusServicio'] == 0)
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$x, 'SIN CONECTIVIDAD');


				$x++;
			}   
			$objPHPExcel->getActiveSheet()->setTitle('Conectividad');
			$objPHPExcel->setActiveSheetIndex(0);
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="conectividad.xls"');
			header('Cache-Control: max-age=0');
			$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit; 
		}  
	} 

	public function exportarExcelGeneral(){

		$secundariasGeneral = $this->conectividad_model->centrosNivelModalidad(2, 1);
		$programasSecGeneral= $this->asociarPrograma(2, 1);
		$secundariasTecnica = $this->conectividad_model->centrosNivelModalidad(2, 7);
		$programasSecTecnica= $this->asociarPrograma(2, 7);
		$secundariasTeles = $this->conectividad_model->centrosNivelModalidad(2, 4);
		$programasSecTeles= $this->asociarPrograma(2, 4);
		$secundariasEstatal = $this->conectividad_model->centrosNivelModalidad(2, 6);
		$programasSecEstatal= $this->asociarPrograma(2, 6);
		$primariasIndigena = $this->conectividad_model->centrosNivelModalidad(1, 5);
		$programasPrimIndigena= $this->asociarPrograma(1, 5);
		$primariasGeneral = $this->conectividad_model->centrosNivelModalidad(1, 8);
		$programasPrimGeneral= $this->asociarPrograma(1, 8);
		$primariasEstatal = $this->conectividad_model->centrosNivelModalidad(1, 6);
		$programasPrimEstatal= $this->asociarPrograma(1, 6);
		$preescolarGeneral = $this->conectividad_model->centrosNivelModalidad(4, 8);
		$programasPreGeneral= $this->asociarPrograma(4, 8);
		$preescolarEstatal = $this->conectividad_model->centrosNivelModalidad(4, 6);
		$programasPreEstatal= $this->asociarPrograma(4, 6);

		$totalSecundarias = count($secundariasGeneral) + count($secundariasTecnica) + count($secundariasTeles) +
							count($secundariasEstatal);
	    $totalPrimarias = count($primariasIndigena) + count($primariasGeneral) + count($primariasEstatal);
		$totalPreescolar = count($preescolarGeneral) + count($preescolarEstatal);

		$totalGeneral = $totalSecundarias + $totalPrimarias + $totalPreescolar;

		$programasTotales = $this->totalesPrograma($programasSecGeneral, $programasSecTecnica, $programasSecTeles, $programasSecEstatal, $programasPrimIndigena, $programasPrimGeneral, $programasPrimEstatal, $programasPreGeneral, $programasPreEstatal);


    		$this->load->library('excel');
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->
				getProperties()
						->setCreator("ConectividadGeneral")
						->setLastModifiedBy("Usuario")
						->setTitle("Conectividad_listaGeneral")
						->setSubject("Reporte")
						->setDescription('Lista General de Centros')
						->setKeywords("conectividadGeneral")
						->setCategory("reportes");
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:L2');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A9:B9');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A14:B14');

			
			$styleL1 = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => '000000'),
			        'size'  => 12,
			        'name'  => 'Calibri'
			    ),
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
			);

			$styleArray = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => 'FFFFFF'),
			        'size'  => 11,
			        'name'  => 'Calibri'
			    ),
				'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => '2F75B5')
		        ),
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
			);


			$styleL2 = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => '000000'),
			        'size'  => 11,
			        'name'  => 'Calibri'
			    ),
				'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'DDEBF7')
		        )
			);

			$styleL3 = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => '000000'),
			        'size'  => 11,
			        'name'  => 'Calibri'
			    ),
				'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'D0CECE')
		        )
			);

			$styleL4 = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => 'FFFFFF'),
			        'size'  => 11,
			        'name'  => 'Calibri'
			    ),
				'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'C65911')
		        ),
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
			);

			$styleL5 = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => '000000'),
			        'size'  => 11,
			        'name'  => 'Calibri'
			    ),
				'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'F8CBAD')
		        )
			);

			$styleL6 = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => 'FFFFFF'),
			        'size'  => 11,
			        'name'  => 'Calibri'
			    ),
				'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => '70AD47')
		        ),
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
			);

			$styleL7 = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => '000000'),
			        'size'  => 11,
			        'name'  => 'Calibri'
			    ),
				'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'C6E0B4')
		        )
			);

			$styleL8 = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => '000000'),
			        'size'  => 12,
			        'name'  => 'Calibri'
			    ),
				'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => '8BE1FF')
		        )
			);


			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A2', 'NIVEL EDUCATIVO')
						->setCellValue('C2', 'PROGRAMAS DE CONECTIVIDAD ')
						->setCellValue('A3', 'SECUNDARIA')
						->setCellValue('C3', 'HDT')
						->setCellValue('D3', 'CQ(CONECTATE QUERETARO)')
						->setCellValue('E3', 'USEBEQ')
						->setCellValue('F3', 'MC2')
						->setCellValue('G3', 'RED BICENTENARIO')
						->setCellValue('H3', '10K')
						->setCellValue('I3', '11K')
						->setCellValue('J3', 'AULA TELMEX')
						->setCellValue('K3', 'RED 23')
						->setCellValue('L3', 'JS Y SZ')
						;
			$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleL1)
						->getActiveSheet()->getStyle('C2')->applyFromArray($styleL1)
						->getActiveSheet()->getStyle('A3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('B3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('C3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('D3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('E3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('F3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('G3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('H3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('I3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('J3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('K3')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('L3')->applyFromArray($styleArray)
						;
		    $objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A4', 'GENERALES')
						->setCellValue('B4', count($secundariasGeneral))
						->setCellValue('C4', count($programasSecGeneral['HDT']))
						->setCellValue('D4', count($programasSecGeneral['CQ']))
						->setCellValue('E4', count($programasSecGeneral['USEBEQ']))
						->setCellValue('F4', count($programasSecGeneral['MC2']))
						->setCellValue('G4', count($programasSecGeneral['RED BI']))
						->setCellValue('H4', count($programasSecGeneral['10K']))
						->setCellValue('I4', count($programasSecGeneral['11K']))
						->setCellValue('J4', count($programasSecGeneral['AULA']))
						->setCellValue('K4', count($programasSecGeneral['RED23']))
						->setCellValue('L4', count($programasSecGeneral['JS']))
						;

			$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('B4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('C4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('D4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('E4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('F4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('G4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('H4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('I4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('J4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('K4')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('L4')->applyFromArray($styleL2);

		     $objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A5', 'TECNICAS')
						->setCellValue('B5', count($secundariasTecnica))
						->setCellValue('C5', count($programasSecTecnica['HDT']))
						->setCellValue('D5', count($programasSecTecnica['CQ']))
						->setCellValue('E5', count($programasSecTecnica['USEBEQ']))
						->setCellValue('F5', count($programasSecTecnica['MC2']))
						->setCellValue('G5', count($programasSecTecnica['RED BI']))
						->setCellValue('H5', count($programasSecTecnica['10K']))
						->setCellValue('I5', count($programasSecTecnica['11K']))
						->setCellValue('J5', count($programasSecTecnica['AULA']))
						->setCellValue('K5', count($programasSecTecnica['RED23']))
						->setCellValue('L5', count($programasSecTecnica['JS']))
						;

			$objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('B5')->applyFromArray($styleL3)			
						->getActiveSheet()->getStyle('C5')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('D5')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('E5')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('F5')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('G5')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('H5')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('I5')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('J5')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('K5')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('L5')->applyFromArray($styleL3);

			 $objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A6', 'TELESECUNDARIA')
						->setCellValue('B6', count($secundariasTeles))
						->setCellValue('C6', count($programasSecTeles['HDT']))
						->setCellValue('D6', count($programasSecTeles['CQ']))
						->setCellValue('E6', count($programasSecTeles['USEBEQ']))
						->setCellValue('F6', count($programasSecTeles['MC2']))
						->setCellValue('G6', count($programasSecTeles['RED BI']))
						->setCellValue('H6', count($programasSecTeles['10K']))
						->setCellValue('I6', count($programasSecTeles['11K']))
						->setCellValue('J6', count($programasSecTeles['AULA']))
						->setCellValue('K6', count($programasSecTeles['RED23']))
						->setCellValue('L6', count($programasSecTeles['JS']))
						;

			$objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('B6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('C6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('D6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('E6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('F6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('G6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('H6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('I6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('J6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('K6')->applyFromArray($styleL2)
						->getActiveSheet()->getStyle('L6')->applyFromArray($styleL2);

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A7', 'ESTATAL')
						->setCellValue('B7', count($secundariasEstatal))
						->setCellValue('C7', count($programasSecEstatal['HDT']))
						->setCellValue('D7', count($programasSecEstatal['CQ']))
						->setCellValue('E7', count($programasSecEstatal['USEBEQ']))
						->setCellValue('F7', count($programasSecEstatal['MC2']))
						->setCellValue('G7', count($programasSecEstatal['RED BI']))
						->setCellValue('H7', count($programasSecEstatal['10K']))
						->setCellValue('I7', count($programasSecEstatal['11K']))
						->setCellValue('J7', count($programasSecEstatal['AULA']))
						->setCellValue('K7', count($programasSecEstatal['RED23']))
						->setCellValue('L7', count($programasSecEstatal['JS']))
						;

			$objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('B7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('C7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('D7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('E7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('F7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('G7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('H7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('I7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('J7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('K7')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('L7')->applyFromArray($styleL3);

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A8', 'TOTAL')
						->setCellValue('B8', $totalSecundarias)
						->setCellValue('A9', 'PRIMARIA');

			$objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('B8')->applyFromArray($styleArray)
						->getActiveSheet()->getStyle('A9')->applyFromArray($styleL4);

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A10', 'INDIGENA')
						->setCellValue('B10', count($primariasIndigena))
						->setCellValue('C10', count($programasPrimIndigena['HDT']))
						->setCellValue('D10', count($programasPrimIndigena['CQ']))
						->setCellValue('E10', count($programasPrimIndigena['USEBEQ']))
						->setCellValue('F10', count($programasPrimIndigena['MC2']))
						->setCellValue('G10', count($programasPrimIndigena['RED BI']))
						->setCellValue('H10', count($programasPrimIndigena['10K']))
						->setCellValue('I10', count($programasPrimIndigena['11K']))
						->setCellValue('J10', count($programasPrimIndigena['AULA']))
						->setCellValue('K10', count($programasPrimIndigena['RED23']))
						->setCellValue('L10', count($programasPrimIndigena['JS']))
						;

			$objPHPExcel->getActiveSheet()->getStyle('A10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('B10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('C10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('D10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('E10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('F10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('G10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('H10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('I10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('J10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('K10')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('L10')->applyFromArray($styleL5);

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A11', 'GENERAL')
						->setCellValue('B11', count($primariasGeneral))
						->setCellValue('C11', count($programasPrimGeneral['HDT']))
						->setCellValue('D11', count($programasPrimGeneral['CQ']))
						->setCellValue('E11', count($programasPrimGeneral['USEBEQ']))
						->setCellValue('F11', count($programasPrimGeneral['MC2']))
						->setCellValue('G11', count($programasPrimGeneral['RED BI']))
						->setCellValue('H11', count($programasPrimGeneral['10K']))
						->setCellValue('I11', count($programasPrimGeneral['11K']))
						->setCellValue('J11', count($programasPrimGeneral['AULA']))
						->setCellValue('K11', count($programasPrimGeneral['RED23']))
						->setCellValue('L11', count($programasPrimGeneral['JS']))
						;

			$objPHPExcel->getActiveSheet()->getStyle('A11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('B11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('C11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('D11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('E11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('F11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('G11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('H11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('I11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('J11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('K11')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('L11')->applyFromArray($styleL3);

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A12', 'ESTATAL')
						->setCellValue('B12', count($primariasEstatal))
						->setCellValue('C12', count($programasPrimEstatal['HDT']))
						->setCellValue('D12', count($programasPrimEstatal['CQ']))
						->setCellValue('E12', count($programasPrimEstatal['USEBEQ']))
						->setCellValue('F12', count($programasPrimEstatal['MC2']))
						->setCellValue('G12', count($programasPrimEstatal['RED BI']))
						->setCellValue('H12', count($programasPrimEstatal['10K']))
						->setCellValue('I12', count($programasPrimEstatal['11K']))
						->setCellValue('J12', count($programasPrimEstatal['AULA']))
						->setCellValue('K12', count($programasPrimEstatal['RED23']))
						->setCellValue('L12', count($programasPrimEstatal['JS']))
						;


			$objPHPExcel->getActiveSheet()->getStyle('A12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('B12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('C12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('D12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('E12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('F12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('G12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('H12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('I12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('J12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('K12')->applyFromArray($styleL5)
						->getActiveSheet()->getStyle('L12')->applyFromArray($styleL5);


			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A13', 'TOTAL')
						->setCellValue('B13', $totalPrimarias)
						->setCellValue('A14', 'PREESCOLAR');

			$objPHPExcel->getActiveSheet()->getStyle('A13')->applyFromArray($styleL4)
						->getActiveSheet()->getStyle('B13')->applyFromArray($styleL4)
						->getActiveSheet()->getStyle('A14')->applyFromArray($styleL6);

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A15', 'GENERAL')
						->setCellValue('B15', count($preescolarGeneral))
						->setCellValue('C15', count($programasPreGeneral['HDT']))
						->setCellValue('D15', count($programasPreGeneral['CQ']))
						->setCellValue('E15', count($programasPreGeneral['USEBEQ']))
						->setCellValue('F15', count($programasPreGeneral['MC2']))
						->setCellValue('G15', count($programasPreGeneral['RED BI']))
						->setCellValue('H15', count($programasPreGeneral['10K']))
						->setCellValue('I15', count($programasPreGeneral['11K']))
						->setCellValue('J15', count($programasPreGeneral['AULA']))
						->setCellValue('K15', count($programasPreGeneral['RED23']))
						->setCellValue('L15', count($programasPreGeneral['JS']))
						;

			$objPHPExcel->getActiveSheet()->getStyle('A15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('B15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('C15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('D15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('E15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('F15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('G15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('H15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('I15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('J15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('K15')->applyFromArray($styleL7)
						->getActiveSheet()->getStyle('L15')->applyFromArray($styleL7);


			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A16', 'ESTATAL')
						->setCellValue('B16', count($preescolarEstatal))
						->setCellValue('C16', count($programasPreEstatal['HDT']))
						->setCellValue('D16', count($programasPreEstatal['CQ']))
						->setCellValue('E16', count($programasPreEstatal['USEBEQ']))
						->setCellValue('F16', count($programasPreEstatal['MC2']))
						->setCellValue('G16', count($programasPreEstatal['RED BI']))
						->setCellValue('H16', count($programasPreEstatal['10K']))
						->setCellValue('I16', count($programasPreEstatal['11K']))
						->setCellValue('J16', count($programasPreEstatal['AULA']))
						->setCellValue('K16', count($programasPreEstatal['RED23']))
						->setCellValue('L16', count($programasPreEstatal['JS']))
						;

			$objPHPExcel->getActiveSheet()->getStyle('A16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('B16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('C16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('D16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('E16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('F16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('G16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('H16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('I16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('J16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('K16')->applyFromArray($styleL3)
						->getActiveSheet()->getStyle('L16')->applyFromArray($styleL3);

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A17', 'TOTAL')
						->setCellValue('B17', $totalPreescolar);

			$objPHPExcel->getActiveSheet()->getStyle('A17')->applyFromArray($styleL6)
						->getActiveSheet()->getStyle('B17')->applyFromArray($styleL6);

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A20', 'TOTALES')
						->setCellValue('B20', $totalGeneral)
						->setCellValue('C20', $programasTotales['HDT'])
						->setCellValue('D20', $programasTotales['CQ'])
						->setCellValue('E20', $programasTotales['USEBEQ'])
						->setCellValue('F20', $programasTotales['MC2'])
						->setCellValue('G20', $programasTotales['RED BI'])
						->setCellValue('H20', $programasTotales['10K'])
						->setCellValue('I20', $programasTotales['11K'])
						->setCellValue('J20', $programasTotales['AULA'])
						->setCellValue('K20', $programasTotales['RED23'])
						->setCellValue('L20', $programasTotales['JS'])
						;

			$objPHPExcel->getActiveSheet()->getStyle('A20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('B20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('C20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('D20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('E20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('F20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('G20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('H20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('I20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('J20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('K20')->applyFromArray($styleL8)
						->getActiveSheet()->getStyle('L20')->applyFromArray($styleL8);

    		//$objPHPExcel->getDefaultStyle()->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->setTitle('ConectividadGeneral');
			$objPHPExcel->setActiveSheetIndex(0);
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="ConectividadGeneral.xls"');
			header('Cache-Control: max-age=0');
			$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit; 
	
	} 

	function asociarPrograma($idNivelEducativo, $idModalidad){
		$programas = [];
		
		$programas['HDT'] = $this->conectividad_model->getCentrosByPrograma(1, $idNivelEducativo, $idModalidad);
		$programas['CQ'] = $this->conectividad_model->getCentrosByPrograma(2, $idNivelEducativo, $idModalidad);
		$programas['USEBEQ'] = $this->conectividad_model->getCentrosByPrograma(3, $idNivelEducativo, $idModalidad);
		$programas['JS'] = $this->conectividad_model->getCentrosByPrograma(4, $idNivelEducativo, $idModalidad);
		$programas['MC2'] = $this->conectividad_model->getCentrosByPrograma(5, $idNivelEducativo, $idModalidad);
		$programas['RED BI'] = $this->conectividad_model->getCentrosByPrograma(6, $idNivelEducativo, $idModalidad);
		$programas['10K'] = $this->conectividad_model->getCentrosByPrograma(7, $idNivelEducativo, $idModalidad);
		$programas['11K'] = $this->conectividad_model->getCentrosByPrograma(8, $idNivelEducativo, $idModalidad);
		$programas['AULA'] = $this->conectividad_model->getCentrosByPrograma(9, $idNivelEducativo, $idModalidad);
		$programas['RED23'] = $this->conectividad_model->getCentrosByPrograma(10, $idNivelEducativo, $idModalidad);

		return $programas;
	}

	function totalesPrograma($programasSecGeneral, $programasSecTecnica, $programasSecTeles, $programasSecEstatal, $programasPrimIndigena, $programasPrimGeneral, $programasPrimEstatal, $programasPreGeneral, $programasPreEstatal){

		$programas['HDT'] = count($programasSecGeneral['HDT']) + count($programasSecTecnica['HDT']) + count($programasSecTeles['HDT']) + count($programasSecEstatal['HDT']) + count($programasPrimIndigena['HDT']) + count($programasPrimGeneral['HDT']) + count($programasPrimEstatal['HDT']) + count($programasPreGeneral['HDT']) + count($programasPreEstatal['HDT']);

		$programas['CQ'] = count($programasSecGeneral['CQ']) + count($programasSecTecnica['CQ']) + count($programasSecTeles['CQ']) + count($programasSecEstatal['HDT']) + count($programasPrimIndigena['CQ']) + count($programasPrimGeneral['CQ']) + count($programasPrimEstatal['CQ']) + count($programasPreGeneral['CQ']) + count($programasPreEstatal['CQ']);

		$programas['USEBEQ'] = count($programasSecGeneral['USEBEQ']) + count($programasSecTecnica['USEBEQ']) + count($programasSecTeles['USEBEQ']) + count($programasSecEstatal['USEBEQ']) + count($programasPrimIndigena['USEBEQ']) + count($programasPrimGeneral['USEBEQ']) + count($programasPrimEstatal['USEBEQ']) + count($programasPreGeneral['USEBEQ']) + count($programasPreEstatal['USEBEQ']);

		$programas['MC2'] = count($programasSecGeneral['MC2']) + count($programasSecTecnica['MC2']) + count($programasSecTeles['MC2']) + count($programasSecEstatal['MC2']) + count($programasPrimIndigena['MC2']) + count($programasPrimGeneral['MC2']) + count($programasPrimEstatal['MC2']) + count($programasPreGeneral['MC2']) + count($programasPreEstatal['MC2']);

		$programas['RED BI'] = count($programasSecGeneral['RED BI']) + count($programasSecTecnica['RED BI']) + count($programasSecTeles['RED BI']) + count($programasSecEstatal['RED BI']) + count($programasPrimIndigena['RED BI']) + count($programasPrimGeneral['RED BI']) + count($programasPrimEstatal['RED BI']) + count($programasPreGeneral['RED BI']) + count($programasPreEstatal['RED BI']);

		$programas['10K'] = count($programasSecGeneral['10K']) + count($programasSecTecnica['10K']) + count($programasSecTeles['10K']) + count($programasSecEstatal['10K']) + count($programasPrimIndigena['10K']) + count($programasPrimGeneral['10K']) + count($programasPrimEstatal['10K']) + count($programasPreGeneral['10K']) + count($programasPreEstatal['10K']);

		$programas['11K'] = count($programasSecGeneral['11K']) + count($programasSecTecnica['11K']) + count($programasSecTeles['11K']) + count($programasSecEstatal['11K']) + count($programasPrimIndigena['11K']) + count($programasPrimGeneral['11K']) + count($programasPrimEstatal['11K']) + count($programasPreGeneral['11K']) + count($programasPreEstatal['11K']);

		$programas['AULA'] = count($programasSecGeneral['AULA']) + count($programasSecTecnica['AULA']) + count($programasSecTeles['AULA']) + count($programasSecEstatal['AULA']) + count($programasPrimIndigena['AULA']) + count($programasPrimGeneral['AULA']) + count($programasPrimEstatal['AULA']) + count($programasPreGeneral['AULA']) + count($programasPreEstatal['AULA']);

		$programas['RED23'] = count($programasSecGeneral['RED23']) + count($programasSecTecnica['RED23']) + count($programasSecTeles['RED23']) + count($programasSecEstatal['RED23']) + count($programasPrimIndigena['RED23']) + count($programasPrimGeneral['RED23']) + count($programasPrimEstatal['RED23']) + count($programasPreGeneral['RED23']) + count($programasPreEstatal['RED23']);

		$programas['JS'] = count($programasSecGeneral['JS']) + count($programasSecTecnica['JS']) + count($programasSecTeles['JS']) + count($programasSecEstatal['JS']) + count($programasPrimIndigena['JS']) + count($programasPrimGeneral['JS']) + count($programasPrimEstatal['JS']) + count($programasPreGeneral['JS']) + count($programasPreEstatal['JS']);

		return $programas;
	}

}

?>