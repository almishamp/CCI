<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends Main_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->library('form_validation');

	}

	public function inicio(){
		echo $this->templates->render('usuario/login');
	}

	public function again($data){
		print_r($data);
		echo $this->templates->render('usuario/login', $data);
		 $this->load->view('usuario/login', $data);
	}


	public function nuevoRegistro(){
		//echo $this->templates->render('usuarios/registrarse');
		$data="hhhh";
		//print_r($data);
				//echo json_encode(array($data));
		echo json_encode(array('status'=>true, 'redirect'=>base_url('conectividad/home'))); 
		//echo json_encode($data);

	}

	public function acceder(){

	//	$this->validarUsuario(isset($_POST['email']), isset($_POST['contrasenia']));

		$contrasenia = isset($_POST['contrasenia']);
		$email = isset($_POST['email']);
	//	$usuario = $this->usuario_model->obtenerUsuario($email, $contrasenia);

	/*	if ($usuario)) {

				$nickname = explode(' ', $usuario->nombre);
				$nickname = $nickname[0];
				$sesion = array(
					'cve_usuario' => $usuario->cve_usuario,
					'cve_perfil' => $usuario->cve_perfil,
					'nombreUsuario' => $usuario->nombreUsuario,
					'email' => $usuario->email,
					'nickname' => $nickname,
					'logueado' => true
				);
				$this->session->set_userdata($sesion);
				switch ($this->session->userdata('cve_perfil')) {
					case '001':
						echo json_encode(array('status'=>true, 'redirect'=>base_url('conectividad/home'))); 
						break;
					default:
						redirect('/');
						break;
				}
			} else {
				redirect('/');
			}  */

		echo json_encode(array('status'=>1, 'redirect'=>base_url('conectividad/home'))); 


	/*		$usuario = $this->input->post('usuario');
			$contrasenia = $this->input->post('contrasenia');
			if ($this->gl_cat_usuarios->resolverLogin($usuario, $contrasenia)) {
				$usuario = $this->gl_cat_usuarios->obtenerUsuario($cve_usuario);
				# Seteamos las variables de sesion
				$nickname = explode(' ', $usuario->nombre);
				$nickname = $nickname[0];
				$sesion = array(
					'cve_usuario' => $usuario->cve_usuario,
					'cve_perfil' => $usuario->cve_perfil,
					'nombre' => $usuario->nombre,
					'correo' => $usuario->correo,
					'nickname' => $nickname,
					'logueado' => true
				);
				$this->session->set_userdata($sesion);
				switch ($this->session->userdata('cve_perfil')) {
					case '001':
						redirect(site_url('Administracion/Clientes'));
						break;
					case '002':
						redirect(site_url('Inicio/Top5'));
						break;
					default:
						redirect('/');
						break;
				}
			} else {
				redirect('/'); 
			}
		} */

	}

	private function validarNuevoUsuario($nombreUsuario, $email, $contrasenia, $contraseniaRepeat){

		if(!$email)
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Por favor ingrese el email';
            $data['status'] = FALSE;
        }else{
        	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
        }else{
        	if ($contrasenia === $contraseniaRepeat) {
			    $data['inputerror'][] = 'contraseniaRepeat';
	            $data['error_string'][] = 'Las passwords no coinciden';
	            $data['status'] = FALSE;
			} 
        }
		
       if($data['status'] === FALSE){ 
			echo json_encode(array("status" => $status, "msj"=> $msj, "data" => $data)); 
            exit();
       }

    } 

    private function validarUsuario($email, $contrasenia){
		

		if(!$email)
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Por favor ingrese el email';
            $data['status'] = FALSE;
        }else{
        	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
		
       if($data['status'] === FALSE){ 
       		$status = 3;
       		$msj = "Favor de verifivar los datos";
			echo json_encode(array("status" => $status, "msj"=> $msj, "data" => $data)); 
            exit();
       }

    } 


}