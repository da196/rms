<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  

 class CatalogsObjectives extends CI_Controller {  

      function __construct(){
        parent::__construct();
        $this->load->model('CatalogsObjectives_Model','catalogsobjectives_model');
      }

     // Default landing page
      function index(){ 
          $this->load->view('include/header');  
          $data['title'] = "Settings";      
          $data['subtitle'] = "Organization Objective";     
          $this->load->view('catalogs/catalogsobjectives_view', $data);
          $this->load->view('include/footer');  //footnote   
          $this->load->view('include/jsfiles'); //all included JS Files
          $this->load->view('catalogs/catalogsobjectives_custom'); //custom JS manipulations for this page  
      }  

      // //Pull data(and creates a table like view) whereby active=1
      function fetch(){  
           $fetch_data = $this->catalogsobjectives_model->make_datatables();   
           $data = array();    

           $no = 1; 
           foreach($fetch_data as $row)  
           {                  
                $sub_array = array(); 
                //$sub_array[] = $row->id;   
                $sub_array[] =  $no++;
                $sub_array[] = $row->code; 
                $sub_array[] = $row->name;  
                $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-default btn-xs viewcatalogsobjectives"><i class="fa fa-list"></i>&nbsp;View</button>&nbsp;<button type="button" name="update" id="'.$row->id.'" class="btn btn-default btn-xs updatecatalogsobjectives"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="button" name="delete" id="'.$row->id.'" class="btn btn-default btn-xs softdeletecatalogsobjectives"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                $data[] = $sub_array; 
           }  
           
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->catalogsobjectives_model->get_all_data(),  
               "recordsFiltered"     =>     $this->catalogsobjectives_model->get_filtered_data(),  
               "data"                =>     $data  
           );  
           echo json_encode($output);  //change Associative array to JSON
           //var_dump($output); //die();
      }  

      function action(){   
          // date_default_timezone_set('Africa/Dar_es_Salaam');
          // $format = "%Y-%m-%d %H:%i %s";       
        $date = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $today = $date->format('Y-m-d H:i:s');  
    
          // Add Action
          if($_POST["action"] == "Add")  
          {  
              $insert_data = array(  
                   'code'         =>     $this->input->post('code'),  
                   'name'         =>     $this->input->post("name"),
                   'description'  =>     $this->input->post("description"),
                   'active'  =>     1,
                   'date_created'=> $today
              );  
              $this->load->model('catalogsobjectives_model');  
              $this->catalogsobjectives_model->insert($insert_data);  
              echo 'New organization objective has been added successfully';  
          }  

           // Edit Action
           if($_POST["action"] == "Edit")  
           {                   
              $updated_data = array(  
                   'code'         =>     $this->input->post('code'),  
                   'name'         =>     $this->input->post("name"),
                   'description'  =>     $this->input->post("description"),
                   'active'  =>     1,
                   'date_updated'=> $today
                   //'date_updated' => @mdate($format) //uses date helper
              );  
              $this->load->model('catalogsobjectives_model');  
              $this->catalogsobjectives_model->update($this->input->post("catalogsobjectives_id"), $updated_data);  
              echo 'Existing organization objective has been updated successfully';  
           }  

           // Soft Delete Action
           if($_POST["action"] == "SoftDelete")  
           { 
              $updated_data = array(  
                   'active' => 0
              );  
              $this->load->model('catalogsobjectives_model');  
              $this->catalogsobjectives_model->update($this->input->post("catalogsobjectives_id"), $updated_data);  
              echo 'Selected organization objective has been deleted successfully';  
           }  
      }  

      
      function fetch_one()  
      {  
           $output = array();  
           $this->load->model("catalogsobjectives_model");  
           $data = $this->catalogsobjectives_model->fetch_one($_POST["catalogsobjectives_id"]);  
           foreach($data as $row)  
           {  
                $output['id'] = $row->id; 
                $output['code'] = $row->code;  
                $output['name'] = $row->name; 
                $output['description'] = $row->description;     
           }  
           echo json_encode($output);  
      }  


      // function delete_one()  
      // {  
      //      $this->load->model("catalogsobjectives_model");  
      //      $this->catalogsobjectives_model->delete_one($_POST["catalogsobjectives_id"]);  
      //      echo "Selected Objective has been Deleted Successfully";  
      // }


 }  