<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* 
	*/
	class Articulo_model extends CI_Model{
		
		public function __construct(){
			$this->load->database();
		}

		function getArticulo($idArticulo){
			$query = $this->db->get_where('articulo', array('idArticulo' => $idArticulo));
			return $query->row_array();
		}

		function getArticulos($idConectividad){
			 $query = $this->db->get_where('articulo', array('idConectividad' => $idConectividad));
			 return $query->result_array();
		}

		function saveArticulo($data){
			$this->db->insert('articulo', $data);
	        return $this->db->insert_id();
		}

		function updateArticulo($data, $idArticulo){
			$this->db->where('idArticulo', $idArticulo);
			$this->db->update('articulo', $data);
			return $this->db->affected_rows();
		}

	}
?>