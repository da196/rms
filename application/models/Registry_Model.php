<?php

Class Registry_Model extends CI_Model{

    // Registry_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
            $this->load->model('Trends_Model','trends_model');
            $this->load->model('Registry_Model','registry_model');
            $this->load->model('Objectives_Category_Model');

            

    }

      public function insert_data_registry($data = array()){

         return $this->db->insert("erms_risk_registry",$data);
         
     }

     // Get All Risk Registry 
     public function get_registry($reg_id,$obj_cat_id){
         $this->db->select('err.*,eu.email,errh.trends_id as trends,errh.quarter_id as quarter,errh.year_id as yr,errh.remarks as rem,eq.quarter_name as qua,errh.status as sts,ey.year, et.trend_name,eoc.objective_category,eic.impact_scale,elhs.like_hood_scale,eces.controls_effectiveness_scale,ero.name');
         $this->db->from('erms_risk_registry as err');
         $this->db->join('erms_user as eu', 'err.reporter_id = eu.id');   
         $this->db->join('erms_objectives_category as eoc', 'err.objective_category_id = eoc.id');
         $this->db->join('erms_risk_owner as ero', 'err.risk_owner_id = ero.id');

         $this->db->join('erms_impact_scale as eic', 'eic.id = err.impact_scale_id');
         $this->db->join('erms_like_hood_scale as elhs', 'elhs.id = err.like_hood_scale_id');
         $this->db->join('erms_controls_effectiveness_scale as eces', 'eces.id = err.controls_effectiveness_scale_id');

         $this->db->join('erms_risk_registry_history as errh', 'errh.risk_registry_id = err.id');
         $this->db->join('erms_trends as et', 'errh.trends_id = et.id');
         $this->db->join('erms_year as ey', 'errh.year_id = ey.id');
         $this->db->join('erms_quarter as eq', 'errh.quarter_id = eq.id');

         $this->db->where('errh.active_code',1);
         $this->db->where('err.active',1);

         if(!empty($reg_id)){
             $this->db->where('err.id',$reg_id);
         }

         if(!empty($obj_cat_id)){
             $this->db->where('err.objective_category_id',$obj_cat_id);
         }
         $this->db->order_by('err.id', 'ASC');
         $query = $this->db->get();
         //$mysql = $this->db->get_compiled_select();
         //print_r($mysql); die();
         return $query;
     }

      // Get Registry Causes 
      public function getRegistry_causes($reg_id){
         $this->db->select('err.*,errca.causes,errca.id as cause_id');
         $this->db->from('erms_risk_registry as err');
         $this->db->join('erms_risk_registry_causes as errca', 'err.id = errca.risk_registry_id');

         $this->db->where('errca.active',1);
         if(!empty($reg_id)){
             $this->db->where('errca.risk_registry_id',$reg_id);
         }
        
         $query = $this->db->get();
         return $query;

     }

     // Get Registry Events 
     public function getRegistry_events($reg_id){
         $this->db->select('err.*,errev.events,errev.id as event_id');
         $this->db->from('erms_risk_registry as err');
         $this->db->join('erms_risk_registry_events as errev', 'err.id = errev.risk_registry_id');
         $this->db->where('errev.active',1);
         if(!empty($reg_id)){
             $this->db->where('errev.risk_registry_id',$reg_id);
         }        
         $query = $this->db->get();
         return $query;
     }

     public function get_risk_register_events($risk_registry_id){
         $this->db->select('errev.id,errev.events');
         $this->db->from('erms_risk_registry as err');
         $this->db->join('erms_risk_registry_events as errev', 'err.id = errev.risk_registry_id');
         $this->db->where('errev.active',1);
         if(!empty($risk_registry_id)){
             $this->db->where('errev.risk_registry_id',$risk_registry_id);
         }        
         $query = $this->db->get();
         return $query;
        // return $query->result();  
     }


     




     // Get Registry Consequences 
     public function getRegistry_consequences($reg_id){
         $this->db->select('err.*,errc.consequences, errc.id as cons_id');
         $this->db->from('erms_risk_registry as err');
         $this->db->join('erms_risk_registry_consequences as errc', 'err.id = errc.risk_registry_id');
         $this->db->where('errc.active',1);

         if(!empty($reg_id)){
             $this->db->where('errc.risk_registry_id',$reg_id);
         }
        
         $query = $this->db->get();
         return $query;

     }

     // Get Registry ExControls 
     public function getRegistry_excontrols($reg_id){
         $this->db->select('err.*,errex.excontrols, errex.id as excontr_id');
         $this->db->from('erms_risk_registry as err');
         $this->db->join('erms_risk_registry_excontrols as errex', 'err.id = errex.risk_registry_id');
         $this->db->where('errex.active',1);

         if(!empty($reg_id)){
             $this->db->where('errex.risk_registry_id',$reg_id);
         }
        
         $query = $this->db->get();
         return $query;

     }

      // Get Registry AdControls 
      public function getRegistry_adcontrols($reg_id){
         $this->db->select('err.*,errad.adcontrols, errad.id as adcontr_id');
         $this->db->from('erms_risk_registry as err');
         $this->db->join('erms_risk_registry_adcontrols as errad', 'err.id = errad.risk_registry_id');
         $this->db->where('errad.active',1);

         if(!empty($reg_id)){
             $this->db->where('errad.risk_registry_id',$reg_id);
         }
        
         $query = $this->db->get();
         return $query;

     }

     // Get Registry Objectives
     public function get_registry_objectives($reg_id){
         $this->db->select('eo.*');
         $this->db->from('erms_objective as eo');
         $this->db->join('erms_risk_registry_objectives as erro', 'eo.id = erro.objective_id');

         if(!empty($reg_id)){
             $this->db->where('erro.risk_registry_id',$reg_id);
         }
        
         $query = $this->db->get();
         return $query;
     }

      // Total count for Reported Risk 
      public function count_RiskRegistered(){
         $this->db->select('err.*');
         $this->db->from('erms_risk_registry as err');
        
         $query = $this->db->get();

         return $query->num_rows();

     }

     // Update the risk registry
     public function update_registry($data,$reg_id){

         $this->db->where('id',$reg_id);
         $this->db->update('erms_risk_registry', $data);     
         $query =  $this->db->get("erms_risk_registry");

         return $query;
        
     }

    /* REPORTS */

    //get all risk of a specified category
    public function getRiskCategoryCount($code){
        $this->db->select('*');
        $this->db->from('erms_risk_registry');
        $this->db->where('objective_category_id',$code);
        $query = $this->db->get();
        return $query->num_rows();
    }

    //GET A COUNT FOR NUMBER OF ITEMS GIVEN ODE
    public function getGreenValueCount($code){
      $minvalue=15;  $maxvalue=25;
      $this->db->select('(impact_scale_id*like_hood_scale_id)/controls_effectiveness_scale_id AS risk_residual_score', FAlSE);
      $this->db->from('erms_risk_registry');
      $this->db->where("(impact_scale_id*like_hood_scale_id)/controls_effectiveness_scale_id BETWEEN $minvalue AND $maxvalue", NULL, FALSE);
      $this->db->where('objective_category_id',$code);
      $query = $this->db->get();
      //var_dump($query->num_rows()); die();
      // $multipleWhere = ['objective_category_id' => $code];
      // $this->db->where($multipleWhere);
      return $query->num_rows();
    }
    public function getAmberValueCount($code){
      $minvalue=8;  $maxvalue=14;
      $this->db->select('(impact_scale_id*like_hood_scale_id)/controls_effectiveness_scale_id AS risk_residual_score', FAlSE);
      $this->db->from('erms_risk_registry');
      $this->db->where("(impact_scale_id*like_hood_scale_id)/controls_effectiveness_scale_id BETWEEN $minvalue AND $maxvalue", NULL, FALSE);
      $this->db->where('objective_category_id',$code);
      $query = $this->db->get();
      // $multipleWhere = ['objective_category_id' => $code];
      // $this->db->where($multipleWhere);
      return $query->num_rows();
    }
    public function getRedValueCount($code){
      $minvalue=0;  $maxvalue=7; //why zero? bcoz on division some get 0.... rounding off to 0
      $this->db->select('(impact_scale_id*like_hood_scale_id)/controls_effectiveness_scale_id AS risk_residual_score', FAlSE);
      $this->db->from('erms_risk_registry');
      $this->db->where("(impact_scale_id*like_hood_scale_id)/controls_effectiveness_scale_id BETWEEN $minvalue AND $maxvalue", NULL, FALSE);
      $this->db->where('objective_category_id',$code);
      $query = $this->db->get();
      // $multipleWhere = ['objective_category_id' => $code];
      // $this->db->where($multipleWhere);
      return $query->num_rows();
    }


     // Get Report DataTable data for view
    function getRiskRegister($postData=null){
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
      $trends_id = $postData['trends_id'];
      // $activity = $postData['activity'];
      $activity = isset($postData['activity'])? $postData['activity'] : '';
 


      $objective_category_id = $postData['objective_category_id'];
      //year_id and quarter_id are not present on erms_risk_registry...hence we shud join with erms_risk_registry_history table
      $quarter_id = $postData['quarter_id'];
      $year_id = $postData['year_id'];
      //var_dump($year_id); die();
      ## Search 
      $search_arr = array();
      $searchQuery = "";
      if($searchValue != ''){
         $search_arr[] = " (trends_id like '%".$searchValue."%' or 
          activity like'%".$searchValue."%'  or 
          objective_category_id like'%".$searchValue."%'  or 
          quarter_id like'%".$searchValue."%'  or 
          year_id like'%".$searchValue."%' ) ";
      }

      if($trends_id != ''){
         $search_arr[] = " trends_id='".$trends_id."' "; //for dropdowns
         //  $search_arr[] = " trends_id like '%".$trends_id."%' ";  //for normal inputs
      }
      if($activity != ''){
         $search_arr[] = " activity='".$activity."' "; //for dropdowns
         //  $search_arr[] = " activity like '%".$activity."%' ";  //for normal inputs
      }
      if($objective_category_id != ''){
        $search_arr[] = " objective_category_id='".$objective_category_id."' "; //for dropdowns
         //$search_arr[] = " objective_category_id like '%".$objective_category_id."%' ";  //for normal inputs
      }
      if($quarter_id != ''){
         $search_arr[] = " quarter_id='".$quarter_id."' "; //for dropdowns
      }
      if($year_id != ''){
         $search_arr[] = " year_id='".$year_id."' "; //for dropdowns
      }    

      if(count($search_arr) > 0){
         $searchQuery = implode(" and ",$search_arr);
      }
      ## Total number of records without filtering
      $this->db->select('count(*) as allcount');
      //join two table: erms_risk_registry AND erms_risk_registry_history
      $this->db->from('erms_risk_registry');
      $this->db->join('erms_risk_registry_history', 'erms_risk_registry_history.risk_registry_id = erms_risk_registry.id');
      $this->db->where('erms_risk_registry.active',1); //only active record
      $records = $this->db->get()->result();
      // $records = $this->db->get('erms_risk_registry')->result();
      $totalRecords = $records[0]->allcount;

      ## Total number of record with filtering
      $this->db->select('count(*) as allcount');
      if($searchQuery != ''){
      $this->db->where($searchQuery);
      }
      $this->db->from('erms_risk_registry');
      $this->db->join('erms_risk_registry_history', 'erms_risk_registry_history.risk_registry_id = erms_risk_registry.id');
      $this->db->where('erms_risk_registry.active',1); //only active record
      $records = $this->db->get()->result();
      // $records = $this->db->get('erms_risk_registry')->result();
      $totalRecordwithFilter = $records[0]->allcount;

      ## Fetch records
      $this->db->select('*');
      if($searchQuery != ''){
           $this->db->where($searchQuery);
      }

      $this->db->limit($rowperpage, $start);
      // $this->db->order_by('erms_risk_registry.date_created', 'desc');
      // $this->db->order_by('erms_risk_registry_history.date_created', 'DESC');
      $this->db->order_by($columnName, $columnSortOrder); //DEFAULT DATATABLE SORT
      $this->db->order_by('erms_risk_registry.activity', 'ASC'); //SORT BY ACTIVITY FIRST
      $this->db->order_by('erms_risk_registry_history.year_id', 'ASC'); //THEN BY YEAR
      $this->db->order_by('erms_risk_registry_history.quarter_id', 'ASC'); //THEN BY QUARTER

      $this->db->from('erms_risk_registry');
      $this->db->join('erms_risk_registry_history', 'erms_risk_registry_history.risk_registry_id = erms_risk_registry.id');
      $this->db->where('erms_risk_registry.active',1); //only active record
      //$this->db->where('erms_risk_registry_history.active_code',1); //only active record //DISPLAY DUPLICATES OF DIFFERENT QUARTERS
      $records = $this->db->get()->result();
      // $records = $this->db->get('erms_risk_registry')->result();


      //var_dump($records); //die();
      $data = array();
      foreach($records as $record ){
         //map risk owner ID to name
         $get_data = $this->risk_model->get_risk_owners_name($record->risk_owner_id)->result();  
         foreach($get_data as $value)  
         {  
            $risk_owner = $value->name;  
         }
         // //map objective ID to code
         // $get_data = $this->catalogsobjectives_model->get_objective_code($record->objective_id)->result();  
         // foreach($get_data as $value)  
         // {  
         //    $objective_id = $value->code;  
         // }

        //check trend and display appropriate icon
        $get_data = $this->trends_model->get_trends_name($record->trends_id)->result();  
        foreach($get_data as $value)  
        {  
            if($value->trend_name == 'Constant - Amber'){  
                $trendsicon = '<span style="color:#FFC200"><i class="fa fa-exchange"></i>&nbsp;Constant</span>'; 
            }elseif ($value->trend_name == 'Constant - Green') {
                $trendsicon = '<span style="color:#008000"><i class="fa fa-exchange"></i>&nbsp;Constant</span>'; 
            }elseif ($value->trend_name == 'Constant - Red') {
                $trendsicon = '<span style="color:#FF0000"><i class="fa fa-exchange"></i>&nbsp;Constant</span>'; 
            }elseif ($value->trend_name == 'Downward - Amber') {
                $trendsicon = '<span style="color:#FFC200"><i class="fa fa-arrow-down"></i>&nbsp;Downward</span>'; 
            }elseif ($value->trend_name == 'Downward - Red') {
                $trendsicon = '<span style="color:#FF0000"><i class="fa fa-arrow-down"></i>&nbsp;Downward</span>'; 
            }elseif ($value->trend_name == 'Upward - Amber') {  
                $trendsicon = '<span style="color:#FFC200"><i class="fa fa-arrow-up"></i>&nbsp;Upward</span>';
            }elseif ($value->trend_name == 'Upward - Green') {  
                $trendsicon = '<span style="color:#008000"><i class="fa fa-arrow-up"></i>&nbsp;Upward</span>';
            }else{
                $trendsicon = 'Unknown';
            }
        }
        $impact_scale_id = $record->impact_scale_id; 
        $like_hood_scale_id = $record->like_hood_scale_id;
        $magnitude = number_format((int)$impact_scale_id*$like_hood_scale_id,0, '.', '');
        $controls_effectiveness_scale_id = $record->controls_effectiveness_scale_id;
        $residualriskscore = ceil($magnitude/$controls_effectiveness_scale_id);

        //map objective_category_id to its name
        $get_data = $this->Objectives_Category_Model->get_objective_category_name($record->objective_category_id)->result();  
        foreach($get_data as $value)  
        {  
           $objective_category_id = $value->objective_category;  
        }
       
        //Map quarter_id to quarter number 
        $quarternumbers = $this->registry_model->getQuarterNumber($record->quarter_id); 
        foreach($quarternumbers->result_array() as $quarternumbersvalue){
           $quarter_id = $quarternumbersvalue['quarter'];
        }
        //Map year_id to year number 
        $yearnumbers = $this->registry_model->getYearNumber($record->year_id); 
        foreach($yearnumbers->result_array() as $yearnumbersvalue){
           $year_id = $yearnumbersvalue['year'];
        }

        $data[] = array( 
          "activity"=>$record->activity,  
          "risk_owner"=>$risk_owner,  
          //"impact_scale_id"=>$impact_scale_id,  
          ///"like_hood_scale_id"=>$like_hood_scale_id,  
          "magnitude"=>$magnitude,  
          //"controls_effectiveness_scale_id"=>$controls_effectiveness_scale_id,  
          "residualriskscore"=>$residualriskscore,

          //this is for dashboard/admin
          "objective_category_id"=>$objective_category_id,
          "quarter_id"=>$quarter_id,
          "year_id"=>$year_id,
          //end dashboard/admin

          "trends_id"=>$trendsicon
          //"date_reported"=>date("d-m-Y", strtotime($record->date_reported)), //format to to display d-m-Y


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

    function getDashboardRiskRegister($postData=null){
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
      $trends_id = $postData['trends_id'];
      // $activity = $postData['activity'];
      $activity = isset($postData['activity'])? $postData['activity'] : '';
      $objective_category_id = $postData['objective_category_id'];
      //year_id and quarter_id are not present on erms_risk_registry...hence we shud join with erms_risk_registry_history table
      $quarter_id = $postData['quarter_id'];
      $year_id = $postData['year_id'];
      //var_dump($objective_category_id); //die();

      ## Search 
      $search_arr = array();  
      $searchQuery = "";
      if($searchValue != ''){ //SINCE WE LACK MAGNITUDE AND RESIDUALRISKSCORE COLUMNS THEN WE WONT SORT ON THESE
         $searchQuery = " (erms_risk_registry.activity like '%".$searchValue."%' or erms_trends.trend_name like '%".$searchValue."%' or erms_objectives_category.objective_category like '%".$searchValue."%' or erms_year.year like '%".$searchValue."%' or erms_quarter.quarter like '%".$searchValue."%') ";
      }      
      if($trends_id != ''){
         $search_arr[] = " trends_id='".$trends_id."' "; //for dropdowns
         //  $search_arr[] = " trends_id like '%".$trends_id."%' ";  //for normal inputs
      }
      if($activity != ''){
         $search_arr[] = " activity='".$activity."' "; //for dropdowns
         //  $search_arr[] = " activity like '%".$activity."%' ";  //for normal inputs
      }
      if($objective_category_id != ''){
        $search_arr[] = " objective_category_id='".$objective_category_id."' "; //for dropdowns
         //$search_arr[] = " objective_category_id like '%".$objective_category_id."%' ";  //for normal inputs
      }
      if($quarter_id != ''){
         $search_arr[] = " quarter_id='".$quarter_id."' "; //for dropdowns
      }
      if($year_id != ''){
         $search_arr[] = " year_id='".$year_id."' "; //for dropdowns
      }    

      if(count($search_arr) > 0){
         $searchQuery = implode(" and ",$search_arr);
      }
      ## Total number of records without filtering
      // $this->db->select('count(*) as allcount');
      // $this->db->from('erms_risk_registry');
      // $this->db->join('erms_risk_registry_history', 'erms_risk_registry_history.risk_registry_id = erms_risk_registry.id');
      // $this->db->where('erms_risk_registry.active',1); //only active record
      // $records = $this->db->get()->result();
      // $totalRecords = $records[0]->allcount;
      $sql="SELECT DISTINCT ON (erms_risk_registry.activity) * FROM erms_risk_registry INNER JOIN erms_risk_registry_history ON erms_risk_registry_history.risk_registry_id = erms_risk_registry.id WHERE erms_risk_registry.active = 1 ORDER BY erms_risk_registry.activity, erms_risk_registry_history.year_id DESC, erms_risk_registry_history.quarter_id DESC";  
      $query = $this->db->query($sql);
      $totalRecords = $query->num_rows();

      ## Total number of record with filtering
      // $this->db->select('count(*) as allcount');
      // if($searchQuery != '')
      //    $this->db->where($searchQuery);
      // $this->db->from('erms_risk_registry');
      // $this->db->join('erms_risk_registry_history', 'erms_risk_registry_history.risk_registry_id = erms_risk_registry.id');
      // //$this->db->where('erms_risk_registry_history.active_code',1); //only active record
      // $records = $this->db->get()->result();
      // $totalRecordwithFilter = $records[0]->allcount;
      $sql="SELECT DISTINCT ON (erms_risk_registry.activity) erms_risk_registry.activity,erms_risk_registry.objective_category_id, erms_risk_registry.impact_scale_id, erms_risk_registry.like_hood_scale_id, erms_risk_registry.controls_effectiveness_scale_id, erms_risk_registry.risk_owner_id, erms_risk_registry_history.risk_registry_id, erms_risk_registry_history.trends_id, erms_risk_registry_history.quarter_id, erms_risk_registry_history.year_id FROM erms_risk_registry INNER JOIN erms_risk_registry_history ON erms_risk_registry_history.risk_registry_id = erms_risk_registry.id";
       if($searchQuery != ''){
         $sql.=" WHERE {$searchQuery} AND erms_risk_registry.active = 1";
       }else{
         $sql.=" WHERE erms_risk_registry.active = 1 ";
       }          
       $sql.=" ORDER BY erms_risk_registry.activity, erms_risk_registry_history.year_id DESC, erms_risk_registry_history.quarter_id DESC";    
      $query = $this->db->query($sql);
      $totalRecordwithFilter = $query->num_rows(); 

       ## Fetch records
      // $this->db->select('*');
      //  if($searchQuery != ''){ $this->db->where($searchQuery); }
      // $this->db->limit($rowperpage, $start); // Produces: LIMIT $rowperpage OFFSET $start
      // $this->db->order_by('erms_risk_registry.date_created', 'desc');
      // $this->db->order_by('erms_risk_registry_history.date_created', 'DESC');
      // //$this->db->order_by($columnName, $columnSortOrder);
      // $this->db->from('erms_risk_registry');
      // $this->db->join('erms_risk_registry_history', 'erms_risk_registry_history.risk_registry_id = erms_risk_registry.id');
      // //$this->db->where('erms_risk_registry_history.active_code',1); //only active record      
      // $records = $this->db->get()->result();

      //PULL LATEST QUARTER DATA
      $sql="SELECT DISTINCT ON (erms_risk_registry.activity) erms_risk_registry.activity,erms_risk_registry.objective_category_id, erms_risk_registry.impact_scale_id, erms_risk_registry.like_hood_scale_id, erms_risk_registry.controls_effectiveness_scale_id, erms_risk_registry.risk_owner_id, erms_risk_registry_history.risk_registry_id, erms_risk_registry_history.trends_id, erms_risk_registry_history.quarter_id, erms_risk_registry_history.year_id FROM erms_risk_registry INNER JOIN erms_risk_registry_history ON erms_risk_registry_history.risk_registry_id = erms_risk_registry.id";
       if($searchQuery != ''){
         $sql.=" WHERE {$searchQuery} AND erms_risk_registry.active = 1";
       }else{
         $sql.=" WHERE erms_risk_registry.active = 1 ";
       }          
       $sql.=" ORDER BY {$columnName} {$columnSortOrder}, erms_risk_registry.activity, erms_risk_registry_history.year_id DESC, erms_risk_registry_history.quarter_id DESC"; 
       $sql.=" LIMIT {$rowperpage} OFFSET {$start}"; 
      $query = $this->db->query($sql);
      $records =  $query->result();
      
      // echo '<pre>'; print_r($records); echo '</pre>'; die();

      $data = array();
      foreach($records as $record ){
         //map risk owner ID to name
         $get_data = $this->risk_model->get_risk_owners_name($record->risk_owner_id)->result();  
         foreach($get_data as $value)  
         {  
            $risk_owner = $value->name;  
         }
        //check trend and display appropriate icon
        $get_data = $this->trends_model->get_trends_name($record->trends_id)->result();  
        foreach($get_data as $value)  
        {  
          if($value->trend_name == 'Constant - Amber'){  
              $trendsicon = '<span style="color:#FFC200"><i class="fa fa-exchange"></i>&nbsp;Constant</span>'; 
          }elseif ($value->trend_name == 'Constant - Green') {
              $trendsicon = '<span style="color:#008000"><i class="fa fa-exchange"></i>&nbsp;Constant</span>'; 
          }elseif ($value->trend_name == 'Constant - Red') {
              $trendsicon = '<span style="color:#FF0000"><i class="fa fa-exchange"></i>&nbsp;Constant</span>'; 
          }elseif ($value->trend_name == 'Downward - Amber') {
              $trendsicon = '<span style="color:#FFC200"><i class="fa fa-arrow-down"></i>&nbsp;Downward</span>'; 
          }elseif ($value->trend_name == 'Downward - Red') {
              $trendsicon = '<span style="color:#FF0000"><i class="fa fa-arrow-down"></i>&nbsp;Downward</span>'; 
          }elseif ($value->trend_name == 'Upward - Amber') {  
              $trendsicon = '<span style="color:#FFC200"><i class="fa fa-arrow-up"></i>&nbsp;Upward</span>';
          }elseif ($value->trend_name == 'Upward - Green') {  
              $trendsicon = '<span style="color:#008000"><i class="fa fa-arrow-up"></i>&nbsp;Upward</span>';
          }else{
              $trendsicon = 'Unknown';
          }
        }
        $impact_scale_id = $record->impact_scale_id; 
        $like_hood_scale_id = $record->like_hood_scale_id;
        $magnitude = number_format((int)$impact_scale_id*$like_hood_scale_id,0, '.', '');
        $controls_effectiveness_scale_id = $record->controls_effectiveness_scale_id;
        $residualriskscore = ceil($magnitude/$controls_effectiveness_scale_id);
        //map objective_category_id to its name
        $get_data = $this->Objectives_Category_Model->get_objective_category_name($record->objective_category_id)->result();  
        foreach($get_data as $value)  
        {  
           $objective_category_id = $value->objective_category;  
        }       
        //Map quarter_id to quarter number 
        $quarternumbers = $this->registry_model->getQuarterNumber($record->quarter_id); 
        foreach($quarternumbers->result_array() as $quarternumbersvalue){
           $quarter_id = $quarternumbersvalue['quarter'];
        }
        //Map year_id to year number 
        $yearnumbers = $this->registry_model->getYearNumber($record->year_id); 
        foreach($yearnumbers->result_array() as $yearnumbersvalue){
           $year_id = $yearnumbersvalue['year'];
        }
        $data[] = array( 
          "activity"=>$record->activity,  
          "risk_owner"=>$risk_owner,  
          "magnitude"=>$magnitude,   
          "residualriskscore"=>$residualriskscore,
          //this is for dashboard/admin
          "objective_category_id"=>$objective_category_id,
          "quarter_id"=>$quarter_id,
          "year_id"=>$year_id,
          //end dashboard/admin
          "trends_id"=>$trendsicon
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
      //$this->db->select('*');

      $search_arr = array();
      $searchQuery = "";

      $trends_id = $postData['trends_id']; 
      $activity = $postData['activity']; 
      // if($activity==''){
      //   $activity='*';
      // }
      $objective_category_id =  $postData['objective_category_id']; 
      // $startDate =  $postData['startDate']; 
      // $endDate =  $postData['endDate']; 

      //year_id & quarter_id are not present on erms_risk_registry...hence we joined it with erms_risk_registry_history
      // remove generation of report based on quarter_id and year_id search output
      $quarter_id =  $postData['quarter_id']; 
      $year_id =  $postData['year_id']; 

      // if($trends_id != ''){
      //   $search_arr[] = " erms_risk_registry_history.trends_id='".$trends_id."' ";
      // }
      // if($activity != ''){
      //   $search_arr[] = " erms_risk_registry.activity='".$activity."' ";
      // }

      // since output didnot require both  $activity AND $objective_category_id AND $quarter_id !='' then implement them separate
      // if($activity != ''){
      //    $search_arr[] = " activity='".$activity."' ";
      // }      
      // if($objective_category_id != ''){
      //   $search_arr[] = " objective_category_id='".$objective_category_id."' ";
      // }
      // if($quarter_id != ''){
      //     //$search_arr[] = " quarter_id='".$quarter_id."' ";
      //     //convert quarter_id to quarter number then compare and generate search query
      //     $quarternumbers0 = $this->registry_model->getQuarterNumber($quarter_id); 
      //     foreach($quarternumbers0->result_array() as $quarternumbersvalue0){
      //        $quarternumbernumeric0 = $quarternumbersvalue0['quarter'];
      //     }         

      //     if($quarternumbernumeric0==1){ 
      //          //select quarter_id where $quarternumbernumeric0==2 ...$x represents  $quarternumbernumeric0 which is 1
      //         for($x=1; $x<=1;$x++){
      //           $quarterid2 = $this->registry_model->getQuarterId($x); 
      //           foreach($quarterid2->result_array() as $quarteridvalue2){
      //              $quarteridnumeric1=$quarteridvalue2['id'];     
      //           } 
      //         }
      //         $search_arr[] = " quarter_id='".$quarteridnumeric1."' AND year_id='".$year_id."' ";              
      //        // $search_arr[] = " quarter_id='".$quarter_id."' ";
      //     }elseif($quarternumbernumeric0==2){
      //         //select quarter_id where $quarternumbernumeric0==2 ...$x represents  $quarternumbernumeric0 which is 2
      //         for($x=1; $x<=2;$x++){
      //           $quarterid2 = $this->registry_model->getQuarterId($x); 
      //           foreach($quarterid2->result_array() as $quarteridvalue2){
      //             if($x==1){ $one=$quarteridvalue2['id']; }   
      //             if($x==2){ $two=$quarteridvalue2['id']; }                
      //           } 
      //         }
      //         //$search_arr[] = " quarter_id='".$quarteridnumeric1."' OR quarter_id='".$quarteridnumeric2."' ";              
      //         // $search_arr[] = " quarter_id='".$one."' OR quarter_id='".$two."' ";
      //         $search_arr[] = " (quarter_id='".$one."' AND year_id='".$year_id."') OR (quarter_id='".$two."' AND year_id='".$year_id."') ";
      //     }elseif($quarternumbernumeric0==3){
      //       //select quarter_id where $quarternumbernumeric0==3 ...$x represents  $quarternumbernumeric0 which is 3
      //       for($x=1; $x<=3;$x++){
      //         $quarterid2 = $this->registry_model->getQuarterId($x); 
      //         foreach($quarterid2->result_array() as $quarteridvalue2){
      //            if($x==1){ $one=$quarteridvalue2['id']; }   
      //            if($x==2){ $two=$quarteridvalue2['id']; }    
      //            if($x==3){ $three=$quarteridvalue2['id']; }                 
      //         } 
      //       }
      //      // $search_arr[] = " quarter_id='".$one."' OR quarter_id='".$two."' OR quarter_id='".$three."' ";
      //      $search_arr[] = " (quarter_id='".$one."' AND year_id='".$year_id."') OR (quarter_id='".$two."' AND year_id='".$year_id."') OR (quarter_id='".$three."' AND year_id='".$year_id."') ";


      //     }elseif($quarternumbernumeric0==4){
      //        //select quarter_id where $quarternumbernumeric0==4 ...$x represents  $quarternumbernumeric0 which is 4
      //        for($x=1; $x<=4;$x++){
      //          $quarterid2 = $this->registry_model->getQuarterId($x); 
      //          foreach($quarterid2->result_array() as $quarteridvalue2){
      //             if($x==1){ $one=$quarteridvalue2['id']; }   
      //             if($x==2){ $two=$quarteridvalue2['id']; }    
      //             if($x==3){ $three=$quarteridvalue2['id']; } 
      //             if($x==4){ $four=$quarteridvalue2['id']; }                    
      //          } 
      //        }
      //        //$search_arr[] = " quarter_id='".$one."' OR quarter_id='".$two."' OR quarter_id='".$three."' OR quarter_id='".$four."' ";
      //        $search_arr[] = " (quarter_id='".$one."' AND year_id='".$year_id."') OR (quarter_id='".$two."' AND year_id='".$year_id."') OR (quarter_id='".$three."' AND year_id='".$year_id."') OR (quarter_id='".$four."' AND year_id='".$year_id."') ";
      //     }else{
      //       $search_arr[] = "";
      //     }
      // } 

      //BIND $objective_category_id AND $quarter_id AND $activity!='' TOGETHER..BUT ALSO ONLY ACTIVE RECORDS
      if($quarter_id != '' && $objective_category_id != ''){ //  && $activity!=''
          //$search_arr[] = " quarter_id='".$quarter_id."' ";
          //convert quarter_id to quarter number then compare and generate search query
          $quarternumbers0 = $this->registry_model->getQuarterNumber($quarter_id); 
          foreach($quarternumbers0->result_array() as $quarternumbersvalue0){
             $quarternumbernumeric0 = $quarternumbersvalue0['quarter'];
          } 
          if($quarternumbernumeric0==1){ 
              //select quarter_id where $quarternumbernumeric0==2 ...$x represents  $quarternumbernumeric0 which is 1
              for($x=1; $x<=1;$x++){
                $quarterid2 = $this->registry_model->getQuarterId($x); 
                foreach($quarterid2->result_array() as $quarteridvalue2){
                   $quarteridnumeric1=$quarteridvalue2['id'];     
                } 
              } 
              if( !empty($trends_id) || !empty($activity) ){
                if( !empty($trends_id) && empty($activity) ){
                  $search_arr[] = " erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$quarteridnumeric1."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 "; 
                }elseif( !empty($activity) && empty($trends_id) ){
                  $search_arr[] = " erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$quarteridnumeric1."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 "; 
                }else{
                  $search_arr[] = " erms_risk_registry.activity='".$activity."' AND erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$quarteridnumeric1."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 "; 
                }                
              }else{
                $search_arr[] = " erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$quarteridnumeric1."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 "; 
              }                           
             // $search_arr[] = " quarter_id='".$quarter_id."' ";
          }elseif($quarternumbernumeric0==2){              
              //select quarter_id where $quarternumbernumeric0==2 ...$x represents  $quarternumbernumeric0 which is 2
              for($x=1; $x<=2;$x++){
                $quarterid2 = $this->registry_model->getQuarterId($x); 
                foreach($quarterid2->result_array() as $quarteridvalue2){
                  if($x==1){ $one=$quarteridvalue2['id']; }   
                  if($x==2){ $two=$quarteridvalue2['id']; }                
                } 
              }
              //$search_arr[] = " quarter_id='".$quarteridnumeric1."' OR quarter_id='".$quarteridnumeric2."' ";              
              // $search_arr[] = " quarter_id='".$one."' OR quarter_id='".$two."' ";
              if( !empty($trends_id) || !empty($activity) ){
                if( !empty($trends_id) && empty($activity) ){
                  $search_arr[] = " ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) ";
                }elseif( !empty($activity) && empty($trends_id) ){
                  $search_arr[] = " ( erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) "; 
                }else{
                  $search_arr[] = " ( erms_risk_registry.activity='".$activity."' AND erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry.activity='".$activity."' AND erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) "; 
                }  
              }else{
                $search_arr[] = " ( erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) ";
              } 
          }elseif($quarternumbernumeric0==3){
            //select quarter_id where $quarternumbernumeric0==3 ...$x represents  $quarternumbernumeric0 which is 3
            for($x=1; $x<=3;$x++){
              $quarterid2 = $this->registry_model->getQuarterId($x); 
              foreach($quarterid2->result_array() as $quarteridvalue2){
                 if($x==1){ $one=$quarteridvalue2['id']; }   
                 if($x==2){ $two=$quarteridvalue2['id']; }    
                 if($x==3){ $three=$quarteridvalue2['id']; }                 
              } 
            }
           // $search_arr[] = " quarter_id='".$one."' OR quarter_id='".$two."' OR quarter_id='".$three."' ";
            if( !empty($trends_id) || !empty($activity) ){
              if( !empty($trends_id) && empty($activity) ){
                $search_arr[] = " ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR (  erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$three."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) ";
              }elseif( !empty($activity) && empty($trends_id) ){
                $search_arr[] = " ( erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR (  erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$three."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) ";
              }else{
                $search_arr[] = " ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR (  erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$three."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) ";
              }
            }else{
              $search_arr[] = " ( erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR (  erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$three."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) ";
            }           
          }elseif($quarternumbernumeric0==4){             
             //select quarter_id where $quarternumbernumeric0==4 ...$x represents  $quarternumbernumeric0 which is 4
             for($x=1; $x<=4;$x++){
               $quarterid2 = $this->registry_model->getQuarterId($x); 
               foreach($quarterid2->result_array() as $quarteridvalue2){
                  if($x==1){ $one=$quarteridvalue2['id']; }   
                  if($x==2){ $two=$quarteridvalue2['id']; }    
                  if($x==3){ $three=$quarteridvalue2['id']; } 
                  if($x==4){ $four=$quarteridvalue2['id']; }                    
               } 
             }
             //$search_arr[] = " quarter_id='".$one."' OR quarter_id='".$two."' OR quarter_id='".$three."' OR quarter_id='".$four."' ";

             if( !empty($trends_id) || !empty($activity) ){                 
                 if( !empty($trends_id) && empty($activity) ){
                   $search_arr[] = " ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR (  erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$three."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$four."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) ";
                 }elseif( !empty($activity) && empty($trends_id) ){
                   $search_arr[] = " ( erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR (  erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$three."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$four."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) ";
                 }else{
                   $search_arr[] = " ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.activity='".$activity."' AND erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.activity='".$activity."' AND  erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR (  erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.activity='".$activity."' AND  erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$three."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry_history.trends_id='".$trends_id."' AND erms_risk_registry.activity='".$activity."' AND  erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$four."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) ";
                 }
             }else{
                $search_arr[] = " ( erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$one."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$two."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR (  erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$three."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) OR ( erms_risk_registry.objective_category_id='".$objective_category_id."' AND erms_risk_registry_history.quarter_id='".$four."' AND erms_risk_registry_history.year_id='".$year_id."' AND erms_risk_registry.active=1 ) ";
             }             
          }else{
            $search_arr[] = "";
          }
      } 

      // $search_arr.=" AND erms_risk_registry.active=1";
      // array_push($array1,'Chemistry','Biology');

      // echo '<pre>'; print_r($search_arr); echo '</pre>';
      // die();



      //lefy this  and merged year with specific quarter as done above
      // if($year_id != ''){
      //   $search_arr[] = " year_id='".$year_id."' ";
      // } 
     
      //echo '<pre>'; print_r( $search_arr ); echo '</pre>';
      if(count($search_arr) > 0){
        $searchQuery = implode(" and ",$search_arr);
      }
      //var_dump($searchQuery);
     //echo '<pre>'; print_r($searchQuery); echo '</pre>';
     // die();

      if($searchQuery != ''){
          $this->db->where($searchQuery);  
          //var_dump( $searchQuery ); 
      }
      //$this->db->where('erms_risk_registry.active',1); //ACTIVE RISK REGISTER RECORD

   
      //$this->db->order_by("erms_risk_registry.date_created", "ASC");     
      $this->db->order_by("erms_risk_registry.activity", "ASC");  
      $this->db->order_by("erms_risk_registry_history.year_id", "ASC"); 
      $this->db->order_by("erms_risk_registry_history.quarter_id", "ASC"); 

      // $this->db->from('erms_risk_registry');
       $this->db->join('erms_risk_registry_history', 'erms_risk_registry.id = erms_risk_registry_history.risk_registry_id');

      //$this->db->where('erms_risk_registry_history.active_code',1); //only active record //last quarter record on "history" table

      // $query = $this->db->get();
      $query = $this->db->get('erms_risk_registry');

      // echo '<pre>'; print_r( $query->result() ); echo '</pre>';   
      // die();

      return $query->result();
    }

    //FETCH RISK REGISTER CAUSES
    function getRiskCauses($risk_registry_id,$quarter_id){
      $this->db->select('*');
      $this->db->where('risk_registry_id',$risk_registry_id);
      $this->db->order_by("causes", "ASC");
      if($quarter_id!=1){
        $this->db->where('active',1);
      }
      $query = $this->db->get("erms_risk_registry_causes");
      //return $query->result();
      return $query;
    }
    //FETCH RISK REGISTER AFFECTED OBJECTIVES
    function get_objective_id_pk($id){
      $this->db->select('objective_id');
      $this->db->where('risk_registry_id',$id);
      $this->db->order_by("objective_id", "ASC");
      $query = $this->db->get("erms_risk_registry_objectives");
      return $query;
    }
    //FETCH RISK REGISTER EVENTS
    function getRiskEvents($risk_registry_id,$quarter_id){
      $this->db->select('*');
      $this->db->where('risk_registry_id',$risk_registry_id);
      $this->db->order_by("events", "ASC");
      if($quarter_id!=1){
        $this->db->where('active',1);
      }
      $query = $this->db->get("erms_risk_registry_events");
      //return $query->result();
      return $query;
    }
    //FETCH RISK REGISTER CONSEQUENCES
    function getRiskConsequences($risk_registry_id,$quarter_id){
      $this->db->select('*');
      $this->db->where('risk_registry_id',$risk_registry_id);
      $this->db->order_by("consequences", "ASC");
      if($quarter_id!=1){
        $this->db->where('active',1);
      }
      $query = $this->db->get("erms_risk_registry_consequences");
      //return $query->result();
      return $query;
    }
    //FETCH RISK REGISTER EXISTING CONTROLS
    function getRiskExistingControls($risk_registry_id,$quarter_id){
      $this->db->select('*');
      $this->db->where('risk_registry_id',$risk_registry_id);
      $this->db->order_by("excontrols", "ASC");
      if($quarter_id!=1){
        $this->db->where('active',1);
      }
      $query = $this->db->get("erms_risk_registry_excontrols");
      //return $query->result();
      return $query;
    }
    //FETCH  RISK REGISTER ADDITIONAL CONTROLS
    function getRiskAdditionalControls($risk_registry_id,$quarter_id){
      $this->db->select('*');
      $this->db->where('risk_registry_id',$risk_registry_id);
      $this->db->order_by("adcontrols", "ASC");
      if($quarter_id!=1){
        $this->db->where('active',1);
      }
      $query = $this->db->get("erms_risk_registry_adcontrols");
      //return $query->result();
      return $query;
    }

    function getAllQuarters(){
      $this->db->select('DISTINCT(quarter_id)'); 
      $this->db->order_by("quarter_id", "ASC");
      $query = $this->db->get("erms_risk_registry_history");
      return $query;
    }

   //GET QUARTERS  FROM erms_quarter TABLE 
    function getSystemQuarters(){
      $this->db->select('*'); 
      $this->db->order_by("quarter", "ASC");
      $query = $this->db->get("erms_quarter");
      return $query;
    }

    function getQuarterNumber($quarter_id){ //used to know how many times to loop to get risk register history
      $this->db->select('quarter'); 
       $this->db->where('id',$quarter_id);
      $query = $this->db->get("erms_quarter");
      return $query;
    }

    function getQuarterId($quarter_number){ 
      $this->db->select('id'); 
       $this->db->where('quarter',$quarter_number);
      $query = $this->db->get("erms_quarter");
      return $query;
    }


    

    function getYearNumber($year_id){ 
      $this->db->select('year'); 
      $this->db->where('id',$year_id);
      $query = $this->db->get("erms_year");
      return $query;
    }

    function getRiskRegisterActivity(){
      // $this->db->select('activity'); 
      // $this->db->order_by("activity", "ASC");
      // $query = $this->db->get("erms_risk_registry");
      // return $query;
      $sql="SELECT DISTINCT ON (activity) activity FROM erms_risk_registry WHERE active=1 ORDER BY activity ASC ";
      $query = $this->db->query($sql);
      return $query;
    }


    //GET YEAR FROM REGISTRY HISTORY TABLE
    function getAllYears(){ 
      $this->db->distinct('year_id');
      $this->db->select('year_id');
      $this->db->order_by("year_id", "DESC");
      $query = $this->db->get("erms_risk_registry_history");
      return $query;
    }

    //GET YEARS FROM erms_year TABLE 
    function getSystemYears(){ 
      $this->db->select('*');
      $this->db->order_by("year", "DESC");
      $query = $this->db->get("erms_year");
      return $query;
    }

    //GET YEAR name from erms_year 
    function getAllYearName($year_id){ 
      // $this->db->select('id,year');
      $this->db->select('*');
      $this->db->where('id',$year_id);
      $query = $this->db->get("erms_year");
     return $query;
      //return $query->result();

    }
        
    //ongeza na year
    //function getQuarterHistory($risk_registry_id,$quarter_id){
    //ONE risk_registry_id for ONE quarter_id ... if they are many they have to be in-active
    //8,1  8,8 8,9 8,4
    function getQuarterHistoryold($risk_registry_id,$quarternumbernumeric,$year_id){
      $this->db->select('*');
      $this->db->where('risk_registry_id',$risk_registry_id);
      if($quarternumbernumeric==1){
        //$this->db->where('quarter_id',1);
         $where = '(quarter_id=1)';
      }elseif($quarternumbernumeric==2){
        // $this->db->where('quarter_id',1);
        // $this->db->where('quarter_id',8);
        $where = '(quarter_id=1 or quarter_id=8)';
      }elseif ($quarternumbernumeric==3) {
        // $this->db->where('quarter_id',1);
        // $this->db->where('quarter_id',8);
        // $this->db->where('quarter_id',9);
        $where = '(quarter_id=1 or quarter_id=8 or quarter_id=9)';
      }elseif($quarternumbernumeric==4){
        // $this->db->where('quarter_id',1);
        // $this->db->where('quarter_id',8);
        // $this->db->where('quarter_id',9);
        // $this->db->where('quarter_id',4);
        $where = '(quarter_id=1 or quarter_id=8 or quarter_id=9 or quarter_id=4) ';
      }else{
        //error
      }

      $where2 = ' year_id='.$year_id;

      $this->db->where($where);
      $this->db->where($where2);

      //$this->db->where('quarter_id',$quarter_id);
      //$this->db->where('active_code',1); //only active record //thede data will never be deleted..so this column doesnt apply
      $query = $this->db->get("erms_risk_registry_history");
      //var_dump($query); 
      //echo '<pre>'; print_r($query); echo '</pre>';
      return $query;
    }

    function getQuarterHistory($risk_registry_id,$quarternumbernumeric,$year_id){
      $this->db->select('*');
      //var_dump($quarternumbernumeric); die();
      if($quarternumbernumeric==1){
         // $array = array('risk_registry_id' => $risk_registry_id, 'quarter_id' => 1);
         $where = " (risk_registry_id= $risk_registry_id AND quarter_id=1 AND year_id= $year_id) "; //id for quarter 1
         //$this->db->where($where); 
      }elseif($quarternumbernumeric==2){
        $where = " (risk_registry_id= $risk_registry_id AND quarter_id=1 AND year_id= $year_id) "; //id for quarter 1
        $where .= " OR (risk_registry_id= $risk_registry_id AND quarter_id=4 AND year_id= $year_id) "; //id for quarter 2
        //$this->db->where($where); 
        //$where = '(quarter_id=1 or quarter_id=8)';
      }elseif ($quarternumbernumeric==3) {
        $where = " (risk_registry_id= $risk_registry_id AND quarter_id=1 AND year_id= $year_id) "; //id for quarter 1
        $where .= " OR (risk_registry_id= $risk_registry_id AND quarter_id=4 AND year_id= $year_id) "; //id for quarter 2
        $where .= " OR (risk_registry_id= $risk_registry_id AND quarter_id=8 AND year_id= $year_id) "; //id for quarter 3
        //$where = '(quarter_id=1 or quarter_id=8 or quarter_id=9)';
      }elseif($quarternumbernumeric==4){
        $where = " (risk_registry_id= $risk_registry_id AND quarter_id=1 AND year_id= $year_id) "; //id for quarter 1
        $where .= " OR (risk_registry_id= $risk_registry_id AND quarter_id=4 AND year_id= $year_id) "; //id for quarter 2
        $where .= " OR (risk_registry_id= $risk_registry_id AND quarter_id=8 AND year_id= $year_id) "; //id for quarter 3
        $where .= " OR (risk_registry_id= $risk_registry_id AND quarter_id=9 AND year_id= $year_id) "; //id for quarter 4
        //$where = '(quarter_id=1 or quarter_id=8 or quarter_id=9 or quarter_id=4) ';
      }else{
        //error
        $where = " (risk_registry_id= $risk_registry_id AND quarter_id=NULL AND year_id= $year_id) ";
      }
      //$where2 = ' year_id='.$year_id;
      $this->db->where($where);
      //$this->db->where($where2);
      $query = $this->db->get("erms_risk_registry_history");
      //var_dump($query);die();
      return $query;
    }

    



    

}