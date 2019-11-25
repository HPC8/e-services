<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts_model extends CI_Model {

    function __construct() {
        $this->tblPost='tbl_posts';
        $this->tblTitle='tbl_posts_title';
    }

    private $_postId,
    $_titleId,
    $_content,
    $_hospcode,
    $_upload,
    $_path;

    public function setPostId($post_id) {
        $this->_postId=$post_id;
    }
    public function setTitleId($post_title_id) {
        $this->_titleId=$post_title_id;
    }
    public function setContent($post_content) {
        $this->_content=$post_content;
    }
    public function setUpload($upload) {
        $this->_upload = $upload;
    }
    public function setPath($path) {
        $this->_path = $path;
    }
    public function setHospcode($hospcode) {
        $this->_hospcode=$hospcode;
    }

    // getPostList List Left Join
    public function getPostList() {
        $this->db->select('*');
        $this->db->from($this->tblPost);
        $this->db->join($this->tblTitle, $this->tblTitle.'.title_id = '.$this->tblPost.'.title_id', 'left');
        $this->db->order_by('id', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    // getPost Left Join
    public function getPost() {
        $this->db->select('*');
        $this->db->from($this->tblPost);
        $this->db->join($this->tblTitle, $this->tblTitle.'.title_id = '.$this->tblPost.'.title_id', 'left');
        $this->db->where('id', $this->_postId);
        $query=$this->db->get();
        return $query->row();
    }

    public function maxId() {
        $this->db->select_max('id');
        $query=$this->db->get($this->tblPost);
        return $query->row();
    }

    public function getTitle() {
        $this->db->select('*');
        $this->db->from($this->tblTitle);
        $this->db->order_by('title_id', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    public function createPost() {
        $data=array('title_id'=> $this->_titleId,
            'content'=> $this->_content,
            'attached' => $this->_upload,
            'path' => $this->_path,
            'created'=> date("Y-m-d H:i:s"),
            'hospcode'=> $this->_hospcode,
        );
        $this->db->insert($this->tblPost, $data);
        return $this->db->insert_id();
    }


}