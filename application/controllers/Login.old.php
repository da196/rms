<?php

require APPPATH.'libraries/LDAP_Controller.php';

class Login extends CI_Controller{

    public function __construct(){

        parent::__construct();  
        $this->load->library('session');
        $this->load->model('User_Model','user_model');  
        $this->load->model('Responsible_Officer_Model','responsible_officer_model');
        $this->load->model('Directorate_Model','directorate_model');
        $this->load->model('CatalogsFaq_Model','catalogsfaq_model');
 

    }

    /*************  Index Page **************/
    public function index(){
           // Check the session first
          // Userdata fetch data stored in the session
          $role_id = $this->session->userdata('role');
          $user_id = $this->session->userdata('user_id');        
          if($this->session->userdata('username') != ''){
            $data['role'] =  $role_id;
            $data['user_id'] =  $user_id;
			$this->load->view('include/header');
			$this->load->view('home',$data);
			$this->load->view('include/footer'); 
            $this->load->view('include/jsfiles'); 
            $this->load->view('login/indexcustom'); //          
        }else{
            redirect(base_url().'login/login');
        }       
    }

    /*************  Login Page **************/
     public function login(){  
        $data['list_directorate'] = $this->directorate_model->get_directorate(); 
        $data['list_responsible_officers'] = $this->responsible_officer_model->get_ResponsibleOfficers(null,1);    
        $data['title'] = 'Login Page';   
        $data['list_faq']= $this->catalogsfaq_model->get_faq_all();
         
        $this->load->view('index', $data);      
    }

    /*************  Login Form Validation  **************/
    public function login_validation()
	{
        // Check if is null on the username and password.
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run()){
                // After success validation                  
                $username = $this->input->post('username');
                $username_only =  str_replace("@tcra.go.tz","",$username); 
                $password = $this->input->post('password');
               
                // Check if the user exists
                if($this->user_model->check_User($username_only)){

                    if(LDAP_Controller::ldap_connection($username_only,$password)){
                        // After login successfully store the session variable
                        // Get user_data (id, email, approved, date_created, date_updated, unique_id)
                        $user =  $this->user_model->get_user($username_only);

                        //print_r($user['role_id']);die();
                      
                        $session_data = array(
                            'username' => $username_only,
                            'user_id'=>$user['id'],
                            'role'=>$user['role_id']
                        );
                        // Store the variables in the session
                        $this->session->set_userdata($session_data);
                        // If user_role is RMU Officer 
                        if($user['role_id'] == 7){
                            // redirect(base_url().'risk/dashboard');  
                            redirect(base_url().'dashboard/admin');  
                        }
                        // If user_role is RMU Officer
                        elseif($user['role_id'] == 4) {            
                            redirect(base_url().'dashboard/admin');  
                        }else{
                            redirect(base_url().'login/index');  
                        }
                    }else{
                        // Wrong Login
                        $this->session->set_flashdata('error','Invalid Username and Password');
                        redirect(base_url().'login/login');
                    }
                }else{
                    // Wrong Login and 
                    // Insert new user in the users_table
                    // Default role 2-> Normal User /  
                        $today = date("Y-m-d");
                        $data = array(
                            'email'=>$username_only,
                            'role_id'=> 2,
                            'active'=>1,
                            'date_created'=>$today
                        );

                        $this->user_model->insert_user($data);
               
                    $this->session->set_flashdata('error','User does not exists, Try Again');
                    redirect(base_url().'login/login');
                }
        }else{
            $this->login();
        }

	}
	
/*************  Login out **************/
    public function logout(){
          // Remove session value 
          $this->session->unset_userdata('username');
          $this->session->unset_userdata('user_id');
          $this->session->unset_userdata('role');
          redirect(base_url().'login/login');
       
    }


}