<?php
include 'inc/header.php';
include 'inc/slider.php';
include 'config/global.php';
?>

<!-- All css index -->
<!-- <link rel="stylesheet" href="css/index.css"> -->
<script src="js/jquery/jquery-3.5.1.js"></script>
<script src="js/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="css/owl.carousel.min.css">

<!-- <body oncontextmenu="return false" ondragstart="return false" onselectstart="return false"> -->

<body>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="productHot-tab" data-toggle="tab" href="#productHot" role="tab" aria-controls="productHot" aria-selected="true">Hot Nhất</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#category" role="tab" aria-controls="profile" aria-selected="false">Danh Mục</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="san-pham-f0p1t0smem.html" aria-selected="false">Tất Cả</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabProduct">
            <div class="tab-pane fade show active" id="productHot" role="tabpanel" aria-labelledby="productHot-tab">
                <!-- Swiper -->
                <div class="wrapper" id="wrapper_product">
                    <div class="carousel-product owl-carousel">
                        <?php
                        $get_all_product_Featured = $product->get_all_product_Featured();
                        if ($get_all_product_Featured) {
                            while ($result = $get_all_product_Featured->fetch_assoc()) {
                                $productId = $result['productId'];
                                $product_img =  json_decode($result['image']);
                                $product_img = $product_img[0]->image;
                                if ($result['size'] != null) {
                                    $sizeObj = json_decode($result['size']);
                                    $size = $sizeObj[0]->size;
                                } else {
                                    $size = null;
                                }
                                if ($result['color'] != null) {
                                    $colorObj = json_decode($result['color']);
                                    $color = $colorObj[0]->color;
                                } else {
                                    $color = null;
                                }
                        ?>
                                <!-- Single Product -->
                                <div id="single-product-wrapper" class="single-product-wrapper bg-white rounded shadow-sm">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img class="lazy" id="imgProductHot" src="img/core-img/best-loader.gif" data-src="<?php echo $product_img ?>" data-status="0">
                                        <ul class="card-button-shop">
                                            <li>
                                                <img class="lazy" src="img/core-img/best-loader.gif" style="width: 1px; height: 1px !important" class="img-clone" data-src="<?php echo $product_img ?>" data-status="0" />
                                                <a class="add_to_cart" data-productid="<?php echo $productId ?>" data-tip="Thêm vào giỏ" data-size="<?php echo $size ?>" data-color="<?php echo $color ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                            </li>
                                            <?php
                                            $wishlist_check = $product->wishlist_check($customer_id, $productId);
                                            $login_check = Session::get('customer_login');
                                            if ($login_check) {
                                                if ($wishlist_check) {
                                            ?>
                                                    <li><a data-tip="Hủy yêu thích" class="add_to_wishlist heart fa fa-heart" data-productid="<?php echo $productId ?>"></a></li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></i></a></li>
                                                <?php
                                                }
                                            }
                                            if (isset($_COOKIE['shopping_wishlist']) && $login_check == false) {
                                                $wishlisted = false;
                                                $cookie_data = stripslashes($_COOKIE['shopping_wishlist']);
                                                $wishlist_data = json_decode($cookie_data, true);
                                                foreach ($wishlist_data as $keys => $values) {
                                                    if ($wishlist_data[$keys]['productId'] == $productId) {
                                                        $wishlisted = true;
                                                    }
                                                }
                                                if ($wishlisted == true) {
                                                ?>
                                                    <li><a data-tip="Hủy yêu thích" class="add_to_wishlist heart fa fa-heart" data-productid="<?php echo $productId ?>"></a></li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></i></a></li>
                                                <?php
                                                }
                                            } else {
                                                if ($login_check == false) {
                                                ?>
                                                    <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></i></a></li>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <li><a data-tip="Chi tiết" href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                        </ul>

                                        <!-- Product Badge -->
                                        <?php
                                        $old_price = $result['old_price'];
                                        $price = $result['price'];
                                        if ($old_price != 0) {
                                            $per = round($temp = (($price * 100) / $old_price) - 100);
                                            echo '<div class="product-badge offer-badge"><span>';
                                            echo $per . " %";
                                            echo '</span></div>';
                                        }
                                        ?>
                                    </div>
                                    <!-- Product Description -->
                                    <div class="product-description mr-3 ml-3">
                                        <span class="small text-muted mb-2"><?php echo $result['catName'] ?></span>
                                        <a href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html">
                                            <div class="block-ellipsis text-dark"><?php echo $result['productName'] ?></div>
                                        </a>
                                        <p class="product-price">
                                            <?php if ($old_price != 0) {
                                            ?>
                                                <span class="old-price"><?php echo $fm->format_currency($old_price) . " ₫" ?></span>&nbsp;
                                            <?php
                                            }
                                            ?>
                                            <?php echo $fm->format_currency($result['price']) . " ₫" ?>
                                        <div class="sell-out page-product"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo ($result['brandId'] == 18) ? "Vũng Liêm" : "Cần Thơ" ?> &nbsp;<i class="fa fa-bolt" aria-hidden="true"></i> Đã bán <?php echo $result['product_soldout'] ?></div>
                                        </p>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Swiper -->
                <div class="wrapper">
                    <div class="carousel-relatedProduct owl-carousel">
                        <?php
                        foreach ($_SESSION['menuCategory'] as $val) {
                            $catId = $val['catId'];
                            $catName = $val['catName'];
                            $product_img = $val['product_img'];
                        ?>
                            <!-- Single Product -->
                            <div class="single-product-wrapper categoryWrapper">
                                <!-- Product Image -->
                                <div class="product-img relatedProducts bg-white rounded shadow-sm">
                                    <a href="<?php echo $fm->vn_to_str($catName) ?>-fcp1t<?php echo $catId ?>smem.html">
                                        <img id="img-category lazy" src="img/core-img/best-loader.gif" data-src="<?php echo $product_img ?>" data-status="0">
                                        <h5 class="categories_name" id="categoryNameWrapper"><?php echo $catName; ?></h5>
                                    </a>
                                    <!-- Product Badge -->
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
        <div class="view-all">
            <div class="py-5 text-center"><a href="san-pham-f0p1t0smem.html" class="btn btn-dark px-5 py-3 text-uppercase">Xem thêm</a></div>
        </div>
    </div>

    <!-- START PROMOTION -->
    <div class="container-fluid pb-3" style="background-color: #eff0f5;" id="coupon">
        <div class="container">
            <h2 class="pt-4"><i class="fa fa-percent" aria-hidden="true"></i> Mã Giảm Giá</h2>
            <p>Nhấn vào đi đến shop để mua nhiều sản phẩm hơn</p>
            <!-- Swiper -->
            <div class="wrapper-coupon">
                <div class="carousel-promotion owl-carousel">
                    <?php
                    $promotion_index = 0;
                    $show_promotion = $product->show_promotion();
                    if ($show_promotion) {
                        while ($result = $show_promotion->fetch_assoc()) {
                            $stylePromotion =  $result['style'];
                    ?>
                            <div class="
                            <?php
                            switch ($stylePromotion) {
                                case "1":
                                    echo "promoBox info-box info-ribbon";
                                    break;
                                case "2":
                                    echo "promoBox warning-box danger-ribbon";
                                    break;
                                case "3":
                                    echo "promoBox success-ribbon";
                                    break;
                                case "4":
                                    echo "promoBox success-box info-ribbon";
                                    break;
                                case "5":
                                    echo "promoBox danger-box warning-ribbon";
                                    break;
                                case "6":
                                    echo "promoBox";
                                    break;
                                default:
                            } ?>">
                                <aside>
                                    <p>Mua từ <?php echo $fm->format_currency($result['condition']) . " ₫" ?></p>
                                </aside>
                                <h5>Giảm <?php echo $fm->format_currency($result['discountMoney']) . " ₫" ?></h5>
                                <p class="row col-8"><?php echo $result['description'] ?></p>
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <p style="color: green;">Mã giảm giá: <span class="promoCode" id="promocode-<?php echo $promotion_index ?>"><?php echo $result['promotionsCode'] ?></span></p>
                                        <button type="button" class="btn pull-right" onclick="copyToClipboardPromotionCode('#promocode-<?php echo $promotion_index ?>')" style="box-shadow: none !important">sao chép</button>
                                    </div>
                                </div>
                            </div>
                    <?php
                            $promotion_index++;
                        }
                    } ?>

                </div>
            </div>
        </div>
    </div>
    <!-- END PROTION -->


    <div class="container-fluid">
        <div class="px-lg-5">
            <div class="container">
                <h2 class="pt-4"><i class="fa fa-trophy" aria-hidden="true"></i> Xếp hạng cao nhất</h2>
                <p>Xếp hạng dựa trên số lượt tìm kiếm và đánh giá của khách hàng</p>

                <div class="row mt-5">
                    <!-- Single Product -->
                    <div class="wrapper" id="wrapper_productRank">
                        <div class="carousel-relatedProduct owl-carousel">
                            <?php
                            $get_all_product_Featured = $product->get_all_product_rank();
                            if ($get_all_product_Featured) {
                                while ($result = $get_all_product_Featured->fetch_assoc()) {
                                    $productId = $result['productId'];
                                    $product_img =  json_decode($result['image']);
                                    $product_img = $product_img[0]->image;
                                    if ($result['size'] != null) {
                                        $sizeObj = json_decode($result['size']);
                                        $size = $sizeObj[0]->size;
                                    } else {
                                        $size = null;
                                    }
                                    if ($result['color'] != null) {
                                        $colorObj = json_decode($result['color']);
                                        $color = $colorObj[0]->color;
                                    } else {
                                        $color = null;
                                    }
                            ?>
                                    <div id="single-product-wrapper" class="single-product-wrapper relatedProducts bg-white rounded shadow-sm">
                                        <!-- Product Image -->
                                        <div class="product-img relatedProducts">
                                            <img src="img/core-img/best-loader.gif" data-src="<?php echo $product_img ?>" class="lazy" data-status="0">
                                            <ul class="card-button-shop">
                                                <li>
                                                    <img class="lazy" src="img/core-img/best-loader.gif" style="width: 1px; height: 1px !important" class="img-clone" data-src="<?php echo $product_img ?>" data-status="0" />
                                                    <a class="add_to_cart" data-productid="<?php echo $productId ?>" data-tip="Thêm vào giỏ" data-size="<?php echo $size ?>" data-color="<?php echo $color ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                                </li>
                                                <?php
                                                $wishlist_check = $product->wishlist_check($customer_id, $productId);
                                                $login_check = Session::get('customer_login');
                                                if ($login_check) {
                                                    if ($wishlist_check) {
                                                ?>
                                                        <li><a data-tip="Hủy yêu thích" class="add_to_wishlist heart fa fa-heart" data-productid="<?php echo $productId ?>"></a></li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></i></a></li>
                                                    <?php
                                                    }
                                                }
                                                if (isset($_COOKIE['shopping_wishlist']) && $login_check == false) {
                                                    $wishlisted = false;
                                                    $cookie_data = stripslashes($_COOKIE['shopping_wishlist']);
                                                    $wishlist_data = json_decode($cookie_data, true);
                                                    foreach ($wishlist_data as $keys => $values) {
                                                        if ($wishlist_data[$keys]['productId'] == $productId) {
                                                            $wishlisted = true;
                                                        }
                                                    }
                                                    if ($wishlisted == true) {
                                                    ?>
                                                        <li><a data-tip="Hủy yêu thích" class="add_to_wishlist heart fa fa-heart" data-productid="<?php echo $productId ?>"></a></li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></i></a></li>
                                                    <?php
                                                    }
                                                } else {
                                                    if ($login_check == false) {
                                                    ?>
                                                        <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></i></a></li>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <li><a data-tip="Chi tiết" href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                            </ul>

                                            <!-- Product Badge -->
                                            <?php
                                            $old_price = $result['old_price'];
                                            $price = $result['price'];
                                            if ($old_price != 0) {
                                                $per = round($temp = (($price * 100) / $old_price) - 100);
                                                echo '<div class="product-badge offer-badge"><span>';
                                                echo $per . " %";
                                                echo '</span></div>';
                                            }
                                            ?>
                                        </div>
                                        <!-- Product Description -->
                                        <div class="product-description ml-3 mr-3">
                                            <span class="small text-muted mb-2"><?php echo $result['catName'] ?></span>
                                            <a href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html">
                                                <div class="block-ellipsis text-dark"><?php echo $result['productName'] ?></div>
                                            </a>
                                            <p class="product-price">
                                                <?php if ($old_price != 0) {
                                                ?>
                                                    <span class="old-price"><?php echo $fm->format_currency($old_price) . " ₫" ?></span>&nbsp;
                                                <?php
                                                }
                                                ?>
                                                <?php echo $fm->format_currency($result['price']) . " " . "₫" ?>
                                            <div class="sell-out page-product"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo ($result['brandId'] == 18) ? "Vũng Liêm" : "Cần Thơ" ?> &nbsp;<i class="fa fa-bolt" aria-hidden="true"></i> Đã bán <?php echo $result['product_soldout'] ?></div>
                                            </p>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <div class="py-5 text-center"><a href="san-pham-f3p1t0smem.html" class="btn btn-dark px-5 py-3 text-uppercase">Xem thêm</a></div>
        </div>
    </div>

    <!--Main layout-->
    <main class="mt-5">
        <div class="container-fluid" style="background-color: #eff0f5;">
            <div class="container" style="background-color: #eff0f5;">
                <!--Section: Best Features-->
                <section id="best-features" class="text-center">
                    <!-- Heading -->
                    <h2 class="pt-5 mb-4 font-weight-bold">Về chúng tôi</h2>
                    <!--Grid row-->
                    <div class="row d-flex justify-content-center mb-4">
                        <!--Grid column-->
                        <div class="col-md-8">

                            <!-- Description -->
                            <p class="grey-text">Chúng tôi chuyên bán những sản phẩm độc và lạ, những sản phẩm mà bạn khó có thể mua được ở các tiệm tập hóa, hay các cửa hàng ở xung quanh bạn. Chất lượng sản phẩm và giao hàng tốt nhất nhất với công nghệ hiện đại sẽ giúp người tiêu dùng dễ dàng kết nối với chúng tôi một cách hiệu quả và tiềm năng hơn.</p>
                        </div>
                        <!--Grid column-->
                    </div>
                    <!--Grid row-->
                    <!--Grid row-->
                    <div class="row">
                        <!--Grid column-->
                        <div class="col-md-4 mb-3">
                            <i class="fa fa-newspaper-o fa-4x orange-text"></i>
                            <h4 class="my-4 font-weight-bold">Cập nhật mới nhất</h4>
                            <p class="grey-text">Sản phẩm của chúng tôi luôn được cập nhật mới nhất, tầng suất mỗi ngày.</p>
                        </div>
                        <!--Grid column-->
                        <!--Grid column-->
                        <div class="col-md-4 mb-3">
                            <i class="fa fa-gift fa-4x orange-text"></i>
                            <h4 class="my-4 font-weight-bold">Giao Hàng Siêu Tốc</h4>
                            <p class="grey-text">Bạn chỉ cần lướt và đặt hàng việc còn lại cứ để chúng tôi lo đến tận nơi.</p>
                        </div>
                        <!--Grid column-->
                        <!--Grid column-->
                        <div class="col-md-4 mb-3">
                            <i class="fa fa-handshake-o fa-4x orange-text"></i>
                            <h4 class="my-4 font-weight-bold">Đối Tác</h4>
                            <p class="grey-text">Hiện nay chúng tôi đã có hơn 10+ đối tác các shop lớn nhỏ trong trung tâm.</p>
                        </div>
                        <!--Grid column-->
                    </div>
                    <!--Grid row-->
                </section>
                <!--Section: Best Features-->
            </div>
        </div>
    </main>
    <!--Main layout-->

    <!-- ##### New Arrivals Area End ##### -->
</body>

<!-- js -->
<script src="js/carousel.js"></script>
<?php include 'inc/footer.php'; ?>
<script src="js/jquery/ui/1.12.1/jquery-ui.min.js"></script>
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
<script>
    scrollingForIndex();
</script>
<script src="webpushr-sw.js"></script>

<!-- start webpushr tracking code -->
<script>
    (function(w, d, s, id) {
        if (typeof(w.webpushr) !== 'undefined') return;
        w.webpushr = w.webpushr || function() {
            (w.webpushr.q = w.webpushr.q || []).push(arguments)
        };
        var js, fjs = d.getElementsByTagName(s)[0];
        js = d.createElement(s);
        js.id = id;
        js.async = 1;
        js.src = "https://cdn.webpushr.com/app.min.js";
        fjs.parentNode.appendChild(js);
    }(window, document, 'script', 'webpushr-jssdk'));
    webpushr('setup', {
        'key': 'BCGwKnPSZGghR1Zyfbqm2S1ZtTLA755qNjK8N69b0E9EgNvyw5Pif1tVxha7fh-MFMViFEaTBzlih5DfbsDdD8o'
    });
</script>
<!-- end webpushr tracking code -->