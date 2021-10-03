<?php
include 'inc/header.php';
Session::set('REQUEST_URI', getRequestUrl()); // lưu vị trí đường dẫn trang khi chưa đăng nhập

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
}

// if (isset($_GET['proid'])) {
// 	$customer_id = Session::get('customer_id');
// 	$proid = $_GET['proid'];
// 	$delwlist = $product->del_wlist($proid, $customer_id);
// }
?>

<?php
// if (!isset($_GET['id'])) {
// 	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
// }
?>

<link rel="stylesheet" href="css/cart.css">
<link rel="stylesheet" href="css/message.css">

<div class="wrap cf">
	<h1 class="projTitle">MUA SẮN THỎA THÍCH<span>-cùng</span> Kabi Store</h1>
	<div class="heading cf">
		<h1>Yêu Thích</h1>
		<a href="index" class="continue">Tiếp Tục Mua Sắm</a>
	</div>
	<div class="cart">
		<?php
		$customer_id = Session::get('customer_id');
		$get_wishlist = $product->get_wishlist($customer_id);
		if ($get_wishlist) {
			$i = 0;
			while ($result = $get_wishlist->fetch_assoc()) {
				$productId = $result['productId'];
				$seo = $result['seo'];
				$old_price = $result['old_price'];
				$i++;
		?>
				<ul class="cartWrap" id="row_product_<?php echo $productId ?>">
					<li class="items odd">
						<div class="infoWrap">
							<div class="cartSection">
								<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" class="itemImg" />
								<p class="itemNumber"><small>#QUE-007544-002</small></p>
								<a href="details/<?php echo $productId ?>/<?php echo $seo ?>.html">
									<h3><?php echo $result['productName'] ?></h3>
								</a>
								<small class="old-price"><?php echo ($old_price == 0) ? $old_price : '' ?></small>
								<p class="p-price"> <?php echo $fm->format_currency($result['price']) . ' ₫' ?></p>
								<!-- <button class="btn btn-succes btn-buy" onclick="window.location.href='details/<?php echo $productId ?>/<?php echo $seo ?>.html'"><i class="fa fa-shopping-cart" aria-hidden="true"> Mua ngay</i></button> -->
							</div>
							<div class="cartSection removeWrap">
								<a class="remove" id="remove-wishlist" href="<?php echo $productId ?>">x</a>
							</div>
						</div>
					</li>
					<!--<li class="items even">Item 2</li>-->
				</ul>
		<?php
			}
		}
		?>
		<hr>
	</div>
</div>
<div class="fixed" id="message"></div>

<?php
include 'inc/footer.php';
?>
<script src="js/ajax_wishlist-and-cart.js"></script>
<script src="js/audio-message.js"></script>