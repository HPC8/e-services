<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('form_validation', 'session', 'my_library'));
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model(array('user_model', 'employee_model', 'meeting_model', 'posts_model'));
    }

    public function index() {
        $data=array();
        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='Error 404';
            $breadcrumb=array("Dashboard"=> "/e-services/",
            "Error 404"=> "",
            );
            $data['breadcrumb']=$breadcrumb;
            //load the view
                $this->template->load('layout/template', 'notfound', $data);
        }

        else {
            redirect('users/login');
        }
    }

}