<?php  
 class CatalogsQuarters_Model extends CI_Model  
 {  
    var $table = "erms_quarter"; 
    //table Columns
    var $column_id = "id";
    var $column_quarter_name = "quarter_name";
    var $column_quarter_description = "quarter_description";
    var $column_active = "active"; 

    var $select_column = array("id", "quarter_name", "quarter_description");  
    var $order_column = array(null, "quarter_name", "quarter_description", null);// Null on index ....
    //order on display page... id,quarter_name,quarter_description, action --- 0,1,2,3,4,5

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

          //$this->db->like($column_quarter_description, $_POST["search"]["value"]);
          $this->db->or_like($this->column_quarter_name, $_POST["search"]["value"]);          

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


      // Get a specific quarter name
      function get_quarter_name($id){
          $this->db->select('quarter_name');
          $query = $this->db->get_where('erms_quarter', array('id' =>  $id));
          return $query;
          //echo json_encode($data);
      }

      // List of all quarter descriptions
      public function get_quarter_descriptions(){
          // list/retrieve data method
          $this->db->select("*");
          $this->db->from("erms_quarter");
          $query = $this->db->get();   
          return $query; //return query then on controller use ->result(); to get results on controller
      }


 }  