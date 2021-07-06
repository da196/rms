<?php

Class Registry_Adcontrols_Model extends CI_Model{

    // Registry_Adcontrols_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

     // Insert Registry_Adcontrols 
     public function insert_registry_adcontrols($data = array()){

        return $this->db->insert("erms_risk_registry_adcontrols",$data);
        
    }

    // Get all Registry_Adcontrols  
    public function registry_consequences($reg_id){
        $this->db->select('eic.*');
        $this->db->from('erms_risk_incident_consequences as eic');

        if(!empty($inc_id)){
            $this->db->where('eic.incident_id',$reg_id);
        }
       
        $query = $this->db->get();
        return $query;
    }


    // Get Registry ADControls 
    public function get_registry_adcontrols($reg_id){
        $this->db->select('erra.*');

        $this->db->from('erms_risk_registry_adcontrols as erra');

        $this->db->where('erra.active',1);

        if(!empty($reg_id)){
            $this->db->where('erra.risk_registry_id',$reg_id);
        }
       
        $query = $this->db->get();
        return $query;

    }

    public function update_registry_adcontrols($data,$id){

        $this->db->where('id',$id);
        $this->db->update('erms_risk_registry_adcontrols', $data);     
        $query =  $this->db->get("erms_risk_registry_adcontrols");

        return $query;
       
    }

}