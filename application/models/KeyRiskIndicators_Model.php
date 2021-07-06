<?php  
 class KeyRiskIndicators_Model extends CI_Model  
 {  
    var $table = "erms_kri"; 
    //table Columns
    var $column_id = "id";
    //var $column_directorate = "directorate";
    var $column_risk_owner = "risk_owner";
    var $column_resources = "resources";
    var $column_main_activity = "main_activity";
    var $column_key_performance_indicator = "key_performance_indicator";

    var $column_kri_green_definition = "kri_green_definition";
    var $column_kri_amber_definition = "kri_amber_definition";
    var $column_kri_red_definition = "kri_red_definition";

    var $column_is_draft = "is_draft";
    var $column_active = "active"; 

    var $select_column = array("id", "risk_owner", "resources", "main_activity", "key_performance_indicator", "kri_green_definition", "kri_amber_definition", "kri_red_definition","is_draft","active");  
    var $order_column = array(null, "risk_owner",  null, null, null, null, null, null, null);// Null on index 0,3,4,5
    //order on display page... id,code,name,resources, edit, delete --- 0,1,2,3,4,5


    function __construct(){
        parent::__construct();
        $this->load->model('Directorate_Model','directorate_model');
        $this->load->model('Objectives_Model');
        $this->load->model('Risk_Model','risk_model');
        $this->load->model('CatalogsObjectives_Model','catalogsobjectives_model');
    }

    function make_query()  
    {  
       $this->db->select($this->select_column);  
       $this->db->from($this->table); 

       //column search processing
       //ISSUES HERE
       if(isset($_POST["search"]["value"]))  
       {  
          //change column with int to string
          // $column_code = "".$this->column_code."";
          // $this->db->like($column_code, $_POST["search"]["value"]); //this column is integer and it causes errors here


          //uncomment here
          //$this->db->or_like($this->column_risk_owner, $_POST["search"]["value"]);          

          //WHERE clause contains String value instead of integer value CAUSES EERORS 
       }  


       //column order processing
       if(isset($_POST["order"]))  
       {   
        $this->db->order_by('date_created', 'DESC');        
          //$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
       }  
       else  
       {  
          //$this->db->order_by($this->column_id, 'DESC');  
        $this->db->order_by('date_created', 'DESC');  // get latest data
       }  
       //var_dump($_POST["order"]); die();


    }  

      function make_datatables(){  
        $this->make_query();  
        $this->db->where($this->column_active, 1); //WHERE active = 1...pull active records only
        if($_POST["length"] != -1)  
        {  
              //$this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get(); 
        return $query->result();  
      } 

      function make_datatables_assess(){  
        $this->make_query();  

        //$multipleWhere = [$this->column_active => 1, $this->column_is_assessed => 0];
        $multipleWhere = [$this->column_active => 1, $this->column_is_draft => 0 ];
        $this->db->where($multipleWhere);

        //$this->db->where($this->column_active, 1); //WHERE active = 1...pull active records only
        if($_POST["length"] != -1)  
        {  
              //$this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get(); 
        return $query->result();  
      } 


      function get_filtered_data(){  
           $this->make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }    

      function get_all_data()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table);  
           return $this->db->count_all_results();  
      } 

      function insert($data)  
      {  
          //start the m_transactionssent(conn)
         //$this->db->trans_begin();
          // table, data
         // $this->db->insert($this->table, $data);  
         // //make transaction complete
         //  $this->db->trans_complete();
         // //check if transaction status TRUE or FALSE
         // if ($this->db->trans_status() === FALSE) {
         //     //if something went wrong, rollback everything
         //     $this->db->trans_rollback();
         //     return FALSE;
         // } else {
         //     //if everything went right,insert the data to the database
         //     $this->db->trans_commit();
         //     return TRUE;
         // }   


         $this->db->trans_start(); # Starting Transaction
         $this->db->trans_strict(TRUE); # See Note 01. If you wish can remove as well 

         $this->db->insert($this->table, $data);   # Inserting data
         # Updating data
         // $this->db->where('id', $id);
         // $this->db->update('table_name', $test); 

         $this->db->trans_complete(); # Completing transaction

         /*Optional*/
         if ($this->db->trans_status() === FALSE) {
             # Something went wrong.
             $this->db->trans_rollback();
             return FALSE;
         } 
         else {
             # Everything is Perfect. 
             # Committing data to the database.
             $this->db->trans_commit();
             return TRUE;
         }

       
      }  


      //INSERT INTO TO erms_kri_objectives TABLE AFTER INSERTING IN erms_key_risk_indicator TABLE
      function multisave_kri_objective($last_insert_id,$objective_id,$today,$activerecord)
      {
        $query="insert into erms_kri_objectives(kri_id,objective_id,date_created,active) values($last_insert_id,$objective_id,'$today',$activerecord)"; //$today comes as a string so put it in quotes
        $this->db->query($query);
      }



      function fetch_one($id)  
      {  
         $this->db->trans_begin();
         $this->db->where("id", $id);  
         $query=$this->db->get($this->table);  
         return $query->result();  
      }  

   

      function update($id, $data)  
      {  

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(TRUE); # See Note 01. If you wish can remove as well 

         $this->db->where("id", $id);  
         $this->db->update($this->table, $data);  

         $this->db->trans_complete(); # Completing transaction

         /*Optional*/
         if ($this->db->trans_status() === FALSE) {
             # Something went wrong.
             $this->db->trans_rollback();
             return FALSE;
         } 
         else {
             # Everything is Perfect. 
             # Committing data to the database.
             $this->db->trans_commit();
             return TRUE;
         }
      }  

      public function insert_assessment($data){

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(TRUE); # See Note 01. If you wish can remove as well 

        $this->db->insert('erms_kri_assessment', $data);  

        $this->db->trans_complete(); # Completing transaction
        /*Optional*/
        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            //return TRUE;
            return ($this->db->affected_rows() != 1) ? false : true;  
        }

              
      }

      public function getYearOfKRIAssessment($id){
        $this->db->select('year');
        $this->db->where("kri_id", $id);
        $this->db->order_by("year", "asc");  
        $query = $this->db->get("erms_kri_assessment");  
        if ($query->num_rows() >= 1) {
         return true;
        } else {
         return false;
        }
      }

      public function getAllYearsOfKRIAssessment($id){
        $this->db->select('*');
        $this->db->where("kri_id", $id);  
        $this->db->where("active", 1);  
        $this->db->order_by("year", "asc"); 
         $this->db->order_by("quarter", "asc"); 
        $query=$this->db->get("erms_kri_assessment");  
        return $query->result();  
      }

      public function getLatestAssessment($kri_id){
         $this->db->select('kri_green_assessment,kri_amber_assessment,kri_red_assessment');
         $this->db->where("kri_id", $kri_id);  
          $this->db->where("active", 1); 
          $this->db->order_by("assessment_date", "desc");  
          $this->db->limit(1);
         $query=$this->db->get("erms_kri_assessment");  
         if ($query->num_rows() >= 1) {
          return $query->result(); 
          //return true;
         } else {
          return false;
         }          
      }
        

      // Soft Delete - Active = 1,0...if 0 Means is has been deleted
      function delete_one($id)  
      {  
          $this->db->trans_start(); # Starting Transaction
          $this->db->trans_strict(TRUE); # See Note 01. If you wish can remove as well 

           $this->db->where("id", $id);  
           $this->db->delete($this->table);  

           $this->db->trans_complete(); # Completing transaction

           /*Optional*/
           if ($this->db->trans_status() === FALSE) {
               # Something went wrong.
               $this->db->trans_rollback();
               return FALSE;
           } 
           else {
               # Everything is Perfect. 
               # Committing data to the database.
               $this->db->trans_commit();
               return TRUE;
           }
      }  


      //Get all active kri
      public function kriscount(){
          $this->db->select('*');
          $this->db->from('erms_kri');   
          $this->db->where("active", 1);    
          $query = $this->db->get();
          return $query->num_rows();
      }

      //Get all active and assessed kri
      public function assessedkriscount(){
          $this->db->select('*');
          $this->db->from('erms_kri');   
          $this->db->where("active", 1); 
          // $whereclause = array('active' => 1, 'is_assessed' => 1);
          $whereclause = array('active' => 1);
          $this->db->where($whereclause);    
          $query = $this->db->get();
          return $query->num_rows();
      }

      




      // Get DataTable data
     function getKeyRiskIndicators($postData=null){
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
      // $objective_id = $postData['objective_id'];
       $risk_owner = $postData['risk_owner'];
       // $startDate = $postData['startDate'];
       // $endDate = $postData['endDate'];
       $year_id = $postData['year_id'];
       $quarter_id = $postData['quarter_id'];

       // $startDate = date('Y-m-d H:i:s', strtotime($startDate)); //format startTime to begin at 00:00:00
       // $endDate = date('Y-m-d H:i:s', strtotime($endDate . '+ 1 day')); //gives time in the next date 00:00:00 hrs

       ## Search 
       $search_arr = array();
       $searchQuery = "";
       // if($searchValue != ''){
       //    $search_arr[] = " (objective_id like '%".$searchValue."%' or 
       //     risk_owner like'%".$searchValue."%' or 
       //     date_created >= '".$searchValue."' ) ";
       // }
       if($searchValue != ''){
          $search_arr[] = " (risk_owner like'%".$searchValue."%' or 
           quarter = '".$searchValue."' or 
           year like'%".$searchValue."' ) ";
       }
       // if($objective_id != ''){
       //    $search_arr[] = " objective_id='".$objective_id."' "; //for dropdowns
       //    //  $search_arr[] = " objective_id like '%".$objective_id."%' ";  //for normal inputs
       // }
       if($risk_owner != ''){
         $search_arr[] = " risk_owner='".$risk_owner."' "; //for dropdowns
          //$search_arr[] = " risk_owner like '%".$risk_owner."%' ";  //for normal inputs
       }
       if($year_id != ''){
         $search_arr[] = " year='".$year_id."' "; //for dropdowns
       }
       if($quarter_id != ''){
         $search_arr[] = " quarter='".$quarter_id."' "; //for dropdowns
       }

       // if($startDate != '' && $endDate ==''){
       //    $search_arr[] = " date_created >= '".$startDate."' ";
       // }

       // if($startDate == '' && $endDate !=''){
       //    $search_arr[] = " date_created <= '".$endDate."' ";
       // }

       // if($endDate != '' && $startDate !=''){
       //    $search_arr[] = " date_created >= '".$startDate."' AND date_created <= '".$endDate."'";
       // }

       if(count($search_arr) > 0){
          $searchQuery = implode(" and ",$search_arr);
       } 

       // echo "<pre>";
       // echo print_r($search_arr); 
       // echo "</pre>";

       ## Total number of records without filtering
       $this->db->select('count(*) as allcount');
       //$multipleWhere = [$this->column_active => 1, $this->column_is_draft => 0 ];
       $multipleWhere = ['erms_kri.active' => 1, 'erms_kri.is_draft' => 0 ];
       $this->db->where($multipleWhere);
       $this->db->join('erms_kri_assessment', 'erms_kri_assessment.kri_id = erms_kri.id', 'left');
       $records = $this->db->get('erms_kri')->result();
       $totalRecords = $records[0]->allcount;

       ## Total number of record with filtering
       $this->db->select('count(*) as allcount');
       // $multipleWhere = [$this->column_active => 1, $this->column_is_draft => 0 ];
       $multipleWhere = ['erms_kri.active' => 1, 'erms_kri.is_draft' => 0 ];
       $this->db->where($multipleWhere);
       if($searchQuery != '')
       $this->db->where($searchQuery);
       $this->db->join('erms_kri_assessment', 'erms_kri_assessment.kri_id = erms_kri.id', 'left');
       $records = $this->db->get('erms_kri')->result();
       $totalRecordwithFilter = $records[0]->allcount;
       
       ## Fetch records
       $this->db->select('erms_kri.*,erms_kri_assessment.year,erms_kri_assessment.quarter,erms_kri_assessment.kri_green_assessment,erms_kri_assessment.kri_amber_assessment,erms_kri_assessment.kri_red_assessment,erms_kri_assessment.assessed_by,erms_kri_assessment.assessment_date');
       //$this->db->from('erms_kri');
       $multipleWhere = ['erms_kri.active' => 1, 'erms_kri.is_draft' => 0 ];
       $this->db->where($multipleWhere);
       if($searchQuery != ''){
            $this->db->where($searchQuery);
       }
       $this->db->order_by($columnName, $columnSortOrder);
       $this->db->limit($rowperpage, $start);
       $this->db->join('erms_kri_assessment', 'erms_kri_assessment.kri_id = erms_kri.id', 'left');
       $records = $this->db->get('erms_kri')->result();
       //$records = $this->db->get()->result();
        // echo "<pre>";
        // echo print_r($records); 
        // echo "</pre>";

        // die();

       $data = array();
       foreach($records as $record ){
          //map risk owner ID to name
          $get_data = $this->risk_model->get_risk_owners_name($record->risk_owner)->result();  
          foreach($get_data as $value)  
          {  
             $risk_owner = $value->name;  
          }
          //map objective ID to code
          // $get_data = $this->catalogsobjectives_model->get_objective_code($record->objective_id)->result();  
          // foreach($get_data as $value)  
          // {  
          //    $objective_id = $value->code;  
          // }

          
          if($record->kri_green_assessment != ''){
            $kri_green_assessment = $record->kri_green_assessment; 
            $kri_amber_assessment = '-'; 
            $kri_red_assessment = '-'; 
          }elseif ($record->kri_amber_assessment != '') {
            $kri_green_assessment = '-'; 
            $kri_amber_assessment= $record->kri_amber_assessment;  
            $kri_red_assessment = '-'; 
          }elseif($record->kri_red_assessment != ''){
            $kri_green_assessment = '-'; 
            $kri_amber_assessment = '-';  
            $kri_red_assessment = $record->kri_red_assessment; 
          }else{
            $kri_green_assessment = '-'; 
            $kri_amber_assessment = '-';  
            $kri_red_assessment = '-'; 
          }


          if($record->year != ''){
            $year = $record->year; 
          }else{
            $year = '-'; 
          }

          if($record->quarter != ''){
            $quarter = $record->quarter; 
            if($quarter==1){$quarter='One';}
            elseif($quarter==4){$quarter='Two';}
            elseif($quarter==8){$quarter='Three';}
            elseif($quarter==9){$quarter='Four';}
            else{$quarter='Error';}        
          }else{
            $quarter = '-'; 
          }


         $data[] = array( 
           "risk_owner"=>$risk_owner,  
           //"objective_id"=>$objective_id,  
           "main_activity"=>$record->main_activity,
           "key_performance_indicator"=>$record->key_performance_indicator,
           "resources"=>$record->resources,
           // "kri_green_definition"=>$record->kri_green_definition,
           // "kri_amber_definition"=>$record->kri_amber_definition,
           // "kri_red_definition"=>$record->kri_red_definition
           "kri_green_assessment"=>$kri_green_assessment,
           "kri_amber_assessment"=>$kri_amber_assessment,
           "kri_red_assessment"=>$kri_red_assessment,
           //"date_reported"=>date("d-m-Y", strtotime($record->date_reported)), //format to to display d-m-Y
           "year"=>$year,
           "quarter"=>$quarter
         ); 
       }

       //var_dump( $data); die();
       // echo "<pre>";
       // echo print_r($data); 
       // echo "</pre>";

       

       ## Response
       $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordwithFilter,
         "aaData" => $data
       );
       return $response; 
     }


     function getKeyRiskIndicatorsReport($postData=null){
        //$searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
       //$objective_id = $postData['objective_id'];    
       //$objective_id = $postData['objective_id'] ?? '';
        $risk_owner = $postData['risk_owner'];
        //$startDate = $postData['startDate'];
        //$endDate = $postData['endDate'];
        $year_id = $postData['year_id'];
        $quarter_id = $postData['quarter_id'];

        ## Search 
        $search_arr = array();
        $searchQuery = "";
        // if($searchValue != ''){
        //    $search_arr[] = " (objective_id like '%".$searchValue."%' or 
        //     risk_owner like'%".$searchValue."%' or 
        //     date_created >= '".$searchValue."' ) ";
        // }

        // if($objective_id != ''){
        //    $search_arr[] = " objective_id='".$objective_id."' "; //for dropdowns
        //    //  $search_arr[] = " objective_id like '%".$objective_id."%' ";  //for normal inputs
        // }
        if($risk_owner != ''){
          $search_arr[] = " risk_owner='".$risk_owner."' "; //for dropdowns
           //$search_arr[] = " risk_owner like '%".$risk_owner."%' ";  //for normal inputs
        }

        if($year_id != ''){
          $search_arr[] = " year='".$year_id."' "; //for dropdowns
        }

        if($quarter_id != ''){
          $search_arr[] = " quarter='".$quarter_id."' "; //for dropdowns
        }

        // if($startDate != '' && $endDate ==''){
        //    $search_arr[] = " date_created >= '".$startDate."' ";
        // }

        // if($startDate == '' && $endDate !=''){
        //    $search_arr[] = " date_created <= '".$endDate."' ";
        // }

        // if($endDate != '' && $startDate !=''){
        //    $search_arr[] = " date_created >= '".$startDate."' AND date_created <= '".$endDate."'";
        // }

        if(count($search_arr) > 0){
           $searchQuery = implode(" and ",$search_arr);
        }

        ## Fetch records
        // $this->db->select('*');
        // if($searchQuery != ''){
        //      $this->db->where($searchQuery);
        // }
        // $this->db->order_by("date_created", "DESC");
        // $query = $this->db->get("erms_kri");
        // return $query->result();  //on the controller will access it via $row->name
        //return $query->result_array();     //on the controller will access it via $row['name']      

        $this->db->select('erms_kri.*,erms_kri_assessment.year,erms_kri_assessment.quarter,erms_kri_assessment.kri_green_assessment,erms_kri_assessment.kri_amber_assessment,erms_kri_assessment.kri_red_assessment,erms_kri_assessment.assessed_by,erms_kri_assessment.assessment_date');
        //$this->db->from('erms_kri');
        $multipleWhere = ['erms_kri.active' => 1, 'erms_kri.is_draft' => 0 ];
        $this->db->where($multipleWhere);
        if($searchQuery != ''){
             $this->db->where($searchQuery);
        }
        $this->db->order_by("erms_kri.date_created", "DESC");
        $this->db->join('erms_kri_assessment', 'erms_kri_assessment.kri_id = erms_kri.id', 'left');
        $this->db->join('erms_kri_objectives', 'erms_kri_objectives.kri_id = erms_kri.id', 'left');
        $records = $this->db->get('erms_kri')->result();
        return $records;        
     }

     

      function fetchReportData($postData=null){
        $search_arr = array();
        $searchQuery = "";

        //$objective_id =  $postData['objective_id']; 
        $risk_owner =  $postData['risk_owner']; 
        // $startDate =  $postData['startDate']; 
        // $endDate =  $postData['endDate']; 
        $year_id =  $postData['year_id']; 
        $quarter_id =  $postData['quarter_id']; 

        // if($objective_id != ''){
        //    $search_arr[] = " objective_id='".$objective_id."' ";
        // }
        if($risk_owner != ''){
          $search_arr[] = " risk_owner='".$risk_owner."' ";
        }

        if($year_id != ''){
          $search_arr[] = " year='".$year_id."' ";
        }

        if($quarter_id != ''){
          $search_arr[] = " quarter='".$quarter_id."' ";
        }
        // if($startDate != '' && $endDate != ''){ //CAST(dob AS DATE)
        //   //$search_arr[] = " date_created BETWEEN CAST('".$startDate."' AS DATE) AND CAST('".$endDate."' AS DATE) ";  
        //   //$search_arr[] = " date_created BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:00'";   
   
        //   $startDate = date('Y-m-d H:i:s', strtotime($startDate));
        //   $endDate = date('Y-m-d H:i:s', strtotime($endDate . '+ 1 day')); //gives time in the next date 00:00:00 hrs
        //   $search_arr[] = " date_created >= '".$startDate."' AND  date_created <= '".$endDate."'";         
        // }else{
        //   if($startDate != '' && $endDate ==''){
        //     $startDate = date('Y-m-d H:i:s', strtotime($startDate));
        //     $search_arr[] = " date_created >= '".$startDate."' ";
        //   }
        //   if($startDate == '' && $endDate != ''){
        //     $endDate = date('Y-m-d H:i:s', strtotime($endDate . '+ 1 day')); //gives time in the next date 00:00:00 hrs
        //     $search_arr[] = " date_created <= '".$endDate."' ";
        //   }   
        // }
       

        if(count($search_arr) > 0){
           $searchQuery = implode(" and ",$search_arr);
        }

       //var_dump($searchQuery); die();

        if($searchQuery != ''){
            $this->db->where($searchQuery);  //var_dump( $this->db->where($searchQuery) ); 
        }

        // $this->db->order_by("date_created", "DESC");
        // $query = $this->db->get("erms_kri");
        // return $query->result();
        $this->db->select('erms_kri.*,erms_kri_assessment.year,erms_kri_assessment.quarter,erms_kri_assessment.kri_green_assessment,erms_kri_assessment.kri_amber_assessment,erms_kri_assessment.kri_red_assessment,erms_kri_assessment.assessed_by,erms_kri_assessment.assessment_date');
        //$this->db->from('erms_kri');
        $multipleWhere = ['erms_kri.active' => 1, 'erms_kri.is_draft' => 0 ];
        $this->db->where($multipleWhere);
        if($searchQuery != ''){
             $this->db->where($searchQuery);
        }
        $this->db->order_by("erms_kri.date_created", "DESC");
        $this->db->join('erms_kri_assessment', 'erms_kri_assessment.kri_id = erms_kri.id', 'left');
        $this->db->join('erms_kri_objectives', 'erms_kri_objectives.kri_id = erms_kri.id', 'left');
        $records = $this->db->get('erms_kri')->result();
        return $records;      
      }

 }  