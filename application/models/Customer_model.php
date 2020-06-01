<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {

    function __construct() {
        $this->lineRegister='tbl_line_register';
        $this->lineFinger='tbl_line_finger';
        $this->employee='tbl_employee';
    }

    private $_cid,
    $_userId,
    $_fingerId,
    $_latitude,
    $_longitude;


    function setCid($cid) {
        $this->_cid=$cid;
    }

    function setUserId($userId) {
        $this->_userId=$userId;
    }

    function setFingerId($fingerId) {
        $this->_fingerId=$fingerId;
    }

    function setLatitude($latitude) {
        $this->_latitude=$latitude;
    }
    function setLongitude($longitude) {
        $this->_longitude=$longitude;
    }

    function checkCid($cid) {
        $this->db->where('cid =', $cid);
        $query=$this->db->get($this->employee);
        return $query->num_rows();
    }

    function countCid($cid) {
        $this->db->where('cid =', $cid);
        $query=$this->db->get($this->lineRegister);
        return $query->num_rows();
    }

    function createUserId() {
        $data=array('cid'=> $this->_cid,
            'lineUserId'=> $this->_userId,
            'date'=> date("Y-m-d H:i:s"),
        );

        $this->db->insert($this->lineRegister, $data);
        return $this->db->insert_id();
    }

    function checkUserId($userId) {
        $this->db->where('lineUserId =', $userId);
        $query=$this->db->get($this->lineRegister);
        return $query->num_rows();
    }

    function checkIn($userId) {
        $this->db->where('lineUserId =', $userId);
        $this->db->where('date =', date("Y-m-d"));
        $this->db->where('checkIn !=', NULL);
        $query=$this->db->get($this->lineFinger);
        return $query->num_rows();
    }

    function checkOut($userId) {
        $this->db->where('lineUserId =', $userId);
        $this->db->where('date =', date("Y-m-d"));
        $this->db->where('checkOut !=', NULL);
        $query=$this->db->get($this->lineFinger);
        return $query->num_rows();
    }

    function createCheckIn() {
        $data=array('lineUserId'=> $this->_userId,
            'date'=> date("Y-m-d"),
            'checkIn'=> date("Y-m-d H:i:s"),
            'latIn'=> $this->_latitude,
            'lngIn'=> $this->_longitude,
        );

        $this->db->insert($this->lineFinger, $data);
        return $this->db->insert_id();
    }

    function checkOutId($userId) {
        $this->db->select('*');
        $this->db->from($this->lineFinger);
        $this->db->where('lineUserId =', $userId);
        $this->db->where('date =', date("Y-m-d"));
        $query=$this->db->get();
        return $query->result();
    }

    function createCheckOut() {
        $data=array('checkOut'=> date("Y-m-d H:i:s"),
            'latOut'=> $this->_latitude,
            'lngOut'=> $this->_longitude,
            'status'=> '0',
        );
        $this->db->where('id', $this->_fingerId);
        $this->db->update($this->lineFinger, $data);
    }

}