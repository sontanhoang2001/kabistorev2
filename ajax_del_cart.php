<?php
include 'lib/session.php';
include 'helpers/format.php';
include_once "classes/cart.php";

Session::init();
$fm = new Format();

$case = $_POST['case'];

switch ($case) {
    case 0:
        $cart_Id = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $customer_id = Session::get('customer_id');

        $ct = new cart();
        $ct->del_product_cart($cart_Id, $customer_id);

        $price_ship = 5000;
        $subtotal = Session::get('sum');
        $ship = Session::get('ship');
        $ship = $ship - $quantity * $price_ship;
        Session::set('ship', $ship);

        $subtotal = $subtotal - ($price * $quantity);
        Session::set('sum', $subtotal);

        $grandTotal = $subtotal + $ship;
        Session::set('grandTotal', $grandTotal);

        // nếu grandTotal = 0 thì không cho chuyển trang checkout
        if ($grandTotal == 0) {
            Session::set('payment', false);
            echo 0;
        } else {
            echo '
                <ul>
                    <li class="totalRow"><span class="label">Tạm Tính:</span><span class="value">' . $fm->format_currency($subtotal) . " ₫" . '</span></li>
                    <li class="totalRow"><span class="label">phí giao hàng:</span><span class="value">' . "+ " . $fm->format_currency($ship) . " ₫" . '</span></li>
                    <li class="totalRow final"><span class="label">Tổng Cộng:</span><span class="value">' . $fm->format_currency($grandTotal) . " ₫" . '</span></li>
                    <li class="totalRow">
						<button type="submit" id="btn_checkout" name="cartcheckout" class="btn success-cart">Xác nhận giỏ hàng</button>
					</li>
                    <li class="errorRow"></li>
                </ul>
            ';
        }
        break;
    case 1:
        $number_cart = session::get('number_cart');
        $number_cart--;
        session::set("number_cart", (int)$number_cart);
        echo session::get('number_cart');
        break;
    default:
}
