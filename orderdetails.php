<?php
include 'inc/header.php';
// include 'inc/slider.php';
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
// if (isset($_GET['confirmid'])) {
// 	$id = $_GET['id'];
// 	$cusId = $_GET['confirmid'];
// 	$shifted_confirm = $ct->shifted_confirm($id, $cusId);
// }
// <a href="orderdetails.html?id=<?php echo $result['id']; ?&confirmid=<?php echo $customer_id >">Chờ nhận hàng..</a>
?>



<link rel="stylesheet" href="css/cart.css">

<div class="wrap cf">
	<div class="heading cf">
		<h1>Theo dõi đơn hàng</h1>
		<a href="index" class="continue">Tiếp Tục Mua Sắm</a>
	</div>
	<div class="cart">
		<?php
		$customer_id = Session::get('customer_id');
		$get_cart_ordered = $ct->get_cart_ordered($customer_id);
		if ($get_cart_ordered) {
			$i = 0;
			$qty = 0;
			$date_orderTemp[0] = "0000-00-00 00:00:00";
			while ($result = $get_cart_ordered->fetch_assoc()) {
				$i++;
				$status = $result['status'];
				$date_order = $result['date_create'];
				$date_orderTemp[$i + 1] = $date_order;
				$quantity = $result['quantity'];
		?>
				<div class="border-group text-right"><?php echo ($date_order != $date_orderTemp[$i - 1]) ? $fm->formatDateTimeP($date_order) : "" ?></div>
				<ul class="cartWrap">
					<li class="items odd">
						<div class="infoWrap">
							<div class="cartSection mwp">
								<!-- <h5 class="numorder"><?php echo $i++; ?></h5> -->
								<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" class="itemImg" />
								<p class="itemNumber"><small>#<?php echo $result['product_code'] ?></small></p>
								<a href="orderdetail?orderId=<?php echo $result['id'] ?>">
									<h3 class="name-cart"><?php echo $result['productName'] ?></h3>
								</a>
								<div class="mt-1">Số lượng: <?php echo $quantity ?></div>
								

								<div class=""><i class="fa fa-money" aria-hidden="true"></i> <p class="p-price"><?php echo $fm->format_currency($result['price']) . ' ₫' ?></p>
								</div>
								<?php
								if ($status == '0') {
								?>
									<td>
										<div class="status-order float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo 'Đang chờ xác nhận...'; ?></div>
									</td>
								<?php
								} elseif ($status == 1) {
								?>
									<td>
										<div class="status-order float-right">Chờ nhận hàng...</div>
									</td>
								<?php
								} else {
								?>
									<td>
										<div class="status-order float-right"><?php echo 'Đã giao'; ?></div>
									</td>
								<?php
								}
								?>
								<!-- <button class="btn btn-succes btn-buy"> <i class="fa fa-shopping-cart" aria-hidden="true"> Mua ngay</i></button> -->
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

<?php
include 'inc/footer.php';
?>