<?php
include 'lib/session.php';
include_once "classes/cart.php";

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

        $price_ship = 5000;
        $subtotal = Session::get('sum');
        $ship = Session::get('ship');

        // $subtotal = $subtotal + ($price * $quantityNew);
        Session::set('sum', $subtotal);

        $grandTotal = $subtotal + $ship - $discount;
        Session::set('grandTotal', $grandTotal);
        echo '
                        <ul>
                            <li class="totalRow"><span class="label">Tạm Tính:</span><span class="value">' . $fm->format_currency($subtotal) . " ₫" . '</span></li>
                            <li class="totalRow"><span class="label">phí giao hàng:</span><span class="value">' . "+ " . $fm->format_currency($ship) . " ₫" . '</span></li>
                            <li class="totalRow">Giảm giá:<span class="value">' . '-' . $fm->format_currency($discount) . '</span></li>
                            <li class="totalRow final"><span class="label">Tổng Cộng:</span><span class="value">' . $fm->format_currency($grandTotal) . " ₫" . '</span></li>
                            <li class="totalRow"><button type="submit" id="btn_checkout" name="cartcheckout" class="btn btn-success">Xác nhận giỏ hàng</button></li>
                            <li class="errorRow"></li>
                        </ul>
                    ';
        break;
    case 2:
        $subtotal = Session::get('sum');
        $ship = Session::get('ship');

        // $subtotal = $subtotal + ($price * $quantityNew);
        Session::set('sum', $subtotal);

        $grandTotal = $subtotal + $ship;
        Session::set('grandTotal', $grandTotal);
        echo '
                            <ul>
                                <li class="totalRow"><span class="label">Tạm Tính:</span><span class="value">' . $fm->format_currency($subtotal) . " ₫" . '</span></li>
                                <li class="totalRow"><span class="label">phí giao hàng:</span><span class="value">' . "+ " . $fm->format_currency($ship) . " ₫" . '</span></li>
                                <li class="totalRow final"><span class="label">Tổng Cộng:</span><span class="value">' . $fm->format_currency($grandTotal) . " ₫" . '</span></li>
                                <li class="totalRow"><button type="submit" id="btn_checkout" name="cartcheckout" class="btn btn-success">Xác nhận giỏ hàng</button></li>
                                <li class="errorRow"></li>
                            </ul>
                        ';
        break;
    default:
}
