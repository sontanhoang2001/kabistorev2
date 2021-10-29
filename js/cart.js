var indexCountMessage = 0;

//delete cart
$('a#remove-cart').each(function (index, val) {
    var cartWrapIndex = ".cartWrap:eq(" + index + ")";
    $(this).click(function (event) {
        event.preventDefault();
        var cartId = $(cartWrapIndex).attr("data-id-1");
        var quantity = $(".input-quantitys:eq(" + index + ")").val();
        var price = $(cartWrapIndex).attr("data-id-3");

        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/delCart.php",
            data: {
                'case': 0,
                'cartId': cartId,
                'quantity': quantity,
                'price': price
            },
            success: function (data) {
                var res = JSON.parse(data);
                switch (res.status) {
                    case 0: {
                        var message = "Xóa sản phẩm thất bại!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                        $("#payGroup").remove();
                        $(".cart").append('<div class="container"><div class="row"><div class="col-12"><p>Giỏ của bạn đang trống! Hãy mua sắm ngay bây giờ.</p></div></div></div>');
                        break;
                    }
                    case 1: {
                        $(cartWrapIndex).fadeOut(2000);
                        $(".number_cart").html(res.number_cart);
                        if ($('#discountPrice').text() == "Chưa nhập mã") {
                            resetDiscount();
                        } else {
                            promoCode = $('#promotion_code').val();
                            $('#promo_code').val(promoCode);
                            checkPromotionCode(promoCode, 1);
                        }

                        var message = "Xóa sản phẩm khỏi giỏ hàng thành công!";
                        let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                        toast.change('Đã lưu và thay đổi...', 2000);
                        break;
                    }
                    case 2: {
                        $(cartWrapIndex).css("display", "none");
                        $(".number_cart").html(res.number_cart);
                        $('#payGroup').remove();
                        $(".cart").append('<div class="container"><div class="row"><div class="col-12"><p>Giỏ của bạn đang trống! Hãy mua sắm ngay bây giờ.</p></div></div></div>');

                        var message = "Không có sản phẩm nào trong giỏ hàng!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Hãy tìm sản phẩm mới đi nào...', 3500);
                        break;
                    }
                    default: {
                        var message = "Lỗi máy chủ!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                    }
                }
            }
        });
    });
});

// chưa lấy đc index
// Update product size
$('.nice-select').each(function (index, val) {
    var cartWrapIndex = ".cartWrap:eq(" + index + ")";

    $('.nice-select:eq(' + index + ') .option:not(.disabled)').click(function (t) {
        var s = $(this),
            n = s.closest(".nice-select");
        productSize = s.data("value");
        var cartId = $(cartWrapIndex).attr("data-id-1");

        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/update-size-cart.php",
            data: {
                'cartId': cartId,
                'size': productSize
            },
            success: function (data) {
                success = JSON.parse(data).success;
                if (success == 1) {
                    var message = "Cập nhật size thành công!";
                    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                    toast.change('Đã lưu và thay đổi...', 2000);
                } else {
                    var message = "Cập nhật size thất bại!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            },
            error: function () {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    });
});

//update quantity cart
var rowTotalPrice;
$('.input-quantitys').each(function (index, val) {
    var quantityBefore, thisValBefore;

    $(this).focus(function () {
        $('#btn_checkout').attr('disabled', 'disabled');

        promotiontAllow = 0;

        quantityBefore = $(this).val();
        var localtion = $(this);
        thisValBefore = $(this).val();
    });

    $(this).focusout(function () {
        var cartWrapIndex = ".cartWrap:eq(" + index + ")";
        rowTotalPrice = $(cartWrapIndex).attr("data-id-3");

        // Trả nút xác nhận đơn hàng về trại thái ban đầu
        $('#btn_checkout').removeAttr('disabled');

        promotiontAllow = 1;

        // Get dữ liệu đừa vào biến
        var cartWrapIndex = ".cartWrap:eq(" + index + ")";
        var cartId = $(cartWrapIndex).attr("data-id-1"),
            productId = $(cartWrapIndex).attr("data-id-2"),
            quantity = $(this).val();

        // reset value input validate
        if (quantity == " ") {
            $(this).val(quantityBefore);
            $(this).val(quantity).css("width", "2ch");
            audioError.play();
            $(cartWrapIndex).append('<div class="alert alert-danger" id="error-qty1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Số lượng phải là số dương.</div>');
            $("#error-qty1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
        } else {
            if (quantity < 1) {
                quantity = quantityBefore;
                $(this).val(quantity).css("width", "2ch");
                audioError.play();
                $(cartWrapIndex).append('<div class="alert alert-danger" id="error-qty1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Số lượng không hợp lệ!.</div>');
                $("#error-qty1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
            } else {
                if (quantity > 10) {
                    quantity = quantityBefore;
                    $(this).val(quantity).css("width", "2ch");
                    audioError.play();
                    $(cartWrapIndex).append('<div class="alert alert-danger" id="error-qty2"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Bạn chỉ có thể đặt số lượng là 10. Trừ khi bạn là khách hàng thân thiết. <a href ="cart" class="alert-link">Chỉnh sửa</a ></div>');
                    $("#error-qty2").show().delay(5000).fadeOut(1000).queue(function () { $(this).remove(); });
                }
            }
        }

        if (quantityBefore != quantity) {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/updateCartQty.php",
                data: {
                    'case': 0,
                    'cartId': cartId,
                    'productId': productId,
                    'quantity': quantity
                },
                success: function (data) {
                    success = JSON.parse(data).success;
                    product_remain = JSON.parse(data).product_remain;
                    PutQuantity(success, product_remain);
                }
            });
        }

        function PutQuantity(success, product_remain) {
            if (success == false) {
                audioError.play();
                localtion.val(thisValBefore);
                $("#row_product_" + cartId).append('<div class="alert alert-danger" id="error-qty"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Chúng tôi chỉ còn ' + product_remain + ' sản phẩm. Vui lòng chỉnh sửa lại số lượng. <a href ="cart" class="alert-link">Chỉnh sửa</a ></div>');
                $("#error-qty").show().delay(5000).fadeOut(1000).queue(function () { $(this).remove(); });
            } else {
                // ajax load total price
                $.ajax({
                    type: "POST",
                    url: "~/../callbackPartial/updateCartQty.php",
                    data: {
                        'case': 1,
                        'cartId': cartId,
                        'quantityBefore': quantityBefore,
                        'quantity': quantity
                    },
                    success: function (data) {
                        console.log(data);
                        // cập nhật lại giá rowPrice
                        rowTotalPrice = currency_vn(rowTotalPrice * quantity);
                        $('p#rowTotalPrice').eq(index).text(rowTotalPrice);

                        var res = JSON.parse(data);
                        $('#subtotal').text(res.subtotal);
                        $('#ship').text("+ " + res.ship);
                        $('#discountPrice').text("Chưa nhập mã");
                        $('#total').text(res.total);

                        var promotionCode = $('#promotion_code').val();
                        if (promotionCode !== "") {
                            checkPromotionCode(promotionCode, 0);
                        }
                        if (disable_check_out == 1) {
                            location.reload();
                        }
                        var message = "Cập nhật số lượng thành công!";
                        let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                        toast.change('Đã lưu và thay đổi...', 2000);
                    }
                });
            }
        }
    });
});

function CheckPostPromotion(status, type, data) {
    switch (status) {
        case 0:
            audioError.play();
            resetDiscount();
            $("#success-promo").css("display", "none")
            $("#error-promo").html('<b>Cảnh báo!</b> Mã giảm giá bạn vừa nhập không đúng hoặc không tồn tại.').show().delay(6000).fadeOut(2000);
            $('#error-promo').show().delay(4000).fadeOut(1000);
            // Xóa code giảm giá nhập sai
            $('#promotion_code').val("");

            // Trả nút xác nhận đơn hàng về trại thái ban đầu
            $('#btn_checkout').removeAttr('disabled');

            break;
        case 1:
            audioError.play();
            resetDiscount();
            $("#success-promo").css("display", "none")
            $.each(JSON.parse(data), function (key, val) {
                $("#error-promo").html('<b>Cảnh báo!</b> Đơn hàng của bạn vẫn chưa điều kiện để giảm giá [' + val[0].promotionsName + '] Giảm ' + val[0].discountMoney + ' ₫ cho tổng giá trị đơn hàng từ ' + val[0].condition + ' ₫.').show().delay(6000).fadeOut(2000);
            });
            $('#error-promo').show().delay(6000).fadeOut(2000);

            // Xóa code giảm giá nhập sai
            $('#promotion_code').val("");

            // Trả nút xác nhận đơn hàng về trại thái ban đầu
            $('#btn_checkout').removeAttr('disabled');
            break;
        case 2:
            audioError.play();
            resetDiscount();
            $("#success-promo").css("display", "none")
            $("#error-promo").html('<b>Thông báo!</b> Rất tiết mã giảm giá này đã hết hạn vài giờ trước.').show().delay(6000).fadeOut(2000);;
            $('#error-promo').show().delay(4000).fadeOut(1000);
            // Xóa code giảm giá nhập sai
            $('#promotion_code').val("");

            // Trả nút xác nhận đơn hàng về trại thái ban đầu
            $('#btn_checkout').removeAttr('disabled');
            break;
        case 3:
            // Thành công
            audioSuccess.play();
            $('#btn_checkout').removeAttr('disabled');
            promotiontAllow = 1;
            $.each(JSON.parse(data), function (key, val) {
                if (val[0].deadlinedate != "0 giờ") {
                    $("#success-promo").html('<b>Nhập mã thành công!</b> ' + val[0].promotionsName + '. Giảm ' + val[0].discountMoney + ' ₫ cho tổng giá trị đơn hàng từ ' + val[0].condition + ' ₫. Thời hạn sử dụng còn ' + val[0].deadlinedate + '.').show().delay(6000).fadeOut(2000);
                } else {
                    $("#success-promo").html('<b>Nhập mã thành công!</b> ' + val[0].promotionsName + '. Giảm ' + val[0].discountMoney + ' ₫ cho tổng giá trị đơn hàng từ ' + val[0].condition + ' ₫. Thời hạn sử dụng còn khoảng vài phút nữa. Hãy nhanh tay lên nào!').show().delay(6000).fadeOut(2000);
                }
            });

            if (type == 1) {
                $('#success-promo').show().show().delay(6000).fadeOut(2000);
            }

            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/discount.php",
                data: {
                    'case': 1,
                    'promoCode': promoCode
                },
                success: function (data) {
                    var res = JSON.parse(data);
                    $('#subtotal').text(res.subtotal);
                    $('#ship').text("+ " + res.ship);
                    $('#discountPrice').text("- " + res.discount);
                    $('#total').text(res.total);

                }
            });
            break;
        default:
    }
}

function checkPromotionCode(promoCode, type) {
    if (promoCode != "") {
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/discount.php",
            data: {
                'case': 0,
                'promoCode': promoCode
            },
            success: function (data) {
                // console.log(data);
                var status,
                    Data = data;
                $.each(JSON.parse(data), function (key, val) {
                    status = val[0].status;
                });
                CheckPostPromotion(status, type, Data);
            }
        });
    }
}


function resetDiscount() {
    promotiontAllow = 1;
    audioError.play();
    $.ajax({
        type: "POST",
        url: "~/../callbackPartial/discount.php",
        data: {
            'case': 2,
            'promoCode': promoCode
        },
        success: function (data) {
            var res = JSON.parse(data);
            $('#subtotal').text(res.subtotal);
            $('#ship').text(res.ship);
            $('#discountPrice').text("Chưa nhập mã");
            $('#total').text(res.total);
        }
    });
}

// Bắt đầu kiểm tra nếu nhập vào mã giảm giá thì disabale btn xác nhận giỏ hàng
if (disable_check_out == 1) {
    $('#btn_checkout').attr('disabled', 'disabled');
}
$('#promotion_code').change(function () {
    if ($('#promotion_code').val() == "") {
        // Trả nút xác nhận đơn hàng về trại thái ban đầu
        $('#btn_checkout').removeAttr('disabled');
        promotiontAllow = 1;
    } else {
        $('#btn_checkout').attr('disabled', 'disabled');
        promotiontAllow = 0;
    }
});
$('#promotion_code').keyup(function () {
    if ($('#promotion_code').val() == "") {
        // Trả nút xác nhận đơn hàng về trại thái ban đầu
        $('#btn_checkout').removeAttr('disabled');
        promotiontAllow = 1;
    } else {
        $('#btn_checkout').attr('disabled', 'disabled');
        promotiontAllow = 0;
    }
});
// Kết thúc kiểm tra nếu nhập vào mã giảm giá thì disabale btn xác nhận giỏ hàng

$('#f_promo').submit(function (e) {
    e.preventDefault();
    promoCode = $('#promotion_code').val();
    $('#promo_code').val(promoCode);
    checkPromotionCode(promoCode, 1);
});


var error_promotionCode_index = 1;
$('#f_cart').submit(function (e) {
    if (promotiontAllow == 0 || disable_check_out == 1) {
        audioError.play();
        $(".errorRow").append('<div class="alert alert-danger" id="error-orderCart_' + error_promotionCode_index + '"><strong>Cảnh báo!</strong> Bạn có 1 sản phẩm đang hết hàng. Vui lòng chỉnh sửa lại. <a href="#location-group" class="alert-link">Sửa lỗi</a>.</div>');
        $("#error-orderCart_" + error_promotionCode_index).show().delay(3000).fadeOut(1000).queue(function () {
            $(this).remove();
        });
    } else if (promotiontAllow == 0) {
        audioError.play();
        $(".errorRow").append('<div class="alert alert-danger" id="error-orderCart_' + error_promotionCode_index + '"><strong>Cảnh báo!</strong> Vui lòng nhấn kiểm tra mã giảm giá! <a href="#location-group" class="alert-link">Sửa lỗi</a>.</div>');
        $("#error-orderCart_" + error_promotionCode_index).show().delay(3000).fadeOut(1000).queue(function () {
            $(this).remove();
        });
    }
    error_promotionCode_index++;
});