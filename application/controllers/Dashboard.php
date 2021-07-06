<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  

class Dashboard extends CI_Controller {  

      // INITILIAZATIONS
      function __construct(){
        parent::__construct();
        $this->load->model('Directorate_Model','directorate_model');
        $this->load->model('KeyRiskIndicators_Model','keyriskindicators_model');
        $this->load->model('Objectives_Model');
        $this->load->model('Risk_Model','risk_model');
        $this->load->model('CatalogsObjectives_Model','catalogsobjectives_model');
        $this->load->model('Registry_Model','registry_model');
        $this->load->model('Incident_Model','incident_model');        
      }

      // admin dashboard landing page
      function admin(){ 
          $this->load->view('include/header'); 
          $data['riskcategorys'] = $this->risk_model->get_risk_category()->result(); //risk category

          $data['alldirectorates'] = $this->directorate_model->get_directorate()->result();   
          $data['organizationobjectives'] = $this->catalogsobjectives_model->get_strategic_objectives()->result();
          // $data['riskowners'] = $this->risk_model->get_risk_owners()->result();

          //Get Category Code
          // $get_data = $this->registry_model->getRiskCategoryCode()->result();  
          // foreach($get_data as $value)  
          // {  
          //    $strategicRiskCode = $value->objective_category_id;
          //    $operationalRiskCode = 
          //    $projectRiskCode = 
          // } 

          //Get count --display circles
          $strategicRiskCode =1; $operationalRiskCode = 2; $projectRiskCode = 3;
          $data['strategicRiskCount'] = $this->registry_model->getRiskCategoryCount($strategicRiskCode);  
          $data['operationalRiskCount'] = $this->registry_model->getRiskCategoryCount($operationalRiskCode);
          $data['projectRiskCount'] = $this->registry_model->getRiskCategoryCount($projectRiskCode);
          //Get value
          $data['strategicRiskCountGreen'] = $this->registry_model->getGreenValueCount($strategicRiskCode);
          $data['strategicRiskCountAmber'] = $this->registry_model->getAmberValueCount($strategicRiskCode);
          $data['strategicRiskCountRed'] = $this->registry_model->getRedValueCount($strategicRiskCode);
          $data['operationalRiskCountGreen'] = $this->registry_model->getGreenValueCount($operationalRiskCode);
          $data['operationalRiskCountAmber'] = $this->registry_model->getAmberValueCount($operationalRiskCode);
          $data['operationalRiskCountRed'] = $this->registry_model->getRedValueCount($operationalRiskCode);
          $data['projectRiskCountGreen'] = $this->registry_model->getGreenValueCount($projectRiskCode);
          $data['projectRiskCountAmber'] = $this->registry_model->getAmberValueCount($projectRiskCode);
          $data['projectRiskCountRed'] = $this->registry_model->getRedValueCount($projectRiskCode);

          //display boxes
          $statusid=1; //submitted/unreviewed status
          $data['unassessedrisks'] =  $this->risk_model->risksstatuscount($statusid);
          $statusid=3; //approved status
          $data['acceptedrisks'] = $this->risk_model->risksstatuscount($statusid);
          $data['submittedrisks'] =  $data['unassessedrisks'] + $data['acceptedrisks'];
          //$statusid=5; //rejected status
          //$data['rejectedrisks'] = $this->risk_model->risksstatuscount($statusid);
          //$data['incidentrisks'] = $this->incident_model->incidentriskscount();
          //$data['kris'] = $this->keyriskindicators_model->kriscount();
          // $data['assessedkris'] = $this->keyriskindicators_model->assessedkriscount();
          $this->load->view('dashboard/admin_index', $data);
          $this->load->view('include/footer');  //footnote    
          $this->load->view('include/jsfiles'); //all included JS Files
          $this->load->view('dashboard/admin_index_custom'); //custom JS manipulations for this page
      }  



}
