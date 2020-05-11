<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public function is_logged(){
    	if (!$this->session->userdata('logged_in')) $this->go_login();
    }

    protected function go_login($error = null){
    	if (is_null($error))
    		redirect(base_url().'login');
    	else 
    		redirect(base_url().'login/start/'.$error);
    }
}