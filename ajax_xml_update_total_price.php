<?php
include('helpers/format.php');
include 'lib/session.php';
Session::init();

$fm = new Format();
$subtotal = Session::get('sum');
// Session::set('qty', $qty);

$vat = $subtotal * 0.1;
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
