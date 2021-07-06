<?php

Class Registry_Consequences_Model extends CI_Model{

    // Registry_Consequences_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

    // Insert Registry_Consequences 
     public function insert_registry_consequences($data = array()){

        return $this->db->insert("erms_risk_registry_consequences",$data);
        
    }

    // Get Registry Consequences 
    public function get_registry_consequences($reg_id){
        $this->db->select('errc.*');

        $this->db->from('erms_risk_registry_consequences as errc');

        $this->db->where('errc.active',1);

        if(!empty($reg_id)){
            $this->db->where('errc.risk_registry_id',$reg_id);
        }
       
        $query = $this->db->get();
        return $query;

    }


    public function update_registry_consequences($data,$id){

        $this->db->where('id',$id);
        $this->db->update('erms_risk_registry_consequences', $data);     
        $query =  $this->db->get("erms_risk_registry_consequences");

        return $query;
       
    }

    // Insert Registry_Consequences_Reason 
    public function insert_registry_consequences_reason($data = array()){
        return $this->db->insert("erms_change_consequence_history",$data);      
    }

}