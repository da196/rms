<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  

 class RiskMaturityModel extends CI_Controller {  

      function __construct(){
        parent::__construct();
        $this->load->model('Directorate_Model','directorate_model'); //for reporting unit
        $this->load->model('Risk_Model','risk_model'); //for risk levels
        $this->load->model('RiskMaturityModel_Model','riskmaturitymodel_model'); //for rmm_processes
      }

     // Default landing page
      function index(){  
          $this->load->view('include/header'); 
          $data['alldirectorates'] = $this->directorate_model->get_directorate()->result();   
          $data['risklevels'] = $this->risk_model->get_risk_levels()->result();   
          $data['rmm_processes'] = $this->riskmaturitymodel_model->get_rmm_processes()->result();
          $data['title'] = "Risk Maturity Model"; 
          $this->load->view('riskmaturitymodel_view', $data);   
          $this->load->view('include/footer'); //footnote
          $this->load->view('include/jsfiles'); //all included JS Files
          $this->load->view('rmm/indexcustom'); //custom JS manipulations for this page
      }  

      //Pull data(and creates a table like view) whereby active=1
      function fetch(){  
           $this->load->model("riskmaturitymodel_model");  
           $fetch_data = $this->riskmaturitymodel_model->make_datatables(); 
           $data = array();  

           $no = 1; 
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                // $sub_array[] = $row->id;   
                $sub_array[] =  $no++;

                //convert Directorate ID to its equivalent name
                $get_data = $this->directorate_model->get_directorate_name($row->reporting_unit)->result();  
                // $sub_array[] = json_encode($get_data);  
                //$sub_array[] = json_encode($row);  
                foreach($get_data as $value)  
                {  
                   $sub_array[] = $value->directorate_name;  
                }   
                //$sub_array[] = $row->reporting_unit;  


                //convert RMM PROCESS ID to its equivalent name
                $get_data = $this->riskmaturitymodel_model->get_rmm_process_name($row->process_id)->result();  
                foreach($get_data as $value)  
                {  
                   $sub_array[] = $value->name;  
                }
                //$sub_array[] = $row->process_id;  

                //convert RISK LEVELS ID to its equivalent name
                $get_data = $this->risk_model->get_risk_level_name($row->risk_level_id)->result();  
                foreach($get_data as $value)  
                {  
                    $sub_array[] = $value->name;  
                } 
                //$sub_array[] = $row->risk_level_id;  
                //$sub_array[] = $row->risk_level_description;  

                $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-default btn-xs viewriskmaturitymodel"><i class="fa fa-list"></i>&nbsp;View</button>&nbsp;<button type="button" name="update" id="'.$row->id.'" class="btn btn-info btn-xs updateriskmaturitymodel"><i class="fa fa-paste"></i>&nbsp;Edit</button>&nbsp;<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs softdeleteriskmaturitymodel"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                // $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-info btn-xs updatekeyriskindicators"><i class="fa fa-paste"></i>&nbsp;Edit</button>';
                // $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs deletekeyriskindicators"><i class="fa fa-trash"></i>&nbsp;Delete</button>';  
                $data[] = $sub_array; 
           }  
           
           
           $output = array(  
               "draw"                =>     intval($_POST["draw"]),  
               "recordsTotal"        =>     $this->riskmaturitymodel_model->get_all_data(),  
               "recordsFiltered"     =>     $this->riskmaturitymodel_model->get_filtered_data(),  
               "data"                =>     $data  
           );  
           echo json_encode($output);  //change Associative array to JSON
      }  

      function action(){     
         // date_default_timezone_set('Africa/Dar_es_Salaam');
         // $format = "%Y-%m-%d %H:%i %s";
        $date = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $today = $date->format('d-m-Y H:i:s');
    
          // Add Action
          if($_POST["action"] == "Add")  
           {  
              $insert_data = array(  
                   'reporting_unit'         =>     $this->input->post('reporting_unit'),  
                   'process_id'         =>     $this->input->post("process_id"),  
                   'risk_level_id'  => $this->input->post("risk_level_id"),
                   'risk_level_description'=>$this->input->post('risk_level_description'),
                   'date_created'=> $today
              );  
              $this->load->model('riskmaturitymodel_model');  
              $this->riskmaturitymodel_model->insert($insert_data);  
              echo 'New Risk Maturity Model Record has been Added Successfully';  
           }  

           // Edit Action
           if($_POST["action"] == "Edit")  
           {    
              $updated_data = array(  
                   'reporting_unit'         =>     $this->input->post('reporting_unit'),  
                   'process_id'         =>     $this->input->post("process_id"),  
                   'risk_level_id'  =>     $this->input->post("risk_level_id"),
                   'risk_level_description'=>$this->input->post('risk_level_description'),
                   //'date_updated' => @mdate($format) //uses date helper
                   'date_updated'=> $today
              );  
              $this->load->model('riskmaturitymodel_model');  
              $this->riskmaturitymodel_model->update($this->input->post("riskmaturitymodel_id"), $updated_data);  
              echo 'Existing Risk Maturity Model Record has been Updated Successfully...';  
           }  

           // Soft Delete Action
           if($_POST["action"] == "SoftDelete")  
           { 
              $updated_data = array(  
                   'active' => 0
              );  
              $this->load->model('riskmaturitymodel_model');  
              $this->riskmaturitymodel_model->update($this->input->post("riskmaturitymodel_id"), $updated_data);  
              echo 'Selected Risk Maturity Model Record has been Deleted Successfully';  
           }  
      }  

      
      function fetch_one()  
      {  
           $output = array();  
           $this->load->model("riskmaturitymodel_model");  
           $data = $this->riskmaturitymodel_model->fetch_one($_POST["riskmaturitymodel_id"]);  
           foreach($data as $row)  
           {  
                $output['id'] = $row->id; 

                //convert Directorate ID to its equivalent name
                $get_data = $this->directorate_model->get_directorate_name($row->reporting_unit)->result();  
                foreach($get_data as $value)  
                {  
                   $output['reporting_unitNAME'] = $value->directorate_name;  
                } 
                $output['reporting_unit'] = $row->reporting_unit;  


                //convert RMM PROCESS ID to its equivalent name
                $get_data = $this->riskmaturitymodel_model->get_rmm_process_name($row->process_id)->result();  
                foreach($get_data as $value)  
                {  
                   $output['process_idNAME'] = $value->name;  
                }
                $output['process_id'] = $row->process_id; 


                //convert RISK LEVELS ID to its equivalent name
                $get_data = $this->risk_model->get_risk_level_name($row->risk_level_id)->result();  
                foreach($get_data as $value)  
                {  
                   $output['risk_level_idNAME'] = $value->name;  
                }
                $output['risk_level_id'] = $row->risk_level_id; 


                $output['risk_level_description'] = $row->risk_level_description;   
           }  
           echo json_encode($output);  
      }  


      //Actual deletion 
      // function delete_one()  
      // {  
      //    $this->load->model("riskmaturitymodel_model");  
      //    $this->riskmaturitymodel_model->delete_one($_POST["riskmaturitymodel_id"]);  
      //    echo "Selected Risk Maturity Model Record has been Deleted Successfully";  
      // }

 }  