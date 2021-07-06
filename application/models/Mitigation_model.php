<?php

Class Mitigation_Model extends CI_Model{

    // Mitigation_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

     /* Insert Section */
     public function insert_mitigation($data = array()){

        return $this->db->insert("erms_risk_incident_mitigation",$data);
        
    }

    public function getIncidentMitigation($incident_id){
        $this->db->select('*');
        $this->db->where('incident_id',$incident_id);
        $this->db->order_by("description", "ASC");
        $query = $this->db->get("erms_risk_incident_mitigation");
        //return $query->result();
        return $query;   
    }

}    