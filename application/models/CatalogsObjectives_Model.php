<?php  
 class CatalogsObjectives_Model extends CI_Model  
 {  
    var $table = "erms_objective"; 
    //table Columns
    var $column_id = "id";
    var $column_name = "name";
    var $column_code = "code";
    var $column_active = "active"; 

    var $select_column = array("id", "code", "name");  
    var $order_column = array(null, "code", "name", null);// Null on index ....
    //order on display page... id,code,name, action --- 0,1,2,3,4,5

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

          $this->db->or_like($this->column_name, $_POST["search"]["value"]);          

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


      function delete_one($id)  
      {  
           $this->db->where("id", $id);  
           $this->db->delete($this->table);  
      }  


      // Get a specific objective name
      function get_objective_name($id){
          $this->db->select('name');
          $query = $this->db->get_where('erms_objective', array('id' =>  $id));
          return $query;
          //echo json_encode($data);
      }

      //GET ALL OBJECTIVES OF A GIVEN KRI_ID      
      function get_kri_objectives($id){
          $this->db->select('objective_id');
          $query = $this->db->get_where('erms_kri_objectives', array('kri_id' =>  $id));
          return $query;
          //echo json_encode($data);
      }

      // Get a specific objective code
      function get_objective_code($id){
          $this->db->select('code');      
          $query = $this->db->get_where('erms_objective', array('id' =>  $id));
          return $query;
          //echo json_encode($data);
      }

      // List of all strategic objectives
      public function get_strategic_objectives(){
          // list/retrieve data method
          $this->db->select("*");
          $this->db->from("erms_objective");
          $this->db->order_by('code', 'ASC');   //sort code in ascending order
          $this->db->where('active',1); //only active record
          $query = $this->db->get();   
          return $query; //return query then on controller use ->result(); to get results on controller
      }




 }  