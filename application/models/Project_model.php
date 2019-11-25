<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model {

    function __construct() {
        $this->tblPlan='tbl_project_plan';
        $this->tblProduct='tbl_project_product';
        $this->tblActivity='tbl_project_activity';
        $this->tblProgram='tbl_project_program';
    }

    private $_planId,
    $_planName,
    $_planYear,
    $_productId,
    $_productName,
    $_productYear,
    $_productMoney,
    $_activityId,
    $_activityName,
    $_activityYear,
    $_activityMoney,
    $_programId,
    $_programName,
    $_programYear,
    $_hospcode;

    public function setPlanId($id) {
        $this->_planId=$id;
    }

    public function setPlanName($name) {
        $this->_planName=$name;
    }

    public function setPlanYear($year) {
        $this->_planYear=$year;
    }

    public function setProductId($id) {
        $this->_productId=$id;
    }

    public function setProductName($name) {
        $this->_productName=$name;
    }

    public function setProductYear($year) {
        $this->_productYear=$year;
    }

    public function setProductMoney($money) {
        $this->_productMoney=$money;
    }

    public function setActivityId($id) {
        $this->_activityId=$id;
    }

    public function setActivityName($name) {
        $this->_activityName=$name;
    }

    public function setActivityYear($year) {
        $this->_activityYear=$year;
    }

    public function setActivityMoney($money) {
        $this->_activityMoney=$money;
    }

    public function setProgramId($id) {
        $this->_programId=$id;
    }

    public function setProgramName($name) {
        $this->_programName=$name;
    }

    public function setProgramYear($year) {
        $this->_programYear=$year;
    }

    public function setHospcode($hospcode) {
        $this->_hospcode=$hospcode;
    }

    // get Plan List
    public function getPlanList($year) {
        $this->db->select('*');
        $this->db->from($this->tblPlan);
        $this->db->where('plan_year', $year);
        $this->db->where('plan_status', '1');
        $this->db->order_by('plan_id', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    // create new Plan
    public function createPlan() {
        $data=array('plan_name'=> $this->_planName,
            'plan_year'=> $this->_planYear,
            'created'=> date("Y-m-d H:i:s"),
            'created_code'=> $this->_hospcode,
        );
        $this->db->insert($this->tblPlan, $data);
        return $this->db->insert_id();
    }

    // update Plan
    public function updatePlan() {
        $data=array('plan_name'=> $this->_planName,
            'plan_year'=> $this->_planYear,
            'modified'=> date("Y-m-d H:i:s"),
            'modified_code'=> $this->_hospcode,
        );
        $this->db->where('plan_id', $this->_planId);
        $this->db->update($this->tblPlan, $data);
    }

    // for view Plan
    public function getPlan() {
        $this->db->select('*');
        $this->db->from($this->tblPlan);
        $this->db->where('plan_id', $this->_planId);
        $query=$this->db->get();
        return $query->row();
    }

    // delete plan
    // public function deletePlan() {
    //     $this->db->where('plan_id', $this->_planId);
    //     $this->db->delete($this->tblPlan);
    // }

    // delete plan
    public function deletePlan() {
        $data=array('plan_status'=> '0',
            'modified'=> date("Y-m-d H:i:s"),
            'modified_code'=> $this->_hospcode,
        );
        $this->db->where('plan_id', $this->_planId);
        $this->db->update($this->tblPlan, $data);
    }


    // get Product List
    public function getProductList($year) {
        $this->db->select('*');
        $this->db->from($this->tblProduct);
        $this->db->where('product_year', $year);
        $this->db->where('product_status', '1');
        $this->db->order_by('product_id', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    // create new Product
    public function createProduct() {
        $data=array('plan_id'=> $this->_planId,
            'product_name'=> $this->_productName,
            'product_year'=> $this->_productYear,
            'created'=> date("Y-m-d H:i:s"),
            'created_code'=> $this->_hospcode,
        );
        $this->db->insert($this->tblProduct, $data);
        return $this->db->insert_id();
    }

    // update Product
    public function updateProduct() {
        $data=array('plan_id'=> $this->_planId,
            'product_name'=> $this->_productName,
            'product_year'=> $this->_productYear,
            'modified'=> date("Y-m-d H:i:s"),
            'modified_code'=> $this->_hospcode,
        );
        $this->db->where('product_id', $this->_productId);
        $this->db->update($this->tblProduct, $data);
    }

    // delete Activity
    public function deleteProduct() {
        $data=array('product_status'=> '0',
            'modified'=> date("Y-m-d H:i:s"),
            'modified_code'=> $this->_hospcode,
        );
        $this->db->where('product_id', $this->_productId);
        $this->db->update($this->tblProduct, $data);
    }


    // for view Plan
    public function getProduct() {
        $this->db->select('*');
        $this->db->from($this->tblProduct);
        $this->db->where('product_id', $this->_productId);
        $query=$this->db->get();
        return $query->row();
    }

    public function plan_name_full($id) {
        if($id !='') {
            $query=$this->db->get_where($this->tblPlan, array('plan_id'=> $id));
            $data=$query->result();
            return ($data[0]->plan_name);
        }

        else {
            return "";
        }
    }

    // create new activity
    public function createActivity() {
        $data=array('product_id'=> $this->_productId,
            'activity_name'=> $this->_activityName,
            'activity_year'=> $this->_activityYear,
            'activity_money'=> $this->_activityMoney,
            'created'=> date("Y-m-d H:i:s"),
            'created_code'=> $this->_hospcode,
        );
        $this->db->insert($this->tblActivity, $data);
        return $this->db->insert_id();
    }

    // update activity
    public function updateActivity() {
        $data=array('product_id'=> $this->_productId,
            'activity_name'=> $this->_activityName,
            'activity_year'=> $this->_activityYear,
            'activity_money'=> $this->_activityMoney,
            'modified'=> date("Y-m-d H:i:s"),
            'modified_code'=> $this->_hospcode,
        );
        $this->db->where('activity_id', $this->_activityId);
        $this->db->update($this->tblActivity, $data);
    }

    // delete Activity
    public function deleteActivity() {
        $data=array('activity_status'=> '0',
            'modified'=> date("Y-m-d H:i:s"),
            'modified_code'=> $this->_hospcode,
        );
        $this->db->where('activity_id', $this->_activityId);
        $this->db->update($this->tblActivity, $data);
    }

    // get activity List
    public function getActivityList($year) {
        $this->db->select('*');
        $this->db->from($this->tblActivity);
        $this->db->where('activity_year', $year);
        $this->db->where('activity_status', '1');
        $this->db->order_by('activity_id', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    // for view activity
    public function getActivity() {
        $this->db->select('*');
        $this->db->from($this->tblActivity);
        $this->db->where('activity_id', $this->_activityId);
        $query=$this->db->get();
        return $query->row();
    }

    public function moneyPlan($id) {
        $this->db->select_sum('activity_money');
        $this->db->from($this->tblPlan);
        $this->db->join($this->tblProduct, $this->tblProduct.'.plan_id = '.$this->tblPlan.'.plan_id', 'left');
        $this->db->join($this->tblActivity, $this->tblActivity.'.product_id = '.$this->tblProduct.'.product_id', 'left');
        $this->db->where('activity_status', '1');
        $this->db->where($this->tblPlan.'.plan_id =', $id);
        $query=$this->db->get();
        $data=$query->result();
        return ($data[0]->activity_money);
    }

    public function chargePlan($id) {
        $this->db->select_sum('activity_charge');
        $this->db->from($this->tblPlan);
        $this->db->join($this->tblProduct, $this->tblProduct.'.plan_id = '.$this->tblPlan.'.plan_id', 'left');
        $this->db->join($this->tblActivity, $this->tblActivity.'.product_id = '.$this->tblProduct.'.product_id', 'left');
        $this->db->where('activity_status', '1');
        $this->db->where($this->tblPlan.'.plan_id =', $id);
        $query=$this->db->get();
        $data=$query->result();
        return ($data[0]->activity_charge);
    }

    public function moneyProduct($id) {
        $this->db->select_sum('activity_money');
        $this->db->from($this->tblProduct);
        $this->db->join($this->tblActivity, $this->tblActivity.'.product_id = '.$this->tblProduct.'.product_id', 'left');
        $this->db->where('activity_status', '1');
        $this->db->where($this->tblProduct.'.product_id =', $id);
        $query=$this->db->get();
        $data=$query->result();
        return ($data[0]->activity_money);
    }

    public function chargeProduct($id) {
        $this->db->select_sum('activity_charge');
        $this->db->from($this->tblProduct);
        $this->db->join($this->tblActivity, $this->tblActivity.'.product_id = '.$this->tblProduct.'.product_id', 'left');
        $this->db->where('activity_status', '1');
        $this->db->where($this->tblProduct.'.product_id =', $id);
        $query=$this->db->get();
        $data=$query->result();
        return ($data[0]->activity_charge);
    }

    // get Program List
    public function getProgramList($year) {
        $this->db->select('*');
        $this->db->from($this->tblProgram);
        $this->db->where('program_year', $year);
        $this->db->where('program_status', '1');
        $this->db->order_by('program_id', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    // new Program
    public function createProgram() {
        $data=array('program_name'=> $this->_programName,
            'program_year'=> $this->_programYear,
            'created'=> date("Y-m-d H:i:s"),
            'created_code'=> $this->_hospcode,
        );
        $this->db->insert($this->tblProgram, $data);
        return $this->db->insert_id();
    }

    // update Program
    public function updateProgram() {
        $data=array('program_name'=> $this->_programName,
            'program_year'=> $this->_programYear,
            'modified'=> date("Y-m-d H:i:s"),
            'modified_code'=> $this->_hospcode,
        );
        $this->db->where('program_id', $this->_programId);
        $this->db->update($this->tblProgram, $data);
    }
    // update Program
    public function deleteProgram() {
        $data=array('program_status'=> '0',
            'modified'=> date("Y-m-d H:i:s"),
            'modified_code'=> $this->_hospcode,
        );
        $this->db->where('program_id', $this->_programId);
        $this->db->update($this->tblProgram, $data);
    }

    // for view Program
    public function getProgram() {
        $this->db->select('*');
        $this->db->from($this->tblProgram);
        $this->db->where('program_id', $this->_programId);
        $query=$this->db->get();
        return $query->row();
    }

    public function product_name_full($id) {
        if($id !='') {
            $query=$this->db->get_where($this->tblProduct, array('product_id'=> $id));
            $data=$query->result();
            return ($data[0]->product_name);
        }

        else {
            return "";
        }
    }


}