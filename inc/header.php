<?php

include 'lib/session.php';
Session::init();
include 'lib/database.php';
include 'helpers/format.php';
include 'helpers/helpers.php';


// spl_autoload_register(function ($class) {
//     include_once "classes/" . $class . ".php";
// });

include_once "lib/Database.php";
include_once "helpers/Format.php";
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


//Loout
if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    // $delCart = $ct->del_all_data_cart($customer_id);
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

    <!-- <base href="http://192.168.1.7/kabistore/"> -->
    <base href="https://webcuatoi.vn/">
    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/icon-web.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">

    <!-- Latest compiled and minified CSS & JS -->

    <!-- <link rel="stylesheet" type="text/css" href="css/loader.css" /> -->

    <!-- <link rel="stylesheet" href="jquery-lib/jquery-ui.css"/>     -->
    <!-- <link rel="stylesheet" type="text/css" href="css/theme-general.css"> -->

    <!-- <script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  }); -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/security.js"></script> -->
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
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="index.html">Trang Chủ</a>
                            <li><a href="#">Shop</a>
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
                            <li><a href="#">Menu</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">Trang Chủ</a></li>
                                    <li><a href="products.html">Tất Cả Sản Phẩm</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="single-blog.html">Single Blog</a></li>
                                    <li><a href="regular-page.html">Regular Page</a></li>
                                    <li><a href="contact.html">Liên Hệ</a></li>

                                    <?php
                                    // $check_cart = $ct->check_cart();
                                    // if ($check_cart == true) {
                                    //     echo '<li><a href="cart.php">Giỏ hàng</a></li>';
                                    // } else {
                                    //     echo '';
                                    // }
                                    ?>

                                    <?php
                                    $customer_id = Session::get('customer_id');
                                    $check_order = $ct->check_order($customer_id);
                                    if ($check_order == true) {
                                        echo '<li><a href="orderdetails.php">Đơn hàng</a></li>';
                                    } else {
                                        echo '';
                                    }
                                    ?>

                                    <?php
                                    // $login_check = Session::get('customer_login');
                                    // if ($login_check == false) {
                                    //     echo '';
                                    // } else {
                                    //     echo '<li><a href="profile.php">Thông tin</a></li>';
                                    // }
                                    // 
                                    ?>
                                    // <?php
                                        // $login_check = Session::get('customer_login');
                                        // if ($login_check) {
                                        //     echo '<li><a href="compare.php">So sánh</a> </li>';
                                        // }
                                        // 
                                        ?>
                                    // <?php
                                        // $login_check = Session::get('customer_login');
                                        // if ($login_check) {
                                        //     echo '<li><a href="wishlist.php">Yêu thích</a> </li>';
                                        // }
                                        ?>

                                    <div class="shopping_cart">
                                        <div class="cart">
                                            <a href="cart.html" title="View my shopping cart" rel="nofollow">
                                                <span class="cart_title">Giỏ hàng</span>
                                                <span class="no_product">

                                                    <?php
                                                    // $check_cart = $ct->check_cart();
                                                    // if ($check_cart) {
                                                    //     $sum = Session::get("sum");
                                                    //     $qty = Session::get("qty");
                                                    //     echo $fm->format_currency($sum) . 'Đ' . ' ' . ' SL: ' . $qty;
                                                    // } else {
                                                    //     echo '(trống)';
                                                    // }

                                                    // 
                                                    ?>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    // if (isset($_GET['customer_id'])) {
                                    //     $customer_id = $_GET['customer_id'];
                                    //     $delCart = $ct->del_all_data_cart();
                                    //     $delCompare = $ct->del_compare($customer_id);
                                    //     Session::destroy();
                                    // }
                                    // 
                                    ?>
                                    <div class="login">
                                        <?php
                                        //     $login_check = Session::get('customer_login');
                                        //     if ($login_check == false) {
                                        //         echo '<a href="login.html">Đăng nhập</a></div>';
                                        //     } else {
                                        //         echo '<a href="?customer_id=' . Session::get('customer_id') . ' ">Đăng xuất</a></div>';
                                        //     }
                                        ?>
                                </ul>
                            </li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="contact.html">Liên Hệ</a></li>

                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <div class="search-area">
                    <form action="search.html" method="POST">
                        <input type="search" name="search-text" id="search-text" placeholder="Tìm kiếm sản phẩm">
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
                        s

                        <span class="arrow_carrot-down"></span>
                        <ul>
                            <li>
                                <?php
                                $login_check = Session::get('customer_login');
                                if ($login_check == false) {
                                    echo '<a class="user-login-option" href="login.html"><i class="fa fa-user"></i> Đăng nhập</a>';
                                } else {
                                    echo '
                                            <a class="user-login-option" href="profile.html"><i class="fa fa-info-circle"></i> Cá nhân</a>
                                            <a class="user-login-option" href="?customer_id=' . Session::get('customer_id') . ' "><i class="fa fa-sign-out"></i> Đăng xuất</a></div>';
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