<?php

class Incident extends CI_Controller{

    public function __construct(){

        parent::__construct(); 
        $this->load->library('session'); 
        $this->load->library('pdf');
        $this->load->model('Incident_Model','incident_model');  
        $this->load->model('Directorate_Model','directorate_model'); 
        $this->load->model('Section_Model','section_model'); 
        $this->load->model('Consequences_Model','consequences_model'); 
        $this->load->model('Mitigation_model','mitigation_model'); 
        $this->load->model('User_Model','user_model'); 
        $this->load->model('UserRoles_Model','userroles_model'); 

    }

    /*************  Incident Create Page **************/
    public function index(){
           // Check the session first
          // Userdata fetch data stored in the session
          $user_id = $this->session->userdata('username');
          if($user_id!= ''){
            $dt['list_directorate'] = $this->directorate_model->get_directorate();
            //print_r($data['list_directorate']); die();
            $dt['user_id'] = $user_id;  
            $this->load->view('include/header');
            $this->load->view('incident_create',$dt);
            $this->load->view('include/footer'); 
            $this->load->view('include/jsfiles'); //all included JS Files
            $this->load->view('incident/indexcustom'); //custom JS manipulations for this page               
        }else{
            redirect(base_url().'login/login');
        }       
    }

    /*************  Incident View Page **************/
    public function view(){
        $role_id = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');
        // Check the session first
       // Userdata fetch data stored in the session
       $username = $this->session->userdata('username');
       if($user_id!= ''){
        $dt['user_id'] = $username;

            if(in_array($role_id,array(4,7))){
            // Check if role is RMU Officer/Adminstrator as 
            // $rmu_admin = array(4,7);
            // (INCIDENT_ID == REPORTER_ID == ESC_USER_ID)
            $dt['list_incident']  = $this->incident_model->get_incident(null,null,null);
            }
            else if(in_array($role_id,array(10,23))){
            // Check if role is Supervisor/Risk Champion as   array(10,23)
            // $sup_chmp = array(10,23);
            $dt['list_incident']  = $this->incident_model->get_incident(null,$user_id,$user_id);
            }
            else{
            // Check as if Normal User/Risk Owner/Management as array(3,8,9)
            $dt['list_incident']  = $this->incident_model->get_incident(null,$user_id,null);
            }

         $this->load->view('include/header');
         $this->load->view('incident_view',$dt);
         $this->load->view('include/footer');
         $this->load->view('include/jsfiles'); //all included JS Files
         $this->load->view('incident/viewcustom'); //custom JS manipulations for this page               
        }else{
            redirect(base_url().'login/login');
        }       
    }

    /*************  Get All Incident Page **************/
    public function generatereports(){
        // Check the session first
       // Userdata fetch data stored in the session
       $user_id = $this->session->userdata('username');
       if($user_id!= ''){
         $dt['list_incident']  = $this->incident_model->get_incident(null,null,null);
         $dt['user_id'] = $user_id; 

         //select all users
         $allusers = $this->user_model->get_all_users();
         $dt['users'] = $allusers;

         $dt['title'] = "Incident"; 
         $dt['subtitle'] = "Reports"; 
         $this->load->view('include/header');
         $this->load->view('incident/incident_report',$dt);
         $this->load->view('include/footer'); 
         $this->load->view('include/jsfiles'); //all included JS Files
         $this->load->view('incident/incident_report_custom'); //custom JS manipulations for this page              
        }else{
                redirect(base_url().'login/login');
        }       
    }

    /*********** Get All the Incident Consequence *******/   
    public function incident_view_consequences(){
        $incident_id = $this->input->post('incident_id');           
        $list_incident_consequences = $this->incident_model->get_incident_consequences($incident_id);
        $json = json_encode($list_incident_consequences->result());        
        echo($json);
    } 

    /*********** Get All the Incident Mitigations *******/   
    public function incident_view_mitigations(){
        $incident_id = $this->input->post('incident_id');
        $list_incident_mitigations = $this->incident_model->get_incident_mitigation($incident_id);
        $json = json_encode($list_incident_mitigations->result()); 
        echo($json);
    } 

    /*************  Incident Form Validation and Insert/Save  **************/
     public function incident_section_get()
    {  
        $directorate = $this->input->post('directorate_id');
        $list_section = $this->section_model->get_section_indirectorate($directorate);
        $json = json_encode($list_section); 
        echo($json);
    }

    /*************  Incident Escalated User (Supervisor/Risk Champion)  **************/
    public function incident_get_escTo()
    {  
        $esc_to = $this->input->post('esc_to_val');
        $section = $this->input->post('getSection');
        $directorate = $this->input->post('getDirectorate');
        
        if($esc_to == '23'){
            $list_users = $this->userroles_model->get_esc_userroles($esc_to,$section);
        }  
        else if($esc_to == '10'){
            $list_users = $this->userroles_model->get_esc_supervisor($esc_to,$section,$directorate);
        }    
        else
        {
            $list_users = $this->userroles_model->get_esc_userroles($esc_to,null);
        }
        $json = json_encode($list_users); 
        echo($json);
    }


   /*************  View  Incident  **************/
   public function view_incident()
   {    
     $inc_id = $this->input->post('inc_id');
     $view_incident = $this->incident_model->get_incident($inc_id,null,null);
     //print_r($view_incident->result()[0]); die();
     $json = json_encode($view_incident->result()[0]); 
     echo($json); 

   }

    /*************  Incident Form Validation and Insert/Save  **************/
    public function incident_insert()
        {   
            // Insert Incident
            $today = date("Y-m-d");
            $directorate = $this->input->post('directorate');
            $section = $this->input->post('section');
            $esc_to = $this->input->post('esc_to');
            $description = $this->input->post('description');
            $reporter_id = $this->input->post('reporter_id');
            $esc_user = $this->input->post('esc_user'); 

            $data_inc = array(
                'directorate_id'=> $directorate,
                'section_id'=> $section,
                'escalated_to'=> $esc_to,
                'description'=>$description,
                'date_reported'=>$today,
                'date_created'=>$today,
                'reporter_id'=>$reporter_id,
                'esc_user_id'=>$esc_user,
                'active'=>1
            );

            //Get email address for send email.
            $get_user = $this->userroles_model->fetch_one($esc_user);   
            $res = $get_user[0];
            $mail = $res->email;
            //var_dump($mail); die();
            $this->email_incident_notification($mail,$description);
            
            // START  TRANSACTIONS *****************
            $this->db->trans_start();
            $this->incident_model->insert_incident($data_inc);
            $insertId = $this->db->insert_id();

            // Insert Consequences
            $consequences = $this->input->post('consequences');
            $number = count($consequences);
            if($number >= 1)
            {
                for($i = 0; $i < $number; $i++){
                    $dt_cons = array(
                        'description'=> $consequences[$i],
                        'incident_id'=> $insertId ,                    
                        'date_created'=>$today
                    );
                    $this->consequences_model->insert_consequences($dt_cons);
                }
            }
            // Insert Mitigations 
            $mitigation = $this->input->post('mitigation');
            $number_m = count($mitigation);
            if($number_m >= 1)
            {
                for($j = 0; $j < $number_m; $j++){
                    $dt_mtg = array(
                        'description'=> $mitigation[$j],
                        'incident_id'=> $insertId ,                    
                        'date_created'=>$today
                    );
                    $this->mitigation_model->insert_mitigation($dt_mtg);
                }
            }   
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo 'Sorry, There was a problem during adding an  Incident';
            }
            else
            {
                $this->db->trans_commit();
                //echo 'You have successfully submitted a New Incident for review';
                
            }
            // END  TRANSACTIONS ***************************          
        }

    // Soft Delete an Incident
    public function delete_incident(){
        $today = date("Y-m-d");
        $inc_id = $this->input->post('incident_id');
        // 0 as In-active incident
        $dt = array(
            'active'=> 0,
            'date_updated'=>$today
        );   

       $this->incident_model->update_incident($dt,$inc_id);           

    }    

    // Get the incident report 
    public function incident_report(){
        $incident_id = $this->uri->segment(3);
        if($incident_id){  
            $listOfIncident = $this->incident_model->get_incident($incident_id,null,null);
            $listofItem =  $listOfIncident->result();
            $approved = $listofItem[0];

            $list_incident_consequences = $this->incident_model->get_incident_consequences($incident_id);
            //print_r($list_incident_consequences->result()); die();

            $list_incident_mitigation = $this->incident_model->get_incident_mitigation($incident_id);

            $html_content = '<h2 style="font-size:15px;"><center><b> TANZANIA COMMUNICATIONS REGULATORY AUTHORITY </b></center></h2>';
            $html_content .= '<h2 style="font-size:13px;"><center> ISO 9001:2015 CERTIFIED </center></h2>';    

            //$html_content .= '<center><img src="C:/xampp/htdocs/erms/public/img/logo.png" width="100" height="70"/></center>';

            $html_content .=  '<center><img src="<?php echo base_url(\'/public/img/logo.png\'); ?>" width="100" height="70"/></center>';
        


            $html_content .= '<h2 style="font-size:20px;"><center><b> Incident Report </b></center></h2>'; 
            // Start       
            $html_content .= '<form style="display:flex; flex-flow:row wrap; align-items:center;">';
            $html_content .= '</form>';
            $html_content .= '<b>Incident Reported By:</b>   <label style="text-decoration:underline;">'. ucfirst(str_replace(".","  ",$approved->email)).'</label><br><br>';                               
            $html_content .= '<b>Directorate:  </b>   <label style="text-decoration:underline;"> '.$approved->directorate_name.'</label><br/><br/>';
            $html_content .= '<b>Section/Unit:  </b>   <label style="text-decoration:underline;"> '.$approved->section_name.'</label><br/><br/>';   
            $html_content .= '<b>Incident Escalated to:  </b>   <label style="text-decoration:underline;"> '.$approved->escalated_to.'</label><br/><br/>';                
            $html_content .= '<b> Description of the Incident:  </b>   <label style="text-decoration:underline;"> '.$approved->description.'</label><br/><br/>';    
            
            //Consequences
            $html_content .= '<div class="form-group row">';
            $html_content .= '<label><b>Possible Consequences/Actual consequences:</b></label>'; 
            $html_content .= '<div class="col-lg-2">';
            $html_content .= '<ol>';
                foreach($list_incident_consequences->result() as $consequences){
            $html_content .= '<li style="font-weight: normal;"> '.$consequences->description.'</li>'; 
                }
            $html_content .= '</ol>';
            $html_content .= '</div>';
            $html_content .= '</div>';


             //Mitigation Proposals
            $html_content .= '<div class="form-group row">';
            $html_content .= '<label><b>Mitigation Proposals:</b></label>'; 
            $html_content .= '<div class="col-lg-2">';
            $html_content .= '<ol>';
                foreach($list_incident_mitigation->result() as $mitigation){
            $html_content .= '<li style="font-weight: normal;"> '.$mitigation->description.'</li>'; 
                }
            $html_content .= '</ol>';
            $html_content .= '</div>';
            $html_content .= '</div>';

            //Signature
            $html_content .= '<b> Signature:  </b>   <label style="text-decoration:underline;"> _____________________________ </label><br/><br/>';  
         
            $html_content .= '<div class="row">'; 
            $html_content .= '<div class="col-lg-12">'; 
                              
            $html_content .= '</div>';
            $html_content .= '</div>';
            // End
            $this->pdf->loadHtml($html_content);
            $this->pdf->render();
            // View the pdf [Attachment => 0] and Download the pdf [Attachment => 1]
            $this->pdf->stream("incidentNo_".$incident_id.".pdf", array("Attachment"=>0));             
        }
    }

   
   //CUSTOM SEARCH AND DOWNLOAD EXCEL
   public function ExcelReport(){  
       $this->load->library("excel");        
       // ob_end_clean();
       //ob_start();
       $object = new PHPExcel();
       $object->setActiveSheetIndex(0);

       
       //set cell A1 content with some text
       $object->getActiveSheet()->setCellValue('A1', 'Incident Risks');
       $object->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
       $object->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
       //merge cell A1 until D1
       $object->getActiveSheet()->mergeCells('A1:F1'); 
       $object->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


       // DEFAULT STYLE ON THE ENTIRE WORKSHEET
       $defaultStyleArray = array(
           'alignment' => array(
               'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT ,
               'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP  ,
               'wrap' => true
           )
       );
       $object->getDefaultStyle()->applyFromArray($defaultStyleArray);
       foreach(range('A','H') as $columnID) {
           $object->getActiveSheet()->getColumnDimension($columnID)
               ->setAutoSize(true);
       } 

       // BOLD HEADER CELLS
       $styleArray = array(
           'font'  => array(
               'bold'  => true
            )
       );
       $object->getActiveSheet()->getStyle('A2')->applyFromArray($styleArray);
       $object->getActiveSheet()->getStyle('B2')->applyFromArray($styleArray);
       $object->getActiveSheet()->getStyle('C2')->applyFromArray($styleArray);
       $object->getActiveSheet()->getStyle('D2')->applyFromArray($styleArray);
       $object->getActiveSheet()->getStyle('E2')->applyFromArray($styleArray);
       $object->getActiveSheet()->getStyle('F2')->applyFromArray($styleArray);
       $object->getActiveSheet()->getStyle('G2')->applyFromArray($styleArray);
       $object->getActiveSheet()->getStyle('H2')->applyFromArray($styleArray);

       $object->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
       $object->getActiveSheet()->getColumnDimension('C')->setWidth(5);

       $table_columns = array("Date Reported","Reported By","Incident Description","Directorate","Section","Escalated To","Possible Consequences","Mitigation Proposals");

       $column = 0;
       foreach($table_columns as $field)
       {
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);
        $column++;
       }

       $postData = $this->input->post();

       //var_dump($postData); die();
       $alldata = $this->incident_model->fetchReportData($postData);

       $excel_row = 3;

       foreach($alldata as $row)
       {
           $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, date("d-m-Y", strtotime($row->date_reported)));

           //convert reporter ID to its equivalent name/email
           $get_data = $this->user_model->get_user_email($row->reporter_id)->result();  
           foreach($get_data as $value)  
           {  
              $reporter_id = $value->email;  
           }
           $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $reporter_id);      

           $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->description);

           //Directorate             
           //CONVERT DIRECTORATE ID TO NAME
           $get_data = $this->directorate_model->get_directorate_name( $row->directorate_id)->result();  
           foreach($get_data as $value) 
           {  
              $directorate_id = $value->directorate_name;  
           }
           $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $directorate_id);

           // Section 
           //CONVERT SECTION ID TO NAME
           $get_data = $this->section_model->get_section_name($row->section_id)->result();  
           foreach($get_data as $value)  
           {  
              $section_id = $value->section_name;  
           }
           $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $section_id);

           //ESCALATED TO
           //convert esc user ID to its equivalent name/email
           $get_data = $this->user_model->get_user_email($row->esc_user_id)->result();  
           foreach($get_data as $value)  
           {  
              $esc_user_id = $value->email;  
           }
           $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $esc_user_id);   

            // POSSIBLE CONSEQUENCES
            $incident_id = $row->id;  $consequences_list='';  $sno=1;
            $consequences_datas = $this->consequences_model->getIncidentConsequences($incident_id); 
            foreach($consequences_datas->result_array() as $rows){
               $consequences_list .=  $sno.'. '.$rows['description'].''.PHP_EOL;
               $sno++;
            } 
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,  $consequences_list); 

            // MITIGATIONS
            $incident_id = $row->id;  $mitigation_list='';  $sno=1;
            $mitigation_datas = $this->mitigation_model->getIncidentMitigation($incident_id); 
            foreach($mitigation_datas->result_array() as $rows){
               $mitigation_list .=  $sno.'. '.$rows['description'].''.PHP_EOL;
               $sno++;
            } 
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,  $mitigation_list);                    
            $excel_row++;
       }

       $filename = 'Incident Report_'.date('Ymd').'.xls'; 
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
    

    public function incidentList(){
       // POST data
       $postData = $this->input->post();
       // Get data
       $data = $this->incident_model->getIncidentList($postData);
       //var_dump($postData); die();
       echo json_encode($data);
    }



    public function email_incident_notification($to_email,$description_name){     
        $address_to = ucfirst(str_replace("."," ",$to_email));
        //Start Body structrure
        $body_msg = '
              <html>
                <head>
                    <title>'.APPLICATION_CLIENT_RMU.'</title>
                </head>
                <body>
                    <p>Hello <b>'.$address_to.',</b><br>
                     A new incident has been successfully reported for review.<br>
                    <b>Incident description:</b>    '.$description_name.' <br>
                    Please login <a href="'.APPLICATION_LINK.'">here</a> to review it further.
                    </p>
                    <p><b>Regards,</b></br>
                    '.APPLICATION_CLIENT_RMU.'</p>
                </body>
            </html>';
        //End Body structrure

        $email_subject = 'Notification for a New Reported Incident'; 

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
        $this->email->from('no-reply@tcra.go.tz',APPLICATION_NAME_ABBREVIATION);
        //$this->email->to('agape.kamagenge'.'@tcra.go.tz');
        $this->email->to($to_email.'@tcra.go.tz');

        $this->email->cc('napalite.magingo@tcra.go.tz, peter.lyimo@tcra.go.tz, nikola.mgalla@tcra.go.tz, joseph.zebedayo@tcra.go.tz');
        //$this->email->cc('agape.kamagenge@tcra.go.tz, auckland.lauwo@tcra.go.tz');
        $this->email->subject($email_subject);
        $this->email->message($body_msg);

        if($this->email->send()){                      
            echo 'A New Incident has been reported and an Email has been sent. ';
        }else{
            echo 'A New Incident has been reported, but Email failed to send.';
        }
    }


}