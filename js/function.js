//copyToClipboard
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    var message = "Đã sao chép mã giảm giá '" + $temp.val() + "'";
    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
    toast.change('Hãy dán mã khi thanh toán!', 2000);
}

//copyToClipboard
function copyToClipboardVal(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    navigator.clipboard.writeText($(element).val());
    $temp.remove();

    var message = "Đã sao chép mã đơn hàng '" + $temp.val() + "'";
    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
}

function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}

// Định dạng Tiền vn
function currency_vn(money) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(money);
}