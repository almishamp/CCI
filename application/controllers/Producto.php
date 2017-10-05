<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('producto_model');
	
	}


	function index(){
		$this->load->library('menu', array('Inicio', 'Contacto', 'Cursos'));
		//$data['mi_menu'] = $this->menu->construirMenu();
		$this->load->view('primero/header');
		$this->load->view('primero/bienvenido'/*, $data*/);
	}

	function prueba(){
		$this->load->view('primero/header');
		$this->load->view('primero/bienvenido');
	}

	function nuevo(){
		$this->load->view('primero/header');
		$this->load->view('primero/formulario');
	}

	function recibirDatos(){
		$data = array(
			'codigoArt' => $this->input->post('codigoArt'),
			'seccionArt' => $this->input->post('seccionArt'),		
			'nombreArt' => $this->input->post('nombreArt'),
			'precioArt' => $this->input->post('precioArt'),
			'fechaArt' => $this->input->post('fechaArt'),
			'importado' => $this->input->post('importado'),
			'paisOrigen' => $this->input->post('paisOrigen'));

		$this->producto_model->agregarProducto($data);
		$this->load->view('primero/header');
		$this->load->view('primero/bienvenido');
	}


	

	
}
?>