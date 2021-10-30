// Load customer info
$("a[data-target='#customerModal']").click(function (event) {
    address_id
    var address_id = $(this).attr("data-address_id"),
        maps_maplat = $(this).attr("data-maps_maplat"),
        maps_maplng = $(this).attr("data-maps_maplng"),
        note_address = $(this).attr("data-note_address");
    var lng = maps_maplng, lat = maps_maplat;
    // lấy tên vị trí bản đồ
    getGeocodingOrderMap(lng, lat);
    $('#cusNoteModel').val(note_address);
    $("#cusAddress_id").val(address_id);

    // load lại order map
    loadOrderMap(lng, lat);
    $("#googlemapOrderAddress").attr("href", "https://maps.google.com/?q=" + lat + "," + lng);
});
