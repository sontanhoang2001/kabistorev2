<?php
include 'inc/header.php';
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
	echo "<script> window.location = '404.php' </script>";
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
	$get_product_details = $product->get_details($productid);
	if ($get_product_details) {
		$i = 0;
		while ($result_details = $get_product_details->fetch_assoc()) {
			$product_imgJson =  json_decode($result_details['image']);
			// echo count($product_img);
			// echo $product_img[$i]->image;
	?>
			<section class="single_product_details_area d-flex align-items-center">
				<!-- Single Product Thumb -->
				<div class="single_product_thumb">
					<div class="product_thumbnail_slides owl-carousel">
						<?php foreach ($product_imgJson as $product_img) { ?>
							<img src="<?php echo $product_img->image ?>">
						<?php
						}  ?>
					</div>
				</div>

				<!-- Single Product Description -->
				<div class="single_product_desc clearfix">
					<span><?php echo $result_details['brandName'] ?></span>
					<div class="fb-like" data-href="https://webcuatoi.vn/kabistore/details.php?proid=<?php echo $productid ?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
					<a href="cart.html">
						<h4><?php echo $result_details['productName'] ?></h4>
					</a>
					<p class="product-price"><span class="old-price mr-1"><?php echo  $fm->format_currency($result_details['old_price']) . " ₫" ?></span> <?php echo $fm->format_currency($result_details['price']) . "	 ₫" ?></p>
					<!-- <p><b>Loại sản phẩm:</b> <?php echo $result_details['catName'] ?></p> -->
					<!-- <p class="product-desc"><?php echo $fm->textShorten($result_details['product_desc'], 150) ?></p> -->
					<form id="cartSubmit">
						<!-- Select Box -->
						<div class="select-box d-flex mb-15">
							<?php if ($result_details['size'] != 0) { ?>
								<select name="select" id="productSize" class="mr-2">
									<option value="4">Size: XL</option>
									<option value="3">Size: X</option>
									<option value="2">Size: M</option>
									<option value="1" selected="selected">Size: S</option>
								</select>
							<?php } else { ?>
								<select name="select" id="productSize" class="mr-2">
									<option value="0">Size: Không</option>
								</select>
							<?php } ?>
							<select name="select" id="productColor">
								<option value="0">Màu: Không</option>
								<!-- <option value="value">Màu: Đen</option>
											<option value="value">Màu: Trắng</option>
											<option value="value">Màu: Đỏ</option> -->
							</select>
						</div>
						<div class="mb-3">
							<b class="mr-2">Số Lượng:</b>
							<input class="input-quantity" type="number" class="buyfield" name="quantity" id="quantity" value="1" min="1" max="10" require="required" />
						</div>
						<div id="error-qty"></div>
						<!-- Cart & Favourite Box -->
						<div class="cart-fav-box d-flex align-items-center mb-2">
							<!-- Cart -->
							<button type="submit" class="fa fa-cart-plus essence-btn btn-add mr-2" id="add-to-cart" value="<?php echo $productid ?>"> Thêm vỏ giỏ</button>

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
					<?php
					// if (isset($AddtoCart)) {
					// 	echo '<span style="color:red; font-size:18px;">Sản phẩm đã được bạn thêm vào giỏ hàng</span>';
					// }
					?>
					</form>
				</div>
				<!-- Cart -->
			</section>
	<?php
		}
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
						?>
								<div class=" descriptionBox mt-4">
									<p><?php echo $result_details['product_desc'] ?></p>
								</div>
						<?php
							}
						}
						?>

						<!-- <div class="mt-4 fb-post" data-href="https://www.facebook.com/ilovekabistore/posts/117390824018384/" data-width="750" data-show-text="true" data-lazy="true"></div> -->
					</div>
				</div>
			</div>
			<div id="menu1" class="container tab-pane fade"><br>
				<div class="row">
					<div class="col-12">
						<div class="fb-comments" data-href="https://webcuatoi.vn/kabistore/details.php?proid=<?php echo $productid; ?>" data-width="100%" data-numposts="10" data-lazy="true" data-mobile="true"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Swiper -->
	<div class="wrapper" id="wrapper_product">
		<div class="carousel-product owl-carousel">
			<?php
			$get_all_product_Featured = $product->get_all_product_Featured();
			if ($get_all_product_Featured) {
				while ($result = $get_all_product_Featured->fetch_assoc()) {
					$productId = $result['productId'];
					$product_img =  json_decode($result['image']);
					echo $product_img = $product_img[0]->image;
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
								<li><a data-tip="Chi tiết" href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html"><i class="fa fa-eye"></i></a></li>
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

	<div class="row">

		<!-- Gallery item -->
		<div class="col-xl-3 col-lg-4 col-md-6 mb-4">
			<div class="bg-white rounded shadow-sm"><img data-src="https://bootstrapious.com/i/snippets/sn-gallery/img-1.jpg" class="lazy img-fluid card-img-top" lazy>
				<div class="p-4">
					<h5> <a href="#" class="text-dark">Red paint cup</a></h5>
					<p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					<div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
						<p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPG</span></p>
						<div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End -->

		<!-- Gallery item -->
		<div class="col-xl-3 col-lg-4 col-md-6 mb-4">
			<div class="bg-white rounded shadow-sm"><img data-src="https://bootstrapious.com/i/snippets/sn-gallery/img-2.jpg" class="lazy img-fluid card-img-top" lazy>
				<div class="p-4">
					<h5> <a href="#" class="text-dark">Lorem ipsum dolor</a></h5>
					<p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					<div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
						<p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">PNG</span></p>
						<div class="badge badge-primary px-3 rounded-pill font-weight-normal">Trend</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End -->

		<!-- Gallery item -->
		<div class="col-xl-3 col-lg-4 col-md-6 mb-4">
			<div class="bg-white rounded shadow-sm"><img data-src="https://bootstrapious.com/i/snippets/sn-gallery/img-3.jpg" class="lazy img-fluid card-img-top" lazy>
				<div class="p-4">
					<h5> <a href="#" class="text-dark">Lorem ipsum dolor</a></h5>
					<p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					<div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
						<p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPG</span></p>
						<div class="badge badge-warning px-3 rounded-pill font-weight-normal text-white">Featured</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End -->

		<!-- Gallery item -->
		<div class="col-xl-3 col-lg-4 col-md-6 mb-4">
			<div class="bg-white rounded shadow-sm"><img data-src="https://bootstrapious.com/i/snippets/sn-gallery/img-4.jpg" class="lazy img-fluid card-img-top">
				<div class="p-4">
					<h5> <a href="#" class="text-dark">Lorem ipsum dolor</a></h5>
					<p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					<div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
						<p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPEG</span></p>
						<div class="badge badge-success px-3 rounded-pill font-weight-normal">Hot</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End -->
	</div>

	<a id="goBack" style="position: fixed; z-index: 2147483647;"><i style="margin-top: 10px;" class="fa fa-arrow-left" aria-hidden="true"></i></a>
</body>
<?php
include 'inc/footer.php';
?>
<script src="js/jquery/jquery-2.2.4.min.js"></script>

<!-- jQuery Nice Number JS -->
<script src="js/jquery.nice-number.js"></script>
<link rel="stylesheet" href="css/jquery.nice-number.min.css">
<script src="js/nice-number.js"></script>
<script src="js/ajax_wishlist-and-cart.js"></script>