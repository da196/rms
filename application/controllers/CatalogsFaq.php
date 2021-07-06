<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  

 class CatalogsFaq extends CI_Controller {  

      function __construct(){
        parent::__construct();
        $this->load->model('CatalogsFaq_Model','catalogsfaq_model');
      }

     // Default landing page
      function index(){ 
          $this->load->view('include/header');   
          $data['title'] = "Settings";    
          $data['subtitle'] = "faq";         
          $this->load->view('catalogs/catalogsfaq_view', $data);
          $this->load->view('include/footer');  //footnote   
          $this->load->view('include/jsfiles'); //all included JS Files
          $this->load->view('catalogs/catalogsfaq_custom'); //custom JS manipulations for this page  
      }  

      // //Pull data(and creates a table like view) whereby active=1
      function fetch(){  
           $fetch_data = $this->catalogsfaq_model->make_datatables();   
           $data = array();    

           $no = 1; 
           foreach($fetch_data as $row)  
           {                  
                $sub_array = array(); 
                //$sub_array[] = $row->id;   
                $sub_array[] =  $no++;
                $sub_array[] = $row->faq_question; 
                $sub_array[] = $row->faq_answer;  

                //$sub_array[] = $row->active;  
                if( $row->active == 1 ){
                  $sub_array[] = 'Active';
                }elseif ($row->active == 0) {
                  $sub_array[] = 'In-Active';
                }else{
                  $sub_array[] = 'Error';
                }  

                $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-default btn-xs viewcatalogsfaq"><i class="fa fa-list"></i>&nbsp;View</button>&nbsp;<button type="button" name="update" id="'.$row->id.'" class="btn btn-default btn-xs updatecatalogsfaq"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="button" name="delete" id="'.$row->id.'" class="btn btn-default btn-xs softdeletecatalogsfaq"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                $data[] = $sub_array; 
           }  
           
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->catalogsfaq_model->get_all_data(),  
               "recordsFiltered"     =>     $this->catalogsfaq_model->get_filtered_data(),  
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
                   'faq_question'         =>     $this->input->post('faq_question'),  
                   'faq_answer'         =>     $this->input->post("faq_answer"),
                   'active'  =>     1,
                   'date_created'=> $today
              );  
              $this->load->model('catalogsfaq_model');  
              $this->catalogsfaq_model->insert($insert_data);  
              echo 'New FAQ has been added successfully';  
          }  
 
           // Edit Action
           if($_POST["action"] == "Edit")  
           {                   
              $updated_data = array(  
                    'faq_question'         =>     $this->input->post('faq_question'),  
                    'faq_answer'         =>     $this->input->post("faq_answer"),
                    'active'  =>     1,
                   'date_updated'=> $today
                   //'date_updated' => @mdate($format) //uses date helper
              );  
              $this->load->model('catalogsfaq_model');  
              $this->catalogsfaq_model->update($this->input->post("catalogsfaq_id"), $updated_data);  
              echo 'Existing FAQ  has been updated successfully';  
           }  

           // Soft Delete Action
           if($_POST["action"] == "SoftDelete")  
           { 
              $updated_data = array(  
                   'active' => 0
              );  
              $this->load->model('catalogsfaq_model');  
              $this->catalogsfaq_model->update($this->input->post("catalogsfaq_id"), $updated_data);  
              echo 'Selected FAQ has been deleted Successfully';  
           }  
      }  

      
      function fetch_one()  
      {  
           $output = array();  
           $this->load->model("catalogsfaq_model");  
           $data = $this->catalogsfaq_model->fetch_one($_POST["catalogsfaq_id"]);  
           foreach($data as $row)  
           {  
                $output['id'] = $row->id; 
                $output['faq_question'] = $row->faq_question;  
                $output['faq_answer'] = $row->faq_answer;   
                $output['active'] = $row->active;   
           }  
           echo json_encode($output);  
      }  

      //Fetch a  single item to be displayed on a view
      function fetch_one_view()  
      {  
           $output = array();  
           $this->load->model("catalogsfaq_model");  
           $data = $this->catalogsfaq_model->fetch_one($_POST["catalogsfaq_id"]);  
           foreach($data as $row)  
           {  
                $output['id'] = $row->id; 
                $output['faq_question'] = $row->faq_question;  
                $output['faq_answer'] = $row->faq_answer; 
                if( $row->active == 1 ){
                  $output['active'] = 'Active'; 
                }elseif ($row->active == 0) {
                  $output['active'] = 'In-Active'; 
                }else{
                  $output['active'] = 'Error'; 
                }
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