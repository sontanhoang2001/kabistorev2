<?php
include 'inc/header.php';
include 'config/global.php';
include 'config/brandLocaltion.php';

Session::set('REQUEST_URI', getRequestUrls()); // lưu vị trí đường dẫn trang khi chưa đăng nhập

$login_check = Session::get('customer_login');
if ($login_check) {
	$customer_id = Session::get('customer_id');
} else {
	$customer_id = 0;
}

if (!isset($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	// LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
	$search_text = $_GET['key'];
	$search_product = $product->search_product($search_text, $page, $product_num); // hàm check catName khi submit lên
	$get_amount_search_product = $product->get_amount_search_product($search_text);
	$result = $get_amount_search_product->fetch_assoc();
	$product_count = $result['totalRow'];
}
?>
<link rel="stylesheet" href="css/pagination.css">

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
	<div class="container h-100">
		<div class="row h-100 align-items-center">
			<div class="col-12">
				<div class="page-title text-center">
					<h2>Tìm những thứ bạn cần</h2>
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
												<li><a class="<?php echo ($filter == "c" && $type == $catId) ? 'font-weight-bold' . $categorySelected = $catName : '' ?>" href="<?php echo $fm->vn_to_str($catName) ?>-fcp1t<?php echo $catId ?>smem.html"><?php echo $catName ?></a></li>
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
									<h6 class="widget-title mb-2">Thương hiệu</h6>
									<!-- <a href="#">Tất cả</a> -->
									<ul class="sub-menu collapse show" id="brand">
										<?php
										$brand_featheread = $bra->show_brand();
										if ($brand_featheread) {
											while ($result = $brand_featheread->fetch_assoc()) {
												$brandId = $result['brandId'];
												$brandName = $result['brandName']
										?>
												<li><a class="<?php echo ($filter == "b" && $type == $brandId) ? 'font-weight-bold' . $brandSelected = $brandName : ''; ?>" href="<?php echo  $fm->vn_to_str($brandName) ?>-fbp1t<?php echo $brandId ?>smem.html"><?php echo $brandName ?></a></li>
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
			if ($get_amount_search_product) {
				$numrow = $product_count;
			} else {
				$numrow = 0;
			}
			?>
			<div class="col-12 col-md-8 col-lg-9">
				<div class="shop_grid_product_area">
					<div class="row">
						<div class="col-12">
							<div class="product-topbar d-flex align-items-center justify-content-between">
								<!-- Total Products -->
								<div class="total-products">
									<h5>Từ khóa tìm kiếm: <?php echo $search_text ?></h5>
									<p><span><?php echo $numrow; ?></span> Sản Phẩm</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row" id="wrapper_product">
						<?php
						$seo = "-re-nhat-can-tho";
						if ($search_product) {
							while ($result = $search_product->fetch_assoc()) {
								$productId = $result['productId'];
								$product_img =  json_decode($result['image']);
								$product_img = $product_img[0]->image;
								$out_of_stock = $result['out_of_stock'];

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
								<div class="col-6 col-sm-6 col-lg-4">
									<!-- Single Product -->
									<div class="single-product-wrapper page-product bg-white rounded shadow-sm">
										<!-- Product Image -->
										<div class="product-img page-product">
											<img src="img/core-img/best-loader.gif" data-src="<?php echo $product_img ?>" class="lazy" data-status="0">
											<ul class="card-button-shop">
												<?php if ($out_of_stock != 1) { ?>
													<li>
														<img style="width: 1px; height: 1px" class="img-clone" data-src="<?php echo $product_img ?>" data-status="0" />
														<a class="add-btn-product add_to_cart" data-productid="<?php echo $productId ?>" data-tip="Thêm vào giỏ" data-size="<?php echo $size ?>" data-color="<?php echo $color ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
													</li>
												<?php } ?>
												<?php
												$wishlist_check = $product->wishlist_check($customer_id, $productId);
												$login_check = Session::get('customer_login');
												if ($login_check == true && $out_of_stock != 1) {
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
												if (isset($_COOKIE['shopping_wishlist']) && $login_check == false && $out_of_stock != 1) {
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
													if ($login_check == false && $out_of_stock != 1) {
													?>
														<li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" data-productid="<?php echo $productId ?>"></i></a></li>
												<?php
													}
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
										</div>
										<!-- Product Description -->
										<div class="product-description">
											<a href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName'])  . $seo ?>.html">
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
											<div class="sell-out page-product">
												<?php if ($result['out_of_stock'] != 1) { ?>
													<div class="sell-out page-product"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo localBrandId($result['brandId']); ?> &nbsp;<i class="fa fa-bolt" aria-hidden="true"></i> Đã bán <?php echo $result['product_soldout'] ?></div>
												<?php } else {
												?>
													<i class="fa fa-hourglass-end" aria-hidden="true"> Tạm hết hàng</i>
												<?php
												} ?>
											</div>
											</p>
										</div>
									</div>
								</div>
						<?php
							}
						} else {
							echo '<div class="m-3">Không có sản phẩm nào được tìm thấy!</div>';
						}
						?>
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
		</div>
	</div>
</section>
<div class="fixed" id="message"></div>

<!-- ##### Shop Grid Area End ##### -->


<?php
include 'inc/footer.php';
?>

<script src="js/function.js"></script>
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
			location.href = "search.html?key=<?php echo $search_text ?>&page=" + page;
		});
	});
</script>