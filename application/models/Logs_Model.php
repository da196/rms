<?php
Class Logs_Model extends CI_Model{

// Logs_Model Constructor 
public function __construct(){
    // CI constructor
    parent::__construct();

        // Load the database
        $this->load->database();  
}


    // Insert of all Logs_Model 
    public function insert_logs($data = array()){

        return $this->db->insert("erms_logs",$data);
        
    }  



} 