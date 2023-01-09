function loadCustomerMap() {

    var mapLat, mapLng;
    // lấy dữ liệu row table hiện tại
    $(".btn[data-target='#customerModal']").click(function () {
        mapLat = $(this).attr("data-lat");
        mapLng = $(this).attr("data-lng");
    });

    // load map order address
    $("#btnloadCustomerMap").click(function () {    
        var lng = mapLng, lat = mapLat;
        // lấy tên vị trí bản đồ
        getGeocodingOrderMap(lng, lat);

        // load lại order map
        $("#googlemapOrderAddress").attr("href", "https://maps.google.com/?q=" + lat + "," + lng);
        loadOrderMap(lng, lat);
    });
}