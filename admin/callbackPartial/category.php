<?php
include '../../classes/category.php';
$cat = new category();

$categoryID = $_POST['categoryID']; // Lấy catid trên host
echo $delCat = $cat->del_category($categoryID); // hàm check delete Name khi submit lên
