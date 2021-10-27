<?php
include '../lib/session.php';
include_once "../classes/cart.php";
Session::init();
$customer_id = Session::get('customer_id');
$productId = $_POST['productId'];
$productSize = $_POST['productSize'];
$quantity = $_POST['quantity'];

// if($productId == null){
//     header('Location:login.html');
//     exit;
// }

$ct = new cart();
echo $ct->add_to_cart($customer_id, $productId, $productSize, $quantity);
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
