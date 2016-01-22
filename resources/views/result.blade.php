<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Geocoding Result</title>
    <link href="{{ asset('assets/css/text.css') }}" rel="stylesheet">
</head>

<body>
    <span class="extruded">You estimated to be at: </span><br>
    <span class="extruded">Street: {{ $streetName }}</span><br>
    <span class="extruded">City: {{ $city }}</span><br>
    <span class="extruded">Region: {{ $region }} </span><br>
    <span class="extruded">Country: {{ $country }} </span><br>
    <span class="extruded">Latitude: {{ $latitude }} </span><br>
    <span class="extruded">Longitude: {{ $longitude }} </span><br>
</body>

</html>