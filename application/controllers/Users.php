<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
        //load database libray manually
        $this->load->database();
        $this->load->library(array('form_validation', 'session', 'my_library', 'my_date', 'thaidate', 'upload'));
        $this->load->helper(array('url', 'html', 'form', 'string'));
        $this->load->model(array('user_model', 'employee_model', 'meeting_model', 'location_model', ));
    }

    public function index() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            redirect('users/profile/');
        }

        else {
            redirect('users/login');
        }
    }

    public function profile() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));

            $data['page_title']='Profile';
            $breadcrumb=array("Home"=> "/e-services/",
                "User"=> "/e-services/users",
                "Profile"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['thaidate']=$this->thaidate;
            $this->user_model->setHospcode($data['user']['hospcode']);
            $data['userInfo']=$this->user_model->getHospcode();

            $this->template->load('layout/template', 'users/profile', $data);

        }

        else {
            redirect('users/login');
        }
    }

    public function edit() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));

            $code=$this->input->post('emp_code');
            $this->user_model->setHospcode($code);
            $data['codeInfo']=$this->user_model->getHospcode();
            $data['thaidate']=$this->thaidate;
            $data['Titlename']=$this->employee_model->getTitlename();
            $data['Blood']=$this->employee_model->getBlood();
            $data['Provinces']=$this->location_model->getAllProvinces();
            $data['Education']=$this->employee_model->getEducation();
            $data['Degree']=$this->employee_model->getDegree();
            $data['Category']=$this->employee_model->getCategory();
            $data['Position']=$this->employee_model->getPosition();
            $data['Level']=$this->employee_model->getLevel();
            $data['Department']=$this->employee_model->getDepartment();
            $data['Section']=$this->employee_model->getSection();
            $data['Position_assign']=$this->employee_model->getPosition_assign();
            $this->output->set_header('Content-Type: application/json');
            $this->load->view('users/popup/renderEdit', $data);
        }

        else {
            redirect('users/login');
        }
    }

    function edit_photo($hospcode) {
        $config['upload_path']='./assets/uploads/employee/photo/'.$hospcode.'/';
        $config['allowed_types']='jpg|jpeg|png';
        $config['max_size']=1024*5;
        $config['encrypt_name']=TRUE;

        $this->upload->initialize($config);

        if ( !$this->upload->do_upload('emp_uplfile')) {}

        else {
            $data=$this->upload->data();
            $photo=array('photo'=> $data['file_name'],
                'reference'=> 'assets/uploads/employee/photo/'.$hospcode.'/',
            );
            $this->db->where('hospcode', $hospcode);
            $this->db->update('tbl_employee', $photo);
        }
    }

    public function update() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));

            $emp_hospcode=$this->input->post('edit_hospcode');
            $emp_email=$this->input->post('edit_email');
            $emp_mobile=$this->input->post('edit_mobile');
            $emp_address=$this->input->post('edit_address');
            $emp_province=$this->input->post('edit_province');
            $emp_amphur=$this->input->post('edit_amphur');
            $emp_district=$this->input->post('edit_district');

            if(empty(trim($emp_email))) {
                $json['error']['email']='อีเมล์ต้องไม่ว่างเปล่า';
            }

            if ($this->my_library->validateEmail($emp_email)==FALSE) {
                $json['error']['email']='รูปแบบอีเมล์ไม่ถูกต้อง';
            }

            if(empty(trim($emp_mobile))) {
                $json['error']['mobile']='เบอร์โทรศัพท์ต้องไม่ว่างเปล่า';
            }

            if ($this->my_library->validateMobile($emp_mobile)==FALSE) {
                $json['error']['mobile']='เบอร์โทรศัพท์ไม่ถูกต้อง';
            }

            if(empty(trim($emp_address))) {
                $json['error']['address']='ที่อยู่ต้องไม่ว่างเปล่า';
            }

            if(empty(trim($emp_province))) {
                $json['error']['province']='จังหวัดต้องไม่ว่างเปล่า';
            }

            if(empty(trim($emp_amphur))) {
                $json['error']['amphur']='อำเภอต้องไม่ว่างเปล่า';
            }

            if(empty(trim($emp_district))) {
                $json['error']['district']='ตำบลต้องไม่ว่างเปล่า';
            }


            if(empty($json['error'])) {
                $this->employee_model->addBy($data['user']['hospcode']);
                $this->employee_model->empHospcode($emp_hospcode);
                $this->employee_model->empEmail($emp_email);
                $this->employee_model->empMobile($emp_mobile);
                $this->employee_model->empAddress($emp_address);
                $this->employee_model->empProvince($emp_province);
                $this->employee_model->empAmphur($emp_amphur);
                $this->employee_model->empDistrict($emp_district);

                if( !empty($_FILES['emp_uplfile'])) {
                    $this->edit_photo($emp_hospcode);
                }

                try {
                    $query=$this->employee_model->updateUser();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }

                if( !empty($query)) {
                    $popup=array('msg'=> 0,
                        'detail'=> 'ระบบทำการอัพเดทข้อมูลสำเร็จ',
                    );
                    $this->session->set_userdata($popup);
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'ระบบไม่สามารถทำการอัพเดทข้อได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                    redirect('users/profile/');
                }
            }

            echo json_encode($json);
        }

        else {
            redirect('users/login');
        }
    }

    public function changePasswd() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));

            $code=$this->input->post('emp_code');
            $this->user_model->setHospcode($code);
            $data['codeInfo']=$this->user_model->getHospcode();

            $this->output->set_header('Content-Type: application/json');
            $this->load->view('users/popup/passwdEdit', $data);
        }

        else {
            redirect('users/login');
        }
    }

    public function updatePasswd() {
        $data=array();
        $json=array();
        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $emp_hospcode=$this->input->post('edit_hospcode');
            $passwd_query=$this->input->post('passwd_query');
            $passwd_old=$this->input->post('passwd_old');
            $passwd=$this->input->post('passwd');
            $passwdconfirm=$this->input->post('passwdconfirm');
            $temp = hash ( "sha256", $passwd_old );

            
            if(empty(trim($passwd_old))) {
                $json['error']['passwd-old']='รหัสผ่านต้องไม่ว่างเปล่า';
            }
            if($passwd_query != $temp){
                $json['error']['passwd-old']='รหัสผ่านไม่ถูกต้อง';
            }
        
            if(empty(trim($passwd))) {
                $json['error']['passwd']='รหัสผ่านต้องไม่ว่างเปล่า';
            }
            if ($this->my_library->checkPasswd($passwd)==FALSE) {
                $json['error']['passwd']='รูปแบบรหัสผ่านไม่ถูกต้อง';
            }
            if(empty(trim($passwdconfirm))) {
                $json['error']['passwdconfirm']='รหัสผ่านต้องไม่ว่างเปล่า';
            }
            if ($passwd!=$passwdconfirm) {
                $json['error']['passwdconfirm']='กรุณยืนยันรหัสผ่านของคุณอีกครั้ง';
            }
            $this->employee_model->empHospcode($emp_hospcode);

            if(empty($json['error'])) {
                $this->employee_model->setPasswd($passwd);

                try {
                    $query=$this->employee_model->updatePaswd();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }
                if( !empty($query)) {
                    $popup=array('msg'=> 0,
                        'detail'=> 'ระบบทำการอัพเดทข้อมูลสำเร็จ',
                    );
                    $this->session->set_userdata($popup);
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'ระบบไม่สามารถทำการอัพเดทข้อได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                    redirect('users/profile/');
                }

            }

            echo json_encode($json);
        }

        else {
            redirect('users/login');
        }
    }

    /*
     * User account information
     */
    public function account() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            redirect('welcome');
        }

        else {
            redirect('users/login');
        }
    }


    /*
     * User login
     */
    public function login() {
        $data=array();

        if($this->session->userdata('success_msg')) {
            $data['success_msg']=$this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }

        if($this->session->userdata('error_msg')) {
            $data['error_msg']=$this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        if($this->input->post('loginSubmit')) {
            $this->form_validation->set_rules('hospcode', 'text', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');


            if ($this->form_validation->run()==true) {
                $con['returnType']='single';
                $con['conditions']=array('hospcode'=>$this->input->post('hospcode'),
                    'passwd'=> hash("sha256", $this->input->post('password')),
                    'status'=> '1'
                );

                $checkLogin=$this->user_model->getRows($con);

                if($checkLogin) {
                    $this->session->set_userdata('isUserLoggedIn', TRUE);
                    $this->session->set_userdata('userId', $checkLogin['emp_id']);
                    redirect('users/account/');
                }

                else {
                    $data['error_msg']='<center><font color="red"><H3><i class="fa fa-exclamation-circle" aria-hidden="true"> รหัสประจำตัวหรือรหัสผ่านไม่ถูกต้อง</H3></i></font></center>';
                }
            }
        }

        //load the view
        $data['page_title']='Login';
        $data['page_name']='Login';
        $data['page_content']='Login';
        $this->load->view('users/login', $data);
    }

    /*
     * User registration
     */
    // public function registration() {
    //     $data=array();
    //     $userData=array();

    //     if($this->input->post('regisSubmit')) {
    //         $this->form_validation->set_rules('name', 'Name', 'required');
    //         $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
    //         $this->form_validation->set_rules('password', 'password', 'required');
    //         $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

    //         $userData=array('name'=> strip_tags($this->input->post('name')),
    //             'email'=> strip_tags($this->input->post('email')),
    //             'password'=> hash("sha256", $this->input->post('password')),
    //             'gender'=> $this->input->post('gender'),
    //             'phone'=> strip_tags($this->input->post('phone')));

    //         if($this->form_validation->run()==true) {
    //             $insert=$this->user->insert($userData);

    //             if($insert) {
    //                 $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
    //                 redirect('users/login');
    //             }

    //             else {
    //                 $data['error_msg']='Some problems occured, please try again.';
    //             }
    //         }
    //     }

    //     $data['user']=$userData;
    //     //load the view
    //     $this->load->view('users/registration', $data);
    // }

    /*
     * User logout
     */
    public function logout() {
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('users/login/');
    }

    /*
     * Existing email check during validation
     */
    public function email_check($str) {
        $con['returnType']='count';
        $con['conditions']=array('email'=>$str);
        $checkEmail=$this->user->getRows($con);

        if($checkEmail > 0) {
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        }

        else {
            return TRUE;
        }
    }
}