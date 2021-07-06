<?php

Class Risk_Model extends CI_Model{

   // RISK Constructor 
   public function __construct(){
       // CI constructor
       parent::__construct();

           // Load the database
           $this->load->database();  
   }

    // Insert Emerging Risk 
    public function insert_risk_emerging($data = array()){

       return $this->db->insert("erms_risk_emerging",$data);
       
   }

   // Retrieve all Emerging Risk (Status as active)
   // STATUS_ID // RISK_ID AND USER_ID
   public function get_risk_emerging($status_code = array(),$risk_id,$user_id){ 
       $this->db->select('ere.*,eu.email,ers.status,ero.first_name,ero.middle_name,ero.last_name,ero.designation');
       $this->db->from('erms_risk_emerging as ere');
       $this->db->join('erms_user as eu', 'ere.reporter_id = eu.id');
       $this->db->join('erms_risk_status as ers', 'ere.status_id = ers.id');
       $this->db->join('erms_responsible_officer as ero', 'ere.responsible_officer_id = ero.id');
       $this->db->where_not_in('ere.status_id', 2);

       if(!empty($status_code)){
           $this->db->where_in('ere.status_id',$status_code);
       }

       if(!empty($risk_id)){
           $this->db->where('ere.id',$risk_id);
       }

       if(!empty($user_id)){
           $this->db->where('ere.reporter_id',$user_id);
       }
       $this->db->order_by('ere.id', 'DESC');
       $query = $this->db->get();
       return $query;

   }

   // Fetch A certain Emerging Risk
   public function fetch_risk_emerging($risk_id){

       $this->db->where("risk_id",$risk_id);
       $query = $this->db->get("erms_risk_emerging");  
       return $query->result();      
   }

   // Update Emerging Risk
   public function update_risk_emerging($risk_emerging,$id){
       $this->db->where("id",$id);
       return $this->db->update("erms_risk_emerging",$risk_emerging);
      
   }

   // Delete Emerging Risk
   // Risk Status 1 as New/Active, 2 as Inactive/Deleted , 3 as Evaluated
     public function delete_risk_emerging($risk_id){

       $this->db->set('status_id', 2);
       $this->db->where('id', $risk_id);
       $this->db->update('erms_risk_emerging'); 
       /*
       $query = $this->db->get("erms_risk_emerging");
       if($query->num_rows() > 0){
           return $query->result_array()[0];
           // return $query->result();
       }
       else{
         return false;  
       }
      */ 

   }

   // Risk with Approval comment 
   public function risk_fetch_approval($risk_id){
       $this->db->select('ere.*,erea.comments,ers.status,ero.first_name,ero.middle_name,ero.last_name,ero.designation');
       $this->db->from('erms_risk_emerging as ere');
       $this->db->join('erms_risk_emerging_approval as erea', 'ere.id = erea.risk_id');
       $this->db->join('erms_risk_status as ers', 'ere.status_id = ers.id');
       $this->db->join('erms_responsible_officer as ero', 'ere.responsible_officer_id = ero.id');

       if(!empty($risk_id)){
           $this->db->where('ere.id',$risk_id);
       }
      
       $query = $this->db->get();
       return $query->result();
   }
   
   // Total count for Reported Risk 
   public function count_Riskreport($status){
       $this->db->select('ere.*');
       $this->db->from('erms_risk_emerging as ere');

       if(!empty($status)){
           $this->db->where('ere.id',$status);
       }
      
       $query = $this->db->get();

       return $query->num_rows();

   }

   //Get risk status count
   public function risksstatuscount($status){
       $this->db->select('*');
       $this->db->from('erms_risk_emerging');
       $this->db->where('status_id',$status);         
       $query = $this->db->get();
       return $query->num_rows();
   }


   
   // List of all RISK Levels from table erms_risk_levels
   public function get_risk_levels(){
       // list/retrieve data method
       $this->db->select("*");
       $this->db->from("erms_risk_levels");
       $query = $this->db->get();   
       return $query;
   }

   // Get a specific RISK LEVEL name
   function get_risk_level_name($id){
       $this->db->select('name');
       $query = $this->db->get_where('erms_risk_levels', array('id' =>  $id));
       return $query; //return query then on controller use ->result(); to get results on controller
       //echo json_encode($data);
   }
   


    // List all risk status 
    public function get_risk_statuses(){
        $this->db->select("*");
        $this->db->from("erms_risk_status");
        $this->db->order_by("status","ASC");
        $query = $this->db->get();   
        //return $query;
         return $query->result();  
    }


    public function get_risk_statuses_exclude_deleted_incomplete(){
      $this->db->select("*");
      $this->db->from("erms_risk_status");
      $this->db->order_by("status","ASC");
      $this->db->where('status !=', 'Deleted');
      $this->db->where('status !=', 'Incomplete');
      $query = $this->db->get();   
      //return $query;
       return $query->result(); 
    }

    //Get status name
    function get_risk_statuses_name($id){
        $this->db->select('status');
        $query = $this->db->get_where('erms_risk_status', array('id' =>  $id));
        return $query; //return query then on controller use ->result(); to get results on controller
        //echo json_encode($data);
    }

    //
    public function get_risk_owners(){
        $this->db->select("*");
        $this->db->from("erms_risk_owner");
        $this->db->order_by('name', 'ASC');   //sort names in ascending order
        $query = $this->db->get();   
        return $query;
    }

    //Get risk owner name
    public function get_risk_owners_name($id){
        $this->db->select('name');
        $query = $this->db->get_where('erms_risk_owner', array('id' =>  $id));
        return $query; //return query then on controller use ->result(); to get results on controller
        //echo json_encode($data);
    }

    public function get_risk_category(){
        // list/retrieve data method
        $this->db->select("*");
        $this->db->from("erms_objectives_category");
        $this->db->order_by('objective_category', 'ASC');   //sort name in ascending order
        $query = $this->db->get();   
        return $query;
    } 


    // CONVERT RISK CATEGORY ID TO NAME
    public function get_risk_category_name($id){
        $this->db->select('objective_category');
        $query = $this->db->get_where('erms_objectives_category', array('id' =>  $id));
        return $query; //return query then on controller use ->result(); to get results on controller
        //echo json_encode($data);
    }




        
   

}

?>