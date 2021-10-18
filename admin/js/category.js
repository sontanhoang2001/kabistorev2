function add_Category() {

    $("input[name='catName']").keyup(function (event) {

        if ($(this).val().length == 0) {
            $("button[name='submit']").attr("disabled", true);
        } else {
            $("button[name='submit']").removeAttr("disabled");
        }
    });

    $(document).submit(function (event) {
        event.preventDefault();
        var categoryName = $("input[name='catName']").val();
        if (categoryName != "") {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/category.php",
                data: {
                    case: 1,
                    categoryName: categoryName
                },
                success: function (data) {
                    Status = JSON.parse(data).status;
                    console.log(Status);
                    switch (Status) {
                        case 0: {
                            var message = "Bạn chưa nhập loại sản phẩm!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 1: {
                            $("input[name='catName']").val("");
                            var message = "Thêm loại sản phẩm thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Đã được thêm vào danh sách...', 3000);
                            break;
                        }
                        case 2: {
                            var message = "Thêm loại sản phẩm thất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 3: {
                            var message = "Tên loại sản phẩm này đã tồn tại!";
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
        indexCountMessage++;
    });
}


function update_del_Category() {
    var categoryID;
    var categoryNameOld;
    $(".btn[data-target='#myModal']").click(function () {
        categoryID = $(this).attr("data-id");
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
        $("#categoryNameModel").val(columnValues[1]);
        categoryNameOld = columnValues[1];
    });
    // $('.modal-footer .btn-primary').click(function() {
    //     $('form[name="modalForm"]').submit();
    // });


    var tr_index;
    $('table tr').click(function () {
        tr_index = $(this).index();
        console.log(tr_index);
    });


    $("#categoryNameModel").keyup(function (event) {
        if ($(this).val().length == 0) {
            $("#updateCategory").attr("disabled", true);
        } else {
            $("#updateCategory").removeAttr("disabled");
        }
    });

    // Cập nhật loại sản phẩm
    $("#updateCategory").click(function (event) {
        event.preventDefault();
        var categoryName = $("#categoryNameModel").val();
        if (categoryName != categoryNameOld) {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/category.php",
                data: {
                    case: 2,
                    categoryID: categoryID,
                    categoryName: categoryName
                },
                success: function (data) {
                    Status = JSON.parse(data).status;
                    console.log(data);
                    switch (Status) {
                        case 0: {
                            var message = "Bạn chưa nhập tên loại sản phẩm!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 1: {
                            $("#myModal .close").click()
                            $('tbody tr td').eq((tr_index * 3) + 1).text(categoryName);
                            var message = "Cập nhật loại sản phẩm thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Đã Lưu và thay đổi...', 3000);
                            break;
                        }
                        case 2: {
                            var message = "Cập nhật loại sản phẩm thất bại!";
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
                }, error: function (data) {
                    var message = "Lỗi máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            });
        }
        indexCountMessage++;
    });

    // xóa loại sản phẩm
    // $("table tr a#delCategory").click(function (event) {
    //     tr_index = $(this).index();
    //     var categoryID = $(this).attr("data-id");
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