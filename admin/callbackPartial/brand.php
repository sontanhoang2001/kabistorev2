<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../classes/brand.php';
    $brand = new brand();
    $case = $_POST['case'];
    switch ($case) {
        case 1: {
                $brandName = $_POST['brandName'];
                echo $insertBrand = $brand->insert_brand($brandName);
                break;
            }
        case 2: {
                $brandId = $_POST['brandID'];
                $brandName =  $_POST['brandName'];
                echo $updateBrand = $brand->update_brand($brandId, $brandName);
                break;
            }
        case 3: {
                $brandId = $_POST['brandID'];
                echo $delbrand = $brand->del_brand($brandId);
                break;
            }
    }
}
