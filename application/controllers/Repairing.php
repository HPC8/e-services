<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Repairing extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'thaidate','ciqrcode', ));
        // Load helper
        $this->load->helper(array('url', 'html', 'form'));
        // Load model
        $this->load->model(array('user_model', 'employee_model','repairing_model'));
    }

    function index() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ระบบแจ้งซ่อม';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบแจ้งซ่อม"=> "/e-services/repairing/",
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['getType']=$this->repairing_model->getType();
            
            $this->template->load('layout/template', 'repairing/create', $data);
           

        }

        else {
            redirect('users/login');
        }
    }

    
}

// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;
