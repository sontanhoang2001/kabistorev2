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
                // select data product for edit product
                $productId = $_POST['productId'];
                $getroductForEdit = $product->getroductForEdit($productId);
                if ($getroductForEdit) {
                    while ($result =  $getroductForEdit->fetch_assoc()) {
                        $productName = $result['productName'];
                        $product_code = $result['product_code'];
                        $catId = $result['catId'];
                        $brandId = $result['brandId'];
                        $product_desc = $result['product_desc'];
                        $type = $result['type'];
                        $old_price = $result['old_price'];
                        $price = $result['price'];
                        $image = $result['image'];
                        $size = $result['size'];
                    }
                    echo json_encode($result_json[] = ['status' => 1, 'product_code' => $product_code, 'productName' => $productName, 'catId' => $catId, 'brandId' => $brandId, 'product_desc' => $product_desc, 'type' => $type, 'old_price' => $old_price, 'price' => $price, 'image' => $image, 'size' => $size]);
                } else {
                    echo json_encode($result_json[] = ['status' => 0]);
                }
                break;
            }
        case 5: {
                // Cập nhật sản phẩm
                $formData = $_POST['formData'];
                echo $update_product = $product->update_product($formData);
                break;
            }
    }
}
