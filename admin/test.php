<!-- <!DOCTYPE html>
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




 -->


<?php
include "../lib/Snoopy.class.php";
require "../lib/simple_html_dom.php";

// $actual_link = substr($_SERVER['PHP_SELF'], 13);

$_SESSION['is_login'] = true;
$snoopy = new Snoopy;
$snoopy->fetch("https://www.facebook.com/ilovekabistore/posts/117394317351368");

$asp =  $snoopy->results;
// Create DOM from URL or file

$html = str_get_html($asp);

// Find all links


$slides_href = $html->find("div.slide a");
$slides_img = $html->find("div.slide a img");
$tin_tuyen_sinh_href_first = $html->find("div div div.news-content div.css_tintuc_tbox div a.css_tintuc_link_btitle");
$tin_tuyen_sinh_title_first = $html->find("div.news-content div.css_tintuc_tbox div a");
$tin_tuyen_sinh_img_first = $html->find("div div div.news-content div.css_tintuc_tbox div img");
$tin_tuyen_sinh_content_first = $html->find("div div div.news-content div.css_tintuc_tbox div p");
$tin_tuyen_sinh_href = $html->find("div.css_tintuc_box a.css_tintuc_link_title");
$tin_tuyen_sinh_title = $html->find("div.css_tintuc_box a.css_tintuc_link_title p.other-news");
$tin_tuyen_sinh_img = $html->find("div.css_tintuc_box a.css_tintuc_link_title div img");

?>
<!-- <base href="https://aptech.cusc.vn/"> -->

<?php
echo $html;