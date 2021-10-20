
function order() {
    var orderID, status;
    // lấy dữ liệu row table hiện tại
    $(".btn[data-target='#statusModal0']").click(function () {
        status = $(this).attr("data-status");
        orderID = $(this).attr("data-orderID");
    });
    $(".btn[data-target='#statusModal1']").click(function () {
        status = $(this).attr("data-status");
        orderID = $(this).attr("data-orderID");
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

    // chỗ này tí thêm function rồi bắt ajax
    // Cập nhật trạng thái đơn hàng
    $("#updateStatusBtn0").click(function (event) {
        alert(statusOrder);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/order.php",
            data: {
                case: 2,
                categoryID: categoryID,
                categoryName: categoryName
            },
            success: function (data) {
                Status = JSON.parse(data).status;
                
                switch (Status) {
                    case 0: {
                        var message = "Cập nhật !";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                        break;
                    }
                    case 1: {
                        $("#myModal .close").click();
                        $('tbody tr td').eq((tr_index * 3) + 1).text(categoryName);
                        var message = "Cập nhật loại sản phẩm thành công!";
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
    $("#updateStatusBtn1").click(function (event) {
        alert(statusOrder);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/order.php",
            data: {
                case: 2,
                categoryID: categoryID,
                categoryName: categoryName
            },
            success: function (data) {
                Status = JSON.parse(data).status;
                switch (Status) {
                    case 0: {
                        var message = "Bạn chưa nhập tên loại sản phẩm!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                        break;
                    }
                    case 1: {
                        $("#myModal .close").click();
                        $('tbody tr td').eq((tr_index * 3) + 1).text(categoryName);
                        var message = "Cập nhật loại sản phẩm thành công!";
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



    // lấy dữ liệu row table hiện tại
    // $(".btn[data-target='#delModal']").click(function () {
    //     categoryID = $(this).attr("data-id");
    //     var columnHeadings = $("thead th").map(function () {
    //         return $(this).text();
    //     }).get();
    //     columnHeadings.pop();
    //     var columnValues = $(this).parent().siblings().map(function () {
    //         return $(this).text();
    //     }).get();
    //     $("#delNoModel").val(columnValues[0]);
    //     $("#delCategoryNameModel").val(columnValues[1]);
    //     categoryNameOld = columnValues[1];
    // });

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