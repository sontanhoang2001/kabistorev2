<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../lib/session.php';
    include_once "../classes/cart.php";

    Session::init();
    $ct = new cart();
    $case = $_POST['case'];
    $promoCode = $_POST['promoCode'];

    // case = 0 đi lên server
    // case = 1 cập nhật lại 1 phần của tổng tiền
    switch ($case) {
        case 0:
            echo $discount = $ct->discount($promoCode);
            break;
        case 1:
            $discount = session::get('discountMoney');
            // unset($_SESSION['discountMoney']);

            $subtotal = Session::get('sum');
            // $ship = Session::get('ship');

            // $subtotal = $subtotal + ($price * $quantityNew);
            Session::set('sum', $subtotal);

            $grandTotal = $subtotal - $discount;

            Session::set('grandTotal', $grandTotal);
            echo json_encode($result_json[] = ['subtotal' => $subtotal, 'total' => $grandTotal, 'discount' => $discount]);
            break;
        case 2:
            $subtotal = Session::get('sum');
            // $ship = Session::get('ship');

            // $subtotal = $subtotal + ($price * $quantityNew);
            Session::set('sum', $subtotal);

            $grandTotal = $subtotal;
            Session::set('grandTotal', $grandTotal);
            echo json_encode($result_json[] = ['subtotal' => $subtotal, 'total' => $grandTotal]);
            break;
        default:
    }
} else {
    header("location:../404.php");
}
