<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../inc/global.php';
    include '../lib/session.php';
    include '../helpers/format.php';
    include_once "../classes/cart.php";

    Session::init();
    $fm = new Format();
    $ct = new cart();

    $case = $_POST['case'];
    $cart_Id = $_POST['cartId'];
    $quantity = $_POST['quantity'];


    switch ($case) {
        case 0:
            $productId = $_POST['productId'];
            $customer_id = Session::get('customer_id');
            echo $ct->update_quantity_Cart($customer_id, $cart_Id, $productId, $quantity);
            break;
        case 1:
            $quantityBefore = $_POST['quantityBefore'];
            if ($quantityBefore < $quantity) {
                $cartSess = $_SESSION['cart'][$cart_Id];
                $price = $cartSess['price'];
                $quantityNew = $quantity - $quantityBefore;

                $get_price_ship = $ct->get_price_ship();
                while ($result_price = $get_price_ship->fetch_assoc()) {
                    $price_ship = $result_price['price'];
                }

                // lấy tổng số lượng
                $quantityTotal = Session::get('quantityTotal');

                // $price_ship = 5000;
                $subtotal = Session::get('sum');
                // lấy ship cũ
                $ship = Session::get('ship');
                if ($quantityTotal > 1) {
                    $ship =  $maxShip + $shipAdd * ($quantityTotal + $quantityNew);
                } else {
                    $ship = $ship + $quantityNew * $price_ship;
                }
                //Lưu giá trị khi ở trong ajax
                Session::set('quantityTotal', $quantityTotal + $quantityNew);

                Session::set('ship', $ship);

                $subtotal = $subtotal + ($price * $quantityNew);
                Session::set('sum', $subtotal);

                $grandTotal = $subtotal + $ship;
                Session::set('grandTotal', $grandTotal);
                echo json_encode($result_json[] = ['subtotal' => $fm->format_currency($subtotal) . " ₫", 'ship' => $ship, 'total' => $fm->format_currency($grandTotal) . " ₫"]);
            } else {
                $cartSess = $_SESSION['cart'][$cart_Id];
                $price = $cartSess['price'];
                $quantityNew = $quantityBefore - $quantity;;

                $get_price_ship = $ct->get_price_ship();
                while ($result_price = $get_price_ship->fetch_assoc()) {
                    $price_ship = $result_price['price'];
                }

                // lấy tổng số lượng
                $quantityTotal = Session::get('quantityTotal');

                // $price_ship = 5000;
                $subtotal = Session::get('sum');
                $ship = Session::get('ship');

                if ($quantityTotal > 1) {
                    $ship =  $maxShip + $shipAdd * ($quantityTotal - $quantityNew);
                } else if ($quantityTotal <= 1) {
                    $ship =  $price_ship;
                } else {
                    $ship = $ship - $quantityNew * $price_ship;
                }
                //Lưu giá trị khi ở trong ajax
                Session::set('quantityTotal', $quantityTotal - $quantityNew);

                Session::set('ship', $ship);

                $subtotal = $subtotal - ($price * $quantityNew);
                Session::set('sum', $subtotal);

                $grandTotal = $subtotal + $ship;
                Session::set('grandTotal', $grandTotal);
                echo json_encode($result_json[] = ['subtotal' => $fm->format_currency($subtotal) . " ₫", 'ship' => $ship, 'total' => $fm->format_currency($grandTotal) . " ₫"]);
            }
            break;
        default:
    }
} else {
    header("location:../404.php");
}
// <li class="totalRow"><a href="checkout" class="btn continue">Vào thanh Toán</a></li>
