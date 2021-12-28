<?php
if (isset($_POST['searchText'])) {
    include_once '../helpers/format.php';
    include_once '../helpers/helpers.php';
    include_once "../classes/product.php";
    include '../config/global.php';

    $product = new product();
    $fm = new Format();

    $search_text = $_POST['searchText'];
    $live_search = $product->live_search($search_text);

    if ($live_search) {
        while ($result = $live_search->fetch_assoc()) {
            $productName = $result['productName'];
            $product_img =  json_decode($result['image']);
            $product_img = $product_img[0]->image;
            $price = $result['price'];
            $old_price = $result['old_price'];
            if ($old_price != 0) {
                $per = round($temp = (($price * 100) / $old_price) - 100);
                echo
                "
                <li>
                    <a href='details/" . $result['productId'] . '/' . $fm->vn_to_str($productName) . $seo . ".html' class='link-product-result'>
                        <img class='img-result' src='" . $product_img . "'>
                        <p class='name-product-result'>" . $productName . "</p>
                        <span class='price-result'>" . $fm->format_currency($price) . '₫' . "</span>
                        <cite class='cite-result'>" . $fm->format_currency($old_price) . '₫' . "</cite>
                        <i class='per-result'>" . $per . '%' . "</i>
                    </a>
                </li>";
            } else {
                echo
                "
                <li>
                    <a href='details/" . $result['productId'] . '/' . $fm->vn_to_str($productName) . $seo . ".html' class='link-product-result'>
                        <img class='img-result' src='" . $product_img . "'>
                        <p class='name-product-result'>" . $result['productName'] . "</p>
                        <span class='price-result'>" . $fm->format_currency($price) . '₫' . "</span>
                    </a>
                </li>";
            }
        }
    }
} else {
    header("location:../404.php");
}
