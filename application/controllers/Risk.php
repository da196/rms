<?php
require APPPATH.'libraries/Quarter.php';

class Risk extends CI_Controller{

    public function __construct(){

        parent::__construct();
     
        $this->load->library('session');  
        $this->load->library('pdf');
        $this->load->model('Risk_Model','risk_model');  
        $this->load->model('Risk_Approval_Model','risk_approval_model'); 
        $this->load->model('User_Model','user_model'); 
        $this->load->model('Registry_Model','registry_model'); 
        $this->load->model('Responsible_Officer_Model','responsible_officer_model'); 
        $this->load->model('RiskReport_Model'); 
        $this->load->model('Incident_Model','incident_model'); 
        $this->load->model('KeyRiskIndicators_Model','keyriskindicators_model');

        
    }


    
      

    
    /*************  Risk Page **************/
    public function dashboard(){
          // Check the session first
          // Userdata fetch data stored in the session
          $role_id = $this->session->userdata('role_id');
          $username = $this->session->userdata('username');
          $user_id = $this->session->userdata('user_id');

          
          if($user_id!= ''){
              $active_code = 1; 
              //$data['getReportRisk'] = $this->risk_model->count_Riskreport(null);
              //$data['getAccessReportRisk'] = $this->risk_model->count_Riskreport(3);
              //$data['getRiskRegister'] = $this->registry_model->count_RiskRegistered();

              $statusid=1; //submitted/unreviewed status
              $data['unreviewedrisks'] =  $this->risk_model->risksstatuscount($statusid);
              $statusid=3; //approved status
              $data['approvedrisks'] = $this->risk_model->risksstatuscount($statusid);
              $statusid=5; //rejected status
              $data['rejectedrisks'] = $this->risk_model->risksstatuscount($statusid);

              $data['incidentrisks'] = $this->incident_model->incidentriskscount();
              $data['kris'] = $this->keyriskindicators_model->kriscount();
              $data['assessedkris'] = $this->keyriskindicators_model->assessedkriscount();
              
              $data['role'] = $role_id;
              $data['user_id'] = $user_id;
              $data['username'] = $username;  
              $this->load->view('include/header');
              $this->load->view('dashboard_rmu',$data);             
              $this->load->view('include/footer');  //footnote   
              $this->load->view('include/jsfiles'); //all included JS Files
              $this->load->view('risk/dashboardcustom'); //custom JS manipulations for this page
          }else{
              redirect(base_url().'login/login');
          } 
    }


        
        /*************  Risk Creation Page **************/
        public function create(){
            // Check the session first
            // Userdata fetch data stored in the session
            $role_id = $this->session->userdata('role_id');
            $user_id = $this->session->userdata('user_id');
            $username = $this->session->userdata('username');
           
             if($user_id!= ''){
             $data['list_responsible_officers'] = $this->responsible_officer_model->get_ResponsibleOfficers(null,1);       
             $data['role'] = $role_id;
             $data['username'] = $username; 
             $data['user_id'] = $user_id;
             $this->load->view('include/header');
             $this->load->view('risk_create',$data);
             $this->load->view('include/footer');  //footnote   
             $this->load->view('include/jsfiles'); //all included JS Files
             $this->load->view('risk/createcustom'); //custom JS manipulations for this page
            }
            else{
            redirect(base_url().'login/login');
            }       
     }    
                

        /*************  Risk View Page **************/
        public function index(){
               //print_r($session_id); die();
               // Check the session first
               // Userdata fetch data stored in the session
               $role_id = $this->session->userdata('role');
               //print_r($role_id); die();
               $user_id = $this->session->userdata('user_id');
               $username = $this->session->userdata('username');
              
                if($user_id!= ''){
                $data['list_responsible_officers'] = $this->responsible_officer_model->get_ResponsibleOfficers(null,1);
                // STATUS_ID // RISK_ID AND USER_ID
                // Check if Administrator
                if(in_array($role_id,array(4))){
                    //$test = ' 4T ';
                    $data['list_risk'] = $this->risk_model->get_risk_emerging(null,null,null);
                // Check if RMU Officer
                }elseif(in_array($role_id,array(7))){
                    //$test = ' 7T ';
                    $status = array(1,3,5);
                    $data['list_risk'] = $this->risk_model->get_risk_emerging($status,null,null);
                }else
                // Check if All Other User
                {    
                    //$test = ' OTHER ';           
                    $data['list_risk'] = $this->risk_model->get_risk_emerging(null,null,$user_id);
                }
                //print_r($test); die();
                
                $data['role'] = $role_id;
                $data['username'] = $username;  
                $data['user_id'] = $user_id;
                $this->load->view('include/header');
                $this->load->view('risk_view',$data);
                $this->load->view('include/footer');  //footnote   
                $this->load->view('include/jsfiles'); //all included JS Files
                $this->load->view('risk/indexcustom'); //custom JS manipulations for this page

            }
            else{
              redirect(base_url().'login/login');
            }       
        }



            /*************  Risk Form Validation and Insert/Save  **************/
            public function risk_save()
            {    
                        // After success validation 
                        $today = date("Y-m-d");
                        $name = $this->input->post('name');
                        $information_source = $this->input->post('information_source');
                        $remarks = $this->input->post('remarks');
                        $responsible_officer = $this->input->post('responsible_officer');
                        $reporter_id = $this->input->post('reporter_id');

                         // Get Quarter here ...
                        // $quarter = Quarter::get_quarter();
                         // End get calculate quarter

                        //BAD DESIGN
                        // Get Quarter here ...
                        $quarterNoCaptured = Quarter::get_quarter();
                        //Map the captured quarter number to the database-quarters table quarter_id
                        if($quarterNoCaptured == 1){
                         $quarter = 1;
                        }elseif ($quarterNoCaptured == 2) {
                         $quarter = 4;
                        }elseif ($quarterNoCaptured == 3) {
                         $quarter = 8;
                        }elseif ($quarterNoCaptured == 4) {
                         $quarter = 9;
                        }else{
                         $quarter = 'quarter_id ERROR';
                        }

                        // Status-id: 4 as SAVED....
                        $data = array(
                            'name'=> $name,
                            'information_source'=> $information_source,
                            'remarks'=> $remarks,
                            'responsible_officer_id'=>$responsible_officer,
                            'reporter_id'=>$reporter_id,
                            'date_reported'=>$today,
                            'date_created'=>$today,
                            'status_id'=>4,
                            'quarter_id'=>$quarter
                        );
                        
                        $this->risk_model->insert_risk_emerging($data);
                        echo 'New risk has been saved, for further refinement!';         

            }


       /*************  Risk Form For Outside (PUBLIC USER) Insert/Submit  **************/
       public function risk_public_insert()
       {    
                   // After success validation 
                   $today = date("Y-m-d");
                   $name = $this->input->post('name');
                   $information_source = $this->input->post('information_source');
                   $remarks = $this->input->post('remarks');
                   $responsible_officer = $this->input->post('responsible_officer');
                   $reporter_id = $this->input->post('reporter_id');

                   // Get Quarter here ...
                   $quarterNoCaptured = Quarter::get_quarter();
                   //BAD DESIGN
                   //Map the captured quarter number to the database-quarters table quarter_id
                   if($quarterNoCaptured == 1){
                    $quarter = 1;
                   }elseif ($quarterNoCaptured == 2) {
                    $quarter = 4;
                   }elseif ($quarterNoCaptured == 3) {
                    $quarter = 8;
                   }elseif ($quarterNoCaptured == 4) {
                    $quarter = 9;
                   }else{
                    $quarter = 'quarter_id ERROR';
                   }


       
                   // End get calculate quarter              
                   // Check if the user not Unknown(6 as ID)

                   if($reporter_id != '6'){
                   
                       $reporter_=  str_replace("@tcra.go.tz","",$reporter_id); 

                       $dt_user = array(
                           'email'=> $reporter_,
                           'active'=> 1,
                           'role_id'=>3,
                           'date_created'=>$today                   
                       );
                       // START TRANSACTION HERE ***************
                       // Insert user and obtain last insert id
                       $this->db->trans_start();  

                       // Check if the user exists ... 
                       if($this->user_model->check_User($reporter_)){
                           
                           $user = $this->user_model->get_user($reporter_); 
                           $reporter = $user['id']; 

                       }else{
                          
                            $this->user_model->insert_user($dt_user);
                            $insertId = $this->db->insert_id();
                            $reporter = $insertId;   

                           }
                   }else{
                       $reporter = $reporter_id;
                   }
               
                   $data = array(
                       'name'=> $name,
                       'information_source'=> $information_source,
                       'remarks'=> $remarks,
                       'responsible_officer_id'=>$responsible_officer,
                       'reporter_id'=>$reporter,
                       'date_reported'=>$today,
                       'date_created'=>$today,
                       'status_id'=>1,
                       'quarter_id'=>$quarter 
                   );
                   
                $this->risk_model->insert_risk_emerging($data);
               

                if($responsible_officer == 227 || $responsible_officer == ''){
                  $this->email_risk_notification_no_responsible_officer($name,$information_source,$remarks);
                }
                else
                {
                    // Get Email Address and send 
                    $get_user = $this->responsible_officer_model->get_ResponsibleOfficers($responsible_officer,1);    
                    $res = $get_user->result()[0];
                    $mail = $res->email_address;
                 
                   // EMAIL EMAIL MAL-FUNCTIONS
                    $this->email_risk_notification($mail,$name,$information_source,$remarks);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === FALSE)
                    {
                       $this->db->trans_rollback();
                       echo 'Sorry, There was a problem during submitting a Risk';
                    }
                    else
                    {
                      $this->db->trans_commit();                                                
                    }
                }      // END  TRANSACTIONS *************************** 
       }
        

       /*************  Risk Form Validation and Insert/Submit  **************/
        public function risk_insert()
        {    
                    // After success validation 
                    $today = date("Y-m-d");
                    $name = $this->input->post('name');
                    $information_source = $this->input->post('information_source');
                    $remarks = $this->input->post('remarks');
                    $responsible_officer = $this->input->post('responsible_officer');
                    $reporter_id = $this->input->post('reporter_id');

                    // Get Quarter here ...
                    // $quarter = Quarter::get_quarter();
                    // End get calculate quarter  

                    //BAD DESIGN
                    // Get Quarter here ...
                    $quarterNoCaptured = Quarter::get_quarter();
                    //Map the captured quarter number to the database-quarters table quarter_id
                    if($quarterNoCaptured == 1){
                     $quarter = 1;
                    }elseif ($quarterNoCaptured == 2) {
                     $quarter = 4;
                    }elseif ($quarterNoCaptured == 3) {
                     $quarter = 8;
                    }elseif ($quarterNoCaptured == 4) {
                     $quarter = 9;
                    }else{
                     $quarter = 'quarter_id ERROR';
                    }            
                                 
                    // START TRANSACTION HERE ***************
                        $this->db->trans_start();  
                // Status_id as 1 as Submitted
                        $data = array(
                        'name'=> $name,
                        'information_source'=> $information_source,
                        'remarks'=> $remarks,
                        'responsible_officer_id'=>$responsible_officer,
                        'reporter_id'=>$reporter_id,
                        'date_reported'=>$today,
                        'date_created'=>$today,
                        'status_id'=>1,
                        'quarter_id'=>$quarter 
                    );
                    
                $this->risk_model->insert_risk_emerging($data);
              
              
                if($responsible_officer == 227 || $responsible_officer == ''){
                  $this->email_risk_notification_no_responsible_officer($name,$information_source,$remarks);
                }
                else
                {
                    // Get Email Address and send 
                    $get_user = $this->responsible_officer_model->get_ResponsibleOfficers($responsible_officer,1);    
                    $res = $get_user->result()[0];
                    $mail = $res->email_address;
                   
             
                    $this->email_risk_notification($mail,$name,$information_source,$remarks);

                    $this->db->trans_complete();

                    if($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                        echo 'Sorry, There was a problem during reporting a Risk';
                    }
                    else
                    { 
                        $this->db->trans_commit();                          
                    }
                    // END  TRANSACTIONS *************************** 
                }    
        }

        /*************  EMAIL RISK NOTIFICATION  **************/
        public function email_risk_notification($to_email,$risk_name,$source,$detail){     
            $address_to1 = ucfirst(str_replace("@tcra.go.tz","",$to_email));
            $address_to = ucfirst(str_replace("."," ",$address_to1));
            //print_r($to_email); die();            
            //Start Body structrure
            $body_msg = '
                <html>
                  <head>
                      <title>'.APPLICATION_CLIENT_RMU.'</title>
                  </head>
                  <body>
                      <p>Hello <b>'.$address_to.',</b><br>
                       A new risk has been successfully reported for review.<br>
                      <b>Risk Name:</b>    '.$risk_name.' <br>
                      <b>Source Risk:</b>   '.$source.'<br>
                      <b>Risk Detail:</b>   '.$detail.'<br>
                      Please login <a href="'.APPLICATION_LINK.'">here</a> to review it further.
                      </p>
                      <p><b>Regards,</b></br>
                      '.APPLICATION_CLIENT_RMU.'</p>
                  </body>
              </html>';
            //End Body structrure

            //$to_email = $to_email;
            $email_subject = 'Notification for a new Reported Risk'; 
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.tcra.go.tz',
                'smtp_port' => 25,
                'smtp_user' => 'no-reply@tcra.go.tz', 
                'smtp_pass' => '', 
                'mailtype' => 'html',
                'wordwrap' => TRUE,
                'newline' => "\r\n",
                'charset' => 'utf-8',
            );
            
            $this->load->library('email');
            $this->email->initialize($config); 
            $this->email->from('no-reply@tcra.go.tz', APPLICATION_NAME_ABBREVIATION);
            $this->email->to($to_email);
            $this->email->cc('napalite.magingo@tcra.go.tz, peter.lyimo@tcra.go.tz, nikola.mgalla@tcra.go.tz, joseph.zebedayo@tcra.go.tz');
            //$this->email->cc('agape.kamagenge@tcra.go.tz');
            $this->email->subject($email_subject);
            $this->email->message($body_msg);

            //var_dump($this->email->send()); 
            //die();

            if($this->email->send()){               
                echo 'A New Risk has been reported and an Email has been sent.';
            }else{
                print 'A New Risk has been reported, but Email failed to send.';
            }
        }

        // Email Notification for with no responsible_officer
        public function email_risk_notification_no_responsible_officer($risk_name,$source,$detail){          
            //Start Body structrure
            $body_msg = '
               <html>
                 <head>
                     <title>'.APPLICATION_CLIENT_RMU.'</title>
                 </head>
                 <body>
                     <p>Hello <b>'.APPLICATION_CLIENT_RMU.',</b><br>
                      A new risk has been successfully reported for review.<br>
                     <b>Risk Name:</b>    '.$risk_name.' <br>
                     <b>Source Risk:</b>   '.$source.'<br>
                     <b>Risk Detail:</b>   '.$detail.'<br>
                     Please login <a href="'.APPLICATION_LINK.'">here</a> to review it further.
                     </p>
                     <p><b>Regards,</b></br>
                     '.APPLICATION_CLIENT_RMU.'</p>
                 </body>
             </html>';
            //End Body structrure

            //$to_email = $to_email;
            $email_subject = 'Notification for a new Reported Risk'; 

            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.tcra.go.tz',
                'smtp_port' => 25,
                'smtp_user' => 'no-reply@tcra.go.tz', 
                'smtp_pass' => '', 
                'mailtype' => 'html',
                'wordwrap' => TRUE,
                'newline' => "\r\n",
                'charset' => 'utf-8',
            );
            
            $this->load->library('email');
            $this->email->initialize($config); 
            $this->email->from('no-reply@tcra.go.tz', APPLICATION_NAME_ABBREVIATION);
            $to_email = 'napalite.magingo@tcra.go.tz';
            //$to_email = 'agape.kamagenge@tcra.go.tz';
            $this->email->to($to_email);
            $this->email->cc('peter.lyimo@tcra.go.tz, nikola.mgalla@tcra.go.tz, joseph.zebedayo@tcra.go.tz');
            //$this->email->cc('agape.kamagenge@tcra.go.tz');
            $this->email->subject($email_subject);
            $this->email->message($body_msg);

            if($this->email->send()){               
                echo 'A New Risk has been reported and an Email has been sent.';
            }else{
                print 'A New Risk has been reported, but Email failed to send.';
            }
        }

        /*************  Complete Risk (Update the status as active) **************/
        public function complete_risk(){

        }
      

        /*************  Delete Risk (Update the status as inactive) **************/
        public function delete_risk()
        {    
            $today = date("Y-m-d");
            $risk_id = $this->input->post('risk_id');
            // 2 as Deleted for risk
            $dt = array(
                'status_id'=> 2,
                'date_updated'=>$today
            );   
            $this->risk_model->update_risk_emerging($dt,$risk_id);                 

        }

          /*************  Delete Risk (Update the status as inactive) **************/
        public function view_risk()
          {    
            $risk_id = $this->input->post('risk_id');
            //print_r($risk_id); die();
            $view_risk = $this->risk_model->get_risk_emerging(null,$risk_id,null);
            $json = json_encode($view_risk->result()[0]); 
            echo($json); 

          }

            /*************  Delete Risk (Update the status as inactive) **************/
        public function  risk_update()
            {  
                 
            $today = date("Y-m-d");
            $u_name = $this->input->post('u_name');
            $u_information_source = $this->input->post('u_information_source');
            $u_remarks = $this->input->post('u_remarks');
            $u_responsible_officer = $this->input->post('u_responsible_officer');

            if(!empty($u_responsible_officer)){
                $u_responsible_officer = $u_responsible_officer;
            }else{
                $u_responsible_officer = 227;
            }
            $dt = array(
                    'name'=> $u_name,
                    'information_source'=> $u_information_source,
                    'remarks'=> $u_remarks,
                    'responsible_officer_id'=>$u_responsible_officer,
                    'date_updated'=>$today
                 );

               $risk_id = $this->input->post('u_risk_id');
       
               $this->risk_model->update_risk_emerging($dt,$risk_id);
               
               echo 'Risk has been updated Successfully';
               
             }

                /*************  Complete Risk (Update the status as inactive) **************/
                // Change the status_id to 1 in erms_risk_emerging as Submit
        public function  risk_complete()
        {  
             
        $today = date("Y-m-d");
        $c_name = $this->input->post('c_name');
        $c_information_source = $this->input->post('c_information_source');
        $c_remarks = $this->input->post('c_remarks');
        $c_responsible_officer = $this->input->post('c_responsible_officer');

        if(!empty($c_responsible_officer)){
            $c_responsible_officer = $c_responsible_officer;
        }else{
            $c_responsible_officer = 227;
        }
        $dt = array(
                'name'=> $c_name,
                'information_source'=> $c_information_source,
                'remarks'=> $c_remarks,
                'responsible_officer_id'=>$c_responsible_officer,
                'date_updated'=>$today,
                'status_id'=> 1
             );

           $risk_id = $this->input->post('c_risk_id');

           $this->risk_model->update_risk_emerging($dt,$risk_id);
           echo 'Risk has been submitted Successfully';
           
         }

               /*************  Approve Risk ***********************/
               // Change the status_id to 3 in erms_risk_emerging
               // Send data to the erms_risk_emerging_approval Table
               // Send email to the reporter (email@tcra.go.tz)
        public function  risk_approve()
            {    
                // Update status_id to 3 as Approve
                $today = date("Y-m-d");
                $risk_id = $this->input->post('approve_risk_id');
                // Add in the erms_risk_emerging_approval table
                $approved_by = $this->input->post('approved_by');
                $comments = $this->input->post('risk_comment');
                $reporter = $this->input->post('reporter');

                $role_id = $this->session->userdata('role');

                if($role_id == 7){
                    if($approved_by == $reporter){
                        $again_result = array("Status_code"=>404, "Message"=>'Sorry, You cannot review your own reported risk!..');
                        echo json_encode($again_result);
                        return false;  
                    }
                }
                
                $dt = array(
                    'status_id'=> 3,
                );        
                $this->risk_model->update_risk_emerging($dt,$risk_id);
               
                $data = array(           
                    'approved'=> 3,
                    'approved_by'=> $approved_by,
                    'comments'=>$comments,
                    'date_approved'=>$today,
                    'risk_id'=> $risk_id
                );       
                $this->risk_approval_model->insert_risk_emerging_approval($data);
                //echo 'The Risk has been reviewed Successfully';

                  // Email Process Start here ...
                  // Send Email as Approval
                    $get_Reporter = $this->risk_model->get_risk_emerging(null,$risk_id,null);    
                    $res = $get_Reporter->result()[0];
                    $to = $res->email; 
 
                    if($to == 'Anonymous User'){
                        $result = array("Status_code"=>200, "Message"=>'The Risk has been reviewed Successfully!..');
                        echo json_encode($result);
                    }
                    else{
                        $this->send_email($to,$comments);
                    }
            }

             /*************  Reject Risk ***********************/
               // Change the status_id to 5 in erms_risk_emerging
               // Send data to the erms_risk_emerging_approval Table
               // Send email to the reporter (email@tcra.go.tz)
        public function  risk_reject()
        {    
        // Update status_id to 5 as Reject
            $today = date("Y-m-d");
            $risk_id = $this->input->post('approve_risk_id');
            $approved_by = $this->input->post('approved_by');
            $comments = $this->input->post('risk_comment');
            $reporter = $this->input->post('reporter');

            $role_id = $this->session->userdata('role');

            // START CHECK (If the RMU user cannot review his/her own reported risk)
            if($role_id == 7){
                if($approved_by == $reporter){
                    $again_result = array("Status_code"=>404, "Message"=>'Sorry, You cannot review your own reported risk!..');
                    echo json_encode($again_result);
                    return false;  
                }
            }
            // END CHECK

            $dt = array(
                'status_id'=> 5,
            );   
            //$this->db->trans_complete();

            $this->risk_model->update_risk_emerging($dt,$risk_id);

            // Add in the erms_risk_emerging_approval table
          
            $data = array(           
                'approved'=> 3,
                'approved_by'=> $approved_by,
                'comments'=>$comments,
                'date_approved'=>$today,
                'risk_id'=> $risk_id
            );       
            $this->risk_approval_model->insert_risk_emerging_approval($data);
            //echo 'The Risk has been reviewed Successfully';


            //if ($this->db->trans_status() === FALSE)
                //{               
                    // Email Process Start here ...
                    // Send Email as Approval
                    $get_Reporter = $this->risk_model->get_risk_emerging(null,$risk_id,null);    
                    $res = $get_Reporter->result()[0];
                    $to = $res->email; 
                    //print_r($to); die();      
                    if($to == 'Anonymous User'){
                        $result = array("Status_code"=>200, "Message"=>'The Risk has been reviewed Successfully!..');
                        echo json_encode($result); 
                    }
                    else{
                        $this->send_email($to,$comments);
                    }
                    //$this->db->trans_rollback();
                    //echo 'The Risk Transaction was rollback'; 
                //}
            //else{
                    //$this->db->trans_commit();
                    //echo 'The Risk has been reviewed Successfully';  
               // }
           
        }

    /*************  Send Email Function For  Risk ***********************/
         public function send_email($to_email,$body)
            {
                $address_to = ucfirst(str_replace("."," ",$to_email));
                //print_r($address_to); die();            
                //Start Body structrure
                $body_msg = '
                            <html>
                                <head>
                                    <title>RMU</title>
                                </head>
                                <body>
                                    <p><b>Hello  '.$address_to.',</b></p></br>
                                    <p>'.$body.'</p></br>
                                    <p><b>Regards,</b></p></br>
                                    <p>Risk Management Unit(RMU)</p>
                                </body>
                            </html>';
                //End Body structrure

                $to_email = $to_email.'@tcra.go.tz';
                $email_subject = 'Notification for the Reported New Emerging Risk'; 

               

                $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'mail.tcra.go.tz',
                    'smtp_port' => 25,
                    'smtp_user' => 'erms@tcra.go.tz', 
                    'smtp_pass' => '3RM5@123', 
                    'mailtype' => 'html',
                    'wordwrap' => TRUE,
                    'newline' => "\r\n",
                    'charset' => 'utf-8',
                    );
                 
                $this->load->library('email');
                $this->email->initialize($config); 
                $this->email->from('erms@tcra.go.tz',"ERMS");
                $this->email->to($to_email);
                $this->email->subject($email_subject);
                $this->email->message($body_msg);
           
                    if($this->email->send()){               
                        $res = array("Status_code"=>200, "Message"=>'The Risk has been Rievewed and Email has been sent Successfully!..');
                        echo json_encode($res);
                    }else{
                        $resr = array("Status_code"=>404, "Message"=>'Sorry, Email Notification was not Successfully!..');
                        echo json_encode($resr);
                    }

            }

            public function risk_pdf_report_details()
            {         
                $risk_id = $this->uri->segment(3);
                
                if($risk_id){  
                    $approvedRisk = $this->risk_model->risk_fetch_approval($risk_id);
                    $approved = $approvedRisk[0];
                    $fullname = $approved->first_name.'  '.$approved->middle_name.'  '.$approved->last_name;
                    //print_r($approved); die();

                    $html_content = '<h2 style="font-size:15px;"><center><b> TANZANIA COMMUNICATIONS REGULATORY AUTHORITY </b></center></h2>';
                    $html_content .= '<h2 style="font-size:13px;"><center> ISO 9001:2015 CERTIFIED </center></h2>';        
                    $html_content .= '<center><img src="C:/xampp/htdocs/erms/public/img/logo.png" width="100" height="70"/></center>';     
                    $html_content .= '<h2 style="font-size:20px;"><center><b> New/Emerging Risk Report </b></center></h2>'; 
                     // Start      
                    $html_content .= '<form style="display:flex; flex-flow:row wrap; align-items:center;">';
                    $html_content .= '</form>';
                    $html_content .= '<b>Reporting Date:</b>   <label style="text-decoration:underline;">'.date("d-m-Y",strtotime($approved->date_reported)).'</label>';        
                    $html_content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    $html_content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    $html_content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    $html_content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    $html_content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    $html_content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    $html_content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    $html_content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';            
                    $html_content .= '<b>Quarter:</b>   <label style="text-decoration:underline;"> '.$approved->quarter_id.'</label><br/><br/>';    
                    $html_content .= '<div class="form-group row">';
                    $html_content .= '<label><b>Summary of Actions taken for emerging risks reporting last time:</b></label>'; 
                    $html_content .= '<div class="col-lg-2">';
                    $html_content .= '<h4 style="text-decoration:underline; font-weight: normal;"> '.$approved->comments.'</h4>'; 
                    $html_content .= '</div>';
                    $html_content .= '</div>';
                    
                    $html_content .= '<div class="row">'; 
                    $html_content .= '<div class="col-lg-12">'; 
                    $html_content .= '<table border="1" width="100%" style="border-collapse: collapse;">'; 
                    $html_content .= ' <thead>'; 
                    $html_content .= '  <tr>'; 
                    $html_content .= '     <th>Emerging Risk</th>'; 
                    $html_content .= '     <th>Source of Information</th>'; 
                    $html_content .= '     <th>Remarks</th>'; 
                    $html_content .= '     <th>Responsible Officer</th>'; 
                    $html_content .= '   </tr>'; 
                    $html_content .= ' </thead>'; 
                    $html_content .= ' <tbody>'; 
                    $html_content .= '  <tr>'; 
                    $html_content .= '     <td style="text-align:center;">'.$approved->name.'</td>'; 
                    $html_content .= '      <td style="text-align:center;">'.$approved->information_source.'</td>'; 
                    $html_content .= '     <td style="text-align:center;">'.$approved->remarks.'</td>'; 
                    $html_content .= '      <td style="text-align:center;">'.$fullname.'</td>';  
                    $html_content .= '  </tr>'; 
                    $html_content .= ' </tbody>'; 
                    $html_content .= '</table>';                               
                    $html_content .= '</div>';
                    $html_content .= '</div>';
                    // End
                    $this->pdf->loadHtml($html_content);
                    $this->pdf->render();
                    // View the pdf [Attachment => 0] and Download the pdf [Attachment => 1]
                    $this->pdf->stream("riskNo_".$risk_id.".pdf", array("Attachment"=>0));
                  
                }
        
        
            }


          /************* Report with pdf *************/
            public function reports(){
                  // Assessed risk from from HRMU
                  // Userdata fetch data stored in the session
                  $user_id = $this->session->userdata('username');
                  if($user_id!= ''){
                    $active_code = 3; 
                    $data['list_approval_risk'] = $this->risk_model->get_risk_emerging($active_code,null,null);
                    $data['user_id'] = $user_id;    
                    $data['title'] = "New Emerging Risk"; 
                    
                    $this->load->view('include/header');
                    $this->load->view('risk/risk_report',$data);
                    $this->load->view('include/footer');
                    $this->load->view('include/jsfiles'); //all included JS Files
                    $this->load->view('risk/reportscustom'); //custom JS manipulations for this page
                                   
                }else{
                    redirect(base_url().'login/login');
                }

            }
            
            
             // REPORTS LANDING PAGE
            public function generatereports(){
                $data['title'] = 'New/Emerging Risk';
                $data['subtitle'] = 'Reports';       

                //select all users
                $users = $this->user_model->get_all_users();
                $data['users'] = $users;

                //select all status //except deleted and incomplete
                $statuses =  $this->risk_model->get_risk_statuses_exclude_deleted_incomplete();
                $data['statuses'] = $statuses;

                //var_dump($statuses);die();

                $this->load->view('include/header');
                $this->load->view('risk/generateReports', $data);
                $this->load->view('include/footer');
                $this->load->view('include/jsfiles'); //all included JS Files
                $this->load->view('risk/generateReports_CustomJS'); //custom JS manipulations for this page
            }

            //CUSTOM SEARCH AND DOWNLOAD EXCEL
            public function ExcelReport(){  

                $this->load->model("RiskReport_Model");
                $this->load->library("excel");
                //removes excel weirdo characters
                // ob_end_clean();
                // ob_start();
                $object = new PHPExcel();
                $object->setActiveSheetIndex(0);               
                $styleArray = array(
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => '000000')
                     ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'add8e6')
                    )
                );

                $titleStyle = [
                    'font' => [
                        'size' => 16,
                        'bold' => true
                    ]
                ];
                $object->getActiveSheet()->getStyle('A3')->applyFromArray($styleArray);
                $object->getActiveSheet()->getStyle('B3')->applyFromArray($styleArray);
                $object->getActiveSheet()->getStyle('C3')->applyFromArray($styleArray);
                $object->getActiveSheet()->getStyle('D3')->applyFromArray($styleArray);
                $object->getActiveSheet()->getStyle('E3')->applyFromArray($styleArray);
                $object->getActiveSheet()->getStyle('F3')->applyFromArray($styleArray);
                $object->getActiveSheet()->getStyle('G3')->applyFromArray($styleArray);  
                $object->getActiveSheet()->getStyle('H3')->applyFromArray($styleArray);
                $object->getActiveSheet()->getStyle('I3')->applyFromArray($styleArray);
                foreach(range('A','I') as $columnID) {
                    $object->getActiveSheet()->getColumnDimension($columnID)
                        ->setAutoSize(true);
                }  

                //name the worksheet
                $object->getActiveSheet()->setTitle('New Emerging Risk');
                //set cell A1 content with some text
                $object->getActiveSheet()->setCellValue('A1', 'New/Emerging Risk');
                //merge cell A1 until D1
                $object->getActiveSheet()->mergeCells('A1:I1'); 
                //set aligment to center for that merged cell (A1 to D1)
                $object->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $object->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);
                

                $object->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $object->getActiveSheet()->getColumnDimension('C')->setWidth(5);

                //TABLE COLUMNS DEFINITION
                $table_columns = array("Emerging Risk", "Source of Information", "Remarks", "Responsible Officer for Follow up", "Date Reported", "Reported By","Status","Quarter","Year");

                $column = 0;
                foreach($table_columns as $field)
                {
                 $object->getActiveSheet()->setCellValueByColumnAndRow($column, 3, $field);
                 $column++;
                }

                $postData = $this->input->post();
                $dataa = $this->RiskReport_Model->fetchReportData($postData);

                //gRAB QUARTER AND YEAR
                // $cellquarter_value1 =[];
                // foreach($employee_data as $rows)
                // {
                //     $cellquarter_value1 = $rows->quarter_id;
                //     if($cellquarter_value1 != $rows->quarter_id){
                //          $cellquarter_value1 .=  $cellquarter_value1;
                //     }  
                // }                
                
                //re-check on year and quarter display
                //POPULATE EXCEL DATA ON HEADER
                //$rownumber=1;
                // $cellyear='Year';  $cellquarter='Quarter';
                // $cellyear_value='20/21';  $cellquarter_value = $cellquarter_value1;
                // $object->getActiveSheet()->setCellValueByColumnAndRow(0, $rownumber, 'werw');

                // $object->getActiveSheet()->setCellValueByColumnAndRow(1, $rownumber, $cellyear_value); 
                // $object->getActiveSheet()->setCellValueByColumnAndRow(3, $rownumber, $cellquarter);
                // $object->getActiveSheet()->setCellValueByColumnAndRow(4, $rownumber, $cellquarter_value);

                //POPULATE EXCEL DATA
                $excel_row = 4;
                foreach($dataa as $row)
                {
                 $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->name);
                 $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->information_source);
                 $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->remarks);

                 //convert reporter ID to its equivalent name/email
                 $get_data = $this->responsible_officer_model->get_ResponsibleOfficers_email($row->responsible_officer_id)->result();  
                 foreach($get_data as $value)  
                 {  
                    $responsible_officer_id = $value->email_address;  
                 }
                 $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $responsible_officer_id);

                 
                 $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, date("d-m-Y", strtotime($row->date_reported)));

                 //convert reporter ID to its equivalent name/email
                 $get_data = $this->user_model->get_user_email($row->reporter_id)->result();  
                 foreach($get_data as $value)  
                 {  
                    $reporter_id = $value->email;  
                 }
                 $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $reporter_id);

                 //convert status ID to its equivalent name
                 $get_data = $this->risk_model->get_risk_statuses_name($row->status_id)->result();  
                 foreach($get_data as $value)  
                 {  
                    $status_id = $value->status;  
                 } 
                 $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $status_id);
                 $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->quarter_id);     
                 $date1 = date("Y", strtotime($row->date_reported)); $date2=$date1+1; $date3= $date1.'/'.$date2;
                 $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $date3);         
                 $excel_row++;
                }

                $filename = 'New Emerging Risks_'.date('Ymd').'.xls';
                //name the worksheet
                $object->getActiveSheet()->setTitle($filename);
                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                // Clean (erase) the output buffer and turn off output buffering
                ob_end_clean();  
                header('Content-Type: application/vnd.ms-excel');
                header("Content-Disposition: attachment;filename=$filename");
                $object_writer->save('php://output');
                exit;
            }

            public function emergingRiskList(){
              // POST data
              $postData = $this->input->post();

              //var_dump( $postData); 
              //die();
              // Get data
              $data = $this->RiskReport_Model->getEmergingRisks($postData);
              echo json_encode($data);
            }



                

 
}