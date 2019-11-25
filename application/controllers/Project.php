<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'my_date'));
        // Load helper
        $this->load->helper(array('url', 'html', 'form'));
        // Load model
        $this->load->model(array('user_model', 'employee_model', 'project_model'));
    }

    public function plan() {
        $data=array();
        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='แผนงาน';
            $breadcrumb=array("Home"=> "/e-services/",
                "แผนงานโครงการ"=> "/e-services/project/",
                "แผนงาน"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $year=$this->my_date->fiscal_year(date("Y-m-d H:i:s"));
            $data['planInfo']=$this->project_model->getPlanList($year);
            $data['admin_level']=$this->user_model->userPlan($data['user']['hospcode']);
            $this->template->load('layout/template', 'project/plan/index', $data);
        }

        else {
            redirect('users/login');
        }
    }

    // Plan save method
    public function savePlan() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $plan_name=$this->input->post('plan_name');
            $plan_year=$this->input->post('plan_year');
            $this->project_model->setHospcode($data['user']['hospcode']);

            if(empty(trim($plan_name))) {
                $json['error']['name']='กรุณากรอกชื่อแผนงาน';
            }

            if(empty(trim($plan_year))) {
                $json['error']['year']='กรุณาเลือกปีงบประมาณ';
            }

            if(empty($json['error'])) {
                $this->project_model->setPlanName($plan_name);
                $this->project_model->setPlanYear($plan_year);

                try {
                    $last_id=$this->project_model->createPlan();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }

            echo json_encode($json);

        }

        else {
            redirect('users/login');
        }
    }

    // Plan view
    public function viewPlan() {
        $data=array();
        $id=$this->input->post('plan_id');
        $this->project_model->setPlanId($id);
        $data['planInfo']=$this->project_model->getPlan();
        $data['moneyInfo']=$this->project_model->moneyPlan($id);
        $data['chargeInfo']=$this->project_model->chargePlan($id);
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('project/plan/popup/renderView', $data);
    }

    // Plan edit
    public function editPlan() {
        $json=array();
        $planId=$this->input->post('plan_id');
        $this->project_model->setPlanId($planId);
        $json['planInfo']=$this->project_model->getPlan();
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('project/plan/popup/renderEdit', $json);
    }

    // Plan update method
    public function updatePlan() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $plan_id=$this->input->post('plan_id');
            $plan_name=$this->input->post('plan_name');
            $plan_year=$this->input->post('plan_year');
            $this->project_model->setHospcode($data['user']['hospcode']);

            if(empty(trim($plan_name))) {
                $json['error']['name']='กรุณากรอกชื่อแผนงาน';
            }

            if(empty(trim($plan_year))) {
                $json['error']['year']='กรุณาเลือกปีงบประมาณ';
            }

            if(empty($json['error'])) {
                $this->project_model->setPlanId($plan_id);
                $this->project_model->setPlanName($plan_name);
                $this->project_model->setPlanYear($plan_year);

                try {
                    $last_id=$this->project_model->updatePlan();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }

            echo json_encode($json);
        }

        else {
            redirect('users/login');
        }
    }

    // Plan Delete method
    public function deletePlan() {
        $data=array();
        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $id=$this->input->post('id');
            $this->project_model->setHospcode($data['user']['hospcode']);
            $this->project_model->setPlanId($id);
            $this->project_model->deletePlan();
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($data);
        }
        else {
            redirect('users/login');
        }
    }

    // // Plan Delete method
    // public function deletePlan() {
    //     $json=array();
    //     $id=$this->input->post('id');
    //     $this->project_model->setPlanId($id);
    //     $this->project_model->deletePlan();
    //     $this->output->set_header('Content-Type: application/json');
    //     echo json_encode($json);
    // }

    // product method
    public function product() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ผลผลิต';
            $breadcrumb=array("Home"=> "/e-services/",
                "แผนงานโครงการ"=> "/e-services/project/",
                "ผลผลิต"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $year=$this->my_date->fiscal_year(date("Y-m-d H:i:s"));
            $data['planInfo']=$this->project_model->getPlanList($year);
            $data['productInfo']=$this->project_model->getProductList($year);
            $data['activityInfo']=$this->project_model->getActivityList($year);
            $data['admin_level']=$this->user_model->userPlan($data['user']['hospcode']);
            $this->template->load('layout/template', 'project/product/index', $data);
        }

        else {
            redirect('users/login');
        }
    }

    // Product save method
    public function saveProduct() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $plan_id=$this->input->post('product_plan_id');
            $product_name=$this->input->post('product_name');
            $product_year=$this->input->post('product_year');
            $this->project_model->setHospcode($data['user']['hospcode']);

            if(empty(trim($plan_id))) {
                $json['error']['plan-id']='กรุณาเลือกแผนงาน';
            }

            if(empty(trim($product_name))) {
                $json['error']['name']='กรุณากรอกชื่อผลผลิต';
            }

            if(empty(trim($product_year))) {
                $json['error']['year']='กรุณาเลือกปีงบประมาณ';
            }

            if(empty($json['error'])) {
                $this->project_model->setPlanId($plan_id);
                $this->project_model->setProductName($product_name);
                $this->project_model->setProductYear($product_year);

                try {
                    $last_id=$this->project_model->createProduct();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }

            echo json_encode($json);

        }

        else {
            redirect('users/login');
        }
    }

    // Product view
    public function viewProduct() {
        $data=array();
        $id=$this->input->post('product_id');
        $this->project_model->setProductId($id);
        $data['productInfo']=$this->project_model->getProduct();
        $data['moneyInfo']=$this->project_model->moneyProduct($id);
        $data['chargeInfo']=$this->project_model->chargeProduct($id);
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('project/product/popup/renderView', $data);
    }

    // Product edit
    public function editProduct() {
        $data=array();
        $id=$this->input->post('product_id');
        $this->project_model->setProductId($id);
        $data['productInfo']=$this->project_model->getProduct();
        $year=$this->my_date->fiscal_year(date("Y-m-d H:i:s"));
        $data['planInfo']=$this->project_model->getPlanList($year);
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('project/product/popup/renderEdit', $data);
    }

    // Product update method
    public function updateProduct() {
        $data=array();
        $json=array();
        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $product_id=$this->input->post('product_id');
            $plan_id=$this->input->post('plan_id');
            $product_name=$this->input->post('product_name');
            $product_year=$this->input->post('product_year');
            $this->project_model->setHospcode($data['user']['hospcode']);

            if(empty(trim($plan_id))) {
                $json['error']['plan-id']='กรุณาเลือกแผนงาน';
            }

            if(empty(trim($product_name))) {
                $json['error']['name']='กรุณากรอกชื่อผลผลิต';
            }

            if(empty(trim($product_year))) {
                $json['error']['year']='กรุณาเลือกปีงบประมาณ';
            }

            if(empty($json['error'])) {
                $this->project_model->setProductId($product_id);
                $this->project_model->setPlanId($plan_id);
                $this->project_model->setProductName($product_name);
                $this->project_model->setProductYear($product_year);

                try {
                    $last_id=$this->project_model->updateProduct();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }

            echo json_encode($json);

        }

        else {
            redirect('users/login');
        }
    }

    // Product Delete method
    public function deleteProduct() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $id=$this->input->post('id');
            $this->project_model->setHospcode($data['user']['hospcode']);
            $this->project_model->setProductId($id);
            $this->project_model->deleteProduct();
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($data);
        }

        else {
            redirect('users/login');
        }
    }

    // activity method
    public function activity() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='กิจกรรม';
            $breadcrumb=array("Home"=> "/e-services/",
                "แผนงานโครงการ"=> "/e-services/project/",
                "กิจกรรม"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $year=$this->my_date->fiscal_year(date("Y-m-d H:i:s"));
            $data['activityInfo']=$this->project_model->getActivityList($year);
            $data['planInfo']=$this->project_model->getPlanList($year);
            $data['productInfo']=$this->project_model->getProductList($year);
            $data['admin_level']=$this->user_model->userPlan($data['user']['hospcode']);
            $this->template->load('layout/template', 'project/activity/index', $data);
        }

        else {
            redirect('users/login');
        }
    }

    // activity view
    public function viewActivity() {
        $data=array();
        $id=$this->input->post('id');
        $this->project_model->setActivityId($id);
        $data['activityInfo']=$this->project_model->getActivity();
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('project/activity/popup/renderView', $data);
    }

    // activity edit
    public function editActivity() {
        $data=array();
        $id=$this->input->post('id');
        $this->project_model->setActivityId($id);
        $data['activityInfo']=$this->project_model->getActivity();
        $year=$this->my_date->fiscal_year(date("Y-m-d H:i:s"));
        $data['productInfo']=$this->project_model->getProductList($year);
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('project/activity/popup/renderEdit', $data);

    }

    // Activity save method
    public function saveActivity() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $product_id=$this->input->post('product_id');
            $activity_name=$this->input->post('activity_name');
            $activity_year=$this->input->post('activity_year');
            $activity_money=$this->input->post('activity_money');
            $this->project_model->setHospcode($data['user']['hospcode']);

            if(empty(trim($product_id))) {
                $json['error']['product-id']='กรุณาเลือกผลผลิต';
            }

            if(empty(trim($activity_name))) {
                $json['error']['name']='กรุณากรอกชื่อกิจกรรม';
            }

            if(empty(trim($activity_year))) {
                $json['error']['year']='กรุณาเลือกปีงบประมาณ';
            }
            if(empty(trim($activity_money))) {
                $json['error']['money']='กรุณากรอกงบประมาณ';
            }

            if(empty($json['error'])) {
                $this->project_model->setProductId($product_id);
                $this->project_model->setActivityName($activity_name);
                $this->project_model->setActivityYear($activity_year);
                $this->project_model->setActivityMoney($activity_money);

                try {
                    $last_id=$this->project_model->createActivity();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }

            echo json_encode($json);
        }

        else {
            redirect('users/login');
        }
    }

    // Activity update method
    public function updateActivity() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $activity_id=$this->input->post('activity_id');
            $product_id=$this->input->post('product_id');
            $activity_name=$this->input->post('activity_name');
            $activity_year=$this->input->post('activity_year');
            $activity_money=$this->input->post('activity_money');
            $this->project_model->setHospcode($data['user']['hospcode']);

            if(empty(trim($product_id))) {
                $json['error']['product-id']='กรุณาเลือกผลผลิต';
            }

            if(empty(trim($activity_name))) {
                $json['error']['name']='กรุณากรอกชื่อกิจกรรม';
            }

            if(empty(trim($activity_year))) {
                $json['error']['year']='กรุณาเลือกปีงบประมาณ';
            }
            if(empty(trim($activity_money))) {
                $json['error']['money']='กรุณากรอกงบประมาณ';
            }

            if(empty($json['error'])) {
                $this->project_model->setActivityId($activity_id);
                $this->project_model->setProductId($product_id);
                $this->project_model->setActivityName($activity_name);
                $this->project_model->setActivityYear($activity_year);
                $this->project_model->setActivityMoney($activity_money);

                try {
                    $last_id=$this->project_model->updateActivity();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }

            echo json_encode($json);
        }

        else {
            redirect('users/login');
        }
    }

    // Activity Delete method
    public function deleteActivity() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $id=$this->input->post('id');
            $this->project_model->setHospcode($data['user']['hospcode']);
            $this->project_model->setActivityId($id);
            $this->project_model->deleteActivity();
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($data);
        }

        else {
            redirect('users/login');
        }
    }

    // Program method
    public function program() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='โครงการ';
            $breadcrumb=array("Home"=> "/e-services/",
                "แผนงานโครงการ"=> "/e-services/project/",
                "โครงการ"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $year=$this->my_date->fiscal_year(date("Y-m-d H:i:s"));
            $data['programInfo']=$this->project_model->getProgramList($year);

            // $data['activityInfo']=$this->project_model->getActivityList($year);
            // $data['planInfo']=$this->project_model->getPlanList($year);
            // $data['productInfo']=$this->project_model->getProductList($year);
            $data['admin_level']=$this->user_model->userPlan($data['user']['hospcode']);
            $this->template->load('layout/template', 'project/program/index', $data);
        }

        else {
            redirect('users/login');
        }
    }

    // Program save method
    public function saveProgram() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $name=$this->input->post('program_name');
            $year=$this->input->post('program_year');
            $this->project_model->setHospcode($data['user']['hospcode']);

            if(empty(trim($name))) {
                $json['error']['name']='กรุณากรอกชื่อโครงการ';
            }

            if(empty(trim($year))) {
                $json['error']['year']='กรุณาเลือกปีงบประมาณ';
            }

            if(empty($json['error'])) {
                $this->project_model->setProgramName($name);
                $this->project_model->setProgramYear($year);

                try {
                    $last_id=$this->project_model->createProgram();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }

            echo json_encode($json);

        }

        else {
            redirect('users/login');
        }
    }

    // Program view
    public function viewProgram() {
        $data=array();
        $id=$this->input->post('id');
        $this->project_model->setProgramId($id);
        $data['programInfo']=$this->project_model->getProgram();
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('project/program/popup/renderView', $data);
    }

    // Program edit
    public function editProgram() {
        $data=array();
        $id=$this->input->post('id');
        $this->project_model->setProgramId($id);
        $data['programInfo']=$this->project_model->getProgram();
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('project/program/popup/renderEdit', $data);
    }

    // Program update method
    public function updateProgram() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $id=$this->input->post('program_id');
            $name=$this->input->post('program_name');
            $year=$this->input->post('program_year');
            $this->project_model->setHospcode($data['user']['hospcode']);

            if(empty(trim($name))) {
                $json['error']['name']='กรุณากรอกชื่อโครงการ';
            }

            if(empty(trim($year))) {
                $json['error']['year']='กรุณาเลือกปีงบประมาณ';
            }

            if(empty($json['error'])) {
                $this->project_model->setProgramId($id);
                $this->project_model->setProgramName($name);
                $this->project_model->setProgramYear($year);

                try {
                    $last_id=$this->project_model->updateProgram();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }

            echo json_encode($json);

        }

        else {
            redirect('users/login');
        }
    }

    // Product Delete method
    public function deleteProgram() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $id=$this->input->post('id');
            $this->project_model->setHospcode($data['user']['hospcode']);
            $this->project_model->setProgramId($id);
            $this->project_model->deleteProgram();
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($data);
        }

        else {
            redirect('users/login');
        }
    }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    // exit;

}