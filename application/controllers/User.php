<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function index()
	{	
	
	}
	

	public function logout()
	{	
		// Remove session value 
        $this->session->unset_userdata('username');
        redirect(base_url().'user_controller/login');
	}
}
