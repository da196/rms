<?php

Class Registry_Objectives_Model extends CI_Model{

    // Registry_Objectives_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

     // Insert Registry_Objectives 
     public function insert_registry_objectives($data = array()){

        return $this->db->insert("erms_risk_registry_objectives",$data);
        
    }

}