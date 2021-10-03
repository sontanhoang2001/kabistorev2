mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: user_location,
        zoom: 14
    });
    //  geocoder here
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        // limit results to Australia
        country: 'VN',
    });

    // Add the control to the map.
    map.addControl(
        new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
        })
    );

    // Add Control Fullscreen 
    map.addControl(new mapboxgl.FullscreenControl());
    // Add Control NavigationControl 
    map.addControl(new mapboxgl.NavigationControl());

    // Add geolocate control to the map.
    // map.addControl(
    //     new mapboxgl.GeolocateControl({
    //         positionOptions: {
    //             enableHighAccuracy: true
    //         },
    //         trackUserLocation: true
    //     })
    // );

    // Initialize the geolocate control.
    var geolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true
    });
    map.addControl(geolocate);

    // layer list menu-map
    var layerList = document.getElementById('menu-map');
    var inputs = layerList.getElementsByTagName('input');

    function switchLayer(layer) {
        var layerId = layer.target.id;
        map.setStyle('mapbox://styles/mapbox/' + layerId);
    }

    for (var i = 0; i < inputs.length; i++) {
        inputs[i].onclick = switchLayer;
    }
    var marker;

    // After the map style has loaded on the page, add a source layer and default
    // styling for a single point.
    map.on('load', function() {
        addMarker(user_location, 'load');
        // add_markers(saved_markers);

        // Listen for the `result` event from the MapboxGeocoder that is triggered when a user
        // makes a selection and add a symbol that matches the result.
        geocoder.on('result', function(ev) {
            // alert("aaaaa");
            // console.log(ev.result.center);

        });
    });

    // Get the geocoder results container.
    // var results = document.getElementById('result');

    // async getGeocoding
    async function getGeocoding(lng, lat) {
        const api_url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + lng + ',' + lat + '.json?access_token=pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
        const response = await fetch(api_url);
        const data = await response.json();
        const {
            features
        } = data;
        // console.log(features[0].place_name);
        // console.log(api_url);

        // results.textContent = features;
        var text_geocoder = document.getElementById("geo-text");
        var btn_lock = document.getElementById("saveLocaltion");
        text_geocoder.classList.remove("text-danger");
        text_geocoder.classList.add("text-success");
        document.getElementById("lat").value = lat;
        document.getElementById("lng").value = lng;
        document.getElementById("geocoding").value = features[0].place_name;
        text_geocoder.innerHTML = features[0].place_name;
        allow_order = true;
        btn_lock.classList.remove("btn-danger");
        btn_lock.classList.add("btn-success");
        document.getElementById("orders").style.background = "#28a745";
    }

    map.on('click', function(e) {
        marker.remove();
        addMarker(e.lngLat, 'click');
        //console.log(e.lngLat.lat);
        const lng = e.lngLat.lng;
        const lat = e.lngLat.lat;

        document.getElementById("lat").value = lat;
        document.getElementById("lng").value = lng;

        getGeocoding(lng, lat);

        // document.getElementById("geocoder").innerHTML = "Địa chỉ hiện tại của bạn: " + "ok";
    });

    function addMarker(ltlng, event) {

        if (event === 'click') {
            user_location = ltlng;
        }

        marker = new mapboxgl.Marker({
                draggable: true,
                color: "#d02922"
            })
            .setLngLat(user_location)
            .addTo(map)
            .on('dragend', onDragEnd);
    }

    function add_markers(coordinates) {

        var geojson = (saved_markers == coordinates ? saved_markers : '');

        //console.log(geojson);

        // add markers to map
        geojson.forEach(function(marker) {
            //console.log(marker);
            // make a marker for each feature and add to the map
            new mapboxgl.Marker()
                .setLngLat(marker)
                .addTo(map);
        });
    }

    function onDragEnd() {
        var lngLat = marker.getLngLat();
        document.getElementById("lat").value = lngLat.lat;
        document.getElementById("lng").value = lngLat.lng;
        //console.log('lng: ' + lngLat.lng + '<br />lat: ' + lngLat.lat);
        const lat = lngLat.lat;
        const lng = lngLat.lng;
        getGeocoding(lng, lat);
    }

    //button getLocation
    function getLocation() {
        geolocate._geolocateButton.click();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(add_markers_to_geolocate_control);
        } else {
            alert("Trình duyệt của bạn không hỗ trợ GPS, vui lòng cài đặt trình duyệt chrome.");
        }
    }
    
    //function add markers to Navigation Control
    function add_markers_to_geolocate_control(position) {
        const lat = position.coords.longitude;
        const lng = position.coords.latitude;
        const location = [lat, lng];
        marker.remove();
        addMarker(location, 'click');
        getGeocoding(lat, lng);
    }

    // document.getElementById('geo-text').appendChild(geocoder.onAdd(map));
