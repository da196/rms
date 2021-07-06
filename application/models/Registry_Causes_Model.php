<?php

Class Registry_Causes_Model extends CI_Model{

    // Registry_Causes_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

     // Insert Registry_Causes 
     public function insert_registry_causes($data = array()){

        return $this->db->insert("erms_risk_registry_causes",$data);
        
    }

    

    public function get_registry_causes($reg_id){
        $this->db->select('errc.*');

        $this->db->from('erms_risk_registry_causes as errc');

        $this->db->where('errc.active',1);

        if(!empty($reg_id)){
            $this->db->where('errc.risk_registry_id',$reg_id);
        }
       
        $query = $this->db->get();
        return $query;

    }


    public function update_registry_causes($data,$cau_id){

        $this->db->where('id',$cau_id);
        $this->db->update('erms_risk_registry_causes', $data);     
        $query =  $this->db->get("erms_risk_registry_causes");

        return $query;
       
    }


    // Insert Registry_Causes_Reason 
     public function insert_registry_causes_reason($data = array()){
        return $this->db->insert("erms_change_cause_history",$data);      
    }

    


    
    

}