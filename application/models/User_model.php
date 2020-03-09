<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
    function __construct() {
        //$this->employee = 'view_employee';
        $this->employee='view_tbl_employee';
        $this->userMtg='tbl_user_mtg';
        $this->userProd='tbl_user_prod';
        $this->userHR='tbl_user_hr';
        $this->tbl_sex='tbl_sex';
        $this->userPlan='tbl_user_plan';
        $this->userPlanTrain='tbl_user_plan_train';
        $this->userSto='tbl_user_stock';
    }

    private $_hospcode;

    public function setHospcode($code) {
        $this->_hospcode=$code;
    }

    // for view Hospcode
    public function getHospcode() {
        $this->db->select('*');
        $this->db->from($this->employee);
        $this->db->where('hospcode', $this->_hospcode);
        $query=$this->db->get();
        return $query->row();
    }

    function getRows($params=array()) {
        $this->db->select('*');
        $this->db->from($this->employee);

        //fetch data by conditions
        if(array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key=> $value) {
                $this->db->where($key, $value);
            }
        }

        if(array_key_exists("emp_id", $params)) {
            $this->db->where('emp_id', $params['emp_id']);
            $query=$this->db->get();
            $result=$query->row_array();
        }

        else {

            //set start and limit
            if(array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'], $params['start']);
            }

            elseif( !array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit']);
            }

            $query=$this->db->get();

            if(array_key_exists("returnType", $params) && $params['returnType']=='count') {
                $result=$query->num_rows();
            }

            elseif(array_key_exists("returnType", $params) && $params['returnType']=='single') {
                $result=($query->num_rows() > 0)?$query->row_array(): FALSE;
            }

            else {
                $result=($query->num_rows() > 0)?$query->result_array(): FALSE;
            }
        }

        //return fetched data
        return $result;
    }

    // public function getProfile($id) {
    //     $query=$this->db->get_where($this->employee, array('hospcode'=> $id));
    //     return $query->result_array();
    // }

    public function getUser_mtg($data) {
        $query=$this->db->get_where($this->userMtg, array('hospcode'=> $data));
        return $query->result();
    }
    public function admin_mtg() {
        $query=$this->db->get($this->userMtg);
        return $query->result();
    }
    public function admin_prod() {
        $query=$this->db->get($this->userProd);
        return $query->result();
    }

    public function getUser_prod($data) {
        $query=$this->db->get_where($this->userProd, array('hospcode'=> $data));
        return $query->result();
    }

    public function getUser_hr($hospcode) {
        $query=$this->db->get_where($this->userHR, array('hospcode'=> $hospcode));
        return $query->result();
    }
    public function userPlan($hospcode) {
        $query=$this->db->get_where($this->userPlan, array('hospcode'=> $hospcode));
        return $query->result();
    }
    public function adminPlanTrain($hospcode) {
        $query=$this->db->get_where($this->userPlanTrain, array('hospcode'=> $hospcode));
        return $query->row();
    }
    public function userStock($hospcode) {
        $query=$this->db->get_where($this->userSto, array('hospcode'=> $hospcode));
        return $query->result();
    }
    
    public function uCheckPlan($hospcode) {
        $query=$this->db->get_where($this->userPlan, array('hospcode'=> $hospcode));
        return $query->result();
    }

    public function getUsername($hospcode) {
        if($hospcode !='') {
            $query=$this->db->get_where($this->employee, array('hospcode'=> $hospcode));
            $data=$query->result();
            return ($data[0]->titlename.$data[0]->firstname.' '.$data[0]->lastname);
        }

        else {
            return "";
        }

    }

    public function getUser($hospcode) {
        $query=$this->db->get_where($this->employee, array('hospcode'=> $hospcode));
        $data=$query->result();
        return ($data[0]->firstname.' '.$data[0]->lastname);
    }

    public function getEmail($hospcode) {
        $query=$this->db->get_where($this->employee, array('hospcode'=> $hospcode));
        $data=$query->result();
        return ($data[0]->email);
    }

    public function sex($id) {
        $query=$this->db->get_where($this->tbl_sex, array('sex_id'=> $id));
        $data=$query->result();
        return ($data[0]->sex_name);
    }

    public function insert($data=array()) {

        //add created and modified data if not included
        if( !array_key_exists("created", $data)) {
            $data['created']=date("Y-m-d H:i:s");
        }

        if( !array_key_exists("modified", $data)) {
            $data['modified']=date("Y-m-d H:i:s");
        }

        //insert user data to users table
        $insert=$this->db->insert($this->employee, $data);

        //return the status
        if($insert) {
            return $this->db->insert_id();
            ;
        }

        else {
            return false;
        }
    }
    public function status($status){
        if($status == "1"){
            return "กำลังปฏิบัติงาน";

        }else{
            return "จำหน่ายแล้ว";
        }

    }
}