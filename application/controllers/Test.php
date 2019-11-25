<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        $this->load->library(array('phpmailer_lib'));
        $this->load->model(array('user_model'));
    }
    
    function send(){
        // Load PHPMailer library
        //$this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
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
        
        // Add a recipient
        $mail->addAddress('kung.suthatburan@gmail.com');

        $data=array();
        $data['user']=$this->user_model->admin_mtg();

        $data=array();
        $data['user']=$this->user_model->admin_mtg();

        foreach($data['user'] as $user) {
            if($user->level==2) {
                $this->user_model->setHospcode($user->hospcode);
                $data['admin']=$this->user_model->getHospcode();
                $mail->addCC($data['admin']->email, $data['admin']->titlename.$data['admin']->firstname.$data['admin']->lastname);
            }

        }
        
        // Add cc or bcc 
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
    
}