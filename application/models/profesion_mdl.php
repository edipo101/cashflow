<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profesion_mdl extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	//Obtener un registro específico a partir de su id
	public function fetch_by_id($id){
		$this->db->where('id_profesion', $id);
      	$row = $this->db->get('profesion')->row();
      	return $row;
	}

	//Actualizar cantidad de hijos
	public function update_hijos($id, $cant){
		$this->db->where('id_profesion', $id);
		$this->db->update('profesion', ['cant_hijos' => $cant]);
    	return 0;
	}

	public function fetch_all(){
		$rows = $this->db->get('profesion');
		return $rows->result();
	}
}