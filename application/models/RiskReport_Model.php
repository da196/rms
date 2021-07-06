<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class RiskReport_Model extends CI_Model {


    function __construct(){
      parent::__construct();
      


      $this->load->model('user_model'); 
      $this->load->model('risk_model'); 
    }



    // private $_emergingRisk;
    // private $_informationSource;
    // private $_startDate;
    // private $_endDate;
    // private $_date_reported;

    // public function setEmergingRisk($emergingRisk) {
    //     $this->_emergingRisk = $emergingRisk;
    // }
    // public function setReportedBy($informationSource) {
    //     $this->_informationSource = $informationSource;
    // }    
    // public function setStartDate($startDate) {
    //     $this->_startDate = $startDate;
    // }
    // public function setEndDate($endDate) {
    //     $this->_endDate = $endDate;
    // }

    // public function setDateReported($date_reported) {
    //     $this->_date_reported = $date_reported;
    // }

    
    // // get Orders List
    // public function getOrders() {        
    //     $this->db->select(array('name', 'information_source', 'remarks', 'date_reported', 'reporter_id', 'status_id'));
    //     $this->db->from('erms_risk_emerging');
    //     if(!empty($this->_startDate) && !empty($this->_endDate)) {


    //         $this->db->where('\''.date(DATE_FORMAT_SIMPLE,  strtotime($this->_date_reported)) .'\' BETWEEN \'' . $this->_startDate . '\' AND \'' . $this->_endDate . '\'');


    //     }        
    //     if(!empty($this->_emergingRisk)){
    //         $this->db->where('name', $this->_emergingRisk);
    //     }        
    //     if(!empty($this->_informationSource)){            
    //         $this->db->like('informationSource', $this->_informationSource, 'both');
    //     }       
    //     $this->db->order_by('date_reported', 'DESC');
    //     $query = $this->db->get();
    //     //var_dump($this->_emergingRisk); die();
    //     return $query->result_array();

    // }






  // Get DataTable data
     function getEmergingRisks($postData=null){
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
       $status_id = $postData['status_id'];
       $reporter_id = $postData['reporter_id'];
       $startDate = $postData['startDate'];
       $endDate = $postData['endDate'];
       ## Search 
       $search_arr = array();
       $searchQuery = "";
       if($searchValue != ''){
          $search_arr[] = " (status_id like '%".$searchValue."%' or 
           reporter_id like'%".$searchValue."%' or 
           date_reported >= '".$searchValue."' ) ";
       } 
       if($status_id != ''){
          $search_arr[] = " status_id='".$status_id."' "; //for dropdowns
          //  $search_arr[] = " status_id like '%".$status_id."%' ";  //for normal inputs
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
       $this->db->where('status_id !=',2); //EXCLUDE DELETED STATUS
       $records = $this->db->get('erms_risk_emerging')->result();
       $totalRecords = $records[0]->allcount;

       ## Total number of record with filtering
       $this->db->select('count(*) as allcount');
       $this->db->where('status_id !=',2); //EXCLUDE DELETED STATUS
       if($searchQuery != '')
       $this->db->where($searchQuery);
       $records = $this->db->get('erms_risk_emerging')->result();
       $totalRecordwithFilter = $records[0]->allcount;

       ## Fetch records
       $this->db->select('*');
       $this->db->where('status_id !=',2); //EXCLUDE DELETED STATUS
       if($searchQuery != ''){
            $this->db->where($searchQuery);
       }       
       $this->db->order_by($columnName, $columnSortOrder);
       //$this->db->order_by('date_reported', 'DESC');
       $this->db->limit($rowperpage, $start);
       $records = $this->db->get('erms_risk_emerging')->result();
       $data = array();
       foreach($records as $record ){
          //map reporter ID to email
          $get_data = $this->user_model->get_user_email($record->reporter_id)->result();  
          foreach($get_data as $value)  
          {  
             $reporter_id = $value->email;  
          }
          //map status ID to name
          $get_data = $this->risk_model->get_risk_statuses_name($record->status_id)->result();  
          foreach($get_data as $value)  
          {  
             $status_id = $value->status;  
          }
         $data[] = array( 
           "name"=>$record->name,  
           "reporter_id"=>$reporter_id,
           "date_reported"=>date("d-m-Y", strtotime($record->date_reported)), //format to to display d-m-Y
           "status_id"=>$status_id
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



     function getEmergingRisksReport($postData=null){
        //$searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
       $status_id = $postData['status_id'];    
       //$status_id = $postData['status_id'] ?? '';
      

        $reporter_id = $postData['reporter_id'];

        //$startDate = $postData['startDate'];
      

        //$endDate = $postData['endDate'];

        ## Search 
        $search_arr = array();
        $searchQuery = "";
        // if($searchValue != ''){
        //    $search_arr[] = " (status_id like '%".$searchValue."%' or 
        //     reporter_id like'%".$searchValue."%' or 
        //     date_reported >= '".$searchValue."' ) ";
        // }
        

        if($status_id != ''){
           $search_arr[] = " status_id='".$status_id."' "; //for dropdowns
           //  $search_arr[] = " status_id like '%".$status_id."%' ";  //for normal inputs
        }
        if($reporter_id != ''){
          $search_arr[] = " reporter_id='".$reporter_id."' "; //for dropdowns
           //$search_arr[] = " reporter_id like '%".$reporter_id."%' ";  //for normal inputs
        }

        // if($startDate != '' && $endDate ==''){
        //    $search_arr[] = " date_reported >= '".$startDate."' ";
        // }

        // if($startDate == '' && $endDate !=''){
        //    $search_arr[] = " date_reported <= '".$endDate."' ";
        // }

        // if($endDate != '' && $startDate !=''){
        //    $search_arr[] = " date_reported >= '".$startDate."' AND date_reported <= '".$endDate."'";
        // }

        if(count($search_arr) > 0){
           $searchQuery = implode(" and ",$search_arr);
        }

        ## Fetch records
        $this->db->select('*');
        if($searchQuery != ''){
             $this->db->where($searchQuery);
        }
        $this->db->order_by("id", "DESC");
        $query = $this->db->get("erms_risk_emerging");

            //var_dump($query->result()); //die();

        return $query->result();  //on the controller will access it via $row->name
        //return $query->result_array();     //on the controller will access it via $row['name']        
     }

  

      function fetchReportData($postData=null){

        $search_arr = array();
        $searchQuery = "";

        $status_id =  $postData['status_id']; 
        $reporter_id =  $postData['reporter_id']; 
        $startDate =  $postData['startDate']; 
        $endDate =  $postData['endDate']; 

        if($status_id != ''){
           $search_arr[] = " status_id='".$status_id."' ";
        }
        if($reporter_id != ''){
          $search_arr[] = " reporter_id='".$reporter_id."' ";
        }
        if($startDate != '' && $endDate != ''){
          $search_arr[] = " date_reported BETWEEN CAST('".$startDate."' AS DATE) AND CAST('".$endDate."' AS DATE) ";          
        }else{
          if($startDate != '' && $endDate ==''){
            $search_arr[] = " date_reported >= '".$startDate."' ";
          }
          if($startDate == '' && $endDate != ''){
            $search_arr[] = " date_reported <= '".$endDate."' ";
          }   
        }
       

        if(count($search_arr) > 0){
           $searchQuery = implode(" and ",$search_arr);
        }

        //var_dump($searchQuery); die();

        if($searchQuery != ''){
            $this->db->where($searchQuery);  //var_dump( $this->db->where($searchQuery) ); 
        }

        $this->db->where('status_id !=', 2); //EXCLUDE DELETED STATUS

        $this->db->order_by("id", "ASC");
         
        $query = $this->db->get("erms_risk_emerging");
        return $query->result();
      }


}
