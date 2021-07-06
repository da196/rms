<?php

Class Directorate_Model extends CI_Model{
    public function __construct(){ // CI constructor        
        parent::__construct();
        $this->load->database();  // Load the database
    }

    // List of all Directorates
    public function get_directorate(){
        $this->db->select("*");
        $this->db->from("erms_risk_directorate");
        $query = $this->db->get();   
        return $query;
    }

     /* Insert Incident 
     public function insert_incident($data = array()){

        return $this->db->insert("erms_risk_incident",$data);
        
    }
    */

        // Get a specific directorate name
        public function get_directorate_name($id){
            $this->db->select('directorate_name');
            $query = $this->db->get_where('erms_risk_directorate', array('id' =>  $id));
            return $query; //return query then on controller use ->result(); to get results on controller
            //echo json_encode($data);
        }
  
        // Get a specific directorate abbreviation
        public function get_directorate_abbreviation($id){
            $this->db->select('directorate_abbreviation');
            $query = $this->db->get_where('erms_risk_directorate', array('id' =>  $id));
            return $query; //return query then on controller use ->result(); to get results on controller
            //echo json_encode($data);
        }


        // CONVERT RISK OWNER ID TO NAME
        public function get_riskowner_name($id){
            $this->db->select('name');
            $query = $this->db->get_where('erms_risk_owner', array('id' =>  $id));
            return $query; //return query then on controller use ->result(); to get results on controller
            //echo json_encode($data);
        }



        


    
}    