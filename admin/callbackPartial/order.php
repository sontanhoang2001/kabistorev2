<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../classes/cart.php';
    $ct = new cart();
    $case = $_POST['case'];
    switch ($case) {
        case 1: {
                $orderID = $_POST['orderID'];
                $num_status = $_POST['num_status'];
                echo $insertCat = $ct->order_status($orderID, $num_status);
                break;
            }
        case 2: {
                $productID = $_POST['productID'];
                $categoryName =  $_POST['categoryName'];
                echo $updateCat = $ct->delivered($productID, $proid, $qty);
                break;
            }
    }
}
