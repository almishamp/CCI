<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articulo extends Main_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model('articulo_model');
		$this->load->model('catalogos_model');
		$this->load->model('conectividad_model');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');

	}

	public function show(){
        $idArticulo = $_POST['idArticulo'];
		echo json_encode($data = $this->articulo_model->getArticulo($idArticulo));
	}

	public function nuevo(){
		$this->validarArticulo($_POST['descripcion'], $_POST['marca'], $_POST['modelo'], $_POST['serie']);

		$dataArticulo = array('descripcion' => $_POST['descripcion'],
						'marca' => $_POST['marca'],
						'modelo' => $_POST['modelo'],
						'serie' => $_POST['serie'],
						'status' => $_POST['statusArticulo'],
						'idConectividad' => $_POST['idConectividad']
						);
	
		$idArticulo = $this->articulo_model->saveArticulo($dataArticulo);

		if($idArticulo){
			$idConectividad = $_POST['idConectividad'];
			$articulos = $this->conectividad_model->getArticulos($idConectividad);
			$status = TRUE;
			$msj = 'Artículo guardado con exito';
		}else{
			$status = FALSE;
			$msj = 'ERROR al guardar artículo';
		} 

		echo json_encode(array("status" => $status, "msj"=> $msj, "artículos" => $articulos)); 
	}

	public function edicion(){

		$this->validarArticulo($_POST['descripcion'], $_POST['marca'], $_POST['modelo'], $_POST['serie']);

		$dataArticulo = array('descripcion' => $_POST['descripcion'],
					'marca' => $_POST['marca'],
					'modelo' => $_POST['modelo'],
					'serie' => $_POST['serie'],
					'status' => $_POST['statusArticulo']
					);

		$idArticulo = $_POST['idArticulo'];
		$filas_afectadas = $this->articulo_model->updateArticulo($dataArticulo, $idArticulo);		

		if($filas_afectadas){
			$idConectividad = $_POST['idConectividad'];
			$articulos = $this->conectividad_model->getArticulos($idConectividad);
			$status = TRUE;
			$msj = 'Actualización realizada con exito';
		}else{
			$status = FALSE;
			$msj = 'ERROR AL ACTUALIZAR DATOS';
		}

	    echo json_encode(array("status" => $status, "msj"=> $msj, "articulos" => $articulos));
		
	}

	public function getLista(){
		$idConectividad = $_POST['idConectividad'];
		echo json_encode($this->articulo_model->getArticulos($idConectividad));
	}


	private function validarArticulo($descripcion, $marca, $modelo, $serie){

		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

		if(!$descripcion)
        {
            $data['inputerror'][] = 'descripcion_area';
            $data['error_string'][] = 'Por favor agregue la descripción del artículo';
            $data['status'] = FALSE;
        }

        if(!$marca)
        {
            $data['inputerror'][] = 'marca_input';
            $data['error_string'][] = 'Por favor agregue la marca del artículo';
            $data['status'] = FALSE;
        }

        if(!$modelo)
        {
            $data['inputerror'][] = 'modelo_input';
            $data['error_string'][] = 'Por favor agregue el modelo del artículo';
            $data['status'] = FALSE;
        }

        if(!$serie)
        {
            $data['inputerror'][] = 'serie_input';
            $data['error_string'][] = 'Por favor agregue la serie del artículo';
            $data['status'] = FALSE;
        }
		
       if($data['status'] === FALSE){ 
            echo json_encode($data);
            exit();
       }

    } 


}