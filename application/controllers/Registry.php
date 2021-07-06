<?php
require APPPATH.'libraries/Quarter.php';

class Registry extends CI_Controller{

    public function __construct(){
        parent::__construct();  
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Objectives_Category_Model','objectives_category_model');
        $this->load->model('Objectives_Model','objectives_model');
        $this->load->model('Directorate_Model','directorate_model'); 
        $this->load->model('Impact_scale_Model','impact_scale_model');
        $this->load->model('Likehood_scale_Model','likehood_scale_model');
        $this->load->model('Effective_controls_Model','effective_controls_model');
        $this->load->model('Trends_Model','trends_model');
        $this->load->model('Year_Model','year_model');
        $this->load->model('Quarter_Model','quarter_model');
        $this->load->model('Risk_Model','risk_model');
        $this->load->model('CatalogsObjectives_Model','catalogsobjectives_model');
        $this->load->model('Registry_Model','registry_model');
        $this->load->model('Registry_Causes_Model','registry_causes_model');
        $this->load->model('Registry_Events_Model','registry_events_model');
        $this->load->model('Registry_Consequences_Model','registry_consequences_model');
        $this->load->model('Registry_Objectives_Model','registry_objectives_model');
        $this->load->model('Registry_Excontrols_Model','registry_excontrols_model');
        $this->load->model('Registry_Adcontrols_Model','registry_adcontrols_model');
        $this->load->model('Registry_History_Model','registry_history_model');
    }

   /*************  Registry Index Page **************/
   public function index(){
        // Check the session first
        // Userdata fetch data stored in the session
        $role_id = $this->session->userdata('role_id');
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');
        if($user_id!= ''){
           $data['list_objective_category'] = $this->objectives_category_model->getAll_objectiveCategory();
           $data['list_objectives'] = $this->objectives_model->getAll_objective();
           $data['list_impact_scale'] = $this->impact_scale_model->getAll_impactScale();
           $data['list_likehood_scale'] = $this->likehood_scale_model->getAll_likehoodScale();
           $data['list_eff_controls'] = $this->effective_controls_model->getAll_effectiveControls();
           $data['list_trends'] = $this->trends_model->getAll_trends();
           //$data['list_directorate'] = $this->directorate_model->get_directorate();
           $data['list_riskOwner'] = $this->risk_model->get_risk_owners();
           
           
           $data['list_year'] = $this->year_model->getAll_years();
           $data['list_quarter'] = $this->quarter_model->getAll_quarters();
           
          
           $this->load->view('include/header');
           $this->load->view('registry_create',$data);
           $this->load->view('include/footer');
           $this->load->view('include/jsfiles'); //all included JS Files
           $this->load->view('registry/indexcustom'); //custom JS manipulations for this page                
       }
       else{
           redirect(base_url().'login/login');
       }       
   }


      /*************  Registry View Page **************/
      public function view(){
         // Userdata fetch data stored in the session
         $role_id = $this->session->userdata('role');
         $user_id = $this->session->userdata('user_id');
         $username = $this->session->userdata('username');     
         if($user_id!= ''){
           // 1 as Strategic/ 2 as Operational and /3 as Project 
           $data['list_strategic_registry'] = $this->registry_model->get_registry(null,1);
           $data['list_operational_registry'] = $this->registry_model->get_registry(null,2);
           $data['list_project_registry'] = $this->registry_model->get_registry(null,3);
           $this->load->view('include/header');
           $this->load->view('registry_view',$data);
           $this->load->view('include/footer');
           $this->load->view('include/jsfiles'); //all included JS Files
           $this->load->view('registry/viewcustom'); //custom JS manipulations for this page                
         }
         else{
           redirect(base_url().'login/login');
         }       
      }


      /*******  Registry View Modal Page   ***********/

      public function view_registry(){
           $reg_id = $this->input->post('reg_id');
           $view_registry = $this->registry_model->get_registry($reg_id,null);
           $json = json_encode($view_registry->result()[0]); 
          // print_r($json); die();
           echo($json);
      }

     


      /*************  EDIT Registry // ASSESS Page **************/
      public function registry_edit($id){
           $registry_id = $this->uri->segment(3);

           $role_id = $this->session->userdata('role_id');
           $user_id = $this->session->userdata('user_id');
           $username = $this->session->userdata('username');

           $list_registry = $this->registry_model->get_registry($registry_id,null);
           if(!$list_registry->result()){
               redirect(base_url().'registry/view');
           }
           else{          
               $reg = $list_registry->result()[0];
               $data['registry_id'] = $reg->id;
               $data['activity'] = $reg->activity; 
               $data['remarks'] = $reg->rem; 
               $data['status'] = $reg->sts;
               $data['trends'] = $reg->trends;
               $data['quarter'] = $reg->quarter;
               $data['year_id'] = $reg->yr;
               

               $data['list_objective_category'] = $this->objectives_category_model->getAll_objectiveCategory();
               $data['list_objectives'] = $this->objectives_model->getAll_objective();

                $data['list_riskOwner'] = $this->risk_model->get_risk_owners();
               $data['riskowner'] = $reg->risk_owner_id;

               $data['list_causes']  = $this->registry_model->getRegistry_causes($registry_id);
               $data['list_events']  = $this->registry_model->getRegistry_events($registry_id);
               $data['list_consequences']  = $this->registry_model->getRegistry_consequences($registry_id);
               $data['list_excontrols']  = $this->registry_model->getRegistry_excontrols($registry_id);
               $data['list_adcontrols']  = $this->registry_model->getRegistry_adcontrols($registry_id);
             
               $data['objective_category'] = $reg->objective_category_id; 

               $data['list_impact_scale'] = $this->impact_scale_model->getAll_impactScale();
               $data['list_likehood_scale'] = $this->likehood_scale_model->getAll_likehoodScale();
               $data['list_eff_controls'] = $this->effective_controls_model->getAll_effectiveControls();
               $data['list_trends'] = $this->trends_model->getAll_trends();

               $data['list_year'] = $this->year_model->getAll_years();
               $data['list_quarter'] = $this->quarter_model->getAll_quarters();


               $data['impact_scale_id'] = $reg->impact_scale_id; 
               $data['like_hood_scale_id'] = $reg->like_hood_scale_id; 
               $data['controls_effectiveness_scale_id'] = $reg->controls_effectiveness_scale_id; 
              
               

               $data['magnitude'] =  (int)($data['impact_scale_id'] *  $data['like_hood_scale_id']);          
               $data['residual_risk_score'] =  (int)($data['magnitude'] / $data['controls_effectiveness_scale_id']);


               if($user_id!= ''){
                   $this->load->view('registryEdit_view',$data);
                   $this->load->view('include/jsfiles'); //all included JS Files
                   $this->load->view('registry/regeditcustom'); //custom JS manipulations for this page 
               }else{
                   redirect(base_url().'login/login');
               }  
           }     
      }


      /**
      //EDIT RISK REGISTER
      **/
      //PULL EDIT PAGE AND PLACE DATA IN IT
      public function risk_register_edit_page($id){
           $registry_id = $this->uri->segment(3);
           $role_id = $this->session->userdata('role_id');
           $user_id = $this->session->userdata('user_id');
           $username = $this->session->userdata('username');
           $list_registry = $this->registry_model->get_registry($registry_id,null);
           if(!$list_registry->result()){
               redirect(base_url().'registry/view');
           }else{          
               $reg = $list_registry->result()[0];

               $data['createdAtFromDB'] = $reg->date_created;
               $data['createdByFromDB'] = $reg->reporter_id;

               $data['registry_id'] = $reg->id;
               $data['activity'] = $reg->activity; 

               $data['remarks'] = $reg->rem; 
               $data['status'] = $reg->sts;
               $data['trends'] = $reg->trends;
               $data['quarter'] = $reg->quarter;
               $data['year_id'] = $reg->yr;
               

               $data['list_objective_category'] = $this->objectives_category_model->getAll_objectiveCategory();

               $data['list_objectives'] = $this->objectives_model->getAll_objective();

                $data['list_riskOwner'] = $this->risk_model->get_risk_owners();
               $data['riskowner'] = $reg->risk_owner_id;

               $data['list_causes']  = $this->registry_model->getRegistry_causes($registry_id);
               $data['list_events']  = $this->registry_model->getRegistry_events($registry_id);
               $data['list_consequences']  = $this->registry_model->getRegistry_consequences($registry_id);
               $data['list_excontrols']  = $this->registry_model->getRegistry_excontrols($registry_id);
               $data['list_adcontrols']  = $this->registry_model->getRegistry_adcontrols($registry_id);
             
               $data['objective_category'] = $reg->objective_category_id; 

               $data['list_impact_scale'] = $this->impact_scale_model->getAll_impactScale();
               $data['list_likehood_scale'] = $this->likehood_scale_model->getAll_likehoodScale();
               $data['list_eff_controls'] = $this->effective_controls_model->getAll_effectiveControls();
               $data['list_trends'] = $this->trends_model->getAll_trends();

               $data['list_year'] = $this->year_model->getAll_years();
               $data['list_quarter'] = $this->quarter_model->getAll_quarters();


               $data['impact_scale_id'] = $reg->impact_scale_id; 
               $data['like_hood_scale_id'] = $reg->like_hood_scale_id; 
               $data['controls_effectiveness_scale_id'] = $reg->controls_effectiveness_scale_id; 
              
               

               $data['magnitude'] =  (int)($data['impact_scale_id'] *  $data['like_hood_scale_id']);          
               $data['residual_risk_score'] =  (int)($data['magnitude'] / $data['controls_effectiveness_scale_id']);

               // echo '<pre>';
               // var_dump($data['list_causes'] );
               // echo '</pre>';

               if($user_id!= ''){
                   $this->load->view('registry/risk_register_edit',$data);
                   $this->load->view('include/jsfiles'); //all included JS Files
                   $this->load->view('registry/risk_register_edit_custom'); //custom JS manipulations for this page 
               }else{
                   redirect(base_url().'login/login');
               }  
           }     
      }

      public function delete_risk_register_causes(){
         $today = date("Y-m-d H:i:s");
         $cause_id = $this->uri->segment(3);  
         $registry_id = $this->uri->segment(4);
         $cause_reason = $this->uri->segment(5);
       
         $dt_causes = array(
             'active'=> 0,
             'date_updated'=>$today
         );
         $dt_cause_reason = array(
          'cause_id'=> $cause_id,
          'cause_reason'=>$cause_reason,
          'date_created'=>$today
         );
         $this->db->trans_start();
         $this->registry_causes_model->update_registry_causes($dt_causes,$cause_id);
         $this->registry_causes_model->insert_registry_causes_reason($dt_cause_reason);
         $this->db->trans_complete();
         if ($this->db->trans_status() === FALSE)
         {
            $this->db->trans_rollback();
            echo 'Sorry, There was a problem during cause deletion process';
         }
         else
         {
            $this->db->trans_commit();
            redirect(base_url()."registry/risk_register_edit_page/".$registry_id);
         } 
      }
      
      public function delete_risk_register_events(){
         $today = date("Y-m-d H:i:s");
         $event_id = $this->uri->segment(3);
         $registry_id = $this->uri->segment(4);
         $event_reason = $this->uri->segment(5);
         $dt_events = array(
             'active'=> 0,
             'date_updated'=>$today
         );
         $dt_event_reason = array(
          'event_id'=> $event_id,
          'event_reason'=>$event_reason,
          'date_created'=>$today
         );
        $this->db->trans_start();
        $this->registry_events_model->update_registry_events($dt_events,$event_id);
        $this->registry_events_model->insert_registry_events_reason($dt_event_reason);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
          $this->db->trans_rollback();
          echo 'Sorry, There was a problem during event deletion process';
        }
        else
        {
          $this->db->trans_commit();
          redirect(base_url()."registry/risk_register_edit_page/".$registry_id);
        }
      }

      public function delete_risk_register_consequences(){
         $today = date("Y-m-d H:i:s");
         $consequences_id = $this->uri->segment(3);
         $registry_id = $this->uri->segment(4);
         $consequence_reason = $this->uri->segment(5);

         $dt_consequences = array(
             'active'=> 0,
             'date_updated'=>$today
         );

         $dt_consequence_reason = array(
          'consequence_id'=> $consequences_id,
          'consequences_reason'=>$consequence_reason,
          'date_created'=>$today
         );

        $this->db->trans_start();

          $this->registry_consequences_model->update_registry_consequences($dt_consequences,$consequences_id);

          $this->registry_consequences_model->insert_registry_consequences_reason($dt_consequence_reason);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            echo 'Sorry, There was a problem during consequence deletion process';
        }
        else
        {
            $this->db->trans_commit();
            redirect(base_url()."registry/risk_register_edit_page/".$registry_id);
        }
      }

      public function delete_risk_register_excontrols(){
         $today = date("Y-m-d H:i:s");
         $excontrols_id = $this->uri->segment(3);
         $registry_id = $this->uri->segment(4);
         $dt_excontrols = array(
             'active'=> 0,
             'date_updated'=>$today
         );
         //print_r($cause_id); die();
         // Make the ID to 0
         $this->registry_excontrols_model->update_registry_excontrols($dt_excontrols,$excontrols_id);
         redirect(base_url()."registry/risk_register_edit_page/".$registry_id);
      }
      
       public function delete_risk_register_adcontrols(){
         $today = date("Y-m-d H:i:s");
         $adcontrols_id = $this->uri->segment(3);
         $registry_id = $this->uri->segment(4);
         $dt_adcontrols = array(
             'active'=> 0,
             'date_updated'=>$today
         );
         //print_r($cause_id); die();
         // Make the ID to 0
         $this->registry_adcontrols_model->update_registry_adcontrols($dt_adcontrols,$adcontrols_id);
         redirect(base_url()."registry/risk_register_edit_page/".$registry_id);
      }




      public function edit_risk_register(){
        $registry_id = $this->input->post("risk_registry_id");
        $list_registry = $this->registry_model->get_registry($registry_id,null);
        $data = array();  
        $sub_array = array();  
        if(!$list_registry->result()){
          redirect(base_url().'registry/view');
        }else{          
           $reg = $list_registry->result()[0];
           $sub_array['registry_id'] = $reg->id;
           $sub_array['activity'] = $reg->activity; 

           $list_objective_category = $this->objectives_category_model->getAll_objectiveCategory();
           $sub_array['list_objective_category'] = $list_objective_category->result()[0];
           //GET OBJECTIVE CATEGORY NAME

           $sub_array['objective_category'] = $reg->objective_category_id; 
           //GET OBJECTIVE CATEGORY NAME

           $sub_array['riskowner'] = $reg->risk_owner_id;
           //GET RISK OWNER NAME           

           $list_objectives = $this->objectives_model->getAll_objective();
           $sub_array['list_objectives'] = $list_objectives->result()[0];

           $list_riskOwner = $this->risk_model->get_risk_owners();
           $sub_array['list_riskOwner'] = $list_riskOwner->result()[0];

           // $list_events  = $this->registry_model->getRegistry_events($registry_id);
           // $sub_array['list_events'] = $list_events->result()[0];         

            $events_query = $this->registry_model->get_risk_register_events($registry_id);
            //LOOP AND GET ALL EVENTS FOR THE SPECIFIED RISK REGISTER ID
            foreach ($events_query->result() as $row) {
              //$row->id =  $events ;
              $list_events[] = $row;
            }
            $sub_array['list_events'] = $list_events;

            // echo "<pre>";
            // var_dump($sub_array['list_events']);
            // echo "</pre>";  

           $list_causes = $this->registry_model->getRegistry_causes($registry_id);
           $sub_array['list_causes'] = $list_causes->result()[0];           

           $list_consequences  = $this->registry_model->getRegistry_consequences($registry_id);
           $sub_array['list_consequences']  = $list_consequences->result()[0];

           $list_excontrols  = $this->registry_model->getRegistry_excontrols($registry_id);
           $sub_array['list_excontrols']  = $list_excontrols->result()[0];

           $list_adcontrols  = $this->registry_model->getRegistry_adcontrols($registry_id); 
           $sub_array['list_adcontrols']  = $list_adcontrols->result()[0];           

           $list_impact_scale = $this->impact_scale_model->getAll_impactScale();
           $sub_array['list_impact_scale'] = $list_impact_scale->result()[0];

           $list_likehood_scale = $this->likehood_scale_model->getAll_likehoodScale();
           $sub_array['list_likehood_scale'] = $list_likehood_scale->result()[0];

           $list_eff_controls = $this->effective_controls_model->getAll_effectiveControls();
           $sub_array['list_eff_controls'] = $list_eff_controls->result()[0];

           $list_trends = $this->trends_model->getAll_trends();
           $sub_array['list_trends'] = $list_trends->result()[0];

           $list_year = $this->year_model->getAll_years();
           $sub_array['list_year'] = $list_year->result()[0];

           $list_quarter = $this->quarter_model->getAll_quarters();
           $sub_array['list_quarter'] = $list_quarter->result()[0];

           $sub_array['impact_scale_id'] = $reg->impact_scale_id; 
           $sub_array['like_hood_scale_id'] = $reg->like_hood_scale_id; 
           $sub_array['controls_effectiveness_scale_id'] = $reg->controls_effectiveness_scale_id;    
           $sub_array['magnitude'] =  (int)($sub_array['impact_scale_id'] *  $sub_array['like_hood_scale_id']);          
           $sub_array['residual_risk_score'] =  (int)($sub_array['magnitude'] / $sub_array['controls_effectiveness_scale_id']); 

           $sub_array['remarks'] = $reg->rem; 
           $sub_array['status'] = $reg->sts;

           $trends_id = intval($reg->trends);
           //GET TRENDS NAME
           $get_data = $this->trends_model->get_trends_name($trends_id)->result();  
           foreach($get_data as $value)  
           {  
              $sub_array['trends'] = $value->trend_name;
           }    
           $quarter_id = intval($reg->quarter);
           //GET QUARTER NAME
           $get_data = $this->quarter_model->get_quarter_name($quarter_id)->result();  
           foreach($get_data as $value)  
           {  
              $sub_array['quarter'] = $value->quarter;
           }
           $year_id = intval($reg->yr);  
           //GET YEAR NAME
           $get_data = $this->year_model->get_year_name($year_id)->result();  
           foreach($get_data as $value)  
           {  
              $sub_array['year'] = $value->year;
           }
           $data[] = $sub_array; 
           echo json_encode($data); 
        }     
      }

     


      //UPDATE RECORDS OF RISK REGISTER VIA AJAX
      // public function update_risk_register(){
      //  // Quarterly Evaluation Register            
      //  /******** START TRANSACTION ****************/
      //  $this->db->trans_start();
      //  $today = date("Y-m-d");
      //  $registryId = $this->input->post('registry_id');
      //  // $remarks = $this->input->post('remarks');
      //  // $status = $this->input->post('status');
      //  // $trends = $this->input->post('trends');        
      //  // $quarter = $this->input->post('quarter');
      //  // $year = $this->input->post('year');
      //  // START Insert Remarks PART
      //  // ACTIVE_CODE = 1 while searching ...
      //  $searchErms_history = $this->registry_history_model->search_registry_history($registryId,$quarter,$year,null);   
      //  //$history = $searchErms_history->result()[0];
      //  //print_r($history); die();
      //  $dt_registry_history = array(
      //      'risk_registry_id'=> $registryId,
      //      'remarks'=> $remarks, 
      //      'status'=> $status,  
      //      'trends_id'=> $trends,                   
      //      'date_created'=>$today,
      //      'quarter_id'=>$quarter,
      //      'year_id'=>$year,
      //      'active_code'=>1
      //      );              
      //  if($searchErms_history->num_rows() <= 0){
      //      // UPDATE ON SPECIFIC RISK_REGISTER ID AS ACTIVE FOR VIEW PURPOSE
      //      $searchErms_risk_history = $this->registry_history_model->search_registry_history($registryId,null,null,1);               
      //      $history = $searchErms_risk_history->result()[0];
      //      $history_id = $history->id;
      //      $dt_update_history = array(
      //          'active_code'=>0,
      //          'date_updated'=>$today
      //      );
      //      // UPDATE REGISTRY HISTORY
      //      $this->registry_history_model->update_registry_history($dt_update_history,$history_id);
      //      // INSERT REGISTRY HISTORY
      //      $this->registry_history_model->insert_registry_history($dt_registry_history);

      //      // Insert Registry Causes 
      //      $causes = $this->input->post('causes');               
      //      if(!empty($causes)){
      //          $number2 = count($causes);
      //          if($number2 >= 1)
      //          {
      //              for($i = 0; $i < $number2; $i++){
      //                  $dt_causes = array(
      //                      'causes'=> $causes[$i],
      //                      'risk_registry_id'=> $registryId ,                    
      //                      'date_created'=>$today,
      //                      'active'=>1,
      //                      'quarter_id'=>$quarter,
      //                      'year_id'=>$year
      //                  );
      //                  $this->registry_causes_model->insert_registry_causes($dt_causes);
      //                  $causeId = $this->db->insert_id();                                                    
      //              }
      //          }
      //      }
      //     //print_r($causeId);  die();
      //     $causes_reason = $this->input->post('causes_reason');
      //     //print_r($causes_reason);  die();             
      //     if(!empty($causes_reason)){
      //       $numberH = count($causes_reason);
      //       for($i = 0; $i < $numberH; $i++){
      //       // Insert Change History Causes
      //             $dt_causes_reason = array(
      //               'cause_reason'=> $causes_reason[$i],
      //               'cause_id'=> $causeId,                    
      //               'date_created'=>$today
      //           );
      //           $this->registry_causes_model->insert_registry_causes_reason($dt_causes_reason);
      //       }
      //     }             
      //      // Insert Registry Events
      //      $events = $this->input->post('events');
      //      if(!empty($events)){
      //          $number3 = count($events);
      //          if($number3 >= 1)
      //          {
      //              for($i = 0; $i < $number3; $i++){
      //                  $dt_events = array(
      //                      'events'=> $events[$i],
      //                      'risk_registry_id'=> $registryId ,                    
      //                      'date_created'=>$today,
      //                      'active'=>1,
      //                      'quarter_id'=>$quarter,
      //                      'year_id'=>$year
      //                  );
      //                  $this->registry_events_model->insert_registry_events($dt_events);
      //                  $eventId = $this->db->insert_id(); 
      //              }
      //          }
      //      }
      //       $events_reason = $this->input->post('events_reason');               
      //       if(!empty($events_reason)){
      //         $numberJ = count($events_reason);
      //         for($i = 0; $i < $numberJ; $i++){
      //         // Insert Change History Events
      //             $dt_events_reason = array(
      //               'event_reason'=> $events_reason[$i],
      //               'event_id'=> $causeId,                    
      //               'date_created'=>$today
      //           );
      //           $this->registry_events_model->insert_registry_events_reason($dt_events_reason);
      //         }
      //       }
      //      // Insert Registry Consequences
      //      $consequences = $this->input->post('consequences');
      //      if(!empty($consequences)){
      //          $number4 = count($consequences);
      //          if($number4 >= 1)
      //          {
      //              for($i = 0; $i < $number4; $i++){
      //                  $dt_consequences = array(
      //                      'consequences'=> $consequences[$i],
      //                      'risk_registry_id'=> $registryId ,                    
      //                      'date_created'=>$today,
      //                      'active'=>1,
      //                      'quarter_id'=>$quarter,
      //                      'year_id'=>$year
      //                  );
      //                  $this->registry_consequences_model->insert_registry_consequences($dt_consequences);
      //                  $consequenceId = $this->db->insert_id();
      //              }
      //          }
      //      }
      //      $consequences_reason = $this->input->post('consequences_reason');
      //      // Insert Change History Consequences               
      //      if(!empty($consequences_reason)){
      //       $numberQ = count($consequences_reason);
      //       for($i = 0; $i < $numberQ; $i++){
      //               $dt_consequences_reason = array(
      //                 'consequences_reason'=> $consequences_reason[$i],
      //                 'consequence_id'=> $consequenceId,                    
      //                 'date_created'=>$today
      //             );
      //             $this->registry_consequences_model->insert_registry_consequences_reason($dt_consequences_reason);
      //         }
      //       }
      //      // Insert Registry ExControls
      //      $ex_controls = $this->input->post('ex_controls');
      //      if(!empty($ex_controls)){
      //          $number5 = count($ex_controls);
      //          if($number5 >= 1)
      //          {
      //              for($i = 0; $i < $number5; $i++){
      //                  $dt_ex_controls = array(
      //                      'excontrols'=> $ex_controls[$i],
      //                      'risk_registry_id'=> $registryId ,                    
      //                      'date_created'=>$today,
      //                      'active'=>1,
      //                      'quarter_id'=>$quarter,
      //                      'year_id'=>$year
      //                  );
      //                  $this->registry_excontrols_model->insert_registry_excontrols($dt_ex_controls);
      //              }
      //          }
      //      }
      //      // Insert Registry ADControls
      //      $ad_controls = $this->input->post('ad_controls');
      //      if(!empty($ad_controls)){
      //          $number6 = count($ad_controls);
      //          if($number6 >= 1)
      //          {
      //              for($i = 0; $i < $number6; $i++){
      //                  $dt_ad_controls = array(
      //                      'adcontrols'=> $ad_controls[$i],
      //                      'risk_registry_id'=> $registryId ,                    
      //                      'date_created'=>$today,
      //                      'active'=>1,
      //                      'quarter_id'=>$quarter,
      //                      'year_id'=>$year
      //                  );
      //                  $this->registry_adcontrols_model->insert_registry_adcontrols($dt_ad_controls);
      //              }
      //          }
      //      }
      //      $this->db->trans_complete();
      //      if ($this->db->trans_status() === FALSE)
      //      {
      //          $this->db->trans_rollback();
      //          $result = array("Status_code"=>300, "Message"=>'Sorry, There was a problem during Assessment of the Risk Register');
      //          echo json_encode($result);
      //          //echo 'Sorry, There was a problem during assessement of the Risk Register';
      //      }
      //      else
      //      {
      //          $this->db->trans_commit();
      //          $other_result = array("Status_code"=>200, "Message"=>'Risk Register has been Assessed Successfully');
      //          echo json_encode($other_result);
      //         // echo 'Risk Register has been Assessed Successfully';
      //      }
      //      /***** END  TRANSACTIONS ****************************/  
      //  }else{
      //      $again_result = array("Status_code"=>404, "Message"=>'Sorry, This Risk has already been Assessed Quarterly ');
      //      echo json_encode($again_result);
      //      //echo ' Sorry, this Risk has been Quarterly Assessed already '; 
      //  }          
      // }







     /*************  Registry Insert Page **************/
     public function registry_insert(){
           // Insert Registry
           $today = date("Y-m-d H:i:s");
           $activity = $this->input->post('activity');
           $risk_category = $this->input->post('risk_category');
           $riskOwner_id = $this->input->post('riskOwner_id');
   

           $impact_scale = $this->input->post('impact_scale');
           $likehood_scale = $this->input->post('likehood_scale');
           $eff_control_scale = $this->input->post('eff_control_scale');

           $remarks = $this->input->post('remarks');
           $trends = $this->input->post('trends');
           $quarter = $this->input->post('quarter');
           $status = $this->input->post('status');
           $year_id = $this->input->post('year');

           $reporter_id = $this->input->post('reporter_id');

           // Get Quarter here ...
           //$quarter_id = Quarter::get_quarter();

           $data_registry = array(
               'activity'=> $activity,
               'objective_category_id'=> $risk_category,
               'risk_owner_id'=>$riskOwner_id,
               'impact_scale_id'=> $impact_scale,
               'like_hood_scale_id'=>$likehood_scale,
               'controls_effectiveness_scale_id'=>$eff_control_scale,
               'reporter_id'=>$reporter_id,
               'date_created'=>$today,
               'active'=>1              
           );


          


           /******** START TRANSACTION ****************/
           $this->db->trans_start();
           $this->registry_model->insert_data_registry($data_registry);
           $registryId = $this->db->insert_id();

           // Insert Registry Objectives
           $objectives = $this->input->post('objectives');
           $number1 = count($objectives);
           if($number1 >= 1)
           {
               for($i = 0; $i < $number1; $i++){
                   $dt_obj = array(
                       'objective_id'=> $objectives[$i],
                       'risk_registry_id'=> $registryId ,                    
                       'date_created'=>$today,
                       'created_by'=>$reporter_id
                   );
                   $this->registry_objectives_model->insert_registry_objectives($dt_obj);
               }
           }

           // Insert Registry Causes
           $causes = $this->input->post('causes');
           $number2 = count($causes);
           if($number2 >= 1)
           {
               for($i = 0; $i < $number2; $i++){
                   $dt_causes = array(
                       'causes'=> $causes[$i],
                       'risk_registry_id'=> $registryId ,                    
                       'date_created'=>$today,
                       'active'=>1,
                       'quarter_id'=>$quarter,
                       'year_id'=>$year_id,
                       'created_by'=>$reporter_id

                   );
                   $this->registry_causes_model->insert_registry_causes($dt_causes);
               }
           }

           // Insert Registry Events
           $events = $this->input->post('events');
           $number3 = count($events);
           if($number3 >= 1)
           {
               for($i = 0; $i < $number3; $i++){
                   $dt_events = array(
                       'events'=> $events[$i],
                       'risk_registry_id'=> $registryId ,                    
                       'date_created'=>$today,
                       'active'=>1,
                       'quarter_id'=>$quarter,
                       'year_id'=>$year_id,
                       'created_by'=>$reporter_id
                   );
                   $this->registry_events_model->insert_registry_events($dt_events);
               }
           }

           // Insert Registry Consequences
           $consequences = $this->input->post('consequences');
           $number4 = count($consequences);
           if($number4 >= 1)
           {
               for($i = 0; $i < $number4; $i++){
                   $dt_consequences = array(
                       'consequences'=> $consequences[$i],
                       'risk_registry_id'=> $registryId ,                    
                       'date_created'=>$today,
                       'active'=>1,
                       'quarter_id'=>$quarter,
                       'year_id'=>$year_id,
                       'created_by'=>$reporter_id
                   );
                   $this->registry_consequences_model->insert_registry_consequences($dt_consequences);
               }
           }

           // Insert Registry ExControls
           $ex_controls = $this->input->post('ex_controls');
           $number5 = count($ex_controls);
           if($number5 >= 1)
           {
               for($i = 0; $i < $number5; $i++){
                   $dt_ex_controls = array(
                       'excontrols'=> $ex_controls[$i],
                       'risk_registry_id'=> $registryId ,                    
                       'date_created'=>$today,
                       'active'=>1,
                       'quarter_id'=>$quarter,
                       'year_id'=>$year_id,
                       'created_by'=>$reporter_id
                   );
                   $this->registry_excontrols_model->insert_registry_excontrols($dt_ex_controls);
               }
           }

           // Insert Registry ADControls
           $ad_controls = $this->input->post('ad_controls');
           $number6 = count($ad_controls);
           if($number6 >= 1)
           {
               for($i = 0; $i < $number6; $i++){
                   $dt_ad_controls = array(
                       'adcontrols'=> $ad_controls[$i],
                       'risk_registry_id'=> $registryId ,                    
                       'date_created'=>$today,
                       'active'=>1,
                       'quarter_id'=>$quarter,
                       'year_id'=>$year_id,
                       'created_by'=>$reporter_id
                   );
                   $this->registry_adcontrols_model->insert_registry_adcontrols($dt_ad_controls);
               }
           }

           // START Insert Remarks PART
           $dt_registry_history = array(
               'risk_registry_id'=> $registryId ,
               'remarks'=> $remarks, 
               'status'=> $status,  
               'trends_id'=> $trends,                   
               'date_created'=>$today,
               'quarter_id'=>$quarter,
               'year_id'=>$year_id,
               'active_code'=>1,
               'created_by'=>$reporter_id
            );

         
            $this->registry_history_model->insert_registry_history($dt_registry_history);
        
           // End Insert Remarks PART

           $this->db->trans_complete();

           // var_dump($this->db->trans_status());
           // die();

           if ($this->db->trans_status() === FALSE)
           {
               $this->db->trans_rollback();
               echo 'Sorry, There was a problem during creating a Risk Register';
           }
           else
           {
               $this->db->trans_commit();
               echo 'You have successfully created Risk Register';
           }
           /***** END  TRANSACTIONS ****************************/  
   }


      /*************  Registry Report Page **************/
  public function reports(){
      // Userdata fetch data stored in the session
      $role_id = $this->session->userdata('role_id');
      $user_id = $this->session->userdata('user_id');
      $username = $this->session->userdata('username');
      if($user_id!= ''){
           $this->load->view('include/header');
           $this->load->view('registry_report');
           $this->load->view('include/footer');
           $this->load->view('include/jsfiles'); //all included JS Files
           $this->load->view('registry/reportscustom'); //custom JS manipulations for this page                
       }
       else{
           redirect(base_url().'login/login');
       }       
  }



    /*************  View Registry Objective  **************/
    public function registry_view_objectives()
    {  
        $reg_id = $this->input->post('reg_id');
        $list_regObjectives = $this->registry_model->get_registry_objectives($reg_id);
        $json = json_encode($list_regObjectives->result()); 

        print_r($json); die();
        echo($json);
    }

    /*************  View Registry Causes  **************/
    public function registry_view_causes()
    {  
       $reg_id = $this->input->post('reg_id');
       $list_regCauses = $this->registry_causes_model->get_registry_causes($reg_id);
        $json = json_encode($list_regCauses->result()); 
        echo($json);
    }

    /*************  View Registry Events  **************/
    public function registry_view_events()
    {  
       $reg_id = $this->input->post('reg_id');
       $list_regEvents = $this->registry_events_model->get_registry_events($reg_id);
       $json = json_encode($list_regEvents->result()); 
        echo($json);
    }

    /*************  View Registry Consequences  **************/
    public function registry_view_consequences()
    {  
       $reg_id = $this->input->post('reg_id');
       $list_regConsequences = $this->registry_consequences_model->get_registry_consequences($reg_id);
        $json = json_encode($list_regConsequences->result()); 
        echo($json);
    }

    /*************  View Registry Excontrols  **************/
    public function registry_view_excontrols()
    {  
        $reg_id = $this->input->post('reg_id');
        $list_regExcontrols = $this->registry_excontrols_model->get_registry_excontrols($reg_id);
        $json = json_encode($list_regExcontrols->result());  
        echo($json);
    }

    /*************  View Registry Adcontrols  **************/
    public function registry_view_adcontrols()
    {  
        $reg_id = $this->input->post('reg_id');
        $list_regAdcontrols = $this->registry_adcontrols_model->get_registry_adcontrols($reg_id);
        $json = json_encode($list_regAdcontrols->result());  
        echo($json);
    }



    // ADDED FUNCTIONS START HERE ...

    /*************  Delete the Registry Causes (UPDATE)  **************/
    public function delete_registry_causes(){
       $today = date("Y-m-d H:i:s");
       $cause_id = $this->uri->segment(3);  
       $registry_id = $this->uri->segment(4);
       $cause_reason = $this->uri->segment(5);
     
       $dt_causes = array(
           'active'=> 0,
           'date_updated'=>$today
       );

       $dt_cause_reason = array(
        'cause_id'=> $cause_id,
        'cause_reason'=>$cause_reason,
        'date_created'=>$today
       );

       $this->db->trans_start();

          $this->registry_causes_model->update_registry_causes($dt_causes,$cause_id);

          $this->registry_causes_model->insert_registry_causes_reason($dt_cause_reason);

       $this->db->trans_complete();

       if ($this->db->trans_status() === FALSE)
       {
           $this->db->trans_rollback();
           echo 'Sorry, There was a problem during cause deletion process';
       }
       else
       {
           $this->db->trans_commit();
           redirect(base_url()."registry/registry_edit/".$registry_id);
       } 

    }
   /*************  Delete the Registry Events (UPDATE)  **************/
    public function delete_registry_events(){
       $today = date("Y-m-d H:i:s");
       $event_id = $this->uri->segment(3);
       $registry_id = $this->uri->segment(4);
       $event_reason = $this->uri->segment(5);
       $dt_events = array(
           'active'=> 0,
           'date_updated'=>$today
       );
       $dt_event_reason = array(
        'event_id'=> $event_id,
        'event_reason'=>$event_reason,
        'date_created'=>$today
       );
      $this->db->trans_start();
      $this->registry_events_model->update_registry_events($dt_events,$event_id);
      $this->registry_events_model->insert_registry_events_reason($dt_event_reason);
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
      {
        $this->db->trans_rollback();
        echo 'Sorry, There was a problem during event deletion process';
      }
      else
      {
        $this->db->trans_commit();
        redirect(base_url()."registry/registry_edit/".$registry_id);
      }
    }

   /*************  Delete the Registry Consequences (UPDATE)  **************/
    public function delete_registry_consequences(){
       $today = date("Y-m-d H:i:s");
       $consequences_id = $this->uri->segment(3);
       $registry_id = $this->uri->segment(4);
       $consequence_reason = $this->uri->segment(5);

       $dt_consequences = array(
           'active'=> 0,
           'date_updated'=>$today
       );

       $dt_consequence_reason = array(
        'consequence_id'=> $consequences_id,
        'consequences_reason'=>$consequence_reason,
        'date_created'=>$today
       );

      $this->db->trans_start();

        $this->registry_consequences_model->update_registry_consequences($dt_consequences,$consequences_id);

        $this->registry_consequences_model->insert_registry_consequences_reason($dt_consequence_reason);

      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE)
      {
          $this->db->trans_rollback();
          echo 'Sorry, There was a problem during consequence deletion process';
      }
      else
      {
          $this->db->trans_commit();
          redirect(base_url()."registry/registry_edit/".$registry_id);
      }

    }
    /*************  Delete the Registry ExControls (UPDATE)  **************/
    public function delete_registry_excontrols(){
       $today = date("Y-m-d H:i:s");
       $excontrols_id = $this->uri->segment(3);
       $registry_id = $this->uri->segment(4);
       $dt_excontrols = array(
           'active'=> 0,
           'date_updated'=>$today
       );

       //print_r($cause_id); die();
       // Make the ID to 0
       $this->registry_excontrols_model->update_registry_excontrols($dt_excontrols,$excontrols_id);

       redirect(base_url()."registry/registry_edit/".$registry_id);

    }
     /*************  Delete the Registry AdControls (UPDATE)  **************/
     public function delete_registry_adcontrols(){
       $today = date("Y-m-d H:i:s");
       $adcontrols_id = $this->uri->segment(3);
       $registry_id = $this->uri->segment(4);
       $dt_adcontrols = array(
           'active'=> 0,
           'date_updated'=>$today
       );

       //print_r($cause_id); die();
       // Make the ID to 0
       $this->registry_adcontrols_model->update_registry_adcontrols($dt_adcontrols,$adcontrols_id);

       redirect(base_url()."registry/registry_edit/".$registry_id);

    }


















    /** DELETE as SOFT DELETE in RISK REGISTRY */
    public function delete_registry(){
        $registryId = $this->input->post('risk_registry_id');
        $today = date("Y-m-d H:i:s"); 
        $user_id = $this->input->post('user_id');



        $dt_data = array(
            'active'=> 0,
            'date_updated'=>$today,
            'updated_by'=>$user_id
        );

        $this->registry_model->update_registry($dt_data,$registryId);
    }


     /*************  Registry Insert Page **************/
    // public function registry_update(){
    //  // Quarterly Evaluation Register            
    //  /******** START TRANSACTION ****************/
    //  $this->db->trans_start();
    //  $today = date("Y-m-d H:i:s");
    //  $registryId = $this->input->post('registry_id');
    //  $remarks = $this->input->post('remarks');
    //  $status = $this->input->post('status');
    //  $trends = $this->input->post('trends');        
    //  $quarter = $this->input->post('quarter');
    //  $year = $this->input->post('year');
    //  // START Insert Remarks PART
    //  // ACTIVE_CODE = 1 while searching ...
    //  $searchErms_history = $this->registry_history_model->search_registry_history($registryId,$quarter,$year,null);   
    //  //$history = $searchErms_history->result()[0];
    //  //print_r($history); die();
    //  $dt_registry_history = array(
    //      'risk_registry_id'=> $registryId,
    //      'remarks'=> $remarks, 
    //      'status'=> $status,  
    //      'trends_id'=> $trends,                   
    //      'date_created'=>$today,
    //      'quarter_id'=>$quarter,
    //      'year_id'=>$year,
    //      'active_code'=>1
    //      );              
    //  if($searchErms_history->num_rows() <= 0){
    //      // UPDATE ON SPECIFIC RISK_REGISTER ID AS ACTIVE FOR VIEW PURPOSE
    //      $searchErms_risk_history = $this->registry_history_model->search_registry_history($registryId,null,null,1);               
    //      $history = $searchErms_risk_history->result()[0];
    //      $history_id = $history->id;
    //      $dt_update_history = array(
    //          'active_code'=>0,
    //          'date_updated'=>$today
    //      );
    //      // UPDATE REGISTRY HISTORY
    //      $this->registry_history_model->update_registry_history($dt_update_history,$history_id);
    //      // INSERT REGISTRY HISTORY
    //      $this->registry_history_model->insert_registry_history($dt_registry_history);
    //      // Insert Registry Causes 
    //      $causes = $this->input->post('causes');               
    //      if(!empty($causes)){
    //          $number2 = count($causes);
    //          if($number2 >= 1)
    //          {
    //              for($i = 0; $i < $number2; $i++){
    //                  $dt_causes = array(
    //                      'causes'=> $causes[$i],
    //                      'risk_registry_id'=> $registryId ,                    
    //                      'date_created'=>$today,
    //                      'active'=>1,
    //                      'quarter_id'=>$quarter,
    //                      'year_id'=>$year
    //                  );
    //                  $this->registry_causes_model->insert_registry_causes($dt_causes);
    //                  $causeId = $this->db->insert_id();                                                    
    //              }
    //          }
    //      }
    //     //print_r($causeId);  die();
    //     $causes_reason = $this->input->post('causes_reason');
    //     //print_r($causes_reason);  die();             
    //     if(!empty($causes_reason)){
    //       $numberH = count($causes_reason);
    //       for($i = 0; $i < $numberH; $i++){
    //       // Insert Change History Causes
    //             $dt_causes_reason = array(
    //               'cause_reason'=> $causes_reason[$i],
    //               'cause_id'=> $causeId,                    
    //               'date_created'=>$today
    //           );
    //           $this->registry_causes_model->insert_registry_causes_reason($dt_causes_reason);
    //       }
    //     }             
    //      // Insert Registry Events
    //      $events = $this->input->post('events');
    //      if(!empty($events)){
    //          $number3 = count($events);
    //          if($number3 >= 1)
    //          {
    //              for($i = 0; $i < $number3; $i++){
    //                  $dt_events = array(
    //                      'events'=> $events[$i],
    //                      'risk_registry_id'=> $registryId ,                    
    //                      'date_created'=>$today,
    //                      'active'=>1,
    //                      'quarter_id'=>$quarter,
    //                      'year_id'=>$year
    //                  );
    //                  $this->registry_events_model->insert_registry_events($dt_events);
    //                  $eventId = $this->db->insert_id(); 
    //              }
    //          }
    //      }
    //       $events_reason = $this->input->post('events_reason');               
    //       if(!empty($events_reason)){
    //         $numberJ = count($events_reason);
    //         for($i = 0; $i < $numberJ; $i++){
    //         // Insert Change History Events
    //             $dt_events_reason = array(
    //               'event_reason'=> $events_reason[$i],
    //               'event_id'=> $causeId,                    
    //               'date_created'=>$today
    //           );
    //           $this->registry_events_model->insert_registry_events_reason($dt_events_reason);
    //         }
    //       }
    //      // Insert Registry Consequences
    //      $consequences = $this->input->post('consequences');
    //      if(!empty($consequences)){
    //          $number4 = count($consequences);
    //          if($number4 >= 1)
    //          {
    //              for($i = 0; $i < $number4; $i++){
    //                  $dt_consequences = array(
    //                      'consequences'=> $consequences[$i],
    //                      'risk_registry_id'=> $registryId ,                    
    //                      'date_created'=>$today,
    //                      'active'=>1,
    //                      'quarter_id'=>$quarter,
    //                      'year_id'=>$year
    //                  );
    //                  $this->registry_consequences_model->insert_registry_consequences($dt_consequences);
    //                  $consequenceId = $this->db->insert_id();
    //              }
    //          }
    //      }
    //      $consequences_reason = $this->input->post('consequences_reason');
    //      // Insert Change History Consequences               
    //      if(!empty($consequences_reason)){
    //       $numberQ = count($consequences_reason);
    //       for($i = 0; $i < $numberQ; $i++){
    //               $dt_consequences_reason = array(
    //                 'consequences_reason'=> $consequences_reason[$i],
    //                 'consequence_id'=> $consequenceId,                    
    //                 'date_created'=>$today
    //             );
    //             $this->registry_consequences_model->insert_registry_consequences_reason($dt_consequences_reason);
    //         }
    //       }
    //      // Insert Registry ExControls
    //      $ex_controls = $this->input->post('ex_controls');
    //      if(!empty($ex_controls)){
    //          $number5 = count($ex_controls);
    //          if($number5 >= 1)
    //          {
    //              for($i = 0; $i < $number5; $i++){
    //                  $dt_ex_controls = array(
    //                      'excontrols'=> $ex_controls[$i],
    //                      'risk_registry_id'=> $registryId ,                    
    //                      'date_created'=>$today,
    //                      'active'=>1,
    //                      'quarter_id'=>$quarter,
    //                      'year_id'=>$year
    //                  );
    //                  $this->registry_excontrols_model->insert_registry_excontrols($dt_ex_controls);
    //              }
    //          }
    //      }
    //      // Insert Registry ADControls
    //      $ad_controls = $this->input->post('ad_controls');
    //      if(!empty($ad_controls)){
    //          $number6 = count($ad_controls);
    //          if($number6 >= 1)
    //          {
    //              for($i = 0; $i < $number6; $i++){
    //                  $dt_ad_controls = array(
    //                      'adcontrols'=> $ad_controls[$i],
    //                      'risk_registry_id'=> $registryId ,                    
    //                      'date_created'=>$today,
    //                      'active'=>1,
    //                      'quarter_id'=>$quarter,
    //                      'year_id'=>$year
    //                  );
    //                  $this->registry_adcontrols_model->insert_registry_adcontrols($dt_ad_controls);
    //              }
    //          }
    //      }
    //      $this->db->trans_complete();
    //      if ($this->db->trans_status() === FALSE)
    //      {
    //          $this->db->trans_rollback();
    //          $result = array("Status_code"=>300, "Message"=>'Sorry, There was a problem during Assessment of the Risk Register');
    //          echo json_encode($result);
    //          //echo 'Sorry, There was a problem during assessement of the Risk Register';
    //      }
    //      else
    //      {
    //          $this->db->trans_commit();
    //          $other_result = array("Status_code"=>200, "Message"=>'Risk Register has been Assessed Successfully');
    //          echo json_encode($other_result);
    //         // echo 'Risk Register has been Assessed Successfully';
    //      }
    //      /***** END  TRANSACTIONS ****************************/  
    //  }else{
    //      $again_result = array("Status_code"=>404, "Message"=>'Sorry, This Risk has already been Assessed Quarterly ');
    //      echo json_encode($again_result);
    //      //echo ' Sorry, this Risk has been Quarterly Assessed already '; 
    //  }          
    // }

    public function risk_register_update(){
      $this->db->trans_start();
      $today = date("Y-m-d H:i:s");
      $createdAtFromDB = $this->input->post('createdAtFromDB');
      $createdByFromDB = $this->input->post('createdByFromDB');
      $registryId = $this->input->post('registry_id');
      $remarks = $this->input->post('remarks');
      $status = $this->input->post('status');
      $trends = $this->input->post('trends');        
      $quarter = $this->input->post('quarter');
      $year = $this->input->post('year');
      $user_id = $this->input->post('reporter_id');
      $active_code = 1;

      // These 3 parameters must be unique //riskregisterid+quarterid+yearid
      // Fetch active active=1
      check_riskregisterhistory_with_riskregisterid_quarterid_yearid
      $searchErms_history = $this->registry_history_model->search_registry_history($registryId,$quarter,$year,null);
      $dt_registry_history = array(
        'risk_registry_id'=> $registryId,
        'remarks'=> $remarks, 
        'status'=> $status,  
        'trends_id'=> $trends,  
        'date_created'=>$createdAtFromDB, //Preserve created_at date
        'created_by'=>$createdByFromDB, //Preserve created_by name           
        'quarter_id'=>$quarter,
        'year_id'=>$year,
        'active_code'=>1,
        'date_updated'=>$today,
        'updated_by'=>$user_id
      ); 
   
      if( $searchErms_history->num_rows() ){
           // UPDATE ON SPECIFIC RISK_REGISTER ID AS ACTIVE FOR VIEW PURPOSE
           $searchErms_risk_history = $this->registry_history_model->search_registry_history($registryId,null,null,1);               
           $history = $searchErms_risk_history->result()[0];
           $history_id = $history->id;
           $dt_update_history = array(
               'active_code'=>0,
               'date_updated'=>$today,
               'updated_by'=>$user_id
           );
           // UPDATE REGISTRY HISTORY
           $this->registry_history_model->update_registry_history($dt_update_history,$history_id);
           // INSERT REGISTRY HISTORY
           $this->registry_history_model->insert_registry_history($dt_registry_history);
           // Insert Registry Causes 
           $causes = $this->input->post('causes');               
           if(!empty($causes)){
               $number2 = count($causes);
               if($number2 >= 1)
               {
                   for($i = 0; $i < $number2; $i++){
                       $dt_causes = array(
                           'causes'=> $causes[$i],
                           'risk_registry_id'=> $registryId ,                    
                           'date_created'=>$today,
                           'active'=>1,
                           'quarter_id'=>$quarter,
                           'year_id'=>$year
                       );
                       $this->registry_causes_model->insert_registry_causes($dt_causes);
                       $causeId = $this->db->insert_id();                                                    
                   }
               }
           }
           // $causes_reason = $this->input->post('causes_reason');        
           // if(!empty($causes_reason)){
           //  $numberH = count($causes_reason);
           //  for($i = 0; $i < $numberH; $i++){
           //      // Insert Change History Causes
           //        $dt_causes_reason = array(
           //          'cause_reason'=> $causes_reason[$i],
           //          'cause_id'=> $causeId,                    
           //          'date_created'=>$today
           //      );
           //      $this->registry_causes_model->insert_registry_causes_reason($dt_causes_reason);
           //  }
           // }             
           // Insert Registry Events
           $events = $this->input->post('events');
           if(!empty($events)){
               $number3 = count($events);
               if($number3 >= 1)
               {
                   for($i = 0; $i < $number3; $i++){
                       $dt_events = array(
                           'events'=> $events[$i],
                           'risk_registry_id'=> $registryId ,                    
                           'date_created'=>$today,
                           'active'=>1,
                           'quarter_id'=>$quarter,
                           'year_id'=>$year
                       );
                       $this->registry_events_model->insert_registry_events($dt_events);
                       $eventId = $this->db->insert_id(); 
                   }
               }
           }
            // $events_reason = $this->input->post('events_reason');               
            // if(!empty($events_reason)){
            //   $numberJ = count($events_reason);
            //   for($i = 0; $i < $numberJ; $i++){
            //   // Insert Change History Events
            //       $dt_events_reason = array(
            //         'event_reason'=> $events_reason[$i],
            //         'event_id'=> $eventId,                    
            //         'date_created'=>$today
            //     );
            //     $this->registry_events_model->insert_registry_events_reason($dt_events_reason);
            //   }
            // }
           // Insert Registry Consequences
           $consequences = $this->input->post('consequences');
           if(!empty($consequences)){
               $number4 = count($consequences);
               if($number4 >= 1)
               {
                   for($i = 0; $i < $number4; $i++){
                       $dt_consequences = array(
                           'consequences'=> $consequences[$i],
                           'risk_registry_id'=> $registryId ,                    
                           'date_created'=>$today,
                           'active'=>1,
                           'quarter_id'=>$quarter,
                           'year_id'=>$year
                       );
                       $this->registry_consequences_model->insert_registry_consequences($dt_consequences);
                       $consequenceId = $this->db->insert_id();
                   }
               }
           }
           // $consequences_reason = $this->input->post('consequences_reason');
           // // Insert Change History Consequences               
           // if(!empty($consequences_reason)){
           //  $numberQ = count($consequences_reason);
           //  for($i = 0; $i < $numberQ; $i++){
           //        $dt_consequences_reason = array(
           //            'consequences_reason'=> $consequences_reason[$i],
           //            'consequence_id'=> $consequenceId,                    
           //            'date_created'=>$today
           //        );
           //        $this->registry_consequences_model->insert_registry_consequences_reason($dt_consequences_reason);
           //    }
           //  }
           // Insert Registry ExControls
           $ex_controls = $this->input->post('ex_controls');
           if(!empty($ex_controls)){
               $number5 = count($ex_controls);
               if($number5 >= 1)
               {
                   for($i = 0; $i < $number5; $i++){
                       $dt_ex_controls = array(
                           'excontrols'=> $ex_controls[$i],
                           'risk_registry_id'=> $registryId ,                    
                           'date_created'=>$today,
                           'active'=>1,
                           'quarter_id'=>$quarter,
                           'year_id'=>$year
                       );
                       $this->registry_excontrols_model->insert_registry_excontrols($dt_ex_controls);
                   }
               }
           }
           // Insert Registry ADControls
           $ad_controls = $this->input->post('ad_controls');
           if(!empty($ad_controls)){
               $number6 = count($ad_controls);
               if($number6 >= 1)
               {
                   for($i = 0; $i < $number6; $i++){
                       $dt_ad_controls = array(
                           'adcontrols'=> $ad_controls[$i],
                           'risk_registry_id'=> $registryId ,                    
                           'date_created'=>$today,
                           'active'=>1,
                           'quarter_id'=>$quarter,
                           'year_id'=>$year
                       );
                       $this->registry_adcontrols_model->insert_registry_adcontrols($dt_ad_controls);
                   }
               }
           }
           $this->db->trans_complete();
           if ($this->db->trans_status() === FALSE)
           {
               $this->db->trans_rollback();
               $result = array("Status_code"=>300, "Message"=>'Sorry, There was a problem during Assessment of the Risk Register');
               echo json_encode($result);
               //echo 'Sorry, There was a problem during assessement of the Risk Register';
           }
           else
           {
               $this->db->trans_commit();
               $other_result = array("Status_code"=>200, "Message"=>'Risk Register has been Assessed Successfully');
               echo json_encode($other_result);
              // echo 'Risk Register has been Assessed Successfully';
           }
      }else{
           $again_result = array("Status_code"=>404, "Message"=>'Sorry, This Risk has already been Assessed Quarterly ');
           echo json_encode($again_result);
      }          
    }

    // public function risk_register_update(){
    //   $this->db->trans_start();
    //   $today = date("Y-m-d H:i:s");
    //   $createdAtFromDB = $this->input->post('createdAtFromDB');
    //   $createdByFromDB = $this->input->post('createdByFromDB');
    //   $user_id = $this->input->post('reporter_id');
    //   $registryId = $this->input->post('registry_id');

    //   //PREVIOUS QUARTER ASSESSMENT
    //   $remarks = $this->input->post('remarks');
    //   $status = $this->input->post('status');
    //   $trends = $this->input->post('trends');        
    //   $quarter = $this->input->post('quarter');
    //   $year = $this->input->post('year');
       


    //    // START Insert Remarks PART
    //    // ACTIVE_CODE = 1 while searching ...
    //    $active_code = 1;
    //    $searchErms_history = $this->registry_history_model->search_registry_history($registryId,$quarter,$year,null);
    //    // var_dump($searchErms_history->num_rows() );
    //    // die();

    //    //$history = $searchErms_history->result()[0];
    //     //print_r($history); die();
    //     $dt_registry_history = array(
    //        'risk_registry_id'=> $registryId,
    //        'remarks'=> $remarks, 
    //        'status'=> $status,  
    //        'trends_id'=> $trends,  

    //        'date_created'=>$createdAtFromDB, //Preserve created_at date
    //        'created_by'=>$createdByFromDB, //Preserve created_by name
           
    //        'quarter_id'=>$quarter,
    //        'year_id'=>$year,
    //        'active_code'=>1,
    //        'date_updated'=>$today,
    //        'updated_by'=>$user_id
    //     );  
    

    //    // IF THERE IS A RECORD
    //    if( $searchErms_history->num_rows() ){
    //        // UPDATE ON SPECIFIC RISK_REGISTER ID AS ACTIVE FOR VIEW PURPOSE
    //        $searchErms_risk_history = $this->registry_history_model->search_registry_history($registryId,null,null,1);               
    //        $history = $searchErms_risk_history->result()[0];   
    //        $historytableid = $history->id; 
    //        $data = array(
    //           'risk_registry_id'=>$registryId,
    //           'remarks'=>$remarks,
    //           'status'=>$status,
    //           'trends_id'=>$trends,
    //           'active_code'=>1,
    //           'date_created'=>$createdAtFromDB, //Preserve created_at date
    //           'date_updated'=>$today,
    //           'quarter_id'=>$quarter,
    //           'year_id'=>$year,
    //           'created_by'=>$createdByFromDB, //Preserve created_by name              
    //           'updated_by'=>$user_id
    //        );

    //        // UPDATE RISK REGISTER HISTORY
    //        $this->registry_history_model->update_risk_register_history($data,$historytableid);



    //        // UPDATE REGISTRY HISTORY
    //        $this->registry_history_model->update_registry_history($dt_update_history,$history_id);
    //        // INSERT REGISTRY HISTORY
    //        $this->registry_history_model->insert_registry_history($dt_registry_history);
    //        // Insert Registry Causes 
    //        $causes = $this->input->post('causes');               
    //        if(!empty($causes)){
    //            $number2 = count($causes);
    //            if($number2 >= 1)
    //            {
    //                for($i = 0; $i < $number2; $i++){
    //                    $dt_causes = array(
    //                        'causes'=> $causes[$i],
    //                        'risk_registry_id'=> $registryId ,                    
    //                        'date_created'=>$today,
    //                        'active'=>1,
    //                        'quarter_id'=>$quarter,
    //                        'year_id'=>$year
    //                    );
    //                    $this->registry_causes_model->insert_registry_causes($dt_causes);
    //                    $causeId = $this->db->insert_id();                                                    
    //                }
    //            }
    //        }
    //        // $causes_reason = $this->input->post('causes_reason');        
    //        // if(!empty($causes_reason)){
    //        //  $numberH = count($causes_reason);
    //        //  for($i = 0; $i < $numberH; $i++){
    //        //      // Insert Change History Causes
    //        //        $dt_causes_reason = array(
    //        //          'cause_reason'=> $causes_reason[$i],
    //        //          'cause_id'=> $causeId,                    
    //        //          'date_created'=>$today
    //        //      );
    //        //      $this->registry_causes_model->insert_registry_causes_reason($dt_causes_reason);
    //        //  }
    //        // }             
    //        // Insert Registry Events
    //        $events = $this->input->post('events');
    //        if(!empty($events)){
    //            $number3 = count($events);
    //            if($number3 >= 1)
    //            {
    //                for($i = 0; $i < $number3; $i++){
    //                    $dt_events = array(
    //                        'events'=> $events[$i],
    //                        'risk_registry_id'=> $registryId ,                    
    //                        'date_created'=>$today,
    //                        'active'=>1,
    //                        'quarter_id'=>$quarter,
    //                        'year_id'=>$year
    //                    );
    //                    $this->registry_events_model->insert_registry_events($dt_events);
    //                    $eventId = $this->db->insert_id(); 
    //                }
    //            }
    //        }
    //         // $events_reason = $this->input->post('events_reason');               
    //         // if(!empty($events_reason)){
    //         //   $numberJ = count($events_reason);
    //         //   for($i = 0; $i < $numberJ; $i++){
    //         //   // Insert Change History Events
    //         //       $dt_events_reason = array(
    //         //         'event_reason'=> $events_reason[$i],
    //         //         'event_id'=> $eventId,                    
    //         //         'date_created'=>$today
    //         //     );
    //         //     $this->registry_events_model->insert_registry_events_reason($dt_events_reason);
    //         //   }
    //         // }
    //        // Insert Registry Consequences
    //        $consequences = $this->input->post('consequences');
    //        if(!empty($consequences)){
    //            $number4 = count($consequences);
    //            if($number4 >= 1)
    //            {
    //                for($i = 0; $i < $number4; $i++){
    //                    $dt_consequences = array(
    //                        'consequences'=> $consequences[$i],
    //                        'risk_registry_id'=> $registryId ,                    
    //                        'date_created'=>$today,
    //                        'active'=>1,
    //                        'quarter_id'=>$quarter,
    //                        'year_id'=>$year
    //                    );
    //                    $this->registry_consequences_model->insert_registry_consequences($dt_consequences);
    //                    $consequenceId = $this->db->insert_id();
    //                }
    //            }
    //        }
    //        // $consequences_reason = $this->input->post('consequences_reason');
    //        // // Insert Change History Consequences               
    //        // if(!empty($consequences_reason)){
    //        //  $numberQ = count($consequences_reason);
    //        //  for($i = 0; $i < $numberQ; $i++){
    //        //        $dt_consequences_reason = array(
    //        //            'consequences_reason'=> $consequences_reason[$i],
    //        //            'consequence_id'=> $consequenceId,                    
    //        //            'date_created'=>$today
    //        //        );
    //        //        $this->registry_consequences_model->insert_registry_consequences_reason($dt_consequences_reason);
    //        //    }
    //        //  }
    //        // Insert Registry ExControls
    //        $ex_controls = $this->input->post('ex_controls');
    //        if(!empty($ex_controls)){
    //            $number5 = count($ex_controls);
    //            if($number5 >= 1)
    //            {
    //                for($i = 0; $i < $number5; $i++){
    //                    $dt_ex_controls = array(
    //                        'excontrols'=> $ex_controls[$i],
    //                        'risk_registry_id'=> $registryId ,                    
    //                        'date_created'=>$today,
    //                        'active'=>1,
    //                        'quarter_id'=>$quarter,
    //                        'year_id'=>$year
    //                    );
    //                    $this->registry_excontrols_model->insert_registry_excontrols($dt_ex_controls);
    //                }
    //            }
    //        }
    //        // Insert Registry ADControls
    //        $ad_controls = $this->input->post('ad_controls');
    //        if(!empty($ad_controls)){
    //            $number6 = count($ad_controls);
    //            if($number6 >= 1)
    //            {
    //                for($i = 0; $i < $number6; $i++){
    //                    $dt_ad_controls = array(
    //                        'adcontrols'=> $ad_controls[$i],
    //                        'risk_registry_id'=> $registryId ,                    
    //                        'date_created'=>$today,
    //                        'active'=>1,
    //                        'quarter_id'=>$quarter,
    //                        'year_id'=>$year
    //                    );
    //                    $this->registry_adcontrols_model->insert_registry_adcontrols($dt_ad_controls);
    //                }
    //            }
    //        }
    //        $this->db->trans_complete();
    //        if ($this->db->trans_status() === FALSE)
    //        {
    //            $this->db->trans_rollback();
    //            $result = array("Status_code"=>300, "Message"=>'Sorry, There was a problem during Assessment of the Risk Register');
    //            echo json_encode($result);
    //            //echo 'Sorry, There was a problem during assessement of the Risk Register';
    //        }
    //        else
    //        {
    //            $this->db->trans_commit();
    //            $other_result = array("Status_code"=>200, "Message"=>'Risk Register has been Assessed Successfully');
    //            echo json_encode($other_result);
    //           // echo 'Risk Register has been Assessed Successfully';
    //        }
    //    }else{
    //        $again_result = array("Status_code"=>404, "Message"=>'Sorry, This Risk has already been Assessed Quarterly ');
    //        echo json_encode($again_result);
    //    }          
    // }





     /* REPORTS SUB-MENU */

     public function generatereports(){
          $data['title'] = 'Risk Register';
          $data['subtitle'] = 'Reports';
          $data['trends'] = $this->trends_model->getAll_trends()->result();
          $data['riskcategorys'] = $this->risk_model->get_risk_category()->result();
          $data['years'] = $this->registry_model->getSystemYears()->result();
          $data['quarters'] = $this->registry_model->getSystemQuarters()->result();  

          $data['activity'] = $this->registry_model->getRiskRegisterActivity()->result();             
          //var_dump( $data['activity']); 
          //echo '<pre>'; print_r($data['activity']); echo '</pre>';
          //die();
          $this->load->view('include/header');
          $this->load->view('registry/registryreport',$data);
          $this->load->view('include/footer');
          $this->load->view('include/jsfiles'); //all included JS Files
          $this->load->view('registry/registryreport_custom'); //custom JS manipulations for this page      
     }

    //CUSTOM SEARCH AND DOWNLOAD EXCEL
    public function ExcelReport(){  
        $this->load->library("excel");
        //removes excel weirdo characters
        // ob_end_clean();
        // ob_start();
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);

        /* HEADER TITLE SETUP */ 
        $object->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
        $object->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $object->getActiveSheet()->mergeCells('B1:K1');
        $object->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        /* DEFAULT STYLE ON ENTIRE STYLESHEET */
        // WRAPPING OF TEXT ON ALL CELLS
        $styleArray = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT ,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP  ,
                'wrap' => true
            ),
            'font' => [
                   'size' => 10
               ]
        );
        $object->getDefaultStyle()->applyFromArray($styleArray);

        //SETTINGS FOR COLUMN(WIDTH, FONT COLOR, FONT SIZE)
        foreach(range('B','K') as $columnID)
        {
            $object->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            $object->getActiveSheet()->getStyle('B2:K2')->getFont()->getColor()->setRGB('000000'); 
            $object->getActiveSheet()->getStyle('B2:K2')->getFont()->setSize(10);
            $object->getActiveSheet()->getStyle('B2:K2')->getFont()->setBold(true);
            $object->getActiveSheet()->getStyle('B2:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $object->getActiveSheet()->getStyle('B2:K2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        }

        // SET ROW AND COLUMNS SIZE FOR HEADERS
        //APPLY AT ROW 1
        $object->getActiveSheet()->getRowDimension('2')->setRowHeight(80); //GOING DOWN SIZE
        $object->getActiveSheet()->getColumnDimension('A')->setWidth(2);

         $object->getActiveSheet()->setCellValue('B2', 'Causes');
         $object->getActiveSheet()->setCellValue('C2', 'Events');
         $object->getActiveSheet()->setCellValue('D2', 'Consequences');
         $object->getActiveSheet()->setCellValue('E2', 'Impact(I)');
         $object->getActiveSheet()->getStyle('E2')->getAlignment()->setTextRotation(90)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $object->getActiveSheet()->setCellValue('F2', 'Likelihood(L)');
         $object->getActiveSheet()->getStyle('F2')->getAlignment()->setTextRotation(90)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $object->getActiveSheet()->setCellValue('G2', 'Magnitude(M=I*L)');
         $object->getActiveSheet()->getStyle('G2')->getAlignment()->setTextRotation(90)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $object->getActiveSheet()->setCellValue('H2', 'Existing Controls');   
         $object->getActiveSheet()->setCellValue('I2', 'Perceived Effectiveness of Controls(E)');
         $object->getActiveSheet()->getStyle('I2')->getAlignment()->setTextRotation(90)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
         $object->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
         $object->getActiveSheet()->setCellValue('J2', 'Residual Risk Score(M/E)');
         $object->getActiveSheet()->getStyle('J2')->getAlignment()->setTextRotation(90)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $object->getActiveSheet()->setCellValue('K2', 'Additional Controls');
    
        $postData = $this->input->post();
        // echo '<pre>'; print_r($postData); echo '</pre>';
        // die();
       
        $alldata = $this->registry_model->fetchReportData($postData);
      
    
       // echo '<pre>'; print_r($alldata); echo '</pre>';
       // die();



        $excel_row = (int) 3;
        $sn = 1;
        $firstdisplay=0;
        foreach($alldata as $row)
        {      
          //CONVERT objective_category_id to its name 
          $get_data = $this->risk_model->get_risk_category_name($row->objective_category_id)->result();  
          foreach($get_data as $value)  
          {
               $riskcategoryname = $value->objective_category;
               $filetitle= 'TCRA '.$riskcategoryname.' Risk Register';
               $object->getActiveSheet()->setCellValue('B1', $filetitle);
          } 

          if($firstdisplay==$row->risk_registry_id){
            continue;
           }  
           /* ROW 1 */
           // $row->activity = 'PR '.$sn.' - '.$row->activity;
           $row->activity = $row->activity;
           $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->activity);          
           $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, '');
           $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row,'');
           $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, '');
           $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, ''); 
           $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, ''); 
           $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, '');     
           $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, '');  
           $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, '');
           $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, '');
           $excel_row++;
           $sn++;
           /* ROW 2 */             
           //CONVERT RISK OWNER ID TO ITS NAME
           $get_data = $this->directorate_model->get_riskowner_name($row->risk_owner_id)->result();  
           foreach($get_data as $value)  
           {  
               //$directorate_abbreviation = $value->name;  
               //$riskowner = 'Risk Owner: '.$directorate_abbreviation;
              $riskowner = 'Risk Owner: '.$value->name;
               $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $riskowner);     
           }                 
           $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, '');
           $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row,'');
           $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, '');
           $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, ''); 
           $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, ''); 
           $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, '');     
           $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, '');  
           $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, '');
           $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, '');
           $excel_row++;
           /* ROW 3 */
           //DISPLAY OBJECTIVES WITH SEPARATED COMMMAS    
           $allobjectivescode = $prefix = '';
           $objectiveIDPK = $this->registry_model->get_objective_id_pk($row->risk_registry_id)->result();   //AFTER MERGING TABLES USE $row->risk_Registry_id instead of $row->id
           foreach($objectiveIDPK as $objectiveIDPKValue){
              $objectiveID = $objectiveIDPKValue->objective_id;
              $objectivescodes = $this->catalogsobjectives_model->get_objective_code($objectiveID)->result();    
              foreach ($objectivescodes as $objectivescode){
                  $allobjectivescode .= $prefix . '' . $objectivescode->code . '';
                  $prefix = ', ';
              }              
           }      
      
           $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, 'Objective Affected: '.$allobjectivescode); 
           $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, '');
           $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row,'');
           $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, '');
           $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, ''); 
           $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, ''); 
           $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, '');     
           $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, '');  
           $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, '');
           $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, '');
           $excel_row++;

           /* ROW 4 */
           // CAUSES
           $risk_registry_id = $row->risk_registry_id;  $causes_list='';  $sno=1; //AFTER MERGING TABLES USE $row->risk_Registry_id instead of $row->id
           //convert quarter_id to quarter number
           $quarternumbers = $this->registry_model->getQuarterNumber($postData['quarter_id']); 
           foreach($quarternumbers->result_array() as $quarternumbersvalue){
              $quarternumbernumeric = $quarternumbersvalue['quarter'];
           }
           $causes_datas = $this->registry_model->getRiskCauses($risk_registry_id,$quarternumbernumeric); 
           foreach($causes_datas->result_array() as $rows){
              $causes_list .=  $sno.'. '.$rows['causes'].''.PHP_EOL;
              $sno++;
           } 
           $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row,  $causes_list); 

           // EVENTS
           $risk_registry_id = $row->risk_registry_id;  $events_list='';  $sno=1;  //AFTER MERGING TABLES USE $row->risk_Registry_id instead of $row->id
           $events_datas = $this->registry_model->getRiskEvents($risk_registry_id,$quarternumbernumeric); 
           foreach($events_datas->result_array() as $rows){
              $events_list .=  $sno.'. '.$rows['events'].''.PHP_EOL;
              $sno++;
           } 
           $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row,  $events_list );   

           // CONSEQUENCES
           $risk_registry_id = $row->risk_registry_id;  $consequences_list='';  $sno=1;  //AFTER MERGING TABLES USE $row->risk_Registry_id instead of $row->id
           $consequences_datas = $this->registry_model->getRiskConsequences($risk_registry_id,$quarternumbernumeric); 
           foreach($consequences_datas->result_array() as $rows){
              $consequences_list .=  $sno.'. '.$rows['consequences'].''.PHP_EOL;
              $sno++;
           } 
           $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row,  $consequences_list );   

           // IMPACT
           $impact = $row->impact_scale_id;
           if ( in_array($impact, range(1,2)) ) {
              $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row,   $impact )->getStyle('E'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('008000');  
           }elseif ($impact==3) {
              $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row,   $impact )->getStyle('E'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFBF00'); 
           }elseif (in_array($impact, range(4,5))) {
              $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row,   $impact )->getStyle('E'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000'); 
           }else{
              $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row,   $impact )->getStyle('E'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000'); 
           }            

           // LIKELIHOOD
           $likelihood = $row->like_hood_scale_id;
           if ( in_array($likelihood, range(1,2)) ) {
              $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,   $likelihood )->getStyle('F'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('008000');  
           }elseif ($likelihood==3) {
              $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,    $likelihood )->getStyle('F'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFBF00'); 
           }elseif (in_array($likelihood, range(4,5))) {
              $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,    $likelihood )->getStyle('F'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000'); 
           }else{
              $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,    $likelihood )->getStyle('F'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000'); 
           }  

           // MAGNITUDE
           $magnitude= number_format((int)$row->impact_scale_id*$row->like_hood_scale_id, 2, '.', '');
           if ( in_array($magnitude, range(1,7)) ) {
               //getStyle('A'.$excel_row.'G'.$excel_row)
              $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,  $magnitude )->getStyle('G'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('008000'); 
           }elseif (in_array($magnitude, range(8,14))) {
              //getStyle('A'.$excel_row.'G'.$excel_row)
              $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,  $magnitude )->getStyle('G'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFBF00'); 
           }elseif (in_array($magnitude, range(15,25))) {
              //getStyle('A'.$excel_row.'G'.$excel_row)
              $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,  $magnitude )->getStyle('G'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');   
           }else{ //there is an issue display black
              //getStyle('A'.$excel_row.'G'.$excel_row)
              $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,  $magnitude )->getStyle('G'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000');    
           }

           // EXISITING CONTROLS
           $risk_registry_id = $row->risk_registry_id;  $excontrols_list='';  $sno=1; //AFTER MERGING TABLES USE $row->risk_Registry_id instead of $row->id
           $excontrols_datas = $this->registry_model->getRiskExistingControls($risk_registry_id,$quarternumbernumeric); 
           foreach($excontrols_datas->result_array() as $rows){
              $excontrols_list .=  $sno.'. '.$rows['excontrols'].''.PHP_EOL;
              $sno++;
           } 
           $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,  $excontrols_list ); 

           // PERCEIVED EFFECTIVENESS CONTROLS 
           $effectivenesscontrol = $row->controls_effectiveness_scale_id;
           if ( in_array($effectivenesscontrol, range(1,2)) ) {
              $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,   $effectivenesscontrol )->getStyle('I'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('008000');  
           }elseif ($effectivenesscontrol==3) {
              $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,    $effectivenesscontrol )->getStyle('I'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFBF00'); 
           }elseif (in_array($effectivenesscontrol, range(4,5))) {
              $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,    $effectivenesscontrol )->getStyle('I'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000'); 
           }else{
              $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,    $effectivenesscontrol )->getStyle('I'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000'); 
           }   

           // RESIDUAL RISK SCORE
           $residual_risk_score= ceil($magnitude/$row->controls_effectiveness_scale_id); //round up
           if ( in_array($residual_risk_score, range(1,7)) ) {
               //getStyle('A'.$excel_row.'G'.$excel_row)
               $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,   $residual_risk_score )->getStyle('J'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('008000');      
           }elseif (in_array($residual_risk_score, range(8,14))) {
              //getStyle('A'.$excel_row.'G'.$excel_row)
              $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,   $residual_risk_score )->getStyle('J'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFBF00');      
           }elseif (in_array($residual_risk_score, range(15,25))) {
              //getStyle('A'.$excel_row.'G'.$excel_row)
              $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,   $residual_risk_score )->getStyle('J'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');         
           }else{ //there is an issue display black
              //getStyle('A'.$excel_row.'G'.$excel_row)
              $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,   $residual_risk_score )->getStyle('J'.$excel_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000');       
           } 
          
           // ADDITIONAL CONTROLS
           $risk_registry_id = $row->risk_registry_id;  $adcontrols_list='';  $sno=1; //AFTER MERGING TABLES USE $row->risk_Registry_id instead of $row->id
           $adcontrols_datas = $this->registry_model->getRiskAdditionalControls($risk_registry_id,$quarternumbernumeric); 
           foreach($adcontrols_datas->result_array() as $rows){
              $adcontrols_list .=  $sno.'. '.$rows['adcontrols'].''.PHP_EOL;
              $sno++;
           }
           $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row,  $adcontrols_list ); 

           //piga queiry ya kufata status remarks and forward trnds for hii quiter id+registry id

          //Detect $postData['year_id'] maps to which year number ..detect the ID from export dropdown
          $yearnumbers = $this->registry_model->getYearNumber($postData['year_id']); 
          foreach($yearnumbers->result_array() as $yearnumbersvalue){
             $yearnumbernumeric = $yearnumbersvalue['year'];
          }

          //Detect $postData['quarter_id'] maps to which quarter number ..detect the ID from export dropdown
          $quarternumbers = $this->registry_model->getQuarterNumber($postData['quarter_id']); 
          foreach($quarternumbers->result_array() as $quarternumbersvalue){
             $quarternumbernumeric = $quarternumbersvalue['quarter'];
          }
          //echo '<pre>'; print_r($quarternumbernumeric); echo '</pre>';

          

          //var_dump($postData['year_id']);
          //die();

          //$quarterhistory = $this->registry_model->getQuarterHistory($row->id,$quarternumbernumeric)->result(); 
          //USE THIS AFTER MERGING THE 2 TABLES
          $quarterhistory = $this->registry_model->getQuarterHistory($row->risk_registry_id,$quarternumbernumeric,$postData['year_id'])->result(); //AFTER MERGING TABLES USE $row->risk_Registry_id instead of $row->id
          
          // echo '<pre>'; print_r($quarterhistory); echo '</pre>';
          //  die();            

          //use $numberOfQuarters to know number of loops for headers
          //data for each geader will check $rows->quarter_id
          //pull should give only one quarter_id with data...sio quarter 1 iko na two remarks
       
          foreach($quarterhistory as $historyrows){                
              //RANDOM GENERATION OF HEXCODE ON EVERY LOOP
              $result = array('hex' => '');
              foreach(array('r', 'b', 'g') as $col){
                  $rand = mt_rand(0, 255);
                  
                  $dechex = dechex($rand);
                  if(strlen($dechex) < 2){
                      $dechex = '0' . $dechex;
                  }
                  $result['hex'] .= $dechex;
              }                
              $QuarterHistoryStyleArray = array(
                  'alignment' => array(
                      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER ,
                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER  ,
                      'wrap' => true
                  ),
                  // 'fill' => array(
                  //      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                  //      'color' => array('rgb' => $result['hex'])
                  //  ),
                  'font'  => array(
                          'bold'  => true
                   )
              );

              $AmberStyleArray = array(
                  'fill' => array(
                         'color' => array('rgb' => 'FFBF00')
                     )
              );
              $RedStyleArray = array(
                  'fill' => array(
                         'color' => array('rgb' => 'FF0000')
                     )
              );
              $GreenStyleArray = array(
                  'fill' => array(
                         'color' => array('rgb' => '#008000 ')
                     )
              );

              //convert quarter_id PK to quarter so as to know which qurter number is it..pass quarter_id and get quarter number
              //grab quarter number via its quarter_id
              $quarternumber = $this->registry_model->getQuarterNumber($historyrows->quarter_id); 
               foreach($quarternumber->result_array() as $quarternumbervalue){
                  $quartervalue = $quarternumbervalue['quarter'];
               }  
               //check for qurter number and display on specific section
               if($quartervalue == 1){   
                      //var_dump('iam 1');             
                      $historycolumnnumbercount= (int) 11; //INTIAL COLUMN NUMBER FOR REGISTRY HISTORY
                      $historycolumnlettercount='L'; //INTIAL LETTER FOR 1st REGISTRY HISTORY

                      $cell=$historycolumnlettercount.'2'; //APPEND 2 COZ HEADER CELL FOR THIS LOPP IS written on row 2
                      $historycolumnstart = $historycolumnlettercount.'1';
                      $object->getActiveSheet()->setCellValue($cell, 'Status');
                      $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                      $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row,  $historyrows->status ); 
                      $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH

                      $historycolumnnumbercount+=1;  
                      $historycolumnlettercount++;
                      $cell=$historycolumnlettercount.'2';
                      $object->getActiveSheet()->setCellValue($cell, 'Remarks');
                      $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                      $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row,  $historyrows->remarks ); 
                      $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH
                      
                      $historycolumnnumbercount+=1;
                      $historycolumnlettercount++;
                      $cell=$historycolumnlettercount.'2';
                      $historycolumnend = $historycolumnlettercount.'1';
                      $object->getActiveSheet()->setCellValue($cell, 'Forward Trends');
                      $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                  
                      $colrow=$historycolumnlettercount.''.$excel_row;
                      if($historyrows->trends_id==1){ //compare to ids
                        // $trends='Upward - Green';  
                        // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('008000');//GREEN     
                        if(file_exists(FCPATH.'application/views/registry/icons/upward-green.png')){
                          $objDrawing = new PHPExcel_Worksheet_Drawing();
                          $signature = FCPATH.'application/views/registry/icons/upward-green.png';    
                          $objDrawing->setPath($signature);
                          $objDrawing->setResizeProportional(true);
                          $objDrawing->setOffsetX(20); //setOffsetX works properly
                          $objDrawing->setOffsetY(20);    
                          $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                          $objDrawing->setHeight(30);
                          $objDrawing->setWidth(18);  
                          $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                        }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                      }elseif($historyrows->trends_id==2){
                        // $trends='Downward - Red';
                        // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FF0000');//RED
                        if(file_exists(FCPATH.'application/views/registry/icons/downward-red.png')){
                          $objDrawing = new PHPExcel_Worksheet_Drawing();
                          $signature = FCPATH.'application/views/registry/icons/downward-red.png';    
                          $objDrawing->setPath($signature);
                          $objDrawing->setResizeProportional(true);
                          $objDrawing->setOffsetX(20); //setOffsetX works properly
                          $objDrawing->setOffsetY(20);    
                          $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                          $objDrawing->setHeight(30);
                          $objDrawing->setWidth(18);  
                          $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                        }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                      }elseif($historyrows->trends_id==3){
                        // $trends='Constant - Amber';
                        // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                        if(file_exists(FCPATH.'application/views/registry/icons/constant-amber.png')){
                          $objDrawing = new PHPExcel_Worksheet_Drawing();
                          $signature = FCPATH.'application/views/registry/icons/constant-amber.png';    
                          $objDrawing->setPath($signature);
                          $objDrawing->setResizeProportional(true);
                          $objDrawing->setOffsetX(20); //setOffsetX works properly
                          $objDrawing->setOffsetY(20);    
                          $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                          $objDrawing->setHeight(30);
                          $objDrawing->setWidth(18);  
                          $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                        }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                      }elseif($historyrows->trends_id==12){
                        // $trends='Upward - Amber';
                        // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                        if(file_exists(FCPATH.'application/views/registry/icons/upward-amber.png')){
                          $objDrawing = new PHPExcel_Worksheet_Drawing();
                          $signature = FCPATH.'application/views/registry/icons/upward-amber.png';    
                          $objDrawing->setPath($signature);
                          $objDrawing->setResizeProportional(true);
                          $objDrawing->setOffsetX(20); //setOffsetX works properly
                          $objDrawing->setOffsetY(20);    
                          $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                          $objDrawing->setHeight(30);
                          $objDrawing->setWidth(18);  
                          $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                        }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                      }elseif($historyrows->trends_id==9){
                        // $trends='Constant - Green';
                        // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('008000');//GREEN
                        if(file_exists(FCPATH.'application/views/registry/icons/constant-green.png')){
                          $objDrawing = new PHPExcel_Worksheet_Drawing();
                          $signature = FCPATH.'application/views/registry/icons/constant-green.png';    
                          $objDrawing->setPath($signature);
                          $objDrawing->setResizeProportional(true);
                          $objDrawing->setOffsetX(20); //setOffsetX works properly
                          $objDrawing->setOffsetY(20);    
                          $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                          $objDrawing->setHeight(30);
                          $objDrawing->setWidth(18);  
                          $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                        }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                      }elseif($historyrows->trends_id==10){
                        // $trends='Constant - Red';
                        // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FF0000');//RED
                        if(file_exists(FCPATH.'application/views/registry/icons/constant-red.png')){
                          $objDrawing = new PHPExcel_Worksheet_Drawing();
                          $signature = FCPATH.'application/views/registry/icons/constant-red.png';    
                          $objDrawing->setPath($signature);
                          $objDrawing->setResizeProportional(true);
                          $objDrawing->setOffsetX(20); //setOffsetX works properly
                          $objDrawing->setOffsetY(20);    
                          $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                          $objDrawing->setHeight(30);
                          $objDrawing->setWidth(18);  
                          $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                        }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                      }elseif($historyrows->trends_id==11){
                        // $trends='Downward - Amber';
                        // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                        if(file_exists(FCPATH.'application/views/registry/icons/downward-amber.png')){
                          $objDrawing = new PHPExcel_Worksheet_Drawing();
                          $signature = FCPATH.'application/views/registry/icons/downward-amber.png';    
                          $objDrawing->setPath($signature);
                          $objDrawing->setResizeProportional(true);
                          $objDrawing->setOffsetX(20); //setOffsetX works properly
                          $objDrawing->setOffsetY(20);    
                          $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                          $objDrawing->setHeight(30);
                          $objDrawing->setWidth(18);  
                          $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                        }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                      }else{
                        $trends='Error';
                        $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, $trends ); 
                      }                        
                      //$object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, $trends ); 
                     // $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH

                      //define headers for first register history
                      $object->setActiveSheetIndex()->mergeCells("".($historycolumnstart).":".($historycolumnend));
                      $object->getActiveSheet()->setCellValue($historycolumnstart,  'End of Quarter '.$quartervalue.' - '.$yearnumbernumeric);
                      $object->getActiveSheet()->getStyle($historycolumnstart)->applyFromArray($QuarterHistoryStyleArray);
               }elseif($quartervalue == 2){  
                   //var_dump('iam 2');               
                   $historycolumnnumbercount=14; //INTIAL COLUMN NUMBER FOR REGISTRY HISTORY
                   $historycolumnlettercount='O'; //INTIAL LETTER FOR 2nd REGISTRY HISTORY

                   $cell=$historycolumnlettercount.'2'; //APPEND 2 COZ HEADER CELL FOR THIS LOPP IS written on row 2
                   $historycolumnstart = $historycolumnlettercount.'1';
                   $object->getActiveSheet()->setCellValue($cell, 'Status');
                   $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                   $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row,  $historyrows->status ); 
                   $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH

                   $historycolumnnumbercount+=1;  
                   $historycolumnlettercount++;
                   $cell=$historycolumnlettercount.'2';
                   $object->getActiveSheet()->setCellValue($cell, 'Remarks');
                   $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                   $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row,  $historyrows->remarks ); 
                   $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH
                   
                   $historycolumnnumbercount+=1;
                   $historycolumnlettercount++;
                   $cell=$historycolumnlettercount.'2';
                   $historycolumnend = $historycolumnlettercount.'1';
                   $object->getActiveSheet()->setCellValue($cell, 'Forward Trends');
                   $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                   
                   $colrow=$historycolumnlettercount.''.$excel_row;
                   if($historyrows->trends_id==1){ //compare to ids
                     // $trends='Upward - Green';  
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('008000');//GREEN     
                     if(file_exists(FCPATH.'application/views/registry/icons/upward-green.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/upward-green.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==2){
                     // $trends='Downward - Red';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FF0000');//RED
                     if(file_exists(FCPATH.'application/views/registry/icons/downward-red.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/downward-red.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==3){
                     // $trends='Constant - Amber';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                     if(file_exists(FCPATH.'application/views/registry/icons/constant-amber.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/constant-amber.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==12){
                     // $trends='Upward - Amber';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                     if(file_exists(FCPATH.'application/views/registry/icons/upward-amber.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/upward-amber.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==9){
                     // $trends='Constant - Green';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('008000');//GREEN
                     if(file_exists(FCPATH.'application/views/registry/icons/constant-green.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/constant-green.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==10){
                     // $trends='Constant - Red';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FF0000');//RED
                     if(file_exists(FCPATH.'application/views/registry/icons/constant-red.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/constant-red.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==11){
                     // $trends='Downward - Amber';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                     if(file_exists(FCPATH.'application/views/registry/icons/downward-amber.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/downward-amber.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }else{
                     $trends='Error';
                     $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, $trends ); 
                   } 

                   // $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, $trends ); 
                   // $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH

                   //define headers for first register history
                   $object->setActiveSheetIndex()->mergeCells("".($historycolumnstart).":".($historycolumnend));
                   $object->getActiveSheet()->setCellValue($historycolumnstart,  'End of Quarter '.$quartervalue.' - '.$yearnumbernumeric);
                   $object->getActiveSheet()->getStyle($historycolumnstart)->applyFromArray($QuarterHistoryStyleArray);
               }
               elseif($quartervalue == 3){
                   //var_dump('iam 3'); 
                   $historycolumnnumbercount=17; //INTIAL COLUMN NUMBER FOR REGISTRY HISTORY
                   $historycolumnlettercount='R'; //INTIAL LETTER FOR 3rd REGISTRY HISTORY

                   $cell=$historycolumnlettercount.'2'; //APPEND 2 COZ HEADER CELL FOR THIS LOPP IS written on row 2
                   $historycolumnstart = $historycolumnlettercount.'1';
                   $object->getActiveSheet()->setCellValue($cell, 'Status');
                   $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                   $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row,  $historyrows->status ); 
                   $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH

                   $historycolumnnumbercount+=1;  
                   $historycolumnlettercount++;
                   $cell=$historycolumnlettercount.'2';
                   $object->getActiveSheet()->setCellValue($cell, 'Remarks');
                   $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                   $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row,  $historyrows->remarks ); 
                   $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH
                   
                   $historycolumnnumbercount+=1;
                   $historycolumnlettercount++;
                   $cell=$historycolumnlettercount.'2';
                   $historycolumnend = $historycolumnlettercount.'1';
                   $object->getActiveSheet()->setCellValue($cell, 'Forward Trends');
                   $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                   
                   $colrow=$historycolumnlettercount.''.$excel_row;
                   if($historyrows->trends_id==1){ //compare to ids
                     // $trends='Upward - Green';  
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('008000');//GREEN     
                     if(file_exists(FCPATH.'application/views/registry/icons/upward-green.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/upward-green.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==2){
                     // $trends='Downward - Red';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FF0000');//RED
                     if(file_exists(FCPATH.'application/views/registry/icons/downward-red.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/downward-red.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==3){
                     // $trends='Constant - Amber';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                     if(file_exists(FCPATH.'application/views/registry/icons/constant-amber.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/constant-amber.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==12){
                     // $trends='Upward - Amber';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                     if(file_exists(FCPATH.'application/views/registry/icons/upward-amber.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/upward-amber.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==9){
                     // $trends='Constant - Green';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('008000');//GREEN
                     if(file_exists(FCPATH.'application/views/registry/icons/constant-green.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/constant-green.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==10){
                     // $trends='Constant - Red';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FF0000');//RED
                     if(file_exists(FCPATH.'application/views/registry/icons/constant-red.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/constant-red.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==11){
                     // $trends='Downward - Amber';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                     if(file_exists(FCPATH.'application/views/registry/icons/downward-amber.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/downward-amber.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }else{
                     $trends='Error';
                     $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, $trends ); 
                   } 

                   // $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, $trends ); 
                   // $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH

                   //define headers for register history
                   $object->setActiveSheetIndex()->mergeCells("".($historycolumnstart).":".($historycolumnend));
                   $object->getActiveSheet()->setCellValue($historycolumnstart,  'End of Quarter '.$quartervalue.' - '.$yearnumbernumeric);
                   $object->getActiveSheet()->getStyle($historycolumnstart)->applyFromArray($QuarterHistoryStyleArray);
               }elseif($quartervalue == 4){
                   //var_dump('iam 4'); 
                   $historycolumnnumbercount=20; //INTIAL COLUMN NUMBER FOR REGISTRY HISTORY
                   $historycolumnlettercount='U'; //INTIAL LETTER FOR 4th REGISTRY HISTORY

                   $cell=$historycolumnlettercount.'2'; //APPEND 2 COZ HEADER CELL FOR THIS LOPP IS written on row 2
                   $historycolumnstart = $historycolumnlettercount.'1';
                   $object->getActiveSheet()->setCellValue($cell, 'Status');
                   $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                   $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row,  $historyrows->status ); 
                   $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH

                   $historycolumnnumbercount+=1;  
                   $historycolumnlettercount++;
                   $cell=$historycolumnlettercount.'2';
                   $object->getActiveSheet()->setCellValue($cell, 'Remarks');
                   $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                   $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row,  $historyrows->remarks ); 
                   $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH
                   
                   $historycolumnnumbercount+=1;
                   $historycolumnlettercount++;
                   $cell=$historycolumnlettercount.'2';
                   $historycolumnend = $historycolumnlettercount.'1';
                   $object->getActiveSheet()->setCellValue($cell, 'Forward Trends');
                   $object->getActiveSheet()->getStyle($cell)->applyFromArray($QuarterHistoryStyleArray);
                   
                   $colrow=$historycolumnlettercount.''.$excel_row;
                   if($historyrows->trends_id==1){ //compare to ids
                     // $trends='Upward - Green';  
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('008000');//GREEN     
                     if(file_exists(FCPATH.'application/views/registry/icons/upward-green.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/upward-green.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==2){
                     // $trends='Downward - Red';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FF0000');//RED
                     if(file_exists(FCPATH.'application/views/registry/icons/downward-red.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/downward-red.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==3){
                     // $trends='Constant - Amber';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                     if(file_exists(FCPATH.'application/views/registry/icons/constant-amber.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/constant-amber.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==12){
                     // $trends='Upward - Amber';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                     if(file_exists(FCPATH.'application/views/registry/icons/upward-amber.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/upward-amber.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==9){
                     // $trends='Constant - Green';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('008000');//GREEN
                     if(file_exists(FCPATH.'application/views/registry/icons/constant-green.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/constant-green.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==10){
                     // $trends='Constant - Red';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FF0000');//RED
                     if(file_exists(FCPATH.'application/views/registry/icons/constant-red.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/constant-red.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }elseif($historyrows->trends_id==11){
                     // $trends='Downward - Amber';
                     // $object->getActiveSheet()->getStyle($colrow)->getFont()->getColor()->setRGB('FFBF00');//AMBER
                     if(file_exists(FCPATH.'application/views/registry/icons/downward-amber.png')){
                       $objDrawing = new PHPExcel_Worksheet_Drawing();
                       $signature = FCPATH.'application/views/registry/icons/downward-amber.png';    
                       $objDrawing->setPath($signature);
                       $objDrawing->setResizeProportional(true);
                       $objDrawing->setOffsetX(20); //setOffsetX works properly
                       $objDrawing->setOffsetY(20);    
                       $objDrawing->setCoordinates($colrow); //set image to cell $colrow
                       $objDrawing->setHeight(30);
                       $objDrawing->setWidth(18);  
                       $objDrawing->setWorksheet($object->getActiveSheet()); //save 
                     }else{ $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, "Icon Not Found!" ); }
                   }else{
                     $trends='Error';
                     $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, $trends ); 
                   } 

                   // $object->getActiveSheet()->setCellValueByColumnAndRow($historycolumnnumbercount, $excel_row, $trends ); 
                   // $object->getActiveSheet()->getColumnDimension($historycolumnlettercount)->setWidth(15); //SET COLUMN WIDTH

                   //define headers for register history
                   $object->setActiveSheetIndex()->mergeCells("".($historycolumnstart).":".($historycolumnend));
                   $object->getActiveSheet()->setCellValue($historycolumnstart,  'End of Quarter '.$quartervalue.' - '.$yearnumbernumeric);
                   $object->getActiveSheet()->getStyle($historycolumnstart)->applyFromArray($QuarterHistoryStyleArray);
               }else{
                  var_dump('Error in getting Quarter value Variable');die();
               } 
          }
          //die();
          $firstdisplay= $row->risk_registry_id;

           $excel_row++; //next row in excel
         }       
    
        $filename = 'Risk Register_'.date('Ymd').'.xls';  
        //name the worksheet
        $object->getActiveSheet()->setTitle($filename);
            
        header('Content-Type: application/vnd.ms-excel');
               
        header("Content-Disposition: attachment;filename=$filename");
        // Clean (erase) the output buffer and turn off output buffering
        ob_end_clean(); 

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');      
        $object_writer->save('php://output');
        exit;
    }

    public function riskRegisterList(){
       // POST data
       $postData = $this->input->post();
       // Get data
       $data = $this->registry_model->getRiskRegister($postData);
         //var_dump($postData); die();
       echo json_encode($data);
    }

    //RISK REGISTER LIST AT DASHBOARD
    public function dashboardRiskRegisterList(){
      //POST data
      $postData = $this->input->post();
      //echo '<pre>' , var_dump($postData) , '</pre>';
      //Get data
      $data = $this->registry_model->getDashboardRiskRegister($postData);  
      echo json_encode($data);   
    }


}