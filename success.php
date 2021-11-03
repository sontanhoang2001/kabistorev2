<?php
include 'inc/header.php';
$get_payment = Session::get('payment');
$customer_id = Session::get('customer_id');
$subtotal = Session::get('sum');
$ship = Session::get('ship');
$discount = session::get('discountMoney');
$get_amount = Session::get('grandTotal');
if ($discount != 0) {
    $discount = "- " . $fm->format_currency($discount);
} else {
    $discount = "...";
}

// if (isset($get_payment)) {
//     if ($get_payment == false) {
//         header('Location:404.html');
//     } else {
//         $delCart = $ct->del_all_data_cart($customer_id);
//         if ($delCart) {
//             session::set("number_cart", 0);
//         }
//         Session::set('payment', false);
//     }
// }
?>


<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-4 mx-auto mt-5 mb-5">
            <div class="payment">
                <div class="payment_header">
                    <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
                </div>
                <div class="content m-4">
                    <h5 class="text-uppercase text-susscess">Thanh toán thành công!</h5>
                    <h4 class="mt-3 theme-color mb-2 text-thankyou">Cảm ơn bạn đã ủng hộ</h4>
                    <div class="font-weight-bold mt-4">Tóm tắt hóa đơn</div>
                    <div class="mb-3 mt-3">
                        <p style="border-top: 2px dashed #bfbfbf;"></p>
                    </div>
                    <div class="row lower">
                        <strong class="col text-muted text-left">Tạm tính</strong>
                        <div class="col text-right"><?php echo $fm->format_currency($subtotal) . " ₫"  ?></div>
                    </div>
                    <div class="row lower">
                        <strong class="col text-muted text-left">Phí giao hàng</strong>
                        <div class="col text-right"><?php echo "+ " . $fm->format_currency($ship) . " ₫"  ?></div>
                    </div>
                    <div class="row lower">
                        <strong class="col text-muted  text-left">Đã giảm giá</strong>
                        <div class="col text-right"><b><?php echo  $discount; ?></b></div>
                    </div>
                    <div class="row lower">
                        <strong class="col text-left" style="font-size: 16px;">Tổng thanh toán</strong>
                        <div class="col text-right"><b><span class="font-weight-bold theme-color"><?php echo $fm->format_currency($get_amount) . " ₫" ?></span></b>
                        </div>
                    </div>
                    <div class="text-center mt-4"> <a class="btn btn-viewOrderDetails" href="orderdetails.html"><i class="fa fa-file-text-o" aria-hidden="true"></i> Xem đơn hàng</a> </div>
                    <div class="row lower mt-3">
                        <p class="col text-left"><b>Lưu ý:</b> Nhân viên của shop sẽ liên hệ đến bạn sớm nhất để xác nhận đơn hàng. bạn nhớ giữ liên lạc với Shop nhé!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>
<script>
    $(document).ready(function() {
        audioSuccess.play();
        $(".number_cart").html("0");
    });
</script>