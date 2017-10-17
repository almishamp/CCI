<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

	public $templates, $sesion_usuario;

	public function __construct(){

		parent::__construct();

        #Se cargan los helpers
		$this->load->helper('url', 'form');
		# Configuracion inicial del motor de plantillas Plates
		$this->templates = new League\Plates\Engine(APPPATH . '/views');
		//$this->templates->addFolder('partials', APPPATH . '/views/partials');
		# Cargamos la libreria para la validacion de los formularios
		$this->load->library(array('form_validation', 'session', 'encrypt'));
	    # Comprobamos que exista una sesion de usuario creada
		if(!$this->session->userdata()) redirect(base_url('/'));
		# Seteamos la clave de usuario en variables globales
		$this->sesion_suario = $this->session->userdata() ? $this->session->userdata('sesion_usuario') : null;
		//$this->updated_user = $this->session->userdata() ? $this->session->userdata('cve_usuario') : null;
		
	}
}

?>