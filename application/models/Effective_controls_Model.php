
<?php
Class Effective_Controls_Model extends CI_Model{

// Effective_Controls_Model Constructor 
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

    // List of all Effective_Controls
    public function getAll_effectiveControls(){
        // list/retrieve data method
        $this->db->select("*");
        $this->db->from("erms_controls_effectiveness_scale");
        $this->db->where("active",1);
        $this->db->order_by('controls_effectiveness_scale_score', 'ASC');
        $query = $this->db->get();   
        return $query;
    }


    



} 