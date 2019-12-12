<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'my_date', 'upload'));
        // Load helper
        $this->load->helper(array('url', 'html', 'form'));
        // Load model
        $this->load->model(array('user_model', 'employee_model', 'posts_model'));
        // Per page limit
        $this->perPage=5;
    }

    public function index() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ข่าวประชาสัมพันธ์';
            $breadcrumb=array("Home"=> "/e-services/",
                "ข่าวประชาสัมพันธ์"=> "/e-services/posts/"
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['postTitle']=$this->posts_model->getTitle();
            $data['postInfo']=$this->posts_model->getPostList();
                $this->template->load('layout/template', 'posts/index', $data);
        }

        else {
            redirect('users/login');
        }
    }

    function do_upload() {
        
        $config['upload_path']='./assets/uploads/posts/';
        $config['allowed_types']='gif|jpg|jpeg|png|zip|doc|docx|xls|xlsx|ppt|pptx|csv|odt|odp|pdf';
        $config['max_size']=1024*5;
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);
       // $img=$_FILES['post_uplfile']['name'];
        //Check if file was uploaded
        if ( !$this->upload->do_upload('post_uplfile')) {
            //$data['error']=$this->upload->display_errors();
            //$json['error']['uplfile'] = $this->upload->display_errors();
            //print_r($data);
        }
        else {
            //Uploaded Completed
            $data=$this->upload->data();
            $name_file=$data['file_name'];
            $path ='assets/uploads/posts/';
            $this->posts_model->setPath($path);
            $this->posts_model->setUpload($name_file);
            //print_r($name_file);
        }
    }

    public function savePost() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $post_title_id=$this->input->post('post_title_id');
            $post_content=$this->input->post('post_content');
            $this->posts_model->setHospcode($data['user']['hospcode']);

            if(empty(trim($post_title_id))) {
                $json['error']['title-id']='กรุณาเลือก';
            }
            if(empty($post_content)) {
                $json['error']['content']='กรุณากรอกข้อมูล';
            }

           // print_r($post_content);

            if(empty($json['error'])) {
                $this->posts_model->setTitleId($post_title_id);
                $this->posts_model->setContent($post_content);
                $this->do_upload();

                try {
                    $last_id=$this->posts_model->createPost();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }

                // if ( !empty($last_id) && $last_id > 0) {
                //     $postId=$last_id;
                //     $this->posts_model->setPostId($postId);
                //     $postInfo=$this->posts_model->getPost();

                //     $json['id']=$postInfo->id;
                //     $json['title_id']=$postInfo->title_id;
                //     $json['content']=$postInfo->content;
                //     //$json['upload']=$postInfo->upload;
                // }
            }

            echo json_encode($json);

        }

        else {
            redirect('users/login');
        }
    }

}