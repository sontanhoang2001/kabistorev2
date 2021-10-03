<?php
include 'lib/session.php';
include_once "classes/cart.php";

Session::init();
$ct = new cart();
$formData = $_POST['formData'];

// $check_payment = $ct->check_payment();
// if ($check_payment) {
//     header('Location:success.php');
//     echo "#" . $check_payment;
// } else {
//     // $customer_id = Session::get('customer_id');
//     // $insertOrder = $ct->insertOrder($formData, $customer_id);
// }

// header('Location:success.php');

echo $insertOrder = $ct->insertOrder($formData);