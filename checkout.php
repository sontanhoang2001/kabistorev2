<?php
include 'config/global.php';
include 'inc/header.php';

$disable_check_out = Session::get('disable_check_out');
if (isset($_POST['cartcheckout']) && ($disable_check_out == 0)) {
    if (Session::get('payment') == false) {
        header('Location:404.html');
    }
} else {
    header('Location:404.html');
}
?>
<link rel="stylesheet" type="text/css" href="css/map.css">

<div class="container pt-4 mb-5">
    <h1 class="projTitle">Thanh Toán an toàn<span>-và</span> đơn giản</h1>
    <div class="card-body p-0">
        <div class="row upper">

            <span class="text-success" id="payment"><span style="border: 1px solid #28a745;" id="number-circle">✔</span> Giỏ hàng</span>
            <span id="payment"><span id="number-circle">2</span> Thanh toán</span>
            <span id="payment"><span id="number-circle">3</span> Hoàn tất</span>
        </div>
        <form id="f_order" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-7 col-responsive">
                    <div class="left-panel border bg-light shadow">
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
                                $email = $result['email'];
                                if ($email != null) {
                                    $email = $result['email'];
                                } else {
                                    $email = "Chưa nhập email";
                                }

                                $phone = $result['phone'];
                                $Phone =  $phone;
                                if ($phone != null) {
                                    $phone = "0" . $result['phone'];
                                } else {
                                    $phone = "Chưa nhập số điện thoại";
                                }
                        ?>
                                <div class="col-md-12 pt-4">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-2">
                                            <div class="mx-auto" style="width: 140px;">
                                                <div class="d-flex justify-content-center align-items-center rounded" style="background-color: rgb(233, 236, 239);">
                                                    <span><img style="width: 140px; height: 140px;" class="avatar img-thumbnail border-1" src="<?php echo $avatar ?>" /></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mt-2">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                <h5 class="text-nowrap text-primary"><?php echo $result['name']; ?></h5>
                                                <p class="mb-0"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo $email; ?></p>
                                                <p class="mb-0"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $phone; ?></p>
                                                <label class="pt-1">
                                                    <a href="profile.html" class="btn btn-primary"><i class="fa fa-edit"></i> Chỉnh sửa</a></input>
                                                </label>
                                                <div class="mt-2">
                                                    <input type="text" name="avatarold" value="<?php echo $result['avatar']; ?>" hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-group" id="location-group">
                                        <div class="row-flex">
                                            <label for="maps_address"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <b>Ghim vị và xác nhận trí giao hàng</b></label>
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
                                    <label for="address"><i class="fa fa-pencil" aria-hidden="true"></i> <b>Ghi chú địa chỉ cụ thể (nếu cần):</b></label>
                                    <textarea type="text" class="form-control" id="note" name="note"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label for="geocoder" class="lGeocoder"><i class="fa fa-map-marker" aria-hidden="true"></i> <b>Vị trí hiện tại của bạn:</b></label>
                                    <div id="geo-text" class="text-danger"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Hãy nhấn chọn vị trí trên bản đồ nơi mà bạn muốn giao hàng...</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <button type="button" name="localtion" id="saveLocaltion" onclick="getLocation();" class="btn btn-danger btn-lock"><i class="fa fa-map-marker" aria-hidden="true"></i> Vị trí hiện tại</button>
                                    <button type="button" onclick="add_markers_to_geolocate_save_control(<?php echo $lng ?>, <?php echo $lat ?>);" class="btn btn-dark btn-lock"><i class="fa fa-bookmark-o" aria-hidden="true"></i> Vị trí đã lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php unset($_SESSION['cart_payment']);
                $subtotal = 0;
                $ship = 0;
                $quantityTotal = 0;

                // $get_price_ship = $ct->get_price_ship();
                // while ($result_price = $get_price_ship->fetch_assoc()) {
                //     $price_ship = $result_price['price'];
                // }
                $price_ship = 0;
                $customer_id = Session::get('customer_id');
                $get_product_cart = $ct->get_product_cart($customer_id);
                $num_rows = mysqli_num_rows($get_product_cart);
                // session::set("numberOfOrders", $num_rows);
                ?>
                <div class="col-md-5 col-responsive">
                    <div class="right-panel border bg-light shadow">
                        <div class="header">Thông tin đơn hàng</div>
                        <div class="row lower pull-right">
                            <div class="col text-left"><a href="cart.html"><u><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa sản phẩm</u></a></div>
                        </div>
                        <p><?php echo $num_rows ?> sản phẩm</p>
                        <?php
                        if ($get_product_cart) {
                            while ($result = $get_product_cart->fetch_assoc()) {
                                $cartId = $result['cartId'];
                                $brandId = $result['brandId'];
                                $productName = $result['productName'];
                                $price = $result['price'];
                                $quantity = $result['quantity'];
                                $productSize = $result['productSize'];
                                $product_img =  json_decode($result['image']);
                                $product_img = $product_img[0]->image;
                        ?>
                                <div class="row item mb-3" id="<?php echo "c" . $cartId ?>">
                                    <div class="col-4 align-self-center0">
                                        <img class="lazy img-fluid" id="itemImg" data-src="<?php echo $product_img; ?>">
                                    </div>
                                    <div class="col-8 mt-1">
                                        <div class="row itemCode">#QUE-007544-002</div>
                                        <div class="row productName-item"><?php echo $result['productName'] ?></div>
                                        <?php if ($productSize != 0) { ?>
                                            <div class="row">
                                                Size:
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
                                                    default:
                                                } ?>
                                            </div>
                                        <?php } ?>
                                        <div class="row">
                                            <div class="font-weight-normal">
                                                Giá: <span class=""><?php echo $fm->format_currency($price) . ' ₫' ?>
                                                    &emsp;x&emsp;<?php echo $quantity ?>
                                                </span>
                                            </div>
                                            <div class="col-12 text-right totalPrice-item font-weight-bold">
                                                <?php
                                                $total = $result['price'] * $quantity;
                                                echo $fm->format_currency($total) . ' ₫';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                $quantityTotal =  (int)$quantityTotal + (int)$quantity;
                                //set sesstion to cart
                                $cart = array();
                                $cart = ['cartId' => $cartId, 'productId' => $result['productId'], 'productName' => $productName, 'totalPrice' => $total, 'quantity' => $quantity, 'productSize' => $productSize];
                                $_SESSION['cart_payment'][] = $cart;
                                // $ship = $ship + $quantity * $price_ship;
                                $subtotal += $total;
                                $brandLocaltion[] = $brandId;
                            }
                        }
                        $brandLocaltion = array_unique($brandLocaltion);
                        $brandLocaltion_array = array();
                        Session::set('quantityTotal', $quantityTotal);
                        // $ship =  (int)$price_ship + (int)$shipAdd * ((int)$quantityTotal - 1);
                        $discount = 0;
                        ?>
                        <hr>
                        <div class="form-group">
                            <label class="mb-4" for="label-payment" id="label_payment"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <b>Phương thức thanh toán</b></label>
                            <div class="col-md-12">
                                <label>
                                    <input type="radio" name="payment_methods" class="card-input-element" value="1" checked="checked" />
                                    <div class="panel panel-default card-input" id="payment_methods">
                                        <img src="img/core-img/income.svg" alt="">
                                    </div>
                                </label>
                                <label>
                                    <input type="radio" name="payment_methods" value="2" class="card-input-element" />
                                    <div class="panel panel-default card-input" id="payment_methods">
                                        <img src="img/core-img/Vi-MoMo-new.jpg" alt="">
                                    </div>
                                </label>
                                <label>
                                    <input type="radio" name="payment_methods" value="3" class="card-input-element" />
                                    <div class="panel panel-default card-input" id="payment_methods">
                                        <img src="img/core-img/visa.svg" alt="">
                                    </div>
                                </label>
                            </div>
                            <div class="clearfix"></div>
                            <p class="text-payment-methods">Thanh toán khi nhận hàng</p>
                        </div>
                        <hr>
                        <div class="form-group">
                            <?php
                            $discount = session::get('discountMoney');
                            ?>
                            <div class="row lower">
                                <strong class="col text-muted text-left">Tạm tính</strong>
                                <div class="col text-right">
                                    <?php echo $fm->format_currency($subtotal) . " ₫";
                                    Session::set('sum', $subtotal);
                                    // Session::set('ship', $ship);
                                    ?>
                                </div>
                            </div>
                            <div class="row lower">
                                <strong class="col text-muted text-left">Phí giao hàng</strong>
                                <div id="price-ship" class="col text-right"><?php echo "+ " . $fm->format_currency($ship) . " ₫"; ?></div>
                            </div>
                            <?php if ($discount != 0) {
                            ?>
                                <div class="row lower">
                                    <strong class="col text-muted  text-left">Giảm giá</strong>
                                    <div class="col text-right"><b><?php echo "- " . $fm->format_currency($discount) . " ₫"; ?></b></div>
                                </div>
                            <?php
                            } ?>
                            <div class="row lower">
                                <strong class="col text-left" style="font-size: 18px;">Tổng cộng</strong>
                                <div id="grandTotal" class="col text-right"><b>
                                        <?php
                                        $grandTotal = $subtotal;
                                        echo $fm->format_currency($grandTotal - $discount) . " ₫";
                                        Session::set('grandTotal', $grandTotal - $discount);
                                        ?></b>
                                </div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left"><a href="cart.html"><u><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa mã giảm giá</u></a></div>
                            </div>

                            <div id="alert-selectLocaltion" class="mt-3 text-danger">
                                Hãy chọn vị trí giao hàng để mở khóa nút đặt hàng
                            </div>

                            <div class="row mt-4 mb-2">
                                <button id="orders" class="btn btn-success rounded-pill py-2 btn-block" type="submit" name="orders" disabled><i id="ordersIcon" class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;Đặt hàng</button>
                                <div class="from-group error-group mt-4">
                                    <div class="alert alert-danger" id="error-geocoder">
                                        <strong>Cảnh báo!</strong> Vui lòng nhấn vào nút xác nhận vị trí, để tiếp tục đặt hàng. <a href="checkout.html#location-group" class="alert-link">Sửa lỗi</a>.
                                    </div>
                                    <div class="alert alert-danger" id="error-payment-methods1">
                                        <strong>Cảnh báo!</strong> Thanh toán Momo đang được nâng cấp. Vui lòng chọn phương thức thanh toán khác.
                                    </div>
                                    <div class="alert alert-danger" id="error-payment-methods2">
                                        <strong>Cảnh báo!</strong> Thanh toán Visa đang được nâng cấp. Vui lòng chọn phương thức thanh toán khác.
                                    </div>
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
<!-- Modal -->
<div class="modal fade" id="gpsModal" tabindex="-1" role="dialog" aria-labelledby="gpsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hướng dẫn bật định vị GPS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="img/core-img/helpGps.gif">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đã hiểu</button>
                <a href="#location-group" id="btnOpenHelp" onclick="getLocation();" class="btn btn-danger btn-lock" data-dismiss="modal"><i class="fa fa-map-marker" aria-hidden="true"></i> Tìm vị trí hiện tại</a>
            </div>
        </div>
    </div>
</div>
<a id="openHelp" data-toggle="modal" data-target="#gpsModal"><i class="fa fa-question-circle" aria-hidden="true" style="margin-top: 10px;"></i></a>

<script src="js/audio-message.js"></script>

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

    var phone = <?php echo ($Phone == null) ? 0 : 1; ?>;

    //quantityTotal
    var quantityTotal = <?php echo $quantityTotal ?>;
    var brandLocaltion = <?php echo json_encode($brandLocaltion) ?>;
</script>

<script src="js/map-API.js"></script>
<!-- <script src="javascript/googleMaps.js"></script> -->
<!-- <script src="js/allow_location.js"></script> -->
<script src="js/function.js"></script>
<script>
    scrolling();
</script>
<script src="js/ajax_check_payment.js"></script>