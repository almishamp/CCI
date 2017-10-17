<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model{
	# Constructor del modelo
	public function __construct(){
		$this->load->database('db1');
	}

	public function obtenerUsuario($email, $contrasenia){
		$query = $this->db->get_where('conectividadUsers', array('email' => $email, 'contrasenia' => $contrasenia));
		return $query->row_array();
	}

	public function saveUsuario($data){
		$this->db->insert('conectividadUsers', $data);
	    return $this->db->insert_id();
	}

/*	public function altaUsuario($nombreUsuario, $contrasenia, $email, $contraseniaRepeat) {
		$data = array(
			'nombreUsuario' => $cve_usuario,
			'contrasenia' => $this->hash_password($contrasenia),
			'email' => $correo,
			'created_at' => date('Y-m-j H:i:s'),
			'updated_at' => date('Y-m-j H:i:s'),
			'estatus' => 'A'
		);
		return $this->db->insert('ConectividadUsers', $data);
	}
	# Resolver el Login de un usuario
	public function resolverLogin($cve_usuario, $contrasenia) {
		$this->db->select('contrasenia');
		$this->db->from('gl_cat_usuarios');
		$this->db->where('cve_usuario', $cve_usuario);
		$this->db->where('estatus', 'A');
		$hash = $this->db->get()->row('contrasenia');
		return $this->verify_password_hash($contrasenia, $hash);
	}
	# Funcion para obtener la informacion basica del usuario con su clave
	public function obtenerUsuario($email, $contrasenia) {
		$this->db->from('ConectividadUsers');
		$this->db->where('email', $email);
		return $this->db->get()->row();
	}
	# Funcion para setear la contraseña del usuario a un hash
	private function hash_password($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}
	# Funcion para desencriptar una contraseña
	private function verify_password_hash($contrasenia, $hash) {
		return password_verify($contrasenia, $hash);
	}

	# Metodo para eliminar logicamente un usuario
	public function suspenderUsuario($cve_usuario, $estatus){
		$this->db->set('estatus', $estatus);
		$this->db->set('updated_at', date('Y-m-j H:i:s'));
		$this->db->where('ConectividadUsers', $cve_usuario);
		$this->db->limit(1);
		$this->db->update('gl_cat_usuarios');
	} */
}