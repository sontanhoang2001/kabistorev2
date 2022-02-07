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
include_once "inc/checkManager.php";
?>

<!DOCTYPE html>
<html lang="vn">

<head>
    <!-- <base href="http://192.168.1.100/"> -->
    <!-- <base href="https://kabistore.com.vn/"> -->
    <base href="https://webcuatoi.vn/">

    <!-- Title  -->
    <meta charset="UTF-8">

    <?php $GET_URI = substr($_SERVER['REQUEST_URI'], 1, 7);
    if ($GET_URI != "details") {
    ?>
        <title>Kabi Store - Shop quần áo thời trang nam nữ - Phụ kiện hot trend Cần Thơ - Vĩnh Long - Vũng Liêm</title>
        <meta name="keywords" content="kabistore.com.vn , kabistore, kabistore gia sieu re, kabistore giá siêu rẻ, kabistore mua hang chat luong, kabistore mua hàng chất lượng, kabistore tong hop, kabistore tổng hợp, kabistore thoi trang, kabistore thời trang, kabistore quan ao, kabistore quần áo, kabistore quần áo giá siêu rẻ, kabistore quan ao gia sieu re, kabistore phu kien, kabistore phụ kiện, kabistore can tho, kabistore Cần Thơ, kabistore vinh long, kabistore Vĩnh Long, kabistore si do gia dung vinh long, kabistore sỉ đồ gia dụng vĩnh long,  kabistore si do gia dung can tho, kabistore sỉ quần áo rẻ nhất cần thơ vĩnh long, kabistore si quan ao re nhat can tho vinh long, kabistore sỉ đồ gia dụng cần thơ, kabistore bán đồ gia dụng rẻ nhất cần thơ, kabistore ban do gia dung re nhat can tho, kabistore bán đồ gia dụng rẻ nhất vĩnh long, kabistore ban do gia dung re nhat vinh long, tan hoang kabistore, Tấn Hoàng kabistore, áo thun cotton tay lỡ fom rộng giá rẻ nhất, oa thun cotton tay lo fom rong gia re nhat, shop quần áo giá rẻ vũng liêm, áo thun vũng liêm, ao thun vung liem, shop quan ao gia re vung liem, kabistore chuyên áo thun cần thơ vĩnh long vũng liêm, kabistore chuyen ao thun can tho vinh long vung liem" />
        <meta name="description" content="⭐⭐⭐⭐⭐ Đánh giá: CHẤT LƯỢNG VIỆT ✅ 🛒 - Kabi Store trang mua sắm trực tuyến với giao diện mua hàng đẹp nhất hiện nay, thân thiện với khách hàng tiện lợi mua sắm, phục vụ chăm sóc khác hàng tốt nhẩt là xứ mệnh hàng đầu của kabistore." />

        <meta property="og:title" content="⭐⭐⭐⭐ Đánh giá: CHẤT LƯỢNG VIỆT ✅ 🛒 Kabi Store - Shop quần áo thời trang nam nữ - Phụ kiện hot trend Cần Thơ - Vĩnh Long - Vũng Liêm" />
        <meta property="keywords" content="Kabistore.com.vn , kabistore, kabistore gia sieu re, kabistore giá siêu rẻ, kabistore mua hang chat luong, kabistore mua hàng chất lượng, kabistore tong hop, kabistore tổng hợp, kabistore thoi trang, kabistore thời trang, kabistore quan ao, kabistore quần áo, kabistore quần áo giá siêu rẻ, kabistore quan ao gia sieu re, kabistore phu kien, kabistore phụ kiện, kabistore can tho, kabistore Cần Thơ, kabistore vinh long, kabistore Vĩnh Long, kabistore si do gia dung vinh long, kabistore sỉ đồ gia dụng vĩnh long,  kabistore si do gia dung can tho, kabistore sỉ quần áo rẻ nhất cần thơ vĩnh long, kabistore si quan ao re nhat can tho vinh long, kabistore sỉ đồ gia dụng cần thơ, kabistore bán đồ gia dụng rẻ nhất cần thơ, kabistore ban do gia dung re nhat can tho, kabistore bán đồ gia dụng rẻ nhất vĩnh long, kabistore ban do gia dung re nhat vinh long, tan hoang kabistore, Tấn Hoàng kabistore, áo thun cotton tay lỡ fom rộng giá rẻ nhất, oa thun cotton tay lo fom rong gia re nhat, shop quần áo giá rẻ vũng liêm, áo thun vũng liêm, ao thun vung liem, shop quan ao gia re vung liem, kabistore chuyên áo thun cần thơ vĩnh long vũng liêm, kabistore chuyen ao thun can tho vinh long vung liem">
        <meta property="og:description" content="Kabi Store trang mua sắm trực tuyến với giao diện mua hàng đẹp nhất hiện nay, thân thiện với khách hàng tiện lợi mua sắm, phục vụ chăm sóc khác hàng tốt nhẩt là xứ mệnh hàng đầu của kabistore." />
        <meta property="og:url" content="kabistore.com.vn">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="600">
        <meta property="og:image:height" content="600">
        <meta property="og:image" content="https://www.kabistore.com.vn/img/thumbnail/img-thumbnail.jpg">
        <meta property="og:image:alt" content="Kabi Store - Shop quần áo thời trang nam nữ - Phụ kiện hot trend Cần Thơ - Vĩnh Long - Vũng Liêm">
        <meta property="og:image:secure_url" content="https://www.kabistore.com.vn/img/thumbnail/img-thumbnail.jpg" />
        <?php } else {
        if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
            echo "<script>
                window.location = '404.php'
            </script>";
        } else {
            $productid = $_GET['proid']; // Lấy productid trên host
        }

        $seoUrl = "https://kabistore.com.vn/" . getRequestUrls();
        // Seo link
        $get_product_details = $product->get_details($productid);
        if ($get_product_details) {
            $result_details = $get_product_details->fetch_assoc();
            $old_price = $result_details['old_price'];
            $productName = $result_details['productName'];
            $productType = $result_details['type'];
            $product_imgJson =  json_decode($result_details['image']);
            $product_img = $product_imgJson[0]->image;
        ?>
            <title><?php echo $productName ?></title>

            <meta property="og:title" content="<?php echo $productName ?>" />
            <meta property="og:description" content="⭐⭐⭐⭐⭐ Đánh giá: CHẤT LƯỢNG VIỆT ✅ 🛒 - Nhấn vào để mua sản phẩm này ngay bây giờ ..." />
            <meta property="og:url" content="<?php echo $seoUrl ?>">
            <meta property="og:image:type" content="image/jpeg">
            <meta property="og:image:width" content="600">
            <meta property="og:image:height" content="600">
            <meta property="og:image" content="<?php echo $product_img ?>">
            <meta property="og:image:alt" content="<?php echo $productName ?>">
            <meta property="og:image:secure_url" content="<?php echo $product_img ?>" />
    <?php
        }
    }
    ?>

    <meta content="INDEX,FOLLOW" name="robots" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="copyright" content="Trang mua sắm trực tuyến Kabistore.com.vn" />
    <meta name="author" content="Trang mua sắm trực tuyến Kabistore.com.vn" />
    <meta http-equiv="audience" content="General" />
    <meta name="resource-type" content="Document" />
    <meta name="distribution" content="Global" />
    <meta name="revisit-after" content="1 days" />
    <meta name="GENERATOR" content="Trang mua sắm trực tuyến Kabistore.com.vn" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link href="img/core-img/icon-web.ico" rel="shortcut icon" type="image/x-icon" />
    <link href="img/core-img/icon-web.ico" rel="apple-touch-icon" />
    <link href="img/core-img/icon-web.ico" rel="apple-touch-icon-precomposed" />
    <meta property="og:site_name" content="Kabistore.com.vn" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="fb:pages" content="105932671830866" />
    <meta property="fb:app_id" content="1661876167354932">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <meta name="google-site-verification" content="ngOfSvh8AOWkNpFQ-rHOwpugk4-wOl9xFFH-KlASdRU" />
    <meta name="facebook-domain-verification" content="ycjxgr2xgj6t34d9ot90h6u9kyymxr" />
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7018934731832878" crossorigin="anonymous"></script>

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link href="css/nice-toast/nice-toast-js.min.css" rel="stylesheet" type="text/css" />

    <!-- Latest compiled and minified CSS & JS -->

    <!-- <link rel="stylesheet" type="text/css" href="css/loader.css" /> -->

    <!-- <link rel="stylesheet" href="jquery-lib/jquery-ui.css"/>     -->

    <!-- <script type="text/javascript">
        $(document).ready(function($) {
            $('#dc_mega-menu-orange').dcMegaMenu({
                rowItems: '4',
                speed: 'fast',
                effect: 'fade'
            });
        });
    </script> -->
    <!-- <script src="js/jquery/jquery-3.6.0.min.js"></script>
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
                    <!-- <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div> -->
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li>
                                <?php
                                $avatar = session::get('avatar');
                                if ($avatar == null) {
                                    $avatar =  "upload/default-user-image.jpg";
                                }
                                if (Session::get('customer_login') == true) { ?>
                                    <div class="row">
                                        <div class="col-12 mb-4" id="user-infor">
                                            <div class="mx-auto">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <span><a href="profile.html"><img style="width: 115px; height: 115px; " class="avatar img-thumbnail border-1 avatar-nav" src="<?php echo $avatar; ?>" /></a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-2 mt-2" id="user-infor">
                                            <div class="text-center mt-5 mb-2">
                                                <h5 class="pb-1 mb-0 text-nowrap"><?php echo (Session::get('customer_name') == null) ? 'Chưa đặt tên' : Session::get('customer_name') ?></h5>
                                                <div class="text-muted"><small>Số dư 360 xu</small></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-12 col-sm-auto mb-4" id="user-infor">
                                        <div class="mx-auto" style="width: 100px;">

                                            <div class="d-flex justify-content-center align-items-center">
                                                <span>
                                                    <img class="avatar img-thumbnail border-1 avatar-nav" src="upload/default-user-image.jpg" />
                                                </span>
                                            </div>
                                        </div>
                                        <div class=" text-center mt-2 mb-0">
                                            <h6 class="pb-1 mb-0 text-nowrap"><a href="login.html">Đăng nhập</a><a href="register.html">Đăng ký</a></h6>
                                        </div>
                                    </div>
                                <?php } ?>
                            </li>

                            <li><a href="index.html"><i class="fa fa-home iconfa" aria-hidden="true"></i> Trang Chủ</a>
                            <li><a href="#"><i class="fa fa-shopping-cart iconfa" aria-hidden="true"></i> Danh Mục</a>
                                <div class="megamenu">
                                    <?php

                                    if (isset($_SESSION['menuCategory'])) {
                                        // xử lý hàng và cột của bảng từ json
                                        $menuCategory = $_SESSION['menuCategory'];
                                        $numberMenuCategory = count($_SESSION['menuCategory']);
                                        $tableMenuCategoryRow = 3;
                                        $tableMenuCategory = $numberMenuCategory / $tableMenuCategoryRow;

                                        // title json
                                        $titleCategory = array("Quần áo", "", "", "Thời trang", "", "", "Phụ kiện hot trend", "", "");
                                        for ($i = 0; $i < $numberMenuCategory; $i++) {
                                            $catId = $menuCategory[$i]['catId'];
                                            $catName = $menuCategory[$i]['catName'];
                                            echo ($i == 0 || $i == 3 || $i == 6) ?
                                                '<ul class="single-mega cn-col-4">
                                            <li class="title">' . $titleCategory[$i]  . '</li>' : '' ?>
                            <li><a href="<?php echo $fm->vn_to_strMenu($catName) ?>-fcp1t<?php echo $catId ?>smem.html"><?php echo $catName ?></a></li>
                    <?php
                                            echo ($i == 2 || $i == 5 || $i == 8) ? '</ul>' : '';
                                        }
                                    }
                    ?>

                    <div class="single-mega cn-col-4">
                        <img src="img/bg-img/bg-6.jpg" alt="">
                    </div>
                    </div>
                    </li>
                    <li><a href="#"><i class="fa fa-bars iconfa" aria-hidden="true"></i> Menu</a>
                        <ul class="dropdown">
                            <li><a href="san-pham-f0p1t0smem.html">Tất cả sản phẩm</a></li>
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
            </div>

            <!-- User Login Info -->
            <div class="user-login-info">
                <a href="#" data-toggle="dropdown">&nbsp<img src="img/core-img/user.svg" alt=""></a>
                <ul class="dropdown-menu dropdown-cart" role="menu">
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