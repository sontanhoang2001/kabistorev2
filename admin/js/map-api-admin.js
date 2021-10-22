// async getGocoding
async function getGeocoding(lng, lat) {
    const api_url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + lng + ',' + lat + '.json?access_token=pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
    const response = await fetch(api_url);
    const data = await response.json();
    const {
        features
    } = data;
    document.getElementById("geocoding").innerHTML = features[0].place_name;
}


function mapSave() {
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [12.550343, 55.665957],
        zoom: 10
    });

    // Create a default Marker and add it to the map.
    const marker1 = new mapboxgl.Marker({ color: 'red' })
        .setLngLat([12.554729, 55.70651])
        .addTo(map);
}