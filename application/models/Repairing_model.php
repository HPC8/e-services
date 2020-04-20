<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repairing_model extends CI_Model {

    function __construct() {
        $this->repairOrder='tbl_repairing_order';
        $this->repairType='tbl_repairing_type';
    }

    private $_repairID,
    $_hospcode;

    function getType() {
        $this->db->select('*');
        $this->db->from($this->repairType);
        $this->db->order_by('name', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }


}