<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  

 class Settings_Permissions extends CI_Controller {  

     // Default landing page
      function index(){  
          $this->load->view('include/header');        
          $this->load->view('permissions_view');   
          $this->load->view('include/footer');    
      }  

      function fetch(){  
           $this->load->model("Permissions_Model","permissions_model");  
           $fetch_data = $this->permissions_model->make_datatables();   
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = $row->id;   
                $sub_array[] = $row->code;  
                $sub_array[] = $row->name;  
                $sub_array[] = $row->description;   
                $sub_array[] = $row->active;  
                $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-default btn-xs updatepermissions">Update</button>';  
                $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-default btn-xs deletepermissions">Delete</button>';  
                $data[] = $sub_array; 
           }  
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->permissions_model->get_all_data(),  
               "recordsFiltered"     =>     $this->permissions_model->get_filtered_data(),  
               "data"                =>     $data  
           );  
           echo json_encode($output);  //change Associative array to JSON
      }  

      function action(){  
          $date = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
          $today = $date->format('d-m-Y H:i:s');

          // Add Action
          if($_POST["action"] == "Add")  
           {  
              $insert_data = array(  
                   'code'         =>     $this->input->post('code'),  
                   'name'         =>     $this->input->post("name"),  
                   'description'  =>     $this->input->post("description"),
                   'active'  =>     $this->input->post("active"),
                   'date_created'=> $today
              );  
              $this->load->model('Permissions_Model','permissions_model');  
              $this->permissions_model->insert($insert_data);  
              echo 'Data Inserted';  
           }  

           // Edit Action
           if($_POST["action"] == "Edit")  
           {                   
              $updated_data = array(  
                   'code'          =>     $this->input->post('code'),  
                   'name'          =>     $this->input->post('name'),  
                   'description'   =>     $this->input->post('description'),
                   'active'  =>     $this->input->post("active") ,
                   'date_updated'=> $today
              );  
              $this->load->model('Permissions_Model','permissions_model');  
              $this->permissions_model->update($this->input->post("permissions_id"), $updated_data);  
              echo 'Data Updated';  
           }  
      }  

      
      function fetch_one()  
      {  
           $output = array();  
           $this->load->model("Permissions_Model","permissions_model");  
           $data = $this->permissions_model->fetch_one($_POST["permissions_id"]);  
           foreach($data as $row)  
           {  
                $output['code'] = $row->code;  
                $output['name'] = $row->name; 
                $output['description'] = $row->description; 
                $output['active'] = $row->active;   
           }  
           echo json_encode($output);  
      }  


      function delete_one()  
      {  
           $this->load->model("Permissions_Model","permissions_model");  
           $this->permissions_model->delete_one($_POST["permissions_id"]);  
           echo "Data Deleted";  
      }


 }  