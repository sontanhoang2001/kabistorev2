<?php
include('helpers/format.php');
include 'lib/session.php';
Session::init();
$fm = new Format();

$Id = $_GET['cartId'];
$quantity = $_GET['qty'];
$price = $_GET['price'];

// $cart = $_SESSION['cart'][$cartid];

$cart = $_SESSION['cart'];
$element = count($cart);
$count = (int)$element;
if ($element == 1) {
    echo "Giỏ hàng của bạn đang trống!";
} else {
    $subtotal = Session::get('sum');

    // Session::set('qty', $qty);

    $vat = $subtotal * 0.1;
    $subtotal = $subtotal - ($price * $quantity);
    Session::set('sum', $subtotal);

    $grandTotal = $subtotal + $vat;
    Session::set('grandTotal', $grandTotal);
    echo '
    <h5>Tổng Thanh Toán</h5>
    <ul>
        <li>Tạm tính <span>' . $fm->format_currency($subtotal) . " ₫" . '</span></li>
        <li>(VAT) <span>10%</span></li>
        <li>Tổng cộng <span>' . $fm->format_currency($grandTotal) . " ₫" . '</span></li>
    </ul>
    <a href="checkout.php" class="primary-btn">Tiến Hành Thanh Toán</a>';
}
unset($_SESSION['cart'][$Id]);
session::set('number_cart', (int)$element - 1);
