<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repairing_model extends CI_Model {

    function __construct() {
        $this->repairOrder='tbl_repairing_order';
        $this->repairType='tbl_repairing_type';
    }

    private $_repairID,
    $_hospcode,
    $_type,
    $_serial,
    $_detail,
    $_doc;

    function setHospcode($hospcode) {
        $this->_hospcode=$hospcode;
    }
    function setRepairType($type) {
        $this->_type=$type;
    }
    function setRepairSerial($serial) {
        $this->_serial=$serial;
    }
    function setRepairDetail($detail) {
        $this->_detail=$detail;
    }
    function setRepairDoc($doc) {
        $this->_doc=$doc;
    }

    function getType() {
        $this->db->select('*');
        $this->db->from($this->repairType);
        $this->db->order_by('name', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    function count_all_year($year) {
        $this->db->select('id');
        $this->db->from($this->repairOrder);
        $this->db->or_like('order_doc', $year);
        $query=$this->db->get();
        return $query->num_rows();
    }

    function createRepair() {
        $data=array('order_doc'=> $this->_doc,
            'hospcode'=> $this->_hospcode,
            'created'=> date("Y-m-d H:i:s"),
            'type'=> $this->_type,
            'serial'=> $this->_serial,
            'description'=> $this->_detail,

        );
        $this->db->insert($this->repairOrder, $data);
        return $this->db->insert_id();
    }

    function getOrders() {
        $this->db->select('*');
        $this->db->from($this->repairOrder);
        $this->db->order_by('id', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }

    public function dataInfo($id) {
        $query=$this->db->get_where($this->repairOrder, array('id'=> $id));
        return $query->result();
    }

    function returnType($id) {
        if($id !='') {
            $query=$this->db->get_where($this->repairType, array('id'=> $id));
            $data=$query->result();
            return ($data[0]->name);
        }

        else {
            return "";
        }
    }

    function checkStatus($status) {
        if($status==1) {
            return $status='<span class="label label-sm label-warning arrowed arrowed-right"><i class="fa fa-spinner"> รอดำเนินการ</i></span>';
        }

        elseif($status==2) {
            return $status='<span class="label label-sm label-primary arrowed arrowed-right"><i class="fa fa-spinner"> กำลังดำเนินการซ่อม</i></span>';
        }

        elseif($status==3) {
            return $status='<span class="label label-sm label-grey arrowed arrowed-right"><i class="fa fa-spinner"> รออะไหล่</i></span>';
        }

        elseif($status==4) {
            return $status='<span class="label label-sm label-info arrowed arrowed-right"><i class="fa fa-paper-plane-o"> ส่งศูนย์บริการ</i></span>';
        }

        elseif($status==5) {
            return $status='<span class="label label-sm label-success arrowed arrowed-right"><i class="fa fa-check"> เสร็จแล้ว</i></span>';
        }

        else {
            return $status='<span class="label label-sm label-pink arrowed arrowed-right"><i class="fa fa-sign-out"> ยกเลิก</i></span>';
        }
    }
    


}