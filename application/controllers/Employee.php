<?php Class Employee extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'my_date', 'thaidate', 'upload', 'excel'));
        // Load helper
        $this->load->helper(array('url', 'html', 'form', 'string'));
        // Load model
        $this->load->model(array('user_model', 'employee_model', 'location_model', 'posts_model'));
    }

    public function index() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='บุคลากร';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบบุคลากร"=> "/e-services/employee/"
            );
            $data['breadcrumb']=$breadcrumb;
            $data['query']=$this->employee_model->list_employee();
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
            $data['admin_level']=$this->user_model->getUser_hr($data['user']['hospcode']);

            $this->template->load('layout/template', 'employee/index', $data);
        }

        else {
            redirect('users/login');
        }
    }

    public function category($id='') {
        $data=array();
        $data['Category']=$this->employee_model->getCategory($id);

        if( !empty($data['Category'])) {
            if($this->session->userdata('isUserLoggedIn')) {
                $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
                $data['mylibrary']=$this->my_library;
                $data['page_title']="บุคลากร";
                $breadcrumb=array("Home"=> "/e-services/",
                    "ระบบบุคลากร"=> "/e-services/employee/",
                    $data['Category'][0]->category_name=> ""
                );
                $data['breadcrumb']=$breadcrumb;
                $data['thaidate']=$this->thaidate;
                $data['cateInfo']=$this->employee_model->category($id);
                $data['admin_level']=$this->user_model->getUser_hr($data['user']['hospcode']);

                if ( !empty($data['admin_level'])) {
                    if($data['admin_level'][0]->level==1 || $data['admin_level'][0]->level==2) {
                        $this->template->load('layout/template', 'employee/category', $data);
                    }
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                    redirect('employee/');
                }
            }

            else {
                redirect('users/login');
            }
        }

        else {
            redirect('employee/');
        }
    }

    public function amount() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']="บุคลากร";
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบบุคลากร"=> "/e-services/employee/",
                "บุคลากรทั้งหมด"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['amount']=$this->employee_model->list_employee();
            $data['admin_level']=$this->user_model->getUser_hr($data['user']['hospcode']);

            if ( !empty($data['admin_level'])) {
                if($data['admin_level'][0]->level==1 || $data['admin_level'][0]->level==2) {
                    $this->template->load('layout/template', 'employee/amount', $data);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('employee/');
            }
        }

        else {
            redirect('users/login');
        }
    }

    public function discard() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']="บุคลากร";
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบบุคลากร"=> "/e-services/employee/",
                "บุคลากรที่จำหน่าย"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['discard']=$this->employee_model->discard();
            $data['admin_level']=$this->user_model->getUser_hr($data['user']['hospcode']);

            if ( !empty($data['admin_level'])) {
                if($data['admin_level'][0]->level==1 || $data['admin_level'][0]->level==2) {
                    $this->template->load('layout/template', 'employee/discard', $data);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('employee/');
            }

        }

        else {
            redirect('users/login');
        }
    }

    public function user_pass() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='User &amp; Password';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบบุคลากร"=> "/e-services/employee/",
                "User & Password"=> ""
            );
            $data['breadcrumb']=$breadcrumb;

            //load the view
            if($data['user']['level_user']>=99) {
                $this->template->load('layout/template', 'employee/user_pass', $data);
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('employee/amount/');
            }
        }

        else {
            redirect('users/login');
        }
    }

    // get amphur names
    public function getamphur() {
        $json=array();
        $this->location_model->setProvincesID($this->input->post('provinceID'));
        $json=$this->location_model->getAmphur();
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // get district names
    function getdistrict() {
        $json=array();
        $this->location_model->setAmphurID($this->input->post('amphurID'));
        $json=$this->location_model->getDistrict();
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    function getcount() {
        $data=$this->employee_model->count();
        print_r(json_encode($data, true));
    }

    public function viewEmp() {
        $data=array();
        $code=$this->input->post('emp_code');
        $this->user_model->setHospcode($code);
        $data['codeInfo']=$this->user_model->getHospcode();
        $data['discardFile']=$this->employee_model->discardFile($code);
        $data['thaidate']=$this->thaidate;
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('employee/popup/renderView', $data);
    }

    function upload_photo($hospcode) {
        mkdir('./assets/uploads/employee/photo/'.$hospcode.'/', 0777, TRUE);
        $path='assets/uploads/employee/photo/'.$hospcode.'/';

        if( !empty($_FILES['emp_uplfile'])) {
            $config['upload_path']='./assets/uploads/employee/photo/'.$hospcode.'/';
            $config['allowed_types']='jpg|jpeg|png';
            $config['max_size']=1024*5;
            $config['encrypt_name']=TRUE;

            $this->upload->initialize($config);

            // if ( !$this->upload->do_upload('emp_uplfile')) {}
            
            if ( !$this->upload->do_upload('emp_uplfile')) {
                $error=$this->upload->display_errors();
                return $error;
            }

            else {
                $data=$this->upload->data();
                $this->employee_model->setPath($path);
                $this->employee_model->setUpload($data['file_name']);
            }
        }

        else {
            $this->employee_model->setPath($path);
        }
    }

    function edit_photo($hospcode) {
        $config['upload_path']='./assets/uploads/employee/photo/'.$hospcode.'/';
        $config['allowed_types']='jpg|jpeg|png';
        $config['max_size']=1024*5;
        $config['encrypt_name']=TRUE;

        $this->upload->initialize($config);

        //if ( !$this->upload->do_upload('emp_uplfile')) {}

        if ( !$this->upload->do_upload('emp_uplfile')) {
            $error=$this->upload->display_errors();
            return $error;
        }
        

        else {
            $data=$this->upload->data();
            $photo=array('photo'=> $data['file_name'],
                'reference'=> 'assets/uploads/employee/photo/'.$hospcode.'/',
            );
            $this->db->where('hospcode', $hospcode);
            $this->db->update('tbl_employee', $photo);
        }
    }

    public function saveEmp() {
        $data=array();
        $json=array();
        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['admin_level']=$this->user_model->getUser_hr($data['user']['hospcode']);

            if ( !empty($data['admin_level'])) {
                if($data['admin_level'][0]->level==1 || $data['admin_level'][0]->level==2) {
                    $emp_hospcode=$this->input->post('emp_hospcode');
                    $emp_sex=$this->input->post('emp_sex');
                    $emp_marital=$this->input->post('emp_marital');
                    $emp_titlename=$this->input->post('emp_titlename');
                    $emp_firstname=$this->input->post('emp_firstname');
                    $emp_lastname=$this->input->post('emp_lastname');
                    $emp_blood=$this->input->post('emp_blood');
                    $emp_positionno=$this->input->post('emp_positionno');
                    $emp_birthday=$this->input->post('emp_birthday');
                    $emp_cid=$this->input->post('emp_cid');
                    $emp_email=$this->input->post('emp_email');
                    $emp_mobile=$this->input->post('emp_mobile');
                    $emp_address=$this->input->post('emp_address');
                    $emp_province=$this->input->post('emp_province');
                    $emp_amphur=$this->input->post('emp_amphur');
                    $emp_district=$this->input->post('emp_district');
                    $emp_accountno=$this->input->post('emp_accountno');
                    $emp_salary=$this->input->post('emp_salary');
                    $emp_startdate=$this->input->post('emp_startdate');
                    $emp_stopdate=$this->input->post('emp_stopdate');
                    $emp_education=$this->input->post('emp_education');
                    $emp_degree=$this->input->post('emp_degree');
                    $emp_branch=$this->input->post('emp_branch');
                    $emp_gpa=$this->input->post('emp_gpa');
                    $emp_category=$this->input->post('emp_category');
                    $emp_position=$this->input->post('emp_position');
                    $emp_level=$this->input->post('emp_level');
                    $emp_department=$this->input->post('emp_department');
                    $emp_section=$this->input->post('emp_section');
                    $emp_note=$this->input->post('emp_note');

                    if(empty(trim($emp_titlename))) {
                        $json['error']['titlename']='ระบุคำนำหน้าชื่อ';
                    }

                    if(empty(trim($emp_firstname))) {
                        $json['error']['firstname']='ชื่อต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_lastname))) {
                        $json['error']['lastname']='นามสกุลต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_blood))) {
                        $json['error']['blood']='ระบุกรุ๊ปเลือด';
                    }

                    if(empty(trim($emp_birthday))) {
                        $json['error']['birthday']='วันเกิดต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_cid))) {
                        $json['error']['cid']='เลขบัตรประชาชนต้องไม่ว่างเปล่า';
                    }

                    if ($this->my_library->validateCID($emp_cid)==FALSE) {
                        $json['error']['cid']='เลขบัตรประชาชนไม่ถูกต้อง';
                    }

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

                    if(empty(trim($emp_startdate))) {
                        $json['error']['startdate']='วันที่เริ่มงานต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_education))) {
                        $json['error']['education']='การศึกษาต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_degree))) {
                        $json['error']['degree']='วุฒิการศึกษาต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_category))) {
                        $json['error']['category']='ประเภทต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_position))) {
                        $json['error']['position']='ตำแหน่งต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_department))) {
                        $json['error']['department']='กลุ่มต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_section))) {
                        $json['error']['section']='งานต้องไม่ว่างเปล่า';
                    }

                    if(empty($json['error'])) {
                        $this->employee_model->addBy($data['user']['hospcode']);
                        $this->employee_model->empHospcode($emp_hospcode);
                        $this->employee_model->empTitlename($emp_titlename);
                        $this->employee_model->empFirstname($emp_firstname);
                        $this->employee_model->empLastname($emp_lastname);
                        $this->employee_model->empSex($emp_sex);
                        $this->employee_model->empMarital($emp_marital);
                        $this->employee_model->empBlood($emp_blood);
                        $this->employee_model->empPositionno($emp_positionno);
                        $this->employee_model->empBirthday($emp_birthday);
                        $this->employee_model->empCid($emp_cid);
                        $this->employee_model->empEmail($emp_email);
                        $this->employee_model->empMobile($emp_mobile);
                        $this->employee_model->empAddress($emp_address);
                        $this->employee_model->empProvince($emp_province);
                        $this->employee_model->empAmphur($emp_amphur);
                        $this->employee_model->empDistrict($emp_district);
                        $this->employee_model->empAccountno($emp_accountno);
                        $this->employee_model->empSalary($emp_salary);
                        $this->employee_model->empStartdate($emp_startdate);
                        $this->employee_model->empStopdate($emp_stopdate);
                        $this->employee_model->empEducation($emp_education);
                        $this->employee_model->empDegree($emp_degree);
                        $this->employee_model->empBranch($emp_branch);
                        $this->employee_model->empGpa($emp_gpa);
                        $this->employee_model->empCategory($emp_category);
                        $this->employee_model->empPosition($emp_position);
                        $this->employee_model->empLevel($emp_level);
                        $this->employee_model->empDepartment($emp_department);
                        $this->employee_model->empSection($emp_section);
                        $this->employee_model->empNote($emp_note);
                        $this->upload_photo($emp_hospcode);

                        try {
                            $last_id=$this->employee_model->createEmp();

                        }

                        catch (Exception $e) {
                            var_dump($e->getMessage());
                        }

                        if($last_id) {
                            $this->employee_model->upoint($emp_hospcode);
                            $popup=array('msg'=> 0,
                                'detail'=> 'ระบบทำการบันทึกข้อมูลสำเร็จ',
                            );
                            $this->session->set_userdata($popup);
                        }

                        else {
                            $popup=array('msg'=> 1,
                                'detail'=> 'ระบบไม่สามารถทำการบันทึกข้อได้',
                            );
                            $this->session->set_userdata($popup);
                            redirect('employee/');
                        }
                    }

                    echo json_encode($json);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('employee/');
            }
        }

        else {
            redirect('users/login');
        }
    }

    public function editEmp() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['admin_level']=$this->user_model->getUser_hr($data['user']['hospcode']);

            if ( !empty($data['admin_level'])) {
                if($data['admin_level'][0]->level==1 || $data['admin_level'][0]->level==2) {
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
                    $this->load->view('employee/popup/renderEdit', $data);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('employee/');
            }
        }

        else {
            redirect('users/login');
        }

    }

    public function updateEmp() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['admin_level']=$this->user_model->getUser_hr($data['user']['hospcode']);

            if ( !empty($data['admin_level'])) {
                if($data['admin_level'][0]->level==1 || $data['admin_level'][0]->level==2) {
                    $emp_hospcode=$this->input->post('edit_hospcode');
                    $emp_sex=$this->input->post('edit_sex');
                    $emp_marital=$this->input->post('edit_marital');
                    $emp_titlename=$this->input->post('edit_titlename');
                    $emp_firstname=$this->input->post('edit_firstname');
                    $emp_lastname=$this->input->post('edit_lastname');
                    $emp_blood=$this->input->post('edit_blood');
                    $emp_positionno=$this->input->post('edit_positionno');
                    $emp_birthday=$this->input->post('edit_birthday');
                    $emp_cid=$this->input->post('edit_cid');
                    $emp_email=$this->input->post('edit_email');
                    $emp_mobile=$this->input->post('edit_mobile');
                    $emp_address=$this->input->post('edit_address');
                    $emp_province=$this->input->post('edit_province');
                    $emp_amphur=$this->input->post('edit_amphur');
                    $emp_district=$this->input->post('edit_district');
                    $emp_accountno=$this->input->post('edit_accountno');
                    $emp_salary=$this->input->post('edit_salary');
                    $emp_startdate=$this->input->post('edit_startdate');
                    $emp_stopdate=$this->input->post('edit_stopdate');
                    $emp_education=$this->input->post('edit_education');
                    $emp_degree=$this->input->post('edit_degree');
                    $emp_branch=$this->input->post('edit_branch');
                    $emp_gpa=$this->input->post('edit_gpa');
                    $emp_category=$this->input->post('edit_category');
                    $emp_position=$this->input->post('edit_position');
                    $emp_level=$this->input->post('edit_level');
                    $emp_department=$this->input->post('edit_department');
                    $emp_section=$this->input->post('edit_section');
                    $emp_note=$this->input->post('edit_note');

                    if(empty(trim($emp_titlename))) {
                        $json['error']['titlename']='ระบุคำนำหน้าชื่อ';
                    }

                    if(empty(trim($emp_firstname))) {
                        $json['error']['firstname']='ชื่อต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_lastname))) {
                        $json['error']['lastname']='นามสกุลต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_blood))) {
                        $json['error']['blood']='ระบุกรุ๊ปเลือด';
                    }

                    if(empty(trim($emp_birthday))) {
                        $json['error']['birthday']='วันเกิดต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_cid))) {
                        $json['error']['cid']='เลขบัตรประชาชนต้องไม่ว่างเปล่า';
                    }

                    if ($this->my_library->validateCID($emp_cid)==FALSE) {
                        $json['error']['cid']='เลขบัตรประชาชนไม่ถูกต้อง';
                    }

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

                    if(empty(trim($emp_startdate))) {
                        $json['error']['startdate']='วันที่เริ่มงานต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_education))) {
                        $json['error']['education']='การศึกษาต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_degree))) {
                        $json['error']['degree']='วุฒิการศึกษาต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_category))) {
                        $json['error']['category']='ประเภทต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_position))) {
                        $json['error']['position']='ตำแหน่งต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_department))) {
                        $json['error']['department']='กลุ่มต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_section))) {
                        $json['error']['section']='งานต้องไม่ว่างเปล่า';
                    }


                    if(empty($json['error'])) {
                        $this->employee_model->addBy($data['user']['hospcode']);
                        $this->employee_model->empHospcode($emp_hospcode);
                        $this->employee_model->empTitlename($emp_titlename);
                        $this->employee_model->empFirstname($emp_firstname);
                        $this->employee_model->empLastname($emp_lastname);
                        $this->employee_model->empSex($emp_sex);
                        $this->employee_model->empMarital($emp_marital);
                        $this->employee_model->empBlood($emp_blood);
                        $this->employee_model->empPositionno($emp_positionno);
                        $this->employee_model->empBirthday($emp_birthday);
                        $this->employee_model->empCid($emp_cid);
                        $this->employee_model->empEmail($emp_email);
                        $this->employee_model->empMobile($emp_mobile);
                        $this->employee_model->empAddress($emp_address);
                        $this->employee_model->empProvince($emp_province);
                        $this->employee_model->empAmphur($emp_amphur);
                        $this->employee_model->empDistrict($emp_district);
                        $this->employee_model->empAccountno($emp_accountno);
                        $this->employee_model->empSalary($emp_salary);
                        $this->employee_model->empStartdate($emp_startdate);
                        $this->employee_model->empStopdate($emp_stopdate);
                        $this->employee_model->empEducation($emp_education);
                        $this->employee_model->empDegree($emp_degree);
                        $this->employee_model->empBranch($emp_branch);
                        $this->employee_model->empGpa($emp_gpa);
                        $this->employee_model->empCategory($emp_category);
                        $this->employee_model->empPosition($emp_position);
                        $this->employee_model->empLevel($emp_level);
                        $this->employee_model->empDepartment($emp_department);
                        $this->employee_model->empSection($emp_section);
                        $this->employee_model->empNote($emp_note);

                        if( !empty($_FILES['emp_uplfile'])) {
                            $this->edit_photo($emp_hospcode);
                        }

                        try {
                            $query=$this->employee_model->updateEmp();
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
                            redirect('employee/');
                        }
                    }

                    echo json_encode($json);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('employee/');
            }
        }

        else {
            redirect('users/login');
        }
    }

    public function discardEmp() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['admin_level']=$this->user_model->getUser_hr($data['user']['hospcode']);

            if ( !empty($data['admin_level'])) {
                if($data['admin_level'][0]->level==1 || $data['admin_level'][0]->level==2) {
                    $code=$this->input->post('emp_code');
                    $this->user_model->setHospcode($code);
                    $data['codeInfo']=$this->user_model->getHospcode();
                    $data['thaidate']=$this->thaidate;
                    $data['retire']=$this->employee_model->getRetire();

                    $this->output->set_header('Content-Type: application/json');

                    $this->load->view('employee/popup/randerDiscard', $data);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('employee/');
            }
        }

        else {
            redirect('users/login');
        }

    }

    public function upload_discard($hospcode) {
        mkdir('./assets/uploads/employee/discard/'.$hospcode.'/', 0777, TRUE);

        if($_FILES["edit_files"]["name"] !='') {
            $config["upload_path"]='./assets/uploads/employee/discard/'.$hospcode.'/';
            $config["allowed_types"]='gif|jpg|png|pdf';
            $config['max_size']=1024*5;
            $config['encrypt_name']=TRUE;
            $this->upload->initialize($config);

            for($count=0; $count<count($_FILES["edit_files"]["name"]); $count++) {
                $_FILES["file"]["name"]=$_FILES["edit_files"]["name"][$count];
                $_FILES["file"]["type"]=$_FILES["edit_files"]["type"][$count];
                $_FILES["file"]["tmp_name"]=$_FILES["edit_files"]["tmp_name"][$count];
                $_FILES["file"]["error"]=$_FILES["edit_files"]["error"][$count];
                $_FILES["file"]["size"]=$_FILES["edit_files"]["size"][$count];

                if ( !$this->upload->do_upload('file')) {
                    $popup=array('msg'=> 1,
                        'detail'=> $this->upload->display_errors(),
                    );
                    $this->session->set_userdata($popup);
                }

                else {
                    $data=$this->upload->data();
                    $data=array('hospcode'=> $hospcode,
                        'file_name'=> $data['file_name'],
                        'date'=> date("Y-m-d H:i:s"),
                    );
                    $this->db->insert('tbl_discard_file', $data);
                }
            }
        }
    }

    public function update_discard() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['admin_level']=$this->user_model->getUser_hr($data['user']['hospcode']);

            if ( !empty($data['admin_level'])) {
                if($data['admin_level'][0]->level==1 || $data['admin_level'][0]->level==2) {
                    $emp_hospcode=$this->input->post('edit_hospcode');
                    $emp_retire=$this->input->post('edit_retire');
                    $emp_date=$this->input->post('edit_date');
                    $emp_detail=$this->input->post('edit_detail');

                    if(empty(trim($emp_retire))) {
                        $json['error']['retire']='ระบุประเภทการจำหน่าย';
                    }

                    if(empty(trim($emp_date))) {
                        $json['error']['date']='วันที่จำหน่ายต้องไม่ว่างเปล่า';
                    }

                    if(empty(trim($emp_detail))) {
                        $json['error']['detail']='สาเหตุต้องไม่ว่างเปล่า';
                    }

                    if(empty($json['error'])) {
                        $this->employee_model->addBy($data['user']['hospcode']);
                        $this->employee_model->empHospcode($emp_hospcode);
                        $this->employee_model->empDiscardRetire($emp_retire);
                        $this->employee_model->empDiscardDate($emp_date);
                        $this->employee_model->empDiscardDetail($emp_detail);

                        if( !empty($_FILES['edit_files'])) {
                            $this->upload_discard($emp_hospcode);
                        }

                        try {
                            $query=$this->employee_model->updateDiscard();
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
                            redirect('employee/');
                        }
                    }

                    echo json_encode($json);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('employee/');
            }
        }

        else {
            redirect('users/login');
        }

    }

    public function Export() {
        // create file name
        $fileName='Employee-'. date("Y-m-d-H-i-s") . '.xlsx';
        // load excel library
        $this->load->library('excel');
        $data['thaidate']=$this->thaidate;
        $empInfo=$this->employee_model->list_employee();
        $objPHPExcel=new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ลำดับ');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'รหัสประจำตัว');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'คำนำหน้าชื่อ');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'ชื่อ');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'นามสกุล');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'เพศ');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'กรุ๊ปเลือด');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'เลขที่ตำแหน่ง');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'วันเกิด');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'อายุ');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'เลขบัตรประชาชน');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'อีเมล์');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'เบอร์โทรศัพท์');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'การศึกษา');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'วุฒิการศึกษา');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'สาขา');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'ที่อยู่');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'ตำบล');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'อำเภอ');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'จังหวัด');
        $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'รหัสไปรษณีย์');
        $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'ประเภทบุคลากร');
        $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'ตำแหน่ง');
        $objPHPExcel->getActiveSheet()->SetCellValue('X1', 'ระดับ');
        $objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'กลุ่ม');
        $objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'งาน');

        // set Row
        $rowCount=2;
        $no=1;

        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'. $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'. $rowCount, $element->hospcode);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'. $rowCount, $element->titlename);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'. $rowCount, $element->firstname);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'. $rowCount, $element->lastname);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'. $rowCount, $element->sex_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'. $rowCount, $element->blood);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'. $rowCount, $element->position_number);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'. $rowCount, $this->thaidate->thai_date_fullmonth($element->birthday));
            $objPHPExcel->getActiveSheet()->SetCellValue('J'. $rowCount, $this->thaidate->birthda($element->birthday));
            $objPHPExcel->getActiveSheet()->SetCellValue('K'. $rowCount, $element->cid);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'. $rowCount, $element->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'. $rowCount, $element->mobile);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'. $rowCount, $element->education_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'. $rowCount, $element->degree_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'. $rowCount, $element->branch);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q'. $rowCount, $element->address);
            $objPHPExcel->getActiveSheet()->SetCellValue('R'. $rowCount, $element->district_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('S'. $rowCount, $element->amphur_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('T'. $rowCount, $element->province_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('U'. $rowCount, $element->zipcode);
            $objPHPExcel->getActiveSheet()->SetCellValue('V'. $rowCount, $element->category_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('W'. $rowCount, $element->position_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('X'. $rowCount, $element->level_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('Y'. $rowCount, $element->department_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('Z'. $rowCount, $element->section_name);
            $rowCount++;
            $no++;
        }

        $objWriter=new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('assets/uploads/employee/export/'. $fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect('assets/uploads/employee/export/'. $fileName);
    }
    public function Export2() {
        // create file name
        $fileName='Employee-'. date("Y-m-d-H-i-s") . '.xlsx';
        // load excel library
        $this->load->library('excel');
        $data['thaidate']=$this->thaidate;
        $empInfo=$this->employee_model->list_employee();
        $objPHPExcel=new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ลำดับ');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'รหัสประจำตัว');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'คำนำหน้าชื่อ');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'ชื่อ');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'นามสกุล');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'เพศ');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'อีเมล์');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'เบอร์โทรศัพท์');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'ประเภทบุคลากร');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'ตำแหน่ง');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'ระดับ');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'กลุ่ม');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'งาน');

        // set Row
        $rowCount=2;
        $no=1;

        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'. $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'. $rowCount, $element->hospcode);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'. $rowCount, $element->titlename);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'. $rowCount, $element->firstname);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'. $rowCount, $element->lastname);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'. $rowCount, $element->sex_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'. $rowCount, $element->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'. $rowCount, $element->mobile);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'. $rowCount, $element->category_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'. $rowCount, $element->position_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'. $rowCount, $element->level_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'. $rowCount, $element->department_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'. $rowCount, $element->section_name);
            $rowCount++;
            $no++;
        }

        $objWriter=new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('assets/uploads/employee/export/'. $fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect('assets/uploads/employee/export/'. $fileName);
    }

    public function test() {
        $data=array();
        $data['user']=$this->user_model->admin_mtg();

        foreach($data['user'] as $user) {
            if($user->level==1) {
                $this->user_model->setHospcode($user->hospcode);
                $data['admin']=$this->user_model->getHospcode();
                $data1=array($data['admin']->email=> $data['admin']->titlename.$data['admin']->firstname.$data['admin']->lastname,
                );
                echo '<pre>';
                print_r($data1);
                echo '</pre>';
            }
           

        }

       


    }


    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    // exit;
    // public function new(){
    //     for($i=10008; $i<=10077; $i++) {
    //         mkdir('./assets/uploads/employee/photo/'.$i.'/', 0777, TRUE);
    //         }

    // }

    // public function discardFile() {
    // $data = $this->employee_model->discardFile(10005);
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    // exit;
    // }
}