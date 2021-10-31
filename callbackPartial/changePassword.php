<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../lib/session.php';
    include_once "../classes/customer.php";
    $cs = new customer();
    Session::init();
    $customer_id = Session::get('customer_id');

    $formData = $_POST['formData'];
    echo $update_customers_password = $cs->update_customers_password($customer_id, $formData);
} else {
    header("location:../404.php");
}