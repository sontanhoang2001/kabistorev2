
function order() {
    var orderId, status, productId, quantity;
    // lấy dữ liệu row table hiện tại
    $(".btn[data-target='#statusModal0']").click(function () {
        status = $(this).attr("data-status");
        orderId = $(this).attr("data-orderid");
        productId = $(this).attr("data-productid");
    });
    $(".btn[data-target='#statusModal1']").click(function () {
        status = $(this).attr("data-status");
        orderId = $(this).attr("data-orderid");
        productId = $(this).attr("data-productid");

        var columnHeadings = $("thead th").map(function () {
            return $(this).text();
        }).get();
        columnHeadings.pop();
        var columnValues = $(this).parent().siblings().map(function () {
            return $(this).text();
        }).get();
        quantity = columnValues[3];
    });


    // kiểm tra row index hện tai
    var tr_index;
    $('table tr').click(function () {
        tr_index = $(this).index();
    });

    var statusOrder;
    // Chọn trạng thái đơn hàng trong bs model
    $("#statusOrder0").change(function (event) {
        statusOrder = $(this).val();
        if (statusOrder == 0) {
            $("#updateStatusBtn0").attr("disabled", true);
        } else {
            $("#updateStatusBtn0").removeAttr("disabled");
        }
    });
    $("#statusOrder1").change(function (event) {
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
    $("#updateStatusBtn0").click(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/order.php",
            data: {
                case: 1,
                orderId: orderId,
                num_status: statusOrder
            },
            success: function (data) {
                var Status = JSON.parse(data).status;
                var acctionMessage;
                if (statusOrder == 1) {
                    acctionMessage = "Chấp nhận đơn hàng ";
                } else if (statusOrder == 3) {
                    acctionMessage = "Hủy đơn hàng ";
                }

                switch (Status) {
                    case 0: {
                        var message = acctionMessage + " thất bại!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                        break;
                    }
                    case 1: {
                        // nếu là 1 thì đổi thẻ a
                        // nếu là 2 thì ẩn row
                        if (statusOrder == 1) {
                            // đổi thẻ a
                            tr_index = tr_index + 1;
                            $('tbody tr td').eq((tr_index * 6) + tr_index - 1).empty().append('<a href="#" data-status="1" data-orderid="' + orderId + '" data-productid="' + productId + '" class="btn" data-toggle="modal" data-target="#statusModal1"><i class="fa fa-truck" aria-hidden="true"></i> Đang giao...</a>');
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
                    default: {
                        var message = "Lỗi máy chủ!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                    }
                }
            }, error: function (data) {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    });

    // Cập nhật trạng thái đơn hàng
    // Đã đơn hàng : 2
    // hủy đơn, khách ko nhận hàng : 3
    $("#updateStatusBtn1").click(function (event) {
        event.preventDefault();
        if (statusOrder == 2) {
            var num_case = 2;
        } else if (statusOrder == 4) {
            var num_case = 1;
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
            success: function (data) {
                var Status = JSON.parse(data).status;
                var acctionMessage;
                if (statusOrder == 2) {
                    acctionMessage = "Đã chọn giao hàng";
                } else if (statusOrder == 4) {
                    acctionMessage = "Hủy đơn hàng ";
                }

                switch (Status) {
                    case 0: {
                        var message = acctionMessage + " thất bại!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                        break;
                    }
                    case 1: {
                        $('tbody tr').eq(tr_index).fadeOut(2000);
                        $("#statusModal1 .close").click();
                        var message = acctionMessage + " thành công!";
                        let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                        toast.change('Đã Lưu và thay đổi...', 3000);
                        break;
                    }
                    default: {
                        var message = "Lỗi máy chủ!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                    }
                }
            }, error: function (data) {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    });



    // lấy dữ liệu row table hiện tại cho productModal
    $(".btn[data-target='#productModal']").click(function () {
        productId = $(this).attr("data-productid");
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/product.php",
            data: {
                case: 1,
                productId: productId
            },
            success: function (data) {
                var res = JSON.parse(data),
                    Status = res.status,
                    productName = res.productName,
                    product_code = res.product_code,
                    product_remain = res.product_remain,
                    price = res.price;

                // console.log(Status, productName, product_code, product_remain, price);

                if (Status != 0) {
                    switch (Status) {
                        case 1: {
                            $('#facebookPluginModel').attr("data-href", "https://www.facebook.com/ilovekabistore/posts/" + product_code);
                            // FB load ajax
                            FB.XFBML.parse();

                            $('#productCodeModel').val(product_code);
                            $('#productNameModel').val(productName);
                            $('#priceModel').val(currency_vn(price));
                            $('#remainModel').val(product_remain);
                            $('#productDetaild').attr("href", "../details/" + productId + "/view.html");

                            $("#delModal .close").click();
                            var message = "Lấy thông tin sản phẩm thành công!";
                            $.niceToast.setup({
                                position: "top-right",
                                timeout: 1000,
                            });
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            $.niceToast.setup({
                                position: "bottom-right",
                                timeout: 5000,
                            });
                            $('#productModal').modal('show');
                            break;
                        }
                        default: {
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
            }, error: function (data) {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    });




    // xóa loại sản phẩm
    // $("#delSubmit").click(function (event) {
    //     event.preventDefault();
    //     $.ajax({
    //         type: "POST",
    //         url: "~/../callbackPartial/category.php",
    //         data: {
    //             case: 3,
    //             categoryID: categoryID
    //         },
    //         success: function (data) {
    //             Status = JSON.parse(data).status;
    //             switch (Status) {
    //                 case 0: {
    //                     var message = "Đã xóa 1 loại sản phẩm thất bại!";
    //                     let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
    //                     toast.change('Vui lòng thử lại...', 3500);
    //                     break;
    //                 }
    //                 case 1: {
    //                     $("#delModal .close").click();
    //                     $("tr.gradeX").eq(tr_index).css("display", "none");
    //                     var message = "Xóa 1 loại sản phẩm thành công!";
    //                     let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
    //                     toast.change('Đã loại bỏ khỏi bảng...', 3000);
    //                     break;
    //                 }
    //                 default: {
    //                     var message = "Lỗi máy chủ!";
    //                     let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
    //                     toast.change('Vui lòng thử lại...', 3500);
    //                 }
    //             }
    //         }, error: function (data) {
    //             var message = "Lỗi máy chủ!";
    //             let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
    //             toast.change('Vui lòng thử lại...', 3500);
    //         }
    //     });
    // });
}