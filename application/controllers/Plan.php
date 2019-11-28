<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'thaidate'));
        // Load helper
        $this->load->helper(array('url', 'html', 'form'));
        // Load model
        $this->load->model(array('user_model', 'employee_model', 'plan_model'));
    }

    public function trainList() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ขออนุมัติไปราชการ';
            $breadcrumb=array("Home"=> "/e-services/",
                "ไปราชการ-จัดประชุม"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['thaidate']=$this->thaidate;
            $data['getTrain']=$this->plan_model->getTrain();
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            // exit; 
            $this->template->load('layout/template', 'plan/train/index', $data);
        }

        else {
            redirect('users/login');
        }
    }

    public function trainCreate() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ขออนุมัติไปราชการ';
            $breadcrumb=array("Home"=> "/e-services/",
                "ไปราชการ-จัดประชุม"=> "/e-services/plan/",
                "ขออนุมัติไปราชการ"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['amount']=$this->employee_model->list_employee();
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            // exit;
            $this->template->load('layout/template', 'plan/train/create', $data);
        }

        else {
            redirect('users/login');
        }
    }

    public function trainEdit($id=null) {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['admin_level']=$this->user_model->adminPlanTrain($data['user']['hospcode']);
            $data['page_title']='ขออนุมัติไปราชการ';
            $breadcrumb=array("Home"=> "/e-services/",
                "ไปราชการ-จัดประชุม"=> "/e-services/plan/",
                "ขออนุมัติไปราชการ"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['amount']=$this->employee_model->list_employee();
            $this->plan_model->setTrainId($id);
            $data['trainInfo']=$this->plan_model->tblTrain();
            $data['userReport']=$this->plan_model->trainReport();
            $data['userInfo']=$this->plan_model->tblTrainUser();
            $data['expensesInfo']=$this->plan_model->tblTrainExpenses();
            $data['statusInfo']=$this->plan_model->tblTrainMission();

            if ( !empty($data['trainInfo'])) {
                if($data['trainInfo']->status=="1") {
                    if($data['trainInfo']->hospcode==$data['user']['hospcode']) {
                        $this->template->load('layout/template', 'plan/train/edit', $data);
                    }
                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                        redirect('plan/trainList/');
                    }
                }
                elseif($data['trainInfo']->status=="2"){
                    if($data['admin_level']){

                    }
                }
                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'ใบงานนี้อยู่ระหว่างดำเนินการ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                    redirect('plan/trainList/');
                }
            }

            else {
                
                redirect('plan/trainList/');
            }


        }

        else {
            redirect('users/login');
        }
    }

    public function checkPlan($id=null) {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ขออนุมัติไปราชการ';
            $breadcrumb=array("Home"=> "/e-services/",
                "ไปราชการ-จัดประชุม"=> "/e-services/plan/",
                "ขออนุมัติไปราชการ"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['amount']=$this->employee_model->list_employee();
            $this->plan_model->setTrainId($id);
            $data['trainInfo']=$this->plan_model->tblTrain();
            $data['userReport']=$this->plan_model->trainReport();
            $data['userInfo']=$this->plan_model->tblTrainUser();
            $data['expensesInfo']=$this->plan_model->tblTrainExpenses();
            $data['statusInfo']=$this->plan_model->tblTrainMission();

            if ( !empty($data['trainInfo'])) {
                $this->template->load('layout/template', 'plan/train/checkPlan', $data);
            }

            else {
                redirect('plan/trainList/');
            }

        }

        else {
            redirect('users/login');
        }
    }


    public function deleteTrinUser() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $id=$this->input->post('id');
            $this->plan_model->setTrainUserId($id);
            $this->plan_model->deleteTrinUser();
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($data);
        }

        else {
            redirect('users/login');
        }
    }

    public function addTrinUser() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $train_id=$this->input->post('train_id');
            $user=$this->input->post('userList');
            $userStatus=$this->input->post('userStatus');
            $userDoc=$this->input->post('userDoc');

            $this->plan_model->setTrainId($train_id);
            $this->plan_model->setHospcode($user);
            $checkUser=$this->plan_model->checkTrainUser();

            if( !empty($checkUser)) {
                $json['error']['userList']='มีรายชื่อผู้ไปราชการแล้ว ไม่สามารถใส่ซ้ำได้!';
            }

            if(empty(trim($user))) {
                $json['error']['userList']='กรุณาเลือกรายชื่อผู้ไปราชการ';
            }

            if(empty($json['error'])) {
                // $this->plan_model->setTrainId($train_id);
                // $this->plan_model->setHospcode($user);
                $this->plan_model->setUserStatus($userStatus);
                $this->plan_model->setUserDoc($userDoc);

                try {
                    $last_id=$this->plan_model->addTrinUser();
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



    public function saveTrain() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $letter=$this->input->post('train_letter');
            $date_create=$this->input->post('train_date_create');
            $report=$this->input->post('report_hospcodet');
            $subject=$this->input->post('train_subject');
            $location=$this->input->post('train_location');
            $form=$this->input->post('train_form');
            $date_start=$this->input->post('train_start');
            $date_end=$this->input->post('train_end');
            $travel_start=$this->input->post('train_travel_start');
            $travel_end=$this->input->post('train_travel_end');

            if(empty(trim($letter))) {
                $json['error']['letter']='กรุณากรอกข้อมูล';
            }

            if(empty(trim($date_create))) {
                $json['error']['create-date']='กรุณาเลือกวันที่ขออนุมัติ';
            }

            if(empty(trim($subject))) {
                $json['error']['subject']='กรุณากรอกข้อมูล';
            }

            if(empty(trim($form))) {
                $json['error']['form']='กรุณากรอกข้อมูล';
            }

            if(empty(trim($location))) {
                $json['error']['location']='กรุณากรอกข้อมูล';
            }

            if(empty(trim($date_start))) {
                $json['error']['start']='กรุณาเลือกวันที่เริ่ม';
            }

            if(empty(trim($date_end))) {
                $json['error']['end']='กรุณาเลือกวันที่สิ้นสุด';
            }

            if(empty(trim($travel_start))) {
                $json['error']['travel-start']='กรุณาเลือกวันที่เริ่ม';
            }

            if(empty(trim($travel_end))) {
                $json['error']['travel-end']='กรุณาเลือกวันที่สิ้นสุด';
            }

            if(empty($json['error'])) {
                $year=$this->thaidate->thaiyear(date("Y-m-d"));
                $count=$this->plan_model->countYear($year);
                $this->plan_model->setTrainDoc($year."/".($count+1));
                $this->plan_model->setHospcode($data['user']['hospcode']);
                $this->plan_model->setLetter($letter);
                $this->plan_model->setDateCreate($date_create);
                $this->plan_model->setReport($report);
                $this->plan_model->setSubject($subject);
                $this->plan_model->setLocation($location);
                $this->plan_model->setForm($form);
                $this->plan_model->setDateStart($date_start);
                $this->plan_model->setDateEnd($date_end);
                $this->plan_model->setTravelStart($travel_start);
                $this->plan_model->setTravelEnd($travel_end);

                try {
                    $lastID=$this->plan_model->createTrain();
                    $json['lastID']=$lastID;
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }

                if ( !empty($lastID)) {
                    $userList=$this->input->post('userList');
                    $userStatus=$this->input->post('userStatus');
                    $userDoc=$this->input->post('userDoc');
                    $count=count($userList);

                    for($i=0; $i<$count; $i++) {
                        $data=array('train_id'=> $lastID,
                            'hospcode'=> $userList[$i],
                            'status'=> $userStatus[$i],
                            'doc'=> $userDoc[$i]);
                        $this->plan_model->insertTrainUser($data);
                    }

                    $data=array('train_id'=> $lastID,
                        'allowance'=> $this->input->post('train_allowance'),
                        'hostel'=> $this->input->post('train_hostel'),
                        'traveling'=> $this->input->post('train_traveling'),
                        'oil'=> $this->input->post('train_oilPrice'),
                        'other'=> $this->input->post('train_otherValues'),
                        'modified'=> date("Y-m-d H:i:s"));
                    $this->plan_model->insertTrainExpenses($data);
                }
            }

            echo json_encode($json);

        }

        else {
            redirect('users/login');
        }
    }

    public function updateTrain() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $train_id=$this->input->post('train_id');
            $letter=$this->input->post('train_letter');
            $date_create=$this->input->post('train_date_create');
            $report=$this->input->post('report_hospcodet');
            $subject=$this->input->post('train_subject');
            $location=$this->input->post('train_location');
            $form=$this->input->post('train_form');
            $date_start=$this->input->post('train_start');
            $date_end=$this->input->post('train_end');
            $travel_start=$this->input->post('train_travel_start');
            $travel_end=$this->input->post('train_travel_end');


            if(empty(trim($letter))) {
                $json['error']['letter']='กรุณากรอกข้อมูล';
            }

            if(empty(trim($date_create))) {
                $json['error']['create-date']='กรุณาเลือกวันที่ขออนุมัติ';
            }

            if(empty(trim($subject))) {
                $json['error']['subject']='กรุณากรอกข้อมูล';
            }

            if(empty(trim($form))) {
                $json['error']['form']='กรุณากรอกข้อมูล';
            }

            if(empty(trim($location))) {
                $json['error']['location']='กรุณากรอกข้อมูล';
            }

            if(empty(trim($date_start))) {
                $json['error']['start']='กรุณาเลือกวันที่เริ่ม';
            }

            if(empty(trim($date_end))) {
                $json['error']['end']='กรุณาเลือกวันที่สิ้นสุด';
            }

            if(empty(trim($travel_start))) {
                $json['error']['travel-start']='กรุณาเลือกวันที่เริ่ม';
            }

            if(empty(trim($travel_end))) {
                $json['error']['travel-end']='กรุณาเลือกวันที่สิ้นสุด';
            }

            if(empty($json['error'])) {
                $this->plan_model->setTrainId($train_id);
                $this->plan_model->setHospcode($data['user']['hospcode']);
                $this->plan_model->setLetter($letter);
                $this->plan_model->setDateCreate($date_create);
                $this->plan_model->setReport($report);
                $this->plan_model->setSubject($subject);
                $this->plan_model->setLocation($location);
                $this->plan_model->setForm($form);
                $this->plan_model->setDateStart($date_start);
                $this->plan_model->setDateEnd($date_end);
                $this->plan_model->setTravelStart($travel_start);
                $this->plan_model->setTravelEnd($travel_end);

                try {
                    $lastID=$this->plan_model->updateTrain();
                    $expenses=array('allowance'=> $this->input->post('train_allowance'),
                        'hostel'=> $this->input->post('train_hostel'),
                        'traveling'=> $this->input->post('train_traveling'),
                        'oil'=> $this->input->post('train_oilPrice'),
                        'other'=> $this->input->post('train_otherValues'),
                        'modified'=> date("Y-m-d H:i:s"));
                    $this->plan_model->updateTrainExpenses($expenses);
                    //$json['lastID']=$lastID;
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

    public function meetingList() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ขออนุมัติจัดอบรมฯ';
            $breadcrumb=array("Home"=> "/e-services/",
                "ไปราชการ-จัดประชุม"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $this->template->load('layout/template', 'plan/meeting/index', $data);
        }

        else {
            redirect('users/login');
        }
    }
}