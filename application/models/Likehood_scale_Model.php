<?php
Class Likehood_Scale_Model extends CI_Model{

// Likehood_Scale_Model Constructor 
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

    // List of all Likehood Scale
    public function getAll_likehoodScale(){
        // list/retrieve data method
        $this->db->select("*");
        $this->db->from("erms_like_hood_scale");
        $this->db->where("active",1);
        $query = $this->db->get();   
        return $query;
    }


    



} 