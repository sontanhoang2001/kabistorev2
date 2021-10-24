// Example starter JavaScript for disabling form submissions if there are invalid fields
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


$(document).ready(function () {
    var a = $('select[name="category"] option:selected').val();
})


$(document).submit(function (e) {
    e.preventDefault();

    var formData = {
        product_code: $("input[name=product_code]").val(),
        productName: $("input[name=productName]").val(),
        productQuantity: $("input[name=productQuantity]").val(),
        category: $('select[name="category"] option:selected').val(),
        brand: $('select[name="brand"] option:selected').val(),
        type: $('select[name="type"] option:selected').val(),
        old_price: $("input[name=old_price]").val(),
        price: $("input[name=price]").val(),
        image: $("#image").val(),
        product_desc: $("#product_desc").val()
    };

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
        var message = "Bạn chưa chọn ưu tiên!";
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


