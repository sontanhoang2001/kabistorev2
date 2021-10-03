<?php

include('config/config.php');
include('helpers/format.php');

$host   = DB_HOST;
$user   = DB_USER;
$pass   = DB_PASS;
$dbname = DB_NAME;

$fm = new Format();

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$product_num = 6;
$index_page = ($page - 1) * $product_num;
$query = "SELECT * FROM tbl_product order by productId desc LIMIT $index_page, $product_num";
$result = mysqli_query($conn, $query);



while ($product = mysqli_fetch_array($result)) {

    $old_price = $product['old_price'];
    $price = $product['price'];
    $per  = round($temp = ($price * 100) / $old_price);




    echo
        "
    <!-- Single Product -->
    <div class='col-6 col-sm-6 col-lg-4'>
        <div class='single-product-wrapper'>
            <!-- Product Image -->
            <div class='product-img'>
                <a href='details.php?proid=" . $product['productId'] . "'>
                    <img src='admin/uploads/" . $product['image'] . "' alt=''>
                </a>
                <!-- Hover Thumb -->
                <!-- <img class='hover-img' src='img/product-img/product-2.jpg' alt=''> -->

                <!-- Product Badge -->
                <div class='product-badge offer-badge'>
                    <span>
                        " . "-" . $per . "%" . "
                    </span>
                </div>
                <!-- Favourite -->
                <div class='product-favourite'>

                </div>
            </div>

            <!-- Product Description -->
            <div class='product-description'>
                <span>topshop</span>
                <a href='single-product-details.html'>
                    <h6>" . $product['productName'] . "</h6>
                </a>
                <p class='product-price'>
                    <span class='old-price'>" . $fm->format_currency($product['old_price']) . " " . "₫" . "
                    </span> " . $fm->format_currency($product['price']) . " " . "₫" . "
                </p>

                <!-- Hover Content -->
                <div class='hover-content'>
                    <!-- Add to Cart -->
                    <div class='add-to-cart-btn'>
                        <a href='#' class='essence-btn' style='text-decoration: none;'><i class='fa fa-shopping-cart fa-2x' aria-hidden='true'></i> Thêm vào</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ";
}
