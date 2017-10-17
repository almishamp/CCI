<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends Main_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->library('form_validation');
		# Cargamos la libreria para la validacion de los formularios
		$this->load->helper('url');
		$this->load->library(array('form_validation', 'session', 'encrypt'));

	}

	public function inicio(){
		if ($this->session->userdata() && $this->session->userdata('logueado') == true) {
			redirect('conectividad/home');
		} else{
			echo $this->templates->render('usuario/login');
		}
	}

	public function salir() {
		if ($this->session->userdata() && $this->session->userdata('logueado') == true) {
			$sesion = array('logueado' => false);
			$this->session->set_userdata($sesion);
		    echo json_encode(array('redirect'=>base_url('/'))); 
		} else {
		    echo json_encode(array('redirect'=>base_url('/'))); 
		}
	}

	public function nuevoRegistro(){
		$email = $_POST['email'];
		$contrasenia =$_POST['contrasenia'];
		$nombreUsuario = $_POST['nombreUsuario'];
		$contraseniaRepeat = $_POST['contraseniaRepeat'];
		$this->validarNuevoUsuario($nombreUsuario, $email, $contrasenia, $contraseniaRepeat);
		$usuario = $this->usuario_model->obtenerUsuario($email, $contrasenia);
		if($usuario){
			$msj = "El correo ya esta asociado a un usuario registrado";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
		}else{
			$dataUsuario = array('email' => $_POST['email'],
								'contrasenia' => $_POST['contrasenia'],
								'nombreUsuario' => $_POST['nombreUsuario'] ,
								'role' => 2,
								'estatus' => 1
								);
	
			$idUsuario = $this->usuario_model->saveUsuario($dataUsuario);
			if($idUsuario){
				$msj = "Usuario creado con exito, ingrese al sistema";
				echo json_encode(array('status'=>1, "msj"=> $msj)); 
			}else{
				$msj = "Ocurrio un error al guardar el registro, intentelo nuevamente";
				echo json_encode(array('status'=>3, "msj"=> $msj)); 
			}

		}
	}

	public function acceder(){
		$email = $_POST['email'];
		$contrasenia =$_POST['contrasenia'];
		$this->validarUsuario($email, $contrasenia);
		$usuario = $this->usuario_model->obtenerUsuario($email, $contrasenia);
		//print_r($usuario);
		if ($usuario) {
			$sesion = array(
				'idUsuario' => $usuario['idUsuario'],
				'nombreUsuario' => $usuario['nombreUsuario'],
				'role' => $usuario['role'],
				'email' => $usuario['email'],
				'status' => $usuario['estatus'],
				'logueado' => true
			);
			//print_r($sesion);
			$this->session->set_userdata($sesion);
			if($sesion['status'] == 1 && $sesion['logueado'] == true)
				echo json_encode(array('status'=>1, 'redirect'=>base_url('conectividad/home'))); 
			if($sesion['logueado'] == true && $sesion['status'] == 0){
				$msj = "El usuario ingresado esta inactivo";
			    echo json_encode(array("status" => 3, "msj"=> $msj)); 
			}
		}else{
			$msj = "¡El usuario ingresado no esta registrado, por favor registre al usuario para acceder al sistema!";
		    echo json_encode(array("status" => 3, "msj"=> $msj)); 
		}	
	}

	private function validarNuevoUsuario($nombreUsuario, $email, $contrasenia, $contraseniaRepeat){
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

		if(!$email)
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Por favor ingrese el email';
            $data['status'] = FALSE;
        }
        if($email){
        	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			    
			}else{
				$data['inputerror'][] = 'email';
	            $data['error_string'][] = 'Por favor agregue una cuenta de correo valida';
	            $data['status'] = FALSE;
			}
        }

        if(!$contrasenia)
        {
            $data['inputerror'][] = 'contrasenia';
            $data['error_string'][] = 'Por favor ingrese la contraseña';
            $data['status'] = FALSE;
        }
		
        if(!$nombreUsuario)
        {
            $data['inputerror'][] = 'nombreUsuario';
            $data['error_string'][] = 'Por favor ingrese el nombre de usuario';
            $data['status'] = FALSE;
        }

        if(!$contraseniaRepeat)
        {
            $data['inputerror'][] = 'contraseniaRepeat';
            $data['error_string'][] = 'Por favor ingrese la contraseña nuevamente';
            $data['status'] = FALSE;
        }
        if($contraseniaRepeat != $contrasenia){
		    $data['inputerror'][] = 'contraseniaRepeat';
            $data['error_string'][] = 'Las passwords no coinciden';
            $data['status'] = FALSE;
        }
		
       if($data['status'] === FALSE){ 
       		$msj = "Favor de verifivar los datos";
			echo json_encode(array("status" => 2, "msj"=> $msj, "data" => $data)); 
            exit();
       }

    } 

    private function validarUsuario($email, $contrasenia){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

		if(!$email)
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Por favor ingrese el email';
            $data['status'] = FALSE;
        }else{
        	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			    
			}else{
				$data['inputerror'][] = 'email';
	            $data['error_string'][] = 'Por favor agregue una cuenta de correo con el formato valido';
	            $data['status'] = FALSE;
			}
        }

        if(!$contrasenia)
        {
            $data['inputerror'][] = 'contrasenia';
            $data['error_string'][] = 'Por favor ingrese la contraseña';
            $data['status'] = FALSE;
        }
		
       if($data['status'] === FALSE){ 
       		$msj = "Favor de verifivar los datos";
			echo json_encode(array("status" => 2, "msj"=> $msj, "data" => $data)); 
            exit();
       }

    } 


}