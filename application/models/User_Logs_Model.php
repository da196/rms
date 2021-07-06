<?php

Class User_Logs_Model extends CI_Model{

    // Student Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();
    
    }

    /* Check if the user exists
    public function check_User($user){

        $this->db->where("username",$user);
        $query = $this->db->get("tbl_users");
        if($query->num_rows() > 0){
            return true;  
        }
        else{
          return false;  
        }

    }
*/
    // Insert data in the userLogs Table
    public function insert_userLogs($data = array()){

        return $this->db->insert("tbl_user_logs",$data); 
           
    }

}