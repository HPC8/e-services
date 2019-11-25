<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {

    function __construct() {
        $this->proTable='tbl_products';
        $this->custTable='view_employee';
        $this->ordTable='tbl_product_orders';
        $this->ordItemsTable='tbl_product_order_items';
        $this->statusProd='tbl_status_prod';
        $this->viewItem='view_product_items';
        $this->serialNo='tbl_serial_number';
        $this->upointTable='tbl_product_upoint';
    }

    /*
     * Fetch products data from the database
     * @param id returns a single record if specified, otherwise all records
     */
    public function getRows($id='') {
        $this->db->select('*');
        $this->db->from($this->proTable);
        $this->db->where('quantity >', 0);
        $this->db->where('status', '1');

        if($id) {
            $this->db->where('id', $id);
            $query=$this->db->get();
            $result=$query->row_array();
        }

        else {
            $this->db->order_by('name', 'asc');
            $query=$this->db->get();
            $result=$query->result();
        }

        // Return fetched data
        return !empty($result)?$result:false;
    }

    public function getOrders() {
        $this->db->select('*');
        $this->db->from($this->ordTable);
        $this->db->order_by('id', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }

    public function getMyOrders($hospcode) {
        $this->db->select('*');
        $this->db->from($this->ordTable);
        $this->db->where('hospcode', $hospcode);
        $this->db->order_by('id', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }

    public function insertCustomer($data) {

        // Add created and modified date if not included
        if( !array_key_exists("created", $data)) {
            $data['created']=date("Y-m-d H:i:s");
        }

        if( !array_key_exists("modified", $data)) {
            $data['modified']=date("Y-m-d H:i:s");
        }

        // Insert customer data
        $insert=$this->db->insert($this->custTable, $data);

        // Return the status
        return $insert?$this->db->insert_id():false;
    }

    /*
     * Insert order data in the database
     * @param data array
     */
    public function insertOrder($data) {

        // Add created and modified date if not included
        if( !array_key_exists("created", $data)) {
            $data['created']=date("Y-m-d H:i:s");
        }

        if( !array_key_exists("modified", $data)) {
            $data['modified']=date("Y-m-d H:i:s");
        }

        // Insert order data
        $insert=$this->db->insert($this->ordTable, $data);

        // Return the status
        return $insert?$this->db->insert_id():false;
    }

    /*
     * Insert order items data in the database
     * @param data array
     */
    public function insertOrderItems($data=array()) {

        // Insert order items
        $insert=$this->db->insert_batch($this->ordItemsTable, $data);

        // Return the status
        return $insert?true: false;
    }

    public function count_all_year($year) {
        $this->db->select('id');
        $this->db->from($this->ordTable);
        $this->db->or_like('order_doc', $year);
        $query=$this->db->get();
        return $query->num_rows();
    }

    public function checkStatus($status) {
        if($status==1) {
            return $status='<span class="label label-sm label-warning arrowed arrowed-right"><i class="fa fa-spinner"> รอการอนุมัติ</i></span>';
        }

        elseif($status==2) {
            return $status='<span class="label label-sm label-success arrowed arrowed-right"><i class="fa fa-check"> อนุมัติ</i></span>';
        }

        elseif($status==3) {
            return $status='<span class="label label-sm label-info arrowed arrowed-right"><i class="fa fa-paper-plane-o"> นำจ่าย</i></span>';
        }

        elseif($status==4) {
            return $status='<span class="label label-sm label-purple arrowed arrowed-right"><i class="fa fa-repeat"> รับคืน</i></span>';
        }

        elseif($status==5) {
            return $status='<span class="label label-sm label-danger arrowed arrowed-right"><i class="fa fa-times"> ไม่อนุมัติ</i></span>';
        }

        else {
            return $status='<span class="label label-sm label-pink arrowed arrowed-right"><i class="fa fa-sign-out"> ยกเลิก</i></span>';
        }
    }

    public function getDetail($id) {
        $query=$this->db->get_where($this->ordTable, array('id'=> $id));
        return $query->result();
    }

    public function getItems($id) {
        $query=$this->db->get_where($this->viewItem, array('order_id'=> $id));
        return $query->result();
    }

    public function getStatus() {
        $query=$this->db->get_where($this->statusProd, array('status'=> '1'));
        return $query->result();
    }

    public function getSerial() {
        $query=$this->db->get_where($this->serialNo, array('status'=> '1'));
        return $query->result();
    }

    public function getOrdItem($id, $product_id) {
        $query=$this->db->get_where($this->ordItemsTable, array('order_id'=> $id, 'product_id'=> $product_id));
        return $query->result();
    }

    public function getProduct($id) {
        $query=$this->db->get_where($this->proTable, array('id'=> $id));
        return $query->result();
    }

    public function getUpoint($hospcode) {
        $query=$this->db->get_where($this->upointTable, array('hospcode'=> $hospcode));
        return $query->result();
    }

    public function countQuantity($id) {
        $this->db->select_sum('quantity');
        $this->db->from($this->ordItemsTable);
        $this->db->where('order_id', $id);
        $query=$this->db->get();
        $data=$query->result();
        return ($data[0]->quantity);
    }
}