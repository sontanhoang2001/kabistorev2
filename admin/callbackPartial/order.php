<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../classes/cart.php';
    $ct = new cart();
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
        case 3: {
                $addressId = $_POST['addressid'];
                $getOrderAddress = $ct->getOrderAddress($addressId);
                if ($getOrderAddress) {
                    while ($result = $getOrderAddress->fetch_assoc()) {
                        $maps_maplat = $result['maps_maplat'];
                        $maps_maplng = $result['maps_maplng'];
                        $note_address = $result['note_address'];
                    }
                    echo json_encode($result_json[] = ['status' => 1, 'maps_maplat' => $maps_maplat, 'maps_maplng' => $maps_maplng, 'note_address' => $note_address]);
                } else {
                    echo json_encode($result_json[] = ['status' => 0]);
                }
                break;
            }
        case 4: {
                $customerId = $_POST['customerId'];
                $getCountOrderSuccess = $ct->getCountOrderSuccess($customerId);
                if ($getCountOrderSuccess) {
                    while ($result = $getCountOrderSuccess->fetch_assoc()) {
                        $numOrderSuccess = $result['numOrderSuccess'];
                        $numOrderWait = $result['numOrderWait'];
                        $numOrderError = $result['numOrderError'];
                        $numOrderScoreBad = $result['numOrderScoreBad'];
                    }
                    echo json_encode($result_json[] = ['status' => 1, 'numOrderSuccess' => $numOrderSuccess, 'numOrderWait' => $numOrderWait, 'numOrderError' => $numOrderError, 'numOrderScoreBad' => $numOrderScoreBad]);
                } else {
                    echo json_encode($result_json[] = ['status' => 0]);
                }
                break;
            }
    }
}
