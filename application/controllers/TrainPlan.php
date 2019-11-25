<?php
Class TrainPlan extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('form_validation','session','myl_ibrary'));
		$this->load->helper(array('url','html','form'));
        $this->load->model(array('user_model','employee_model','meeting_model'));
    }
    
    function train_list(){
        $data['page_title'] = 'train_list';
        $data['page_name'] = 'train_list';
        $data['page_content'] = 'train_list';
        $breadcrumb  = array(
            "Home" => "/e-services/",
            "ขอนุมัติไปราชการ" => "/e-services/trainplan/",
            "train_list" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $this->template->load('layout/template','train/train_list',$data);
    }
    function train_add(){
        $data['page_title'] = 'train_add';
        $data['page_name'] = 'train_add';
        $data['page_content'] = 'train_add';
        $breadcrumb  = array(
            "Home" => "/e-services/",
            "ขอนุมัติไปราชการ" => "/e-services/trainplan/",
            "train_add" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $this->template->load('layout/template','train/train_add',$data);
    }
}