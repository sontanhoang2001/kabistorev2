<?php
// $productid = mysqli_real_escape_string($conn, $productid);
// $customer_id = mysqli_real_escape_string($conn, $customer_id);

// Nếu typeId = 1 thì thêm vào wishlist ngược lại thì xóa wishlist
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../lib/session.php';
    include_once "../classes/cart.php";
    Session::init();
    $productId = $_POST['productId'];
    $customer_id = Session::get('customer_id');

    $ct = new cart();
    echo $ct->add_to_wishlist($productId, $customer_id);
} else {
    header("location:../404.php");
}