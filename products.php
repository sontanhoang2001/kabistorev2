<?php
include 'inc/header.php';
Session::set('REQUEST_URI', getRequestUrl()); // lưu vị trí đường dẫn trang khi chưa đăng nhập

$login_check = Session::get('customer_login');
if ($login_check) {
    $customer_id = Session::get('customer_id');
} else {
    $customer_id = 0;
}

if (!isset($_GET['filter']) && !isset($_GET['page']) && !isset($_GET['type'])) {
    $filter = 0;
    $page = 1;
    $type = 0;
} else {
    $filter = $_GET['filter'];
    $page = $_GET['page'];
    $type = $_GET['type'];
}
// if (!isset($_GET['page'])) {
//     echo "<meta http-equiv='refresh' content='0;URL=?page=1'>";
// }
?>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/message.css">

<!-- ##### Right Side Cart Area ##### -->
<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">

    <!-- Cart Button -->
    <!-- <div class="cart-button">
        <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""> <span>3</span></a>
    </div> -->

    <div class="cart-content d-flex">
        <!-- Cart List Area -->
        <div class="cart-list">
            <!-- Single Cart Item -->
            <div class="single-cart-item">
                <a href="#" class="product-image">
                    <img src="img/product-img/product-1.jpg" class="cart-thumb" alt="">
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                        <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                        <span class="badge">Mango</span>
                        <h6>Button Through Strap Mini Dress</h6>
                        <p class="size">Size: S</p>
                        <p class="color">Color: Red</p>
                        <p class="price">$45.00</p>
                    </div>
                </a>
            </div>

            <!-- Single Cart Item -->
            <div class="single-cart-item">
                <a href="#" class="product-image">
                    <img src="img/product-img/product-2.jpg" class="cart-thumb" alt="">
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                        <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                        <span class="badge">Mango</span>
                        <h6>Button Through Strap Mini Dress</h6>
                        <p class="size">Size: S</p>
                        <p class="color">Color: Red</p>
                        <p class="price">$45.00</p>
                    </div>
                </a>
            </div>

            <!-- Single Cart Item -->
            <div class="single-cart-item">
                <a href="#" class="product-image">
                    <img src="img/product-img/product-3.jpg" class="cart-thumb" alt="">
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                        <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                        <span class="badge">Mango</span>
                        <h6>Button Through Strap Mini Dress</h6>
                        <p class="size">Size: S</p>
                        <p class="color">Color: Red</p>
                        <p class="price">$45.00</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="cart-amount-summary">

            <h2>Summary</h2>
            <ul class="summary-table">
                <li><span>subtotal:</span> <span>$274.00</span></li>
                <li><span>delivery:</span> <span>Free</span></li>
                <li><span>discount:</span> <span>-15%</span></li>
                <li><span>total:</span> <span>$232.00</span></li>
            </ul>
            <div class="checkout-btn mt-100">
                <a href="checkout.html" class="btn essence-btn">check out</a>
            </div>
        </div>
    </div>
</div>
<!-- ##### Right Side Cart End ##### -->

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2>dresses</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Shop Grid Area Start ##### -->
<section class="shop_grid_area section-padding-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="shop_sidebar_area d-none d-sm-block">

                    <!-- ##### Single Widget ##### -->
                    <div class="widget catagory mb-4">
                        <!--  Catagories  -->
                        <div class="catagories-menu">
                            <ul id="menu-content2" class="menu-content collapse show">
                                <!-- Single Item -->
                                <li data-toggle="collapse" data-target="#category">
                                    <!-- Widget Title -->
                                    <h6 class="widget-title mb-4">Loại Sản Phẩm</h6>
                                    <!-- <a href="#">Tất cả</a> -->
                                    <ul class="sub-menu collapse show" id="category">
                                        <?php
                                        $cat_featheread = $cat->show_category();
                                        if ($cat_featheread) {
                                            while ($result = $cat_featheread->fetch_assoc()) {
                                                $catId = $result['catId'];
                                                $catName = $result['catName'];
                                        ?>
                                                <li><a class="<?php echo ($filter == "category" && $type == $catId) ? 'font-weight-bold' . $categorySelected = $catName : '' ?>" href="products-category-1-<?php echo $catId ?>.html"><?php echo $catName ?></a></li>
                                        <?php
                                            }
                                        } ?>
                                    </ul>
                                </li>
                                <!-- Single Item -->
                                <!-- <li data-toggle="collapse" data-target="#shoes" class="collapsed">
                                    <a href="#">shoes</a>
                                    <ul class="sub-menu collapse" id="shoes">
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Bodysuits</a></li>
                                        <li><a href="#">Dresses</a></li>
                                        <li><a href="#">Hoodies &amp; Sweats</a></li>
                                        <li><a href="#">Jackets &amp; Coats</a></li>
                                        <li><a href="#">Jeans</a></li>
                                        <li><a href="#">Pants &amp; Leggings</a></li>
                                        <li><a href="#">Rompers &amp; Jumpsuits</a></li>
                                        <li><a href="#">Shirts &amp; Blouses</a></li>
                                        <li><a href="#">Shirts</a></li>
                                        <li><a href="#">Sweaters &amp; Knits</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>
                    </div>

                    <!-- ##### Single Widget ##### -->
                    <!-- <div class="widget price mb-50">
                        Widget Title
                        <h6 class="widget-title mb-30">Lọc Sản Phẩm</h6>
                        Widget Title 2
                        <p class="widget-title2 mb-30">giá sản phẩm</p>

                        <div class="widget-desc">
                            <div class="slider-range">
                                <div data-min="49" data-max="360" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="49" data-value-max="360" data-label-result="Range:">
                                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                </div>
                                <div class="range-price">Giá Từ: $49.00 - $360.00</div>
                            </div>
                        </div>
                    </div> -->

                    <!-- ##### Single Widget ##### -->
                    <!-- <div class="widget color mb-50"> -->
                    <!-- Widget Title 2 -->
                    <!-- <p class="widget-title2 mb-30">Color</p>
                            <div class="widget-desc">
                                <ul class="d-flex">
                                    <li><a href="#" class="color1"></a></li>
                                    <li><a href="#" class="color2"></a></li>
                                    <li><a href="#" class="color3"></a></li>
                                    <li><a href="#" class="color4"></a></li>
                                    <li><a href="#" class="color5"></a></li>
                                    <li><a href="#" class="color6"></a></li>
                                    <li><a href="#" class="color7"></a></li>
                                    <li><a href="#" class="color8"></a></li>
                                    <li><a href="#" class="color9"></a></li>
                                    <li><a href="#" class="color10"></a></li>
                                </ul>
                            </div> -->
                    <!-- </div> -->

                    <!-- ##### Single Widget ##### -->
                    <div class="widget catagory mb-4">

                        <!--  Catagories  -->
                        <div class="catagories-menu">
                            <ul id="menu-content2" class="menu-content collapse show">
                                <!-- Single Item -->
                                <li data-toggle="collapse" data-target="#brand">
                                    <!-- Widget Title -->
                                    <h6 class="widget-title mb-4">Thương hiệu</h6>
                                    <!-- <a href="#">Tất cả</a> -->
                                    <ul class="sub-menu collapse show" id="brand">
                                        <?php
                                        $brand_featheread = $bra->show_brand();
                                        if ($brand_featheread) {
                                            while ($result = $brand_featheread->fetch_assoc()) {
                                                $brandId = $result['brandId'];
                                                $brandName = $result['brandName']
                                        ?>
                                                <li><a class="<?php echo ($filter == "brand" && $type == $brandId) ? 'font-weight-bold' . $brandSelected = $brandName : ''; ?>" href="products-brand-1-<?php echo $brandId ?>.html"><?php echo $brandName ?></a></li>
                                        <?php
                                            }
                                        } ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $product_all = $product->get_all_product($filter, $page, $type);
            $amount_all_product = $product->get_amount_all_product($filter, $type);
            $result = $amount_all_product->fetch_assoc();
            $product_count = $result['totalRow'];
            ?>
            <div class="col-12 col-md-8 col-lg-9">
                <div class="shop_grid_product_area">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-topbar d-flex align-items-center justify-content-between">
                                <!-- Total Products -->
                                <div class="total-products">
                                    <p><span><?php echo $product_count ?></span> Sản Phẩm</p>
                                </div>
                                <!-- Sorting -->
                                <div class="product-sorting d-flex">
                                    <p>lọc theo:</p>

                                    <select name="select" id="sortByselect">
                                        <option value="0" <?php echo ($filter == 0) ? 'selected="selected"' : '' ?>>Tất cả</option>

                                        <?php if ($filter == "category") {
                                        ?>
                                            <option value="c" selected="selected"><?php echo $categorySelected ?></option>
                                        <?php } else if ($filter == "brand") {
                                        ?>
                                            <option value="b" selected="selected"><?php echo $brandSelected ?></option>
                                        <?php } ?>
                                        <option value="1" <?php echo ($filter == 1) ? 'selected="selected"' : '' ?>>Bán chạy</option>
                                        <option value="2" <?php echo ($filter == 2) ? 'selected="selected"' : '' ?>>Khuyến mãi</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="wrapper_product">
                        <?php
                        if ($product_all) {
                            while ($result = $product_all->fetch_assoc()) {
                                $productId = $result['productId'];
                                $product_img =  "admin/uploads/" . $result['image'];
                                $seo = $result['seo'];
                        ?>
                                <!-- Single Product -->
                                <div class="col-6 col-sm-6 col-lg-4">
                                    <!-- Single Product -->
                                    <div class="single-product-wrapper page-product">
                                        <!-- Product Image -->
                                        <div class="product-img page-product">
                                            <img src="<?php echo $product_img ?>" alt="">
                                            <ul class="card-button-shop">
                                                <li><a data-tip="Chi tiết" href="details/<?php echo $result['productId'] ?>/<?php echo $seo ?>.html"><i class="fa fa-eye"></i></a></li>
                                                <?php
                                                $wishlist_check = $product->wishlist_check($customer_id, $productId);
                                                $login_check = Session::get('customer_login');
                                                if ($login_check) {
                                                    if ($wishlist_check) {
                                                ?>
                                                        <li><a data-tip="Hủy yêu thích" class="add_to_wishlist heart fa fa-heart" href="<?php echo $productId ?>"></a></li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" href="<?php echo $productId ?>"></i></a></li>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" href="<?php echo $productId ?>"></a></li>

                                                <?php
                                                }
                                                ?>
                                                <li>
                                                    <img style="width: 1px;" class="img-clone" src="<?php echo $product_img ?>" alt="cart icon" />
                                                    <a class="add_to_cart" href="<?php echo $productId ?>" data-tip="Thêm vào giỏ"><i class="fa fa-shopping-cart"></i></a>
                                                </li>
                                            </ul>
                                            <!-- Product Badge -->

                                            <?php
                                            $old_price = $result['old_price'];
                                            $price = $result['price'];
                                            if ($old_price != 0) {
                                                $per = round($temp = (($price * 100) / $old_price) - 100);
                                                echo '<div class="product-badge offer-badge page-product"><span>';
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
                                            <?php if ($filter == "category" || $filter == "brand") { ?>
                                            <?php } else { ?>
                                                <span class="category"><?php echo $result['catName'] ?></span>
                                            <?php } ?>
                                            <a href="details/<?php echo $result['productId'] ?>/<?php echo $seo ?>.html">
                                                <div class="product-name page-product"><?php echo $result['productName'] ?></div>
                                            </a>
                                            <p class="product-price">
                                                <?php if ($old_price != 0) {
                                                ?>
                                                    <span class="old-price"><?php echo $fm->format_currency($old_price) . " " . "₫" ?></span>&nbsp;
                                                <?php
                                                }
                                                ?>
                                                <?php echo $fm->format_currency($result['price']) . " ₫" ?>
                                            <div class="sell-out page-product">Đã bán <?php echo $result['product_soldout'] ?></div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>

                    <div class="row">
                        <a class="list-Product"></a>
                    </div>
                </div>

                <!-- <div id="xemthem">Xem Thêm</div> -->
                <!-- <style>
                    .col-sm-6 {
                        float: left;
                    }

                    .essence-btn,
                    .wishlist-btn,
                    .compare-btn {
                        min-width: auto;
                    }

                    .single-product-wrapper .product-img {
                        height: auto;
                    }

                    .single-product-wrapper .product-img .product-badge {
                        height: 19px;
                        background-color: #000000;
                        color: #ffffff;
                        font-family: "Ubuntu", sans-serif;
                        font-weight: 700;
                        font-size: 10px;
                        padding: 0px 4px;
                        display: inline-block;
                        line-height: 20px;
                        position: absolute;
                        top: 6px;
                        left: 7px;
                        z-index: 10;
                    }

                    .essence-btn,
                    .wishlist-btn,
                    .compare-btn {
                        display: inline-block;
                        min-width: 120px;
                        height: 35px;
                        color: #ffffff;
                        border: none;
                        border-radius: 0;
                        padding: 0 12px;
                        text-transform: uppercase;
                        font-size: 9px;
                        line-height: 39px;
                        background-color: #0315ff;
                        letter-spacing: 1.5px;
                        font-weight: 600;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, .5);
                        margin: 22px 0px 7px;
                    }

                    /* @media (min-width: 1200px) {
                        .col-lg-4 {
                            width: 33%;
                        }
                    } */

                    .pagination {
                        display: inline-block;
                    }

                    .pagination a {
                        color: black;
                        float: left;
                        padding: 8px 16px;
                        text-decoration: none;
                        transition: background-color .3s;
                        border: 1px solid #ddd;
                    }

                    .pagination a.active {
                        background-color: #4CAF50;
                        color: white;
                        border: 1px solid #4CAF50;
                    }

                    .pagination a:hover:not(.active) {
                        background-color: #ddd;
                    }
                </style> -->

                <!-- Pagination -->
                <ul class="pagination">
                    <?php
                    if ($product_count >= 12) {
                        $product_button = ceil(($product_count) / 6);
                        $query = $_SERVER['QUERY_STRING'];
                        $query_string = substr($query, -1, 2);
                        $page_now = (int)$query_string;
                        if ($page_now == 0) {
                            $page_now = (int)$query_string + 1;
                        }
                        $product_button = ceil(($product_count) / 12);
                        $page_now = $_GET['page'];
                        if ($page_now != 1) {
                            $page_now_index = $page_now - 1;
                            echo '<li class="page-item"><a class="page-link" href="products-' . $filter . '-' . $page_now_index . '-' . $type . '.html">❮</a></li>';
                            // << previous
                        }
                    ?>
                        <?php
                        $max = 0;
                        for ($i = 1; $i <= $product_button; $i++) {
                            if ($i == 1) {
                        ?>
                                <li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>" style="margin-right:0px"><a class="page-link" href="products-<?php echo $filter ?>-<?php echo $i ?>-<?php echo $type ?>.html"><?php echo $i ?></a></li>
                                <?php
                            } else {
                                if ($i == $page_now) {
                                    if ($i == $max + 1) {
                                ?>
                                        <li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>" style="margin-left:0px"><a class="page-link" href="products-<?php echo $filter ?>-<?php echo $i ?>-<?php echo $type ?>.html"><?php echo $i ?></a></li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>"><a class="page-link" href="products-<?php echo $filter ?>-<?php echo $i ?>-<?php echo $type ?>.html"><?php echo $i ?></a></li>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>"><a class="page-link" href="products-<?php echo $filter ?>-<?php echo $i ?>-<?php echo $type ?>.html"><?php echo $i ?></a></li>
                    <?php
                                }
                            }
                            $max++;
                        }
                        if ($page_now != $max) {
                            $page_now_index = $page_now + 1;
                            echo '<li class="page-item"><a class="page-link" href="products-' . $filter . '-' . $page_now_index . '-' . $type . '.html">❯</a></li>';
                            // >> next
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="fixed" id="message"></div>

<!-- ##### Shop Grid Area End ##### -->



<?php
include 'inc/bs-modal.php';
include 'inc/footer.php';
?>

<script src="js/function.js"></script>
<script type="text/javascript">
    var filter = <?php echo $filter ?>;
    // var page = 0;
    // $(document).ready(function() {
    //     $("#xemthem").click(function() {
    //         page = page + 1;
    //         $.get("page_ajax.php", {
    //                 page: page
    //             },
    //             function(data) {
    //                 $(".list-Product").html(data);
    //             });
    //     });
    // });

    $(document).on("click", ".nice-select .option:not(.disabled)", function(t) {
        var s = $(this),
            n = s.closest(".nice-select");
        if (s.data("value") != filter) {
            if (s.data("value") == "c" || s.data("value") == "b") {} else {
                window.location.replace(getAbsolutePath() + "products-" + s.data("value") + "-1-0.html");
            }
        }
    })
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="js/flyto.js"></script>
<script>
    // var productId;
    // var localbutton;

    var limitCart = <?php echo session::get('number_cart') ?>;
    $('#wrapper_product').flyto({
        target: '#cart-img',
        button: '.add_to_cart'
    });
</script>
<script src="js/ajax_wishlist-and-cart.js"></script>
<script src="js/audio-message.js"></script>