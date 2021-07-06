<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends CI_Controller {

   public function __construct(){

        parent::__construct();
        $this->load->helper('url');

        // Load model
        $this->load->model('RiskReport_Model');

      }

      public function index(){

        // $cities = $this->RiskReport_Model->getCities();
        // $data['cities'] = $cities;

        // load view
        $this->load->view('user_view');

      }

      public function userList(){

        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->RiskReport_Model->getUsers($postData);

        echo json_encode($data);
      }

}
