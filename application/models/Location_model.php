<?php class Location_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->provinces='tbl_provinces';
        $this->amphures='tbl_amphures';
        $this->districts='tbl_districts';
        $this->zipcodes='tbl_zipcodes';
    }

    private $_provincesID;
    private $_amphurID;

    // set provinces id
    public function setProvincesID($provincesID) {
        return $this->_provincesID=$provincesID;
    }

    // set amphur id
    public function setAmphurID($amphurID) {
        return $this->_amphurID=$amphurID;
    }

    // get provinces method
    public function getAllProvinces() {
        $this->db->order_by("province_name", "ASC");
        $query=$this->db->get($this->provinces);
        return $query->result();
    }

    // get amphur method
    public function getAmphur() {
        $this->db->where('province_id', $this->_provincesID);
        $this->db->order_by("amphur_name", "ASC");
        $query=$this->db->get($this->amphures);
        return $query->result();
    }

    // get district method
    public function getDistrict() {
        $this->db->where('amphur_id', $this->_amphurID);
        $this->db->order_by("district_name", "ASC");
        $query=$this->db->get($this->districts);
        return $query->result();
    }

    // get name amphur method
    public function nameAmphur($id) {
        $query=$this->db->get_where($this->amphures, array('amphur_id'=> $id));
        $data=$query->result();
        return ($data[0]->amphur_name);
    }
    // get name amphur method
    public function nameDistrict($id) {
        $query=$this->db->get_where($this->districts, array('district_id'=> $id));
        $data=$query->result();
        return ($data[0]->district_name);
    }
}

?>