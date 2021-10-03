<?php
include 'lib/session.php';
include 'helpers/format.php';
include_once "classes/cart.php";

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

            $price_ship = 5000;
            $subtotal = Session::get('sum');
            $ship = Session::get('ship');
            $ship = $ship + $quantityNew * $price_ship;
            Session::set('ship', $ship);

            $subtotal = $subtotal + ($price * $quantityNew);
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
        } else {
            $cartSess = $_SESSION['cart'][$cart_Id];
            $price = $cartSess['price'];
            $quantityNew = $quantityBefore - $quantity;;

            $price_ship = 5000;
            $subtotal = Session::get('sum');
            $ship = Session::get('ship');
            $ship = $ship - $quantityNew * $price_ship;
            Session::set('ship', $ship);

            $subtotal = $subtotal - ($price * $quantityNew);
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
        }
        break;
    default:
}



// <li class="totalRow"><a href="checkout" class="btn continue">Vào thanh Toán</a></li>
