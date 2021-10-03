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

<link rel="stylesheet" href="css/cart.css">

<br><br>

<div class="wrap cf">
	<h1 class="projTitle">MUA SẮN THỎA THÍCH<span>-cùng</span> VŨNG LIÊM NOW</h1>
	<div class="heading cf">
		<h1>So Sánh Giá</h1>
		<a href="index" class="continue">Tiếp Tục Mua Sắm</a>
	</div>
	<div class="cart">
		<?php
		if (isset($update_quantity_cart)) {
			echo $update_quantity_cart;
		}
		?>
		<?php
		if (isset($delcart)) {
			echo $delcart;
		}
		?>

		<?php
		$customer_id = Session::get('customer_id');
		$get_compare = $product->get_compare($customer_id);
		if ($get_compare) {
			$i = 0;
			while ($result = $get_compare->fetch_assoc()) {
				$i++;
		?>
				<ul class="cartWrap">
					<li class="items odd">
						<div class="infoWrap">
							<div class="cartSection">
								<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" class="itemImg" />
								<p class="itemNumber"><small>#QUE-007544-002</small></p>
								<h3><?php echo $result['productName'] ?></h3>
								<p><small class="old-price">40.000 ₫</small></p>
								<p class="p-price"> <?php echo $fm->format_currency($result['price']) . ' ₫' ?></p>
								<br>
								<button class="btn btn-succes btn-buy"> <i class="fa fa-shopping-cart" aria-hidden="true"> Mua ngay</i></button>
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
	</div>
</div>
<?php
include 'inc/footer.php';
?>