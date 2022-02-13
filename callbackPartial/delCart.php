<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../config/global.php';
    include '../lib/session.php';
    include '../helpers/format.php';
    include_once "../classes/cart.php";
    include 'CartCookie.php';

    Session::init();
    $fm = new Format();
    $case = $_POST['case'];

    switch ($case) {
        case 0:
            $cart_Id = $_POST['cartId'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];

            $customer_id = Session::get('customer_id');

            if (isset($_SESSION['customer_login'])) {
                $ct = new cart();
                $del_product_cart = $ct->del_product_cart($cart_Id, $customer_id);
            } else {
                $del_product_cart = delCartCookie($cart_Id);
            }

            if ($del_product_cart) {
                // $price_ship = 5000;
                $subtotal = Session::get('sum');
                // $ship = Session::get('ship');
                // lấy tổng số lượng
                $quantityTotal = Session::get('quantityTotal');

                //$ship = $ship - $quantity * $price_ship;
                // $ship =  (int)$price_ship + (int)$shipAdd * ((int)$quantityTotal - (int)$quantity - 1);
                // } else {
                //     $ship =  $price_ship;
                // }
                //Lưu giá trị khi ở trong ajax
                Session::set('quantityTotal', $quantityTotal - $quantity);

                // Session::set('ship', $ship);

                $subtotal = $subtotal - ($price * $quantity);
                Session::set('sum', $subtotal);

                $grandTotal = $subtotal;
                Session::set('grandTotal', $grandTotal);

                // Trừ số đếm trên giỏ hàng
                $number_cart = session::get('number_cart');
                $number_cart--;
                session::set("number_cart", (int)$number_cart);
                $number_cart =  session::get('number_cart');

                // nếu number_cart = 0 thì không cho chuyển trang checkout
                if ($number_cart == 0) {
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
} else {
    header("location:../404.php");
}
