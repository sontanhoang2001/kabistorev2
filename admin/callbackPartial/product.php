<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../classes/product.php';
    $product = new product();
    $case = $_POST['case'];
    switch ($case) {
        case 1: {
                $productId = $_POST['productId'];
                $viewProductOrder = $product->viewProductOrderAdmin($productId);
                if ($viewProductOrder) {
                    while ($result =  $viewProductOrder->fetch_assoc()) {
                        $productName = $result['productName'];
                        $product_code = $result['product_code'];
                        $product_remain = $result['product_remain'];
                        $price = $result['price'];
                    }
                    echo json_encode($result_json[] = ['status' => 1, 'productName' => $productName, 'product_code' => $product_code, 'product_remain' => $product_remain, 'price' => $price]);
                } else {
                    echo json_encode($result_json[] = ['status' => 0]);
                }
                break;
            }
        case 2: {

            }

    }
}
