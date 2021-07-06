<?php

Class Registry_Events_Model extends CI_Model{

    // Registry_Events_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

     // Insert Registry_Events 
     public function insert_registry_events($data = array()){

        return $this->db->insert("erms_risk_registry_events",$data);
        
    }

    // Get All the Registry Events
    public function get_registry_events($reg_id){
        $this->db->select('erre.*');

        $this->db->from('erms_risk_registry_events as erre');

        $this->db->where('erre.active',1);

        if(!empty($reg_id)){
            $this->db->where('erre.risk_registry_id',$reg_id);
        }
       
        $query = $this->db->get();
        return $query;

    }


    public function update_registry_events($data,$eve_id){

        $this->db->where('id',$eve_id);
        $this->db->update('erms_risk_registry_events', $data);     
        $query =  $this->db->get("erms_risk_registry_events");

        return $query;     
    }


    // Insert Registry_Event_Reason 
    public function insert_registry_events_reason($data = array()){
        return $this->db->insert("erms_change_event_history",$data);

    }

    
}