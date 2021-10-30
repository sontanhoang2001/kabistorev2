// async getGocoding
async function getGeocodingInfo(lng, lat) {
    const api_url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + lng + ',' + lat + '.json?access_token=pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
    const response = await fetch(api_url);
    const data = await response.json();
    const {
        features
    } = data;
    document.getElementById("geocodingAddressSave").innerHTML = features[0].place_name;
    document.getElementById("geocodingAddressSave").innerHTML = features[0].place_name;
}


async function getGeocodingOrderMap(lng, lat) {
    const api_url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + lng + ',' + lat + '.json?access_token=pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
    const response = await fetch(api_url);
    const data = await response.json();
    const {
        features
    } = data;
    document.getElementById("geocodingOrderAddress").innerHTML = features[0].place_name;
    try {
        document.getElementById("geocodingAddressSave").innerHTML = features[0].place_name;
    } catch (error) {

    }
}

mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';

function loadOrderMap(cusMaps_maplat, cusMaps_maplng) {
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [cusMaps_maplat, cusMaps_maplng],
        zoom: 14
    });

    // Add Control Fullscreen 
    map.addControl(new mapboxgl.FullscreenControl());
    // Add Control NavigationControl 
    map.addControl(new mapboxgl.NavigationControl());

    // Vị trí hiện tại
    map.addControl(
        new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            // When active the map will receive updates to the device's location as it changes.
            trackUserLocation: true,
            // Draw an arrow next to the location dot to indicate which direction the device is heading.
            showUserHeading: true
        })
    );


    // Chỉ đường
    // map.addControl(
    //     new MapboxDirections({
    //         accessToken: mapboxgl.accessToken
    //     }),
    //     'top-left'
    // );

    // Create a default Marker and add it to the map.
    const marker1 = new mapboxgl.Marker({ color: 'red' })
        .setLngLat([cusMaps_maplat, cusMaps_maplng])
        .addTo(map);
}