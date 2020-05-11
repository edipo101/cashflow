<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_mdl extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	//Obtener datos del usuario
	public function fetch_by($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$row = $this->db->get('view_usuario')->row();
      	return $row;
	}

	//Obtener todos los registros
	public function fetch_all(){
		$rows = $this->db->get('usuario');
		return $rows->result();
	}

  	//Insertar nuevo registro
  	public function insert($values){
		$this->db->insert('usuario', $values);
		return $this->db->insert_id();
	}

	public function update($id, $values){
		$this->db->where('id_usuario', $id);
		$this->db->update('usuario', $values);
    	return 0;
	}

	//Algun usuario está ocupando cierta profesion
	public function is_used($id_profesion){
		$query = 'select count(*) as cant
					from usuario
					where id_profesion = '.$id_profesion;
		$result = $this->db->query($query)->row()->cant;
		return $result;
	}
}