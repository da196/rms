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
        $this->load->model('Roles_Model','roles_model'); 
        $this->load->library('user_agent');
        //$this->config->load('constants'); //Load constants
        
    }

          //testemail_risk_notification('agape.kamagenge@tcra.go.tz','test risk','test source od risk','test details');
        // public function testemail_risk_notification($to_email=null,$risk_name=null,$source=null,$detail=null){     
        //     $to_email = 'agape.kamagenge@tcra.go.tz';
        //     $risk_name= 'test risk';
        //     $source='test source od risk';
        //     $detail='test details';

        //     $address_to = ucfirst(str_replace("@tcra.go.tz"," ",$to_email));
        //     $address_to = ucfirst(str_replace("."," ",$address_to));
              
        //     //Start Body structrure
        //     $body_msg = '
        //                 <html>
        //                     <head>
        //                         <title>RMU</title>
        //                     </head>
        //                     <body>
        //                         <p><b>Hello  '.$address_to.',</b></p></br>
        //                         <p> A new Risk has successfully been submitted for Review. </p></br>

        //                         <p> <b>Risk Name:</b>    '.$risk_name.' </p></br>

        //                         <p> <b>Source Risk:</b>   '.$source.'</p></br>

        //                         <p> <b>Risk Detail:</b>   '.$detail.'</p></br>

        //                         <p><b>Regards,</b></p></br>
        //                         <p>Risk Management Unit(RMU)</p>
        //                     </body>
        //                 </html>';
        //     //End Body structrure

        //     //$to_email = $to_email;
        //     $email_subject = 'Notification for the Reported New Risk'; 
        //     $config = array(
        //         'protocol' => 'smtp',
        //         'smtp_host' => 'mail.tcra.go.tz',
        //         'smtp_port' => 25,
        //         'smtp_user' => 'erms@tcra.go.tz', 
        //         'smtp_pass' => '3RM5@123', 
        //         'mailtype' => 'html',
        //         'wordwrap' => TRUE,
        //         'newline' => "\r\n",
        //         'charset' => 'utf-8',
        //     );
            
        //     $this->load->library('email');
        //     $this->email->initialize($config); 
        //     $this->email->from('erms@tcra.go.tz', APPLICATION_NAME_ABBREVIATION);
        //     $this->email->to($to_email);
        //     // $this->email->cc('napalite.magingo@tcra.go.tz, peter.lyimo@tcra.go.tz, nikola.mgalla@tcra.go.tz, joseph.zebedayo@tcra.go.tz');
        //     //$this->email->cc('agape.kamagenge@tcra.go.tz, auckland.lauwo@tcra.go.tz');
        //     $this->email->subject($email_subject);
        //     $this->email->message($body_msg);

        //         if($this->email->send()){               
        //             var_dump('A New Risk has been reported and an Email was sent Successfully!..');
        //             ///return true;
        //         }else{
        //             //echo 'Sorry, Email Notification was not successful!';
        //           var_dump('Sorry, Email Notification was not successful!');
        //             //return false;
        //         }
        //         print_r($to_email); die();  
        // }

        // if ( $this->testemail_risk_notification() == false ) 
        //     { print_r(dead);die();  }

      



   
    /*************  Index Page **************/
    public function index(){
        if($this->agent->browser() == 'Chrome' OR $this->agent->browser() == 'Mozilla' OR $this->agent->browser() == 'Edge'){ 
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
                //redirect(base_url().'login/testemail_risk_notification');                   
            }  
        }else{
            $this->load->view('unsupported_browser');   
        }          
    }

    /*************  Login Page **************/
    public function login(){  
        $data['list_directorate'] = $this->directorate_model->get_directorate(); // List of all Directorates
        $data['list_responsible_officers'] = $this->responsible_officer_model->get_ResponsibleOfficers(null,1);    
        //$data['title'] = 'Login Page';   
        $data['list_faq']= $this->catalogsfaq_model->get_faq_all();
        if($this->agent->browser() == 'Chrome' OR $this->agent->browser() == 'Mozilla' OR $this->agent->browser() == 'Edge'){
            $this->load->view('index', $data);    
        }else{
            $this->load->view('unsupported_browser');   
        } 
    }

    public function login_validation(){        
        $this->load->library('form_validation'); // Check if is null on the username and password.
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run()){ // After success validation                                 
                $username = $this->input->post('username');
                $username_only =  str_replace("@tcra.go.tz","",$username); 
                $password = $this->input->post('password');

                // User Login in LDAP Check 
                if(LDAP_Controller::ldap_connection($username_only,$password)){
                    // Checks if the user exists in the database
                    if($this->user_model->check_User($username_only)){
                            $user =  $this->user_model->get_user($username_only);
                            $get_data = $this->roles_model->get_role_name($user['role_id'])->result();
                            foreach($get_data as $value)  
                            {  
                               $rolename = $value->name;  
                            }
                            //var_dump($rolename);die();
                            $session_data = array(
                                'username' => $username_only,
                                'user_id'=> $user['id'],
                                'role'=> $user['role_id'],
                                'rolename'=> $rolename
                            );
                            //var_dump($session_data);die();

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
                        $today = date("Y-m-d");
                        $data = array(
                            'email'=>$username_only,
                            'role_id'=> 3,
                            'active'=>1,
                            'date_created'=>$today
                        );
                        // Insert the new user in the database
                        $this->user_model->insert_user($data);
                        $user =  $this->user_model->get_user($username_only);
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
                    }
                }else{
                    $this->session->set_flashdata('error','Invalid Username and Password');
                    redirect(base_url().'login/login');
                }
        }else{
            $this->login();
        }
    }
	

    public function logout(){          
        $this->session->unset_userdata('username');// Remove session value 
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('role');
        redirect(base_url().'login/login');       
    }
}