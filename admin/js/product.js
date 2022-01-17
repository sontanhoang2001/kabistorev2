var jsonImageArray;

// upload ảnh lên server
function uploadProductImg(type) {
    // var fileImage = document.getElementById('input_img');
    var form_data = new FormData();

    // Read selected files
    var totalfiles = document.getElementById('input_img').files.length;

    // Xóa ảnh review
    $("#reviewImage img").remove();
    // Tạo hiệu ứng load
    for (var i = 0; i < totalfiles; i++) {
        $("#reviewImage").append('<img class="lazy mr-2 mt-2" style="width: 100px; height: 100px;" src="../img/core-img/loadAvatar.gif">');
    }

    var textImageTemp = "";
    var imgIndex = 0;
    for (var index = 0; index < totalfiles; index++) {
        form_data.append("image", document.getElementById('input_img').files[index]);

        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var time = today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds();

        var filename = date + '_' + time + document.getElementById('input_img').files[index].name;

        $.ajax({
            url: "https://api.imgbb.com/1/upload?name=" + filename + "&key=349ac570c10df02ade51500393e25fb1",
            method: "POST",
            timeout: 0,
            processData: false,
            mimeType: "multipart/form-data",
            contentType: false,
            data: form_data,
            success: function(response) {
                // console.log(response);
                var jx = JSON.parse(response);
                // console.log(jx.data.url);
                // tạo ảnh xem trước
                imgIndex = imgIndex + 1;
                $("#reviewImage img").eq(imgIndex - 1).attr("src", jx.data.url)
                    // set url
                    // type == 0
                    // type == 1
                switch (type) {
                    case 0:
                        $("#image").append(jx.data.url + ",");
                        break;
                    case 1:
                        textImageTemp = textImageTemp + jx.data.url + ","
                        $("#image").val(textImageTemp);
                        break;
                }
            },
            error: function() {
                var message = "Upload ko thành công!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    }
}

function add_product() {
    // Hiển thị số tiền keyup
    var root_price;
    $("input[name=root_price]").keyup(function() {
        root_price = $(this).val();
        if (root_price.length == 0) {
            $('#root_priceText').text(currency_vn(0));
        } else {
            var root_price = $(this).val();
            $('#root_priceText').text(currency_vn(root_price));
        }
    })
    $("input[name=old_price]").keyup(function() {
        if ($(this).val().length == 0) {
            $('#old_priceText').text(currency_vn(0));
        } else {
            var old_price = $(this).val();
            $('#old_priceText').text(currency_vn(old_price));
        }
    })
    $("input[name=price]").keyup(function() {
        if ($(this).val().length == 0) {
            $('#priceText').text(currency_vn(0));
        } else {
            var price = $(this).val();
            $('#priceText').text(currency_vn(price));
        }
    })

    $("input[name=priceShipping]").keyup(function() {
        if ($(this).val().length == 0) {
            $('#priceShippingText').text(currency_vn(0));
        } else {
            var price = $(this).val();
            $('#priceShippingText').text(currency_vn(price));
        }
    })

    // Tính tiền lãi khi nhập giá bán
    var interestRate;
    $("input[name=price]").keyup(function() {
        var root_price = $("input[name=root_price]").val();
        var price = $(this).val();
        var priceShipping = $("input[name=priceShipping]").val();
        interestRate = price - root_price;
        var totalPrice = Number(interestRate) + Number(priceShipping);

        $("input[name=interestRate]").val(currency_vn(interestRate));
        $("input[name=totalPrice]").val(currency_vn(totalPrice));
    })


    $("input[name=priceShipping]").keyup(function() {
        var priceShipping = $("input[name=priceShipping]").val();
        var totalPrice = Number(interestRate) + Number(priceShipping);
        $("input[name=totalPrice]").val(currency_vn(totalPrice));
    })

    // Tạo review Image cho hình ảnh
    $("#image").blur(function() {
        $("#reviewImage img").remove();
        var array = $(this).val().split(",");
        var imageArrayArg = new Array();
        $.each(array, function(i) {
            // tạo ảnh xem trước
            $("#reviewImage").append('<img class="mr-2 mt-2" style="width: 100px; height: 100px;" src="' + array[i] + '">');
            var jsonObj = new Object();
            jsonObj.image = array[i];
            imageArrayArg.push(jsonObj);
        });
        jsonImageArray = JSON.stringify(imageArrayArg);
        // console.log(imageArrayArg[0]['image']);
        // console.log(imageArrayArg[1]['image']);
    });


    var colorTemp1 = '';
    var colorTemp2 = '';

    $("input[type='checkbox']").change(function() {
        $("#color").empty();
        colorTemp1 = '';

        for (var i = 1; i <= 7; i++) {
            if ($("#color" + i).prop('checked')) {
                var colorText = $('#color' + i + ':checked').val();
                colorTemp1 += colorText + ", ";
                $("#color").text(colorTemp1 + colorTemp2);
            }
        }
    });

    $("#color8").keyup(function() {
        $("#color").empty();
        colorTemp2 = '';

        if ($(this).val() != "") {
            var colorText = $(this).val();
            colorTemp2 += colorText + ", ";
            $("#color").text(colorTemp1 + colorTemp2);
        } else {
            $("#color").text(colorTemp1 + "");
        }
    })

    $(document).submit(function(e) {
        e.preventDefault();


        // Xử lý chuỗi thành mảng json
        var array = $("#image").val().split(",");
        var imageArrayArg = new Array();
        $.each(array, function(i) {
            var jsonObj = new Object();
            jsonObj.image = array[i];
            if (i != array.length - 1) {
                imageArrayArg.push(jsonObj);
            }
        });
        jsonImageArray = JSON.stringify(imageArrayArg);
        // console.log(jsonImageArray);
        // console.log(imageArrayArg[0]['image']);
        // console.log(imageArrayArg[1]['image']);


        var sizeArray = new Array();
        for (var i = 1; i <= 5; i++) {
            var objTemp = new Object();
            objTemp.size = i;
            if ($('#size' + i).prop('checked')) {
                sizeArray.push(objTemp);
            }
        }
        if (JSON.stringify(sizeArray) == "[]") {
            sizeArray = null;
        } else {
            sizeArray = JSON.stringify(sizeArray);
        }

        var colorString = $("#color").text().replace(/\s+/g, '').split(",");
        var colorArray = new Array();
        $.each(colorString, function(i) {
            var jsonObj = new Object();
            jsonObj.color = colorString[i];
            if (i != colorString.length - 1) {
                colorArray.push(jsonObj);
            }
        });

        if (JSON.stringify(colorArray) == "[]") {
            colorArray = null;
        } else {
            colorArray = JSON.stringify(colorArray);
        }

        var formData = {
            product_code: $("input[name=product_code]").val(),
            productName: $("input[name=productName]").val(),
            productQuantity: $("input[name=productQuantity]").val(),
            category: $('select[name="category"] option:selected').val(),
            brand: $('select[name="brand"] option:selected').val(),
            root_price: $("input[name=root_price]").val(),
            old_price: $("input[name=old_price]").val(),
            price: $("input[name=price]").val(),
            size: sizeArray,
            color: colorArray,
            image: jsonImageArray,
            product_desc: $("#product_desc").val(),
            type: $('select[name="type"] option:selected').val(),
            product_soldout: $("input[name=product_soldout]").val()
        };

        if (formData.category == 0) {
            var message = "Bạn chưa chọn loại sản phẩm!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else if (formData.brand == 0) {
            var message = "Bạn chưa chọn thương hiệu!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else if (formData.type == "null") {
            var message = "Bạn chưa chọn Trạng thái & Xếp hạng!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else if (formData.size == "null") {
            var message = "Bạn chưa chọn size!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/product.php",
                data: {
                    case: 2,
                    formData: formData
                },
                success: function(data) {
                    var res = JSON.parse(data),
                        Status = res.status;

                    switch (Status) {
                        case 0:
                            {
                                var message = "Các trường không được bỏ trống!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
                            }
                        case 1:
                            {
                                var message = "Thêm sản phẩm thành công!";
                                let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                                toast.change('Đã đưa vào danh sách...', 3500);
                                break;
                            }
                        case 2:
                            {
                                var message = "Thêm sản phẩm thất bại!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
                            }
                        case 3:
                            {
                                var message = "Mã sản phẩm đã tồn tại!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
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
}

function product_list() {
    // kiểm tra row index hện tai
    var tr_index, rowData;
    // $('table tr').click(function () {
    //     tr_index = $(this).index();
    // });


    var colorTemp1 = '';
    var colorTemp2 = '';

    var table = $('#dataTable').DataTable();
    $('#dataTable tbody').on('click', 'tr', function() {
        tr_index = table.row(this).index();
        rowData = table.row(this).data();
    });


    var rowImportQtyModal, productid, product_remain;
    //mở modal thêm số lượng sản phẩm
    $('.btn[data-target="#importQtyModal"]').click(function(e) {
        e.preventDefault();
        // Lấy vị trí hiện tại của importQtyModal
        rowImportQtyModal = $(this);

        // lấy dữ liệu row vị trí hiện tại
        product_remain = $(this).attr("data-qty"),
            productid = $(this).attr("data-productid");
        $('input[name=product_remainModal]').val(product_remain);

        // lấy dữ liệu row vị trí hiện tại

        var columnValues = $(this).parent().siblings().map(function() {
            return $(this).text();
        }).get();
        $('input[name=productNameImportModal]').val(columnValues[3]);
    })

    // khi nhấn nút nhập số lượng
    $("#btnImportQty").click(function() {
        var product_more_quantity = $("input[name=product_more_quantity]").val();
        var formData = {
            productid: productid,
            product_remain: product_remain,
            product_more_quantity: product_more_quantity
        }

        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/product.php",
            data: {
                case: 3,
                formData: formData
            },
            success: function(data) {
                var Status = JSON.parse(data).status;
                switch (Status) {
                    case 0:
                        {
                            var message = "Các trường không được bỏ trống!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                    case 1:
                        {
                            var message = "Nhập thêm hàng thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Đã cập nhật dữ liệu...', 3500);
                            $("#importQtyModal .close").click()

                            var totalQty = Number(formData.product_remain) + Number(product_more_quantity);
                            $(rowImportQtyModal).empty();
                            $(rowImportQtyModal).append('<a href="#" class="btn" data-productid="' + formData.productid + '" data-qty="<?php echo $productQuantity ?>" data-toggle="modal" data-target="#importQtyModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> ' + totalQty + '</a>');
                            break;
                        }
                    case 2:
                        {
                            var message = "Nhập thêm hàng thất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
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


    $('#importQtyModal').on('hide.bs.modal', function() {
        $("input[name=product_remainModal]").val("");
        $("input[name=product_more_quantity]").val("");
    })

    var productId, jsonImageArray;
    var productName,
        product_code,
        catId,
        brandId,
        product_desc,
        size,
        root_price,
        old_price,
        price,
        image,
        type;

    // Khi nhấn vào edit
    $('.btn[data-target="#editModal"]').click(function(e) {
        e.preventDefault();
        productId = $(this).attr("data-productid");

        // Lấy thông tin sản phẩm
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/product.php",
            data: {
                case: 4,
                productId: productId
            },
            success: function(data) {
                var res = JSON.parse(data),
                    Status = res.status;
                if (Status != 0) {
                    productName = res.productName,
                        product_code = res.product_code,
                        catId = res.catId,
                        brandId = res.brandId,
                        product_desc = res.product_desc,
                        type = res.type,
                        root_price = res.root_price,
                        old_price = res.old_price,
                        price = res.price,
                        image = res.image,
                        size = res.size,
                        color = res.color;

                    $("input[name=product_code]").val(product_code);
                    $("input[name=productName]").val(productName);
                    $('#category option[value=" ' + catId + ' "]').attr('selected', 'selected');
                    $('#brand option[value=" ' + brandId + ' "]').attr('selected', 'selected');

                    $('#root_priceText').text(currency_vn(root_price));
                    $("input[name=root_price]").val(root_price);

                    $('#old_priceText').text(currency_vn(old_price));
                    $("input[name=old_price]").val(old_price);

                    $('#priceText').text(currency_vn(price));
                    $("input[name=price]").val(price);

                    var size = JSON.parse(res.size)
                    $.each(size, function(i, val) {
                        var sizeNumber = val.size;
                        $("#size" + sizeNumber).prop('checked', true);
                    })

                    var color = JSON.parse(res.color)
                    $.each(color, function(i, val) {
                        var color = val.color;
                        switch (color) {
                            case "Trắng":
                                colorTemp1 += color + ", ";
                                $("#color1").prop('checked', true);
                                break;
                            case "Đỏ":
                                colorTemp1 += color + ", ";
                                $("#color2").prop('checked', true);
                                break;
                            case "Đen":
                                colorTemp1 += color + ", ";
                                $("#color3").prop('checked', true);
                                break;
                            case "Cam":
                                colorTemp1 += color + ", ";
                                $("#color4").prop('checked', true);
                                break;
                            case "Vàng":
                                colorTemp1 += color + ", ";
                                $("#color5").prop('checked', true);
                                break;
                            case "Lá":
                                colorTemp1 += color + ", ";
                                $("#color6").prop('checked', true);
                                break;
                            case "Hồng":
                                colorTemp1 += color + ", ";
                                $("#color7").prop('checked', true);
                                break;
                            default:
                                colorTemp2 += color + ", ";
                                $("#color8").text(color);
                        }
                        $("#color").text(colorTemp1 + colorTemp2);
                    })

                    YourEditor.setData(product_desc);

                    $('#type option[value="' + type + '"]').attr('selected', 'selected');

                    // load ảnh
                    $("#reviewImage img").remove();
                    // lấy img từ input
                    const obj_img = JSON.parse(image);
                    var imageTemp = "";
                    $.each(obj_img, function(i) {
                        // Khởi tạo lại lại ảnh sản phẩm
                        $("#reviewImage").append('<img class="mr-2 mt-2" style="width: 100px; height: 100px;" src="' + obj_img[i]['image'] + '">');
                        // Khởi tạo lại chuỗi json thành text
                        imageTemp = imageTemp.concat(obj_img[i]['image']) + ",";

                    });
                    jsonImageArray = imageTemp;
                    $("#image").val(imageTemp);
                } else {
                    var message = "Lỗi máy chủ!";
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
    })

    // Hiển thị số tiền keyup
    var root_price;
    $("input[name=root_price]").keyup(function() {
        root_price = $(this).val();
        if (root_price.length == 0) {
            $('#root_priceText').text(currency_vn(0));
        } else {
            var root_price = $(this).val();
            $('#root_priceText').text(currency_vn(root_price));
        }
    })
    $("input[name=old_price]").keyup(function() {
        if ($(this).val().length == 0) {
            $('#old_priceText').text(currency_vn(0));
        } else {
            var old_price = $(this).val();
            $('#old_priceText').text(currency_vn(old_price));
        }
    })
    $("input[name=price]").keyup(function() {
        if ($(this).val().length == 0) {
            $('#priceText').text(currency_vn(0));
        } else {
            var price = $(this).val();
            $('#priceText').text(currency_vn(price));
        }
    })

    $("input[name=priceShipping]").keyup(function() {
        if ($(this).val().length == 0) {
            $('#priceShippingText').text(currency_vn(0));
        } else {
            var price = $(this).val();
            $('#priceShippingText').text(currency_vn(price));
        }
    })

    // Tính tiền lãi khi nhập giá gốc
    $("input[name=root_price]").keyup(function() {
        var root_price = $(this).val();
        var price = $("input[name=price]").val();
        var priceShipping = $("input[name=priceShipping]").val();
        interestRate = price - root_price;
        var totalPrice = Number(interestRate) + Number(priceShipping);

        $("input[name=interestRate]").val(currency_vn(interestRate));
        $("input[name=totalPrice]").val(currency_vn(totalPrice));
    })

    // Tính tiền lãi khi nhập giá bán
    var interestRate;
    $("input[name=price]").keyup(function() {
        var root_price = $("input[name=root_price]").val();
        var price = $(this).val();
        var priceShipping = $("input[name=priceShipping]").val();
        interestRate = price - root_price;
        var totalPrice = Number(interestRate) + Number(priceShipping);

        $("input[name=interestRate]").val(currency_vn(interestRate));
        $("input[name=totalPrice]").val(currency_vn(totalPrice));
    })


    $("input[name=priceShipping]").keyup(function() {
            var priceShipping = $("input[name=priceShipping]").val();
            var totalPrice = Number(interestRate) + Number(priceShipping);
            $("input[name=totalPrice]").val(currency_vn(totalPrice));
        })
        // Hiển thị số tiền keyup


    // Tạo review Image cho hình ảnh
    $("#image").blur(function() {
        $("#reviewImage img").remove();
        var array = $(this).val().split(",");
        var imageArrayArg = new Array();
        $.each(array, function(i) {
            // tạo ảnh
            $("#reviewImage").append('<img class="mr-2 mt-2" style="width: 100px; height: 100px;" src="' + array[i] + '">');
            var jsonObj = new Object();
            jsonObj.image = array[i];
            imageArrayArg.push(jsonObj);
        });
        jsonImageArray = JSON.stringify(imageArrayArg);
    })


    $("input[type='checkbox']").change(function() {
        $("#color").empty();
        colorTemp1 = '';

        for (var i = 1; i <= 7; i++) {
            if ($("#color" + i).prop('checked')) {
                var colorText = $('#color' + i + ':checked').val();
                colorTemp1 += colorText + ", ";
                $("#color").text(colorTemp1 + colorTemp2);
            }
        }
    });

    $("#color8").keyup(function() {
        $("#color").empty();
        colorTemp2 = '';

        if ($(this).val() != "") {
            var colorText = $(this).val();
            colorTemp2 += colorText + ", ";
            $("#color").text(colorTemp1 + colorTemp2);
        } else {
            $("#color").text(colorTemp1 + "");
        }
    })

    // Khi nhấn nút cập nhật
    $("#btnUpdateProduct").click(function() {
        // Lấy thông tin sản phẩm
        var categoryTxt = $('select[name="category"] option:selected').text(),
            brandTxt = $('select[name="brand"] option:selected').text(),
            typeTxt = $('select[name="type"] option:selected').text();

        // Xử lý chuỗi thành mảng json
        var array = $("#image").val().split(",");
        var imageArrayArg = new Array();
        $.each(array, function(i) {
            var jsonObj = new Object();
            jsonObj.image = array[i];
            if (i != array.length - 1) {
                imageArrayArg.push(jsonObj);
            }
        });
        jsonImageArray = JSON.stringify(imageArrayArg);
        // console.log(jsonImageArray);


        var sizeArray = new Array();
        for (var i = 1; i <= 5; i++) {
            var objTemp = new Object();
            objTemp.size = i;
            if ($('#size' + i).prop('checked')) {
                sizeArray.push(objTemp);
            }
        }
        if (JSON.stringify(sizeArray) == "[]") {
            sizeArray = null;
        } else {
            sizeArray = JSON.stringify(sizeArray);
        }

        var colorString = $("#color").text().replace(/\s+/g, '').split(",");
        var colorArray = new Array();
        $.each(colorString, function(i) {
            var jsonObj = new Object();
            jsonObj.color = colorString[i];
            if (i != colorString.length - 1) {
                colorArray.push(jsonObj);
            }
        });

        if (JSON.stringify(colorArray) == "[]") {
            colorArray = null;
        } else {
            colorArray = JSON.stringify(colorArray);
        }

        var formData = {
            productId: productId,
            product_code: $("input[name=product_code]").val(),
            productName: $("input[name=productName]").val(),
            productQuantity: $("input[name=productQuantity]").val(),
            category: $('select[name="category"] option:selected').val(),
            brand: $('select[name="brand"] option:selected').val(),
            root_price: $("input[name=root_price]").val(),
            old_price: $("input[name=old_price]").val(),
            price: $("input[name=price]").val(),
            size: sizeArray,
            color: colorArray,
            image: jsonImageArray,
            product_desc: YourEditor.data.get(),
            type: $('select[name="type"] option:selected').val()
        };

        if (formData.category == 0) {
            var message = "Bạn chưa chọn loại sản phẩm!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else if (formData.brand == 0) {
            var message = "Bạn chưa chọn thương hiệu!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else if (formData.type == "null") {
            var message = "Bạn chưa chọn Trạng thái & Xếp hạng!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else if (formData.size == "null") {
            var message = "Bạn chưa chọn size!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/product.php",
                data: {
                    case: 5,
                    formData: formData
                },
                success: function(data) {
                    var res = JSON.parse(data),
                        Status = res.status;
                    switch (Status) {
                        case 0:
                            {
                                var message = "Các trường không được bỏ trống!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
                            }
                        case 1:
                            {
                                var message = "Cập nhật sản phẩm thành công!";
                                let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                                toast.change('Đã Lưu và thay đổi...', 3500);
                                $("#editModal .close").click()


                                // cập nhật dữ liệu vào bảng
                                $('tbody tr td').eq((tr_index * 11) + tr_index + 1).empty().append(formData.product_code);

                                try {
                                    // lấy img từ input
                                    const obj_img = JSON.parse(formData.image);
                                    $('tbody tr td').eq((tr_index * 11) + tr_index + 2).find("a").empty().append('<img src="' + obj_img[0]['image'] + '" width="100px" height="100px">');
                                } catch (error) {

                                }
                                $('tbody tr td').eq((tr_index * 11) + tr_index + 3).empty().append(formData.productName);
                                $('tbody tr td').eq((tr_index * 11) + tr_index + 7).empty().append(currency_vn(formData.price));
                                $('tbody tr td').eq((tr_index * 11) + tr_index + 8).empty().append(categoryTxt);
                                $('tbody tr td').eq((tr_index * 11) + tr_index + 9).empty().append(brandTxt);
                                $('tbody tr td').eq((tr_index * 11) + tr_index + 10).empty().append(typeTxt);
                                break;
                            }
                        case 2:
                            {
                                var message = "Cập nhật sản phẩm thất bại!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
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
    })

    // productModal edit bị ẩn
    $('#editModal').on('hide.bs.modal', function() {
        $("input[name=product_code]").val("");
        $("input[name=productName]").val("");
        $('#category option[value=" ' + category + ' "]').removeAttr('selected');
        $('#brand option[value=" ' + brandId + ' "]').removeAttr('selected', 'selected');
        $('#size option[value="' + size + '"]').removeAttr('selected', 'selected');
        $("input[name=root_price]").val("");
        $("input[name=old_price]").val("");
        $("input[name=price]").val("");
        YourEditor.setData("");
        $('#type option[value="' + type + '"]').removeAttr('selected');

        $('#root_priceText').text(currency_vn(0));
        $('#old_priceText').text(currency_vn(0));
        $('#priceText').text(currency_vn(0));
        $('#product_desc_parent').remove();


        for (var i = 1; i <= 5; i++) {
            $("#size" + i).prop('checked', false);
        }
        for (var i = 0; i <= 7; i++) {
            $("#color" + i).prop('checked', false);
        }
        $("#color8").text("");
        $("#color").empty();
        colorTemp1 = "";
        colorTemp2 = "";

        $('#btnEditor').removeAttr("disabled");
    })

    // Khi mở delModal
    $('.btn[data-target="#delModal"]').click(function(e) {
        e.preventDefault();
        productId = $(this).attr("data-productid");

        // lấy dữ liệu row vị trí hiện tại
        var columnValues = $(this).parent().siblings().map(function() {
            return $(this).text();
        }).get();
        $('#productNameDelModel').text("Bạn có thật sự muốn xóa ' " + columnValues[3] + " ' ?");
    })

    // Khi nhấn nút btnDelProduct
    $('#btnDelProduct').click(function() {
        $.ajax({
            type: "POST",
            url: "~/../callbackPartial/product.php",
            data: {
                case: 6,
                productId: productId
            },
            success: function(data) {
                var res = JSON.parse(data),
                    Status = res.status;
                switch (Status) {
                    case 0:
                        {
                            var message = "Sản phẩm này không thể xóa!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                    case 1:
                        {
                            $('#delModal .close').click();
                            var message = "Xóa sản phẩm thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Đã Lưu và thay đổi...', 3500);
                            $("#editModal .close").click()
                            $('tbody tr').eq(tr_index).css("background-color", "hotpink").fadeOut(1000);
                            break;
                        }
                }
            },
            error: function(data) {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    })
}