<?php
function delCartCookie($cart_Id)
{
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);

    foreach ($cart_data as $keys => $values) {
        if ($cart_data[$keys]['cartId'] == $cart_Id) {
            unset($cart_data[$keys]);
            $item_data = json_encode($cart_data);

            $name = "shopping_cart";
            $value = $item_data;
            $expire = time() + 365 * 24 * 60 * 60;
            $path = '/';
            setcookie($name, $value, $expire, $path);
            return true;
        }
    }
}

function updateCartCookie($cart_Id, $productId, $quantity)
{
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);

    foreach ($cart_data as $keys => $values) {
        if ($cart_data[$keys]['cartId'] == $cart_Id) {
            $productSize = $cart_data[$keys]['productSize'];
            $color = $cart_data[$keys]['color'];

            $item_array = array(
                'cartId' => (int)$cart_Id,
                'productId' => (int)$productId,
                'quantity' => (int)$quantity,
                'productSize' => $productSize,
                'color' =>  (String)$color
            );
            $cart_data[$keys] = $item_array;
            $item_data = json_encode($cart_data);

            $name = "shopping_cart";
            $value = $item_data;
            $expire = time() + 365 * 24 * 60 * 60;
            $path = '/';
            setcookie($name, $value, $expire, $path);
        }
    }
}
