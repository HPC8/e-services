<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" href="<?=base_url()?>favicon.ico" type="image/gif">
    <title>e-Service : <?php echo $page_title; ?></title>
    <meta name="<?php echo $page_name; ?>" content="<?php echo $page_content; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url()?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name"><img src="<?php echo base_url('assets/img/logo/logo1.png'); ?>" width="65%"
                        height="65%" />
            </div>
            <br>
            <h2>E-SERVICE Application</h2>

            <p>กรุณาลงชื่อเพื่อเข้าใช้งานระบบ</p>
            <?php
    if(!empty($success_msg)){
        echo '<p class="statusMsg">'.$success_msg.'</p>';
    }elseif(!empty($error_msg)){
        echo '<p class="statusMsg">'.$error_msg.'</p>';
    }
    ?>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="hospcode" placeholder="รหัสประจำตัว 5 หลัก"
                        required="" value="" autocomplete="off">
                    <?php echo form_error('text','<span class="help-block">','</span>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required="" autocomplete="off">
                    <?php echo form_error('password','<span class="help-block">','</span>'); ?>
                </div>
                <div class="form-group">
                    <input type="submit" name="loginSubmit" class="btn btn-primary block full-width m-b"
                        value="Login" />
                </div>
            </form>
            <p class="m-t"> <small>
                    ศูนย์อนามัยที่ 8 อุดรธานี | กรมอนามัย | กระทรวงสาธารณสุข
                    <p>© Copyright 2019, ICT ศูนย์อนามัยที่ 8 อุดรธานี</p></small> </p>
        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url()?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

</body>

</html>