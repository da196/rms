<?php
Class Year_Model extends CI_Model{

// Year_Model Constructor 
public function __construct(){
    // CI constructor
    parent::__construct();

        // Load the database
        $this->load->database();  
}


    // List of all Year_Model 
    public function getAll_years(){
        // list/retrieve data method
        $this->db->select("*");
        $this->db->from("erms_year");
        $this->db->order_by('id', 'DESC'); 
        $query = $this->db->get();  
        return $query;
    }   

    //Get Year name
    public function get_year_name($id){
        $this->db->select('year');
        $query = $this->db->get_where('erms_year', array('id' =>  $id));
        return $query; //return query then on controller use ->result(); to get results on controller
        //echo json_encode($data);
    }

    



} 