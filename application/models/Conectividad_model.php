<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conectividad_model extends CI_Model{

	public function __construct(){

		$this->load->database('db1');
	}

	function getListConectividad(){

		$this->db->select('c.idConectividad, claveCT, nombreCT, statusServicio, m.idModalidad as idModalidad, m.nombre as modalidad, rm.idMunicipio as idMunicipio, rm.nombreMunicipio as municipio, localidad, ne.idNivelEducativo as idNivelEducativo, ne.nombre as nivelEducativo, t.idTurno as idTurno, t.nombre as turno, nct.idNivelCT as idNivelCT, nct.nombre as nivelCT, p.idPrograma as idPrograma, p.idCatPrograma as idCatPrograma, p.status as status, cp.nombre as programa, tp.idCatTipoPrograma as idCatTipoPrograma, tp.nombre as tipoPrograma, cpv.idCatProveedor as idCatProveedor, cpv.nombre as nombreProveedor');    
		$this->db->from('conectividad as c');
		$this->db->join('CA_RegionMunicipio as rm', 'rm.idMunicipio = c.idMunicipio');
		$this->db->join('CA_Modalidad as m', 'm.idModalidad = c.idModalidad');
		$this->db->join('CA_NivelEducativo as ne', 'ne.idNivelEducativo = c.idNivelEducativo');
		$this->db->join('CA_Turno as t', 't.idTurno = c.idTurno');
		$this->db->join('CA_NivelCT nct', 'nct.idNivelCT = c.idNivelCT');
		$this->db->join('programa p', 'p.idConectividad = c.idConectividad');
		$this->db->join('CA_programas cp', 'cp.IdCatPrograma = p.IdCatPrograma');
		$this->db->join('CA_Tipoprograma tp', 'tp.idCatTipoPrograma=p.idCatTipoPrograma');
		$this->db->join('CA_Proveedores cpv', 'cpv.idCatProveedor=p.idCatProveedor');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getListaSinConexion(){
		$this->db->select('idConectividad, claveCT, nombreCT, statusServicio, localidad, colonia, rm.nombreMunicipio as 				municipio, m.nombre as modalidad, ne.nombre as nivelEducativo, t.nombre as turno');   
		$this->db->from('conectividad as c');
		$this->db->join('CA_RegionMunicipio as rm', 'rm.idMunicipio = c.idMunicipio');
		$this->db->join('CA_Modalidad as m', 'm.idModalidad = c.idModalidad');
		$this->db->join('CA_NivelEducativo as ne', 'ne.idNivelEducativo = c.idNivelEducativo');
		$this->db->join('CA_Turno as t', 't.idTurno = c.idTurno');
		$this->db->where('statusServicio', 0);
		$query = $this->db->get();
		return $query->result_array();



	}

	function getListaConSinConexion(){
		$this->db->select('idConectividad, claveCT, nombreCT, statusServicio, localidad, colonia, rm.nombreMunicipio as 				municipio, m.nombre as modalidad, ne.nombre as nivelEducativo, t.nombre as turno');    
		$this->db->from('conectividad as c');
		$this->db->join('CA_RegionMunicipio as rm', 'rm.idMunicipio = c.idMunicipio');
		$this->db->join('CA_Modalidad as m', 'm.idModalidad = c.idModalidad');
		$this->db->join('CA_NivelEducativo as ne', 'ne.idNivelEducativo = c.idNivelEducativo');
		$this->db->join('CA_Turno as t', 't.idTurno = c.idTurno');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getCentro($idConectividad){
		$this->db->select('idConectividad, claveCT, nombreCT, statusServicio, latitud, longitud, nombreRespSitio, 					   nombreRespInventario, localidad, colonia, rm.nombreMunicipio as municipio, m.nombre as         modalidad, ne.nombre as nivelEducativo, t.nombre as turno');    
		$this->db->from('conectividad as c');
		$this->db->join('CA_RegionMunicipio as rm', 'rm.idMunicipio = c.idMunicipio');
		$this->db->join('CA_Modalidad as m', 'm.idModalidad = c.idModalidad');
		$this->db->join('CA_NivelEducativo as ne', 'ne.idNivelEducativo = c.idNivelEducativo');
		$this->db->join('CA_Turno as t', 't.idTurno = c.idTurno');
		$this->db->where('idConectividad', $idConectividad);
		$query = $this->db->get();
		return $query->row_array();
	}

	function getCentroByClave($claveCT){
		$this->db->select('idConectividad, claveCT, nombreCT, statusServicio, latitud, longitud, nombreRespSitio, 					   nombreRespInventario, localidad, colonia, rm.nombreMunicipio as municipio, m.nombre as         modalidad, ne.nombre as nivelEducativo, t.nombre as turno');    
		$this->db->from('conectividad as c');
		$this->db->join('CA_RegionMunicipio as rm', 'rm.idMunicipio = c.idMunicipio');
		$this->db->join('CA_Modalidad as m', 'm.idModalidad = c.idModalidad');
		$this->db->join('CA_NivelEducativo as ne', 'ne.idNivelEducativo = c.idNivelEducativo');
		$this->db->join('CA_Turno as t', 't.idTurno = c.idTurno');
		$this->db->where('claveCT', $claveCT);
		$query = $this->db->get();
		return $query->row_array();

	}

	function getProgramas($idConectividad){

		$this->db->select('cp.nombre as programa,p.status as status, p.idPrograma as idPrograma, p.gid as gid, p.vsatid as vsatid, tp.nombre as tipoprograma, cpv.nombre as proveedor, p.idCatProveedor as idCatProveedor, p.idCatTipoPrograma as idCatTipoPrograma');
		$this->db->from('conectividad as c');
		$this->db->join('programa as p', 'p.idConectividad = c.idConectividad');
		$this->db->join('CA_Programas as cp', 'cp.idCatPrograma = p.idCatPrograma');
		$this->db->join('CA_Tipoprograma tp', 'tp.idCatTipoPrograma = p.idCatTipoPrograma');
		$this->db->join('CA_Proveedores as cpv', 'cpv.idCatProveedor = p.idCatProveedor');
		$this->db->where('c.idConectividad', $idConectividad);
		$query = $this->db->get();

		return $query->result_array();
	}

	function getArticulos($idConectividad){
		 $query = $this->db->get_where('articulo', array('idConectividad' => $idConectividad));

		return $query->result_array();
	}


	function getCentroByClaveCTSAGA($claveCT){

		$query = $this->db->get_where('conectividad', array('claveCT' => $claveCT));

		return $query->row_array();
	}

	function getCentroByClaveCTCTBA($claveCT){
		$query = $this->db->query("select* from  [SILCEQ.USEBEQ.EDU.MX].[SOPORTE].[DBO].[A_CTBA] where CLAVECCT = '$claveCT'");

		return $query->row_array();
	}

	function updateConectividad($data, $idConectividad){
		$this->db->where('idConectividad', $idConectividad);
		$this->db->update('conectividad', $data);

		return $this->db->affected_rows();
	}

	function getListConectividadFiltros($idsModalidad, $idsMunicipio, $idsNivelEducativo, $idsNivelCT, $idsTurno, $idsProgramas, $idsProveedores, $localidades){

		$this->db->select('c.idConectividad, claveCT, nombreCT, statusServicio, m.idModalidad as idModalidad, m.nombre as modalidad, rm.idMunicipio as idMunicipio, rm.nombreMunicipio as municipio, localidad, ne.idNivelEducativo as idNivelEducativo, ne.nombre as nivelEducativo, t.idTurno as idTurno, t.nombre as turno, nct.idNivelCT as idNivelCT, nct.nombre as nivelCT, p.idPrograma as idPrograma, p.idCatPrograma as idCatPrograma, p.status as status, cp.nombre as programa, tp.idCatTipoPrograma as idCatTipoPrograma, tp.nombre as tipoPrograma, cpv.idCatProveedor as idCatProveedor, cpv.nombre as nombreProveedor');    
		$this->db->from('conectividad as c');
		$this->db->join('CA_RegionMunicipio as rm', 'rm.idMunicipio = c.idMunicipio');
		$this->db->join('CA_Modalidad as m', 'm.idModalidad = c.idModalidad');
		$this->db->join('CA_NivelEducativo as ne', 'ne.idNivelEducativo = c.idNivelEducativo');
		$this->db->join('CA_Turno as t', 't.idTurno = c.idTurno');
		$this->db->join('CA_NivelCT nct', 'nct.idNivelCT = c.idNivelCT');
		$this->db->join('programa p', 'p.idConectividad = c.idConectividad');
		$this->db->join('CA_programas cp', 'cp.IdCatPrograma = p.IdCatPrograma');
		$this->db->join('CA_Tipoprograma tp', 'tp.idCatTipoPrograma=p.idCatTipoPrograma');
		$this->db->join('CA_Proveedores cpv', 'cpv.idCatProveedor=p.idCatProveedor');
		//$this->db->where('statusServicio', 1);
		//$this->db->where_in('c.idMunicipio', $idsMunicipio);
		if(count($idsModalidad) > 0){
		    $this->db->where_in('c.idModalidad', $idsModalidad);
		}
		if(count($idsMunicipio) > 0){
		    $this->db->where_in('c.idMunicipio', $idsMunicipio);
		}
		if(count($localidades) > 0){
		    $this->db->where_in('c.localidad', $localidades);
		}
		if(count($idsNivelEducativo) > 0){
		    $this->db->where_in('c.idNivelEducativo', $idsNivelEducativo);
		}
		if(count($idsNivelCT) > 0){
		    $this->db->where_in('c.idNivelCT', $idsNivelCT);
		}
		if(count($idsTurno) > 0){
		    $this->db->where_in('c.idTurno', $idsTurno);
		}
		if(count($idsProgramas) > 0){
		    $this->db->where_in('p.idCatPrograma', $idsProgramas);
		}
		if(count($idsProveedores) > 0){
		    $this->db->where_in('cpv.idCatProveedor', $idsProveedores);
		}


		$query = $this->db->get();

		return $query->result_array();
	}

	function getListConectividadFiltrosConSinConexion($idsModalidad, $idsMunicipio, $idsNivelEducativo, $idsNivelCT, $idsTurno, $opcionConectividad, $localidades){

		$this->db->select('c.idConectividad, claveCT, nombreCT, statusServicio, m.idModalidad as idModalidad, m.nombre as modalidad, rm.idMunicipio as idMunicipio, rm.nombreMunicipio as municipio, localidad, ne.idNivelEducativo as idNivelEducativo, ne.nombre as nivelEducativo, t.idTurno as idTurno, t.nombre as turno, nct.idNivelCT as idNivelCT, nct.nombre as nivelCT');    
		$this->db->from('conectividad as c');
		$this->db->join('CA_RegionMunicipio as rm', 'rm.idMunicipio = c.idMunicipio');
		$this->db->join('CA_Modalidad as m', 'm.idModalidad = c.idModalidad');
		$this->db->join('CA_NivelEducativo as ne', 'ne.idNivelEducativo = c.idNivelEducativo');
		$this->db->join('CA_Turno as t', 't.idTurno = c.idTurno');
		$this->db->join('CA_NivelCT nct', 'nct.idNivelCT = c.idNivelCT');
		if($opcionConectividad == 2){
		  $this->db->where('c.statusServicio', 0);
		}
		//$this->db->where_in('c.idMunicipio', $idsMunicipio);
		if(count($idsModalidad) > 0){
		    $this->db->where_in('c.idModalidad', $idsModalidad);
		}
		if(count($idsMunicipio) > 0){
		    $this->db->where_in('c.idMunicipio', $idsMunicipio);
		}
		if(count($localidades) > 0){
		    $this->db->where_in('c.localidad', $localidades);
		}
		if(count($idsNivelEducativo) > 0){
		    $this->db->where_in('c.idNivelEducativo', $idsNivelEducativo);
		}
		if(count($idsNivelCT) > 0){
		    $this->db->where_in('c.idNivelCT', $idsNivelCT);
		}
		if(count($idsTurno) > 0){
		    $this->db->where_in('c.idTurno', $idsTurno);
		}

		$query = $this->db->get();

		return $query->result_array();
	}

}



?>