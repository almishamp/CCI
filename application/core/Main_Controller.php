<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

	public $templates;

	public function __construct(){

		parent::__construct();

        #Se cargan los helpers
		$this->load->helper('url', 'form');
		# Configuracion inicial del motor de plantillas Plates
		$this->templates = new League\Plates\Engine(APPPATH . '/views');
	//	$this->templates->addFolder('partials', APPPATH . '/views/partials');
		
	}
}

?>