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

        #clock {
            text-align: center;
            font-size: 40px;
            font-weight: bold;
        }

        #title {
            text-align: center;
        }

        .divider {
            opacity: 0.2;
        }

        div.left {
            text-align: left;
        }

        .radio-container {
            margin: 2rem auto;
            max-width: 400px;
            width: 100%;
        }

        .radio-label {
            background: white;
            border: 1px solid #eee;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            display: inline-block;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 600;
            margin: 0 auto 10px;
            padding: 15px 15px 15px 55px;
            position: relative;
            transition: .3s ease all;
            width: 100%;
        }

        .radio-label:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .radio-label:before {
            background: #eee;
            border-radius: 50%;
            content: '';
            height: 30px;
            left: 20px;
            position: absolute;
            top: calc(50% - 15px);
            transition: .3s ease background-color;
            width: 30px;
        }

        .radio-label span {
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .radio-btn {
            position: absolute;
            visibility: hidden;
        }

        .radio-btn:checked+.radio-label {
            background: #ECF5FF;
            border-color: #4A90E2;
        }

        .radio-btn:checked+.radio-label:before {
            background-color: #4A90E2;
            background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48c3ZnIHdpZHRoPSIyNiIgaGVpZ2h0PSIyMCIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIyLjAyOTY4IC00MC4wOTAzIDI2IDIwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48IS0tR2VuZXJhdGVkIGJ5IElKU1ZHIChodHRwczovL2dpdGh1Yi5jb20vaWNvbmphci9JSlNWRyktLT48cGF0aCBkPSJNMjcuOTc0MywtMzYuMTI3MmMwLDAuNDQ2NDI4IC0wLjE1NjI1LDAuODI1ODkzIC0wLjQ2ODc1LDEuMTM4MzlsLTEyLjEyMDUsMTIuMTIwNWwtMi4yNzY3OSwyLjI3Njc5Yy0wLjMxMjUsMC4zMTI1IC0wLjY5MTk2NCwwLjQ2ODc1IC0xLjEzODM5LDAuNDY4NzVjLTAuNDQ2NDI4LDAgLTAuODI1ODkzLC0wLjE1NjI1IC0xLjEzODM5LC0wLjQ2ODc1bC0yLjI3Njc5LC0yLjI3Njc5bC02LjA2MDI3LC02LjA2MDI3Yy0wLjMxMjUsLTAuMzEyNSAtMC40Njg3NSwtMC42OTE5NjUgLTAuNDY4NzUsLTEuMTM4MzljMCwtMC40NDY0MjkgMC4xNTYyNSwtMC44MjU4OTMgMC40Njg3NSwtMS4xMzgzOWwyLjI3Njc5LC0yLjI3Njc5YzAuMzEyNSwtMC4zMTI1IDAuNjkxOTY1LC0wLjQ2ODc1IDEuMTM4MzksLTAuNDY4NzVjMC40NDY0MjksMCAwLjgyNTg5MywwLjE1NjI1IDEuMTM4MzksMC40Njg3NWw0LjkyMTg4LDQuOTM4NjJsMTAuOTgyMSwtMTAuOTk4OWMwLjMxMjUsLTAuMzEyNSAwLjY5MTk2NCwtMC40Njg3NSAxLjEzODM5LC0wLjQ2ODc1YzAuNDQ2NDI4LDAgMC44MjU4OTMsMC4xNTYyNSAxLjEzODM5LDAuNDY4NzVsMi4yNzY3OCwyLjI3Njc5YzAuMzEyNSwwLjMxMjUgMC40Njg3NSwwLjY5MTk2NCAwLjQ2ODc1LDEuMTM4MzlaIiB0cmFuc2Zvcm09InNjYWxlKDEuMDAxOTgpIiBmaWxsPSIjZmZmIj48L3BhdGg+PC9zdmc+');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 15px;
        }

        .radio-btn.positive:checked+.radio-label {
            background: #EAFFF6;
            border-color: #32B67A;
        }

        .radio-btn.positive:checked+.radio-label:before {
            background-color: #32B67A;
        }

        .radio-btn.neutral:checked+.radio-label:before {
            background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAtMTUgMzAgOC41NzE0MyIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+PCEtLUdlbmVyYXRlZCBieSBJSlNWRyAoaHR0cHM6Ly9naXRodWIuY29tL2ljb25qYXIvSUpTVkcpLS0+PHBhdGggZD0iTTMwLC0xMi4zMjE0djMuMjE0MjljMCwwLjczNjYwNyAtMC4yNjIyNzcsMS4zNjcxOSAtMC43ODY4MywxLjg5MTc0Yy0wLjUyNDU1NCwwLjUyNDU1NCAtMS4xNTUxMywwLjc4NjgzMSAtMS44OTE3NCwwLjc4NjgzMWgtMjQuNjQyOWMtMC43MzY2MDcsMCAtMS4zNjcxOSwtMC4yNjIyNzcgLTEuODkxNzQsLTAuNzg2ODMxYy0wLjUyNDU1MywtMC41MjQ1NTMgLTAuNzg2ODMsLTEuMTU1MTMgLTAuNzg2ODMsLTEuODkxNzR2LTMuMjE0MjljMCwtMC43MzY2MDcgMC4yNjIyNzcsLTEuMzY3MTkgMC43ODY4MywtMS44OTE3NGMwLjUyNDU1NCwtMC41MjQ1NTMgMS4xNTUxMywtMC43ODY4MyAxLjg5MTc0LC0wLjc4NjgzaDI0LjY0MjljMC43MzY2MDcsMCAxLjM2NzE5LDAuMjYyMjc3IDEuODkxNzQsMC43ODY4M2MwLjUyNDU1MywwLjUyNDU1NCAwLjc4NjgzLDEuMTU1MTMgMC43ODY4MywxLjg5MTc0WiIgZmlsbD0iI2ZmZiI+PC9wYXRoPjwvc3ZnPg==');
        }

        .radio-btn.negative:checked+.radio-label {
            background: #FFF2F2;
            border-color: #E75153;
        }

        .radio-btn.negative:checked+.radio-label:before {
            background-color: #E75153;
            background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48c3ZnIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIxLjg1MTg1IC0zOS42OTcgMjAgMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjwhLS1HZW5lcmF0ZWQgYnkgSUpTVkcgKGh0dHBzOi8vZ2l0aHViLmNvbS9pY29uamFyL0lKU1ZHKS0tPjxwYXRoIGQ9Ik0yMS43Mjk5LC0yMy40NzFjMCwwLjQ0NjQyOCAtMC4xNTYyNSwwLjgyNTg5MyAtMC40Njg3NSwxLjEzODM5bC0yLjI3Njc5LDIuMjc2NzljLTAuMzEyNSwwLjMxMjUgLTAuNjkxOTY0LDAuNDY4NzUgLTEuMTM4MzksMC40Njg3NWMtMC40NDY0MjgsMCAtMC44MjU4OTMsLTAuMTU2MjUgLTEuMTM4MzksLTAuNDY4NzVsLTQuOTIxODcsLTQuOTIxODhsLTQuOTIxODgsNC45MjE4OGMtMC4zMTI1LDAuMzEyNSAtMC42OTE5NjQsMC40Njg3NSAtMS4xMzgzOSwwLjQ2ODc1Yy0wLjQ0NjQyOCwwIC0wLjgyNTg5MiwtMC4xNTYyNSAtMS4xMzgzOSwtMC40Njg3NWwtMi4yNzY3OSwtMi4yNzY3OWMtMC4zMTI1LC0wLjMxMjUgLTAuNDY4NzUsLTAuNjkxOTY1IC0wLjQ2ODc1LC0xLjEzODM5YzAsLTAuNDQ2NDI5IDAuMTU2MjUsLTAuODI1ODkzIDAuNDY4NzUsLTEuMTM4MzlsNC45MjE4OCwtNC45MjE4OGwtNC45MjE4OCwtNC45MjE4OGMtMC4zMTI1LC0wLjMxMjUgLTAuNDY4NzUsLTAuNjkxOTY0IC0wLjQ2ODc1LC0xLjEzODM5YzAsLTAuNDQ2NDI4IDAuMTU2MjUsLTAuODI1ODkzIDAuNDY4NzUsLTEuMTM4MzlsMi4yNzY3OSwtMi4yNzY3OGMwLjMxMjUsLTAuMzEyNSAwLjY5MTk2NCwtMC40Njg3NSAxLjEzODM5LC0wLjQ2ODc1YzAuNDQ2NDI5LDAgMC44MjU4OTMsMC4xNTYyNSAxLjEzODM5LDAuNDY4NzVsNC45MjE4OCw0LjkyMTg4bDQuOTIxODcsLTQuOTIxODhjMC4zMTI1LC0wLjMxMjUgMC42OTE5NjUsLTAuNDY4NzUgMS4xMzgzOSwtMC40Njg3NWMwLjQ0NjQyOSwwIDAuODI1ODkzLDAuMTU2MjUgMS4xMzgzOSwwLjQ2ODc1bDIuMjc2NzksMi4yNzY3OGMwLjMxMjUsMC4zMTI1IDAuNDY4NzUsMC42OTE5NjUgMC40Njg3NSwxLjEzODM5YzAsMC40NDY0MjkgLTAuMTU2MjUsMC44MjU4OTMgLTAuNDY4NzUsMS4xMzgzOWwtNC45MjE4OCw0LjkyMTg4bDQuOTIxODgsNC45MjE4OGMwLjMxMjUsMC4zMTI1IDAuNDY4NzUsMC42OTE5NjQgMC40Njg3NSwxLjEzODM5WiIgdHJhbnNmb3JtPSJzY2FsZSgxLjAwNTYxKSIgZmlsbD0iI2ZmZiI+PC9wYXRoPjwvc3ZnPg==');
        }
    </style>

</head>

<body class="gray-bg" onload="displayTime();">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div id="clock">
            <span id="hours">:</span><span class="blinker">:</span><span id="minutes"></span><span
                class="blinker">:</span><span id="seconds"></span>
        </div>
        <p><?= $thaidate->thai_date_fullmonth(date("Y-m-d"));?></p>

        <form action="" method="post">
            <img id="pictureUrl" width="30%">
            <p id="displayName"></p>
            <div class="form-group">
                <input type="hidden" name="lineUserId" class="form-control input-sm" id="lineUserId" />
                <input type="hidden" name="Latitude" class="form-control input-sm" id="Latitude" />
                <input type="hidden" name="Longitude" class="form-control input-sm" id="Longitude" />
                <?php echo form_error('text','<span class="help-block">','</span>'); ?>

            </div>

            <div class="left radio-container">
                <input class="radio-btn" name="status" id="radio-1" type="radio" value="1" required
                    onclick="checkRadio(this)" disabled>
                <label class="radio-label" for="radio-1"> <span>&nbsp;&nbsp;&nbsp;เข้างาน (Check in)</span></label>

                <input class="radio-btn" name="status" id="radio-2" type="radio" value="0" required
                    onclick="checkRadio(this)" disabled>
                <label class="radio-label" for="radio-2"> <span>&nbsp;&nbsp;&nbsp;ออกงาน (Check out)</span></label>
            </div>
            <?php
                if(!empty($success_msg)){
                    echo '<p class="statusMsg">'.$success_msg.'</p>';
                }elseif(!empty($error_msg)){
                    echo '<p class="statusMsg">'.$error_msg.'</p>';
                }
            ?>
            <p id="message"></p>
            <div class="form-group">
                <input type="submit" name="CheckSubmit" class="btn btn-primary btn-lg block full-width m-b"
                    value="บันทึกข้อมูล" id="CheckSubmit" disabled>
            </div>
        </form>
        <br>

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
        function runApp() {
            liff.getProfile().then(profile => {
                document.getElementById("pictureUrl").src = profile.pictureUrl;
                // document.getElementById("userId").innerHTML = profile.userId;
                document.getElementById("displayName").innerHTML = profile.displayName;
                // document.getElementById("statusMessage").innerHTML = profile.statusMessage;
                // document.getElementById("getDecodedIDToken").innerHTML = liff.getDecodedIDToken().email;
                var lineUserId = profile.userId;
                document.getElementById('lineUserId').value = lineUserId;
                // var displayName = profile.displayName;
                // document.getElementById('displayName').value = displayName;

            }).catch(err => console.error(err));
        }
        liff.init({
            // liffId ของระบบงาน
            liffId: "1654261952-8j694jWE"
        }, () => {
            if (liff.isLoggedIn()) {
                runApp()
            } else {
                liff.login();
            }
        }, err => console.error(err.code, error.message));

        // if hours/minutes/seconds is one digit, add a zero
        function doubleDigits(num) {
            if (num < 10) {
                return "0" + num;
            } else {
                return num;
            }
        }

        function displayTime() {
            // Get current time
            var today = new Date();
            // Assign hours, minutes, seconds to vars, but make them use the doubleDigits function to check if they consist of one digit, if they do, a 0 gets placed in front of them
            var h = doubleDigits(today.getHours());
            var m = doubleDigits(today.getMinutes());
            var s = doubleDigits(today.getSeconds());
            // Transfer values to HTML
            document.getElementById("hours").innerHTML = h;
            document.getElementById("minutes").innerHTML = m;
            document.getElementById("seconds").innerHTML = s;
            console.log('x')
        }

        function blinkers() {
            // Identify all the blinking parts
            var blinkingParts = document.getElementsByClassName('blinker');
            // Loop through the blinking parts, changing each one's css
            for (i = 0; i < blinkingParts.length; i++) {
                blinkingParts[i].style.opacity = (blinkingParts[i].style.opacity == '0.6' ? '0.2' : '0.6');
            };

        };
        // Run these functions every second
        setInterval(function () {
            displayTime();
            blinkers();
        }, 1000);

        function checkRadio(termsCheckBox) {
            if (termsCheckBox.checked) {
                document.getElementById("CheckSubmit").disabled = false;
            } else {
                document.getElementById("CheckSubmit").disabled = true;
            }
        }
    </script>
    <script>
        window.onload = function () {
            getLocation();
        }

        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else {
                window.alert("เบราเซอร์นี้ไม่รองรับ Geolocation");
            }
        }

        var BETWEEN_DEGREE = 15;
        var THOUSAND_METER = 1000;

        var SURFACE_DISTANCE_PER_ONE_DEGREE = [{
                latitude: 110.574,
                longitude: 111.320
            }, //0  degree
            {
                latitude: 110.649,
                longitude: 107.551
            }, //15 degree
            {
                latitude: 110.852,
                longitude: 96.486
            }, //30 degree
            {
                latitude: 111.132,
                longitude: 78.847
            }, //45 degree
            {
                latitude: 111.412,
                longitude: 55.800
            }, //60 degree  
            {
                latitude: 111.618,
                longitude: 28.902
            }, //75 degree
            {
                latitude: 111.694,
                longitude: 0.000
            } //90 degree
        ];
        var GPS = function (lat, lnt) {
            this.latitude = lat || 0;
            this.longitude = lnt || 0;
        };

        function getSurfaceDistance(gps) {
            return SURFACE_DISTANCE_PER_ONE_DEGREE[parseInt(gps.latitude / BETWEEN_DEGREE)]; //depend on latitude
        }

        function getLatitudeDistance(gps) {
            return getSurfaceDistance(gps).latitude * THOUSAND_METER;
        }

        function getLongitudeDistance(gps) {
            return getSurfaceDistance(gps).longitude * THOUSAND_METER;
        }


        function showPosition(position) {
            var Latitude = position.coords.latitude;
            var Longitude = position.coords.longitude;
            var distance, message;

            var checkIn = new GPS(17.448957, 102.904616);
            var gpsClient = new GPS(Latitude, Longitude);

            distance = findDistance(checkIn, gpsClient).toFixed(2);

            if (distance <= 80) {
                document.getElementById("radio-1").disabled = false;
                document.getElementById("radio-2").disabled = false;
                message ='<center><p style="color:green"><i class="fa fa-check-circle" aria-hidden="true"> สามารถลงเวลาปฏิบัติงานได้</i></p></center>'
            } else {
                document.getElementById("radio-1").disabled = true;
                document.getElementById("radio-2").disabled = true;
                message ='<center><p style="color:red"><i class="fa fa-exclamation-circle" aria-hidden="true"> คุณอยู่นอกพิกัด ไม่สามารถลงเวลาได้</i></p></center>'
            }

            document.getElementById('Latitude').value = Latitude;
            document.getElementById('Longitude').value = Longitude;
            document.getElementById("message").innerHTML = message;

        }

        function findDistance(checkIn, gpsClient) {

            var latitudeDistance1 = getLatitudeDistance(checkIn);
            var latitudeDistance2 = getLatitudeDistance(gpsClient);

            var longitudeDistance1 = getLongitudeDistance(checkIn);
            var longitudeDistance2 = getLongitudeDistance(gpsClient);

            // (X2 * a2 - X1 * a1) ^ 2
            var power1 = Math.pow((gpsClient.latitude * latitudeDistance2) - (checkIn.latitude * latitudeDistance1), 2);
            // (Y2 * b2 - Y1 * b1) ^ 2
            var power2 = Math.pow((gpsClient.longitude * longitudeDistance2) - (checkIn.longitude * longitudeDistance1),
                2);

            return Math.sqrt(power1 + power2);
        };
    </script>

</body>

</html>