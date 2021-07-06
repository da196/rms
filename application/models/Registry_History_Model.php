<?php

Class Registry_History_Model extends CI_Model{

    // Registry_History_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

     // Insert Registry_History_Model 
     public function insert_registry_history($data = array()){

        return $this->db->insert("erms_risk_registry_history",$data);
        
    }

    // SEARCH HISTORY ACTIVE+REGID+QUARTERID+YEARID
    public function search_registry_history($reg_id,$quarter,$year,$code){
        $this->db->select('errh.*,ey.year');
        $this->db->from('erms_risk_registry_history as errh');
        $this->db->join('erms_year as ey', 'errh.year_id = ey.id');
        $this->db->join('erms_trends as et', 'errh.trends_id = et.id');

        if(!empty($code)){
        $this->db->where('errh.active_code',$code);
        }

        if(!empty($reg_id)){
            $this->db->where('errh.risk_registry_id',$reg_id);
        }

        if(!empty($quarter)){
            $this->db->where('errh.quarter_id',$quarter);
        }

        if(!empty($year)){
            $this->db->where('errh.year_id',$year);
        }
       
        $query = $this->db->get();
        return $query;
    }   



    // UPDATE RISK REGISTER HISTORY
    public function update_registry_history($data,$his_id){
        $this->db->where('id',$his_id);
        $this->db->update('erms_risk_registry_history', $data);     
        $query =  $this->db->get("erms_risk_registry_history");
        return $query;       
    }
    public function update_risk_register_history($data,$tableid){
        $this->db->where('id',$tableid);
        $this->db->update('erms_risk_registry_history', $data);     
        $query =  $this->db->get("erms_risk_registry_history");
        return $query;       
    }
}