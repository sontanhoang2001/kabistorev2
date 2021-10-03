<?php
include 'inc/header.php';
$get_payment = Session::get('payment');
$customer_id = Session::get('customer_id');
$subtotal = Session::get('sum');
$ship = Session::get('ship');
$discount = session::get('discountMoney');
$get_amount = Session::get('grandTotal');

if (isset($get_payment)) {
    if ($get_payment == false) {
        header('Location:404.html');
    } else {
        $delCart = $ct->del_all_data_cart($customer_id);
        if ($delCart) {
            session::set("number_cart", 0);
        }
        Session::set('payment', false);
    }
}
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

    .btn-primary:hover {
        color: #fff;
        background-color: #004cb9;
        border-color: #004cb9;
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

    .button {
        width: 200px;
        height: 35px;
        color: #fff;
        border-radius: 30px;
        padding: 5px 10px;
        background: #7fad39;
        transition: all ease-in-out 0.3s;
    }

    .content h1 {
        font-size: 25px;
        padding-top: 10px;
        margin-bottom: 10px;
    }


    p {
        font-size: 16px;
        font-family: "Cairo", sans-serif;
        color: #6f6f6f;
        font-weight: 400;
        line-height: 26px;
        margin: 0px 0 25px 0;
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
                    <div class="d-flex justify-content-between"> <span class="font-weight-bold">Tổng cộng</span> <span class="text-muted"><?php echo $fm->format_currency($subtotal) . " ₫"  ?></span> </div>
                    <div class="d-flex justify-content-between"> <small>Phí giao hàng</small> <small><?php echo "+ " . $fm->format_currency($ship) . " ₫"  ?></small> </div>
                    <div class="d-flex justify-content-between"> <small>Đã giảm giá</small> <small><?php echo "- " . $fm->format_currency($discount) . " ₫"  ?></small> </div>
                    <div class="d-flex justify-content-between mt-3"> <span class="font-weight-bold">Tổng thanh toán</span> <span class="font-weight-bold theme-color"><?php echo $fm->format_currency($get_amount) . " ₫" ?></span> </div>
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
        $(".number_cart").html("0");
    });
</script>