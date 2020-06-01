<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'thaidate','phpmailer_lib' ));
        // Load helper
        $this->load->helper(array('url', 'html', 'form'));
        // Load model
        $this->load->model(array('meeting_model', 'customer_model', 'user_model', 'employee_model', ));
    }

    // public function index() {
    //     $data['page_title']='Working Time';
    //     $data['page_name']='Working Time';
    //     $data['page_content']='Working Time';
    //     $data['thaidate']=$this->thaidate;
    //     $this->load->view('finger/working', $data);
    // }

    public function meeting() {
        $data=array();
        $data['mylibrary']=$this->my_library;
        $data['meeting_room']=$this->meeting_model->getMeetingroom();
        $data['page_title']='จองห้องประชุม';
        $breadcrumb=array("Home"=> "/e-services/",
            "ระบบห้องประชุม"=> "/e-services/meeting/",
            "จองห้องประชุม"=> ""
        );
        $data['breadcrumb']=$breadcrumb;
        $this->template->load('layout2/template', 'customer/meeting/create', $data);

    }

    public function calendar() {
        $data=array();

        $data['mylibrary']=$this->my_library;
        $data['page_title']='ปฏิทินจองห้องประชุม';
        $breadcrumb=array("Home"=> "/e-services/",
            "ระบบห้องประชุม"=> "/e-services/meeting/",
            "ปฏิทินจองห้องประชุม"=> ""
        );
        $data['breadcrumb']=$breadcrumb;
        $this->template->load('layout2/template', 'customer/meeting/calendar', $data);
    }

    public function saveMeeting() {
        $json=array();
        $data['thaidate']=$this->thaidate;
        $name=$this->input->post('customer_name');
        $cid=$this->input->post('customer_cid');
        $phone=$this->input->post('customer_phone');
        $mail=$this->input->post('customer_mail');
        $company=$this->input->post('customer_company');
        $room=$this->input->post('customer_room');
        $bookstart=$this->input->post('customer_bookstart');
        $timestart=$this->input->post('customer_timestart');
        $bookend=$this->input->post('customer_bookend');
        $timeend=$this->input->post('customer_timeend');
        $detail=$this->input->post('customer_detail');

        if(empty(trim($name))) {
            $json['error']['name']='ชื่อ-นามสกุลต้องไม่ว่างเปล่า';
        }

        if(empty(trim($cid))) {
            $json['error']['cid']='เลขบัตรประชาชนต้องไม่ว่างเปล่า';
        }

        if ($this->my_library->validateCID($cid)==FALSE) {
            $json['error']['cid']='เลขบัตรประชาชนไม่ถูกต้อง';
        }

        if(empty(trim($mail))) {
            $json['error']['mail']='อีเมล์ต้องไม่ว่างเปล่า';
        }

        if ($this->my_library->validateEmail($mail)==FALSE) {
            $json['error']['mail']='รูปแบบอีเมล์ไม่ถูกต้อง';
        }

        if(empty(trim($phone))) {
            $json['error']['phone']='เบอร์โทรศัพท์ต้องไม่ว่างเปล่า';
        }

        if ($this->my_library->validateMobile($phone)==FALSE) {
            $json['error']['phone']='เบอร์โทรศัพท์ไม่ถูกต้อง';
        }

        if(empty(trim($company))) {
            $json['error']['company']='ชื่อหน่วยงานไม่ว่างเปล่า';
        }

        if(empty(trim($room))) {
            $json['error']['room']='กรุณาเลือกห้องประชุม';
        }

        if(empty(trim($bookstart))) {
            $json['error']['bookstart']='วันที่เริ่มต้องไม่ว่างเปล่า';
        }

        if(empty(trim($timestart))) {
            $json['error']['timestart']='เวลาเริ่มต้องไม่ว่างเปล่า';
        }

        if(empty(trim($bookend))) {
            $json['error']['bookend']='วันที่สิ้นสุดต้องไม่ว่างเปล่า';
        }

        if(empty(trim($timeend))) {
            $json['error']['timeend']='เวลาสิ้นสุดต้องไม่ว่างเปล่า';
        }

        if(empty(trim($detail))) {
            $json['error']['detail']='วัตถุประสงค์ต้องไม่ว่างเปล่า';
        }




        if(empty($json['error'])) {

            $book_start=$bookstart." ".$timestart.":00";
            $book_end=$bookend." ".$timeend.":00";

            if($book_end >=$book_start) {
                $count_query=$this->meeting_model->count_meeting($room, $book_start, $book_end);
                $event_query=$this->meeting_model->checkEvent($room);
                $data['nameMeeting']=$event_query['nameMeeting'];
                $data['event_color']=$event_query['event_color'];

                if($count_query > 0) {
                    $time_start=substr($book_start, 11, 5);
                    $time_stop=substr($book_end, 11, 5);

                    if($data['thaidate']->fullmonth($book_start)==$data['thaidate']->fullmonth($book_end)) {
                        $json['error']['timeerror']=$data['nameMeeting'].' วันที่ '.$data['thaidate']->thai_date_and_time($book_start).' ถึง '.$time_stop.' น. ไม่ว่างกรุณาเลือกช่วงเวลาใหม่ครับ';
                    }

                    else {
                        $json['error']['timeerror']=$data['nameMeeting'].' วันที่ '.$data['thaidate']->thai_date_and_time($book_start).' ถึง '.$data['thaidate']->thai_date_and_time($book_end).' น. ไม่ว่างกรุณาเลือกช่วงเวลาใหม่ครับ';

                    }
                }

                else {
                    $year=$this->thaidate->thaiyear(date("Y-m-d"));
                    $count=$this->meeting_model->count_all_year($year);
                    $data=array('meeting_doc'=> $year."/".($count+1),
                        'meeting_room'=> $room,
                        'meeting_date'=> date("Y-m-d H:i:s"),
                        'update'=> date("Y-m-d H:i:s"),
                        'detail'=> $detail,
                        'book_start'=> $book_start,
                        'book_end'=> $book_end,
                        'event_color'=> $data['event_color'],
                    );
                    $insert=$this->meeting_model->insert_meeting($data);

                    if ($insert) {
                        $data['insert_id']=$this->db->insert_id();
                        
                        $customer=array('bookId'=> $data['insert_id'],
                            'name'=> $name,
                            'cid'=> $cid,
                            'email'=> $mail,
                            'phone'=> $phone,
                            'company'=> $company,
                        );
                        $insertCustomer=$this->meeting_model->insert_CustomerMeeting($customer);
                        $sendmail=$this->customer_meeting($data['insert_id'], $sms=1);
                    }

                    else {
                        $json['error']['timeerror']='ระบบไม่สามารถทำการบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ';
                    }
                }

            }

            else {
                $json['error']['timeerror']='วันที่และช่วงเวลาสิ้นสุดการประชุมไม่ถูกต้อง กรุณาทำรายการใหม่ครับ';
            }


            try {
                //$last_id=$this->employee_model->createEmp();

            }

            catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }

        echo json_encode($json);
    }

    public function customer_meeting($id, $sms) {
        $data=array();
        $data['mylibrary']=$this->my_library;
        $data['mydate']=$this->thaidate;
        $data['detail']=$this->meeting_model->getDetail($id);
        $data['Customer']=$this->meeting_model->getCustomer($id);
        
        // PHPMailer object
        $mail=$this->phpmailer_lib->load();
        $mail->CharSet="utf-8";
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='ict.hpc8@gmail.com';
        $mail->Password='anamai#hpc8';
        $mail->SMTPSecure='ssl';
        $mail->Port=465;

        $mail->setFrom('ict.hpc8@gmail.com', 'e-Services Online');
        $mail->addReplyTo('ict.hpc8@gmail.com', 'e-Services Online');

        // Add a recipient getEmail
        $mail->addAddress($data['Customer'][0]->email);

        // Add cc or bcc 
        if($data['detail'][0]->meeting_status==1) {
            $data['user']=$this->user_model->admin_mtg();
            foreach($data['user'] as $user) {
                if($user->level==2) {
                    $this->user_model->setHospcode($user->hospcode);
                    $data['admin']=$this->user_model->getHospcode();
                    $mail->addCC($data['admin']->email, $data['admin']->titlename.$data['admin']->firstname.' '.$data['admin']->lastname);
                }
            }
        }
        elseif($data['detail'][0]->meeting_status==2) {
            $data['user']=$this->user_model->admin_mtg();
            foreach($data['user'] as $user) {
                if($user->level==1) {
                    $this->user_model->setHospcode($user->hospcode);
                    $data['admin']=$this->user_model->getHospcode();
                    $mail->addCC($data['admin']->email, $data['admin']->titlename.$data['admin']->firstname.' '.$data['admin']->lastname);
                }
            }
        }
        else {
            // Add cc or bcc 
            //$mail->addCC('ict.hpc8@gmail.com');
            //$mail->addBCC('bcc@example.com');
        }
 
        //Check status 
        if($data['detail'][0]->meeting_status==1) {
            $mail->Subject='แจ้งเตือน การขอใช้บริการจองห้องประชุมผ่านระบบ e-Services Online เลขที่เอกสาร : '.$data['detail'][0]->meeting_doc;
        }

        elseif($data['detail'][0]->meeting_status==2) {
            $mail->Subject='แจ้งเตือน การอนุมัติใบงานผ่านระบบ e-Services Online เลขที่เอกสาร : '.$data['detail'][0]->meeting_doc;
        }

        elseif($data['detail'][0]->meeting_status==3) {
            $mail->Subject='แจ้งเตือน การไม่อนุมัติใบงานผ่านระบบ e-Services Online เลขที่เอกสาร : '.$data['detail'][0]->meeting_doc;
        }

        else {
            $mail->Subject='แจ้งเตือน การยกเลิกใบงานผ่านระบบ e-Services Online เลขที่เอกสาร : '.$data['detail'][0]->meeting_doc;
        }

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mailContent="<div style='border: 1px dashed #cccccc; background-color: #ffffff; padding: 20px; font-size: 12px; color: #666666; font-family: tahoma; line-height: 20px;'>
<div style='border-bottom: dashed #eeeeee 1px; text-align: left;'><img src=https://lh6.googleusercontent.com/9JPAzQDCFOmov7CQyGogUgjjM024KZuhP_KuLmNIOK2rXRUxR4_wMQPQqhz_bOxtkWVlu24DmLX3LBzwrGw01FgxA93ktnAVWfPHvole9OFuzUD4gQHkq9PDRkVqQeKdjmgpHqh2 /></div><p>
        <div><span style='padding-top: 5px; padding-bottom: 0px; margin: 0px; font-weight: bold;'>เรียน คุณ".$data['Customer'][0]->name."</span> ตามที่ท่านได้แจ้งความประสงค์ที่จะขอจอง <strong>".get_instance()->meeting_model->getRoom($data['detail'][0]->meeting_room)."</strong> ผ่านช่องทางระบบ e-Services Online โดยมีรายละเอียดรายการตามนี้</div><div style='padding-top: 10px;'><table width='99%'cellspacing='1'cellpadding='5'bgcolor='#CCCCCC'><tbody><tr><td style='font-weight: bold; background-color: #eeeeee; width: 99.3548%; text-align: left;'colspan='2'align='center'>รายละเอียดการจองห้องประชุม</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>เลขที่เอกสาร</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".$data['detail'][0]->meeting_doc."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>ชื่อผู้ขอใช้บริการ</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".get_instance()->user_model->getCustomerNameFull($id)."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>ชื่อห้องประชุม</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".get_instance()->meeting_model->getRoom($data['detail'][0]->meeting_room)."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>วันที่ใช้งาน</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".$data['detail'][0]->book_start."- ".$data['detail'][0]->book_end."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>เรื่อง/เหตุผล</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".$data['detail'][0]->detail."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>สถานะ</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'><a href='#'>".get_instance()->meeting_model->checkStatus($data['detail'][0]->meeting_status). "</a></td></tr></tbody></table></div></div><div style='padding-top: 10px;'>All Right Reserved. Powered By <strong>e-Services Online </strong>© ICT ศูนย์อนามัยที่ 8 อุดรธานี</div></div>";

        $mail->Body=$mailContent;

        // Send email
        $mail->send();

    }







}


// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;