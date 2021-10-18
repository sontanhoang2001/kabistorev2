<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../classes/brand.php';
    $brand = new brand();
    $case = $_POST['case'];
    switch ($case) {
        case 1: {
                $brandName = $_POST['brandName'];
                $insertBrand = $brand->insert_brand($brandName);
                break;
            }
        case 2: {
                $categoryID = $_POST['categoryID'];
                $categoryName =  $_POST['categoryName'];
                echo $updateCat = $cat->update_category($categoryID, $categoryName);
                break;
            }
        case 3: {
                $categoryID = $_POST['categoryID'];
                echo $delCat = $cat->del_category($categoryID);
                break;
            }
    }
}
