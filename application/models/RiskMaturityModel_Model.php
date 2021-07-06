<?php  
 class RiskMaturityModel_Model extends CI_Model  
 {  
    var $table = "erms_rmm"; 
    //table Columns
    var $column_id = "id";
    var $column_reporting_unit = "reporting_unit";
    var $column_process_id = "process_id";
    var $column_risk_level_id = "risk_level_id";
    var $column_risk_level_description = "risk_level_description";
    var $column_active = "active"; 

    var $select_column = array("id", "reporting_unit", "process_id", "risk_level_id","risk_level_description");  
    var $order_column = array(null, "reporting_unit", null, null, null, null);// Null on index 0,2,3,4,5
    //order on display page... id,reporting_unit,process_id,risk_level_id,risk_level_description,view+edit+delete --- 0,1,2,3,4,5

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
          // $this->db->like($column_process_id, $_POST["search"]["value"]); //this column is integer and it causes errors here

          $this->db->or_like($this->column_reporting_unit, $_POST["search"]["value"]);          

          //WHERE clause contains String value instead of integer value CAUSES EERORS 
       }  

       //column order processing
       if(isset($_POST["order"]))  
       {  
          $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
       }  
       else  
       {  
          $this->db->order_by($this->column_id, 'DESC');  
       }  
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
         // table, data
           $this->db->insert($this->table, $data);  
      }  

      function fetch_one($id)  
      {  
           $this->db->where("id", $id);  
           $query=$this->db->get($this->table);  
           return $query->result();  
      }  

      function update($id, $data)  
      {  
           $this->db->where("id", $id);  
           $this->db->update($this->table, $data);  
      }  

      // Soft Delete - Active = 1,0...if 0 Means is has been deleted
      function delete_one($id)  
      {  
           $this->db->where("id", $id);  
           $this->db->delete($this->table);  
      } 



      // List of all RISK Maturity Model Processes from table erms_risk_levels
      public function get_rmm_processes(){
          // list/retrieve data method
          $this->db->select("*");
          $this->db->from("erms_rmm_processes");
          $query = $this->db->get();   
          return $query;
      }

      // Get a specific rmm_process name
      function get_rmm_process_name($id){
          $this->db->select('name');
          $query = $this->db->get_where('erms_rmm_processes', array('id' =>  $id));
          return $query; //return query then on controller use ->result(); to get results on controller
          //echo json_encode($data);
      }


 }  