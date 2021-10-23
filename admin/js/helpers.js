//copyToClipboard copy tên sản phẩm và dán vào tìm kiếm
function pasteFind(element) {
    var productName = $(element).val();
    $('input.form-control.form-control-sm').val(productName);
    var message = "Copy tên sản phẩm thành công!";
    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
    toast.change('Đã dán vào khung tìm kiếm...', 3000);
    $("#productModal .close").click();
}

//copyToClipboard copy dữ liệu và dán vào tìm kiếm by data attr
function pasteFindByAttr(element) {
    var dataName = $(element).attr("data-orderid");
    $('input.form-control.form-control-sm').val(dataName);
    var message = "Copy tên sản phẩm thành công!";
    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
    toast.change('Đã dán vào khung tìm kiếm...', 3000);
}
// Định dạng Tiền vn
function currency_vn(money) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(money);
}
