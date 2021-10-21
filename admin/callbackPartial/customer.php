<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../classes/customer.php';
    $cs = new customer();
    $case = $_POST['case'];
    switch ($case) {
        case 1: {
                $orderId = $_POST['orderId'];
                $num_status = $_POST['num_status'];
                echo $order_status = $ct->order_status($orderId, $num_status);
                break;
            }
        case 2: {
                $orderId =  $_POST['orderId'];
                $productId = $_POST['productId'];
                $quantity = $_POST['quantity'];
                echo $updateCat = $ct->delivered($orderId, $productId, $quantity);
                break;
            }
    }
}
