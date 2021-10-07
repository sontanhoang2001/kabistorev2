<?php
if (isset($_POST['searchText'])) {
    include_once '../lib/database.php';
    include_once '../helpers/format.php';
    include_once '../helpers/helpers.php';
    include_once "../classes/product.php";
    $product = new product();
    $fm = new Format();

    $search_text = $_POST['searchText'];
    $live_search = $product->live_search($search_text);

    if ($live_search) {
        while ($result = $live_search->fetch_assoc()) {
            $img = $result['image'];
            $price = $result['price'];
            $old_price = $result['old_price'];
            if ($old_price != 0) {
                $per = round((int)$temp = ((int)$price * 100) / (int)$old_price);
                echo
                "
                <li>
                    <a href='details.php?proid=" . $result['productId'] . "' class='link-product-result'>
                        <img class='img-result' src='admin/uploads/" . $img . "'>
                        <p class='name-product-result'>" . $result['productName'] . "</p>
                        <span class='price-result'>" . $fm->format_currency($price) . '₫' . "</span>
                        <cite class='cite-result'>" . $fm->format_currency($old_price) . '₫' . "</cite>
                        <i class='per-result'>" . '-' . $per . '%' . "</i>
                    </a>
                </li>";
            } else {
                echo
                "
                <li>
                    <a href='details.php?proid=" . $result['productId'] . "' class='link-product-result'>
                        <img class='img-result' src='admin/uploads/" . $img . "'>
                        <p class='name-product-result'>" . $result['productName'] . "</p>
                        <span class='price-result'>" . $fm->format_currency($price) . '₫' . "</span>
                    </a>
                </li>";
            }
        }
    }
}