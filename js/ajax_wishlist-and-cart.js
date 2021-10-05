$(document).ready(function () {
    var indexCountMessage = 0;
    $(".add_to_wishlist").click(function (event) {
        var class_localtion = $(this);
        var productStatus = $(this).attr("data-id-1"),
            productId = $(this).attr("href");
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "ajax-add_to_wishlist.php",
            data: {
                'data': 0,
                'productId': productId
            },
            success: function (data) {
                $(".myModal_text").html(data);
                // $("#myModal").modal('show');
                $(class_localtion).toggleClass("fa-heart fa-heart-o");
                if (productStatus == 0) {
                    $(class_localtion).attr('data-id-1', 1);
                    $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Thêm yêu thích thành công!!!</div>');
                    $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                } else {
                    $(class_localtion).attr('data-id-1', 0);
                    $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Đã xóa yêu thích thành công!!!</div>');
                    $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                }
            }
        });
    });

    $(".add_to_wishlist_details").click(function (event) {
        var productId = $(location).attr('search').substring(7);
        alert(productId);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "ajax-add_to_wishlist.php",
            data: {
                'data': 0,
                'productId': productId
            },
            success: function (data) {
                $('.heart').toggleClass("is-active");
            }
        });
    });

    // Xóa wishlist
    $("#remove-wishlist").click(function (event) {
        event.preventDefault();
        var productId = $(this).attr("href");

        $.ajax({
            type: "POST",
            url: "ajax-add_to_wishlist.php",
            data: {
                'data': 0,
                'productId': productId
            },
            success: function (data) {
                $("#row_product_" + productId).remove();

                $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Xóa yêu thích thành công!!!</div>');
                $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
            }, error: function (data) {
                audioError.play();
                $("#message").append('<div class="alert-box failure notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Xóa yêu thích thất bại!!!</a ></div>');
                $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
            }
        });
    });

    $(".add_to_cart").click(function (event) {
        var productId = $(this).attr("href"),
            productSize = $(this).attr("data-id-1");
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/add-to-cart.php",
            data: {
                'productId': productId,
                'productSize': productSize,
                'quantity': 1
            },
            success: function (data) {
                // $(".myModal_text").html("Bạn đã thêm vào giỏ hàng thành công!");
                // $("#myModal").modal('show');

                Status = JSON.parse(data).status;
                Value = JSON.parse(data).value;

                switch (Status) {
                    case 0: {
                        window.location = 'login.php';
                        break;
                    }
                    case 1: {
                        $(".number_cart").html(Value);
                        $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Thêm giỏ hàng thành công!!!</div>');
                        $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                        break;
                    }
                    case 2: {
                        audioError.play();
                        $("#message").append('<div class="alert-box failure notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Lỗi máy chủ!!!.</div>');
                        $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                        break;
                    }
                    case 3: {
                        audioError.play();
                        $("#message").append('<div class="alert-box failure notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Chúng tôi chỉ còn ' + Value + ' sản phẩm. Vui lòng chỉnh sửa lại.</div>');
                        $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                        break;
                    }
                    case 4: {
                        audioError.play();
                        $("#message").append('<div class="alert-box failure notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Giỏ hàng của bạn đã đầy. <a href ="cart" class="alert-link">Sửa giỏ hàng</a ></div>');
                        $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                        break;
                    }
                    default:
                }
            },
            error: function (data) {
                audioError.play();
                $("#message").append('<div class="alert alert-danger" id="success-message">Lỗi máy chủ!!!</div>');
                $("#success-message").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
            }
        });
        indexCountMessage++;
    });

    var productSize = 0;
    $('#cartSubmit').on("click", ".nice-select:eq(0) .option:not(.disabled)", function (t) {
        var s = $(this),
            n = s.closest(".nice-select");
        productSize = s.data("value");
    });

    $("#cartSubmit").submit(function (e) {
        e.preventDefault();
        var productId = $("#add-to-cart").val();
        var quantity = $("#quantity").val()

        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/add-to-cart.php",
            data: {
                'productId': productId,
                'productSize': productSize,
                'quantity': quantity
            },
            success: function (data) {
                Status = JSON.parse(data).status;
                Value = JSON.parse(data).value;
                switch (Status) {
                    case 0: {
                        window.location = 'login.php';
                        break;
                    }
                    case 1: {
                        $(".number_cart").html(Value);
                        window.location = 'cart.php';
                        break;
                    }
                    case 2: {
                        audioError.play();
                        $("#error-submit").append('<div class="alert-box failure notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Lỗi máy chủ!!!.</div>');
                        $("#rror-submit1" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                        break;
                    }
                    case 3: {
                        audioError.play();
                        $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Chúng tôi chỉ còn ' + Value + ' sản phẩm. Vui lòng chỉnh sửa lại.</div>');
                        $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                        break;
                    }
                    case 4: {
                        audioError.play();
                        $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Giỏ hàng của bạn đã đầy. Hãy vào thanh toán hoặc chỉnh sửa giỏ hàng. <a href ="cart" class="alert-link">Vào giỏ hàng</a ></div>');
                        $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                        break;
                    }
                    default:
                }

                // $(".myModal_text").html("Bạn đã thêm vào giỏ hàng thành công!");
                // $("#myModal").modal('show');
            }, error: function (data) {
                audioError.play();
                $("#error-submit").append('<div class="alert alert-danger" id="error-submit1">Lỗi máy chủ!!!</div>');
                $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
            }
        });
    });


    $('.input-quantity').focus(function () {
        $('.essence-btn').css("background-color", "rgb(153, 153, 153)");
    });

    $('.input-quantity').blur(function () {
        $('.essence-btn').css("background-color", "#ff9f1a");
    });

    // validate quantity
    $('.input-quantity').each(function (index, val) {
        var quantityBefore;
        $(this).focus(function () {
            $(this).css("box-shadow", "0 2px 5px rgb(0 0 0 / 50%");
            $(this).css("border", "1px solid rgb(33 37 41 / 0%");
            $(this).css("border-radius", "5px");
            // $(".stockStatus").css("display", "none");
            quantityBefore = $(this).val();
        });

        $(this).focusout(function () {
            $(this).css("box-shadow", "0 2px 5px rgb(0 0 0 / 30%)");
            $(this).css("border", "none");
            $(this).css("border-radius", "5px");
            // $(".stockStatus").css("display", "inline-block");

            var cartId = $(this).attr("data-id-1"),
                productId = $(this).attr("data-id-2"),
                quantity = $(this).val();

            // reset value input validate
            if (quantity == " ") {
                $(this).val(quantityBefore);
                audioError.play();
                $("#error-qty").append('<div class="alert alert-danger" id="error-qty1"><strong>Cảnh báos!</strong><p class="text-success-result"></b></p>Số lượng phải là số dương.</div>');
                $("#error-qty1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
            } else {
                if (quantity < 1) {
                    quantity = quantityBefore;
                    $(this).val(quantity);
                    audioError.play();
                    $("#error-qty").append('<div class="alert alert-danger" id="error-qty1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Số lượng không hợp lệ!.</div>');
                    $("#error-qty1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                } else {
                    if (quantity > 10) {
                        quantity = quantityBefore;
                        $(this).val(quantity);
                        audioError.play();
                        $("#error-qty").append('<div class="alert alert-danger" id="error-qty2"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Bạn chỉ có thể đặt số lượng là 10. Trừ khi bạn là khách hàng thân thiết.</div>');
                        $("#error-qty2").show().delay(5000).fadeOut(1000).queue(function () { $(this).remove(); });
                    }
                }
            }
        });
    });
});
