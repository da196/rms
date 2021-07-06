<?php

Class User_Model extends CI_Model{

    // Student Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();
    
    }

    // Check if the user exists
    public function check_User($user){

        $this->db->where("email",$user);
        $query = $this->db->get("erms_user");
        if($query->num_rows() > 0){
            return true;  
        }
        else{
          return false;  
        }

    }

    // Get user ID 
    public function get_user($user){
        $this->db->where("email",$user);
        $query = $this->db->get("erms_user");
        if($query->num_rows() > 0){
            return $query->result_array()[0];
            // return $query->result();
        }
        else{
          return false;  
        }
    }

    // Insert Users in the tbl_users
    public function insert_user($data = array()){

        return $this->db->insert("erms_user",$data);
    }



    // List all users
    public function get_all_users(){
        $this->db->select("*");
        $this->db->from("erms_user");
        $this->db->order_by("email","ASC");
        $query = $this->db->get();   
        // return $query;
        return $query->result();  
    }

    function get_user_email($id){
        $this->db->select('email');
        $query = $this->db->get_where('erms_user', array('id' =>  $id));
        return $query;
          //return $query->result();  
        //echo json_encode($data);
    }


    //All users emails
    public function get_all_users_email(){
        // list/retrieve data method
        $this->db->select("*");
        $this->db->from("erms_user");
        $notallowedmail='Anonymous User';
        $this->db->where("email !=",$notallowedmail);
        $query = $this->db->get();   
        return $query;
    }

}

?>