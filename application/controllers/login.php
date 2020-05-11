<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/my_controller.php"); 

class login extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('usuario_mdl');
	}

	public function index(){
		$this->start();
	}

	public function start($code_error = null){
		$this->load->model('profesion_mdl');

		$tipo_error = array(
			1 => '¡Nombre de usuario o contraseña incorrectos!'
			// 2 => '¡Seleccione una profesion!',
			// 3 => '¡La profesion que seleccionó ya está en uso!'
		);

		// $datos = array(
		// 	'profesiones' => $this->profesion_mdl->fetch_all(),
		// );
		$datos = array();	
		
		if (!is_null($code_error))
			$datos['mensaje_error'] = $tipo_error[$code_error];
		
		$this->load->view('login', $datos);
	}

	public function loguearse(){
		$this->load->model('profesion_mdl');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// $id_profesion = $this->input->post('id_profesion');

		$user = $this->usuario_mdl->fetch_by($username, $password);
		// $profesion = $this->profesion_mdl->fetch_by_id($id_profesion);

		if (is_null($user)){
			$error = 1;
			$this->go_login($error);
		}
		// if (is_null($profesion)) {
		// 	$error = 2;
		// 	$this->go_login($error);
		// }
		
		// if ((int)$this->usuario_mdl->is_used($profesion->id_profesion) > 0) {			
		// 	$error = 3;
		// 	$this->go_login($error);
		// }

		$data = array(
			'id_usuario' => $user->id_usuario,
			'nombre' => $user->nombre,
			'id_profesion' => $user->id_profesion,
			'logged_in' => 1
		);
		$this->session->set_userdata($data);
		redirect(base_url() . 'home');

	}

	public function cerrar_sesion() {
        $this->session->sess_destroy();
        $this->go_login();
    }

    
}