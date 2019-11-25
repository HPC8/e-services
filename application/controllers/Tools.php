<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library(array('form_validation','session','my_library'));
		$this->load->helper(array('url','html','form'));
        $this->load->model(array('user_model','employee_model','meeting_model'));
    }
    public function random(){
        $data = array();
        if($this->session->userdata('isUserLoggedIn')){
            $data['user'] = $this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title'] = 'Random';
            $breadcrumb  = array(
                "Home" => "/e-services/",
                "Tools" => "/e-services/tools",
                "Random" => ""
                );
            $data['breadcrumb'] = $breadcrumb;
            
        //load the view
            //$this->session->set_flashdata('globalmsg', 'ระบบทำการลบข้อมูลเรียบร้อย...');
            $this->template->load('layout/template','tools/random',$data); 

        }else{
            redirect('users/login');
        }
    }
    public function randomProgress(){
        $data = array();
        if($this->session->userdata('isUserLoggedIn')){
            $data['user'] = $this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title'] = 'randomProgress';
            $breadcrumb  = array(
                "Home" => "/e-services/",
                "Tools" => "/e-services/tools/",
                "Random" => ""
                );
            $data['breadcrumb'] = $breadcrumb;
            
            $data['random_number_array'] = range(1, 200);
            shuffle($data['random_number_array'] );
            $data['random_number_array'] = array_slice($data['random_number_array'] ,0,5);
        //load the view
       
            //$this->session->set_flashdata('globalmsg', 'ระบบทำการลบข้อมูลเรียบร้อย...');
            $this->template->load('layout/template','tools/progress',$data); 
  

        }else{
            redirect('users/login');
        }
    }

}