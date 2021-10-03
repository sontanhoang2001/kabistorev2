<?php
include('config/config.php');
include('helpers/format.php');

$host   = DB_HOST;
$user   = DB_USER;
$pass   = DB_PASS;
$dbname = DB_NAME;

$conn = mysqli_connect($host, $user, $pass, $dbname);


if (isset($_POST['query'])) {

    $query = "SELECT * FROM tbl_product WHERE productName LIKE '%{$_POST['query']}%' LIMIT 6";
    $result = mysqli_query($conn, $query);

    $fm = new Format();

    if (mysqli_num_rows($result) > 0) {
        while ($product = mysqli_fetch_array($result)) {

            $img = $product['image'];
            $price = $product['price'];
            $old_price = $product['old_price'];
            if ($old_price != 0) {
                $per = round((int)$temp = ((int)$price * 100) / (int)$old_price);
                echo
                "
                <li>
                    <a href='details.php?proid=" . $product['productId'] . "' class='link-product-result'>
                        <img class='img-result' src='admin/uploads/" . $img . "'>
                        <p class='name-product-result'>" . $product['productName'] . "</p>
                        <span class='price-result'>" . $fm->format_currency($price) . '₫' . "</span>
                        <cite class='cite-result'>" . $fm->format_currency($old_price) . '₫' . "</cite>
                        <i class='per-result'>" . '-' . $per . '%' . "</i>
                    </a>
                </li>";
            } else {
                echo
                "
                <li>
                    <a href='details.php?proid=" . $product['productId'] . "' class='link-product-result'>
                        <img class='img-result' src='admin/uploads/" . $img . "'>
                        <p class='name-product-result'>" . $product['productName'] . "</p>
                        <span class='price-result'>" . $fm->format_currency($price) . '₫' . "</span>
                    </a>
                </li>";
            }
        }
        // echo "<script>
        // $(document).ready(function() {

        //     $('.name-product-result').each(function(f) {

        //         var newstr = $(this).text().substring(0, 45);
        //         $(this).text(newstr + '...');

        //     });
        // })
        // </script>";
    } else {
        // echo "<p style='color:red'>User not found...</p>";
    }
}
