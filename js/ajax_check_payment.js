var Selected = 1;
$(document).ready(function () {
    var payment_methods = true;
    // var location;

    $('#f_order input').on('change', function () {
        var selected = $('input[name="payment_methods"]:checked').val();
        Selected = selected;
        if (selected == 1) {
            payment_methods = true;
            $(".text-payment-methods").text('Phương thức thanh toán bằng tiền mặt');
        } else {
            payment_methods = false;
            if (selected == 2) {
                $(".text-payment-methods").text('Phương thức thanh toán bằng momo');
            } else {
                $(".text-payment-methods").text('Phương thức thanh toán bằng thẻ Visa');
            }
        }
    });

    function ajaxCallBack(i, success, cartId, productName, quantity, product_remain) {
        if (success == true) {
            audioSuccess.play();
            window.location.replace(getAbsolutePath() + "success.html");
        } else {
            $(".error-group").append('<div class="alert alert-danger" id="error-payment-methods_ajax' + i + '"><strong>Cảnh báo!</strong><p class="text-success-result">Bạn đã đặt sản phẩm: <b> ' + productName + ' </b></p> với số lượng là ' + quantity + ' Chúng tôi chỉ còn ' + product_remain + ' sản phẩm. Vui lòng chỉnh sửa lại số lượng. <a href ="cart" class="alert-link">Chỉnh sửa</a ></div>');
            $("#error-payment-methods_ajax" + i).show().delay(10000).fadeOut(1000).queue(function () { $(this).remove(); });
            $("div#c" + cartId).css("background-color", "pink");
        }
    }

    $('#f_order').submit(function (e) {
        if (allow_order == false) {
            e.preventDefault();
            audioError.play();
            $("#error-geocoder").show().delay(5000).fadeOut(1000);
        } else if (phone == 0) {
            e.preventDefault();
            $("#error-payment-methods-phone").show().delay(5000).fadeOut(1000);
            audioError.play();
            $(".error-group").append('<div class="alert alert-danger" id="error-payment-methods-phone"><strong>Cảnh báo!</strong> Bạn chưa cập nhật số điện thoại vui lòng cập nhật ngay. <a href="profile.html" class="alert-link">Cập nhật</a>.</div>');
            $("#error-payment-methods-phone").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
        } else if (Selected == 2) {
            e.preventDefault();
            audioError.play();
            $("#error-payment-methods1").show().delay(7000).fadeOut(1000);
        } else if (Selected == 3) {
            audioError.play();
            e.preventDefault();
            $("#error-payment-methods2").show().delay(7000).fadeOut(1000);
        }
        else {
            var formData = {
                maps_maplat: $("#lat").val(),
                maps_maplng: $("#lng").val(),
                note: $("#note").val()
                // address: $("#address").val(),
            };
            var success;
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/checkPayment.php",
                dataType: 'json',
                data: {
                    'formData': formData
                },
                success: function (data) {
                    $.each(data, function (i, value) {
                        var success = value[0].success,
                            cartId = value[0].cartId,
                            productName = value[0].productName,
                            quantity = value[0].quantity,
                            product_remain = value[0].product_remain;
                        ajaxCallBack(i, success, cartId, productName, quantity, product_remain);
                    });
                }, error: function (data) {
                    console.log(data);
                    var message = "Lỗi máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            });
            e.preventDefault(success);
        }
    });
});