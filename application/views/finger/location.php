<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>GPS</title>

</head>

<body>


    <p id="demo"></p>
    <input type="text" name="Latitude" class="form-control input-sm" id="Latitude" />
    <input type="text" name="Longitude" class="form-control input-sm" id="Longitude" />
    <br>
    <h3 id="Status"></h3>



    <script>
        window.onload = function () {
            getLocation();
        }

        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
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
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
            var Latitude = position.coords.latitude;
            var Longitude = position.coords.longitude;
            var distance, message;

            var checkIn = new GPS(17.448957, 102.904616);
            var gpsClient = new GPS(Latitude, Longitude);

            distance = findDistance(checkIn, gpsClient).toFixed(2);

            if(distance <= 50){
                message = 'สามารถลงเวลาปฏิบัติงาน '+distance;
            }else{
                message = 'คุณอยู่นอกพิกัด ไม่สามารถลงเวลาได้ '+distance;
                // window.alert("คุณอยู่นอกพิกัด ไม่สามารถลงเวลาได้");
                // window.history.back();
            }
            document.getElementById('Latitude').value = Latitude;
            document.getElementById('Longitude').value = Longitude;
            document.getElementById("Status").innerHTML = message;

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