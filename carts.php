<?php
include 'inc/header.php';
?>

<?php
Session::set('PHP_SELF', $PHP_SELF = substr($_SERVER['REQUEST_URI'], 18)); // lưu vị trí đường dẫn trang khi chưa đăng nhập

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}

// BỎ CÁC CHỨC NĂNG NÀY BỞI VÌ ĐÃ THAY THẾ BẰNG AJAX
// if (isset($_GET['cartid'])) {
//     $cartid = $_GET['cartid'];
//     $delcart = $ct->del_product_cart($cartid);
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
//     // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
//     $cartId = $_POST['cartId'];
//     $proId = $_POST['proId'];
//     $quantity = $_POST['quantity'];
//     $update_quantity_Cart = $ct->update_quantity_Cart($proId, $quantity, $cartId); // hàm check catName khi submit lên
//     if ($quantity <= 0) {
//         $delcart = $ct->del_product_cart($cartId);
//     }
// }
?>

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="shoping__product">Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Tổng Cộng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="product_data">
                            <?php
                            $i = 1;
                            $subtotal = 0;
                            $qty = 0;
                            if (isset($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $val) {
                                    $productId = $val['id'];
                                    $quantity = $val['quantity'];
                                    $element = $val['element'];

                                    $customer_id = Session::get('customer_id');
                                    $get_product_cart = $ct->get_product_cart($productId);
                                    if ($get_product_cart) {
                                        while ($result = $get_product_cart->fetch_assoc()) {
                            ?>
                                            <tr id="row_data_<?php echo $element; ?>">
                                                <td>
                                                    <?php echo $i++; ?>
                                                </td>
                                                <td class="shoping__cart__item">
                                                    <img src="admin/uploads/<?php echo $result['image'] ?>" alt="">
                                                    <h5><?php echo $result['productName'] ?></h5>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    <?php echo $fm->format_currency($result['price']) . " ₫" ?>
                                                </td>
                                                <form method="GET">
                                                    <td class="shoping__cart__quantity">
                                                        <div class="quantity">
                                                            <!-- <div class="pro-qty">
                                                            <input type="text" class="qty" value="<?php echo $quantity ?>" />
                                                        </div> -->
                                                            <input type="hidden" id="cartId" name="cartId" min="0" value="<?php echo $element; ?>" />
                                                            <input type="hidden" id="proId" name="proId" min="0" value="<?php echo $productId; ?>" />
                                                            <input type="hidden" id="price" value="<?php echo $result['price']; ?>" />
                                                            <input class="input-quantity" id="quantity_<?php echo $element; ?>" type="number" class="buyfield" name="quantity" value="<?php echo $quantity; ?>" min="1" max="100" onblur="updatequantity(this.form)" />
                                                            <!-- <button type="submit" name="submit"><span class="icon_loading"></span> Cập nhật</button> -->
                                                        </div>
                                                    </td>
                                                    <td class="shoping__cart__total">
                                                        <?php
                                                        $total = $result['price'] * $quantity;
                                                        echo $fm->format_currency($total) . " ₫";
                                                        ?>
                                                    </td>
                                                    <td class="shoping__cart__item__close">
                                                        <button onclick="delcart(this.form)" class="close"><span class="icon_close"></span></button>
                                                    </td>
                                                </form>
                                            </tr>
                            <?php
                                            $subtotal += $total;
                                            $qty = $qty + $quantity;
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            if ($i > 1) {
            ?>
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="shop.php" class="primary-btn cart-btn">TIẾP TỤC MUA MẮN</a>&emsp;
                        <?php
                        if (isset($update_quantity_Cart)) {
                            echo $update_quantity_Cart;
                        }
                        ?>

                        <?php
                        if (isset($delcart)) {
                            echo $delcart;
                        }
                        ?>
                        <!-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Cập nhật Giỏi hàng</a> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <!-- <h5>Mã giảm giá</h5>
                            <form action="#">
                                <input type="text" placeholder="Nhập mã giả giá">
                                <button type="submit" class="site-btn">Áp dụng</button>
                            </form> -->
                        </div>
                    </div>
                </div>
                <div id="total_checkouts" class="col-lg-6">
                    <div id="total_checkout" class="shoping__checkout">
                        <h5>Tổng Thanh Toán</h5>
                        <ul>
                            <li>Tạm tính <span><?php echo $fm->format_currency($subtotal) . " ₫";
                                                Session::set('sum', $subtotal);
                                                Session::set('qty', $qty);
                                                ?></span></li>
                            <li>(VAT) <span>10%</span></li>
                            <li>Tổng cộng <span><?php
                                                $vat = $subtotal * 0.1;
                                                $grandTotal = $subtotal + $vat;
                                                echo $fm->format_currency($grandTotal) . " ₫";
                                                Session::set('grandTotal', $grandTotal);
                                                ?></span></li>
                        </ul>
                        <a href="checkout.php" class="primary-btn">Tiến Hành Thanh Toán</a>
                    </div>
                </div>
            <?php
            } else {
                echo '                
                <div class="col-lg-6">
                        <a href="shop.php" class="primary-btn cart-btn">TIẾP TỤC MUA SẮM</a>
                </div>
                <div class="col-lg-6">
                    <p class="justify-content-between">Giỏ của bạn đang trống! Hãy mua sắm ngay bây giờ!</p>
                </div>';
            }
            ?>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->
<?php
include 'inc/footer.php';
?>

<style>
    .big-blue {
        width: 200px;
        height: 200px;
        background-color: #00f;
    }
</style>


<script>
    function updatequantity(form) {
        var url;
        var desc;
        proId = form.proId.value;
        qty = form.quantity.value;
        qty = parseInt(qty);
        cartId = form.cartId.value;
        cartId = parseInt(cartId);
        price = form.price.value;
        Quantity = cartId;
        Price = price;

        if (qty <= 0 || qty > 100) {
            document.getElementById("quantity_" + cartId).value = 1;
        } else {
            url = "ajax_xml_update_quantity_cart.php?proId=" + proId + "&qty=" + qty + "&cartId=" + cartId + "&price=" + price;
            if (window.XMLHttpRequest) {
                request = new XMLHttpRequest();
            } else {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    document.getElementById("product_data").innerHTML = request.responseText;

                    url = "ajax_xml_update_total_price.php";
                    if (window.XMLHttpRequest) {
                        request = new XMLHttpRequest();
                    } else {
                        request = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    request.onreadystatechange = function() {
                        if (request.readyState == 4 && request.status == 200) {
                            document.getElementById("total_checkout").innerHTML = request.responseText;
                        }
                    }
                    request.open('GET', url, true);
                    request.send();
                }
            }
            request.open('GET', url, true);
            request.send();
        }
    }


    function delcart(form) {
        var url;
        var desc;
        Id = form.cartId.value;
        price = form.price.value;
        qty = form.quantity.value;

        event.preventDefault();

        url = "ajax_xml_del_product_cart.php?cartId=" + Id + "&qty=" + qty + "&price=" + price;
        if (window.XMLHttpRequest) {
            request = new XMLHttpRequest();
        } else {
            request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                document.getElementById("row_data_" + Id).style.display = "none";
                document.getElementById("total_checkout").innerHTML = request.responseText;
            }
        }
        request.open('GET', url, true);
        request.send();
    }

    // $('').click(function() {
    //     qty = this.quantity.value;
    //     qty = parseInt(qty);
    //     cartId = this.cartId.value;
    //     cartId = parseInt(cartId);
    //     price = this.price.value;
    //     price = parseInt(price);

    //     $.ajax({
    //         type: "POST",
    //         url: "ajax_xml_del_product_cart.php",
    //         data: {
    //             'cartId': cartId,
    //             'quantity': qty,
    //             'price': price
    //         },
    //         success: function(data) {
    //             $("#row_data_" + productId).css("display", "none")
    //             $("#total_checkout").html(data);
    //         }
    //     });
    // });
</script>