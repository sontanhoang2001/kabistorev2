<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../lib/session.php';
    include_once '../helpers/format.php';
    include_once "../classes/customer.php";

    Session::init();
    $fm = new Format();
    $cs = new customer();

    $formData = $_POST['formData'];

    $customer_id = Session::get('customer_id');
    $UpdateCustomers = $cs->update_customers($formData, $customer_id);
}
