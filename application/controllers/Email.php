<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session', 'my_library', 'my_date', 'phpmailer_lib'));
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model(array('user_model', 'employee_model', 'meeting_model', 'product_model'));
    }

    public function meeting($id, $sms) {
        $data=array();
        $data['mylibrary']=$this->my_library;
        $data['mydate']=$this->my_date;
        $data['detail']=$this->meeting_model->getDetail($id);

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
        $mail->addAddress(get_instance()->user_model->getEmail($data['detail'][0]->hospcode));

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
        <div><span style='padding-top: 5px; padding-bottom: 0px; margin: 0px; font-weight: bold;'>เรียน คุณ".get_instance()->user_model->getUser($data['detail'][0]->hospcode)."</span>ตามที่ท่านได้แจ้งความประสงค์ที่จะขอจอง <strong>".get_instance()->meeting_model->getRoom($data['detail'][0]->meeting_room)."</strong>ผ่านช่องทางระบบ e-Services Online โดยมีรายละเอียดรายการตามนี้</div><div style='padding-top: 10px;'><table width='99%'cellspacing='1'cellpadding='5'bgcolor='#CCCCCC'><tbody><tr><td style='font-weight: bold; background-color: #eeeeee; width: 99.3548%; text-align: left;'colspan='2'align='center'>รายละเอียดการจองห้องประชุม</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>เลขที่เอกสาร</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".$data['detail'][0]->meeting_doc."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>ชื่อผู้ขอใช้บริการ</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".get_instance()->user_model->getUsername($data['detail'][0]->hospcode)."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>ชื่อห้องประชุม</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".get_instance()->meeting_model->getRoom($data['detail'][0]->meeting_room)."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>วันที่ใช้งาน</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".$data['detail'][0]->book_start."- ".$data['detail'][0]->book_end."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>เรื่อง/เหตุผล</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".$data['detail'][0]->detail."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>สถานะ</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'><a href='http://apps.anamai.moph.go.th/e-services/meeting/detail/".$id."'target='_blank'>".get_instance()->meeting_model->checkStatus($data['detail'][0]->meeting_status). "</a></td></tr></tbody></table></div></div><div style='padding-top: 10px;'>All Right Reserved. Powered By <strong>e-Services Online </strong>© ICT ศูนย์อนามัยที่ 8 อุดรธานี</div></div>";

        $mail->Body=$mailContent;

        // Send email
        if( !$mail->send()) {
            $popup=array('msg'=> 1,
                'detail'=> 'ระบบไม่สามารถส่ง E-Mail แจ้งเตือนได้กรุณาติดต่อผู้ดูแลระบบครับ Error '.$mail->ErrorInfo,
            );
            $this->session->set_userdata($popup);
            redirect('meeting/view/');
        }

        else {
            if($sms==1) {
                $popup=array('msg'=> 0,
                    'detail'=> 'ระบบทำการบันทึกข้อมูลสำเร็จ พร้อมได้ส่งข้อความแจ้งเตือนไปที่ E-Mail '.get_instance()->user_model->getEmail($data['detail'][0]->hospcode).' ของท่านเรียบร้อยแล้ว',
                );

            }

            elseif($sms==2) {
                $popup=array('msg'=> 0,
                    'detail'=> 'ระบบทำการแก้ไขข้อมูลสำเร็จ พร้อมได้ส่งข้อความแจ้งเตือนไปที่ E-Mail '.get_instance()->user_model->getEmail($data['detail'][0]->hospcode).' ของท่านเรียบร้อยแล้ว',
                );
            }

            elseif($sms==3) {
                $popup=array('msg'=> 0,
                    'detail'=> 'ระบบทำการอัพเดทข้อมูลสำเร็จ พร้อมได้ส่งข้อความแจ้งเตือนไปที่ E-Mail '.get_instance()->user_model->getEmail($data['detail'][0]->hospcode).' เรียบร้อยแล้ว',
                );
            }

            else {
                $popup=array('msg'=> 0,
                    'detail'=> 'ระบบทำการยกเลิกใบงานสำเร็จ พร้อมได้ส่งข้อความแจ้งเตือนไปที่ E-Mail '.get_instance()->user_model->getEmail($data['detail'][0]->hospcode).' ของท่านเรียบร้อยแล้ว',
                );
            }

            $this->session->set_userdata($popup);
            redirect('meeting/view/');
        }
    }

    public function product($id, $sms) {
        $data=array();
        $data['mylibrary']=$this->my_library;
        $data['mydate']=$this->my_date;
        $data['detail']=$this->product_model->getDetail($id);
        $data['items']=$this->product_model->getItems($id);

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
        $mail->addAddress(get_instance()->user_model->getEmail($data['detail'][0]->hospcode));
        
        // Add cc or bcc
        if($data['detail'][0]->status==1) {
            $data['user']=$this->user_model->admin_mtg();
            foreach($data['user'] as $user) {
                if($user->level==2) {
                    $this->user_model->setHospcode($user->hospcode);
                    $data['admin']=$this->user_model->getHospcode();
                    $mail->addCC($data['admin']->email, $data['admin']->titlename.$data['admin']->firstname.' '.$data['admin']->lastname);
                }
            }
        }
        elseif($data['detail'][0]->status==2) {
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
        if($data['detail'][0]->status==1) {
            $mail->Subject='แจ้งเตือน การขอยืมครุภัณฑ์ผ่านระบบ e-Services Online เลขที่เอกสาร : '.$data['detail'][0]->order_doc;
        }

        elseif($data['detail'][0]->status==2) {
            $mail->Subject='แจ้งเตือน การอนุมัติใบงานผ่านระบบ e-Services Online เลขที่เอกสาร : '.$data['detail'][0]->order_doc;
        }

        elseif($data['detail'][0]->status==3) {
            $mail->Subject='แจ้งเตือน การนำจ่ายครุภัณฑ์ผ่านระบบ e-Services Online เลขที่เอกสาร : '.$data['detail'][0]->order_doc;
        }

        elseif($data['detail'][0]->status==4) {
            $mail->Subject='แจ้งเตือน การรับคืนครุภัณฑ์ผ่านระบบ e-Services Online เลขที่เอกสาร : '.$data['detail'][0]->order_doc;
        }

        elseif($data['detail'][0]->status==5) {
            $mail->Subject='แจ้งเตือน การไม่อนุมัติใบงานผ่านระบบ e-Services Online เลขที่เอกสาร : '.$data['detail'][0]->order_doc;
        }

        else {
            $mail->Subject='แจ้งเตือน การยกเลิกใบงานผ่านระบบ e-Services Online เลขที่เอกสาร : '.$data['detail'][0]->order_doc;
        }

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mailContent="<div style='border: 1px dashed #cccccc; background-color: #ffffff; padding: 20px; font-size: 12px; color: #666666; font-family: tahoma; line-height: 20px;'>
<div style='border-bottom: dashed #eeeeee 1px; text-align: left;'><img src=https://lh6.googleusercontent.com/9JPAzQDCFOmov7CQyGogUgjjM024KZuhP_KuLmNIOK2rXRUxR4_wMQPQqhz_bOxtkWVlu24DmLX3LBzwrGw01FgxA93ktnAVWfPHvole9OFuzUD4gQHkq9PDRkVqQeKdjmgpHqh2 /></div><p>
        <div><span style='padding-top: 5px; padding-bottom: 0px; margin: 0px; font-weight: bold;'>เรียน คุณ".get_instance()->user_model->getUser($data['detail'][0]->hospcode)."</span> ตามที่ท่านได้แจ้งความประสงค์ที่จะขอยืมครุภัณฑ์ ผ่านช่องทางระบบ e-Services Online โดยมีรายละเอียดรายการตามนี้</div><div style='padding-top: 10px;'><table width='100%'cellspacing='1'cellpadding='5'bgcolor='#CCCCCC'><tbody><tr><td style='font-weight: bold; background-color: #eeeeee; width: 99.3548%; text-align: left;'colspan='2'align='center'>รายละเอียดการขอยืมครุภัณฑ์</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>เลขที่เอกสาร</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".$data['detail'][0]->order_doc."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>ชื่อผู้ขอใช้บริการ</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".get_instance()->user_model->getUsername($data['detail'][0]->hospcode)."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>วันที่ใช้งาน</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".$data['detail'][0]->start_date."- ".$data['detail'][0]->end_date."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>เรื่อง/เหตุผล</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'>".$data['detail'][0]->description."</td></tr><tr><td style='font-weight: bold; width: 17.2904%;'align='right'bgcolor='#FFFFFF'>สถานะ</td><td style='width: 82.0644%;'bgcolor='#FFFFFF'><a href='http://apps.anamai.moph.go.th/e-services/products/view/ 'target='_blank'>".get_instance()->product_model->checkStatus($data['detail'][0]->status). "</a></td></tr></tbody></table></br></div></div><div style='padding-top: 10px;'>All Right Reserved. Powered By <strong>e-Services Online </strong>© ICT ศูนย์อนามัยที่ 8 อุดรธานี</div></div>";

        $mail->Body=$mailContent;

        // Send email
        if( !$mail->send()) {
            $popup=array('msg'=> 1,
                'detail'=> 'ระบบไม่สามารถส่ง E-Mail แจ้งเตือนได้กรุณาติดต่อผู้ดูแลระบบครับ Error '.$mail->ErrorInfo,
            );
            $this->session->set_userdata($popup);
            //redirect('products/view/');
        }

        if($sms==1) {
            $popup=array('msg'=> 0,
                'detail'=> 'ระบบทำการบันทึกข้อมูลสำเร็จ พร้อมได้ส่งข้อความแจ้งเตือนไปที่ E-Mail '.get_instance()->user_model->getEmail($data['detail'][0]->hospcode).' ของท่านเรียบร้อยแล้ว',
            );
            $this->session->set_userdata($popup);
            redirect('products/view/');
        }

        elseif($sms==2||$sms==3||$sms==4||$sms==5) {
            $popup=array('msg'=> 0,
                'detail'=> 'ระบบทำการอัพเดทข้อมูลสำเร็จ พร้อมได้ส่งข้อความแจ้งเตือนไปที่ E-Mail '.get_instance()->user_model->getEmail($data['detail'][0]->hospcode).' เรียบร้อยแล้ว',
            );
            $this->session->set_userdata($popup);
        }

        elseif($sms==7) {
            $popup=array('msg'=> 0,
                'detail'=> 'ระบบทำการแก้ไขข้อมูลสำเร็จ พร้อมได้ส่งข้อความแจ้งเตือนไปที่ E-Mail '.get_instance()->user_model->getEmail($data['detail'][0]->hospcode).' ของท่านเรียบร้อยแล้ว',
            );
            $this->session->set_userdata($popup);
        }

        else {
            $popup=array('msg'=> 0,
                'detail'=> 'ระบบทำการยกเลิกใบงานสำเร็จ พร้อมได้ส่งข้อความแจ้งเตือนไปที่ E-Mail '.get_instance()->user_model->getEmail($data['detail'][0]->hospcode).' ของท่านเรียบร้อยแล้ว',
            );
            $this->session->set_userdata($popup);
        }

        //$this->session->set_userdata($popup);
        //redirect('products/view/');
    }
}