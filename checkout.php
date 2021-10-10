<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<link rel="stylesheet" type="text/css" href="css/payment.css">

<?php
$disable_check_out = Session::get('disable_check_out');
if (isset($_POST['cartcheckout']) && ($disable_check_out == 0)) {
    if (Session::get('payment') == false) {
        header('Location:404.html');
    }
} else {
    header('Location:404.html');
}
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['orders'])) {

//     // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
//     // $UpdateCustomers = $cs->update_customers_location($_POST, $id); // hàm check catName khi submit lên
//     // $delCart = $ct->del_all_data_cart($customer_id);
//     // $sendGmail = $ct->insertOrder($customer_id);
//     $customer_id = Session::get('customer_id');
//     $insertOrder = $ct->insertOrder($_POST, $customer_id);
// }

// if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
//     $customer_id = Session::get('customer_id');
//     $insertOrder = $ct->insertOrder($customer_id);
//     // $delCart = $ct->del_all_data_cart($customer_id);
//     // $sendGmail = $ct->insertOrder($customer_id);
//     header('Location:success.php');
// }
?>
<link rel="stylesheet" type="text/css" href="css/map.css">

<div class="container-fluid pt-4">
    <h1 class="projTitle">Thanh Toán an toàn<span>-và</span> đơn giản</h1>
    <hr>
    <div class="card-body p-0">
        <div class="row upper">
            <span><i class="fa fa-check-circle-o"></i> Giỏ hàng</span>
            <span id="payment"><span id="number-circle">2</span> Thanh toán</span>
            <span id="payment"><span id="number-circle">3</span> Hoàn tất</span>
        </div>
        <form id="f_order" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-7">
                    <div class="left-panel border">
                        <div class="header">Thông tin giao hàng</div>
                        <!-- <div class="icons"> <img src="https://img.icons8.com/color/48/000000/visa.png" /> <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png" /> <img src="https://img.icons8.com/color/48/000000/maestro.png" /> </div> -->
                        <?php
                        $id = Session::get('customer_id');
                        $get_customers = $cs->show_customers($id);
                        if ($get_customers) {
                            while ($result = $get_customers->fetch_assoc()) {
                                // neu sesstion da dc ta thi gan ga tri sesstion
                                $lng = $result['maps_maplng'];
                                $lat = $result['maps_maplat'];
                                $phone = $result['phone'];
                        ?>
                                <div class="col-md-12 pt-4">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">
                                            <div class="mx-auto" style="width: 140px;">
                                                <div class="d-flex justify-content-center align-items-center rounded" style="height: 120px; background-color: rgb(233, 236, 239);">
                                                    <span><img class="avatar img-thumbnail border-1" src="upload/avatars/<?php echo $result['avatar']; ?>" /></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                <h5 class="text-nowrap text-primary"><?php echo $result['name']; ?></h5>
                                                <div class=""><?php echo $result['email']; ?></div>
                                                <div class=""><?php echo $phone; ?></div>
                                                <label class="pt-1">
                                                    <a href="profile.html" class="btn-editProfile btn-primary"><i class="fa fa-edit"></i> Chỉnh sửa</a></input>
                                                </label>
                                                <div class="mt-2">
                                                    <input type="text" name="avatarold" value="<?php echo $result['avatar']; ?>" hidden>
                                                </div>
                                            </div>
                                            <!-- <div class="text-center text-sm-right">
                                                    <span class="badge badge-secondary">administrator</span>
                                                    <div class="text-muted"><small><?php echo $result['date_Joined']; ?></small></div>
                                                </div> -->
                                        </div>

                                    </div>
                                    <hr>

                                    <div class="form-group" id="location-group">
                                        <div class="row-flex">
                                            <label for="maps_address"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Ghim vị trí giao hàng</label>
                                            <!-- <input type="text" class="form-control" name="maps_address" id="maps_address" value="" placeholder="Nhập tên địa điểm cần tìm"> -->
                                            <div id="maps_maparea">
                                                <div class="panel-google-maps">
                                                    <div id="map"></div>
                                                    <div id="menu-map">
                                                        <input id="satellite-v9" type="radio" name="rtoggle" value="satellite" checked="checked">
                                                        <label for="satellite-v9">vệ tinh</label>
                                                        <input id="streets-v11" type="radio" name="rtoggle" value="streets" checked="checked">
                                                        <label for="streets-v11">đường phố</label>
                                                        <input id="dark-v10" type="radio" name="rtoggle" value="dark">
                                                        <label for="dark-v10">tối</label>
                                                    </div>
                                                </div>
                                                <!-- <div class="panel-google-maps" id="maps_mapcanvas" class="form-group"></div> -->
                                                <!-- <div class="panel-google-maps">
                                                <div id="map"></div>
                                            </div> -->
                                                <div class="form-group">
                                                    <input class="col-md-6" type="hidden" class="form-control" name="maps_maplat" id="lat" readonly="readonly">
                                                    <input class="col-md-6" type="hidden" class="form-control" name="maps_maplng" id="lng" readonly="readonly">
                                                    <input class="col-md-12" type="hidden" class="form-control" name="geocoder" id="geocoding" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <div class="form-group">
                            <div class="row pt-2">
                                <div class="col-md-12 col-xs-12">
                                    <label for="address"><i class="fa fa-pencil" aria-hidden="true"></i> Ghi chú địa chỉ cụ thể:</label>
                                    <input type="text" class="form-control" id="note" name="note">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="geocoder" class="lGeocoder"><i class="fa fa-map-marker" aria-hidden="true"></i> Vị trí hiện tại của bạn:</label>
                                    <div id="geo-text" class="text-danger">Đang tìm vị trí...</div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="button" name="localtion" id="saveLocaltion" onclick="getLocation();" class="btn btn-danger btn-lock"><i class="fa fa-map-marker" aria-hidden="true"></i> Vị trí hiện tại</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php unset($_SESSION['cart_payment']);
                $i = 1;
                $subtotal = 0;
                $ship = 0;
                $price_ship = 5000;
                $customer_id = Session::get('customer_id');
                $get_product_cart = $ct->get_product_cart($customer_id);
                $num_rows = mysqli_num_rows($get_product_cart);
                ?>
                <div class="col-md-5">
                    <div class="right-panel border">
                        <div class="header">Thông tin đơn hàng</div>
                        <p><?php echo $num_rows ?> sản phẩm</p>
                        <?php
                        if ($get_product_cart) {
                            while ($result = $get_product_cart->fetch_assoc()) {
                                $cartId = $result['cartId'];
                                $productName = $result['productName'];
                                $price = $result['price'];
                                $quantity = $result['quantity'];
                                $productSize = $result['productSize'];
                        ?>
                                <div class="row item" id="<?php echo "c" . $cartId ?>">
                                    <div class="col-4 align-self-center">
                                        <img class="img-fluid" src="admin/uploads/<?php echo $result['image']; ?>">
                                    </div>
                                    <div class="col-8">
                                        <div class="row text-muted itemCode">#QUE-007544-002</div>
                                        <div class="row productName-item"><?php echo $result['productName'] ?></div>
                                        <?php if ($productSize != 0) { ?>
                                            <div class="row"><small>Size: 

                                                    <?php
                                                    switch ($quantity) {
                                                        case 4: {
                                                                echo "XL";
                                                                break;
                                                            }
                                                        case 3: {
                                                                echo "X";
                                                                break;
                                                            }
                                                        case 2: {
                                                                echo "M";
                                                                break;
                                                            }
                                                        case 1: {
                                                                echo "S";
                                                                break;
                                                            }
                                                    } ?>
                                            </div>
                                        <?php } ?>
                                        <div class="row"><small>Giá: <span class="price"><?php echo $price ?></span></small>
                                            <div class="qty-item">&emsp;x&emsp;<?php echo $quantity ?></div>
                                        </div>
                                        <div class="col-12 text-right totalPrice-item">
                                            <?php
                                            $total = $result['price'] * $quantity;
                                            echo $fm->format_currency($total) . ' ₫';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                        <?php
                                //set sesstion to cart
                                $cart = array();
                                $cart = ['cartId' => $cartId, 'productId' => $result['productId'], 'productName' => $productName, 'totalPrice' => $total, 'quantity' => $quantity];
                                $_SESSION['cart_payment'][] = $cart;
                                $ship = $ship + $quantity * $price_ship;
                                $subtotal += $total;
                            }
                        }
                        ?>
                        <?php
                        // $check_cart = $ct->check_cart();
                        // if ($check_cart) {
                        $discount = 0;
                        ?>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="label-payment" id="label_payment">Phương thức thanh toán</label>
                            </div>
                            <div class="col-md-12">
                                <label>
                                    <input type="radio" name="payment_methods" class="card-input-element" value="1" checked="checked" />
                                    <div class="panel panel-default card-input">
                                        <img src="img/core-img/income.svg" alt="">
                                    </div>
                                </label>
                                <label>
                                    <input type="radio" name="payment_methods" value="2" class="card-input-element" />
                                    <div class="panel panel-default card-input">
                                        <img src="img/core-img/Vi-MoMo-new.jpg" alt="">
                                    </div>
                                </label>
                                <label>
                                    <input type="radio" name="payment_methods" value="3" class="card-input-element" />
                                    <div class="panel panel-default card-input">
                                        <img src="img/core-img/visa.svg" alt="">
                                    </div>
                                </label>
                            </div>
                            <div class="clearfix"></div>
                            <p class="text-payment-methods"> Phương thức thanh toán bằng tiền mặt</p>
                        </div>
                        <hr>
                        <div class="form-group">

                            <!-- <div class="promoCode">
                                <label for="promo">Mã Giảm Giá</label>
                                <input class="form-control" type="text" name="promo"value="<?php echo $promo_code; ?>" />
                                <!-- <a href="" class="btn" id="discount"></a> -->
                            <!-- </div> -->


                            <?php
                            $discount = session::get('discountMoney');
                            ?>
                            <div class="row lower">
                                <div class="col text-left">Tạm tính</div>
                                <div class="col text-right"><?php echo $fm->format_currency($subtotal) . " ₫";
                                                            Session::set('sum', $subtotal);
                                                            Session::set('ship', $ship);
                                                            ?>
                                </div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left">Phí giao hàng</div>
                                <div class="col text-right"><?php echo "+ " . $fm->format_currency($ship) . " ₫"; ?></div>
                            </div>
                            <?php if ($discount != 0) {
                            ?>
                                <div class="row lower">
                                    <div class="col text-left"><b>Giảm giá</b></div>
                                    <div class="col text-right"><b><?php echo "- " . $fm->format_currency($discount); ?></b></div>
                                </div>
                            <?php
                            } ?>
                            <div class="row lower">
                                <div class="col text-left"><b>Tổng cộng</b></div>
                                <div class="col text-right"><b>
                                        <?php
                                        $grandTotal = $subtotal + $ship;
                                        echo $fm->format_currency($grandTotal - $discount) . " ₫";
                                        ?></b>
                                </div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left"><a href="cart.html"><u>Sửa mã giảm giá</u></a></div>
                            </div>
                            <button id="orders" class="btn" type="submit" name="orders"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;Đặt Hàng</button>
                            <div class="from-group error-group">
                                <div class="alert alert-danger" id="error-geocoder">
                                    <strong>Cảnh báo!</strong> Vui lòng nhấn vào nút xác nhận vị trí, để tiếp tục đặt hàng. <a href="#location-group" class="alert-link">Sửa lỗi</a>.
                                </div>

                                <div class="alert alert-danger" id="error-payment-methods1">
                                    <strong>Cảnh báo!</strong> Thanh toán Momo đang được nâng cấp. Vui lòng chọn phương thức khác. <a href="#" class="alert-link">Sửa lỗi</a>.
                                </div>
                                <div class="alert alert-danger" id="error-payment-methods2">
                                    <strong>Cảnh báo!</strong> Thanh toán Visa đang được nâng cấp. Vui lòng chọn phương thức khác. <a href="#" class="alert-link">Sửa lỗi</a>.
                                </div>
                            </div>
                            <p class="text-muted text-center">Thông tin thanh toán sẽ được mã hóa</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<?php

// foreach ($_SESSION['cart_payment'] as $val) {
//     echo "cartId: " . $val['cartId'] . " - ";
//     echo "id: " . $val['productId'] . " - ";
//     echo "ProductName: " . $val['productName'] . " - ";
//     echo "qty: " . $val['quantity'];
//     echo "<br>";
// }
?>
<?php
include 'inc/footer.php';
?>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.3.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.3.0/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css">
<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script>
    var allow_order = false;
    var user_location,
        lat = <?php echo ($lat == null) ? 0 : $lat ?>,
        lng = <?php echo ($lng == null) ? 0 : $lng ?>;

    if (lng != 0 && lat != 0) {
        var saved_markers = [<?php echo $lng; ?>, <?php echo $lat; ?>];
        user_location = saved_markers;
    } else {
        user_location = [105.7691644, 10.0353821];
    }

    var phone = <?php echo ($phone == null) ? 0 : 1; ?>
</script>
<script src="js/map-API.js"></script>
<!-- <script src="javascript/googleMaps.js"></script> -->
<!-- <script src="js/allow_location.js"></script> -->
<script src="js/function.js"></script>
<script src="js/ajax_check_payment.js"></script>

<script>
    // window.addEventListener('load', function() {
    //     let scroll_cart = document.querySelector("div#c122");
    //     scroll_cart.scrollIntoView();
    // })
</script>