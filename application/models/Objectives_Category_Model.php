<?php

Class Objectives_Category_Model extends CI_Model{

    // Directorate_Model Constructor 
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

        // List of all Objective_Category
        public function getAll_objectiveCategory(){
            // list/retrieve data method
            $this->db->select("*");
            $this->db->from("erms_objectives_category");
            $query = $this->db->get();   
            return $query;
        }


        

        // Get a specific objective category name
        function get_objective_category_name($objective_category_id){
            $this->db->select('objective_category');      
            $query = $this->db->get_where('erms_objectives_category', array('id' =>  $objective_category_id));
            return $query;
            //echo json_encode($data);
        }


        


    
}  