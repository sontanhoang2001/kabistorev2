<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once "../classes/customer.php";
    $cs = new customer();

    $formData = $_POST['formData'];
    echo $login_Customer = $cs->insert_customer($formData);
} else {
    header("location:../404.php");
}