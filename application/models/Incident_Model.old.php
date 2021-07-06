<?php

Class Incident_Model extends CI_Model{

    // Incident_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();
        // Load the database
        $this->load->database();  
        $this->load->model('Section_Model','section_model');
        $this->load->model('Directorate_Model','directorate_model');            
    }

     // Insert Incident 
    public function insert_incident($data = array()){

        return $this->db->insert("erms_risk_incident",$data);
    }

    // Get all the Incident
    public function get_incident($inc_id,$rep_id,$esc_id){
        $this->db->select('eri.*,eu.email,ers.section_name,erd.directorate_name');
        $this->db->from('erms_risk_incident as eri');
        $this->db->join('erms_user as eu', 'eri.reporter_id = eu.id');
        $this->db->join('erms_risk_directorate as erd', 'erd.id = eri.directorate_id');
        $this->db->join('erms_risk_section as ers', 'ers.id = eri.section_id');

        if(!empty($inc_id)){
            $this->db->where('eri.id',$inc_id);
        }
        
        if(!empty($rep_id)){
            $this->db->where('eri.reporter_id',$rep_id);
        }

        if(!empty($esc_id)){

            //$this->db->or_where('id', $id);

            $this->db->or_where('eri.esc_user_id',$esc_id);
        }

        $this->db->order_by('eri.id', 'DESC');
       
        $query = $this->db->get();
        return $query;

    }

    // Get all the Consequences 
    public function get_incident_consequences($inc_id){
        $this->db->select('eic.*');
        $this->db->from('erms_risk_incident_consequences as eic');

        if(!empty($inc_id)){
            $this->db->where('eic.incident_id',$inc_id);
        }
       
        $query = $this->db->get();
        return $query;
    }

    // Get all the Mitigation
    public function get_incident_mitigation($inc_id){
        $this->db->select('eim.*');
        $this->db->from('erms_risk_incident_mitigation as eim');

        if(!empty($inc_id)){
            $this->db->where('eim.incident_id',$inc_id);
        }
       
        $query = $this->db->get();
        return $query;

    }


    //Get all incident risk
    public function incidentriskscount(){
        $this->db->select('*');
        $this->db->from('erms_risk_incident');     
        $query = $this->db->get();
        return $query->num_rows();
    }



/*
    // Retrieve all Emerging Risk (Status as active)
    public function get_risk_emerging($status_code,$risk_id){ 
        $this->db->select('ere.*,eu.email');
        $this->db->from('erms_risk_emerging as ere');
        $this->db->join('erms_user as eu', 'ere.reporter_id = eu.id');
        $this->db->join('erms_risk_status as ers', 'ere.status_id = ers.id');

        if(!empty($status_code)){
            $this->db->where('ere.status_id',$status_code);
        }

        if(!empty($risk_id)){
            $this->db->where('ere.id',$risk_id);
        }
       
        $query = $this->db->get();
        return $query;

    }

    // Fetch A certain Emerging Risk
    public function fetch_risk_emerging($risk_id){

        $this->db->where("risk_id",$risk_id);
        $query = $this->db->get("erms_risk_emerging");  
        return $query->result();      
    }

    // Update Emerging Risk
    public function update_risk_emerging($risk_emerging,$id){
        $this->db->where("id",$id);
        return $this->db->update("erms_risk_emerging",$risk_emerging);
       
    }

    // Delete Emerging Risk
    // Risk Status 1 as New/Active, 2 as Inactive/Deleted , 3 as Evaluated
      public function delete_risk_emerging($risk_id){

        $this->db->set('status_id', 2);
        $this->db->where('id', $risk_id);
        $this->db->update('erms_risk_emerging'); 
        /*
        $query = $this->db->get("erms_risk_emerging");
        if($query->num_rows() > 0){
            return $query->result_array()[0];
            // return $query->result();
        }
        else{
          return false;  
        }
       */ 

    //}

        

          // Get DataTable data
   function getIncidentList($postData=null){
     $response = array();
     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value
     // Custom search filter 
     $reporter_id = $postData['reporter_id'];
     $startDate = $postData['startDate'];
     $endDate = $postData['endDate'];
     ## Search 
     $search_arr = array();
     $searchQuery = "";
     if($searchValue != ''){
        $search_arr[] = " (reporter_id like'%".$searchValue."%' or 
         date_reported >= '".$searchValue."' ) ";
     } 
     if($reporter_id != ''){
       $search_arr[] = " reporter_id='".$reporter_id."' "; //for dropdowns
        //$search_arr[] = " reporter_id like '%".$reporter_id."%' ";  //for normal inputs
     }
     if($startDate != '' && $endDate ==''){
        $search_arr[] = " date_reported >= '".$startDate."' ";
     }
     if($startDate == '' && $endDate !=''){
        $search_arr[] = " date_reported <= '".$endDate."' ";
     }
     if($endDate != '' && $startDate !=''){
        $search_arr[] = " date_reported >= '".$startDate."' AND date_reported <= '".$endDate."'";
     }
     if(count($search_arr) > 0){
        $searchQuery = implode(" and ",$search_arr);
     }
     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $records = $this->db->get('erms_risk_incident')->result();
     $totalRecords = $records[0]->allcount;
     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
     $this->db->where($searchQuery);
     $records = $this->db->get('erms_risk_incident')->result();
     $totalRecordwithFilter = $records[0]->allcount;
     ## Fetch records
     $this->db->select('*');
     if($searchQuery != ''){
          $this->db->where($searchQuery);
     }     
     //$this->db->order_by($columnName, $columnSortOrder); 
     $this->db->order_by('date_reported', 'DESC');
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('erms_risk_incident')->result();
     $data = array();
     foreach($records as $record ){
        //map reporter ID to email
        $get_data = $this->user_model->get_user_email($record->reporter_id)->result();  
        foreach($get_data as $value)  
        {  
           $reporter_id = $value->email;  
        }

        //CONVERT SECTION ID TO NAME
        $get_data = $this->section_model->get_section_name($record->section_id)->result();  
        foreach($get_data as $value)  
        {  
           $section_id = $value->section_name;  
        }

        //CONVERT DIRECTORATE ID TO NAME
        $get_data = $this->directorate_model->get_directorate_name($record->directorate_id)->result();  
        foreach($get_data as $value) 
        {  
           $directorate_id = $value->directorate_name;  
        }

        //map status ID to name
        // $get_data = $this->risk_model->get_risk_statuses_name($record->status_id)->result();  
        // foreach($get_data as $value)  
        // {  
        //    $status_id = $value->status;  
        // }

        //map escalated ID to email
        $get_data = $this->user_model->get_user_email($record->esc_user_id)->result();  
        foreach($get_data as $value)  
        {  
           $esc_user_id = $value->email;  
        }
       $button = '<button class="btn-white btn btn-xs"><i class="fa fa-download"></i>&nbsp;<a href="incident_report/'.$record->id.'" target=_new>Download PDF</a></button>';
       $data[] = array( 
         "description"=>$record->description,  
         "reporter_id"=>$reporter_id,
         "date_reported"=>date("d-m-Y", strtotime($record->date_reported)), //format to to display d-m-Y
         "esc_user_id"=>$esc_user_id,
         "directorate_id"=>$directorate_id,
         "section_id"=>$section_id,
         "button"=> $button
       ); 
     }
     ## Response
     $response = array(
       "draw" => intval($draw),
       "iTotalRecords" => $totalRecords,
       "iTotalDisplayRecords" => $totalRecordwithFilter,
       "aaData" => $data
     );
     return $response; 
   }


   function fetchReportData($postData=null){

     $search_arr = array();
     $searchQuery = "";

     $reporter_id =  $postData['reporter_id']; 
     $startDate =  $postData['startDate']; 
     $endDate =  $postData['endDate']; 

     if($reporter_id != ''){
        $search_arr[] = " reporter_id='".$reporter_id."' ";
     }
   
     if($startDate != '' && $endDate != ''){ //CAST(dob AS DATE)
       //$search_arr[] = " date_created BETWEEN CAST('".$startDate."' AS DATE) AND CAST('".$endDate."' AS DATE) ";  
       //$search_arr[] = " date_created BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:00'";  
       $startDate = date('Y-m-d H:i:s', strtotime($startDate));
       $endDate = date('Y-m-d H:i:s', strtotime($endDate . '+ 1 day')); //gives time in the next date 00:00:00 hrs
       $search_arr[] = " date_created >= '".$startDate."' AND  date_created <= '".$endDate."'";         
     }else{
       if($startDate != '' && $endDate ==''){
         $startDate = date('Y-m-d H:i:s', strtotime($startDate));
         $search_arr[] = " date_created >= '".$startDate."' ";
       }
       if($startDate == '' && $endDate != ''){
         $endDate = date('Y-m-d H:i:s', strtotime($endDate . '+ 1 day')); //gives time in the next date 00:00:00 hrs
         $search_arr[] = " date_created <= '".$endDate."' ";
       }   
     }
    

     if(count($search_arr) > 0){
        $searchQuery = implode(" and ",$search_arr);
     }

    //var_dump($searchQuery); die();

     if($searchQuery != ''){
         $this->db->where($searchQuery);  //var_dump( $this->db->where($searchQuery) ); 
     }

     $this->db->order_by("date_created", "DESC");
     $query = $this->db->get("erms_risk_incident");
     return $query->result();
   }

        
   

}

?>