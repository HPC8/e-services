<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Finger extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'thaidate', ));
        // Load helper
        $this->load->helper(array('url', 'html', 'form'));
        // Load model
        $this->load->model(array('user_model', 'employee_model', 'finger_model'));
    }

    public function index() {
        $data=array();

        if($this->session->userdata('success_msg')) {
            $data['success_msg']=$this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }

        if($this->session->userdata('error_msg')) {
            $data['error_msg']=$this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        if($this->input->post('CheckSubmit')) {
            $this->form_validation->set_rules('lineUserId', 'text', 'required');
            $this->form_validation->set_rules('status', 'text', 'required');

            if ($this->form_validation->run()==true) {

                $userId=$this->input->post('lineUserId');
                $status=$this->input->post('status');
                $latitude=$this->input->post('Latitude');
                $longitude=$this->input->post('Longitude');

                $checkUserId=$this->finger_model->checkUserId($userId);

                if($checkUserId !=0) {
                    if($status=='1') {
                        $checkIn=$this->finger_model->checkIn($userId);

                        if($checkIn !=0) {
                            $data['error_msg']='<center><p style="color:red"><i class="fa fa-exclamation-circle" aria-hidden="true"> วันนี้คุณได้ทำการลงเวลาเข้าปฏิบัติงานแล้ว</i></p></center>';
                        }

                        else {
                           $this->finger_model->setUserId($userId);
                           $this->finger_model->setLatitude($latitude);
                           $this->finger_model->setLongitude($longitude);
                           $last_id=$this->finger_model->createCheckIn();
                           redirect('finger/checkIn/');
                        }
                    }

                    else {
                        $checkOut=$this->finger_model->checkOut($userId);               
                        if($checkOut !=0) {
                            $data['error_msg']='<center><p style="color:red"><i class="fa fa-exclamation-circle" aria-hidden="true"> วันนี้คุณได้ทำการลงเวลาออกเรียบร้อยแล้ว</i></p></center>';
                        }

                        else {
                            $checkOutId=$this->finger_model->checkOutId($userId);
                            if($checkOutId != NULL){
                                $this->finger_model->setFingerId($checkOutId[0]->id);
                                $this->finger_model->setLatitude($latitude);
                                $this->finger_model->setLongitude($longitude);
                                $this->finger_model->createCheckOut();
                                redirect('finger/checkOut/');
                            }
                            else{
                                $data['error_msg']='<center><p style="color:red"><i class="fa fa-exclamation-circle" aria-hidden="true"> วันนี้คุณยังไม่ได้ทำการลงเวลาเข้าปฏิบัติงาน</i></p></center>';
                            }
                            
                        }
                    }
                }

                else {
                    redirect('finger/register/'.$userId);
                }

            }
        }

        //load the view
        $data['page_title']='Working Time';
        $data['page_name']='Working Time';
        $data['page_content']='Working Time';
        $data['thaidate']=$this->thaidate;
        $this->load->view('finger/working', $data);
    }

    public function register($Id='') {

        $data=array();

        if($this->session->userdata('success_msg')) {
            $data['success_msg']=$this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }

        if($this->session->userdata('error_msg')) {
            $data['error_msg']=$this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        if($this->input->post('registerSubmit')) {
            $this->form_validation->set_rules('emp_cid', 'text', 'required');

            if ($this->form_validation->run()==true) {

                $cid=$this->input->post('emp_cid');
                $userId=$this->input->post('lineUserId');

                if($userId !='') {
                    $this->finger_model->setUserId($userId);
                }

                else {
                    $this->finger_model->setUserId($Id);
                }

                $checkCid=$this->finger_model->checkCid($cid);

                if($checkCid !=0) {
                    $countCid=$this->finger_model->countCid($cid);

                    if($countCid !=0) {
                        $data['error_msg']='<center><p style="color:red"><i class="fa fa-exclamation-circle" aria-hidden="true"> ขอโทษด้วยครับ เลขบัตรประชาชน '.$cid.' ลงทะเบียนแล้ว</p></i></font></center>';

                    }

                    else {
                        $this->finger_model->setCid($cid);
                        //$this->finger_model->setUserId($userId);
                        $last_id=$this->finger_model->createUserId();
                        redirect('finger/success/');
                    }
                }

                else {
                    $data['error_msg']='<center><p style="color:red"><i class="fa fa-exclamation-circle" aria-hidden="true"> ขอโทษด้วยครับ เลขบัตรประชาชน '.$cid.' ไม่พบในฐานข้อมูลกรุณาติดต่องานการเจ้าที่</i></p></center>';

                }
            }
        }

        //load the view
        $data['page_title']='Line Register';
        $data['page_name']='Line Register';
        $data['page_content']='Line Register';
        $this->load->view('finger/register', $data);
    }

    public function success() {
        $data=array();
        //load the view
        $data['page_title']='Register success';
        $data['page_name']='Register success';
        $data['page_content']='Register success';
        $this->load->view('finger/success', $data);
    }
    public function checkIn() {
        $data=array();
        //load the view
        $data['page_title']='Check In success';
        $data['page_name']='Check In success';
        $data['page_content']='Check In success';
        $this->load->view('finger/checkIn', $data);
    }
    public function checkOut() {
        $data=array();
        //load the view
        $data['page_title']='Check Out success';
        $data['page_name']='Check Out success';
        $data['page_content']='Check Out success';
        $this->load->view('finger/checkOut', $data);
    }
    public function location() {
        $data=array();
        //load the view
        $this->load->view('finger/location', $data);
    }
}


// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;