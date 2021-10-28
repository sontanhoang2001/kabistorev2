<?php
include '../lib/session.php';
include '../helpers/format.php';
include_once "../classes/cart.php";

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
        $del_product_cart = $ct->del_product_cart($cart_Id, $customer_id);
        if ($del_product_cart) {
            $price_ship = 5000;
            $subtotal = Session::get('sum');
            $ship = Session::get('ship');
            $ship = $ship - $quantity * $price_ship;
            Session::set('ship', $ship);

            $subtotal = $subtotal - ($price * $quantity);
            Session::set('sum', $subtotal);

            $grandTotal = $subtotal + $ship;
            Session::set('grandTotal', $grandTotal);

            // Trừ số đếm trên giỏ hàng
            $number_cart = session::get('number_cart');
            $number_cart--;
            session::set("number_cart", (int)$number_cart);
            $number_cart =  session::get('number_cart');

            // nếu grandTotal = 0 thì không cho chuyển trang checkout
            if ($grandTotal == 0) {
                Session::set('payment', false);
                // 2 ko còn sp trong giỏ hàng
                echo json_encode($_result_json[] = ['status' => 2, 'number_cart' => $number_cart]);
            } else {
                // 1 Xóa thành công
                echo json_encode($_result_json[] = ['status' => 1, 'number_cart' => $number_cart]);
            }
        } else {
            // 0 xóa thất bại
            echo json_encode($_result_json[] = ['status' => 0]);
        }
        break;
    default:
}
