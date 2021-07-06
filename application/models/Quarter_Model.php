<?php
Class Quarter_Model extends CI_Model{

// Quarter_Model Constructor 
public function __construct(){
    // CI constructor
    parent::__construct();

        // Load the database
        $this->load->database();  
}


    // List of all Quarter_Model 
    public function getAll_quarters(){
        // list/retrieve data method
        $this->db->select("*");
        $this->db->from("erms_quarter");
        $query = $this->db->get();   
        return $query;
    }   

    
    //Get Quarter name
    public function get_quarter_name($id){
        $this->db->select('quarter');
        $query = $this->db->get_where('erms_quarter', array('id' =>  $id));
        return $query; //return query then on controller use ->result(); to get results on controller
        //echo json_encode($data);
    }
   

    



} 