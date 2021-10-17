var indexCountMessage = 0;

// Toast.setMaxCount(6);

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
                            let toast = $.niceToast.error('<strong>Error</strong>: Lỗi!');
                            toast.change(message + '...', 2000);
                            break;
                        }
                        case 1: {
                            $("input[name='catName']").val("");
                            var message = "Thêm loại sản phẩm thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: Thành công!');
                            toast.change(message + '...', 2000);
                            break;
                        }
                        case 2: {
                            var message = "Thêm loại sản phẩm thất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: Lỗi!');
                            toast.change(message + '...', 2000);
                            break;
                        }
                        case 3: {
                            var message = "Tên loại sản phẩm này đã tồn tại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: Lỗi!');
                            toast.change(message + '...', 2000);
                            break;
                        }
                        default: {
                            var message = "Lỗi máy chủ!";
                            let toast = $.niceToast.error('<strong>Error</strong>: Lỗi!');
                            toast.change(message + '...', 2000);
                        }
                    }
                }, error: function (data) {
                    let toast = $.niceToast.error('<strong>Error</strong>: Lỗi!');
                    toast.change(message + '...', 2000);
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
                            $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p> Bạn chưa nhập tên loại sản phẩm!!!</div>');
                            $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                            break;
                        }
                        case 1: {
                            $("#myModal .close").click()
                            $('tbody tr td').eq((tr_index * 3) + 1).text(categoryName);
                            $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Cập nhật loại sản phẩm thành công!</div>');
                            $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                            break;
                        }
                        case 2: {
                            $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p> Cập nhật loại sản phẩm thất bại!!!</div>');
                            $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                            break;
                        }
                        default: {
                            $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p> Lỗi máy chủ!!!</div>');
                            $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                        }
                    }
                }, error: function (data) {
                    $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p> Lỗi máy chủ!!!</div>');
                    $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                }
            });
        }
        indexCountMessage++;
    });

    // xóa loại sản phẩm
    $("table tr a#delCategory").click(function (event) {
        tr_index = $(this).index();
        var categoryID = $(this).attr("data-id");
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/category.php",
            data: {
                case: 3,
                categoryID: categoryID
            },
            success: function (data) {
                Status = JSON.parse(data).status;
                switch (Status) {
                    case 0: {
                        $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Đã xóa 1 loại sản phẩm thất bại!!!</div>');
                        $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                        break;
                    }
                    case 1: {
                        $("tr.gradeX").eq(tr_index).css("display", "none");
                        $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Xóa 1 loại sản phẩm thành công!</div>');
                        $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                        break;
                    }
                    default: {
                        $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Lỗi máy chủ!!!</div>');
                        $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                    }
                }
            }, error: function (data) {
                $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Lỗi máy chủ!!!</div>');
                $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
            }
        });
        indexCountMessage++;
    });
}