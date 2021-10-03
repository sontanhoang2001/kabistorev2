<?php

include('config/config.php');
include('helpers/format.php');
include 'lib/session.php';
Session::init();

$fm = new Format();

$host   = DB_HOST;
$user   = DB_USER;
$pass   = DB_PASS;
$dbname = DB_NAME;

// Create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$quantity = $conn->real_escape_string($_GET['qty']);
$id = $conn->real_escape_string($_GET['proId']);
$price = $conn->real_escape_string($_GET['price']);
$element = $_GET['cartId'];

$query = "SELECT product_remain FROM tbl_product WHERE productId = '$id' ";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product_remain = $row['product_remain'];
        if ($product_remain > $quantity) {
            $cart = ['id' => $id, 'quantity' => $quantity, 'element' => $element];
            $_SESSION['cart'][$element] = $cart;
            session::set('number_cart', $element);
            // $total = $price * $quantity;
            // echo $fm->format_currency($total) . " ₫";
            // echo "Đã cập nhật";

            $i = 1;
            $subtotal = 0;
            $qty = 0;
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $val) {
                    $productId = $val['id'];
                    $quantity = $val['quantity'];
                    $element = $val['element'];

                    $query = "SELECT productName, price, image from tbl_product where productId = '$productId' ";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $total = $row['price'] * $quantity;
                            echo '
                            <tr>
                                <td>
                                    ' . $i++ . '
                                </td>
                                <td class="shoping__cart__item">
                                    <img src="admin/uploads/' . $row['image'] . '" alt="">
                                    <h5>' . $row['productName'] . '</h5>
                                </td>
                                <td class="shoping__cart__price">
                                   ' . $fm->format_currency($row['price']) . " ₫" . '
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <form method="post">
                                            <input type="hidden" id="cartId" name="cartId" min="0" value="' . $element . '" />
                                            <input type="hidden" id="proId" name="proId" min="0" value="' . $productId . '" />
                                            <input type="hidden" id="price" value="' . $row['price'] . '" />
                                            <input class="input-quantity" id="quantity" type="number" class="buyfield" name="quantity" value="' . $quantity . '" min="1" max="100" onblur="updatequantity(this.form)" />
                                        </form>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    ' . $fm->format_currency($total) . " ₫" . '
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a class="close" href="?cartid=' . $element . '"><span class="icon_close"></span></a>
                                </td>
                            </tr>';
                            $subtotal += $total;
                            $qty = $qty + $quantity;
                            Session::set('sum', $subtotal);
                        }
                    }
                }
            }
        } else {
            $i = 1;
            $subtotal = 0;
            $qty = 0;
            if (isset($_SESSION['cart'])) {
                echo '
                <tr>
                <td></td>
                <td><br><span style="color: red; font-weight: bold;"> Số lượng bạn đặt quá số lượng chúng tôi chỉ còn  ' . $product_remain . '  món</span></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                ';

                foreach ($_SESSION['cart'] as $val) {
                    $productId = $val['id'];
                    $quantity = $val['quantity'];
                    $element = $val['element'];

                    $query = "SELECT productName, price, image from tbl_product where productId = '$productId' ";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $total = $row['price'] * $quantity;

                            echo '
                            <tr>
                                <td>
                                    ' . $i++ . '
                                </td>
                                <td class="shoping__cart__item">
                                    <img src="admin/uploads/' . $row['image'] . '" alt="">
                                    <h5>' . $row['productName'] . '</h5>
                                </td>
                                <td class="shoping__cart__price">
                                   ' . $fm->format_currency($row['price']) . " ₫" . '
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <form method="post">
                                            <input type="hidden" id="cartId" name="cartId" min="0" value="' . $element . '" />
                                            <input type="hidden" id="proId" name="proId" min="0" value="' . $productId . '" />
                                            <input type="hidden" id="price" value="' . $row['price'] . '" />
                                            <input class="input-quantity" id="quantity" type="number" class="buyfield" name="quantity" value="' . $quantity . '" min="1" max="100" onblur="updatequantity(this.form)" />
                                        </form>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    ' . $fm->format_currency($total) . " ₫" . '
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a class="close" href="?cartid=' . $element . '"><span class="icon_close"></span></a>
                                </td>
                            </tr>';
                            // echo "<span style='color: red;'> Số lượng " . $quantity . " bạn đặt quá số lượng chúng tôi chỉ còn " . $product_remain . " món</span> ";
                        }
                    }
                }
            }
        }
    }
} else {
    echo "Lỗi không thể thực hiện được";
}
$conn->close();
