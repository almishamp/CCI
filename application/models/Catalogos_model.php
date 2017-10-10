<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_model extends CI_Model{

	public function __construct(){

		$this->load->database('db1');

	}

	function getMunicipioByNombre($municipio){
		$query = $this->db->get_where('CA_RegionMunicipio', array('nombreMunicipio' => $municipio));
		return $query->row_array();
	}

	function getNivelEducativoByNombre($nivelEducativo){
		$query = $this->db->get_where('CA_NivelEducativo', array('nombre' => $nivelEducativo));
		return $query->row_array();
	}

	function getTurnoByNombre($turno){
		$query = $this->db->get_where('CA_Turno', array('nombre' => $turno));
		return $query->row_array();
	}

	function getModalidadByNombre($modalidad){
		$query = $this->db->get_where('CA_Modalidad', array('nombre' => $modalidad));
		return $query->row_array();
	}

	function getNivelCTByNombre($nivelCT){
		$query = $this->db->get_where('CA_NivelCT', array('nombre' => $nivelCT));
		return $query->row_array();
	}

	function getListaCatalogoProveedores(){
		$query = $this->db->get('CA_Proveedores');
		return $query->result_array();
	}

	function getListaCatalogoProgramas(){
		$query = $this->db->get('CA_Programas');
		return $query->result_array();
	}

	function getProveedorCat($idCatProveedor){
		$query = $this->db->get_where('CA_Proveedores', array('idCatProveedor' => $idCatProveedor));
		return $query->row_array();
	}

	function getProgramaCat($nombre){
		$query = $this->db->get_where('CA_Programas', array('nombre' => $nombre));
		return $query->row_array();
	}

	function getPrograma($idCatPrograma){
		$query = $this->db->get_where('CA_Programas', array('idCatPrograma' => $idCatPrograma));
		return $query->row_array();
	}

	function getProveedor($idCatProveedor){
		$query = $this->db->get_where('CA_Proveedores', array('idCatProveedor' => $idCatProveedor));
		return $query->row_array();
	}

	function savePrograma($data){
			$this->db->insert('CA_Programas', $data);			
	        return $this->db->insert_id();
		}

	function updatePrograma($data, $idCatPrograma){
		$this->db->where('idCatPrograma', $idCatPrograma);
		$this->db->update('CA_Programas', $data);
		return $this->db->affected_rows();
	}

	function saveProveedor($data){
			$this->db->insert('CA_Proveedores', $data);			
	        return $this->db->insert_id();
		}

	function updateProveedor($data, $idCatProveedor){
		$this->db->where('idCatProveedor', $idCatProveedor);
		$this->db->update('CA_Proveedores', $data);
		return $this->db->affected_rows();
	}

	function getProveedorByName($nombre){
		$query = $this->db->get_where('CA_Proveedores', array('nombre' => $nombre));
		return $query->row_array();
	}

	function getListaMunicipios(){
		$query = $this->db->get('CA_RegionMunicipio');
		return $query->result_array();
	}

	function getListaModalidad(){
		$query = $this->db->get('CA_Modalidad');
		return $query->result_array();
	}

	function getListaNivelEducativo(){
		$query = $this->db->get('CA_NivelEducativo');
		return $query->result_array();
	}

	function getListaTurno(){
		$query = $this->db->get('CA_Turno');
		return $query->result_array();
	}

	function getListaNivelCT(){
		$query = $this->db->get('CA_NivelCT');
		return $query->result_array();
	}

	function getCatalogo($catalogo){
		$query = $this->db->get("$catalogo");
		return $query->result_array();
	}

	function getListaLocalidades(){
		$this->db->distinct();
		$this->db->select('localidad');
		$query = $this->db->get('conectividad');

		return $query->result_array();
	}
	
	

}