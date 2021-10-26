<?php
include 'inc/header.php';
Session::set('REQUEST_URI', getRequestUrl()); // lưu vị trí đường dẫn trang khi chưa đăng nhập
$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
	exit;
}
?>

<?php
// if (!isset($_GET['id'])) {
// 	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
// }
?>

<link rel="stylesheet" href="css/theme-general.css">
<link rel="stylesheet" href="css/cart.css">
<!-- jQuery Nice Number CSS -->
<link rel="stylesheet" href="css/jquery.nice-number.min.css">


<link rel="stylesheet" href="css/details.css">
<!-- jQuery Nice Number CSS -->
<link rel="stylesheet" href="css/scroll-box.css">
<style>
	.alert {
		display: none;
	}

	.alert-danger {
		display: none;
	}

	form#f_promo {
		padding-bottom: 15px;
	}

	.nice-number {
		padding-top: 0px;
	}


	.nice-number button {
		display: none;
		background-color: #82ca9c;
		box-shadow: 0 2px 5px rgb(0 0 0 / 22%);
		padding-top: 4px;
		padding-left: 11px;
	}

	.nice-number input {
		box-shadow: none;
		text-align: center;
		font-size: 1em;
		padding: .25em;
		margin: 1em .5em 0 0;
		border: 1px solid #e8e8e8;
		color: #000;
		border-radius: 0px;
		padding-left: 5px;
		padding-right: 5px;
	}

	.nice-select {
		-webkit-tap-highlight-color: transparent;
		background-color: #fff;
		border-radius: 0px !important;
		border: solid 1px #e8e8e8;
		box-sizing: border-box;
		/* clear: both; */
		/* cursor: pointer; */
		/* display: block; */
		float: left;
		font-family: inherit;
		font-size: 10px;
		font-weight: normal;
		height: 31px;
		line-height: 28px;
		outline: none;
		padding-left: 8px;
		padding-right: 24px;
		position: relative;
		text-align: left !important;
		-webkit-transition: all 0.2s ease-in-out;
		transition: all 0.2s ease-in-out;
		-webkit-user-select: none;
		-moz-user-select: none;
		margin-top: 12px;
		margin-right: 6px;
	}

	.nice-select:focus {
		box-shadow: rgb(0 0 0 / 50%) 0px 2px 5px;
		border: 1px solid rgba(33, 37, 41, 0);
		border-radius: 5px !important;
	}

	span.current {
		color: #000;
	}

	input.input-quantitys:focus {
		box-shadow: 0 2px 5px rgb(0 0 0 / 50%);
		border: 1px solid rgb(33 37 41 / 0%);
		border-radius: 5px;
	}

	input.input-quantitys:out-of-range {
		box-shadow: none;
		border: 1px solid #212529c2;
		border-radius: 0px;
	}
</style>

<div class="wrap cf">
	<h1 class="projTitle">MUA SẮN THỎA THÍCH<span>-cùng</span> Kabi Store</h1>
	<div class="heading cf">
		<h1>Giỏ Hàng</h1>
		<a href="index.html" class="continue">Tiếp Tục Mua Sắm</a>
	</div>
	<div class="cart">
		<!--    <ul class="tableHead">
      <li class="prodHeader">Product</li>
      <li>Quantity</li>
      <li>Total</li>
       <li>Remove</li>
	</ul>-->

		<?php
		// if (isset($update_quantity_Cart)) {
		// 	echo $update_quantity_Cart;

		?>

		<?php
		// if (isset($delcart)) {
		// 	echo $delcart;
		// }
		?>

		<?php
		$get_price_ship = $ct->get_price_ship();
		while ($result_price = $get_price_ship->fetch_assoc()) {
			$price_ship = $result_price['price'];
		}
		$i = 0;
		$subtotal = 0;
		$ship = 0;
		// Khởi tạo session cho mỗi lần truy cập
		$disable_check_out = 0;
		$customer_id = Session::get('customer_id');
		$get_product_cart = $ct->get_product_cart($customer_id);
		if ($get_product_cart) {
			Session::set('payment', true);
			while ($result = $get_product_cart->fetch_assoc()) {
				$cartId = $result['cartId'];
				$productId = $result['productId'];
				$quantity = $result['quantity'];
				$price = $result['price'];
				$product_img =  json_decode($result['image']);
				$product_img = $product_img[0]->image;
		?>
				<ul class="cartWrap" data-id-1="<?php echo $cartId; ?>" data-id-2="<?php echo $productId ?>" data-id-3="<?php echo $result['price'] ?>">
					<li class="items odd">
						<div class="infoWrap">
							<div class="cartSection">
								<img data-src="<?php echo $product_img ?>" alt="" class="lazy itemImg" />
								<p class="itemNumber"><small>#<?php echo $result['product_code'] ?></small></p>
								<h3 class="name-cart"><?php echo $result['productName'] ?></h3>
								<!-- <input type="text" class="qty" id="qty1_<?php echo $cartId; ?>" value="<?php echo $quantity ?>" /> -->
								<p class="mb-0">
									<?php if ($result['productSize'] != 0) { ?>
										<select name="product-size" id="product-size">
											<option value="4" <?php echo ($result['productSize'] == 4) ? 'selected="selected"' : "" ?>>Size: XL</option>
											<option value="3" <?php echo ($result['productSize'] == 3) ? 'selected="selected"' : "" ?>>Size: X</option>
											<option value="2" <?php echo ($result['productSize'] == 2) ? 'selected="selected"' : "" ?>>Size: M</option>
											<option value="1" <?php echo ($result['productSize'] == 1) ? 'selected="selected"' : "" ?>>Size: S</option>
										</select>
									<?php } ?>
									<input class="input-quantitys" type="number" class="buyfield" name="quantity" value="<?php echo $quantity ?>" min="1" max="10" />&nbsp; x <?php echo $fm->format_currency($result['price']) . " ₫" ?>
								</p>

								<?php if ($result['product_remain'] <= $quantity) {
								?>
									<p class="stockStatus-out"> Hết hàng</p>
								<?php
									$disable_check_out = 1; // chỉ cần 1 đơn hàng hết hàng thì = true ko cho phét thanh toán 
								} ?>

							</div>
							<div class="prodTotal cartSection">
								<p>
									<?php
									$total = $price * $quantity;
									echo $fm->format_currency($total) . " ₫";
									?>
								</p>
							</div>
							<div class="cartSection removeWrap">
								<a class="remove" id="remove-cart" href="#">x</a>
							</div>
						</div>
					</li>
					<!--<li class="items even">Item 2</li>-->
				</ul>
		<?php
				$cart = array();
				$cart = ['price' => $price];
				$_SESSION['cart'][$cartId] = $cart;

				$ship = $ship + $quantity * $price_ship;
				$subtotal += $total;
			}
		} else {
			Session::set('payment', false);
		}

		if ($disable_check_out == 1) {
			Session::set('disable_check_out', 1);
		} else {
			Session::set('disable_check_out', 0);
		}
		?>
	</div>
	<?php
	$check_cart = $ct->check_cart($customer_id);
	if ($check_cart) {
		$discount = 0;
	?>
		<div class="promoCode">
			<label for="promo">Mã Giảm Giá</label>
			<form id="f_promo">
				<input type="text" id="promotion_code" />
				<button type="submit" class="btn btn-success" id="discount"></button>
			</form>
			<div class="alert alert-danger" id="error-promo">
				<strong>Cảnh báo!</strong> Đơn hàng đang hết hàng. Vui lòng chỉnh sửa lại số lượng hoặc xóa đơn hàng! <a href="#location-group" class="alert-link">Sửa lỗi</a>.
			</div>
			<div class="alert alert-success" id="success-promo" role="alert">
				<strong>Cảnh báo!</strong> Đơn hàng đang hết hàng. Vui lòng chỉnh sửa lại số lượng hoặc xóa đơn hàng! <a href="#location-group" class="alert-link">Sửa lỗi</a>.
			</div>
		</div>
		<form id="f_cart" method="POST" action="checkout.html" enctype="multipart/form-data">
			<div class="subtotal cf">
				<ul>
					<li class="totalRow"><span class="label">Tạm Tính:</span><span class="value"><?php echo $fm->format_currency($subtotal) . " ₫";
																									Session::set('sum', $subtotal);
																									Session::set('ship', $ship);
																									?></span></li>
					<li class="totalRow"><span class="label">phí giao hàng:</span><span class="value"><?php echo "+ " . $fm->format_currency($ship) . " ₫"; ?></span></li>
					<li class="totalRow final"><span class="label">Tổng Cộng:</span><span class="value"><?php
																										// $vat = $subtotal * 0.1;
																										$grandTotal = $subtotal + $ship;
																										echo $fm->format_currency($grandTotal - $discount) . " ₫";
																										?></span></li>
					<li class="totalRow">
						<button type="submit" id="btn_checkout" name="cartcheckout" class="btn success-cart">Xác nhận giỏ hàng</button>
					</li>
					<li class="errorRow"></li>
				</ul>
			</div>
		</form>
	<?php
	} else {
		echo '
 			<div class="container">
				<div class="row">
					<div class="col-12">
						<p>Giỏ của bạn đang trống! Hãy nhấn vào nút giỏ hàng <i class="fa fa-cart-plus" aria-hidden="true"></i> để đưa sản phẩm vào thanh toán. Hãy mua sắm ngay bây giờ.</p>
					</div>
				</div>
	 		</div>';
	}
	?>
</div>


<script>
	// Remove Items From Cart
	// $('a.remove').click(function() {
	// 	event.preventDefault();
	// 	$(this).parent().parent().parent().hide(400);

	// })

	// Just for testing, show all items
	// $('a.btn.continue').click(function() {
	// 	$('li.items').show(400);
	// });
</script>


<?php
include 'inc/footer.php';
?>

<!-- jQuery Nice Number JS -->
<script src="js/jquery.nice-number.js"></script>
<script src="js/nice-number.js"></script>
<script>
	var promotiontAllow = 1;
	var disable_check_out = <?php echo $disable_check_out ?>;
	var promoCode = "";
</script>
<script src="js/cart.js"></script>
<!-- <script src="js/ajax_wishlist-and-cart.js"></script> -->

<script>
</script>