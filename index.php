<?php

include 'inc/header.php';
include 'inc/slider.php';
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check) {
}
?>

<!-- All css index -->
<link rel="stylesheet" href="css/index.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<style>

</style>

<!-- API Voice Robot -->
<!-- <script src="https://code.responsivevoice.org/responsivevoice.js?key=5CJ9DfAD"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<input id="text" type="hidden" value="Chào mừng Độ Nguyễn đã đến với Tấn Hoàng Shop"></input>

<input id="voiceselection" type="hidden" value="Vietnamese Female"></input> -->


<script>
    //Populate voice selection dropdown
    // var voicelist = responsiveVoice.getVoices();
    // var vselect = $("#voiceselection");
    // $.each(voicelist, function() {
    //     vselect.append($("<option />").val(this.name).text(this.name));
    // });


    // responsiveVoice.speak($('#text').val(),$('#voiceselection').val());

    // window.document.onload = function() {
    //     // alert("Image is loaded");
    //     //setTimeout(responsiveVoice.speak("Welcome to the Responsive Voice website","Vietnamese Female"),150);
    // }
</script>
<!-- <input id="click-robot" onclick="responsiveVoice.speak($('#text').val(),$('#voiceselection').val());" type="button" value="🔊 Play"/> -->

<!-- API Voice Robot -->

<!-- <body oncontextmenu="return false" ondragstart="return false" onselectstart="return false"> -->

<body>

    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Hot Nhất</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Danh Mục</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tất Cả</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabProduct">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <!-- Swiper -->
                <div class="wrapper" id="wrapper_product">
                    <div class="carousel-product owl-carousel">
                        <?php
                        $get_all_product_Featured = $product->get_all_product_Featured();
                        if ($get_all_product_Featured) {
                            while ($result = $get_all_product_Featured->fetch_assoc()) {
                                $productId = $result['productId'];
                                $seo = $result['seo'];
                                $product_img =  "admin/uploads/" . $result['image'];
                        ?>
                                <!-- Single Product -->
                                <div class="single-product-wrapper" data-id-1="<?php echo $productId ?>">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="<?php echo $product_img ?>">
                                        <ul class="card-button-shop">
                                            <li><a data-tip="Chi tiết" href="details.php?proid=<?php echo $productId ?>"><i class="fa fa-eye"></i></a></li>
                                            <?php
                                            $wishlist_check = $product->wishlist_check($customer_id, $productId);
                                            $login_check = Session::get('customer_login');
                                            if ($login_check) {
                                                if ($wishlist_check) {
                                            ?>
                                                    <li><a data-tip="Hủy yêu thích" class="add_to_wishlist heart fa fa-heart" href="<?php echo $productId ?>" data-id-1="1"></a></li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" href="<?php echo $productId ?>" data-id-1="0"></i></a></li>
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
                                                <a class="add_to_cart" href="<?php echo $productId ?>" data-tip="Thêm vào giỏ" data-id-1="<?php echo $result['size'] ?>"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                            <!-- <a class="add_to_cart" data-tip="Thêm vào giỏ"><i class="fa fa-shopping-cart"></i></a> -->
                                        </ul>

                                        <!-- <button id="add_to_cart_effect_<?php echo $productId ?>" class="button add_to_cart_effect" type="button">
                                            <img class="icon" src="assets/images/cart-sm.png" alt="cart icon" />
                                            Add to cart
                                        </button> -->

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
                                        <span class="category"><?php echo $result['catName'] ?></span>
                                        <a href="details/<?php echo $result['productId'] ?>/<?php echo $seo ?>.html">
                                            <div class="product-name"><?php echo $result['productName'] ?></div>
                                        </a>
                                        <p class="product-price">
                                            <?php if ($old_price != 0) {
                                            ?>
                                                <span class="old-price"><?php echo $fm->format_currency($old_price) . " " . "VND" ?></span>&nbsp;
                                            <?php
                                            }
                                            ?>
                                            <?php echo $fm->format_currency($result['price']) . " " . "₫" ?>
                                        <div class="sell-out">Đã bán 78</div>
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


            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Swiper -->
                <div class="wrapper">
                    <div class="carousel-product owl-carousel">
                        <?php
                        $show_category_img = $cat->show_category_img();
                        if ($show_category_img) {
                            while ($result = $show_category_img->fetch_assoc()) {
                        ?>
                                <!-- Single Product -->
                                <div class="single-product-wrapper">

                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <a href="products-category-1-<?php echo $result['catId'] ?>.html">
                                            <img src="admin/uploads/<?php echo $result['image'] ?>" alt="">
                                            <h5 class="categories_name"><?php echo $result['catName']; ?></h5>
                                        </a>
                                        <!-- Product Badge -->
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
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                gdssagsd
            </div>
        </div>
        <div class="view-all">
            <button onclick="window.location.href='products-0-1-0.html'" class="btn-view-all">XEM THÊM <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>
    </div>
    <!-- START PROMOTION -->
    <div class="container-fluid" style="background-color: #eff0f5;">
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
                                <div class="row ml-2">
                                    <p style="color: green;">Mã giảm giá: <span class="promoCode" id="promocode-<?php echo $promotion_index ?>"><?php echo $result['promotionsCode'] ?></span></p>
                                    <button type="button" class="btn ml-4" onclick="copyToClipboard('#promocode-<?php echo $promotion_index ?>')">sao chép</button>
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
                        <p>Kỷ niệm ngày Hoàng Thảo yêu nhau. Khuyến mãi từ ngày 06-08-2021 đến ngày 10-08-2021.</p>
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

    <script>
        $(".carousel-product").owlCarousel({
            margin: 20,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 2,
                    nav: false
                },
                700: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: false
                }
            }
        });

        $(".carousel-promotion").owlCarousel({
            margin: 310,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 2,
                    nav: false
                },
                700: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: false
                }
            }
        });
    </script>


    <!-- <div class="testprin">day nè</div> -->

    <div class="container">
        <h2 class="pt-4"><i class="fa fa-camera-retro" aria-hidden="true"></i> Hoạt Động</h2>
        <p>Những bức ảnh tuyệt vời từ hoạt động của chúng tôi</p>
        <!-- <h1>Hoạt Động</h1> -->

        <div class="gallery" id="gallery">
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,care" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,studied" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,substance" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,choose" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,past" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,lamp" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,yet" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,eight" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,crew" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,event" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,instrument" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,practical" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,pass" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,bigger" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,number" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,feature" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,line" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,railroad" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,pride" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,too" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,bottle" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,base" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,cell" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,bag" alt=""></div>
            </div>
            <div class="gallery-item">
                <div class="content"><img src="https://source.unsplash.com/random/?tech,card" alt=""></div>
            </div>
        </div>
        <hr>
    </div>

    <script>
        var gallery = document.querySelector('#gallery');
        var getVal = function(elem, style) {
            return parseInt(window.getComputedStyle(elem).getPropertyValue(style));
        };
        var getHeight = function(item) {
            return item.querySelector('.content').getBoundingClientRect().height;
        };
        var resizeAll = function() {
            var altura = getVal(gallery, 'grid-auto-rows');
            var gap = getVal(gallery, 'grid-row-gap');
            gallery.querySelectorAll('.gallery-item').forEach(function(item) {
                var el = item;
                el.style.gridRowEnd = "span " + Math.ceil((getHeight(item) + gap) / (altura + gap));
            });
        };
        gallery.querySelectorAll('img').forEach(function(item) {
            item.classList.add('byebye');
            if (item.complete) {
                console.log(item.src);
            } else {
                item.addEventListener('load', function() {
                    var altura = getVal(gallery, 'grid-auto-rows');
                    var gap = getVal(gallery, 'grid-row-gap');
                    var gitem = item.parentElement.parentElement;
                    gitem.style.gridRowEnd = "span " + Math.ceil((getHeight(gitem) + gap) / (altura + gap));
                    item.classList.remove('byebye');
                });
            }
        });
        window.addEventListener('resize', resizeAll);
        gallery.querySelectorAll('.gallery-item').forEach(function(item) {
            item.addEventListener('click', function() {
                item.classList.toggle('full');
            });
        });
    </script>

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
                            <p class="grey-text">Chúng tôi cung cấp dịch vụ phân phối vào giao hàng tốt nhất và nhanh nhất trong khu vực trung tâm thị trấn Vũng Liêm, với công nghệ hiện đại dễ dàng giúp người tiêu dùng và người kinh doanh kết nối lại với nhau một cách hiệu quả và tiềm năng nhất.</p>

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
                <hr class="my-5">
            </div>
        </div>
    </main>
    <!--Main layout-->



    <!-- ##### New Arrivals Area End ##### -->

    <!-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0&appId=2524995901113133&autoLogAppEvents=1"></script>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<div class="fb-comments" data-href="https://www.facebook.com/photo.php?fbid=2498426717137072&set=a.1453659248280496&type=3&theater" data-numposts="5" data-width=""></div>
			</div>
		</div>
	</div> -->

</body>

<!--

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nối bật</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
                $product_featheread = $product->getproduct_featheread();
                if ($product_featheread) {
                    while ($result = $product_featheread->fetch_assoc()) {

                ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'], 50) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['price']) . " " . "VND" ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
                    }
                }
                ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản phẩm mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
            $product_new = $product->getproduct_new();
            if ($product_new) {
                while ($result_new = $product_new->fetch_assoc()) {

            ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
					 <h2><?php echo $result_new['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_new['product_desc'], 50) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result_new['price']) . " VND" ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
			<?php
                }
            }
            ?>
			</div>
    </div>
 </div>
 !-->
<!-- <div class="alert-box success notification">Successful Alert !!!</div>
    <div class="alert-box failure notification">Failure Alert !!!</div>
    <div class="alert-box warning notification">Warning Alert !!!</div> -->


<!-- js -->
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
</script>

<!-- 
<script>
    $(document).ready(function() {
        $('.submitpro').on('submit', function(e) {
            e.preventDefault();
            var productId = $(this).find('button').data('dataid');
            // alert(productId);

            $.ajax({
                type: "POST",
                url: "add_to_cart.php",
                data: {
                    'productId': productId
                },
                success: function(data) {
                    $(".testprin").html(data);
                }
            });
        });
    });
</script> -->
<script src="js/ajax_wishlist-and-cart.js"></script>
<script src="js/function.js"></script>