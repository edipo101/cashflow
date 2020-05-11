<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gasto_mdl extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	//Obtener todos los registros de un profesional $id
	public function fetch_all($id){
		$this->db->where('id_profesion', $id);
		$rows = $this->db->get('gasto');
		return $rows->result();
	}

	//Eliminar todos los registros del profesional $id
	public function delete_by_profesion($id){
    	$this->db->where('id_profesion', $id);
    	$this->db->delete('gasto');
    	return 0;
  	}

  	//Insertar nuevo registro
  	public function insert($values){
		$this->db->insert('gasto', $values);
		return $this->db->insert_id();
	}

	public function total_monto($id){
		$query = 'select sum(monto) as total
					from gasto
					where id_profesion = '.$id;
		$result = $this->db->query($query)->row()->total;
		return $result;
	}
}