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

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
    
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link href="css/nice-toast/nice-toast-js.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="css/message.css">


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">


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

                                    <!-- <div class="shopping_cart">
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
                                    </div> -->
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

    <body ng-app="myApp">
        <div ng-view></div>

        <p><a href="test.html#/!">Main</a></p>

        <a href="test.html#!red">Red</a>
        <a href="#!green">Green</a>
        <a href="#!blue">Blue</a>

        <script>
            var app = angular.module("myApp", ["ngRoute"]);
            app.config(function($routeProvider) {
                $routeProvider
                    .when("/", {
                        templateUrl: "home.php"
                    })
                    .when("/red", {
                        templateUrl: "red.php"
                    })
                    .when("/green", {
                        templateUrl: "green.htm"
                    })
                    .when("/blue", {
                        templateUrl: "blue.htm"
                    });
            });
        </script>


        </div> -->
        <style>
            .new_footer_area {
                background: #fbfbfd;
            }


            .new_footer_top {
                padding: 120px 0px 270px;
                position: relative;
                overflow-x: hidden;
            }

            .new_footer_area .footer_bottom {
                padding-top: 5px;
                padding-bottom: 50px;
            }

            .footer_bottom {
                font-size: 14px;
                font-weight: 300;
                line-height: 20px;
                color: #7f88a6;
                padding: 27px 0px;
            }

            .new_footer_top .company_widget p {
                font-size: 16px;
                font-weight: 300;
                line-height: 28px;
                color: #6a7695;
                margin-bottom: 20px;
            }

            .new_footer_top .company_widget .f_subscribe_two .btn_get {
                border-width: 1px;
                margin-top: 20px;
            }

            .btn_get_two:hover {
                background: transparent;
                color: #5e2ced;
            }

            .btn_get:hover {
                color: #fff;
                background: #6754e2;
                border-color: #6754e2;
                -webkit-box-shadow: none;
                box-shadow: none;
            }

            /* a:hover,
    a:focus,
    .btn:hover,
    .btn:focus,
    button:hover,
    button:focus {
        text-decoration: none;
        outline: none;
    } */



            .new_footer_top .f_widget.about-widget .f_list li a:hover {
                color: #5e2ced;
            }

            .new_footer_top .f_widget.about-widget .f_list li {
                margin-bottom: 11px;
            }

            .f_widget.about-widget .f_list li:last-child {
                margin-bottom: 0px;
            }

            .f_widget.about-widget .f_list li {
                margin-bottom: 15px;
            }

            .f_widget.about-widget .f_list {
                margin-bottom: 0px;
            }

            .new_footer_top .f_social_icon a {
                width: 44px;
                height: 44px;
                line-height: 43px;
                background: transparent;
                border: 1px solid #e2e2eb;
                font-size: 24px;
            }

            .f_social_icon a {
                width: 46px;
                height: 46px;
                border-radius: 50%;
                font-size: 14px;
                line-height: 45px;
                color: #858da8;
                display: inline-block;
                background: #ebeef5;
                text-align: center;
                -webkit-transition: all 0.2s linear;
                -o-transition: all 0.2s linear;
                transition: all 0.2s linear;
            }

            .ti-facebook:before {
                content: "\e741";
            }

            .ti-twitter-alt:before {
                content: "\e74b";
            }

            .ti-vimeo-alt:before {
                content: "\e74a";
            }

            .ti-pinterest:before {
                content: "\e731";
            }

            .btn_get_two {
                -webkit-box-shadow: none;
                box-shadow: none;
                background: #5e2ced;
                border-color: #5e2ced;
                color: #fff;
            }

            .btn_get_two:hover {
                background: transparent;
                color: #5e2ced;
            }

            .new_footer_top .f_social_icon a:hover {
                background: #5e2ced;
                border-color: #5e2ced;
                color: white;
            }

            .new_footer_top .f_social_icon a+a {
                margin-left: 4px;
            }

            .new_footer_top .f-title {
                margin-bottom: 30px;
                color: #263b5e;
            }

            .f_600 {
                font-weight: 600;
            }

            .f_size_18 {
                font-size: 18px;
            }

            /* h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: #4b505e;
    } */

            .new_footer_top .f_widget.about-widget .f_list li a {
                color: #6a7695;
            }


            .new_footer_top .footer_bg {
                position: absolute;
                bottom: 0;
                background: url("http://droitthemes.com/html/saasland/img/seo/footer_bg.png") no-repeat scroll center 0;
                width: 100%;
                height: 266px;
            }

            .new_footer_top .footer_bg .footer_bg_one {
                background: url("https://1.bp.blogspot.com/-mvKUJFGEc-k/XclCOUSvCnI/AAAAAAAAUAE/jnBSf6Fe5_8tjjlKrunLBXwceSNvPcp3wCLcBGAsYHQ/s1600/volks.gif") no-repeat center center;
                width: 330px;
                height: 105px;
                background-size: 100%;
                position: absolute;
                bottom: 0;
                left: 30%;
                -webkit-animation: myfirst 22s linear infinite;
                animation: myfirst 22s linear infinite;
            }

            .new_footer_top .footer_bg .footer_bg_two {
                background: url("https://1.bp.blogspot.com/-hjgfxUW1o1g/Xck--XOdlxI/AAAAAAAAT_4/JWYFJl83usgRFMvRfoKkSDGd--_Sv04UQCLcBGAsYHQ/s1600/cyclist.gif") no-repeat center center;
                width: 88px;
                height: 100px;
                background-size: 100%;
                bottom: 0;
                left: 38%;
                position: absolute;
                -webkit-animation: myfirst 30s linear infinite;
                animation: myfirst 30s linear infinite;
            }



            @-moz-keyframes myfirst {
                0% {
                    left: -25%;
                }

                100% {
                    left: 100%;
                }
            }

            @-webkit-keyframes myfirst {
                0% {
                    left: -25%;
                }

                100% {
                    left: 100%;
                }
            }

            @keyframes myfirst {
                0% {
                    left: -25%;
                }

                100% {
                    left: 100%;
                }
            }

            /*************footer End*****************/
        </style>
        <div class="fixed" id="message"></div>
        <!-- ##### Footer Area Start ##### -->



        <footer class="new_footer_area bg_color">
            <div class="new_footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget company_widget wow fadeInLeft" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Get in Touch</h3>
                                <p>Don’t miss any updates of our new templates and extensions.!</p>
                                <form action="#" class="f_subscribe_two mailchimp" method="post" novalidate="true" _lpchecked="1">
                                    <input type="text" name="EMAIL" class="form-control memail" placeholder="Email">
                                    <button class="btn btn_get btn_get_two" type="submit">Subscribe</button>
                                    <p class="mchimp-errmessage" style="display: none;"></p>
                                    <p class="mchimp-sucmessage" style="display: none;"></p>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Download</h3>
                                <ul class="list-unstyled f_list">
                                    <li><a href="#">Company</a></li>
                                    <li><a href="#">Android App</a></li>
                                    <li><a href="#">ios App</a></li>
                                    <li><a href="#">Desktop</a></li>
                                    <li><a href="#">Projects</a></li>
                                    <li><a href="#">My tasks</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Help</h3>
                                <ul class="list-unstyled f_list">
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Term &amp; conditions</a></li>
                                    <li><a href="#">Reporting</a></li>
                                    <li><a href="#">Documentation</a></li>
                                    <li><a href="#">Support Policy</a></li>
                                    <li><a href="#">Privacy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget social-widget pl_70 wow fadeInLeft" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Team Solutions</h3>
                                <div class="f_social_icon">
                                    <a href="#" class="fab fa-facebook"></a>
                                    <a href="#" class="fab fa-twitter"></a>
                                    <a href="#" class="fab fa-linkedin"></a>
                                    <a href="#" class="fab fa-pinterest"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer_bg">
                    <div class="footer_bg_one"></div>
                    <div class="footer_bg_two"></div>
                </div>
            </div>
            <div class="footer_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-sm-7">
                            <p class="mb-0 f_400">© cakecounter Inc.. 2019 All rights reserved.</p>
                        </div>
                        <div class="col-lg-6 col-sm-5 text-right">
                            <p>Made with <i class="icon_heart"></i> in <a href="#">CakeCounter</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ##### Footer Area End ##### -->



        <!-- jQuery (Necessary for All JavaScript Plugins) -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>

        <!-- <script src="js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script> -->

        <!-- Popper js -->
        <script src="js/popper.min.js"></script>
        <!-- Bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Plugins js -->
        <script src="js/plugins.js"></script>
        <!-- Classy Nav js -->
        <script src="js/classy-nav.min.js"></script>
        <!-- Active js -->
        <script src="js/active.js"></script>
        <script src="js/audio-message.js"></script>

        <!-- cdnjs -->
        <script type="text/javascript" src="js/lazy/jquery.lazy.min.js"></script>
        <script type="text/javascript" src="js/lazy/jquery.lazy.plugins.min.js"></script>
        <script>
            $(function() {
                $('.lazy').Lazy({
                    // your configuration goes here
                    scrollDirection: 'vertical',
                    effect: 'fadeIn',
                    effectTime: 1000,
                    threshold: 0,
                    visibleOnly: true,
                    onError: function(element) {
                        console.log('error loading ' + element.data('src'));
                    }
                });
            });
        </script>

        <!-- Include Plugin JS file -->
        <script src="js/nice-toast/nice-toast-js.min.js" type="text/javascript"></script>

        <!-- niceToast -->
        <script type="text/javascript">
            $(document).ready(function() {
                $.niceToast.setup({
                    position: "bottom-right",
                    timeout: 5000,
                });
            });
        </script>

        <script src="js/live-search.js"></script>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="js/flyto.js"></script>
        <script>
            // var productId;
            // var localbutton;
            <?php $number_cart = session::get('number_cart'); ?>
            var limitCart = <?php echo (!$number_cart) ? 0 : session::get('number_cart') ?>;
            $('#wrapper_product').flyto({
                target: '#cart-img',
                button: '.add_to_cart'
            });

            $('#wrapper_productRank').flyto({
                target: '#cart-img',
                button: '.add_to_cart'
            });
        </script>


        <script src="js/ajax_wishlist-and-cart.js"></script>
        <script src="js/function.js"></script>
    </body>

</html>