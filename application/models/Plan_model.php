<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan_model extends CI_Model {

    function __construct() {
        $this->tblTrain='tbl_plan_train';
        $this->tblTrainUser='tbl_plan_train_user';
        $this->tblTrainExpenses='tbl_plan_train_expenses';
        $this->tblTrainMission='tbl_plan_train_mission';
        $this->tblEmp='tbl_employee';


    }

    private $_hospcode,
    $_letter,
    $_create,
    $_report,
    $_subject,
    $_location,
    $_form,
    $_datestart,
    $_dateend,
    $_travelstart,
    $_travelend,
    $_traindoc,
    $_trainId,
    $_trainUserId,
    $_userStatus,
    $_userDoc;


    public function setHospcode($code) {
        $this->_hospcode=$code;
    }

    public function setLetter($letter) {
        $this->_letter=$letter;
    }

    public function setDateCreate($create) {
        $this->_create=$create;
    }

    public function setReport($report) {
        $this->_report=$report;
    }

    public function setSubject($subject) {
        $this->_subject=$subject;
    }

    public function setLocation($location) {
        $this->_location=$location;
    }

    public function setForm($form) {
        $this->_form=$form;
    }

    public function setDateStart($date_start) {
        $this->_datestart=$date_start;
    }

    public function setDateEnd($date_end) {
        $this->_dateend=$date_end;
    }

    public function setTravelStart($travel_start) {
        $this->_travelstart=$travel_start;
    }

    public function setTravelEnd($travel_end) {
        $this->_travelend=$travel_end;
    }

    public function setTrainDoc($traindoc) {
        $this->_traindoc=$traindoc;
    }

    public function setTrainId($id) {
        $this->_trainId=$id;
    }

    public function setTrainUserId($id) {
        $this->_trainUserId=$id;
    }

    public function setUserStatus($userStatus) {
        $this->_userStatus=$userStatus;
    }

    public function setUserDoc($userDoc) {
        $this->_userDoc=$userDoc;
    }


    public function countYear($year) {
        $this->db->select('id');
        $this->db->from($this->tblTrain);
        $this->db->or_like('train_doc', $year);
        $query=$this->db->get();
        return $query->num_rows();
    }

    // create new Train
    public function createTrain() {
        $data=array('letter'=> $this->_letter,
            'date_create'=> $this->_create,
            'hospcode'=> $this->_hospcode,
            'report'=> $this->_report,
            'subject'=> $this->_subject,
            'location'=> $this->_location,
            'form'=> $this->_form,
            'date_start'=> $this->_datestart,
            'date_end'=> $this->_dateend,
            'travel_start'=> $this->_travelstart,
            'travel_end'=> $this->_travelend,
            'create'=> date("Y-m-d H:i:s"),
            'train_doc'=> $this->_traindoc,
        );
        $this->db->insert($this->tblTrain, $data);
        return $this->db->insert_id();
    }

    public function updateTrain() {
        $data=array('letter'=> $this->_letter,
            'date_create'=> $this->_create,
            'hospcode'=> $this->_hospcode,
            'report'=> $this->_report,
            'subject'=> $this->_subject,
            'location'=> $this->_location,
            'form'=> $this->_form,
            'date_start'=> $this->_datestart,
            'date_end'=> $this->_dateend,
            'travel_start'=> $this->_travelstart,
            'travel_end'=> $this->_travelend,
            'modified'=> date("Y-m-d H:i:s"),
        );
        $this->db->where('id', $this->_trainId);
        $this->db->update($this->tblTrain, $data);
    }

    public function confirmTrain() {
        $data=array('status'=> '2',
            'modified'=> date("Y-m-d H:i:s"),
        );
        $this->db->where('id', $this->_trainId);
        $this->db->update($this->tblTrain, $data);
    }


    public function updateTrainExpenses($expenses) {
        $this->db->where('train_id', $this->_trainId);
        $this->db->update($this->tblTrainExpenses, $expenses);
        return TRUE;
    }

    public function insertTrainUser($data) {
        $this->db->insert($this->tblTrainUser, $data);
        return TRUE;
    }

    public function insertTrainExpenses($data) {
        $this->db->insert($this->tblTrainExpenses, $data);
        return TRUE;
    }

    public function tblTrain() {
        $this->db->select('*');
        $this->db->from($this->tblTrain);
        $this->db->where('id', $this->_trainId);
        $query=$this->db->get();
        return $query->row();
    }

    public function tblTrainUser() {
        $this->db->select('*');
        $this->db->from($this->tblTrainUser);
        $this->db->where('train_id', $this->_trainId);
        $query=$this->db->get();
        return $query->result();
        //return $query->row();
    }

    public function tblTrainExpenses() {
        $this->db->select('*');
        $this->db->from($this->tblTrainExpenses);
        $this->db->where('train_id', $this->_trainId);
        $query=$this->db->get();
        //return $query->result();
        return $query->row();
    }

    public function tblTrainMission() {
        $this->db->select('*');
        $this->db->from($this->tblTrainMission);
        $query=$this->db->get();
        return $query->result();
    }

    public function deleteTrinUser() {
        $this->db->where('id', $this->_trainUserId);
        $this->db->delete($this->tblTrainUser);
    }

    public function addTrinUser() {
        $data=array('train_id'=> $this->_trainId,
            'hospcode'=> $this->_hospcode,
            'status'=> $this->_userStatus,
            'doc'=> $this->_userDoc);
        $this->db->insert($this->tblTrainUser, $data);
        return $this->db->insert_id();
    }

    public function checkTrainUser() {
        $this->db->select('*');
        $this->db->from($this->tblTrainUser);
        $this->db->where('train_id', $this->_trainId);
        $this->db->where('hospcode', $this->_hospcode);
        $query=$this->db->get();
        return $query->row();
    }

    public function getUserMission($id) {
        $query=$this->db->get_where($this->tblTrainMission, array('id'=> $id));
        $data=$query->result();
        return ($data[0]->name);
    }

    public function trainReport() {
        $this->db->select('*');
        $this->db->from($this->tblTrainUser);
        $this->db->join($this->tblEmp, $this->tblEmp.'.hospcode = '.$this->tblTrainUser.'.hospcode', 'left');
        $this->db->where($this->tblTrainUser.'.train_id =', $this->_trainId);
        $query=$this->db->get();
        return $query->result();
    }

    public function getTrain() {
        $this->db->select('*');
        $this->db->from($this->tblTrain);
        $this->db->order_by('id', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }

    public function checkStatus($status) {
        if($status==1) {
            return $status='<span class="label label-sm label-warning arrowed arrowed-right"><i class="fa fa-spinner"> บันทึกข้อมูล</i></span>';
        }

        elseif($status==2) {
            return $status='<span class="label label-sm label-success arrowed arrowed-right"><i class="fa fa-check"> รอตรวจแผน</i></span>';
        }

        elseif($status==3) {
            return $status='<span class="label label-sm label-info arrowed arrowed-right"><i class="fa fa-paper-plane-o"> เงินรอตรวจสอบ</i></span>';
        }

        elseif($status==4) {
            return $status='<span class="label label-sm label-purple arrowed arrowed-right"><i class="fa fa-repeat"> รออนุมัติ</i></span>';
        }

        elseif($status==5) {
            return $status='<span class="label label-sm label-danger arrowed arrowed-right"><i class="fa fa-times"> ไม่อนุมัติ</i></span>';
        }

        else {
            return $status='<span class="label label-sm label-pink arrowed arrowed-right"><i class="fa fa-sign-out"> ยกเลิก</i></span>';
        }
    }




}