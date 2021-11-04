var indexCountMessage = 0;
$(".add_to_wishlist").click(function (event) {
    var class_localtion = $(this);
    var productId = $(this).attr("data-productid");

    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "~/../callbackPartial/wishlist.php",
        data: {
            'productId': productId
        },
        success: function (data) {
            Status = JSON.parse(data).status;

            switch (Status) {
                case 0: {
                    window.location = 'login.html';
                    break;
                }
                case 1: {
                    $(class_localtion).toggleClass("fa-heart fa-heart-o");
                    var message = "Thêm yêu thích thành công!";
                    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                    toast.change('Đã thêm lưu vào yêu thích!', 2000);
                    break;
                }
                case 2: {
                    var message = "Thêm yêu thích thất bại!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                    break;
                }
                case 3: {
                    $(class_localtion).toggleClass("fa-heart fa-heart-o");
                    var message = "Xóa yêu thích thành công!";
                    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                    toast.change('Đã xóa khỏi yêu thích...', 3500);
                    break;
                }
                case 4: {
                    var message = "Xóa yêu thích thất bại!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
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

$(".add_to_wishlist_details").click(function (event) {
    // var productId = $(location).attr('search');
    var productId = $(this).attr('data-productId');

    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "~/../callbackPartial/wishlist.php",
        data: {
            'productId': productId
        },
        success: function (data) {
            Status = JSON.parse(data).status;
            switch (Status) {
                case 0: {
                    window.location = 'login.html';
                    break;
                }
                case 1: {
                    $('.heart').toggleClass("is-active");
                    var message = "Thêm yêu thích thành công!";
                    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                    toast.change('Đã thêm lưu vào yêu thích!', 2000);
                    break;
                }
                case 2: {
                    var message = "Thêm yêu thích thất bại!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                    break;
                }
                case 3: {
                    $('.heart').toggleClass("is-active");
                    var message = "Xóa yêu thích thành công!";
                    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                    toast.change('Đã xóa khỏi yêu thích...', 3500);
                    break;
                }
                case 4: {
                    var message = "Xóa yêu thích thất bại!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
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


//delete wishlist
$('a#remove-wishlist').each(function (index, val) {
    var cartWrapIndex = ".cartWrap:eq(" + index + ")";
    $(this).click(function (event) {
        event.preventDefault();
        var productId = $(cartWrapIndex).attr("data-id-1");
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/wishlist.php",
            data: {
                'productId': productId
            },
            success: function (data) {
                Status = JSON.parse(data).status;
                switch (Status) {
                    case 3: {
                        $(cartWrapIndex).addClass("effectDelCart").fadeOut(1500);
                        var message = "Xóa yêu thích thành công";
                        let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                        toast.change('Đã xóa và thay đổi...', 2000);
                        break;
                    }
                    case 4: {
                        var message = "Xóa yêu thích thất bại!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
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

// Add to cart
$(".add_to_cart").click(function (event) {
    var productId = $(this).attr("data-productid");
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
            Status = JSON.parse(data).status;
            Value = JSON.parse(data).value;

            switch (Status) {
                case 0: {
                    window.location = 'login.html';
                    break;
                }
                case 1: {
                    $(".number_cart").html(Value);
                    var message = "Thêm vào giỏ hàng thành công!";
                    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                    toast.change('Đã lưu vào giỏ hàng!', 2000);
                    break;
                }
                case 2: {
                    var message = "Lỗi máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                    break;
                }
                case 3: {
                    var message = "Chúng tôi chỉ còn " + Value + " sản phẩm!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng tìm sp tương tự...', 3500);
                    break;
                }
                case 4: {
                    var message = "Giỏ hàng của bạn đã đầy!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Hãy vào giỏ hàng để kiểm tra...', 3500);
                    break;
                }
                default:
            }
        },
        error: function (data) {
            var message = "Lỗi máy chủ!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng thử lại...', 3500);
        }
    });
});

// Start cartSubmit in product details
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
                    var message = "Lỗi máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                    break;
                }
                case 3: {
                    var message = "Chúng tôi chỉ còn " + Value + " sản phẩm!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng tìm sp tương tự...', 3500);
                    break;
                }
                case 4: {
                    var message = "Giỏ hàng của bạn đã đầy!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Hãy vào giỏ hàng để kiểm tra...', 3500);
                    break;
                }
                default:
            }

            // $(".myModal_text").html("Bạn đã thêm vào giỏ hàng thành công!");
            // $("#myModal").modal('show');
        }, error: function (data) {
            var message = "Lỗi máy chủ!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng thử lại...', 3500);
        }
    });
});
// End cartSubmit in product details

// input qty details
$('.input-quantity').focus(function () {
    $('.essence-btn').css("background-color", "#9e9e9e");
});

$('.input-quantity').blur(function () {
    $('.essence-btn').css("background-color", "#03a9f4");
});

// validate quantity product details
$('.input-quantity').each(function (index, val) {
    var quantityBefore;
    $(this).focus(function () {
        $(this).css("box-shadow", "0 2px 5px rgb(0 0 0 / 50%");
        $(this).css("border", "1px solid rgb(33 37 41 / 0%");
        $(this).css("border-radius", "5px");
        quantityBefore = $(this).val();
    });

    $(this).focusout(function () {
        $(this).css("box-shadow", "0 2px 5px rgb(0 0 0 / 30%)");

        var cartId = $(this).attr("data-id-1"),
            productId = $(this).attr("data-id-2"),
            quantity = $(this).val();

        // reset value input validate
        if (quantity == " ") {
            $(this).val(quantityBefore);
            $("#error-qty").append('<div class="alert alert-danger" id="error-qty1"><strong>Cảnh báos!</strong><p class="text-success-result"></b></p>Số lượng phải là số dương.</div>');
            $("#error-qty1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
        } else {
            if (quantity < 1) {
                quantity = quantityBefore;
                $(this).val(quantity);
                $("#error-qty").append('<div class="alert alert-danger" id="error-qty1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Số lượng không hợp lệ!.</div>');
                $("#error-qty1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
            } else {
                if (quantity > 10) {
                    quantity = quantityBefore;
                    $(this).val(quantity);
                    $("#error-qty").append('<div class="alert alert-danger" id="error-qty2"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Bạn chỉ có thể đặt số lượng là 10. Trừ khi bạn là khách hàng thân thiết.</div>');
                    $("#error-qty2").show().delay(5000).fadeOut(1000).queue(function () { $(this).remove(); });
                }
            }
        }
    });
});

