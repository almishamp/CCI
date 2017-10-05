<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* 
	*/
	class Programa_model extends CI_Model{
		
		public function __construct(){
			$this->load->database();
		}

		function getPrograma($idPrograma){

			$this->db->select('cp.nombre as programa, p.idPrograma as idPrograma, p.idConectividad as idConectividad, p.status as status, p.gid as gid, p.vsatid as vsatid,p.ipModem as ipModem, p.ipTelefonia as ipTelefonia,
				p.idCatProveedor as idCatProveedor, tp.nombre as tipoprograma, cpv.nombre as proveedor, p.idCatPrograma as idCatPrograma');
			$this->db->from('programa as p');
			$this->db->join('CA_Programas as cp', 'cp.idCatPrograma = p.idCatPrograma');
			$this->db->join('CA_Tipoprograma tp', 'tp.idCatTipoPrograma = p.idCatTipoPrograma');
			$this->db->join('CA_Proveedores cpv', 'cpv.idCatProveedor = p.idCatProveedor');
			$this->db->where('p.idPrograma', $idPrograma);
			$query = $this->db->get();
			return $query->row_array();
		}

		function getConectividad($idConectividad){
			$query = $this->db->get_where('conectividad', array('idConectividad' => $idConectividad));
			return $query->row_array();
		}

		function getProveedores($idPrograma){
			 $this->db->select('cpv.nombre as nombreProveedor, cpv.status as status, pv.idProveedor as idProveedor, cpv.idCatProveedor as idCatProveedor');
			 $this->db->from('proveedor as pv');
			 $this->db->join('CA_Proveedores as cpv', 'cpv.idCatProveedor = pv.idCatProveedor');
			 $this->db->where('pv.idPrograma', $idPrograma);
			 $query = $this->db->get();
			 return $query->result_array();
		}

		function getProveedor($idProveedor){
			$this->db->select('cpv.nombre as proveedor, cpv.nombreContacto as nombreContacto, 
							   cpv.telefonoContacto as telefonoContacto, pv.idProveedor as idProveedor,');
			 $this->db->from('proveedor as pv');
			 $this->db->join('CA_Proveedores as cpv', 'cpv.idCatProveedor = pv.idCatProveedor');
			 $this->db->where('pv.idProveedor', $idProveedor);
			 $query = $this->db->get();

			 return $query->row_array();
		}

		function getListaProgramas(){
			$query = $this->db->get('CA_Programas');
			return $query->result_array();
		}

		function savePrograma($data){
			$this->db->insert('programa', $data);
	        return $this->db->insert_id();
		}

		function saveProveedor($data){
			$this->db->insert('proveedor', $data);			
	        return $this->db->insert_id();
		}

		function getProgramas($idConectividad, $idCatPrograma, $idCatTipoPrograma){
			$query = $this->db->query("select* from  programa where idConectividad = '$idConectividad' and idCatPrograma = '$idCatPrograma' and idCatTipoPrograma = '$idCatTipoPrograma'");
			return $query->row_array();
		}

		function getProveedorB($idPrograma, $idCatProveedor){
			$query = $this->db->query("select* from  proveedor where idPrograma = '$idPrograma' and idCatProveedor = '$idCatProveedor'");
			return $query->row_array();
		}

		function updatePrograma($data, $idPrograma){
			$this->db->where('idPrograma', $idPrograma);
			$this->db->update('programa', $data);
			return $this->db->affected_rows();
		}

		function updateProveedor($data, $idProveedor){
			$this->db->where('idProveedor', $idProveedor);
			$this->db->update('proveedor', $data);
			return $this->db->affected_rows();
		}

	}
?>