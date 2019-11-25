<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meeting_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->status_mtg='tbl_status_mtg';
        $this->meetingฺBook='tbl_meeting_book';
    }

    public function getCalender() {
        // $this->db->select("*");  
        // $this->db->from("meetingBook");  
        // $query = $this->db->get();
        // return $query->result(); 
        $query=$this->db->get_where('view_tbl_meeting_book', array('meeting_status'=> '2'));
        return $query->result();
    }

    public function getMeetingroom() {
        $query=$this->db->get_where('tbl_meeting_room', array('status'=> '1'));
        return $query->result();
    }

    public function getStatus() {
        $query=$this->db->get_where($this->status_mtg, array('status'=> '1'));
        return $query->result();
    }

    public function insert_meeting($data) {
        $this->db->insert('tbl_meeting_book', $data);
        return TRUE;
    }

    function count_meeting($meeting_room, $book_start, $book_end) {
        $query=$this->db->query("SELECT id FROM `tbl_meeting_book` 
WHERE ((meeting_room='$meeting_room') AND (meeting_status < '3') AND((book_start BETWEEN '$book_start'AND '$book_end')OR(book_end BETWEEN '$book_start'AND '$book_end')))");  
return $query->num_rows();
        }

        public function count_all_year($year) {
            $this->db->select('id');
            $this->db->from($this->meetingฺBook);
            $this->db->or_like('meeting_doc', $year);
            $query=$this->db->get();
            return $query->num_rows();
        }

        public function checkEvent($meeting_room) {
            $nameMeeting="";
            $event_color="";

            if($meeting_room==1) {
                $nameMeeting="ห้องประชุม ศูนย์อนามัยที่ 8 อุดรธานี";
                $event_color="#1a75ff";
                return array('nameMeeting'=> $nameMeeting,
                    'event_color'=> $event_color,
                );
            }

            elseif($meeting_room==2) {
                $nameMeeting="ห้องประชุม ธราดล";
                $event_color="#00b33c";
                return array('nameMeeting'=> $nameMeeting,
                    'event_color'=> $event_color,
                );
            }

            elseif($meeting_room==3) {
                $nameMeeting="ห้องประชุม ชลธี";
                $event_color="#ff9900";
                return array('nameMeeting'=> $nameMeeting,
                    'event_color'=> $event_color,
                );
            }

            elseif($meeting_room==4) {
                $nameMeeting="ห้องประชุม VDO Conference";
                $event_color="#ff8080";
                return array('nameMeeting'=> $nameMeeting,
                    'event_color'=> $event_color,
                );
            }

            else {
                $nameMeeting="้องประชุมไม่ถูกต้อง";
                $event_color="#FFF";
                return array('nameMeeting'=> $nameMeeting,
                    'event_color'=> $event_color,
                );
            }
        }

        public function view_meeting() {
            $query=$this->db->query("SELECT * FROM tbl_meeting_book ORDER BY id DESC");
            return $query->result();
        }

        public function getDetail($id) {
            $query=$this->db->get_where('tbl_meeting_book', array('id'=> $id));
            return $query->result();
        }

        public function getRoom($id) {
            $query=$this->db->get_where('tbl_meeting_room', array('id'=> $id));
            $data=$query->result();
            return ($data[0]->name);
        }

        public function getImages($id) {
            $query=$this->db->get_where('tbl_meeting_room', array('id'=> $id));
            $data=$query->result();
            return ($data[0]->img);
        }

        public function checkStatus($status) {
            if($status==1) {
                return $status='<span class="label label-sm label-warning arrowed arrowed-right"><i class="fa fa-spinner"> รอการอนุมัติ</i></span>';
            }

            elseif($status==2) {
                return $status='<span class="label label-sm label-success arrowed arrowed-right"><i class="fa fa-check"> อนุมัติ</i></span>';
            }

            elseif($status==3) {
                return $status='<span class="label label-sm label-danger arrowed arrowed-right"><i class="fa fa-times"> ไม่อนุมัติ</i></span>';
            }

            else {
                return $status='<span class="label label-sm label-pink arrowed arrowed-right"><i class="fa fa-sign-out"> ยกเลิก</i></span>';
            }
        }

        public function getEdit($id) {
            $query=$this->db->get_where('tbl_meeting_book', array('id'=> $id));
            return $query->result();
        }
    }

    ?>