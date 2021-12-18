<?php
include 'inc/header.php';
include 'config/global.php';

$login_check = Session::get('customer_login');
if ($login_check) {
    $customer_id = Session::get('customer_id');
} else {
    $customer_id = 0;
}

if (!isset($_GET['filter']) && !isset($_GET['page']) && !isset($_GET['type'])  && !isset($_GET['priceStart']) && !isset($_GET['priceEnd'])) {
    $filter = 0;
    $page = 1;
    $type = 0;
    $priceStart = 0;
    $priceEnd = 0;
} else {
    $filter = $_GET['filter'];
    $page = $_GET['page'];
    $type = $_GET['type'];

    if ($_GET['priceStart'] == "m") {
        $priceStart = 0;
    } else {
        $priceStart = $_GET['priceStart'];
    }

    if ($_GET['priceEnd'] == "m") {
        $priceEnd = 500000;
    } else {
        $priceEnd = $_GET['priceEnd'];
    }
}

if (!isset($_GET['typeName'])) {
    $typeName = 0;
} else {
    $typeName = $_GET['typeName'];
}

Session::set('REQUEST_URI', $typeName . "-f" . getRequestUrl()); // lưu vị trí đường dẫn trang khi chưa đăng nhập
?>
<style>
    .nice-select:focus {
        box-shadow: none !important;
        border: none !important;
        border-radius: none !important;
    }
</style>
<link rel="stylesheet" href="css/pagination.css">
<link rel="stylesheet" href="css/price_range_style.css">


<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2 class="projTitle" style="border-bottom: none !important; font-size: 25px">MUA SẮN THỎA THÍCH<span>-cùng</span> Kabi Store</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Shop Grid Area Start ##### -->
<section class="shop_grid_area mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="shop_sidebar_area d-none d-sm-block" id="filter-panel">
                    <!-- close btn -->
                    <div class="classycloseIcon" id="closeFilterPanel">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <div class="filter-panel-scrollbar my-custom-scrollbar-primary">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-4">
                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <h6 class="widget-title mb-4">Lọc sản phẩm</h6>
                                <hr>

                                <!-- ##### Single Widget ##### -->
                                <div class="widget price mb-50">
                                    <!-- Widget Title -->
                                    <!-- <h6 class="widget-title mb-30">Giá Sản Phẩm</h6> -->
                                    <!-- Widget Title 2 -->
                                    <p class="widget-title2 mb-30">Lọc theo giá <small>(Nhập giá vào ô)</small></p>
                                    <div class="widget-desc">
                                        <div class="slider-range">
                                            <div id="slider-range" class="price-filter-range mb-3" name="rangeInput"></div>
                                            <input type="number" min=0 max="500000" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field form-control" />-
                                            <input type="number" min=0 max="500000" oninput="validity.valid||(value='500000');" id="max_price" class="price-range-field form-control" />
                                            <button class="btn btn-info price-range-search" id="price-range-submit"><i class="fa fa-search"></i></button>
                                            <div class="range-price text-success">Giá Từ: 0₫ - 500.000₫</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ##### Single Widget ##### -->
                                <div class="widget color mb-40">
                                    <!-- Widget Title 2 -->
                                    <p class="widget-title2 mb-30">Màu sắc <small>(chưa khả dụng)</small></p>
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
                                    </div>
                                </div>

                                <!-- ##### Single Widget ##### -->
                                <div class="widget color mb-50">
                                    <ul id="menu-content2" class="menu-content collapse show">
                                        <!-- Single Item -->
                                        <li data-toggle="collapse" data-target="#category">
                                            <!-- Widget Title -->
                                            <h6 class="widget-title2 mb-2">Loại Sản Phẩm</h6>
                                            <!-- <a href="#">Tất cả</a> -->
                                            <ul class="sub-menu collapse show" id="category">
                                                <?php
                                                $cat_featheread = $cat->show_category();
                                                if ($cat_featheread) {
                                                    while ($result = $cat_featheread->fetch_assoc()) {
                                                        $catId = $result['catId'];
                                                        $catName = $result['catName'];
                                                ?>
                                                        <li><a class="<?php echo ($filter == "c" && $type == $catId) ? 'font-weight-bold' . $categorySelected = $catName : '' ?>" href="<?php echo $fm->vn_to_str($catName) ?>-fcp1t<?php echo $catId ?>s<?php echo $priceStart ?>e<?php echo $priceEnd ?>.html"><?php echo $catName ?></a></li>
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

                                <!-- ##### Single Widget ##### -->
                                <div class="widget catagory mb-50">

                                    <!--  Catagories  -->
                                    <div class="catagories-menu">
                                        <ul id="menu-content2" class="menu-content collapse show">
                                            <!-- Single Item -->
                                            <li data-toggle="collapse" data-target="#brand">
                                                <!-- Widget Title -->
                                                <h6 class="widget-title2 mb-2">Mã kho</h6>
                                                <!-- <a href="#">Tất cả</a> -->
                                                <ul class="sub-menu collapse show" id="brand">
                                                    <?php
                                                    $brand_featheread = $bra->show_brand();
                                                    if ($brand_featheread) {
                                                        while ($result = $brand_featheread->fetch_assoc()) {
                                                            $brandId = $result['brandId'];
                                                            $brandName = $result['brandName']
                                                    ?>
                                                            <li><a class="<?php echo ($filter == "b" && $type == $brandId) ? 'font-weight-bold' . $brandSelected = $brandName : ''; ?>" href="<?php echo  $fm->vn_to_str($brandName) ?>-fbp1t<?php echo $brandId ?>s<?php echo $priceStart ?>e<?php echo $priceEnd ?>.html"><?php echo $brandName ?></a></li>
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
                    </div>
                </div>
            </div>
            <?php
            $product_all = $product->get_all_product($filter, $page, $type, $product_num, $priceStart, $priceEnd);
            $amount_all_product = $product->get_amount_all_product($filter, $type, $priceStart, $priceEnd);
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
                                        <?php if ($filter == "c") {
                                        ?>
                                            <option value="c" selected="selected"><?php echo $categorySelected ?></option>
                                        <?php } else if ($filter == "b") {
                                        ?>
                                            <option value="b" selected="selected"><?php echo $brandSelected ?></option>
                                        <?php } ?>
                                        <option value="1" <?php echo ($filter == 1) ? 'selected="selected"' : '' ?>>Bán chạy</option>
                                        <option value="2" <?php echo ($filter == 2) ? 'selected="selected"' : '' ?>>Khuyến mãi</option>
                                        <option value="3" <?php echo ($filter == 3) ? 'selected="selected"' : '' ?>>Tốt nhất</option>
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
                                $product_img =  json_decode($result['image']);
                                $product_img = $product_img[0]->image;
                        ?>
                                <!-- Single Product -->
                                <div class="col-6 col-sm-6 col-lg-4">
                                    <!-- Single Product -->
                                    <div class="single-product-wrapper page-product bg-white rounded shadow-sm">
                                        <!-- Product Image -->
                                        <div class="product-img page-product">
                                            <img data-src="<?php echo $product_img ?>" class="lazy" alt="">
                                            <ul class="card-button-shop">
                                                <li>
                                                    <img style="width: 1px; height: 1px;" class="img-clone" src="<?php echo $product_img ?>" alt="cart icon" />
                                                    <a class="add-btn-product add_to_cart" data-productid="<?php echo $productId ?>" data-tip="Thêm vào giỏ" data-id-1="<?php echo $result['size'] ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                                </li>
                                                <?php
                                                $wishlist_check = $product->wishlist_check($customer_id, $productId);
                                                $login_check = Session::get('customer_login');
                                                if ($login_check) {
                                                    if ($wishlist_check) {
                                                ?>
                                                        <li><a data-tip="Hủy yêu thích" class="add-btn-product add_to_wishlist heart fa fa-heart" data-productid="<?php echo $productId ?>"></a></li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li><a data-tip="Thêm yêu thích" class="add-btn-product add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></i></a></li>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <li><a data-tip="Thêm yêu thích" class="add-btn-product add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></a></li>
                                                <?php
                                                }
                                                ?>
                                                <li><a data-tip="Chi tiết" class="add-btn-product" href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
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
                                            <?php if ($filter == "c" || $filter == "b") { ?>
                                            <?php } else { ?>
                                                <span class="small text-muted mb-2"><?php echo $result['catName'] ?></span>
                                            <?php } ?>
                                            <a href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html">
                                                <div class="block-ellipsis text-dark"><?php echo $result['productName'] ?></div>
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
                        } else {
                            echo "Không tìm thấy sản phẩm nào!";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <?php
        if ($product_count >= $product_num) {
            $product_button = ceil(($product_count) / $product_num);
            $page_now = $page;
        }
        ?>
        <div class="mt-5 mb-4">
            <nav aria-label="Page navigation">
                <ul class="pagination" id="pagination"></ul>
            </nav>
        </div>
    </div>
</section>
<a id="showFilterPannel" class="d-md-none d-sm-block" href="#">
    <i class="fa fa-filter">
        <p style="color: #fff;">Lọc</p>
    </i></a>
<!-- ##### Shop Grid Area End ##### -->


<?php
include 'inc/footer.php';
?>
<script src="js/function.js"></script>
<script type="text/javascript">
    var filter = "<?php echo $filter ?>";
    $(document).on("click", ".nice-select .option:not(.disabled)", function(t) {
        var s = $(this),
            n = s.closest(".nice-select");
        if (s.data("value") != filter) {
            window.location.replace("san-pham-" + "f" + s.data("value") + "p1t0s<?php echo $priceStart ?>e<?php echo $priceEnd ?>.html");
        }
    })
</script>

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
</script>
<script src="js/ajax_wishlist-and-cart.js"></script>
<script src="js/audio-message.js"></script>
<script src="js/price_range_script.js"></script>
<script>
    var typeNamePath = "<?php echo $typeName ?>",
        typePath = "<?php echo $type ?>";
    // get and set range value url
    $(function() {
        $("#slider-range").slider({
            range: true,
            orientation: "horizontal",
            min: 0,
            max: 200000,
            values: [<?php echo $priceStart ?>, <?php echo $priceEnd ?>],
            step: 100,

            slide: function(event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }

                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
            }
        });

        $("#min_price").val($("#slider-range").slider("values", 0));
        $("#max_price").val($("#slider-range").slider("values", 1));
        $(".range-price").html("Giá từ: " + new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format($("#slider-range").slider("values", 0)) + " - " + new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format($("#slider-range").slider("values", 1)));
    });
</script>
<script src="js/pagination/jquery.twbsPagination.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        window.pagObj = $('#pagination').twbsPagination({
            totalPages: "<?php echo $product_button ?>",
            visiblePages: 4,
            startPage: <?php echo $page_now ?>,
            onPageClick: function(event, page) {
                // console.info(page + ' (from options)');
            }
        }).on('page', function(event, page) {
            // console.info(page + ' (from event listening)');
            location.href = "<?php echo $paginationHref =  $typeName . '-f' . $filter . 'p' ?>" + page + "<?php echo  't' . $type . 's' . $priceStart . 'e' . $priceEnd; ?>" + ".html";
        });
    });
</script>