<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  

 class Settings_Objectives extends CI_Controller {  

     // Default landing page
      function index(){  
          $this->load->view('include/header');        
          $this->load->view('objectives_view');   
          $this->load->view('include/footer');    
      }  

      function fetch(){  
           $this->load->model("Objectives_Model","objectives_model");  
           $fetch_data = $this->objectives_model->make_datatables();   
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = $row->id;   
                $sub_array[] = $row->code;  
                $sub_array[] = $row->name;  
                $sub_array[] = $row->description;   
                $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-default btn-xs updateobjectives"><i class="fa fa-edit"></i> Edit</button>';
                $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-default btn-xs deleteobjectives"><i class="fa fa-trash"></i> Delete</button>';  
                $data[] = $sub_array; 
           }  
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->objectives_model->get_all_data(),  
               "recordsFiltered"     =>     $this->objectives_model->get_filtered_data(),  
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
                   'date_created'=> $today
              );  
              $this->load->model('Objectives_Model','objectives_model');  
              $this->objectives_model->insert($insert_data);  
              echo 'New Objective has been Added Successfully';  
           }  

           // Edit Action
           if($_POST["action"] == "Edit")  
           {                   
              $updated_data = array(  
                   'code'          =>     $this->input->post('code'),  
                   'name'          =>     $this->input->post('name'),  
                   'description'   =>     $this->input->post('description'),
                   'date_updated'=> $today  
              );  
              $this->load->model('Objectives_Model','objectives_model');  
              $this->objectives_model->update($this->input->post("objective_id"), $updated_data);  
              echo 'Existing Objective has been Updated Successfully';  
           }  
      }  

      
      function fetch_one()  
      {  
           $output = array();  
           $this->load->model("Objectives_Model","objectives_model");  
           $data = $this->objectives_model->fetch_one($_POST["objective_id"]);  
           foreach($data as $row)  
           {  
                $output['code'] = $row->code;  
                $output['name'] = $row->name; 
                $output['description'] = $row->description;   
           }  
           echo json_encode($output);  
      }  


      function delete_one()  
      {  
           $this->load->model("Objectives_Model","objectives_model");  
           $this->objectives_model->delete_one($_POST["objective_id"]);  
           echo "Selected Objective has been Deleted Successfully";  
      }


    


 }  