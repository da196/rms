<?php

Class Responsible_Officer_Model extends CI_Model{

    // Responsible_Office Constructor 
    public function __construct(){
        // CI constructor
        parent::__construct();

            // Load the database
            $this->load->database();  
    }

    // Get All Responsible Officer
    public function get_ResponsibleOfficers($officer_id,$status){
        $this->db->select('ero.*');
        $this->db->from('erms_responsible_officer as ero');

        if(!empty($officer_id)){
            $this->db->where('ero.id',$officer_id);
        }

        if(!empty($status)){
            $this->db->where('ero.active',$status);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_ResponsibleOfficers_email($id){
        $this->db->select('ero.email_address');
        $this->db->from('erms_responsible_officer as ero');

        // if(!empty($status)){
        //     $this->db->where('ero.active',$status);
        // }
        $this->db->where('ero.id',$id);
        $query = $this->db->get();
        return $query;
    }
}  