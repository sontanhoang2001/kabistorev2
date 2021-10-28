<?php
include 'inc/header.php';
$get_payment = Session::get('payment');
$customer_id = Session::get('customer_id');
$subtotal = Session::get('sum');
$ship = Session::get('ship');
$discount = session::get('discountMoney');
$get_amount = Session::get('grandTotal');
if (isset($_SESSION['discountMoney'])) {
    $discount = $fm->format_currency(session::get('discountMoney'));
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
<style>
    .theme-color {
        color: #30a728
    }

    hr.new1 {
        border-top: 2px dashed #fff;
        margin: 0.4rem 0
    }

    .btn-primary {
        color: #fff;
        background-color: #7fad39;
        border-color: #7fad39;
        padding: 12px;
        padding-right: 30px;
        padding-left: 30px;
        border-radius: 1px;
        font-size: 17px
    }


    .payment {
        border: 1px solid #f2f2f2;
        border-radius: 20px;
        background: #fff;
    }

    .payment_header {
        background: #7fad39;
        padding: 20px;
    }

    .check {
        margin: 0px auto;
        width: 50px;
        height: 50px;
        border-radius: 100%;
        background: #fff;
        text-align: center;
    }

    .check i {
        vertical-align: middle;
        line-height: 50px;
        font-size: 30px;
    }

    .content {
        text-align: center;
    }



    .content h1 {
        font-size: 25px;
        padding-top: 10px;
        margin-bottom: 10px;
    }

    .text-susscess {
        font-size: 24px;
    }

    .text-thankyou {
        font-size: 20px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-4 mx-auto mt-5 mb-5">
            <div class="payment">
                <div class="payment_header">
                    <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
                </div>
                <div class="content m-4">
                    <h5 class="text-uppercase text-susscess">Thanh toán thành công!</h5>
                    <h4 class="mt-4 theme-color mb-2 text-thankyou">Cảm ơn bạn đã ủng hộ</h4> <span class="theme-color">Tóm tắt hóa đơn</span>
                    <div class="mb-3">
                        <hr class="new1">
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
                    <div class="text-center mt-5"> <a class="btn btn-primary" href="orderdetails.html">Xem đơn hàng</a> </div>

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
        audioError.play();
        $(".number_cart").html("0");
    });
</script>