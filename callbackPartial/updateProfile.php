<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../lib/session.php';
    include_once "../classes/customer.php";
    $cs = new customer();
    Session::init();
    $customer_id = Session::get('customer_id');

    $formData = $_POST['formData'];
    echo $UpdateCustomers = $cs->update_customers($formData, $customer_id);
} else {
    header("location:../404.php");
}
