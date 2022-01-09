<?php
include 'inc/header.php';
include 'config/global.php';

Session::set('REQUEST_URI', getRequestUrls(0)); // lưu vị trí đường dẫn trang khi chưa đăng nhập
$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
	exit;
}
$discount = session::set('discountMoney', 0);

// if (!isset($_GET['id'])) {
// 	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
// }
?>

<!-- jQuery Nice Number CSS -->
<link rel="stylesheet" href="css/jquery.nice-number.min.css">

<!-- jQuery Nice Number CSS -->
<link rel="stylesheet" href="css/scroll-box.css">

<div class="wrap cf">
	<h1 class="projTitle">MUA SẮM THỎA THÍCH<span>-cùng</span> Kabi Store</h1>
	<div class="heading cf">
		<h1>Giỏ Hàng</h1>
		<div class="pull-right">
			<a href="san-pham-f0p1t0smem.html" class="btn btn-info text"><small>Tiếp Tục Mua Sắm </small> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
		</div>
	</div>
	<div class="cart">
		<!--    <ul class="tableHead">
			<li class="prodHeader">Product</li>
			<li>Quantity</li>
			<li>Total</li>
			<li>Remove</li>
			</ul>-->

		<?php
		$i = 0;
		$quantityTotal = 0;
		// tiền ship tối đa
		// Cộng thêm mỗi đơn hàng
		$shipAdd = 3500;
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
								<a href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html">
									<img data-src="<?php echo $product_img ?>" alt="" class="lazy itemImg" />
								</a>
								<p class="itemNumber" style="margin-top: 0px"><small>#<?php echo $result['product_code'] ?></small></p>
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
								<p id="rowTotalPrice">
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
				$quantityTotal =  (int)$quantityTotal + (int)$quantity;
				$cart = array();
				$cart = ['price' => $price];
				$_SESSION['cart'][$cartId] = $cart;
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
		Session::set('quantityTotal', $quantityTotal);
		// $ship =  (int)$price_ship + (int)$shipAdd * ((int)$quantityTotal - 1);

		?>
	</div>

	<div class="row" style="margin-right: -4px; margin-left: -4px;" id="payGroup">
		<?php
		$check_cart = $ct->check_cart($customer_id);
		if ($check_cart) {
			$discount = 0;
		?>
			<div class="col-lg-6">
				<form id="f_promo">
					<div class="p-4">
						<p class="font-italic mb-4">Hãy sưu tập mã giảm giá và dán vào đây để áp dụng ưu đãi ngay đi nào!</p>
						<div class="input-group mb-4 border rounded-pill p-2">
							<input type="text" placeholder="mã giảm giá..." aria-describedby="button-addon3" class="form-control border-0" id="promotion_code">
							<div class="input-group-append border-0">
								<button type="submit" class="btn btn-dark px-4 rounded-pill" id="discount"><i class="fa fa-gift mr-2" aria-hidden="true"></i>Áp dụng</button>
							</div>
						</div>
						<div class="alert alert-success" id="success-promo" role="alert">
						</div>
						<div class="alert alert-danger" id="error-promo">
						</div>
					</div>
				</form>
				<!-- <p class="font-italic mb-4">Lưu ý: Shop sẽ check vị trí của Khách hàng để giảm phí giao hàng xuống mức thấp nhất có thể và gửi hóa đơn cho bạn trước khi giao hàng.</p> -->
			</div>

			<div class="col-lg-6">
				<div class="p-4">
					<form id="f_cart" method="POST" action="checkout.html" enctype="multipart/form-data">

						<ul class="list-unstyled mb-4" id="totalPay">
							<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tạm tính</strong><strong id="subtotal">
									<?php echo $fm->format_currency($subtotal) . " ₫";
									Session::set('sum', $subtotal);
									Session::set('ship', $ship);
									?></strong></li>

							<li class="d-flex justify-content-between py-3 border-bottom none"><strong class="text-muted">Giảm giá</strong><strong id="discountPrice">Chưa nhập mã</strong></li>
							<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tổng cộng</strong>
								<h5 class="font-weight-bold" id="total">
									<?php
									// $vat = $subtotal * 0.1;
									$grandTotal = $subtotal + $ship;
									echo $fm->format_currency($grandTotal - $discount) . " ₫";
									?>
								</h5>
							</li>
						</ul>
						<button name="cartcheckout" id="btn_checkout" class="btn btn-dark rounded-pill py-2 btn-block">Đi đến thanh toán</button>
					</form>
					<div class="mt-4">
						<li class="errorRow"></li>
					</div>
				</div>
			</div>
		<?php
		} else {
			echo '
 			<div class="container">
				<div class="row">
					<div class="col-12">
						<p class="mb-5">Giỏ của bạn đang trống! Hãy nhấn vào nút giỏ hàng <i class="fa fa-cart-plus" aria-hidden="true"></i> để đưa sản phẩm vào thanh toán. Hãy mua sắm ngay bây giờ.</p>
					</div>
				</div>
	 		</div>';
		}
		?>
	</div>
</div>

<?php
include 'inc/footer.php';
?>
<script src="js/function.js"></script>

<!-- jQuery Nice Number JS -->
<script src="js/jquery.nice-number.js"></script>
<script src="js/nice-number.js"></script>
<script>
	var promotiontAllow = 1;
	var disable_check_out = <?php echo $disable_check_out ?>;
	var promoCode = "";
</script>
<script src="js/audio-message.js"></script>
<script src="js/cart.js"></script>