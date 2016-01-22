<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Geocoding Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
<div id="menuBall2" class="menuBall">
    <a href="#" class="ball redball" onclick="getLocation();">
        <div class="menuText">
            Get My Location
        </div>
    </a>
</div>
</body>

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(savePosition, positionError, {timeout:10000});
        } else {
            alert("Geolocation is not supported by this browser");
        }
    }

    // handle the error here
    function positionError(error) {
        var errorCode = error.code;
        var message = error.message;

        alert(message);
    }

    function savePosition(position) {
        $.post("<?php echo route('geolocate') ?>", {lat: position.coords.latitude, lng: position.coords.longitude});
        var form = document.createElement("form");
        form.method = 'post';
        form.action = '<?php echo route('geolocate') ?>';

        var lat = document.createElement('input');
        lat.type = "text";
        lat.name = "lat";
        lat.value = position.coords.latitude;

        var lng = document.createElement('input');
        lng.type = "text";
        lng.name = "lng";
        lng.value = position.coords.longitude;

        form.appendChild(lat);
        form.appendChild(lng);
        form.submit();
    }
</script>
</html>