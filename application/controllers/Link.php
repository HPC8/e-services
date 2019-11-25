<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {
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
            $data['page_title']='ลิงค์ภายใน';
            $breadcrumb=array("Home"=> "/e-services/",
            "ลิงค์ภายใน"=> "",
            );
            $data['breadcrumb']=$breadcrumb;
            //load the view
                $this->template->load('layout/template', 'link/index', $data);
        }

        else {
            redirect('users/login');
        }
    }
    public function external() {
        $data=array();
        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ลิงค์ภายนอก';
            $breadcrumb=array("Home"=> "/e-services/",
            "ลิงค์ภายนอก"=> "",
            );
            $data['breadcrumb']=$breadcrumb;
            //load the view
                $this->template->load('layout/template', 'link/external', $data);
        }

        else {
            redirect('users/login');
        }
    }

}