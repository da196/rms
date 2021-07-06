<?php

Class Consequences_Model extends CI_Model{

    // Consequences_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

     /* Insert Section */
     public function insert_consequences($data = array()){

        return $this->db->insert("erms_risk_incident_consequences",$data);        
    }

    public function getIncidentConsequences($incident_id){
        $this->db->select('*');
        $this->db->where('incident_id',$incident_id);
        $this->db->order_by("description", "ASC");
        $query = $this->db->get("erms_risk_incident_consequences");
        //return $query->result();
        return $query;   
    }
}    