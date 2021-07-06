<?php

Class Risk_Approval_Model extends CI_Model{

    // Student Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

     // Insert Emerging Risk Approval
     public function insert_risk_emerging_approval($data = array()){

        return $this->db->insert("erms_risk_emerging_approval",$data);
        
    }

}    