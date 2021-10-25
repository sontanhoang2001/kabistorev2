function add_product() {
    (() => {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    $(document).submit(function (e) {
        e.preventDefault();
        var formData = {
            product_code: $("input[name=product_code]").val(),
            productName: $("input[name=productName]").val(),
            productQuantity: $("input[name=productQuantity]").val(),
            category: $('select[name="category"] option:selected').val(),
            brand: $('select[name="brand"] option:selected').val(),
            old_price: $("input[name=old_price]").val(),
            price: $("input[name=price]").val(),
            size: $('select[name="size"] option:selected').val(),
            image: $("#image").val(),
            product_desc: $("#product_desc").val(),
            type: $('select[name="type"] option:selected').val()
        };

        alert(formData.type);
        if ($("input[name=old_price]").val() <= $("input[name=price]").val()) {
            var message = "Giá cũ phải lớn hơn giá mới!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        }
        else if (formData.category == 0) {
            var message = "Bạn chưa chọn loại sản phẩm!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        }
        else if (formData.brand == 0) {
            var message = "Bạn chưa chọn thương hiệu!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else if (formData.type == "null") {
            var message = "Bạn chưa chọn Trạng thái & Xếp hạng!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        }
        else if (formData.size == "null") {
            var message = "Bạn chưa chọn size!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else {
            console.log(formData.product_code, formData.productName, formData.productQuantity, formData.category, formData.brand, formData.type, formData.old_price, formData.price, formData.image, formData.product_desc);
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/product.php",
                data: {
                    case: 2,
                    formData: formData
                },
                success: function (data) {
                    var res = JSON.parse(data),
                        Status = res.status;

                    switch (Status) {
                        case 0: {
                            var message = "Các trường không được bỏ trống!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 1: {
                            var message = "Thêm sản phẩm thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 2: {
                            var message = "Thêm sản phẩm thất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 3: {
                            var message = "Mã sản phẩm đã tồn tại!";
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
    });
}

function product_list() {
    // kiểm tra row index hện tai
    var tr_index;
    // $('table tr').click(function () {
    //     tr_index = $(this).index();
    // });


    var table = $('#dataTable').DataTable();
    $('#dataTable tbody').on('click', 'tr', function () {
        tr_index = table.row(this).index();
    });


    var rowImportQtyModal, productid, product_remain;
    //mở modal thêm số lượng sản phẩm
    $('.btn[data-target="#importQtyModal"]').click(function (e) {
        e.preventDefault();
        // Lấy vị trí hiện tại của importQtyModal
        rowImportQtyModal = $(this);

        // lấy dữ liệu row vị trí hiện tại
        product_remain = $(this).attr("data-qty"),
            productid = $(this).attr("data-productid");
        $('input[name=product_remainModal]').val(product_remain);

        // lấy dữ liệu row vị trí hiện tại

        var columnValues = $(this).parent().siblings().map(function () {
            return $(this).text();
        }).get();
        $('input[name=productNameImportModal]').val(columnValues[3]);
    })

    // khi nhấn nút nhập số lượng
    $("#btnImportQty").click(function () {
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
            success: function (data) {
                var Status = JSON.parse(data).status;
                switch (Status) {
                    case 0: {
                        var message = "Các trường không được bỏ trống!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                        break;
                    }
                    case 1: {
                        var message = "Nhập thêm hàng thành công!";
                        let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                        toast.change('Đã cập nhật dữ liệu...', 3500);
                        $("#importQtyModal .close").click()

                        var totalQty = Number(formData.product_remain) + Number(product_more_quantity);
                        $(rowImportQtyModal).empty();
                        $(rowImportQtyModal).append('<a href="#" class="btn" data-productid="' + formData.productid + '" data-qty="<?php echo $productQuantity ?>" data-toggle="modal" data-target="#importQtyModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> ' + totalQty + '</a>');
                        break;
                    }
                    case 2: {
                        var message = "Nhập thêm hàng thất bại!";
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
    });


    $('#importQtyModal').on('hide.bs.modal', function () {
        $("input[name=product_remainModal]").val("");
        $("input[name=product_more_quantity]").val("");
    })


    var productId;
    // Khi nhấn vào edit
    $('.btn[data-target="#editModal"]').click(function (e) {
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
            success: function (data) {
                var res = JSON.parse(data),
                    Status = res.status;
                if (Status != 0) {
                    var productName = res.productName,
                        product_code = res.product_code,
                        catId = res.catId,
                        brandId = res.brandId,
                        product_desc = res.product_desc,
                        type = res.type,
                        old_price = res.old_price,
                        price = res.price,
                        image = res.image,
                        size = res.size;
                    $("input[name=product_code]").val(product_code);
                    $("input[name=productName]").val(productName);
                    $('#category option[value=" ' + catId + ' "]').attr('selected', 'selected');
                    $('#brand option[value=" ' + brandId + ' "]').attr('selected', 'selected');
                    $("input[name=old_price]").val(old_price);
                    $("input[name=price]").val(price);
                    $('#size option[value=" ' + size + ' "]').attr('selected', 'selected');
                    $("#image").val(image);
                    $("#product_desc").val(product_desc);
                    $('#type option[value="' + type + '"]').attr('selected', 'selected');
                    $("#editModal").modal('show');
                } else {
                    var message = "Lỗi máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            }, error: function (data) {
                var message = "Lỗi máy chủ!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);
            }
        });
    })


    $("#btnUpdateProduct").click(function () {
        // Lấy thông tin sản phẩm
        var formData = {
            productId: productId,
            product_code: $("input[name=product_code]").val(),
            productName: $("input[name=productName]").val(),
            productQuantity: $("input[name=productQuantity]").val(),
            category: $('select[name="category"] option:selected').val(),
            brand: $('select[name="brand"] option:selected').val(),
            old_price: $("input[name=old_price]").val(),
            price: $("input[name=price]").val(),
            size: $('select[name="size"] option:selected').val(),
            image: $("#image").val(),
            product_desc: $("#product_desc").val(),
            type: $('select[name="type"] option:selected').val()
        };

        if ((Number)(formData.old_price) <= (Number)(formData.price)) {
            var message = "Giá cũ phải lớn hơn giá mới!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        }
        else if (formData.category == 0) {
            var message = "Bạn chưa chọn loại sản phẩm!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        }
        else if (formData.brand == 0) {
            var message = "Bạn chưa chọn thương hiệu!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        } else if (formData.type == "null") {
            var message = "Bạn chưa chọn Trạng thái & Xếp hạng!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng chỉnh sửa lại...', 3500);
        }
        else if (formData.size == "null") {
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
                success: function (data) {
                    var res = JSON.parse(data),
                        Status = res.status;
                    switch (Status) {
                        case 0: {
                            var message = "Các trường không được bỏ trống!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                        case 1: {
                            var message = "Cập nhật sản phẩm thành công!";
                            let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                            toast.change('Đã Lưu và thay đổi...', 3500);
                            $("#editModal .close").click()

                            // cập nhật dữ liệu vào bảng
                            break;
                        }
                        case 2: {
                            var message = "Cập nhật sản phẩm tthất bại!";
                            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                            toast.change('Vui lòng thử lại...', 3500);
                            break;
                        }
                    }
                }, error: function (data) {
                    var message = "Lỗi máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            });
        }
    })


    $('.btn[data-target="#delModal"]').click(function (e) {
        e.preventDefault();

        var productid = $(this).attr("data-productid");
        // lấy dữ liệu row vị trí hiện tại
        var columnValues = $(this).parent().siblings().map(function () {
            return $(this).text();
        }).get();
        $('#productNameDelModel').text("Bạn có thật sự muốn xóa ' " + columnValues[3] + " ' ?");
    })

    $('#btnDelProduct').click(function () {
        alert(tr_index);
        $('tbody tr').eq(tr_index).fadeOut(1000);
        //$delProduct = $pd -> del_product($id, $image);

    })
}