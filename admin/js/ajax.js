var indexCountMessage = 0;


function category() {
    var categoryID;
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
    });
    // $('.modal-footer .btn-primary').click(function() {
    //     $('form[name="modalForm"]').submit();
    // });


    var tr_index;
    $('table tr').click(function () {
        tr_index = $(this).index();
        console.log(tr_index);
    });


    $("#updateCategory").click(function (event) {
        $('tbody tr td').eq((tr_index * 3) + 1).text("ok");
        var localtion = $(this);
        event.preventDefault();

        // bắt tiếp

        // $.ajax({
        //     type: "POST",
        //     url: "~/../callbackPartial/category.php",
        //     data: {
        //         categoryID: categoryID
        //     },
        //     success: function (data) {
        //         // Status = JSON.parse(data).status;
        //         alert(data);
        //         // switch (Status) {
        //         //     case 0: {
        //         //         window.location = 'login.html';
        //         //         break;
        //         //     }
        //         //     case 1: {
        //         //         $(class_localtion).toggleClass("fa-heart fa-heart-o");
        //         //         $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Thêm yêu thích thành công!</div>');
        //         //         $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
        //         //         break;
        //         //     }
        //         //     case 2: {
        //         //         $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Thêm yêu thích thất bại!!!</div>');
        //         //         $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
        //         //         break;
        //         //     }
        //         //     case 3: {
        //         //         $(class_localtion).toggleClass("fa-heart fa-heart-o");
        //         //         $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Xóa yêu thích thành công!</div>');
        //         //         $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
        //         //         break;
        //         //     }
        //         //     case 4: {
        //         //         $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p> Xóa yêu thích thất bại!!!</div>');
        //         //         $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
        //         //         break;
        //         //     }
        //         //     default: {
        //         //         $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p> Đã xảy ra sự cố mạng!!!</div>');
        //         //         $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
        //         //     }
        //         // }
        //     }, error: function (data) {
        //         alert(data);
        //     }
        // });
        indexCountMessage++;
    });



    $("table tr a#delCategory").click(function (event) {
        var localtion = $(this);
        var categoryID = $(this).attr("data-id");
        alert(categoryID);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/category.php",
            data: {
                categoryID: categoryID
            },
            success: function (data) {
                // Status = JSON.parse(data).status;
                alert(data);
                // switch (Status) {
                //     case 0: {
                //         window.location = 'login.html';
                //         break;
                //     }
                //     case 1: {
                //         $(class_localtion).toggleClass("fa-heart fa-heart-o");
                //         $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Thêm yêu thích thành công!</div>');
                //         $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                //         break;
                //     }
                //     case 2: {
                //         $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p>Thêm yêu thích thất bại!!!</div>');
                //         $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                //         break;
                //     }
                //     case 3: {
                //         $(class_localtion).toggleClass("fa-heart fa-heart-o");
                //         $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Xóa yêu thích thành công!</div>');
                //         $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                //         break;
                //     }
                //     case 4: {
                //         $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p> Xóa yêu thích thất bại!!!</div>');
                //         $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                //         break;
                //     }
                //     default: {
                //         $("#error-submit").append('<div class="alert alert-danger" id="error-submit1"><strong>Cảnh báo!</strong><p class="text-success-result"></b></p> Đã xảy ra sự cố mạng!!!</div>');
                //         $("#error-submit1").show().delay(3000).fadeOut(1000).queue(function () { $(this).remove(); });
                //     }
                // }
            }, error: function (data) {
                alert(data);
            }
        });
        indexCountMessage++;
    });
}