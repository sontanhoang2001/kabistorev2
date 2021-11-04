<?php
include 'inc/header.php';
include 'inc/slider.php';
include 'inc/global.php';
?>

<!-- All css index -->
<!-- <link rel="stylesheet" href="css/index.css"> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

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
                        ?>
                                <!-- Single Product -->
                                <div id="single-product-wrapper" class="single-product-wrapper bg-white rounded shadow-sm" data-id-1="<?php echo $productId ?>">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="<?php echo $product_img ?>" loading="lazy">
                                        <ul class="card-button-shop">
                                            <li>
                                                <img style="width: 1px; height: 1px;" class="img-clone" src="<?php echo $product_img ?>" alt="cart icon" />
                                                <a class="add_to_cart" data-productid="<?php echo $productId ?>" data-tip="Thêm vào giỏ" data-id-1="<?php echo $result['size'] ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
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
                                            } else {
                                                ?>
                                                <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></a></li>
                                            <?php
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
                                        <!-- Favourite -->
                                        <!-- <div class="product-favourite">
                                                    <?php
                                                    $result['productId'];
                                                    $customer_id = Session::get('customer_id');
                                                    $wishlist_check = $product->wishlist_check($customer_id, $result['productId']);

                                                    $login_check = Session::get('customer_login');
                                                    if ($login_check) {
                                                        if ($wishlist_check) {
                                                            echo '<a href="#" class="favme active fa fa-heart"></a>';
                                                        } else {
                                                            echo '<a href="#" class="favme fa fa-heart"></a>';
                                                        }
                                                    }
                                                    ?>
                                                </div> -->
                                    </div>
                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span class="small text-muted mb-2"><?php echo $result['catName'] ?></span>
                                        <a href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html">
                                            <div class="text-dark"><?php echo $result['productName'] ?></div>
                                        </a>
                                        <p class="product-price">
                                            <?php if ($old_price != 0) {
                                            ?>
                                                <span class="old-price"><?php echo $fm->format_currency($old_price) . " " . "VND" ?></span>&nbsp;
                                            <?php
                                            }
                                            ?>
                                            <?php echo $fm->format_currency($result['price']) . " ₫" ?>
                                        <div class="sell-out">Đã bán <?php echo $result['product_soldout'] ?></div>
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
                                <div class="product-img relatedProducts">
                                    <a href="<?php echo $fm->vn_to_str($catName) ?>-fcp1t<?php echo $catId ?>smem.html">
                                        <img src="<?php echo $product_img ?>" loading="lazy">
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
    <div class="container-fluid pb-3" style="background-color: #eff0f5;">
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
                                    echo "promo";
                                    break;
                                case "5":
                                    echo "promoBox";
                                    break;
                                default:
                            } ?>">
                                <aside>
                                    <p>Mua từ <?php echo $fm->format_currency($result['condition']) . " ₫" ?></p>
                                </aside>
                                <h5>Giảm <?php echo $fm->format_currency($result['discountMoney']) . " ₫" ?></h5>
                                <p class="row col-10"><?php echo $result['description'] ?></p>
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <p style="color: green;">Mã giảm giá: <span class="promoCode" id="promocode-<?php echo $promotion_index ?>"><?php echo $result['promotionsCode'] ?></span></p>
                                        <button type="button" class="btn pull-right" onclick="copyToClipboard('#promocode-<?php echo $promotion_index ?>')" style="box-shadow: none !important">sao chép</button>
                                    </div>
                                </div>
                            </div>
                    <?php
                            $promotion_index++;
                        }
                    } ?>

                    <!-- <div class="promoBox info-box info-ribbon">
                        <aside>
                            <p>Mua từ 120k</p>
                        </aside>
                        <h4>Giảm 50k</h4>
                        <p>Kỷ niệm ngày . Khuyến mãi từ ngày 06-08-2021 đến ngày 10-08-2021.</p>
                        <div class="row ml-2">
                            <p style="color: green;">Mã giảm giá: <span class="promoCode">BOH232</span></p>
                            <button type="button" class="btn ml-4">sao chép</button>
                        </div>
                    </div>

                    <div class="promoBox warning-box danger-ribbon">
                        <aside>
                            <p>Ribbon Text</p>
                        </aside>
                        <h4>Hero Text Goes Here Yo!</h4>
                        <p>This is where I would type real copy if this wasn't just in codepen!</p>
                        <div class="row ml-2">
                            <p style="color: green;">Mã giảm giá: <span class="promoCode">BOH232</span></p>
                            <button type="button" class="btn ml-4">sao chép</button>
                        </div>
                    </div>

                    <div class="promoBox success-ribbon">
                        <aside>
                            <p>Ribbon Text</p>
                        </aside>
                        <h4>Hero Text Goes Here Yo!</h4>
                        <p>This is where I would type real copy if this wasn't just in codepen!</p>
                        <div class="row ml-2">
                            <p style="color: green;">Mã giảm giá: <span class="promoCode">BOH232</span></p>
                            <button type="button" class="btn ml-4">sao chép</button>
                        </div>
                    </div>

                    <div class="promoBox success-box info-ribbon">
                        <aside>
                            <p>Ribbon Text</p>
                        </aside>
                        <h4>Hero Text Goes Here Yo!</h4>
                        <p>This is where I would type real copy if this wasn't just in codepen!</p>
                        <div class="row ml-2">
                            <p style="color: green;">Mã giảm giá: <span class="promoCode">BOH232</span></p>
                            <button type="button" class="btn ml-4">sao chép</button>
                        </div>
                    </div>

                    <div class="promo">
                        <div class="promoBox danger-box warning-ribbon">
                            <aside>
                                <p>Ribbon Text</p>
                            </aside>
                            <h4>Hero Text Goes Here Yo!</h4>
                            <p>This is where I would type real copy if this wasn't just in codepen!</p>
                            <div class="row ml-2">
                                <p style="color: green;">Mã giảm giá: <span class="promoCode">BOH232</span></p>
                                <button type="button" class="btn ml-4">sao chép</button>
                            </div>
                        </div>
                    </div>

                    <div class="promoBox">
                        <aside>
                            <p>Ribbon Text</p>
                        </aside>
                        <h4>Hero Text Goes Here Yo!</h4>
                        <p>This is where I would type real copy if this wasn't just in codepen!</p>
                        <div class="row ml-2">
                            <p style="color: green;">Mã giảm giá: <span class="promoCode">BOH232</span></p>
                            <button type="button" class="btn ml-4">sao chép</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- END PROTION -->

    <!-- <div class="testprin">day nè</div> -->


    <?php
    // $get_all_product_rank = $product->get_all_product_rank();
    // if ($show_promotion) {
    //     while ($result = $get_all_product_rank->fetch_assoc()) {
    //         $img_array[] =  $result['image'];
    //     }
    // }
    ?>
    <div class="container-fluid">
        <div class="px-lg-5">
            <div class="container">
                <h2 class="pt-4"><i class="fa fa-trophy" aria-hidden="true"></i> Xếp hạng cao nhất</h2>
                <p>Xếp hạng dựa trên số lượt tìm kiếm và đánh giá của khách hàng</p>

                <div class="row mt-5">
                    <div class="wrapper" id="wrapper_productRank">
                        <div class="carousel-relatedProduct owl-carousel">
                            <?php
                            $get_all_product_Featured = $product->get_all_product_rank();
                            if ($get_all_product_Featured) {
                                while ($result = $get_all_product_Featured->fetch_assoc()) {
                                    $productId = $result['productId'];
                                    $product_img =  json_decode($result['image']);
                                    $product_img = $product_img[0]->image;
                            ?>
                                    <!-- Single Product -->

                                    <div id="single-product-wrapper" class="single-product-wrapper relatedProducts bg-white rounded shadow-sm" data-id-1="<?php echo $productId ?>">
                                        <!-- Product Image -->
                                        <div class="product-img relatedProducts">
                                            <img data-src="<?php echo $product_img ?>" class="lazy">
                                            <ul class="card-button-shop">
                                                <li>
                                                    <img style="width: 1px; height: 1px;" class="img-clone" src="<?php echo $product_img ?>" alt="cart icon" />
                                                    <a class="add_to_cart" data-productid="<?php echo $productId ?>" data-tip="Thêm vào giỏ" data-id-1="<?php echo $result['size'] ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
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
                                                } else {
                                                    ?>
                                                    <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></a></li>
                                                <?php
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
                                        <div class="product-description ml-4 mr-4">
                                            <span class="small text-muted"><?php echo $result['catName'] ?></span>
                                            <a href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html">
                                                <div class="text-dark"><?php echo $result['productName'] ?></div>
                                            </a>
                                            <p class="product-price">
                                                <?php if ($old_price != 0) {
                                                ?>
                                                    <span class="old-price"><?php echo $fm->format_currency($old_price) . " " . "VND" ?></span>&nbsp;
                                                <?php
                                                }
                                                ?>
                                                <?php echo $fm->format_currency($result['price']) . " " . "₫" ?>
                                            <div class="sell-out">Đã bán <?php echo $result['product_soldout'] ?></div>
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

        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>


        <div class="px-lg-5">
            <div class="container">
                <h2 class="pt-4"><i class="fa fa-plug" aria-hidden="true"></i> Hướng dẫn mua hàng</h2>
                <p>Video hướng dẫn cách bước đặt hàng tại Kabistore vô cùng đơn giản</p>

                <div class="row mt-5">
                    <div class="col-md-6">
                        <!-- Your embedded video player code -->
                        <div class="fb-video" data-href="https://www.facebook.com/facebook/videos/10153231379946729/" data-width="500" data-show-text="false" data-lazy="true">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/facebook/videos/10153231379946729/">
                                    <a href="https://www.facebook.com/facebook/videos/10153231379946729/">How to Share With Just Friends</a>
                                    <p>How to share with just friends.</p>
                                    Posted by <a href="https://www.facebook.com/facebook/">Facebook</a> on Friday, December 5, 2014
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Your embedded video player code -->
                        <div class="fb-video" data-href="https://www.facebook.com/facebook/videos/10153231379946729/" data-width="500" data-show-text="false" data-lazy="true">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/facebook/videos/10153231379946729/">
                                    <a href="https://www.facebook.com/facebook/videos/10153231379946729/">How to Share With Just Friends</a>
                                    <p>How to share with just friends.</p>
                                    Posted by <a href="https://www.facebook.com/facebook/">Facebook</a> on Friday, December 5, 2014
                                </blockquote>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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
                            <p class="grey-text">Chúng tôi cung cấp dịch vụ phân phối vào giao hàng tốt nhất và nhanh nhất trong khu vực trung tâm, với công nghệ hiện đại dễ dàng giúp người tiêu dùng và người kinh doanh kết nối lại với nhau một cách hiệu quả và tiềm năng nhất.</p>

                        </div>
                        <!--Grid column-->
                    </div>
                    <!--Grid row-->
                    <!--Grid row-->
                    <div class="row">
                        <!--Grid column-->
                        <div class="col-md-4 mb-3">
                            <i class="fa fa-handshake-o fa-4x orange-text"></i>
                            <h4 class="my-4 font-weight-bold">Đối Tác</h4>
                            <p class="grey-text">Hiện nay chúng tôi đã có hơn 100+ đối tác các shop lớn nhỏ trong trung tâm.</p>
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
                            <i class="fa fa-newspaper-o fa-4x orange-text"></i>
                            <h4 class="my-4 font-weight-bold">Cổng Thông Tin</h4>
                            <p class="grey-text">Chúng tôi luôn cập nhật thông tin chính thống mới nhất đến người tiêu dùng thông minh.</p>
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
<?php include 'inc/footer.php' ?>
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