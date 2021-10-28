//copyToClipboard
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    $("#message").append('<div class="alert-box success notification" id="success-message' + indexCountMessage + '"><i class="fa fa-bullhorn aria-hidden="true"></i> Đã sao chép mã giảm giá "' + $temp.val() + '"</div>');
    $("#success-message" + indexCountMessage).show().delay(3000).fadeOut(1000).queue(function () {
        $(this).remove();
    });
    indexCountMessage++;
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