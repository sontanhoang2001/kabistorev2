function order() {
    var orderId, status, productId, quantity;
    // lấy dữ liệu row table hiện tại
    $(".btn[data-target='#statusModal0']").click(function() {
        status = $(this).attr("data-status");
        orderId = $(this).attr("data-orderid");
        productId = $(this).attr("data-productid");
        quantity = $(this).attr("data-qty");


        // lấy dữ liệu row vị trí hiện tại
        var columnHeadings = $("thead th").map(function() {
            return $(this).text();
        }).get();
        columnHeadings.pop();
        var columnValues = $(this).parent().siblings().map(function() {
            return $(this).text();
        }).get();
    });

    $(".btn[data-target='#statusModal1']").click(function() {

        status = $(this).attr("data-status");
        orderId = $(this).attr("data-orderid");
        productId = $(this).attr("data-productid");
        quantity = $(this).attr("data-qty");

        // lấy dữ liệu row vị trí hiện tại
        var columnHeadings = $("thead th").map(function() {
            return $(this).text();
        }).get();
        columnHeadings.pop();
        var columnValues = $(this).parent().siblings().map(function() {
            return $(this).text();
        }).get();
        //ko sử dụng nữa// quantity = columnValues[3];
    });

    // kiểm tra row index hện tai
    var tr_index;
    $('table tr').click(function() {
        tr_index = $(this).index();
    });

    var statusOrder;
    // Chọn trạng thái đơn hàng trong bs model
    $("#statusOrder0").change(function(event) {
        statusOrder = $(this).val();
        if (statusOrder == 0) {
            $("#updateStatusBtn0").attr("disabled", true);
        } else {
            $("#updateStatusBtn0").removeAttr("disabled");
        }
    });

    $("#statusOrder1").change(function(event) {
        statusOrder = $(this).val();
        if (statusOrder == 0) {
            $("#updateStatusBtn1").attr("disabled", true);
        } else {
            $("#updateStatusBtn1").removeAttr("disabled");
        }
    });

    // Cập nhật trạng thái đơn hàng
    // chấp nhận đơn hàng : 1
    // hủy đơn : 3
    $("#updateStatusBtn0").click(function(event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/order.php",
            data: {
                case: 1,
                orderId: orderId,
                num_status: statusOrder
            },
            success: function(data) {
                var Status = JSON.parse(data).status;
                var acctionMessage;
                if (statusOrder == 1) {
                    acctionMessage = "Chấp nhận đơn hàng ";
                } else if (statusOrder == 3) {
                    acctionMessage = "Hủy đơn hàng ";
                }
                switch (Status) {
                    case 0:
                        {
                            var message = acctionMessage + " thất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                    case 1:
                        {
                            // nếu là 1 thì đổi thẻ a
                            // nếu là 2 thì ẩn row
                            if (statusOrder == 1) {
                                // đổi thẻ a
                                tr_index = tr_index + 1;
                                $('tbody tr td').eq((tr_index * 6) + tr_index - 1).empty().append('<a href="#" data-status="1" data-orderid="' + orderId + '" data-productid="' + productId + '" data-qty="' + quantity + '" class="btn" data-toggle="modal" data-target="#statusModal1"><i class="fa fa-truck" aria-hidden="true"></i> Đang giao...</a>');
                                $("#statusModal0 .close").click();
                            } else if (statusOrder == 3) {
                                // $('tbody tr').eq(tr_index).css("display", "none");
                                $('tbody tr').eq(tr_index).fadeOut(2000);
                                $("#statusModal0 .close").click();
                            }
                            var message = acctionMessage + " thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Đã Lưu và thay đổi...', 3000);
                            break;
                        }
                    default:
                        {
                            var message = "Lỗi máy chủ!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                        }
                }
            },
            error: function(data) {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    });

    // Cập nhật trạng thái đơn hàng
    // Đã đơn hàng : 2
    // hủy đơn, khách ko nhận hàng : 4
    $("#updateStatusBtn1").click(function(event) {
        event.preventDefault();
        var num_case;
        if (statusOrder == 2) {
            num_case = 2;
        } else if (statusOrder == 4) {
            num_case = 1;
        }

        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/order.php",
            data: {
                case: num_case,
                orderId: orderId,
                num_status: statusOrder,
                orderId: orderId,
                productId: productId,
                quantity: quantity
            },
            success: function(data) {
                var Status = JSON.parse(data).status;
                var acctionMessage;
                if (statusOrder == 2) {
                    acctionMessage = "Đã chọn giao hàng";
                } else if (statusOrder == 4) {
                    acctionMessage = "Hủy đơn hàng ";
                }

                switch (Status) {
                    case 0:
                        {
                            var message = acctionMessage + " thất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                    case 1:
                        {
                            $('tbody tr').eq(tr_index).fadeOut(2000);
                            $("#statusModal1 .close").click();
                            var message = acctionMessage + " thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Đã Lưu và thay đổi...', 3000);
                            break;
                        }
                    default:
                        {
                            var message = "Lỗi máy chủ!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                        }
                }
            },
            error: function(data) {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    });

    // lấy dữ liệu row table hiện tại cho productModal
    $(".btn[data-target='#productModal']").click(function() {
        productId = $(this).attr("data-productid");
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/product.php",
            data: {
                case: 1,
                productId: productId
            },
            success: function(data) {
                var res = JSON.parse(data),
                    Status = res.status,
                    productName = res.productName,
                    product_code = res.product_code,
                    product_remain = res.product_remain,
                    price = res.price;

                // console.log(Status, productName, product_code, product_remain, price);

                if (Status != 0) {
                    switch (Status) {
                        case 1:
                            {
                                $('#facebookPluginModel').attr("data-href", "https://www.facebook.com/ilovekabistore/posts/" + product_code);
                                // FB load ajax
                                FB.XFBML.parse();

                                $('#productCodeModel').val(product_code);
                                $('#productNameModel').val(productName);
                                $('#priceModel').val(currency_vn(price));
                                $('#remainModel').val(product_remain);
                                $('#productDetaild').attr("href", "../details/" + productId + "/view.html");

                                // $("#delModal .close").click();
                                $('#productModal').modal('show');
                                break;
                            }
                        default:
                            {
                                var message = "Lỗi máy chủ!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                            }
                    }
                } else {
                    var message = "Lấy thông tin sản phẩm thất bại!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            },
            error: function(data) {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    });

    // statusModal0 bị ẩn
    $("#statusModal0").on('hide.bs.modal', function() {
        $("#statusOrder0 option[value=0]").attr('selected', 'selected');
        $("#statusOrder1 option[value=0]").attr('selected', 'selected');
    });

    // statusModal1 bị ẩn
    $("#statusModal1").on('hide.bs.modal', function() {
        $("#statusOrder0 option[value=0]").attr('selected', 'selected');
        $("#statusOrder1 option[value=0]").attr('selected', 'selected');
    });

    // productModal bị ẩn
    $('#productModal').on('hide.bs.modal', function() {
        $('#productCodeModel').val("");
        $('#productNameModel').val("");
        $('#priceModel').val((""));
        $('#remainModel').val("");
        $('#productDetaild').attr("href", "");
    })


    // kiểm tra row index hện tai
    var tr_index;
    var table = $('#dataTable').DataTable();
    $('#dataTable tbody').on('click', 'tr', function() {
        tr_index = table.row(this).index();
    });


    var addressid, cusMaps_maplat, cusMaps_maplng, customerId;
    // Load customer info
    $(".btn[data-target='#customerModal']").click(function(event) {
        event.preventDefault();
        // resset tab về tab đầu tiền
        $("#btnViewInfo").click();
        addressid = $(this).attr("data-addressid");
        customerId = $(this).attr("data-customerid");
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/customer.php",
            data: {
                case: 0,
                customerId: customerId
            },
            success: function(data) {
                var res = JSON.parse(data),
                    Status = res.status,
                    username = res.username,
                    name = res.name,
                    avatar = res.avatar,
                    date_of_birth = res.date_of_birth,
                    gender = res.gender,
                    phone = res.phone,
                    email = res.email,
                    date_Joined = res.date_Joined;
                cusMaps_maplat = res.maps_maplat;
                cusMaps_maplng = res.maps_maplng;

                switch (Status) {
                    case 0:
                        {
                            var message = "load thông tin khách hàng thất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                    case 1:
                        {
                            var lng = cusMaps_maplng,
                                lat = cusMaps_maplat;
                            // lấy tên vị trí bản đồ
                            getGeocodingInfo(lng, lat);
                            $("#googlemapAddressSave").attr("href", "https://maps.google.com/?q=" + lat + "," + lng);

                            if (avatar != null) {
                                $("#cusAvatar").attr("src", avatar);
                            } else if (username.length > 14) {
                                $("#cusAvatar").attr("src", "https://graph.facebook.com/" + username + "/picture?type=normal");
                            } else {
                                $("#cusAvatar").attr("src", "../upload/avatars/default-user-image.jpg");
                            }
                            $("#cusName").text(name);
                            $("#cusUserName").text(username);
                            if (date_of_birth == null) {
                                $("#cusDate_of_birth").text("Không rõ");
                            } else {
                                $("#cusDate_of_birth").text(date_of_birth);
                            }
                            $("#cusGender").text(gender);
                            if (gender == 0) {
                                $("#cusGender").text("nam");
                            } else if (gender == 1) {
                                $("#cusGender").text("nữ");

                            } else if (gender == 2) {
                                $("#cusGender").text("khác");

                            }
                            if (phone == null) {
                                $("#cusPhone").text("Không rõ");
                            } else {
                                $("#cusPhone").text("0" + phone);
                            }
                            if (email == null) {
                                $("#cusEmail").text("Không rõ");
                            } else {
                                $("#cusEmail").text(email);
                            }
                            $("#cusDate_Joined").text(date_Joined);
                            break;
                        }
                    default:
                        {
                            var message = "Lỗi máy chủ!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                        }
                }
            },
            error: function(data) {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    });

    // Delete customer
    $("#delAccount").click(function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/customer.php",
            data: {
                case: 1,
                customerId: customerId
            },
            success: function(data) {
                var res = JSON.parse(data),
                    Status = res.status;

                switch (Status) {
                    case 0:
                        {
                            var message = "Xóa tài khoản khách hàng không thất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                    case 1:
                        {
                            $("#customerModal .close").click()
                            var message = "Đã xóa tài khoản thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Đã Lưu và thay đổi...', 3000);
                            // xóa row table
                            $(".gradeX ").eq(tr_index).remove();
                            break;
                        }
                    default:
                        {
                            var message = "Lỗi máy chủ!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                        }
                }
            },
            error: function(data) {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    });

    var enableLoadDataOrderAddress = true;
    // load map order address
    $("#btnOrderAddress").click(function() {
        if (enableLoadDataOrderAddress != false) {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/order.php",
                data: {
                    case: 3,
                    addressid: addressid
                },
                success: function(data) {
                    var res = JSON.parse(data),
                        Status = res.status,
                        order_maplat = res.maps_maplat,
                        order_maplng = res.maps_maplng,
                        note_address = res.note_address;

                    switch (Status) {
                        case 0:
                            {
                                var message = "load vị trí giao hàng thất bại!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
                            }
                        case 1:
                            {
                                // đã load thành công cho = false để ko load nữa
                                enableLoadDataOrderAddress = false;

                                var lng = order_maplng,
                                    lat = order_maplat;
                                // lấy tên vị trí bản đồ
                                getGeocodingOrderMap(lng, lat);
                                $('#cusNoteModel').val(note_address);

                                // load lại order map
                                $("#googlemapOrderAddress").attr("href", "https://maps.google.com/?q=" + lat + "," + lng);
                                loadOrderMap(lng, lat)
                                break;
                            }
                        default:
                            {
                                var message = "Lỗi máy chủ!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                            }
                    }
                },
                error: function(data) {
                    var message = "Lỗi máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            });
        }
    });

    // load map order history
    var enableLoadDataOrderHistory = true;
    $("#btnOrderHistory").click(function() {
        if (enableLoadDataOrderHistory != false) {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/order.php",
                data: {
                    case: 4,
                    customerId: customerId
                },
                success: function(data) {
                    var res = JSON.parse(data),
                        Status = res.status,
                        numOrderSuccess = res.numOrderSuccess,
                        numOrderWaitDelivery = res.numOrderWaitDelivery,
                        numOrderError = res.numOrderError,
                        numOrderScoreBad = res.numOrderScoreBad;

                    switch (Status) {
                        case 0:
                            {
                                var message = "Load lịch sử đơn hàng thất bại!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
                            }
                        case 1:
                            {
                                // đã load thành công cho = false để ko load nữa
                                enableLoadDataOrderHistory = false;
                                $('#numOrderSuccess').text(numOrderSuccess + " đơn");
                                $('#numOrderWaitDelivery').text(numOrderWaitDelivery + " đơn");
                                $('#numOrderError').text(numOrderError + " đơn");
                                $('#numOrderScoreBad').text(numOrderScoreBad + " đơn");

                                $("#hrefOrderListDelivered").attr("href", "delivered-list?cusId=" + customerId);
                                $("#hrefOrderWaitDelivery").attr("href", "delivered-list?cusId=" + customerId);
                                $("#hrefOrderError").attr("href", "delivered-list?cusId=" + customerId);
                                $("#hrefOrderScoreBad").attr("href", "delivered-list?cusId=" + customerId);
                                break;
                            }
                        default:
                            {
                                var message = "Lỗi máy chủ!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                            }
                    }
                },
                error: function(data) {
                    var message = "Lỗi máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            });
        }
    });


    // customerModal bị ẩn
    $('#customerModal').on('hide.bs.modal', function() {
        enableLoadDataOrderAddress = true;
        enableLoadDataOrderHistory = true;

        $('#map').remove();
        $('.panelmapOrderAddress').append('<div id="map"></div>');
        $("#cusName").text("Không xác định");
        $("#cusDate_of_birth").text("Không xác định");
        $("#cusGender").text("Không xác định");
        $("#cusGender").text("Không xác định");
        $("#cusPhone").text("Không xác định");
        $("#cusEmail").text("Không xác định");
        $("#cusAvatar").attr("src", "../upload/avatars/default-user-image.jpg");
    });

}