<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>e-Service : <?php echo $page_title; ?></title>
    <meta name="<?php echo $page_name; ?>" content="<?php echo $page_content; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url()?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet">
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #727272;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">

        <div>
            <h1 class="logo-name"><img src="<?php echo base_url('assets/img/logo/logo1.png'); ?>"
                    style="max-width:140px;width:100%" />
        </div>
        <br>
        <h2>ลงทะเบียนเพื่อขอใช้งานระบบลงเวลาปฏิบัติงาน Online</h2>

        <br>
        <?php
                if(!empty($success_msg)){
                    echo '<p class="statusMsg">'.$success_msg.'</p>';
                }elseif(!empty($error_msg)){
                    echo '<p class="statusMsg">'.$error_msg.'</p>';
                }
            ?>
        <form action="" method="post">
            <!-- <img id="pictureUrl" width="25%">
                <p id="userId"></p>
                <p id="displayName"></p>
                <p id="statusMessage"></p>
                <p id="getDecodedIDToken"></p> -->

            <div class="form-group has-feedback">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-credit-card"></i>
                    </span>
                    <input type="text" id="emp-cid" name="emp_cid" placeholder="เลขบัตรประชาชน 13 หลัก"
                        class="form-control input-emp-cid" required="" value="" autocomplete="off">
                    <input type="hidden" name="lineUserId" class="form-control input-sm" id="lineUserId" />
                    <br />
                    <?php echo form_error('text','<span class="help-block">','</span>'); ?>
                </div>
            </div>




            <div class="form-group">
                <input type="submit" name="registerSubmit" class="btn btn-primary block full-width m-b"
                    value="ลงทะเบียน">
            </div>
        </form>
       
    </div>
    <div class="footer">
        <p class="m-n"> <small>
                ศูนย์อนามัยที่ 8 อุดรธานี | กรมอนามัย | กระทรวงสาธารณสุข
                <p>© Copyright 2019, ICT ศูนย์อนามัยที่ 8 อุดรธานี</p></small> </p>
    </div>
    <!-- Mainly scripts -->
    <script src="<?php echo base_url()?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/custom/jquery.mask.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/line/liff-sdk2.js"></script>
    <script>
        $(document).ready(function () {
            $('.input-emp-cid').mask('9-9999-99999-99-9');
        });
    </script>
    <script>
        function runApp() {
            liff.getProfile().then(profile => {
                // document.getElementById("pictureUrl").src = profile.pictureUrl;
                // document.getElementById("userId").innerHTML = profile.userId;
                // document.getElementById("displayName").innerHTML = profile.displayName;
                // document.getElementById("statusMessage").innerHTML = profile.statusMessage;
                // document.getElementById("getDecodedIDToken").innerHTML = liff.getDecodedIDToken().email;
                var lineUserId = profile.userId;
                document.getElementById('lineUserId').value = lineUserId;

            }).catch(err => console.error(err));
        }
        liff.init({
            liffId: "1654261952-vXX89AJo"
        }, () => {
            if (liff.isLoggedIn()) {
                runApp()
            } else {
                liff.login();
            }
        }, err => console.error(err.code, error.message));
    </script>

</body>

</html>