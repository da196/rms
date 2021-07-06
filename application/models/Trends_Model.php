<?php
Class Trends_Model extends CI_Model{

// Trends_Model Constructor 
public function __construct(){
    // CI constructor
    parent::__construct();

        // Load the database
        $this->load->database();  
}


    // List of all Trends_Model 
    public function getAll_trends(){
        // list/retrieve data method
        $this->db->select("*");
        $this->db->from("erms_trends");
        $this->db->order_by('trend_name', 'ASC');   //sort names in ascending order
        $query = $this->db->get();   
        return $query;
    }   

    //Get trend name
    public function get_trends_name($id){
        $this->db->select('trend_name');
        $query = $this->db->get_where('erms_trends', array('id' =>  $id));
        return $query; //return query then on controller use ->result(); to get results on controller
        //echo json_encode($data);
    }


    



} 