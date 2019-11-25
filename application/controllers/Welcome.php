<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('form_validation', 'session', 'my_library', 'my_date'));
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model(array('user_model', 'employee_model', 'meeting_model', 'posts_model','project_model'));

    }

    public function index() {
        $data=array();
        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='Welcome';
            $breadcrumb=array("Dashboard"=> "/e-services/"
            );
            $data['breadcrumb']=$breadcrumb;
            $data['postId']=$this->posts_model->maxId();
            $this->posts_model->setPostId($data['postId']->id);
            $data['infoPost']=$this->posts_model->getPost();
            $year=$this->my_date->fiscal_year(date("Y-m-d H:i:s"));
            $data['activityInfo']=$this->project_model->getActivityList($year);
            $data['productInfo']=$this->project_model->getProductList($year);
            //load the view
            $this->template->load('layout/template', 'welcome', $data);
        }
        else {
            redirect('users/login');
        }
    }

}