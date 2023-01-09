$("input[name='priceShipping']").keyup(function (event) {
    if ($(this).val().length == 0) {
        $("button[name='submit']").attr("disabled", true);
        $('#priceShippingNew').text(currency_vn(0));
    } else {
        $("button[name='submit']").removeAttr("disabled");
        var priceShipping = $(this).val();
        $('#priceShippingNew').text(currency_vn(priceShipping));
    }
});

$("input[name='priceShipping']").blur(function (event) {
    if ($(this).val().length == 0) {
        $("button[name='submit']").attr("disabled", true);
        $('#priceShippingNew').text(currency_vn(0));
    } else {
        $("button[name='submit']").removeAttr("disabled");
        var priceShipping = $(this).val();
        $('#priceShippingNew').text(currency_vn(priceShipping));
    }
});