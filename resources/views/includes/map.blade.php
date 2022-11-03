<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps.css">
    <script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps-web.min.js">
    </script>


</head>

<body>
    <input id="lat" type="text" class="form-control" name="latitude" id="lat"
        value="{{ old('latitude', $flat->latitude) }}" hidden>

    <input id="lon" type="text" class="form-control" name="longitude" id="lon"
        value="{{ old('longitude', $flat->longitude) }}" hidden>

    <div id="map" style="width: 100%;height: 600px">
    </div>
    <script type="text/javascript">
        const longitude = document.getElementById('lon').value;
        const latitude = document.getElementById('lat').value;

        let center = [longitude, latitude];
        let map = tt.map({
            key: "LoUScCfSMvO6XE0DcnNW32fDqHOr2BKj",
            container: "map",
            center: center,
            zoom: 13,
        })

        map.on('load', () => {
            new tt.Marker().setLngLat(center).addTo(map)
        })
    </script>

</body>

</html>
