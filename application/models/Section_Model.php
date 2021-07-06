<?php

Class Section_Model extends CI_Model{

    // Section_Model Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

     /* Insert Section 
     public function insert_incident($data = array()){

        return $this->db->insert("erms_risk_incident",$data);
        
    }
    */

    // List of all Section
    public function get_section(){
        // list/retrieve data method
        $this->db->select("*");
        $this->db->from("erms_risk_section");
        $query = $this->db->get();

        return $query->result();
    }
               
    // List of all Sections in a Directorate
    public function get_section_indirectorate($dir_id){

        $this->db->select('ers.*');
        $this->db->from('erms_risk_section as ers');
        //$this->db->join('erms_risk_directorate as erd', 'erd.id = ers.directorate_id');

        if(!empty($dir_id)){
            $this->db->where('ers.directorate_id',$dir_id);
        }                   
        $query = $this->db->get();
        return $query->result();
    }

    public function get_section_name($id){
        $this->db->select('section_name');
        $query = $this->db->get_where('erms_risk_section', array('id' =>  $id));
        return $query;
    }
    
}  