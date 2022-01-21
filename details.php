<?php
include 'inc/header.php';
include 'config/global.php';

if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
	echo "<script>
	window.location = '404.php'
</script>";
} else {
	$productid = $_GET['proid']; // Lấy productid trên host
}

$login_check = Session::get('customer_login');
if ($login_check) {
	$customer_id = Session::get('customer_id');
} else {
	$actual_link = $_SERVER['REQUEST_URI'];
	Session::set('REQUEST_URI', $actual_link);
	$customer_id = 0;
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
	<meta property="og:title" content="<?php echo $productName ?>" />
	<meta property="og:description" content="⭐⭐⭐⭐⭐ Đánh giá: CHẤT LƯỢNG VIỆT ✅ 🛒 - Nhấn vào liên kết để kiểm tra tình trạng của sản phẩm. Đặt hàng nhanh tức thì chỉ bằng một liên kết..." />
	<meta property="og:url" content="<?php echo $seoUrl ?>">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="600">
	<meta property="og:image:height" content="600">
	<meta property="og:image" content="<?php echo $product_img ?>">
	<meta property="og:image:secure_url" content="<?php echo $product_img ?>" />
<?php }

include 'inc/facebookPlugin.php';
?>
<link rel="stylesheet" href="css/details.css">

<!-- <link rel="stylesheet" href="css/index.css"> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">


<body>
	<!-- ##### Single Product Details Area Start ##### -->
	<?php
	if ($get_product_details) {
	?>
		<section class="single_product_details_area d-flex align-items-center">
			<!-- Single Product Thumb -->
			<div class="single_product_thumb">
				<div class="product_thumbnail_slides owl-carousel">
					<?php foreach ($product_imgJson as $product_img) { ?>
						<img id="img-detaild" src="img/core-img/best-loader.gif" data-src="<?php echo $product_img->image ?>" data-status="0">
					<?php
					}  ?>
				</div>
			</div>

			<!-- Single Product Description -->
			<div class="single_product_desc clearfix">
				<span><?php echo $result_details['brandName'] ?></span>
				<div class="fb-like" data-href="https://kabistore.com.vn/details/<?php echo $productid ?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
				<h4><?php echo $productName ?></h4>
				<p class="product-price"><span class="old-price mr-1">
						<?php if ($old_price != 0) {
							echo $fm->format_currency($result_details['old_price']) . " ₫";
						}
						?>
					</span> <?php echo $fm->format_currency($result_details['price']) . "	 ₫" ?></p>
				<?php if ($productType != 9) { ?>

					<form id="cartSubmit" method="POST">
						<!-- Select Box -->
						<div class="select-box d-flex mb-15">
							<?php
							$result_size = $result_details['size'];
							$result_color = $result_details['color'];

							if ($result_size != null) {
								$result_size =  json_decode($result_size);
							?>
								<select name="select" id="productSize" class="mr-2">
									<?php
									foreach ($result_size as $value) {
										switch ($value->size) {
											case 1:
												$size = "S";
												break;
											case 2:
												$size = "M";
												break;
											case 3:
												$size = "X";
												break;
											case 4:
												$size = "XL";
												break;
											case 5:
												$size = "Freesize";
												break;
										}
									?>
										<option value="<?php echo $value->size ?>"><?php echo ($value->size == 5) ? "Freesize" : "Size: " .  $size ?></option>
									<?php } ?>
								</select>
							<?php
							} else {
								$size = null;
							?>
								<select name="select" id="productSize" class="mr-2">
									<option value="0">Size: Không</option>
								</select>
							<?php }

							if ($result_color != null) {
								$result_color =  json_decode($result_color);
							?>
								<select name="select" id="productColor">
									<?php
									foreach ($result_color as $value) {
									?>
										<option value="<?php echo $value->color ?>">Màu: <?php echo $value->color ?></option>
									<?php }
									?>
								</select>
							<?php
							} else {
								$color = null;
							?>
								<select name="select" id="productColor">
									<option value="0">Màu: Không</option>
								</select>
							<?php } ?>
						</div>
						<div class="mb-3">
							<b class="mr-2">Số Lượng:</b>
							<input class="input-quantity" type="number" class="buyfield" name="quantity" id="quantity" value="1" min="1" max="10" require="required" />
						</div>
						<div id="error-qty"></div>
						<!-- Cart & Favourite Box -->
						<div class="cart-fav-box d-flex align-items-center mb-2">
							<!-- Cart -->
							<button type="submit" class="essence-btn btn-add btn btn-primary mr-2" id="add-to-cart" value="<?php echo $productid ?>"><i class="fa fa-cart-plus fa-2x" aria-hidden="true"></i> Mua ngay</button>

							<!-- Favourite -->
							<?php
							$wishlist_check = $product->wishlist_check($customer_id, $productid);
							// $compare_check = $product->compare_check($customer_id, $id);

							$login_check = Session::get('customer_login');
							if ($login_check) {
								if ($wishlist_check) {
									echo '<button class="add_to_wishlist_details heart wishlist-btn btn-add is-active" data-productId="' .  $productid . '"></button>';
								} else {
									echo '<button class="add_to_wishlist_details heart wishlist-btn btn-add" data-productId="' .  $productid . '"></button>';
								}
							}
							?>
						</div>
						<div id="error-submit"></div>
					</form>
				<?php } else {
				?>
					<div class="text-danger">Sản phẩm này đã ngưng kinh doanh</div>
				<?php
				} ?>
			</div>
			<!-- Cart -->
		</section>
	<?php
	}
	?>
	<!-- ##### Single Product Details Area End ##### -->
	</div>

	<div class="container mt-3">
		<!-- Nav tabs -->
		<ul class="nav nav-pills pills-dark mb-3" id="pills-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#home">Chi tiết sản phẩm</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#menu1">Đánh giá sản phẩm</a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content mb-5">
			<div id="home" class="container tab-pane active">
				<div class="row">
					<div class="col-12">
						<?php
						$get_product_details = $product->get_details($productid);
						if ($get_product_details) {
							while ($result_details = $get_product_details->fetch_assoc()) {
								if ($result_details['product_desc'] != null) {
						?>
									<div class=" descriptionBox mt-4">
										<p><?php echo $result_details['product_desc'] ?></p>
									</div>
								<?php
								} else {
								?>
									<p class="mt-5">Không có mô tả cho sản phẩm này.</p>
						<?php
								}
							}
						}
						?>
					</div>
				</div>
			</div>
			<div id="menu1" class="container tab-pane fade"><br>
				<div class="row">
					<div class="col-12">
						<div class="fb-comments" data-href="https://kabistore.com.vn/details/<?php echo $productId ?>" data-width="100%" data-numposts="10" data-lazy="true" data-mobile="true"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Gợi ý sp -->
	<div class="container mb-5">
		<h5 class="mb-5">Sản phẩm gợi ý cho bạn</h5>

		<!-- Swiper -->
		<div class="wrapper" id="wrapper_product">
			<div class="carousel-relatedProduct owl-carousel">
				<?php
				$get_relatedProduct = $product->get_relatedProduct($productid);
				if ($get_relatedProduct) {
					while ($result = $get_relatedProduct->fetch_assoc()) {
						$productId = $result['productId'];
						$product_img =  json_decode($result['image']);
						$product_img = $product_img[0]->image;
				?>
						<!-- Single Product -->
						<div id="single-product-wrapper" class="single-product-wrapper relatedProducts bg-white rounded shadow-sm" data-id-1="<?php echo $productId ?>">
							<!-- Product Image -->
							<div class="product-img relatedProducts">
								<img class="lazy" src="img/core-img/best-loader.gif" data-src="<?php echo $product_img ?>" data-status="0">
								<ul class="card-button-shop">
									<li>
										<img style="width: 1px; height: 1px" class="img-clone" data-src="<?php echo $product_img ?>" data-status="0" />
										<a class="add_to_cart fa fa-cart-plus" data-productid="<?php echo $productId ?>" data-tip="Thêm vào giỏ" data-id-1="<?php echo $result['size'] ?>"></a>
									</li>
									<?php
									$wishlist_check = $product->wishlist_check($customer_id, $productId);
									$login_check = Session::get('customer_login');
									if ($login_check) {
										if ($wishlist_check) {
									?>
											<li><a data-tip="Hủy yêu thích" class="add_to_wishlist heart fa fa-heart" style="background-position: inherit !important;" data-productid="<?php echo $productId ?>"></a></li>
										<?php
										} else {
										?>
											<li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" style="background-position: inherit !important" data-productid="<?php echo $productId ?>"></i></a></li>
										<?php
										}
									} else {
										?>
										<li><a data-tip="Thêm yêu thích" class="add_to_wishlist heart fa fa-heart-o" style="background-position: inherit !important" data-productid="<?php echo $productId ?>"></a></li>
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
								<a href="details/<?php echo $productId ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html">
									<div class="block-ellipsis text-dark"><?php echo $result['productName'] ?></div>
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
</body>

<script src="js/carousel.js"></script>
<?php
include 'inc/footer.php';
?>
<!-- <script src="js/jquery/jquery-2.2.4.min.js"></script> -->

<!-- jQuery Nice Number JS -->
<script src="js/jquery.nice-number.js"></script>
<link rel="stylesheet" href="css/jquery.nice-number.min.css">
<script src="js/nice-number.js"></script>

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