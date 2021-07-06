<?php  
 class UserRoles_Model extends CI_Model  
 {  
    var $table = "erms_user"; 
    //table Columns
    var $column_id = "id";
    var $column_email = "email";
    //var $column_code = "code";
    var $column_active = "active"; 


    var $select_column = array("id", "email", "active", "role_id");  
    var $order_column = array(null, "email", null, null, null, null);// Null on index 0,3,4,5
    //order on display page... id,code,name,description, edit, delete --- 0,1,2,3,4,5

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

          $this->db->or_like($this->column_email, $_POST["search"]["value"]);          

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
           //start the transaction
           $this->db->trans_begin();

           // table, data
           $this->db->insert($this->table, $data);  

          //make transaction complete
          $this->db->trans_complete();
          //check if transaction status TRUE or FALSE
          if ($this->db->trans_status() === FALSE) {
              //if something went wrong, rollback everything
              $this->db->trans_rollback();
              return FALSE;
          } else {
              //if everything went right,insert the data to the database
              $this->db->trans_commit();
              return TRUE;
          }
      }  

      function fetch_one($id)  
      {  
           $this->db->where("id", $id);  
           $query=$this->db->get($this->table);  
           return $query->result();  
      }  

      function update($id, $data)  
      {  
           //start the transaction
           $this->db->trans_begin();

           $this->db->where("id", $id);  
           $this->db->update($this->table, $data);  


           //make transaction complete
           $this->db->trans_complete();
           //check if transaction status TRUE or FALSE
           if ($this->db->trans_status() === FALSE) {
               //if something went wrong, rollback everything
               $this->db->trans_rollback();
               return FALSE;
           } else {
               //if everything went right,insert the data to the database
               $this->db->trans_commit();
               return TRUE;
           }
      }  


      function delete_one($id)  
      {  
           //start the transaction
           $this->db->trans_begin();

           $this->db->where("id", $id);  
           $this->db->delete($this->table); 

           //make transaction complete
           $this->db->trans_complete();
           //check if transaction status TRUE or FALSE
           if ($this->db->trans_status() === FALSE) {
               //if something went wrong, rollback everything
               $this->db->trans_rollback();
               return FALSE;
           } else {
               //if everything went right,insert the data to the database
               $this->db->trans_commit();
               return TRUE;
           }
      }  

      // Get user roles from the select : RISK CHAMPION
      public function get_esc_userroles($role_id,$sec){
            $this->db->select('eu.*');
            $this->db->from('erms_user as eu');

            if(!empty($role_id)){
                $this->db->where('eu.role_id',$role_id);
            } 
            
            if(!empty($sec)){
                $this->db->where('eu.section_id',$sec);
            }

            $query = $this->db->get();
            return $query->result();
      }
      
      // Get user roles from the select : SUPERVISOR 
      public function get_esc_supervisor($role_id,$sec,$dir){
        $this->db->select('eu.*');
        $this->db->from('erms_user as eu');

        if(!empty($role_id)){
            $this->db->where('eu.role_id',$role_id);
        } 
        
        if(!empty($sec)){
            $this->db->where('eu.section_id',$sec);
        }
  
        $this->db->or_where('eu.directorate_id', $dir);
    
        $query = $this->db->get();
        return $query->result();
     }


    
 }  