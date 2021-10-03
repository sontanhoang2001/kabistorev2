<?php
include 'inc/header.php';

if (!isset($_GET['orderId']) || $_GET['orderId'] == NULL) {
	echo "<script> window.location = '404.php' </script>";
} else {
	$orderId = $_GET['orderId']; // Lấy productid trên host
}
?>
<?php
//    if(isset($_GET['cartid'])){
//        $cartid = $_GET['cartid']; 
//        $delcart = $ct->del_product_cart($cartid);
//    }

// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
//        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
//        $cartId = $_POST['cartId'];
//        $quantity = $_POST['quantity'];
//        $update_quantity_Cart = $ct -> update_quantity_Cart($cartId, $quantity); // hàm check catName khi submit lên
//    	if ($quantity <= 0) {
//    		$delcart = $ct->del_product_cart($cartId);
//    	}
//    } 
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
}
?>
<?php
if (isset($_GET['confirmid'])) {
	$id = $_GET['id'];
	$cusId = $_GET['confirmid'];
	$shifted_confirm = $ct->shifted_confirm($id, $cusId);
}
?>


<link rel="stylesheet" href="css/cart.css">

<br><br>

<div class="wrap cf">
	<div class="heading cf">
		<h1>Chi tiết đơn hàng</h1>
		<a href="index" class="continue">Tiếp Tục Mua Sắm</a>
	</div>
	<div class="cart">
		<?php
		if (isset($update_quantity_Cart)) {
			echo $update_quantity_Cart;
		}
		?>

		<?php
		if (isset($delcart)) {
			echo $delcart;
		}
		?>
		<?php
		$customer_id = Session::get('customer_id');
		$get_cart_ordered_detail = $ct->get_cart_ordered_detail($orderId, $customer_id);
		if ($get_cart_ordered_detail) {
			$i = 0;
			$qty = 0;
			while ($result = $get_cart_ordered_detail->fetch_assoc()) {
				$i++;
		?>
				<ul class="cartWrap">
					<li class="items odd">
						<div class="infoWrap">
							<div class="cartSection">
								<h5 class="numorder"><?php echo $i++; ?></h5>
								<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" class="itemImg" />
								<p class="itemNumber"><small>#QUE-007544-002</small>&nbsp;-&nbsp;<?php echo $fm->formatDate($result['date_order'])  ?></p>
								<h3><?php echo $result['productName'] ?></h3>
								<p class="p-price"> <?php echo $fm->format_currency($result['price']) . ' ₫' ?></p>
								<br>
								<?php
								if ($result['status'] == '0') {
								?>

									<td><?php echo 'Đang chờ xử lý...'; ?></td>

								<?php
								} elseif ($result['status'] == 1) {
								?>
									<td>
										<a href="?id=<?php echo $result['id']; ?>&confirmid=<?php echo $customer_id ?>">Nhận hàng</a>
									</td>
								<?php
								} else {
								?>
									<td><?php echo 'Đã nhận hàng'; ?></td>
								<?php
								}
								?>
								<!-- <button class="btn btn-succes btn-buy"> <i class="fa fa-shopping-cart" aria-hidden="true"> Mua ngay</i></button> -->
							</div>
							<div class="cartSection removeWrap">
								<a class="remove" href="?proid=<?php echo $result['productId'] ?>">x</a>
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
		<div class="subtotal cf">
			<ul>
				<li class="totalRow"><span class="label">Tạm Tính:</span><span class="value"><?php echo $fm->format_currency($subtotal) . " VND";
																								Session::set('sum', $subtotal);
																								Session::set('qty', $qty);
																								?></span></li>
				<li class="totalRow"><span class="label">VAT:</span><span class="value">10%</span></li>
				<li class="totalRow final"><span class="label">Tổng Cộng:</span><span class="value"><?php
																									$vat = $subtotal * 0.1;
																									$grandTotal = $subtotal + $vat;
																									echo $fm->format_currency($grandTotal) . " VND";
																									?></span></li>
				<li class="totalRow"><a href="checkout" class="btn continue">Thanh Toán</a></li>
			</ul>
		</div>
	</div>
</div>

<?php
include 'inc/footer.php';
?>