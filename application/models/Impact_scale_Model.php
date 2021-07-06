<?php
Class Impact_Scale_Model extends CI_Model{

// Impact_Scale_Model Constructor 
public function __construct(){
    // CI constructor
    parent::__construct();

        // Load the database
        $this->load->database();  
}

 /* Insert Incident 
 public function insert_incident($data = array()){

    return $this->db->insert("erms_risk_incident",$data);
    
}
*/

    // List of all Impact_Scale
    public function getAll_impactScale(){
        // list/retrieve data method
        $this->db->select("*");
        $this->db->from("erms_impact_scale");
        $this->db->where("active",1);
        $this->db->order_by('impact_scale_score', 'ASC');
        $query = $this->db->get();   
        return $query;
    }


    



} 