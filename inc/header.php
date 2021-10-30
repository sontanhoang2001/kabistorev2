<?php
// spl_autoload_register(function ($class) {
//     include_once "classes/" . $class . ".php";
// });
include_once 'lib/session.php';
Session::init();
include_once "lib/database.php";
include_once "helpers/format.php";
include_once 'helpers/helpers.php';
include_once "classes/cart.php";
include_once "classes/user.php";
include_once "classes/customer.php";
include_once "classes/category.php";
include_once "classes/product.php";
include_once "classes/brand.php";

$db = new Database();
$fm = new Format();
$ct = new cart();
$us = new user();
$cs = new customer();
$cat = new category();
$product = new product();
$bra = new brand();


if (isset($_SESSION['customer_login'])) {
    $login_check = Session::get('customer_login');
} else {
    if (isset($_COOKIE['is_login'])) {
        $cs->login_cookie();
    }
}


//Loout
if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    // $delCart = $ct->del_all_data_cart($customer_id);
    setcookie('is_login', '', time() - 3600, '/index.html');
    Session::destroy();
}

// header("Cache-Control: no-cache, must-revalidate");
// header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
// header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Vũng Liêm Now - Giao hàng siêu tốc</title>

    <!-- <base href="http://192.168.1.4/"> -->
    <base href="https://webcuatoi.vn/">
    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/icon-web.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link href="css/nice-toast/nice-toast-js.min.css" rel="stylesheet" type="text/css" />

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "0d28d541-beb1-40cc-8d00-785bb0e91d63",
            });
        });
    </script>


    <!-- Latest compiled and minified CSS & JS -->

    <!-- <link rel="stylesheet" type="text/css" href="css/loader.css" /> -->

    <!-- <link rel="stylesheet" href="jquery-lib/jquery-ui.css"/>     -->
    <!-- <link rel="stylesheet" type="text/css" href="css/theme-general.css"> -->

    <!-- <script type="text/javascript">
        $(document).ready(function($) {
            $('#dc_mega-menu-orange').dcMegaMenu({
                rowItems: '4',
                speed: 'fast',
                effect: 'fade'
            });
        });
    </script> -->
    <!-- <script src="js/security.js"></script> -->
    <link rel="stylesheet" href="css/message.css">
</head>

<body>
    <!-- <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div> -->
    <!--##### Header Area Start #####-->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="index.html"><img class="nav-brand-image1" src="img/core-img/logo.png" alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <!-- <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div> -->
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li>
                                <?php if (Session::get('customer_login') == true) { ?>
                                    <div class="row">
                                        <div class="col-12 mb-4" id="user-infor">
                                            <div class="mx-auto">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <span><a href="profile.html"><img style="width: 115px; height: 115px; " class="avatar img-thumbnail border-1 avatar-nav" src="<?php echo (session::get('account_type') == 0) ?  "upload/avatars/" . session::get('avatar')  : session::get('avatar') ?>" /></a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-2 mt-2" id="user-infor">
                                            <div class="text-center mt-5 mb-2">
                                                <h5 class="pb-1 mb-0 text-nowrap"><?php echo Session::get('customer_name') ?></h5>
                                                <div class="text-muted"><small>Số dư 360 xu</small></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-12 col-sm-auto mb-4" id="user-infor">
                                        <div class="mx-auto" style="width: 100px;">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <span><img class="avatar img-thumbnail border-1 avatar-nav" src="upload/default-user-image.jpg" /></span>
                                            </div>
                                        </div>
                                        <div class=" text-center mt-2 mb-0">
                                            <h6 class="pb-1 mb-0 text-nowrap"><a href="login.html">Đăng nhập</a><a href="register.html">Đăng ký</a></h6>
                                        </div>
                                    </div>
                                <?php } ?>
                            </li>

                            <li><a href="index.html"><i class="fa fa-home iconfa" aria-hidden="true"></i> Trang Chủ</a>
                            <li><a href="#"><i class="fa fa-shopping-cart iconfa" aria-hidden="true"></i> Shop</a>
                                <div class="megamenu">
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Sen Đá</li>
                                        <li><a href="shop.html">Dresses</a></li>
                                        <li><a href="shop.html">Blouses &amp; Shirts</a></li>
                                        <li><a href="shop.html">T-shirts</a></li>
                                        <li><a href="shop.html">Rompers</a></li>
                                        <li><a href="shop.html">Bras &amp; Panties</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Men's Collection</li>
                                        <li><a href="shop.html">T-Shirts</a></li>
                                        <li><a href="shop.html">Polo</a></li>
                                        <li><a href="shop.html">Shirts</a></li>
                                        <li><a href="shop.html">Jackets</a></li>
                                        <li><a href="shop.html">Trench</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Kid's Collection</li>
                                        <li><a href="shop.html">Dresses</a></li>
                                        <li><a href="shop.html">Shirts</a></li>
                                        <li><a href="shop.html">T-shirts</a></li>
                                        <li><a href="shop.html">Jackets</a></li>
                                        <li><a href="shop.html">Trench</a></li>
                                    </ul>
                                    <div class="single-mega cn-col-4">
                                        <img src="img/bg-img/bg-6.jpg" alt="">
                                    </div>
                                </div>
                            </li>
                            <li><a href="#"><i class="fa fa-bars iconfa" aria-hidden="true"></i> Menu</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">Trang Chủ</a></li>
                                    <li><a href="san-pham-f0p1t0smem.html">Tất Cả Sản Phẩm</a></li>
                                    <?php
                                    $customer_id = Session::get('customer_id');
                                    $login_check = Session::get('customer_login');
                                    if ($login_check) {
                                    ?>
                                        <li><a href="cart.html">Giỏ hàng</a></li>
                                        <li><a href="orderdetails.html">Đơn hàng</a></li>
                                        <li><a href="profile.html">Thông tin Cá nhân</a></li>
                                        <li><a href="wishlist.html">Yêu thích</a> </li>
                                        <li><a href="?customer_id=' . $customer_id . ' ">Đăng xuất</a></li>
                                    <?php
                                    } else {
                                        echo '<li><a href="login.html">Đăng nhập</a><li>';
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li><a href="blog.html"><i class="fa fa-rss iconfa" aria-hidden="true"></i> Blog</a></li>
                            <li><a href="contact.html"><i class="fa fa-phone-square iconfa" aria-hidden="true"></i> Liên Hệ</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <div class="search-area">
                    <form action="search.html" method="GET">
                        <input type="search" name="key" id="search-text" placeholder="Tìm kiếm sản phẩm">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true" name="search_product" value="Tìm Kiếm"></i></button>
                    </form>
                    <ul id="suggestion"></ul>
                </div>


                <!-- Favourite Area -->
                <div class="favourite-area">
                    <a href="wishlist.html">&nbsp<img src="img/core-img/heart.svg" alt=""></a>
                </div>

                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="cart.html" id="essenceCartBtn">&nbsp<img id="cart-img" src="img/core-img/cart.svg" alt="">
                        <span class="number_cart"><?php
                                                    if (isset($_SESSION['number_cart'])) {
                                                        echo session::get('number_cart');
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>&nbsp;</span>
                    </a>

                    <!-- <a href="#" id="essenceCartBtn" data-toggle="dropdown" role="button" aria-expanded="false">&nbsp<img src="img/core-img/bag.svg" alt=""></a>
                    <ul class="dropdown-menu dropdown-cart" role="menu">
                        <li>
                            <span class="item">
                                <span class="item-left">
                                    <img src="http://www.prepbootstrap.com/Content/images/template/menucartdropdown/item_4.jpg" alt="" />
                                    <span class="item-info">
                                        <span>Item name</span>
                                        <span>Giá: 7$</span>
                                    </span>
                                </span>
                                <span class="item-right">
                                    <button class="btn btn-danger  fa fa-close"></button>
                                </span>
                            </span>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <span>
                                <?php
                                // $check_cart = $ct->check_cart();
                                // if ($check_cart) {
                                //     $sum = Session::get("sum");
                                //     $qty = Session::get("qty");
                                //     echo $fm->format_currency($sum) . 'Đ' . ' ' . ' SL: ' . $qty;
                                // } else {
                                //     echo '0';
                                // }
                                ?>
                            </span>
                        </li>
                        <li><a class="text-center" href="#">Xem vỏ hàng</a></li>
                    </ul>
                    </a> -->
                </div>

                <!-- User Login Info -->
                <div class="user-login-info">
                    <a href="#" data-toggle="dropdown">&nbsp<img src="img/core-img/user.svg" alt=""></a>
                    <ul class="dropdown-menu dropdown-cart" role="menu">
                        <?php
                        $login_check = Session::get('customer_login');
                        $customer_name = Session::get('customer_username');
                        // if ($login_check == false) {
                        //     echo '<div> Đăng nhập</div>';
                        // } else {
                        //     echo '<div>' . $customer_name . '</div>';
                        // }
                        // 
                        ?>

                        <span class="arrow_carrot-down"></span>
                        <ul>
                            <?php
                            $login_check = Session::get('customer_login');
                            if ($login_check == false) {
                                echo '<a class="user-login-option" href="login.html"><i class="fa fa-user"></i> Đăng nhập</a>';
                            } else {
                            ?>
                                <li><a class="user-login-option" href="orderdetails.html"><i class="fa fa-clock-o" aria-hidden="true"></i> Đơn hàng</a></li>
                                <li><a class="user-login-option" href="wishlist.html"><i class="fa fa-heart" aria-hidden="true"></i> Yêu thích</a></li>
                                <li><a class="user-login-option" href="profile.html"><i class="fa fa-info-circle"></i> Cá nhân</a></li>
                                <li><a class="user-login-option" href="?customer_id=' . Session::get('customer_id') . ' "><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                            <?php
                            }
                            ?>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->
    <!-- <script>
        window.addEventListener("load", function() {
                const loader = document.querySelector(".loader-wrapper") // loader.className += "hidden";
                document.getElementsByClassName('loader-wrapper')[0].style.visibility = 'hidden';
            }

        );
    </script> -->

    <!-- <script>
        window.addEventListener("load", function() {
            const loader = document.querySelector(".loader-wrapper")
            loader.className += "hidden";
        });
    </script> -->