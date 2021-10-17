<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../classes/category.php';
    $cat = new category();
    $case = $_POST['case'];
    switch ($case) {
        case 1: {
                $categoryName = $_POST['categoryName'];
                echo $insertCat = $cat->insert_category($categoryName);
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
