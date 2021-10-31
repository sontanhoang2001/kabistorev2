<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../lib/session.php';
    include_once "../classes/cart.php";

    Session::init();
    $fm = new Format();
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
            $ship = Session::get('ship');

            // $subtotal = $subtotal + ($price * $quantityNew);
            Session::set('sum', $subtotal);

            $grandTotal = $subtotal + $ship - $discount;
            Session::set('grandTotal', $grandTotal);
            echo json_encode($result_json[] = ['subtotal' => $fm->format_currency($subtotal) . " ₫", 'ship' => $fm->format_currency($ship) . " ₫", 'total' => $fm->format_currency($grandTotal) . " ₫", 'discount' => $fm->format_currency($discount) . " ₫"]);
            break;
        case 2:
            $subtotal = Session::get('sum');
            $ship = Session::get('ship');

            // $subtotal = $subtotal + ($price * $quantityNew);
            Session::set('sum', $subtotal);

            $grandTotal = $subtotal + $ship;
            Session::set('grandTotal', $grandTotal);
            echo json_encode($result_json[] = ['subtotal' => $fm->format_currency($subtotal) . " ₫", 'ship' => $fm->format_currency($ship) . " ₫", 'total' => $fm->format_currency($grandTotal) . " ₫"]);
            break;
        default:
    }
} else {
    header("location:../404.php");
}
