function add_Brand() {

    $("input[name='brandName']").keyup(function (event) {

        if ($(this).val().length == 0) {
            $("button[name='submit']").attr("disabled", true);
        } else {
            $("button[name='submit']").removeAttr("disabled");
        }
    });

    $(document).submit(function (event) {
        event.preventDefault();
        var brandName = $("input[name='brandName']").val();
        if (brandName != "") {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/brand.php",
                data: {
                    case: 1,
                    brandName: brandName
                },
                success: function (data) {
                    Status = JSON.parse(data).status;
                    console.log(Status);
                    switch (Status) {
                        case 0: {
                            var message = "Bạn chưa nhập tên thương hiệu!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 1: {
                            $("input[name='brandName']").val("");
                            var message = "Thêm tên thương hiệu thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Đã được thêm vào danh sách...', 3000);
                            break;
                        }
                        case 2: {
                            var message = "Thêm tên thương hiệu thất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 3: {
                            var message = "Tên thương hiệu này đã tồn tại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        default: {
                            var message = "Error máy chủ!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                        }
                    }
                }, error: function (data) {
                    var message = "Error máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            });
        }
    });
}


function update_del_Brand() {
    var brandId;
    var brandNameOld;
    // lấy dữ liệu row table hiện tại
    $(".btn[data-target='#myModal']").click(function () {
        brandID = $(this).attr("data-id");
        var columnHeadings = $("thead th").map(function () {
            return $(this).text();
        }).get();
        columnHeadings.pop();
        var columnValues = $(this).parent().siblings().map(function () {
            return $(this).text();
        }).get();
        // var modalBody = $('<div id="modalContent"></div>');
        // var modalForm = $('<form role="form" name="modalForm" action="putYourPHPActionHere.php" method="post"></form>');
        // $.each(columnHeadings, function(i, columnHeader) {
        //     var formGroup = $('<div class="form-group"></div>');
        //     formGroup.append('<label for="' + columnHeader + '">' + columnHeader + '</label>');
        //     formGroup.append('<input class="form-control" name="' + columnHeader + i + '" id="' + columnHeader + i + '" value="' + columnValues[i] + '" />');
        //     modalForm.append(formGroup);
        // });
        // modalBody.append(modalForm);
        // $('.modal-body').html(modalBody);

        $("#noModel").val(columnValues[0]);
        $("#brandNameModel").val(columnValues[1]);
        brandNameOld = columnValues[1];
    });
    // $('.modal-footer .btn-primary').click(function() {
    //     $('form[name="modalForm"]').submit();
    // });


    var tr_index;
    $('table tr').click(function () {
        tr_index = $(this).index();
    });


    $("#brandNameModel").keyup(function (event) {
        if ($(this).val().length == 0) {
            $("#updateBrand").attr("disabled", true);
        } else {
            $("#updateBrand").removeAttr("disabled");
        }
    });

    // Cập nhật tên thương hiệu
    $("#updateBrand").click(function (event) {
        event.preventDefault();
        var brandName = $("#brandNameModel").val();
        if (brandName != brandNameOld) {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/brand.php",
                data: {
                    case: 2,
                    brandID: brandID,
                    brandName: brandName
                },
                success: function (data) {
                    console.log(data);
                    Status = JSON.parse(data).status;
                    switch (Status) {
                        case 0: {
                            var message = "Bạn chưa nhập tên thương hiệu!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 1: {
                            $("#myModal .close").click();
                            $('tbody tr td').eq((tr_index * 3) + 1).text(brandName);
                            var message = "Cập nhật tên thương hiệu thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Đã Lưu và thay đổi...', 3000);
                            break;
                        }
                        case 2: {
                            var message = "Cập nhật tên thương hiệu thất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 3: {
                            var message = "Tên thương hiệu vừa nhập đã tồn tại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng nhập lại...', 3500);
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
        }
    });


    // lấy dữ liệu row table hiện tại
    $(".btn[data-target='#delModal']").click(function () {
        brandID = $(this).attr("data-id");
        var columnHeadings = $("thead th").map(function () {
            return $(this).text();
        }).get();
        columnHeadings.pop();
        var columnValues = $(this).parent().siblings().map(function () {
            return $(this).text();
        }).get();
        $("#delNoModel").val(columnValues[0]);
        $("#delBrandNameModel").val(columnValues[1]);
       brandNameOld = columnValues[1];
    });

    // xóa tên thương hiệu
    $("#delSubmit").click(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/brand.php",
            data: {
                case: 3,
                brandID: brandID
            },
            success: function (data) {
                Status = JSON.parse(data).status;
                switch (Status) {
                    case 0: {
                        var message = "Xóa tên thương hiệu thất bại!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                        break;
                    }
                    case 1: {
                        $("#delModal .close").click();
                        $("tr.gradeX").eq(tr_index).css("display", "none");
                        var message = "Xóa tên thương hiệu thành công!";
                        let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                        toast.change('Đã bỏ khỏi bảng...', 3000);
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
}