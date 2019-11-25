<?php class Employee_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->tbl_employee='tbl_employee';
        $this->employee='view_tbl_employee';
        $this->titlename='tbl_titlename';
        $this->blood='tbl_blood';
        $this->provinces='tbl_provinces';
        $this->amphures='tbl_amphures';
        $this->districts='tbl_districts';
        $this->zipcodes='tbl_zipcodes';
        $this->education='tbl_education';
        $this->degree='tbl_degree';
        $this->category='tbl_category';
        $this->position='tbl_position';
        $this->level='tbl_level';
        $this->department='tbl_department';
        $this->section='tbl_section';
        $this->position_assign='tbl_position_assign';
        $this->upoint='tbl_product_upoint';
        $this->retire='tbl_retire';
        $this->discard_file='tbl_discard_file';


    }

    private $_empId,
    $_hospcode,
    $_titlename,
    $_firstname,
    $_lastname,
    $_sex,
    $_marital,
    $_blood,
    $_positionno,
    $_birthday,
    $_cid,
    $_email,
    $_mobile,
    $_address,
    $_province,
    $_amphur,
    $_district,
    $_accountno,
    $_salary,
    $_startdate,
    $_stopdate,
    $_education,
    $_degree,
    $_branch,
    $_gpa,
    $_category,
    $_position,
    $_level,
    $_department,
    $_section,
    $_addby,
    $_path,
    $_upload,
    $_passwd,
    $_discardRetire,
    $_discardDate,
    $_discardDetail,
    $_discardDoc;

    public function setEmpId($empId) {
        $this->_empId=$empId;
    }

    public function empHospcode($emp_hospcode) {
        $this->_hospcode=$emp_hospcode;
    }

    public function empTitlename($emp_titlename) {
        $this->_titlename=$emp_titlename;
    }

    public function empFirstname($emp_firstname) {
        $this->_firstname=$emp_firstname;
    }

    public function empLastname($emp_lastname) {
        $this->_lastname=$emp_lastname;
    }

    public function empSex($emp_sex) {
        $this->_sex=$emp_sex;
    }

    public function empMarital($emp_marital) {
        $this->_marital=$emp_marital;
    }

    public function empBlood($emp_blood) {
        $this->_blood=$emp_blood;
    }

    public function empPositionno($emp_positionno) {
        $this->_positionno=$emp_positionno;
    }

    public function empBirthday($emp_birthday) {
        $this->_birthday=$emp_birthday;
    }

    public function empCid($emp_cid) {
        $this->_cid=$emp_cid;
    }

    public function empEmail($emp_email) {
        $this->_email=$emp_email;
    }

    public function empMobile($emp_mobile) {
        $this->_mobile=$emp_mobile;
    }

    public function empAddress($emp_address) {
        $this->_address=$emp_address;
    }

    public function empProvince($emp_province) {
        $this->_province=$emp_province;
    }

    public function empAmphur($emp_amphur) {
        $this->_amphur=$emp_amphur;
    }

    public function empDistrict($emp_district) {
        $this->_district=$emp_district;
    }

    public function empAccountno($emp_accountno) {
        $this->_accountno=$emp_accountno;
    }

    public function empSalary($emp_salary) {
        $this->_salary=$emp_salary;
    }

    public function empStartdate($emp_startdate) {
        $this->_startdate=$emp_startdate;
    }

    public function empStopdate($emp_stopdate) {
        $this->_stopdate=$emp_stopdate;
    }

    public function empEducation($emp_education) {
        $this->_education=$emp_education;
    }

    public function empDegree($emp_degree) {
        $this->_degree=$emp_degree;
    }

    public function empBranch($emp_branch) {
        $this->_branch=$emp_branch;
    }

    public function empGpa($emp_gpa) {
        $this->_gpa=$emp_gpa;
    }

    public function empCategory($emp_category) {
        $this->_category=$emp_category;
    }

    public function empPosition($emp_position) {
        $this->_position=$emp_position;
    }

    public function empLevel($emp_level) {
        $this->_level=$emp_level;
    }

    public function empDepartment($emp_department) {
        $this->_department=$emp_department;
    }

    public function empSection($emp_section) {
        $this->_section=$emp_section;
    }

    public function addBy($hospcode) {
        $this->_addby=$hospcode;
    }

    public function setUpload($upload) {
        $this->_upload=$upload;
    }

    public function setPath($path) {
        $this->_path=$path;
    }

    public function setPasswd($passwd) {
        $this->_passwd=$passwd;
    }

    public function empDiscardRetire($emp_retire) {
        $this->_discardRetire=$emp_retire;
    }

    public function empDiscardDate($emp_date) {
        $this->_discardDate=$emp_date;
    }

    public function empDiscardDetail($emp_detail) {
        $this->_discardDetail=$emp_detail;
    }

    public function empDiscardDoc($discardDoc) {
        $this->_discardDoc=$discardDoc;
    }


    public function createEmp() {
        $data=array('hospcode'=> $this->_hospcode,
            'titlename'=> $this->_titlename,
            'firstname'=> $this->_firstname,
            'lastname'=> $this->_lastname,
            'sex'=> $this->_sex,
            'marital'=> $this->_marital,
            'blood'=> $this->_blood,
            'position_number'=> $this->_positionno,
            'birthday'=> $this->_birthday,
            'cid'=> $this->_cid,
            'email'=> $this->_email,
            'mobile'=> $this->_mobile,
            'address'=> $this->_address,
            'province_id'=> $this->_province,
            'amphur_id'=> $this->_amphur,
            'district_id'=> $this->_district,
            'account_number'=> $this->_accountno,
            'salary'=> $this->_salary,
            'start_date'=> $this->_startdate,
            'stop_date'=> $this->_stopdate,
            'education_id'=> $this->_education,
            'degree_id'=> $this->_degree,
            'branch'=> $this->_branch,
            'gpa'=> $this->_gpa,
            'category_id'=> $this->_category,
            'position_id'=> $this->_position,
            'level_id'=> $this->_level,
            'department_id'=> $this->_department,
            'section_id'=> $this->_section,
            'passwd'=> hash("sha256", $this->_hospcode),
            'add_by'=> $this->_addby,
            'add_ip'=> $this->input->ip_address(),
            'add_date'=> date("Y-m-d H:i:s"),
            'photo'=> $this->_upload,
            'reference'=> $this->_path,
        );

        $this->db->insert($this->tbl_employee, $data);
        return $this->db->insert_id();
    }

    public function upoint($emp_hospcode) {
        $data=array('hospcode'=> $emp_hospcode,
            'point'=> '10',
            'modified'=> date("Y-m-d H:i:s"),
        );
        $this->db->insert($this->upoint, $data);
    }

    public function updateEmp() {
        $data=array('titlename'=> $this->_titlename,
            'firstname'=> $this->_firstname,
            'lastname'=> $this->_lastname,
            'sex'=> $this->_sex,
            'marital'=> $this->_marital,
            'blood'=> $this->_blood,
            'position_number'=> $this->_positionno,
            'birthday'=> $this->_birthday,
            'cid'=> $this->_cid,
            'email'=> $this->_email,
            'mobile'=> $this->_mobile,
            'address'=> $this->_address,
            'province_id'=> $this->_province,
            'amphur_id'=> $this->_amphur,
            'district_id'=> $this->_district,
            'account_number'=> $this->_accountno,
            'salary'=> $this->_salary,
            'start_date'=> $this->_startdate,
            'stop_date'=> $this->_stopdate,
            'education_id'=> $this->_education,
            'degree_id'=> $this->_degree,
            'branch'=> $this->_branch,
            'gpa'=> $this->_gpa,
            'category_id'=> $this->_category,
            'position_id'=> $this->_position,
            'level_id'=> $this->_level,
            'department_id'=> $this->_department,
            'section_id'=> $this->_section,
            'add_by'=> $this->_addby,
            'add_ip'=> $this->input->ip_address(),
            'add_date'=> date("Y-m-d H:i:s"),
        );
        $this->db->where('hospcode', $this->_hospcode);
        $this->db->update($this->tbl_employee, $data);
        return "Ok";
    }

    public function updateUser() {
        $data=array('email'=> $this->_email,
            'mobile'=> $this->_mobile,
            'address'=> $this->_address,
            'province_id'=> $this->_province,
            'amphur_id'=> $this->_amphur,
            'edit_by'=> $this->_addby,
            'edit_ip'=> $this->input->ip_address(),
            'edit_date'=> date("Y-m-d H:i:s"),
        );
        $this->db->where('hospcode', $this->_hospcode);
        $this->db->update($this->tbl_employee, $data);
        return "Ok";
    }

    public function updatePaswd() {
        $data=array('passwd'=> hash("sha256", $this->_passwd),
            'edit_by'=> $this->_hospcode,
            'edit_ip'=> $this->input->ip_address(),
            'edit_date'=> date("Y-m-d H:i:s"),
        );
        $this->db->where('hospcode', $this->_hospcode);
        $this->db->update($this->tbl_employee, $data);
        return "Ok";
    }

    public function updateDiscard() {
        $data=array('status'=> 0,
            'retire_id'=> $this->_discardRetire,
            'discard_by'=> $this->_addby,
            'discard_date'=> $this->_discardDate,
            'discard_detail'=> $this->_discardDetail,
            'discard_bydate'=> date("Y-m-d H:i:s"),
            'discard_ip'=> $this->input->ip_address(),

        );
        $this->db->where('hospcode', $this->_hospcode);
        $this->db->update($this->tbl_employee, $data);
        return "Ok";
    }


    public function getEmp() {
        $this->db->select('*');
        $this->db->from($this->employee);
        $this->db->where('emp_id', $this->_empId);
        $query=$this->db->get();
        return $query->row();
    }

    public function getHospcode($hospcode) {
        $this->db->select('*');
        $this->db->from($this->employee);
        $this->db->where('hospcode', $hospcode);
        $query=$this->db->get();
        return $query->row();
    }


    public function list_employee() {
        $query=$this->db->order_by('titlename', 'ASC')->order_by('firstname', 'ASC')->get_where($this->employee, array('status'=> '1'));
        return $query->result();
    }

    public function category($cateId) {
        $this->db->select('*');
        $this->db->from($this->employee);
        $this->db->where('category_id', $cateId);
        $this->db->where('status =', 1);
        $this->db->order_by('titlename', 'ASC');
        $this->db->order_by('firstname', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    public function discard() {
        $this->db->select('*');
        $this->db->from($this->employee);
        $this->db->where('status =', 0);
        $this->db->order_by('titlename', 'ASC');
        $this->db->order_by('firstname', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    public function hospcodeLast() {
        $this->db->select_max('hospcode');
        $query=$this->db->get($this->employee);
        $data=$query->result();
        return ($data[0]->hospcode+1);
    }

    public function getTitlename() {
        $query=$this->db->get($this->titlename);
        return $query->result();
    }

    public function getBlood() {
        $query=$this->db->get($this->blood);
        return $query->result();
    }

    function getEducation() {
        $query=$this->db->get($this->education);
        return $query->result();
    }

    public function getRetire() {
        $query=$this->db->get($this->retire);
        return $query->result();
    }

    function getDegree() {
        $this->db->order_by("degree_name", "ASC");
        $query=$this->db->get($this->degree);
        return $query->result();
    }

    function getCategory($id='') {
        if($id) {
            $this->db->where('category_id', $id);
            $query=$this->db->get($this->category);
            return $query->result();
        }

        else {
            $query=$this->db->get($this->category);
            return $query->result();
        }
    }

    function getPosition() {
        $this->db->order_by("position_name", "ASC");
        $query=$this->db->get($this->position);
        return $query->result();
    }

    function getLevel() {
        $this->db->order_by("id", "ASC");
        $query=$this->db->get($this->level);
        return $query->result();
    }

    function getDepartment() {
        $this->db->order_by("department_id", "ASC");
        $query=$this->db->get($this->department);
        return $query->result();
    }

    function getSection() {
        $this->db->order_by("section_id", "ASC");
        $query=$this->db->get($this->section);
        return $query->result();
    }

    function getPosition_assign() {
        $this->db->order_by("id", "ASC");
        $query=$this->db->get($this->position_assign);
        return $query->result();
    }

    function countEmp($category_id) {
        if($category_id !='') {
            $this->db->where('status =', 1);
            $this->db->where('category_id =', $category_id);
            $query=$this->db->get($this->employee);
            echo $query->num_rows();
        }

        elseif($category_id=='0') {
            $this->db->where('status =', 0);
            $query=$this->db->get($this->employee);
            echo $query->num_rows();
        }

        else {
            $this->db->where('status =', 1);
            $query=$this->db->get($this->employee);
            echo $query->num_rows();
        }
    }

    function count() {
        $query=$this->db->get('view_emp_count');
        return $query->result();
    }

    public function getRetirename($id) {
        $query=$this->db->get_where($this->retire, array('retire_id'=> $id));
        $data=$query->result();
        return ($data[0]->retire_name);
    }

    public function discardFile($code) {
        if($code !='') {
            $this->db->select('*');
            $this->db->from($this->discard_file);
            $this->db->where('hospcode =', $code);
            $query=$this->db->get();
            return $query->result();
        }
        else {
            return "";
        }
    }

}

?>