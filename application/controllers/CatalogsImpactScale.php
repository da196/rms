<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  

 class CatalogsImpactScale extends CI_Controller {  

      function __construct(){
        parent::__construct();
        $this->load->model('CatalogsImpactScale_Model','catalogsimpactscale_model');
      }

     // Default landing page
      function index(){ 
          $this->load->view('include/header');  
          $data['title'] = "Settings";  
          $data['subtitle'] = "Impact Rating Scale";           
          $this->load->view('catalogs/catalogsimpactscale_view',$data);
          $this->load->view('include/footer');  //footnote   
          $this->load->view('include/jsfiles'); //all included JS Files
          $this->load->view('catalogs/catalogsimpactscale_custom'); //custom JS manipulations for this page  
      }  

      // //Pull data(and creates a table like view) whereby active=1
      function fetch(){  
           $fetch_data = $this->catalogsimpactscale_model->make_datatables();   
           $data = array();    

           $no = 1; 
           foreach($fetch_data as $row)  
           {                  
                $sub_array = array(); 
                //$sub_array[] = $row->id;   
                $sub_array[] =  $no++;
                $sub_array[] = $row->impact_scale; 
                $sub_array[] = $row->impact_scale_score; 
                $sub_array[] = $row->color_code; 
                $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-default btn-xs viewcatalogsimpactscale"><i class="fa fa-list"></i>&nbsp;View</button>&nbsp;<button type="button" name="update" id="'.$row->id.'" class="btn btn-default btn-xs updatecatalogsimpactscale"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="button" name="delete" id="'.$row->id.'" class="btn btn-default btn-xs softdeletecatalogsimpactscale"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                $data[] = $sub_array; 
           }  
           
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->catalogsimpactscale_model->get_all_data(),  
               "recordsFiltered"     =>     $this->catalogsimpactscale_model->get_filtered_data(),  
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
                   'impact_scale'         =>     $this->input->post('impact_scale'),  
                   'impact_scale_score'         =>     $this->input->post("impact_scale_score"),
                   'color_code'         =>     $this->input->post("color_code"),
                   'active'  =>     1,
                   'date_created'=> $today
              );  
              $this->load->model('catalogsimpactscale_model');  
              $this->catalogsimpactscale_model->insert($insert_data);  
              echo 'New impact rating scale has been added successfully';  
          }  
 
           // Edit Action
           if($_POST["action"] == "Edit")  
           {                   
              $updated_data = array(  
                   'impact_scale'         =>     $this->input->post('impact_scale'),  
                   'impact_scale_score'         =>     $this->input->post("impact_scale_score"),
                   'color_code'         =>     $this->input->post("color_code"),
                   'active'  =>     1,
                   'date_updated'=> $today
                   //'date_updated' => @mdate($format) //uses date helper
              );  
              $this->load->model('catalogsimpactscale_model');  
              $this->catalogsimpactscale_model->update($this->input->post("catalogsimpactscale_id"), $updated_data);  
              echo 'Existing impact rating scale has been updated successfully';  
           }  

           // Soft Delete Action
           if($_POST["action"] == "SoftDelete")  
           { 
              $updated_data = array(  
                   'active' => 0
              );  
              $this->load->model('catalogsimpactscale_model');  
              $this->catalogsimpactscale_model->update($this->input->post("catalogsimpactscale_id"), $updated_data);  
              echo 'Selected impact rating scale has been deleted successfully';  
           }  
      }  

      
      function fetch_one()  
      {  
           $output = array();  
           $this->load->model("catalogsimpactscale_model");  
           $data = $this->catalogsimpactscale_model->fetch_one($_POST["catalogsimpactscale_id"]);  
           foreach($data as $row)  
           {  
                $output['id'] = $row->id; 
                $output['impact_scale'] = $row->impact_scale;  
                $output['impact_scale_score'] = $row->impact_scale_score;    
                $output['color_code'] = $row->color_code;    
           }  
           echo json_encode($output);  
      }  


      // function delete_one()  
      // {  
      //      $this->load->model("catalogsimpactscale_model");  
      //      $this->catalogsimpactscale_model->delete_one($_POST["catalogsobjectives_id"]);  
      //      echo "Selected Objective has been Deleted Successfully";  
      // }


 }  