<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../config/global.php';
    include '../lib/session.php';
    include_once "../classes/cart.php";


    Session::init();
    $ct = new cart();

    $case = $_POST['case'];
    $cart_Id = $_POST['cartId'];
    $quantity = $_POST['quantity'];

    switch ($case) {
        case 0:
            $productId = $_POST['productId'];
            if (isset($_SESSION['customer_login'])) {
                echo $ct->update_quantity_Cart(1, $cart_Id, $productId, $quantity);
            } else {
                echo $ct->update_quantity_Cart(0, $cart_Id, $productId, $quantity);
            }
            break;
        case 1:
            $quantityBefore = $_POST['quantityBefore'];
                $cartSess = $_SESSION['cart'][$cart_Id];
                $price = $cartSess['price'];
                
            if ($quantityBefore < $quantity) {
                $quantityNew = $quantity - $quantityBefore;

                // lấy tổng số lượng
                $quantityTotal = Session::get('quantityTotal');

                // $price_ship = 5000;
                $subtotal = Session::get('sum');
                // lấy ship cũ
                // $ship = Session::get('ship');
                // $ship =  (int)$price_ship + (int)$shipAdd * ((int)$quantityTotal + (int)$quantityNew - 1);

                //Lưu giá trị khi ở trong ajax
                Session::set('quantityTotal', $quantityTotal + $quantityNew);

                // Session::set('ship', $ship);

                $subtotal = $subtotal + ($price * $quantityNew);
                Session::set('sum', $subtotal);

                $grandTotal = $subtotal;
                Session::set('grandTotal', $grandTotal);
                echo json_encode($result_json[] = ['subtotal' => $subtotal, 'total' => $grandTotal]);
            } else {

                $quantityNew = $quantityBefore - $quantity;


                // lấy tổng số lượng
                $quantityTotal = Session::get('quantityTotal');

                // $price_ship = 5000;
                $subtotal = Session::get('sum');
                // $ship = Session::get('ship');
                // $ship =  (int)$price_ship + (int)$shipAdd * ((int)$quantityTotal - (int)$quantityNew - 1);

                //Lưu giá trị khi ở trong ajax
                Session::set('quantityTotal', $quantityTotal - $quantityNew);

                // Session::set('ship', $ship);

                $subtotal = $subtotal - ($price * $quantityNew);
                Session::set('sum', $subtotal);

                $grandTotal = $subtotal;
                Session::set('grandTotal', $grandTotal);
                echo json_encode($result_json[] = ['subtotal' => $subtotal, 'total' => $grandTotal]);
            }
            break;
        default:
    }
} else {
    header("location:../404.php");
}
// <li class="totalRow"><a href="checkout" class="btn continue">Vào thanh Toán</a></li>
