<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datos_iniciales_mdl extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	//Obtener los datos iniciales de un profesional en función al tipo
	//1: Gasto
	//2: Pasivo
	public function fetch_by_id($id, $tipo){
		$query = 'select a.nombre, b.monto, a.tipo, a.color_etiqueta
					from datos_iniciales a inner join profesion_datos_iniciales b on 
					a.id_valor = b.id_valor	and b.id_profesion = '.$id.' and a.tipo = '.$tipo;
		$rows = $this->db->query($query);
		return $rows->result();
	}
}