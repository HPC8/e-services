<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_model extends CI_Model {

    function __construct() {
        $this->stoTable='tbl_stock';
        $this->custTable='view_employee';
        $this->ordTable='tbl_stock_orders';
        $this->ordItemsTable='tbl_stock_order_items';
        $this->stoGroup='tbl_stock_group';
        $this->stoCategory='tbl_stock_category';
    }

    private $_name,
    $_qty,
    $_unit,
    $_group,
    $_category,
    $_hospcode,
    $_path,
    $_upload,
    $_StockId;

    function setHospcode($hospcode) {
        $this->_hospcode=$hospcode;
    }

    function setNmae($name) {
        $this->_name=$name;
    }

    function setQty($qty) {
        $this->_qty=$qty;
    }

    function setUnit($unit) {
        $this->_unit=$unit;
    }

    function setGroup($group) {
        $this->_group=$group;
    }

    function setCategory($category) {
        $this->_category=$category;
    }

    function setPath($path) {
        $this->_path=$path;
    }

    function setUpload($upload) {
        $this->_upload=$upload;
    }

    function setStockId($id) {
        $this->_StockId=$id;
    }


    function getRows($id='') {
        $this->db->select('*');
        $this->db->from($this->stoTable);
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

    function getStockList($id='') {
        $this->db->select('*');
        $this->db->from($this->stoTable);
        // $this->db->join($this->stoGroup, $this->stoGroup.'.id = '.$this->stoTable.'.group', 'left');
        // $this->db->where('quantity >', 0);
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

    function getOrders() {
        $this->db->select('*');
        $this->db->from($this->ordTable);
        $this->db->order_by('id', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }

    function getMyOrders($hospcode) {
        $this->db->select('*');
        $this->db->from($this->ordTable);
        $this->db->where('hospcode', $hospcode);
        $this->db->order_by('id', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }

    function insertCustomer($data) {

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
    function insertOrder($data) {

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
    function insertOrderItems($data=array()) {

        // Insert order items
        $insert=$this->db->insert_batch($this->ordItemsTable, $data);

        // Return the status
        return $insert?true: false;
    }

    function count_all_year($year) {
        $this->db->select('id');
        $this->db->from($this->ordTable);
        $this->db->or_like('order_doc', $year);
        $query=$this->db->get();
        return $query->num_rows();
    }

    function checkStatus($status) {
        if($status==1) {
            return $status='<span class="label label-sm label-warning arrowed arrowed-right"><i class="fa fa-spinner"> รอหัวหน้ากลุ่มอนุมัติ</i></span>';
        }

        elseif($status==2) {
            return $status='<span class="label label-sm label-primary arrowed arrowed-right"><i class="fa fa-spinner"> รอหัวหน้าหน่วยพัสดุอนุมัติ</i></span>';
        }

        elseif($status==3) {
            return $status='<span class="label label-sm label-grey arrowed arrowed-right"><i class="fa fa-spinner"> รอจ่าย</i></span>';
        }

        elseif($status==4) {
            return $status='<span class="label label-sm label-info arrowed arrowed-right"><i class="fa fa-paper-plane-o"> จ่ายแล้ว</i></span>';
        }

        elseif($status==5) {
            return $status='<span class="label label-sm label-success arrowed arrowed-right"><i class="fa fa-check"> รับของแล้ว</i></span>';
        }

        elseif($status==6) {
            return $status='<span class="label label-sm label-danger arrowed arrowed-right"><i class="fa fa-times"> หัวหน้ากลุ่มไม่อนุมัติ</i></span>';
        }

        elseif($status==7) {
            return $status='<span class="label label-sm label-danger arrowed arrowed-right"><i class="fa fa-times"> หัวหน้าหน่วยพัสดุไม่อนุมัติ</i></span>';
        }

        else {
            return $status='<span class="label label-sm label-pink arrowed arrowed-right"><i class="fa fa-sign-out"> ยกเลิก</i></span>';
        }
    }

    function getDetail($id) {
        $query=$this->db->get_where($this->ordTable, array('id'=> $id));
        return $query->result();
    }


    function getOrdItem($id, $product_id) {
        $query=$this->db->get_where($this->ordItemsTable, array('order_id'=> $id, 'product_id'=> $product_id));
        return $query->result();
    }

    function getStock($id) {
        $query=$this->db->get_where($this->stoTable, array('id'=> $id));
        return $query->result();
    }


    function countQuantity($id) {
        $this->db->select_sum('quantity');
        $this->db->from($this->ordItemsTable);
        $this->db->where('order_id', $id);
        $query=$this->db->get();
        $data=$query->result();
        return ($data[0]->quantity);
    }

    function returnGroup($id) {
        if($id !='') {
            $query=$this->db->get_where($this->stoGroup, array('id'=> $id));
            $data=$query->result();
            return ($data[0]->name);
        }

        else {
            return "";
        }
    }

    function returnCategory($id) {
        if($id !='') {
            $query=$this->db->get_where($this->stoCategory, array('id'=> $id));
            $data=$query->result();
            return ($data[0]->name);
        }

        else {
            return "";
        }
    }

    function getGroup() {
        $this->db->select('*');
        $this->db->from($this->stoGroup);
        $this->db->order_by('name', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    function getCategory() {
        $this->db->select('*');
        $this->db->from($this->stoCategory);
        $this->db->order_by('name', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    function createStock() {
        $data=array('name'=> $this->_name,
            'quantity'=> $this->_qty,
            'unit'=> $this->_unit,
            'group'=> $this->_group,
            'category'=> $this->_category,
            'path'=> $this->_path,
            'image'=> $this->_upload,
            'created'=> date("Y-m-d H:i:s"),
            'add_by'=> $this->_hospcode,
        );
        $this->db->insert($this->stoTable, $data);
        return $this->db->insert_id();
    }

    function stockInfo() {
        $this->db->select('*');
        $this->db->from($this->stoTable);
        $this->db->where('id', $this->_StockId);
        $query=$this->db->get();
        return $query->row();
    }

    // delete Stock
    function delStock() {
        $data=array('status'=> '0',
            'modified'=> date("Y-m-d H:i:s"),
            'edit_by'=> $this->_hospcode,
        );
        $this->db->where('id', $this->_StockId);
        $this->db->update($this->stoTable, $data);
    }



}