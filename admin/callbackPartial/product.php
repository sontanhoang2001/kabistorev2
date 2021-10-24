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
                // insert sản phẩm
                $formData = $_POST['formData'];
                echo $insertProduct = $product->insert_product($formData);
                break;
            }
        case 3: {
                // update thêm số lượng sản phẩm
                $formData = $_POST['formData'];
                echo $update_quantity_product = $product->update_quantity_product($formData);
                break;
            }
        case 4: {
                // insert sản phẩm
                $formData = $_POST['formData'];
                echo $insertProduct = $product->insert_product($formData);
                break;
            }
    }
}
