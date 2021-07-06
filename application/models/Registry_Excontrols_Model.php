<?php

Class Registry_Excontrols_Model extends CI_Model{

    // Registry_Excontrols_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

     // Insert Registry_Excontrols 
     public function insert_registry_excontrols($data = array()){

        return $this->db->insert("erms_risk_registry_excontrols",$data);
        
    }

    // Get Registry Consequences 
    public function get_registry_excontrols($reg_id){
        $this->db->select('erre.*');

        $this->db->from('erms_risk_registry_excontrols as erre');

        $this->db->where('erre.active',1);

        if(!empty($reg_id)){
            $this->db->where('erre.risk_registry_id',$reg_id);
        }
       
        $query = $this->db->get();
        return $query;

    }


    public function update_registry_excontrols($data,$ex_id){

        $this->db->where('id',$ex_id);
        $this->db->update('erms_risk_registry_excontrols', $data);     
        $query =  $this->db->get("erms_risk_registry_excontrols");

        return $query;
       
    }

}