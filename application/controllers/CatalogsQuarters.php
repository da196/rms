<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  

 class CatalogsQuarters extends CI_Controller {  

      function __construct(){
        parent::__construct();
        $this->load->model('CatalogsQuarters_Model','catalogsquarters_model');
      }

     // Default landing page
      function index(){ 
          $this->load->view('include/header');   
          $data['title'] = "Settings";       
          $data['subtitle'] = "Quarter";     
          $this->load->view('catalogs/catalogsquarters_view',$data);
          $this->load->view('include/footer');  //footnote   
          $this->load->view('include/jsfiles'); //all included JS Files
          $this->load->view('catalogs/catalogsquarters_custom'); //custom JS manipulations for this page     
      }  

      // //Pull data(and creates a table like view) whereby active=1
      function fetch(){  
           $fetch_data = $this->catalogsquarters_model->make_datatables();   
           $data = array();    

           $no = 1; 
           foreach($fetch_data as $row)  
           {                  
                $sub_array = array(); 
                //$sub_array[] = $row->id;   
                $sub_array[] =  $no++;
                $sub_array[] = $row->quarter_name; 
                $sub_array[] = $row->quarter_description;  
                $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-default btn-xs viewcatalogsquarters"><i class="fa fa-list"></i>&nbsp;View</button>&nbsp;<button type="button" name="update" id="'.$row->id.'" class="btn btn-default btn-xs updatecatalogsquarters"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="button" name="delete" id="'.$row->id.'" class="btn btn-default btn-xs softdeletecatalogsquarters"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                $data[] = $sub_array; 
           }  
           
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->catalogsquarters_model->get_all_data(),  
               "recordsFiltered"     =>     $this->catalogsquarters_model->get_filtered_data(),  
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
                   'quarter_name'         =>     $this->input->post('quarter_name'),  
                   'quarter_description'         =>     $this->input->post("quarter_description"),
                   'active'  =>     1,
                   'date_created'=> $today
              );  
              $this->load->model('catalogsquarters_model');  
              $this->catalogsquarters_model->insert($insert_data);  
              echo 'New Quarter has been Added Successfully';  
          }  
 
           // Edit Action
           if($_POST["action"] == "Edit")  
           {                   
              $updated_data = array(  
                   'quarter_name'         =>     $this->input->post('quarter_name'),  
                   'quarter_description'         =>     $this->input->post("quarter_description"),
                   'active'  =>     1,
                   'date_updated'=> $today
                   //'date_updated' => @mdate($format) //uses date helper
              );  
              $this->load->model('catalogsquarters_model');  
              $this->catalogsquarters_model->update($this->input->post("catalogsquarters_id"), $updated_data);  
              echo 'Existing Quarter has been Updated Successfully';  
           }  

           // Soft Delete Action
           if($_POST["action"] == "SoftDelete")  
           { 
              $updated_data = array(  
                   'active' => 0
              );  
              $this->load->model('catalogsquarters_model');  
              $this->catalogsquarters_model->update($this->input->post("catalogsquarters_id"), $updated_data);  
              echo 'Selected Quarter has been Deleted Successfully';  
           }  
      }  

      
      function fetch_one()  
      {  
           $output = array();  
           $this->load->model("catalogsquarters_model");  
           $data = $this->catalogsquarters_model->fetch_one($_POST["catalogsquarters_id"]);  
           foreach($data as $row)  
           {  
                $output['id'] = $row->id; 
                $output['quarter_name'] = $row->quarter_name;  
                $output['quarter_description'] = $row->quarter_description;    
           }  
           echo json_encode($output);  
      }  


      // function delete_one()  
      // {  
      //      $this->load->model("catalogsquarters_model");  
      //      $this->catalogsquarters_model->delete_one($_POST["catalogsobjectives_id"]);  
      //      echo "Selected Objective has been Deleted Successfully";  
      // }


 }  