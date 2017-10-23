<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos extends Main_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model('catalogos_model');
		$this->load->model('usuario_model');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');

	}

	public function listProgramas(){
		if ($this->session->userdata() && $this->session->userdata('logueado') == true) {
			echo $this->templates->render('catalogos/programas');
		} else{
		   redirect('/');
		}
	}

	public function listProveedores(){
		if ($this->session->userdata() && $this->session->userdata('logueado') == true) {
			echo $this->templates->render('catalogos/proveedores');
		} else{
			redirect('/');
		}
	}

	public function listUsuarios(){
		if ($this->session->userdata() && $this->session->userdata('logueado') == true) {
			echo $this->templates->render('catalogos/usuarios');
		} else{
			redirect('/');
		}
	}

	public function showPrograma(){
		$idCatPrograma = $_POST['idCatPrograma'];
		echo json_encode($this->catalogos_model->getPrograma($idCatPrograma));
	}

	public function showProveedor(){
		$idCatProveedor = $_POST['idCatProveedor'];
		echo json_encode($this->catalogos_model->getProveedor($idCatProveedor));
	}

	public function showUsuario(){
		$idUsuario = $_POST['idUsuario'];
		echo json_encode($this->usuario_model->obtenerUsuarioId($idUsuario));
	}

	public function getListProgramas(){
		$programas = $this->catalogos_model->getListaCatalogoProgramas();
	    $user = $this->session->userdata();
		echo json_encode(array("programas" => $programas, "user" => $user)); 
	}

	public function getListProveedores(){
		$proveedores = $this->catalogos_model->getListaCatalogoProveedores();
	    $user = $this->session->userdata();
		echo json_encode(array("proveedores" => $proveedores, "user" => $user)); 
	}

	public function getListUsuarios(){
		$usuarios = $this->catalogos_model->getListaUsuarios();
	    $user = $this->session->userdata();
		echo json_encode(array("usuarios" => $usuarios, "user" => $user)); 
	}

	public function getProvedorCAT(){
		$idCatProveedor = $_POST['idCatProveedor'];
		echo json_encode($this->catalogos_model->getProveedorCat($idCatProveedor));
	}

	public function nuevoPrograma(){
       if($_POST['nombre']){
			$dataPrograma = array('nombre' => $_POST['nombre'],
						'status' => $_POST['status']
						);
			$idPrograma = $this->catalogos_model->savePrograma($dataPrograma);
			if($idPrograma){
				$status = 1;
				$msj = 'Programa guardado con exito';
			}else{
				$status = 2;
				$msj = 'ERROR al guardar programa';
			} 
			echo json_encode(array("status" => $status, "msj"=> $msj)); 	
		}
		else{
			$msj = "Agregue un nombre al programa";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
       }


				
	}

	public function editarPrograma(){
		if($_POST['nombre']){
			$dataPrograma = array('nombre' => $_POST['nombre'],
						'status' => $_POST['status']
						);
			$idCatPrograma = $_POST['idCatPrograma'];
			$filas_afectadas = $this->catalogos_model->updatePrograma($dataPrograma, $idCatPrograma);		

			if($filas_afectadas){
				$status = 1;
				$msj = 'Programa guardado con exito';
			}else{
				$status = 2;
				$msj = 'ERROR al guardar programa';
			} 
			echo json_encode(array("status" => $status, "msj"=> $msj)); 
		}
		else{
			$msj = "Agregue un nombre al programa";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
       }		
	}

	public function nuevoProveedor(){

       if($_POST['nombre']){
       		$nombreProveedor = $_POST['nombre'];
       		$proveedorEncontrado = $this->catalogos_model->getProveedorByName($nombreProveedor);
       		if($proveedorEncontrado){
       			$status = 4;
				$msj = 'El proveedor ya se encuentra en el catalogo';
       			echo json_encode(array("status" => $status, "msj"=> $msj)); 
       		}
			else{
				$dataProveedor = array('nombre' => $_POST['nombre'],
								   'nombreContacto' => $_POST['nombreContacto'],
								   'telefonoContacto' => $_POST['telefonoContacto'],
						'status' => $_POST['status'],

						);
				$idCatProveedor = $this->catalogos_model->saveProveedor($dataProveedor);
				if($idCatProveedor){
					$status = 1;
					$msj = 'Proveedor guardado con exito';
				}else{
					$status = 2;
					$msj = 'ERROR al guardar proveedor';
				} 
				echo json_encode(array("status" => $status, "msj"=> $msj)); 
			}	
		}
		else{
			$msj = "Agregue un nombre al proveedor";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
       }			
	}

	public function editarProveedor(){
		if($_POST['nombre']){
			$nombreProveedor = $_POST['nombre'];
       		$proveedorEncontrado = $this->catalogos_model->getProveedorByName($nombreProveedor);
       		if($proveedorEncontrado['idCatProveedor'] != $_POST['idCatProveedor']){
       			$status = 4;
				$msj = 'El proveedor ya se encuentra en el catalogo';
       			echo json_encode(array("status" => $status, "msj"=> $msj)); 
       		}
			else{
				$dataProveedor = array('nombre' => $_POST['nombre'],
									   'nombreContacto' => $_POST['nombreContacto'],
									   'telefonoContacto' => $_POST['telefonoContacto'],
									   'status' => $_POST['status'],
							);
				$idCatProveedor = $_POST['idCatProveedor'];
				$filas_afectadas = $this->catalogos_model->updateProveedor($dataProveedor, $idCatProveedor);		

				if($filas_afectadas){
					$status = 1;
					$msj = 'Proveedor guardado con exito';
				}else{
					$status = 2;
					$msj = 'ERROR al guardar proveedor';
				} 
				echo json_encode(array("status" => $status, "msj"=> $msj)); 
			}	
		}
		else{
			$msj = "Agregue un nombre al proveedor";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
       }		
	}

	public function nuevoUsuario(){
    	$email = $_POST['email'];
		$contrasenia =$_POST['contrasenia'];
		$nombreUsuario = $_POST['nombreUsuario'];
		$role = $_POST['role'];
		$status = $_POST['status'];
		$this->validarUsuario($nombreUsuario, $email, $contrasenia);
		$usuario = $this->usuario_model->verificarUsuario($email);
		if($usuario){
			$msj = "El correo ya esta asociado a un usuario registrado";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
		}else{
			$dataUsuario = array('email' => $email,
								'contrasenia' => $contrasenia,
								'nombreUsuario' => $nombreUsuario ,
								'role' => $role,
								'estatus' => $status
								);
	
			$idUsuario = $this->usuario_model->saveUsuario($dataUsuario);
			if($idUsuario){
				$msj = "Usuario creado con exito";
				//$usuarios = $this->catalogos_model->getListaUsuarios();
				echo json_encode(array('status'=>1, "msj"=> $msj)); 
			}else{
				$msj = "Ocurrio un error al guardar el registro, intentelo nuevamente";
				echo json_encode(array('status'=>3, "msj"=> $msj)); 
			}

		}
    }

      public function editarUsuario(){
    	$email = $_POST['email'];
		$contrasenia =$_POST['contrasenia'];
		$nombreUsuario = $_POST['nombreUsuario'];
		$role = $_POST['role'];
		$status = $_POST['status'];
		$idUsuario = $_POST['idUsuario'];
		$this->validarUsuario($nombreUsuario, $email, $contrasenia);
		$usuario = $this->usuario_model->obtenerUsuario($email, $contrasenia);
		if($usuario['idUsuario'] != $idUsuario){
			$msj = "El correo ya esta asociado a un usuario registrado";
			echo json_encode(array("status" => 3, "msj"=> $msj)); 
		}else{
			$dataUsuario = array('email' => $email,
								'contrasenia' => $contrasenia,
								'nombreUsuario' => $nombreUsuario ,
								'role' => $role,
								'estatus' => $status
								);
	
			$idUsuario = $this->usuario_model->editarUsuario($dataUsuario, $idUsuario);
			if($idUsuario){
				$msj = "Usuario editado con exito";
				echo json_encode(array('status'=>1, "msj"=> $msj)); 
			}else{
				$msj = "Ocurrio un error al editar el registro, intentelo nuevamente";
				echo json_encode(array('status'=>3, "msj"=> $msj)); 
			}

		}
    }

    //Validación para cuando el administrador crea un nuevo usuario
    private function validarUsuario($nombreUsuario, $email, $contrasenia){
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $email = trim($email);
		if(!$email)
        {
            $data['inputerror'][] = 'email_input';
            $data['error_string'][] = 'Por favor ingrese el email';
            $data['status'] = FALSE;
        }else{
        	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			    $data['inputerror'][] = 'email_input';
	            $data['error_string'][] = 'Por favor agregue una cuenta de correo valida';
	            $data['status'] = FALSE;
			}
        }
	    if(!$contrasenia){
            $data['inputerror'][] = 'password_input';
            $data['error_string'][] = 'Por favor ingrese la contraseña';
            $data['status'] = FALSE;
        }
		
        if(!$nombreUsuario)
        {
            $data['inputerror'][] = 'nombreUsuario_input';
            $data['error_string'][] = 'Por favor ingrese el nombre de usuario';
            $data['status'] = FALSE;
        }
		
       if($data['status'] === FALSE){ 
       		$msj = "Favor de verifivar los datos";
			echo json_encode(array("status" => 2, "msj"=> $msj, "data" => $data)); 
            exit();
       }

    } 


}