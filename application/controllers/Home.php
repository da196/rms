<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller {
	public function __construct(){
	    parent::__construct(); 
	    $this->load->library('user_agent');
	    //$this->config->load('constants'); //Load constants
	}
	
	public function index()
	{
		if($this->agent->browser() == 'Chrome' OR $this->agent->browser() == 'Mozilla' OR $this->agent->browser() == 'Edge'){
		    // echo $this->agent->browser() . '<br />';
		    // echo $this->agent->version()  . '<br />';
		    // echo $this->agent->platform() . '<br />';
		    // echo $_SERVER['HTTP_USER_AGENT'] . '<br />';  
		    $this->load->view('include/header');
		    $this->load->view('home');
		    $this->load->view('include/footer');  
		}else{
		    $this->load->view('unsupported_browser');   
		} 
		//echo "home";		
	}
}
