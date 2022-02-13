<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../lib/session.php';
    include_once "../classes/cart.php";
    include_once "../helpers/format.php";

    Session::init();
    $fm = new Format();

    $customer_id = Session::get('customer_id');
    $productId = $_POST['productId'];
    $productSize = $_POST['productSize'];
    $productColor = $_POST['productColor'];
    $quantity = $_POST['quantity'];

    // if($productId == null){
    //     header('Location:login.html');
    //     exit;
    // }

    if (isset($_SESSION['customer_login'])) {
        $ct = new cart();
        echo $ct->add_to_cart($customer_id, $productId, $quantity, $productSize, $productColor);
    } else {
        if (isset($_COOKIE["shopping_cart"])) {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            $number_cart = count($cart_data);
            $elemented = session::get('elemented');
        } else {
            $number_cart = 0;
            $elemented = 1;
            $cart_data = array();
        }

        $item_array = array(
            'cartId' => (int)$elemented - 1,
            'productId' => (int)$productId,
            'quantity' => (int)$quantity,
            'productSize' => (int)$productSize,
            'color' =>  (String)$fm->vn_to_str($productColor)
        );
        $cart_data[] = $item_array;
        $item_data = json_encode($cart_data);


        // if (isset($_SESSION['cart_guest'])) {
        //     $cart = $_SESSION['cart_guest'];
        //     $number_cart = count($cart);
        //     $elemented = session::get('elemented');
        // } else {
        //     $number_cart = 0;
        //     $elemented = 1;
        // }

        $number_cart++;

        if ($number_cart <= 12) {
            session::set('elemented', (int)$elemented + 1);

            // $cart = array();
            // $cart = ['cartId' => (int)$elemented - 1, 'productId' => (int)$productId, 'quantity' => (int)$quantity, 'productSize' => $productSize, 'color' => $productColor];
            // $_SESSION['cart_guest'][] = $cart;

            $name = "shopping_cart";
            $value = $item_data;
            $expire = time() + 365 * 24 * 60 * 60;
            $path = '/';
            setcookie($name, $value, $expire, $path);

            session::set("number_cart", (int)$number_cart);
            $elemented = session::get('elemented');
            setcookie('CartElemented', $elemented, $expire, $path);

            echo json_encode($return_json[][] = ['status' => 1, 'value' => session::get('number_cart')]);
        } else {
            echo json_encode($result_json[][] = ['status' => 4, 'value' => 0]);
        }
    }

    // Session::init();
    // $customer_id = Session::get('customer_id');
    // $id = $_POST['productId'];
    // $quantity = 1;

    // if ($customer_id == null) {
    //     echo "<script> window.location = 'login.php' </script>";
    // } else {
    //     if (isset($_SESSION['cart'])) {
    //         $cart = $_SESSION['cart'];
    //         $element = count($cart);
    //         $elemented = session::get('elemented');
    //     } else {
    //         $element = 0;
    //         $elemented = 1;
    //     }
    //     $cart = array();
    //     $elemented = (int)$elemented++;
    //     $cart = ['id' => $id, 'quantity' => $quantity, 'element' => $elemented - 1];
    //     $_SESSION['cart'][] = $cart;
    //     session::set('number_cart', (int)$element + 1);
    //     session::set('elemented', (int)$elemented + 1);
    //     echo session::get('number_cart');
    // }
} else {
    header("location:../404.php");
}
