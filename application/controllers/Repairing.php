<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Repairing extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'thaidate', 'ciqrcode', ));
        // Load helper
        $this->load->helper(array('url', 'html', 'form'));
        // Load model
        $this->load->model(array('user_model', 'employee_model', 'repairing_model'));
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

    // Repairing save method
    public function saveRepairing() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $type=$this->input->post('repairing_type');
            $serial=$this->input->post('repairing_serial');
            $detail=$this->input->post('repairing_detail');

            $year=$this->thaidate->thaiyear(date("Y-m-d"));
            $count=$this->repairing_model->count_all_year($year);
            $doc=$year."/".($count+1);
            $this->repairing_model->setRepairDoc($doc);
            $this->repairing_model->setHospcode($data['user']['hospcode']);

            if($type<=2) {}

            if(empty(trim($type))) {
                $json['error']['type']='กรุณาเลือกประเภทของปัญหา';
            }

            if($type==1 or $type==2) {
                $json['error']['serial']='กรุณากรอกเลขครุภัณฑ์';
            }

            if($type==4) {
                $json['error']['serial']='กรุณากรอกเลขทะเบียน';
            }

            // if(empty(trim($serial))) {
            //     $json['error']['serial']='กรุณากรอกเลขครุภัณฑ์';
            // }

            if(empty(trim($detail))) {
                $json['error']['detail']='กรุณากรอกรายละเอียดการส่งซ่อม';
            }

            if(empty($json['error'])) {
                $this->repairing_model->setRepairType($type);
                $this->repairing_model->setRepairSerial($serial);
                $this->repairing_model->setRepairDetail($detail);

                try {
                    $last_id=$this->repairing_model->createRepair();
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

    public function view() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='รายการแจ้งซ่อม';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบแจ้งซ่อม"=> "/e-services/repairing/",
                "รายการแจ้งซ่อม"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['thaidate']=$this->thaidate;
            $data['query']=$this->repairing_model->getOrders();

            $this->template->load('layout/template', 'repairing/view', $data);
        }

        else {
            redirect('users/login');
        }
    }

    // view Repairing
    public function viewRepair() {
        $data=array();
        $id=$this->input->post('id');
        $data['thaidate']=$this->thaidate;
        $data['dataInfo']=$this->repairing_model->dataInfo($id);
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('repairing/popup/renderView', $data);

    }

    public function editRepairing() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['userLevel']=$this->user_model->userRepair($data['user']['hospcode']);
            $id=$this->input->post('id');
            $data['thaidate']=$this->thaidate;
            $data['dataInfo']=$this->repairing_model->dataInfo($id);

            if ( !empty($data['userLevel'])) {
                if($data['dataInfo'][0]->status=="1") {
                    if($data['userLevel'][0]->level==2) {
                        $this->output->set_header('Content-Type: application/json');
                        //$this->load->view('products/popup/renderApprovers', $data);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                    }
                }

                elseif($data['dataInfo'][0]->status=="2") {
                    if($data['userLevel'][0]->level==1) {
                        $this->output->set_header('Content-Type: application/json');
                        //$this->load->view('products/popup/renderSending', $data);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                    }
                }

                elseif($data['dataInfo'][0]->status=="4") {
                    if($data['userLevel'][0]->level==1) {
                        $this->output->set_header('Content-Type: application/json');
                        //$this->load->view('products/popup/renderReceiving', $data);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                    }
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'ใบงานนี้อยู่ระหว่างดำเนินการ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                }

            }

            elseif($data['dataInfo'][0]->status=="3") {
                if($data['dataInfo'][0]->hospcode==$data['user']['hospcode']) {
                    $this->output->set_header('Content-Type: application/json');
                    //$this->load->view('products/popup/renderReturning', $data);
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
            }
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