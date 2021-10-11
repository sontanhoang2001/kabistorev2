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



<link rel="stylesheet" href="css/details.css">
<!-- jQuery Nice Number CSS -->
<link rel="stylesheet" href="css/jquery.nice-number.min.css">
<script src="js/audio-message.js"></script>

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
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#home">Chi tiết sản phẩm</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#menu1">Đánh giá sản phẩm</a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
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
					</div>
				</div>
			</div>
			<div id="menu1" class="container tab-pane fade"><br>
				<div class="row">
					<div class="col-12">
						<div class="fb-comments" data-href="https://webcuatoi.vn/kabistore/details.php?proid=<?php echo $productid; ?>" data-width="100%" data-numposts="10"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=633481687507433&autoLogAppEvents=1" nonce="VT6UQdfg"></script>



<?php
include 'inc/footer.php';
?>

<!-- Dependencies -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

<!-- jQuery Nice Number JS -->
<script src="js/jquery.nice-number.js"></script>
<script src="js/nice-number.js"></script>
<script src="js/ajax_wishlist-and-cart.js"></script>