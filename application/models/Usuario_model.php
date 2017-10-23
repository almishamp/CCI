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


	public function obtenerUsuarioId($idUsuario){
		$query = $this->db->get_where('conectividadUsers', array('idUsuario' => $idUsuario));
		return $query->row_array();
	}

	public function verificarUsuario($email){
		$query = $this->db->get_where('conectividadUsers', array('email' => $email));
		return $query->row_array();
	}

	public function editarUsuario($dataUsuario, $idUsuario){
			$this->db->where('idUsuario', $idUsuario);
			$this->db->update('conectividadUsers', $dataUsuario);
			return $this->db->affected_rows();
		}

}