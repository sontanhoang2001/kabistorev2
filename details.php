<?php
include 'inc/header.php';
// include 'inc/slider.php';

if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
	echo "<script> window.location = '404.php' </script>";
} else {
	$productid = $_GET['proid']; // Lấy productid trên host
}

$login_check = Session::get('customer_login');
if ($login_check) {
	$customer_id = Session::get('customer_id');
} else {
	$customer_id = 0;
}

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
// 	// LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
// 	$insertWishlist = $product->insertWishlist($productid, $customer_id); // hàm check catName khi submit lên
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
// 	// LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
// 	$quantity = $_POST['quantity'];
// 	$customer_id = Session::get('customer_id');

// 	if (isset($_SESSION['cart'])) {
// 		$cart = $_SESSION['cart'];
// 		$element = count($cart);
// 	} else {
// 		$element = 0;
// 	}

// 	Session::set('PHP_SELF', $PHP_SELF = substr($_SERVER['REQUEST_URI'], 18)); // lưu vị trí đường dẫn trang khi chưa đăng nhập

// 	if ($customer_id == null) {
// 		echo "<script> window.location = 'login.php' </script>";
// 	} else {
// 		$insertCart = $ct->add_to_cart($productid, $quantity, $element); // hàm check catName khi submit lên
// 	}
// }


?>
<script src="js/audio-message.js"></script>
<style>
	.alert {
		display: none;
	}

	.alert-danger {
		display: none;
	}
</style>
<link rel="stylesheet" href="css/details.css">
<!-- jQuery Nice Number CSS -->
<link rel="stylesheet" href="css/jquery.nice-number.min.css">

<body>
	<!-- ##### Right Side Cart Area ##### -->
	<!-- <div class="cart-bg-overlay"></div> -->

	<!-- <div class="right-side-cart-area">
		Cart Button
		<div class="cart-button">
			<a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""> <span>3</span></a>
		</div>

		<div class="cart-content d-flex">

			Cart List Area
			<div class="cart-list">
				Single Cart Item
				<div class="single-cart-item">
					<a href="#" class="product-image">
						<img src="img/product-img/product-1.jpg" class="cart-thumb" alt="">
						Cart Item Desc
						<div class="cart-item-desc">
							<span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
							<span class="badge"></span>
							<h6>Button Through Strap Mini Dress</h6>
							<p class="size">Size: S</p>
							<p class="color">Color: Red</p>
							<p class="price">$45.00</p>
						</div>
					</a>
				</div>

				Single Cart Item
				<div class="single-cart-item">
					<a href="#" class="product-image">
						<img src="img/product-img/product-2.jpg" class="cart-thumb" alt="">
						Cart Item Desc
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

				Single Cart Item
				<div class="single-cart-item">
					<a href="#" class="product-image">
						<img src="img/product-img/product-3.jpg" class="cart-thumb" alt="">
						Cart Item Desc
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

			Cart Summary
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
	</div> -->
	<!-- ##### Right Side Cart End ##### -->

	<!-- ##### Single Product Details Area Start ##### -->
	<?php
	$get_product_details = $product->get_details($productid);
	if ($get_product_details) {
		while ($result_details = $get_product_details->fetch_assoc()) {
			# code...

	?>
			<section class="single_product_details_area d-flex align-items-center">
				<!-- Single Product Thumb -->
				<div class="single_product_thumb">
					<div class="product_thumbnail_slides owl-carousel">
						<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="">
						<img src="img/product-img/product-big-2.jpg" alt="">
						<img src="img/product-img/product-big-3.jpg" alt="">
					</div>
				</div>

				<!-- Single Product Description -->
				<div class="single_product_desc clearfix">
					<!-- Swiper -->
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<span><?php echo $result_details['brandName'] ?></span>
								<div class="fb-like" data-href="https://webcuatoi.vn/kabistore/details.php?proid=<?php echo $productid ?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
								<a href="cart.html">
									<h4><?php echo $result_details['productName'] ?></h4>
								</a>
								<p class="product-price"><span class="old-price mr-1"><?php echo $result_details['old_price'] . " ₫" ?></span> <?php echo $fm->format_currency($result_details['price']) . "	 ₫" ?></p>
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
												<option value="0">Size: Không</option>
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
												echo '<button class="add_to_wishlist_details heart wishlist-btn btn-add is-active"></button>';
											} else {
												echo '<button class="add_to_wishlist_details heart wishlist-btn btn-add"></button>';
											}
										}
										?>
										<?php
										if (isset($insertWishlist)) {
											echo $insertWishlist;
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
								<?php
								if (isset($insertCart)) {
									echo $insertCart;
								}
								?>
								</form>
							</div>

							<div class="swiper-slide">
								<div class="main">
									<div class="content">
										<div class="section group">
											<?php
											$get_product_details = $product->get_details($productid);
											if ($get_product_details) {
												while ($result_details = $get_product_details->fetch_assoc()) {

											?>
													<h5>Chi tiết sản phẩm</h5>
													<div class="descriptionBox">
														<p><?php echo $result_details['product_desc'] ?></p>
													</div>

										</div>
								<?php
												}
											}
								?>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="container">
									<div class="row">
										<div class="col-12">
											<h5>Đánh giá sản phẩm</h5>
											<!-- <form action="index.php" method="POST">
													<p><input type="hidden" value="<?php echo $productid ?>" name="product_id_binhluan"></p>
													<p><input type="text" class="form-control" name="ten_nguoibinhluan" placeholder="Điền tên">
													<p>
													<p><textarea rows="5" style="resize: none;" class="form-control" name="noi_dung_binhluan" placeholder="Bình luận"></textarea>
													<p>
													<p><input type="submit" class="btn btn-success" name="binhluan_submit" value="Gửi bình luận"></p>
												</form> -->
											<div class="fb-comments" data-href="https://webcuatoi.vn/kabistore/details.php?proid=<?php echo $productid; ?>" data-width="100%" data-numposts="5"></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Add Pagination -->
						<div class="swiper-pagination"></div>

						<!-- Add Arrows -->
						<!-- <div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div> -->
					</div>
				</div>
				<!-- Cart -->
			</section>
	<?php
		}
	}
	?>
	<!-- ##### Single Product Details Area End ##### -->
	</div>
</body>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=633481687507433&autoLogAppEvents=1" nonce="VT6UQdfg"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<!-- Demo styles -->
<style>
	.swiper-container {
		width: 100%;
		height: 100%;
		padding: 0px;
		margin-top: -22px;
	}

	.swiper-slide {
		background-position: center;
		background-size: cover;
		width: 100%;
		height: 100%;
	}

	.swiper-container-horizontal>.swiper-pagination-bullets,
	.swiper-pagination-custom,
	.swiper-pagination-fraction {
		bottom: 200px;
		left: 100%;
		width: 1%;
	}

	.single_product_details_area .single_product_desc span {
		font-size: 14px;
		text-transform: none;
		font-weight: 600;
		color: #787878;
		margin-bottom: 10px;
		display: block;
	}

	.swiper-horizontal>.swiper-pagination-bullets,
	.swiper-pagination-bullets.swiper-pagination-horizontal,
	.swiper-pagination-custom,
	.swiper-pagination-fraction {
		z-index: 0;
		bottom: -35px !important;
		padding-left: 42%;
	}

	.swiper-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet,
	.swiper-pagination-horizontal.swiper-pagination-bullets .swiper-pagination-bullet {
		float: left;
	}
</style>

<!-- Initialize Swiper -->
<script>
	var swiper = new Swiper('.swiper-container', {
		effect: 'flip',
		grabCursor: true,
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
	});
</script>


<?php
include 'inc/footer.php';
?>

<!-- Dependencies -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

<!-- jQuery Nice Number JS -->
<script src="js/jquery.nice-number.js"></script>
<script src="js/nice-number.js"></script>

<script type="text/javascript">
	var toancuc = 0;
	$(document).ready(function() {
		$("#xemthem").click(function() {
			toancuc = toancuc + 1;
			$.get("page_ajax.php", {
					page: toancuc
				},
				function(data) {
					$(".list-Product").html(data);
				});
		});
	});
</script>
<script src="js/ajax_wishlist-and-cart.js"></script>