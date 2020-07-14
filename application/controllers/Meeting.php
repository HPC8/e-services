<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('form_validation', 'session', 'my_library', 'my_date', 'thaidate'));
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model(array('user_model', 'employee_model', 'meeting_model'));
    }

    public function index() {
        redirect('meeting/view/');
    }

    public function create() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['meeting_room']=$this->meeting_model->getMeetingroom();
            $data['page_title']='จองห้องประชุม';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบห้องประชุม"=> "/e-services/meeting/",
                "จองห้องประชุม"=> ""
            );
            $data['breadcrumb']=$breadcrumb;

            $this->template->load('layout/template', 'meeting/create', $data);
        }

        else {
            redirect('users/login');
        }
    }

    public function view() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='รายการจองห้องประชุม';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบห้องประชุม"=> "/e-services/meeting/",
                "รายการจองห้องประชุม"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['query']=$this->meeting_model->view_meeting();
            $data['mydate']=$this->my_date;

            $this->template->load('layout/template', 'meeting/view', $data);

        }

        else {
            redirect('users/login');
        }
    }

    public function calendar() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='ปฏิทินจองห้องประชุม';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบห้องประชุม"=> "/e-services/meeting/",
                "ปฏิทินจองห้องประชุม"=> ""
            );
            $data['breadcrumb']=$breadcrumb;

            $this->template->load('layout/template', 'meeting/calendar', $data);
        }

        else {
            redirect('users/login');
        }
    }

    public function getCalender() {
        $data_events=$this->meeting_model->getCalender();
        $calendar=array();

        foreach ($data_events as $key=> $val) {
            $time1=substr($val->book_start, 11, 5);
            $time2=substr($val->book_end, 11, 5);
            $calendar[]=array( //'id' 	=> intval($val->id), 
                'title'=> $time1." ถึง ".$time2." ".$val->name_meeting,
                'start'=> $val->book_start,
                'end'=> $val->book_end,
                'description'=> $val->meeting_doc." #".$val->detail." @".$val->section_name.$val->customer_company,
                'color'=> $val->event_color,
            );
        }

        echo json_encode($calendar);
    }

    public function post_validate() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['meeting_room']=$this->meeting_model->getMeetingroom();
            $data['page_title']='จองห้องประชุม';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบห้องประชุม"=> "/e-services/meeting/",
                "จองห้องประชุม"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mydate']=$this->my_date;
            $data['thaidate']=$this->thaidate;

            $book_start=$this->input->post('book_start')." ".$this->input->post('time_start').":00";
            $book_end=$this->input->post('book_end')." ".$this->input->post('time_end').":00";
            $meeting_room=$this->input->post('meeting_room');

            if($book_end >=$book_start) {
                $count_query=$this->meeting_model->count_meeting($meeting_room, $book_start, $book_end);
                $event_query=$this->meeting_model->checkEvent($meeting_room);
                $data['nameMeeting']=$event_query['nameMeeting'];
                $data['event_color']=$event_query['event_color'];

                if($count_query > 0) {
                    $time_start=substr($book_start, 11, 5);
                    $time_stop=substr($book_end, 11, 5);

                    if($data['thaidate']->fullmonth($book_start)==$data['thaidate']->fullmonth($book_end)) {
                        $popup=array('msg'=> 1,
                            'detail'=> $data['nameMeeting'].' วันที่ '.$data['thaidate']->thai_date_and_time($book_start).' ถึง '.$time_stop.' น. ไม่ว่างกรุณาเลือกช่วงเวลาใหม่ด้วยครับ',
                        );
                        $this->session->set_userdata($popup);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> $data['nameMeeting'].' วันที่ '.$data['thaidate']->thai_date_and_time($book_start).' ถึง '.$data['thaidate']->thai_date_and_time($book_end).' น. ไม่ว่างกรุณาเลือกช่วงเวลาใหม่ด้วยครับ',
                        );
                        $this->session->set_userdata($popup);
                    }

                    redirect('meeting/create/');
                }

                else {
                    // $date_y=$this->my_date->fiscal_year(date("Y-m-d H:i:s"));
                    // $meeting_doc=$this->db->count_all('tbl_meeting_book');
                    $year=$this->thaidate->thaiyear(date("Y-m-d"));
                    $count=$this->meeting_model->count_all_year($year);
                    $data=array('meeting_doc'=> $year."/".($count+1),
                        'hospcode'=> $this->input->post('inputhospcode'),
                        'meeting_room'=> $meeting_room,
                        'meeting_date'=> date("Y-m-d H:i:s"),
                        'update'=> date("Y-m-d H:i:s"),
                        'detail'=> $this->input->post('detail'),
                        'book_start'=> $book_start,
                        'book_end'=> $book_end,
                        'event_color'=> $data['event_color'],
                    );
                    $insert=$this->meeting_model->insert_meeting($data);

                    if ($insert) {
                        $data['insert_id']=$this->db->insert_id();
                        redirect('email/meeting/'.$data['insert_id'].'/'.$sms=1);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'ระบบไม่สามารถทำการบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ',
                        );
                        $this->session->set_userdata($popup);
                        redirect('meeting/create/');
                    }
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'วันที่และช่วงเวลาสิ้นสุดการประชุมไม่ถูกต้อง กรุณาทำรายการใหม่ด้วยครับ',
                );
                $this->session->set_userdata($popup);
                redirect('meeting/create/');
            }
        }

        else {
            redirect('users/login');
        }
    }

    public function update_data($id) {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['meeting_room']=$this->meeting_model->getMeetingroom();
            $data['page_title']='จองห้องประชุม';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบห้องประชุม"=> "/e-services/meeting/",
                "จองห้องประชุม"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mydate']=$this->my_date;
            $data['thaidate']=$this->thaidate;

            $book_start=$this->input->post('book_start')." ".$this->input->post('time_start').":00";
            $book_end=$this->input->post('book_end')." ".$this->input->post('time_end').":00";
            $meeting_room=$this->input->post('meeting_room');

            if($book_end >=$book_start) {
                $count_query=$this->meeting_model->count_meeting($meeting_room, $book_start, $book_end);
                $event_query=$this->meeting_model->checkEvent($meeting_room);
                $data['nameMeeting']=$event_query['nameMeeting'];
                $data['event_color']=$event_query['event_color'];

                if($count_query > 0) {
                    $time_start=substr($book_start, 11, 5);
                    $time_stop=substr($book_end, 11, 5);

                    if($data['thaidate']->fullmonth($book_start)==$data['thaidate']->fullmonth($book_end)) {
                        $popup=array('msg'=> 1,
                            'detail'=> $data['nameMeeting'].' วันที่ '.$data['thaidate']->thai_date_and_time($book_start).' ถึง '.$time_stop.' น. ไม่ว่างกรุณาเลือกช่วงเวลาใหม่ด้วยครับ',
                        );
                        $this->session->set_userdata($popup);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> $data['nameMeeting'].' วันที่ '.$data['thaidate']->thai_date_and_time($book_start).' ถึง '.$data['thaidate']->thai_date_and_time($book_end).' น. ไม่ว่างกรุณาเลือกช่วงเวลาใหม่ด้วยครับ',
                        );
                        $this->session->set_userdata($popup);
                    }

                    $this->session->set_userdata($popup);
                    redirect('meeting/edit/'.$id);
                }

                else {
                    $data=array('meeting_room'=> $meeting_room,
                        'update'=> date("Y-m-d H:i:s"),
                        'detail'=> $this->input->post('detail'),
                        'book_start'=> $book_start,
                        'book_end'=> $book_end,
                        'event_color'=> $data['event_color'],
                    );

                    $this->db->where('id', $id);
                    $this->db->update('tbl_meeting_book', $data);
                    redirect('email/meeting/'.$id.'/'.$sms=2);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'วันที่และช่วงเวลาสิ้นสุดการประชุมไม่ถูกต้อง กรุณาทำรายการใหม่ด้วยครับ',
                );
                $this->session->set_userdata($popup);
                redirect('meeting/edit/'.$id);
            }
        }

        else {
            redirect('users/login');
        }
    }

    public function detail($id) {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='รายการจองห้องประชุม';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบห้องประชุม"=> "/e-services/meeting/",
                "รายการจองห้องประชุม"=> "/e-services/meeting/view/",
                "รายละเอียด"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['mydate']=$this->my_date;
            $data['detail']=$this->meeting_model->getDetail($id);
            $data['admin_level']=$this->user_model->getUser_mtg($data['user']['hospcode']);
            $data['status']=$this->meeting_model->getStatus();


            if ( !empty($data['admin_level'])) {
                if($data['admin_level'][0]->level=="1") {
                    //$this->template->load('layout/template', 'meeting/administrator', $data);
                    $this->template->load('layout/template', 'meeting/detail', $data);
                }

                elseif($data['admin_level'][0]->level=="2") {
                    $this->template->load('layout/template', 'meeting/admin', $data);
                }

                elseif($data['admin_level'][0]->level=="3") {
                    echo $data['admin_level'][0]->level;
                }

                else {
                    $this->template->load('layout/template', 'meeting/detail', $data);
                }
            }

            else {
                $this->template->load('layout/template', 'meeting/detail', $data);
            }
        }

        else {
            redirect('users/login');
        }
    }

    // view meeting
    public function viewMeeting() {
        $data=array();
        $id=$this->input->post('id');
        $data['thaidate']=$this->thaidate;
        $data['detail']=$this->meeting_model->getDetail($id);
        $data['status']=$this->meeting_model->getStatus();
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('meeting/popup/renderView', $data);

    }

    // view meeting
    public function editMeeting() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['admin_level']=$this->user_model->getUser_mtg($data['user']['hospcode']);
            $id=$this->input->post('id');
            $data['thaidate']=$this->thaidate;
            $data['detail']=$this->meeting_model->getDetail($id);
            $data['status']=$this->meeting_model->getStatus();
            $data['meeting_room']=$this->meeting_model->getMeetingroom();
            $data['userBook']=$this->user_model->getRowsUser($data['detail'][0]->hospcode);
            $this->output->set_header('Content-Type: application/json');

            if( !empty($data['admin_level'])) {
                if($data['detail'][0]->meeting_status==1 and $data['admin_level'][0]->level==2) {
                    $this->load->view('meeting/popup/renderApprove', $data);
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                }

            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
            }

        }

        else {
            redirect('users/login');
        }
    }

    // view srock order
    public function updateMeeting() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $id=$this->input->post('meetingId');
            $inputstatus=$this->input->post('inputstatus');
            $data['detail']=$this->meeting_model->getDetail($id);
            $data['status']=$this->meeting_model->getStatus();

            $data['approve']=array('meeting_status'=> $inputstatus,
                'allower_code'=> $data['user']['hospcode'],
                'allower_date'=> date("Y-m-d H:i:s"),
            );

            $this->db->where('id', $id);
            $this->db->update('tbl_meeting_book', $data['approve']);
            redirect('email/meeting/'.$id.'/'.$sms=3);
        }

        else {
            redirect('users/login');
        }
    }

    public function edit($id) {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='รายการจองห้องประชุม';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบห้องประชุม"=> "/e-services/meeting/",
                "รายการจองห้องประชุม"=> "/e-services/meeting/view/",
                "แก้ไข"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['mydate']=$this->my_date;
            $data['edit']=$this->meeting_model->getEdit($id);
            $data['meeting_room']=$this->meeting_model->getMeetingroom();
            $data['detail']=$this->meeting_model->getDetail($id);

            if($data['detail'][0]->hospcode==$data['user']['hospcode'] && $data['detail'][0]->meeting_status=="1") {
                $this->template->load('layout/template', 'meeting/edit', $data, FALSE);
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('meeting/view/');
            }
        }

        else {
            redirect('users/login');
        }
    }

    // public function update_document($id) {
    //     $data=array();

    //     if($this->session->userdata('isUserLoggedIn')) {
    //         $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
    //         $data['mylibrary']=$this->my_library;
    //         $data['meeting_room']=$this->meeting_model->getMeetingroom();
    //         $data['page_title']='จองห้องประชุม';
    //         $breadcrumb=array("Home"=> "/e-services/",
    //             "ระบบห้องประชุม"=> "/e-services/meeting/",
    //             "จองห้องประชุม"=> ""
    //         );
    //         $data['breadcrumb']=$breadcrumb;
    //         $data['mydate']=$this->my_date;

    //         $data=array('meeting_status'=> $this->input->post('inputstatus'),
    //             'update'=> date("Y-m-d H:i:s"),
    //             'allower_code'=> $data['user']['hospcode'],
    //             'allower_date'=> date("Y-m-d H:i:s"),
    //         );
    //         $this->db->where('id', $id);
    //         $this->db->update('tbl_meeting_book', $data);
    //         redirect('email/meeting/'.$id.'/'.$sms=3);
    //     }

    //     else {
    //         redirect('users/login');
    //     }
    // }

    public function delMeeting() {
        $data=array();
        $id=$this->input->post('id');
        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['detail']=$this->meeting_model->getDetail($id);

            $datastatus=array('id'=> $id,
                'meeting_status'=> '9',
                'update'=> date("Y-m-d H:i:s"),
                'edit_by'=>$data['user']['hospcode'],
            );

            if($data['detail'][0]->hospcode==$data['user']['hospcode'] && $data['detail'][0]->meeting_status<="2") {
                $this->db->where('id', $id);
                $this->db->update('tbl_meeting_book', $datastatus);
                $this->output->set_header('Content-Type: application/json');
                echo json_encode($data);
            }
    
            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่สามารถยกเลิกใบงานได้ กรุณาติดต่อผู้ดูแลระบบ...',
                );
                $this->session->set_userdata($popup);
            }
           
        }
        else {
            redirect('users/login');
        }
    }

    public function cancel($id, $status) {
        $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
        $data['admin_level']=$this->user_model->getUser_mtg($data['user']['hospcode']);
        $data['detail']=$this->meeting_model->getDetail($id);

        $datastatus=array('id'=> $id,
            'meeting_status'=> $status,
            'update'=> date("Y-m-d H:i:s"),
        );

        if($data['detail'][0]->hospcode==$data['user']['hospcode'] && $data['detail'][0]->meeting_status=="1") {
            $this->db->where('id', $id);
            $this->db->update('tbl_meeting_book', $datastatus);
            redirect('email/meeting/'.$id.'/'.$sms=0);
        }

        else {
            $popup=array('msg'=> 1,
                'detail'=> 'คุณไม่สามารถยกเลิกใบงานได้ กรุณาติดต่อผู้ดูแลระบบ...',
            );
            $this->session->set_userdata($popup);
            redirect('meeting/view/');
        }
    }

    public function popup() {
        echo '<center><img src="https://apps.anamai.moph.go.th/e-services/assets/uploads/images/loading-crop.gif"
style="max-width:480px;width:100%"></center>';

    }
}



// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;