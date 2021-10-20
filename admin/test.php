<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Demo: Switch from Google Maps to Mapbox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet" />
    <style>
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 500px;
            height: 500px;
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';

        const map = new mapboxgl.Map({
            container: 'map', // HTML container id
            style: 'mapbox://styles/mapbox/streets-v11', // style URL
            center: [-21.92661562, 64.14356426], // starting position as [lng, lat]
            zoom: 13
        });

        const popup = new mapboxgl.Popup().setHTML(
            `<h3>Reykjavik Roasters</h3><p>A good coffee shop</p>`
        );

        const marker = new mapboxgl.Marker()
            .setLngLat([-21.92661562, 64.14356426])
            .setPopup(popup)
            .addTo(map);
    </script>



</body>

</html>





