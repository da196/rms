<?php  
 // use PhpOffice\PhpSpreadsheet\Spreadsheet;
 // use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 // ob_start(); 
 // require(APPPATH . 'vendor/autoload.php'); 

// define('WP_DEBUG_DISPLAY', false);
// @ini_set('display_errors',0);

 defined('BASEPATH') OR exit('No direct script access allowed');  
 class KeyRiskIndicator extends CI_Controller {  

      // INITILIAZATIONS
      function __construct(){
        parent::__construct();
        $this->load->model('Directorate_Model','directorate_model');
        $this->load->model('KeyRiskIndicators_Model','keyriskindicators_model');
        $this->load->model('Objectives_Model');
        $this->load->model('Risk_Model','risk_model');
        $this->load->model('CatalogsObjectives_Model','catalogsobjectives_model');
        $this->load->model('Registry_Model','registry_model');

        $this->load->model('Year_Model','year_model');
        $this->load->model('Quarter_Model','quarter_model');


      }

     // Default landing page
      function index(){ 
          $this->load->view('include/header');         
          // $data['alldirectorates'] = $this->directorate_model->get_directorate()->result();   
          $data['organizationobjectives'] = $this->catalogsobjectives_model->get_strategic_objectives()->result();
          $data['riskowners'] = $this->risk_model->get_risk_owners()->result();
          $data['title'] = 'Key Risk Indicator';
          $data['subtitle'] = 'Create';

          $data['list_year'] = $this->year_model->getAll_years();
          $data['list_quarter'] = $this->quarter_model->getAll_quarters();

          $this->load->view('kri/keyriskindicator_create', $data);
          $this->load->view('include/footer');  //footnote    
          $this->load->view('include/jsfiles'); //all included JS Files
          $this->load->view('kri/keyriskindicator_create_custom'); //custom JS manipulations for this page
      }  

      function action(){   
          // date_default_timezone_set('Africa/Dar_es_Salaam');
          // $format = "%Y-%m-%d %H:%i %s";   
          $date = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
          $today = $date->format('Y-m-d H:i:s');     
      
          // Add Action
          if($_POST["action"] == "Add")  
          {  
              $insert_data = array(  
                   // 'directorate'         =>     $this->input->post('directorate'),  
                   'risk_owner'         =>     $this->input->post("risk_owner"),  
                   //'objective_id'  =>     $this->input->post("objective_id"),
                   'main_activity'         =>     $this->input->post('main_activity'),  
                   'key_performance_indicator' =>  $this->input->post("key_performance_indicator"),  
                   'resources'  =>     $this->input->post("resources"),
                   //'risk_measurement'  =>     $this->input->post("risk_measurement"),
                   'kri_green_definition'  =>     $this->input->post("kri_green_definition"),
                   'kri_amber_definition'  =>     $this->input->post("kri_amber_definition"),
                   'kri_red_definition'  =>     $this->input->post("kri_red_definition"),
                   'date_created'=> $today,
                   'is_draft' => 0
              );   
              $this->keyriskindicators_model->insert($insert_data);  

              $last_insert_id = $this->db->insert_id();//LAST INSERTED kri id
              $activerecord = 1;
              $objective_ids = $this->input->post("objective_id");
              //var_dump($objective_ids); die();
              for($i=0;$i<count($objective_ids);$i++){
                $objective_id = $objective_ids[$i];
                $this->keyriskindicators_model->multisave_kri_objective($last_insert_id,$objective_id,$today,$activerecord);    
              }
              echo 'You have successfuly submitted key Risk Indicator';  
          }  

          // Save As Draft Action
          if($_POST["action"] == "SaveAsDraft")  
          {  
         
              $saveasdraft_data = array(  
                   'risk_owner'         => $this->input->post("risk_owner")?$this->input->post("risk_owner"):'', 
                   'main_activity' =>  $this->input->post('main_activity')?$this->input->post('main_activity'):' ',  
                   'key_performance_indicator' =>$this->input->post("key_performance_indicator")?$this->input->post("key_performance_indicator"):' ',  
                   'resources'  => $this->input->post("resources")?$this->input->post("resources"):' ',
                   'kri_green_definition'  =>$this->input->post("kri_green_definition")?$this->input->post("kri_green_definition"):' ',
                   'kri_amber_definition'  =>$this->input->post("kri_amber_definition")?$this->input->post("kri_amber_definition"):' ',
                   'kri_red_definition'  =>$this->input->post("kri_red_definition")?$this->input->post("kri_red_definition"):' ',
                   'date_created'=> $today,
                   'is_draft' => 1
                   
                   
                   //'is_assessed' => '404' //404 is saved as a draft //its waiting to be saved as complete
              );

                
              // echo '<pre>';
              // print_r($this->input->post("risk_owner"));
              // echo  '</pre>';    
              //var_dump($this->input->post("risk_owner"));      
              //die();
              $this->keyriskindicators_model->insert($saveasdraft_data);  

             

              $last_insert_id = $this->db->insert_id();//LAST INSERTED kri id
              $activerecord = 1;
              $objective_ids = $this->input->post("objective_id");
              if( isset($objective_ids) ){
                for($i=0;$i<count($objective_ids);$i++){
                  $objective_id = $objective_ids[$i];
                  $this->keyriskindicators_model->multisave_kri_objective($last_insert_id,$objective_id,$today,$activerecord);    
                }
              }              
              echo 'You have successfuly submitted key Risk Indicator as a draft';  
          }  

           // Edit Action
           if($_POST["action"] == "Edit")  
           {                   
              $updated_data = array(  
                   'risk_owner'         =>     $this->input->post("risk_owner"),
                   'main_activity'         =>     $this->input->post('main_activity'),  
                   'key_performance_indicator' =>  $this->input->post("key_performance_indicator"),  
                   'resources'  =>     $this->input->post("resources"),
                   'kri_green_definition'  =>     $this->input->post("kri_green_definition"),
                   'kri_amber_definition'  =>     $this->input->post("kri_amber_definition"),
                   'kri_red_definition'  =>     $this->input->post("kri_red_definition"),
                   //'date_updated' => @mdate($format) //uses date helper
                   'date_updated'=> $today,
                   'is_draft' => 0
              );  
              $this->keyriskindicators_model->update($this->input->post("keyriskindicators_id"), $updated_data);  
              echo 'You have successfuly submitted key Risk Indicator';  
           }  

           // Assess Action
           if($_POST["action"] == "Assess")  
           {      
              
              if($this->input->post("kri_green_assessment") == NULL){
                $kri_green_assessment = '';
              }else{
                $kri_green_assessment = $this->input->post("kri_green_assessment");
              }

              if($this->input->post("kri_amber_assessment") == NULL){
                $kri_amber_assessment = '';
              }else{
                $kri_amber_assessment = $this->input->post("kri_amber_assessment");
              }

              if($this->input->post("kri_red_assessment") == NULL){
                $kri_red_assessment = '';
              }else{
                $kri_red_assessment = $this->input->post("kri_red_assessment");
              }

              $year = $this->input->post("year");
              $quarter = $this->input->post("quarter");

               // Print_r ($_SESSION);
               // die();
              $assessment_data = array(  
                   // 'directorate'         =>     $this->input->post('directorate'),  
                   //'risk_owner'         =>     $this->input->post("risk_owner"),  
                   //'objective_id'  =>     $this->input->post("objective_id"),
                   //'main_activity'         =>     $this->input->post('main_activity'),  
                  // 'key_performance_indicator' =>  $this->input->post("key_performance_indicator"),  
                  // 'resources'  =>     $this->input->post("resources"),
                   //'risk_measurement'  =>     $this->input->post("risk_measurement"),
                  // 'kri_green_definition'  =>     $this->input->post("kri_green_definition"),
                   //'kri_amber_definition'  =>     $this->input->post("kri_amber_definition"),
                   //'kri_red_definition'  =>     $this->input->post("kri_red_definition"),

                   'kri_id'  =>     $this->input->post("keyriskindicators_id"),                

                   'year'  =>    $year,
                   'quarter'  =>    $quarter,

                   'kri_green_assessment'  =>     $kri_green_assessment,
                   'kri_amber_assessment'  =>     $kri_amber_assessment,
                   'kri_red_assessment'  =>     $kri_red_assessment,
                   //'date_updated' => @mdate($format) //uses date helper
                   'assessment_date'=> $today,
                   'assessed_by'=> $_SESSION['username'],
                   'date_created'=> $today           
              );  

              //$this->keyriskindicators_model->insert_assessment($assessment_data);
              if($this->keyriskindicators_model->insert_assessment($assessment_data)){
                 echo 'You have successfuly assessed key Risk Indicator';  
              }
              
           }  

           // Soft Delete Action 
           // Change active from 1 to 0
           if($_POST["action"] == "SoftDelete")  
           { 
              $updated_data = array(  
                   'active' => 0,
                   'date_updated'=> $today
              );  
           
              $this->keyriskindicators_model->update($this->input->post("keyriskindicators_id"), $updated_data);  
              echo 'You have successfully deleted key Risk Indicator';  
           }  
      }

      //Pull data(and creates a table like view) whereby active=1
      function fetch(){  
           $fetch_data = $this->keyriskindicators_model->make_datatables();   
           $data = array();    

           $no = 1; 
           foreach($fetch_data as $row)  
           {                  
                $sub_array = array(); 

                //$sub_array[] = $row->id;   
                //$sub_array[] =  $no++;
              
                //convert Directorate ID to its equivalent name
                // $get_data = $this->directorate_model->get_directorate_name($row->directorate)->result();  
                // // $sub_array[] = json_encode($get_data);  
                // //$sub_array[] = json_encode($row);  
                // foreach($get_data as $value)  
                // {  
                //    $sub_array[] = $value->directorate_name;  
                // }   

                //convert risk owner ID to its equivalent name
                $get_data = $this->risk_model->get_risk_owners_name($row->risk_owner)->result();  
                foreach($get_data as $value)  
                {  
                   $sub_array[] = $value->name;  
                } 

                //$sub_array[] = $row->objective_id; 
                //convert Objective ID to its equivalent code
                $get_data = $this->catalogsobjectives_model->get_objective_code($row->objective_id)->result();  
                //$sub_array[] = json_encode($get_data);  
                //$sub_array[] = json_encode($row);  
                foreach($get_data as $value)  
                {  
                   $sub_array[] = $value->code;  
                }

                $sub_array[] = $row->main_activity; 
                $sub_array[] = $row->key_performance_indicator;  
                $sub_array[] = $row->resources;   
                
                 
                // $sub_array[] = $row->risk_measurement; 
                $sub_array[] = $row->kri_green_definition; 
                $sub_array[] = $row->kri_amber_definition; 
                $sub_array[] = $row->kri_red_definition; 

                $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-default btn-xs viewkeyriskindicators"><i class="fa fa-list"></i>&nbsp;View</button>&nbsp;<button type="button" name="update" id="'.$row->id.'" class="btn btn-default btn-xs updatekeyriskindicators"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="button" name="delete" id="'.$row->id.'" class="btn btn-default btn-xs softdeletekeyriskindicators"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                $data[] = $sub_array; 
           }  
           
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->keyriskindicators_model->get_all_data(),  
               "recordsFiltered"     =>     $this->keyriskindicators_model->get_filtered_data(),  
               "data"                =>     $data  
           );  
           echo json_encode($output);  //change Associative array to JSON
           //var_dump($output); //die();
      } 

      function fetch_one()  
      {  
           $output = array();  
           $this->load->model("keyriskindicators_model");  
           $data = $this->keyriskindicators_model->fetch_one($_POST["keyriskindicators_id"]);  
      

           foreach($data as $row)  
           {  
                $output['id'] = $row->id; 

                //convert Directorate ID to its equivalent name
                // $get_data = $this->directorate_model->get_directorate_name($row->directorate)->result();  
                // foreach($get_data as $value)  
                // {  
                //    $output['directorateNAME'] = $value->directorate_name;  
                // } 
                // $output['directorate'] = $row->directorate;  
             
                $output['risk_owner'] = $row->risk_owner; 

            

                //pull all objectives for this record ..data on separate table
                $getkriobjectives = $this->catalogsobjectives_model->get_kri_objectives($row->id)->result();
                //loop through them to get their id
                $allobjectives=array();
                foreach($getkriobjectives as $getkriobjective)  
                {
                  array_push($allobjectives, $getkriobjective->objective_id);
                }  
                $output['objective_id'] = $allobjectives;
   

             
                $output['main_activity'] = $row->main_activity;  
                $output['key_performance_indicator'] = $row->key_performance_indicator; 
                $output['resources'] = $row->resources;  
                //$output['risk_measurement'] = $row->risk_measurement;      
                $output['kri_green_definition'] = $row->kri_green_definition;   
                $output['kri_amber_definition'] = $row->kri_amber_definition;   
                $output['kri_red_definition'] = $row->kri_red_definition;   

                //echo "<pre>" . print_r($output). "</pre>";
           }  

           //die();
           echo json_encode($output);  
      }       


      function delete_one()  
      {  
           $this->load->model("keyriskindicators_model");  
           $this->keyriskindicators_model->delete_one($_POST["keyriskindicators_id"]);  
           echo "Selected Key Risk Indicator has been Deleted Successfully";  
      }

      /** ASSESS SUB-MENU FUNCTIONS **/

      //LANDING PAGE FOR ASSESS SUB-MENU
      public function assess(){ 
        $this->load->view('include/header');         
        // $data['alldirectorates'] = $this->directorate_model->get_directorate()->result();   
        $data['organizationobjectives'] = $this->catalogsobjectives_model->get_strategic_objectives()->result();
        $data['riskowners'] = $this->risk_model->get_risk_owners()->result();

        //fetch all system defined quarters
        //fetch quarters from erms_kri_assessment
        //display quarters left for a specific year

        $data['years'] = $this->year_model->getAll_years()->result();
        $data['quarters'] = $this->quarter_model->getAll_quarters()->result();


        $data['title'] = 'Key Risk Indicator';
        $data['subtitle'] = 'Assess';
        $this->load->view('kri/keyriskindicator_assess', $data);
        $this->load->view('include/footer');  //footnote    
        $this->load->view('include/jsfiles'); //all included JS Files
        $this->load->view('kri/keyriskindicator_assess_custom'); //custom JS manipulations for this page
      }

      public function fetch_assess(){  
           $fetch_data = $this->keyriskindicators_model->make_datatables_assess();   
           $data = array();    

           $no = 1; 
           foreach($fetch_data as $row)  
           {                  
                $sub_array = array(); 

                //$sub_array[] = $row->id;   
                //$sub_array[] =  $no++;
              
                //convert Directorate ID to its equivalent name
                // $get_data = $this->directorate_model->get_directorate_name($row->directorate)->result();  
                // // $sub_array[] = json_encode($get_data);  
                // //$sub_array[] = json_encode($row);  
                // foreach($get_data as $value)  
                // {  
                //    $sub_array[] = $value->directorate_name;  
                // }   

                //convert risk owner ID to its equivalent name
                $get_data = $this->risk_model->get_risk_owners_name($row->risk_owner)->result();  
                foreach($get_data as $value)  
                {  
                   $sub_array[] = $value->name;  
                } 

                //$sub_array[] = $row->objective_id; 
                //convert Objective ID to its equivalent name
                //$get_data = $this->catalogsobjectives_model->get_objective_code($row->objective_id)->result();  
                //$sub_array[] = json_encode($get_data);  
                //$sub_array[] = json_encode($row);  
                // foreach($get_data as $value)  
                // {  
                //    $sub_array[] = $value->code;  
                // }

                $sub_array[] = $row->main_activity; 
                $sub_array[] = $row->key_performance_indicator;  
                $sub_array[] = $row->resources;   
                
                 
                // $sub_array[] = $row->risk_measurement; 
                $sub_array[] = $row->kri_green_definition; 
                $sub_array[] = $row->kri_amber_definition; 
                $sub_array[] = $row->kri_red_definition; 

                $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-default btn-xs assesskeyriskindicators"><i class="fa fa-paste"></i>&nbsp;Assess</button>';
                $data[] = $sub_array; 
           }  
           
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->keyriskindicators_model->get_all_data(),  
               "recordsFiltered"     =>     $this->keyriskindicators_model->get_filtered_data(),  
               "data"                =>     $data  
           );  
           //var_dump($output); die();
           echo json_encode($output);  //change Associative array to JSON
           //var_dump($output); //die();
      } 

      public function fetch_one_assess()  
      {  
           $output = array();  
           $this->load->model("keyriskindicators_model");  
           $data = $this->keyriskindicators_model->fetch_one($_POST["keyriskindicators_id"]);  
           foreach($data as $row)  
           {  
                $output['id'] = $row->id; 

                //convert Directorate ID to its equivalent name
                // $get_data = $this->directorate_model->get_directorate_name($row->directorate)->result();  
                // foreach($get_data as $value)  
                // {  
                //    $output['directorateNAME'] = $value->directorate_name;  
                // } 
                // $output['directorate'] = $row->directorate;  

             
                $output['risk_owner'] = $row->risk_owner; 

                // $get_data = $this->catalogsobjectives_model->get_objective_name($row->objective_id)->result();   
                // foreach($get_data as $value)  
                // {  
                //    $output['objectiveNAME'] = $value->name;  
                // }
                $output['objectiveNAME'] = 'testtest';

                //pull all objectives for this record ..data on separate table
                $getkriobjectives = $this->catalogsobjectives_model->get_kri_objectives($row->id)->result();
                //loop through them to get their id
                $allobjectives=array();
                foreach($getkriobjectives as $getkriobjective)  
                {
                  array_push($allobjectives, $getkriobjective->objective_id);
                }  
                $output['objective_id'] = $allobjectives;
                //$output['objective_id'] = $row->objective_id; 

                
                $output['main_activity'] = $row->main_activity;  
                $output['key_performance_indicator'] = $row->key_performance_indicator; 
                $output['resources'] = $row->resources;  
                //$output['risk_measurement'] = $row->risk_measurement;      
                $output['kri_green_definition'] = $row->kri_green_definition;   
                $output['kri_amber_definition'] = $row->kri_amber_definition;   
                $output['kri_red_definition'] = $row->kri_red_definition;   

                $kri_id = $row->id;
                $output['isYearPresent'] =  $this->keyriskindicators_model->getYearOfKRIAssessment($kri_id);  
                if($output['isYearPresent']==true){
                  $getyears = $this->keyriskindicators_model->getAllYearsOfKRIAssessment($kri_id);             
                  $no = 1;
                  $allassessment = array();
                  foreach($getyears as $getyear)  
                  {   
                      $assessment = array( // array structure for batch insert method.                 
                             'year' => $getyear->year,
                             'quarter' => $getyear->quarter,
                             'green'=>$getyear->kri_green_assessment,
                             'amber'=>$getyear->kri_amber_assessment,
                             'red'=>$getyear->kri_red_assessment,               
                      );  

                      array_push($allassessment, $assessment); 
                      $no++;                                  
                  }  
                  $output['alldata'] = $allassessment;
                  // echo "<pre>";
                  // print_r($allassessment);   
                  // echo "</pre>";         
                }
           }  
           echo json_encode($output);  
      } 

      /** VIEW SUB-MENU FUNCTIONS **/
      //LANDING PAGE FOR ASSESS SUB-MENU
      public function view(){ 
        $this->load->view('include/header');         
        // $data['alldirectorates'] = $this->directorate_model->get_directorate()->result();   
        $data['organizationobjectives'] = $this->catalogsobjectives_model->get_strategic_objectives()->result();
        $data['riskowners'] = $this->risk_model->get_risk_owners()->result();
        $data['title'] = 'Key Risk Indicator';
        $data['subtitle'] = 'View';
        $this->load->view('kri/keyriskindicator_view', $data);
        $this->load->view('include/footer');  //footnote    
        $this->load->view('include/jsfiles'); //all included JS Files
        $this->load->view('kri/keyriskindicator_view_custom'); //custom JS manipulations for this page
      }

      public function fetch_view(){  
           $fetch_data = $this->keyriskindicators_model->make_datatables();

           // var_dump($fetch_data);
           // die();
           $data = array();  
           $no = 1; 
           foreach($fetch_data as $row)  
           {                  
                $sub_array = array(); 
                //$sub_array[] = $row->id;
                $kri_id = $row->id;   
                //$sub_array[] =  $no++;
              
                //convert Directorate ID to its equivalent name
                // $get_data = $this->directorate_model->get_directorate_name($row->directorate)->result();  
                // // $sub_array[] = json_encode($get_data);  
                // //$sub_array[] = json_encode($row);  
                // foreach($get_data as $value)  
                // {  
                //    $sub_array[] = $value->directorate_name;  
                // }   

                //convert risk owner ID to its equivalent name
                $get_data = $this->risk_model->get_risk_owners_name($row->risk_owner)->result();  
                foreach($get_data as $value)  
                {  
                   $sub_array[] = $value->name;  
                }
                 

                //$sub_array[] = $row->objective_id; 
                //convert Objective ID to its equivalent name
                //$get_data = $this->catalogsobjectives_model->get_objective_code($row->objective_id)->result();  
                //$sub_array[] = json_encode($get_data);  
                //$sub_array[] = json_encode($row);  
                // foreach($get_data as $value)  
                // {  
                //    $sub_array[] = $value->code;  
                // }

                $sub_array[] = $row->main_activity; 
                $sub_array[] = $row->key_performance_indicator;  
                $sub_array[] = $row->resources;   
                
                 
                // $sub_array[] = $row->risk_measurement; 
                // $sub_array[] = $row->kri_green_definition; 
                // $sub_array[] = $row->kri_amber_definition; 
                // $sub_array[] = $row->kri_red_definition;   

                //FETCH LATEST GREEN + AMBER + RED ASSESSMENT
                $getlatestassessments = $this->keyriskindicators_model->getLatestAssessment($kri_id);  
                if($getlatestassessments == FALSE){
                    $sub_array[] = '-'; 
                    $sub_array[] = '-';  
                    $sub_array[] = '-'; 
                }else{
                    foreach($getlatestassessments as $getlatestassessment)  
                    {  
                        if($getlatestassessment->kri_green_assessment != ''){
                          $sub_array[] = $getlatestassessment->kri_green_assessment; 
                          $sub_array[] = '-'; 
                          $sub_array[] = '-'; 
                        }elseif ($getlatestassessment->kri_amber_assessment != '') {
                          $sub_array[] = '-'; 
                          $sub_array[] = $getlatestassessment->kri_amber_assessment;  
                          $sub_array[] = '-'; 
                        }elseif($getlatestassessment->kri_red_assessment != ''){
                          $sub_array[] = '-'; 
                          $sub_array[] = '-';  
                          $sub_array[] = $getlatestassessment->kri_red_assessment; 
                        }else{
                          $sub_array[] = '-'; 
                          $sub_array[] = '-';  
                          $sub_array[] = '-'; 
                        }
                    }
                }

                //IF SAVED AS DRAFT SHOW "COMPLETE" AND "DELETE" BUTTONS 
                //LATEST MEANS LATE DATA ENTERED FROM THE SYSTEM UI
                if($row->is_draft == 1){   
                  $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-default btn-xs updatekeyriskindicators"><i class="fa fa-save"></i>&nbsp;Complete</button>&nbsp;<button type="button" name="delete" id="'.$row->id.'" class="btn btn-default btn-xs softdeletekeyriskindicators"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                }else{ //SHOW "VIEW" BUTTON
                   $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-default btn-xs viewkeyriskindicators"><i class="fa fa-list"></i>&nbsp;View</button>&nbsp;<button type="button" name="delete" id="'.$row->id.'" class="btn btn-default btn-xs softdeletekeyriskindicators"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                }

              

                // $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-default btn-xs viewkeyriskindicators"><i class="fa fa-list"></i>&nbsp;View</button>&nbsp;<button type="button" name="update" id="'.$row->id.'" class="btn btn-default btn-xs updatekeyriskindicators"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="button" name="delete" id="'.$row->id.'" class="btn btn-default btn-xs softdeletekeyriskindicators"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                $data[] = $sub_array; 
           }  
           
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->keyriskindicators_model->get_all_data(),  
               "recordsFiltered"     =>     $this->keyriskindicators_model->get_filtered_data(),  
               "data"                =>     $data
           );  
           echo json_encode($output);  //change Associative array to JSON
           // var_dump($output); 
           // echo "<pre>" . print_r($output) . "</pre>";
           // die();
      } 

      // ON CLICKING VIEW BUTTON
      public function fetch_one_view()  
      {  
           $output = array();  
           $this->load->model("keyriskindicators_model");  
           $data = $this->keyriskindicators_model->fetch_one($_POST["keyriskindicators_id"]);  
           foreach($data as $row)  
           {  
                $output['id'] = $row->id; 

                //convert Directorate ID to its equivalent name
                // $get_data = $this->directorate_model->get_directorate_name($row->directorate)->result();  
                // foreach($get_data as $value)  
                // {  
                //    $output['directorateNAME'] = $value->directorate_name;  
                // } 
                // $output['directorate'] = $row->directorate;  

                //convert risk owner ID to its equivalent name
                $get_data = $this->risk_model->get_risk_owners_name($row->risk_owner)->result();  
                foreach($get_data as $value)  
                {  
                   $output['risk_owner'] = $value->name;  
                } 

                $allobjectives='';
                //pull all objectives for this record ..data on separate table
                $getkriobjectives = $this->catalogsobjectives_model->get_kri_objectives($row->id)->result();  
                //loop through them to get their names
                $x=1; $allobjectives='';
                foreach($getkriobjectives as $getkriobjective)  
                {
                  //for($x=1;$x<=count($getkriobjectives);$x++){
                    $get_data = $this->catalogsobjectives_model->get_objective_name($getkriobjective->objective_id)->result();
                    foreach($get_data as $value)  
                    {  
                       //$output['objectiveNAME'] = $value->name;  
                      
                       $allobjectives .= $x.'.'.$value->name.''.PHP_EOL;  
                       //$allobjectives =$value->name; 
                       $x++;  
                    }                  
                  //}
                }
                $output['objectiveNAME'] = $allobjectives;
                //$output['objective_id'] = $row->objective_id;

                //$output['objective_id'] = $row->objective_id; 
                $output['main_activity'] = $row->main_activity;  
                $output['key_performance_indicator'] = $row->key_performance_indicator; 
                $output['resources'] = $row->resources;  
                //$output['risk_measurement'] = $row->risk_measurement;      
                $output['kri_green_definition'] = $row->kri_green_definition;   
                $output['kri_amber_definition'] = $row->kri_amber_definition;   
                $output['kri_red_definition'] = $row->kri_red_definition;   

                // $output['kri_green_value'] = $row->kri_green_value;   
                // $output['kri_amber_value'] = $row->kri_amber_value;   
                // $output['kri_red_value'] = $row->kri_red_value; 

               $kri_id = $row->id;
               $output['isYearPresent'] =  $this->keyriskindicators_model->getYearOfKRIAssessment($kri_id);  
                if($output['isYearPresent']==true){
                  $getyears = $this->keyriskindicators_model->getAllYearsOfKRIAssessment($kri_id);             
                  $no = 1;
                  $allassessment = array();
                  foreach($getyears as $getyear)  
                  {   
                      $assessment = array( // array structure for batch insert method.                 
                             'year' => $getyear->year,
                             'quarter' => $getyear->quarter,
                             'green'=>$getyear->kri_green_assessment,
                             'amber'=>$getyear->kri_amber_assessment,
                             'red'=>$getyear->kri_red_assessment,               
                      );  
                      array_push($allassessment, $assessment); 
                      $no++;                                  
                  }  
                  $output['alldata'] = $allassessment;
                } 
           }  
           echo json_encode($output);  
      } 

      /** REPORTS SUB-MENU FUNCTIONS **/

      //LANDING PAGE FOR REPORTS SUB-MENU
      public function reports(){ 
          // $this->load->view('include/header');         
          // $data['alldirectorates'] = $this->directorate_model->get_directorate()->result();   
          // $data['strategicobjectives'] = $this->catalogsobjectives_model->get_strategic_objectives()->result();
          // $data['title'] = 'Key Risk Indicator';
          // $data['subtitle'] = 'Reports';
          // $this->load->view('keyriskindicatorreport_view', $data);
          // $this->load->view('include/footer');  //footnote    
          // $this->load->view('include/jsfiles'); //all included JS Files
          // $this->load->view('kri/indexcustom'); //custom JS manipulations for this page
      }


      // REPORTS LANDING PAGE
      public function generatereports(){
          $data['title'] = 'Key Risk Indicator';
          $data['subtitle'] = 'Reports';       

          //select all Organization objectives
          //$objectives = $this->Objectives_Model->getAll_objective();
          //$data['objectives'] = $objectives;
         // $data['organizationobjectives'] = $this->catalogsobjectives_model->get_strategic_objectives()->result();
          $data['years'] = $this->registry_model->getSystemYears()->result();
          $data['quarters'] = $this->registry_model->getSystemQuarters()->result();  

          //select all risk owners
          $riskowners =  $this->risk_model->get_risk_owners()->result();
          $data['riskowners'] = $riskowners;          

          $this->load->view('include/header');
          $this->load->view('kri/generateReports', $data);
          $this->load->view('include/footer');
          $this->load->view('include/jsfiles'); //all included JS Files
          $this->load->view('kri/generateReports_CustomJS'); //custom JS manipulations for this page
      }

      //CUSTOM SEARCH AND DOWNLOAD EXCEL
      public function ExcelReport(){  
          $this->load->library("excel");
          $object = new PHPExcel();

          $object->setActiveSheetIndex(0);

          // BOLD HEADER CELLS
          $styleArray = array(
              'font'  => array(
                  'bold'  => true
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

          $object->getActiveSheet()->getStyle('G3')->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '008000')
                  ),
                  'font'  => array(
                      'bold'  => true,
                   )
              )
          );
          $object->getActiveSheet()->getStyle('H3')->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => 'ffbf00')
                  ),
                  'font'  => array(
                      'bold'  => true,
                   )                  
              )
          );
          $object->getActiveSheet()->getStyle('I3')->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => 'FF0000')
                  ),
                  'font'  => array(
                      'bold'  => true,
                   )
              )
          );

          foreach(range('A','I') as $columnID) {
              $object->getActiveSheet()->getColumnDimension($columnID)
                  ->setAutoSize(true);
          }  

          //name the worksheet
          //$object->getActiveSheet()->setTitle('Key Risk Indicator');
          //set cell A1 content with some text
          $object->getActiveSheet()->setCellValue('A1', 'Key Risk Indicator');
          //merge cell A1 until D1
          $object->getActiveSheet()->mergeCells('A1:I1'); 
          //set aligment to center for that merged cell (A1 to D1)
          $object->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
          $object->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);         


          $table_columns = array("S/N", "Risk Owner", "Strategic Objective", "Main Activity", "Key Performance Indicator (KPI)", "Resources","Green","Amber","Red");

          $column = 0;

          foreach($table_columns as $field)
          {
           $object->getActiveSheet()->setCellValueByColumnAndRow($column, 3, $field);
           $column++;
          }

          $postData = $this->input->post();

          $alldata = $this->keyriskindicators_model->fetchReportData($postData);

          $excel_row = 4;

          $sn  = (int) 1;
          //$sn = 1;
          


          foreach($alldata as $row)
          {
            //var_dump($sn);
            // ROW ONE - WITH DEFINITIONS
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, '');
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, '');
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, '');
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, '');
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, '');
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, '');
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->kri_green_definition);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->kri_amber_definition); 
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->kri_red_definition);  
            $excel_row++;
            // // ROW TWO - WITH VALUES
            // $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, '#'.$sn);
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sn);
             //convert risk owner id to its name
            $get_data = $this->risk_model->get_risk_owners_name($row->risk_owner)->result();  
            foreach($get_data as $value)  
            {  
                $risk_owner = $value->name;  
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $risk_owner);
            }  
            //convert objective id id to its code
            //DISPLAY OBJECTIVES WITH SEPARATED COMMMAS    
            $allobjectivescode = $prefix = '';
            $get_data = $this->catalogsobjectives_model->get_kri_objectives($row->id)->result(); 
            foreach($get_data as $value)  
            { 
                $objectiveID = $value->objective_id;
                $objectivescodes = $this->catalogsobjectives_model->get_objective_code($objectiveID)->result();    
                foreach ($objectivescodes as $objectivescode){
                    $allobjectivescode .= $prefix . '' . $objectivescode->code . '';
                    $prefix = ', ';
                } 
            }
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $allobjectivescode);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->main_activity);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->key_performance_indicator);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->resources);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->kri_green_assessment);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->kri_amber_assessment); 
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->kri_red_assessment);            
            $excel_row++;
            $sn++;
          }
          // die();
          // echo "<pre>";
          // echo print_r($allobjectivescode); 
          // echo "</pre>";
          // die();

          $filename = 'Key Risk Indicator_'.date('Ymd').'.xls'; 
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

      public function keyRiskIndicatorList(){
        // POST data
        $postData = $this->input->post();
        // Get data
        $data = $this->keyriskindicators_model->getKeyRiskIndicators($postData);
        echo json_encode($data);
      }



 }  