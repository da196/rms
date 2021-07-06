<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  

// Mapping of users to respective roles
 class UserRoles extends CI_Controller {  

      function __construct(){
        parent::__construct();
        $this->load->model('UserRoles_Model','userroles_model');
        $this->load->model('Roles_Model','roles_model');     
        $this->load->model('User_Model','user_model');        
      }


     // Default landing page
      function index(){  
          $this->load->view('include/header');
          $data['rolenames'] = $this->roles_model->get_all_roles()->result();    
          $data['emails'] = $this->user_model->get_all_users_email()->result();    

          $data['title'] = "Users"; 
          $data['subtitle'] = "Roles";   
          $this->load->view('userroles_view',$data);   
          $this->load->view('include/footer');  //footnote    
          $this->load->view('include/jsfiles'); //all included JS Files
          $this->load->view('userroles_custom'); //custom JS manipulations for this page 
      }  

      function fetch(){  
           $this->load->model("userroles_model");  
           $fetch_data = $this->userroles_model->make_datatables();   
           $data = array();  

           $no = 1; 
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
               // $sub_array[] = $row->id;  
                $sub_array[] = $no++; 
                $sub_array[] = $row->email;  
               // $sub_array[] = $row->active;  
               // $sub_array[] = $row->approved;  

               //convert role ID to its equivalent name
               $get_data = $this->roles_model->get_role_name($row->role_id)->result();  
               // $sub_array[] = json_encode($get_data);  
               //$sub_array[] = json_encode($row);  
               foreach($get_data as $value)  
               {  
                  $sub_array[] = $value->name;  
               } 
               //$sub_array[] = $row->role_id;  

                $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-default btn-xs viewuserroles"><i class="fa fa-list"></i>&nbsp;View</button>&nbsp;<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-xs updateuserroles">Change Role</button>';  
                //&nbsp;<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs deleteuserroles">Delete</button>
                $data[] = $sub_array; 
           }  
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->userroles_model->get_all_data(),  
               "recordsFiltered"     =>     $this->userroles_model->get_filtered_data(),  
               "data"                =>     $data  
           );  
           echo json_encode($output);  //change Associative array to JSON
      }  


      
  

      function action(){ 
          // date_default_timezone_set('Africa/Dar_es_Salaam');
          // $format = '%Y-%m-%d %H:%i %s';        
          $date = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
          $today = $date->format('Y-m-d H:i:s');  

          // Add Action
          if($_POST["action"] == "Add")  
           {  
              $insert_data = array(  
                   'email'         =>     $this->input->post('email'),  
                   'active'         =>     $this->input->post("active"), 
                   'role_id'  =>     $this->input->post("role_id"),
                   'date_created'=> $today
              );  
              $this->load->model('userroles_model');  
              $this->userroles_model->insert($insert_data);  
              echo 'Role has been assigned to a user successfully';  
           }  

           // Edit Action
           if($_POST["action"] == "Edit")  
           {                   
              $updated_data = array(  
                  //'email'         =>     $this->input->post('email'),  
                  'role_id'  =>     $this->input->post("role_id"),
                  'active'         =>     $this->input->post("active"), 
                  'date_updated'=> $today
              );  
              $this->load->model('userroles_model');  
              $this->userroles_model->update($this->input->post("userroles_id"), $updated_data);  
              echo 'Changes have been updated successfully';  
           }  

           // Soft Delete Action
           if($_POST["action"] == "SoftDelete")  
           { 
              $updated_data = array(  
                   'active' => 0
              );  
              $this->load->model('userroles_model');  
              $this->userroles_model->update($this->input->post("userroles_id"), $updated_data);  
              echo 'Selected user has been deleted successfully';  
           }  
      }  

      
      function fetch_one()  
      {  
           $output = array();  
           $this->load->model("userroles_model");  
           $data = $this->userroles_model->fetch_one($_POST["userroles_id"]);  
           foreach($data as $row)  
           {  
                $output['email'] = $row->email;  
                //convert role ID to its equivalent name
                $get_data = $this->roles_model->get_role_name($row->role_id)->result();  
                // $sub_array[] = json_encode($get_data);  
                foreach($get_data as $value)  
                {  
                   $output['role_idNAME'] = $value->name;  
                }  

                //convert role ID to its equivalent description
                $get_data = $this->roles_model->get_role_description($row->role_id)->result();  
                // $sub_array[] = json_encode($get_data);  
                foreach($get_data as $value)  
                {  
                   $output['role_description'] = $value->description;  
                }  

                $output['role_id'] = $row->role_id;  //different from role_idNAME...to be used on update MODAL not view MODAL
           }  
           echo json_encode($output);  
      }  


      function delete_one()  
      {  
           $this->load->model("userroles_model");  
           $this->userroles_model->delete_one($_POST["userroles_id"]);  
           echo "Data Deleted";  
      }


 }  