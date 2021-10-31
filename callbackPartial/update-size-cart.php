<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../lib/session.php';
    include '../helpers/format.php';
    include_once "../classes/cart.php";

    Session::init();
    $fm = new Format();
    $ct = new cart();

    $cart_Id = $_POST['cartId'];
    $size = $_POST['size'];

    $customer_id = Session::get('customer_id');
    echo $ct->update_size_cart($customer_id, $cart_Id, $size);
} else {
    header("location:../404.php");
 }