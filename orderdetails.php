<?php
include 'inc/header.php';
include 'inc/global.php';


if (!isset($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
}
?>


<link rel="stylesheet" href="css/pagination.css">

<h1 class="projTitle">MUA SẮN THỎA THÍCH<span>-cùng</span> Kabi Store</h1>
<div class="wrap cf">
	<div class="heading cf">
		<h1>Theo dõi đơn hàng</h1>
		<div class="pull-right">
			<a href="san-pham-f0p1t0smem.html" class="btn btn-info text"><small>Tiếp Tục Mua Sắm </small> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
		</div>
	</div>
	<div class="cart">
		<?php
		$customer_id = Session::get('customer_id');
		$product_num = 12;
		$get_cart_ordered = $ct->get_cart_ordered($customer_id, $page, $product_num);
		$amount_all_cart = $ct->get_amount_all_cart($customer_id);
		$result = $amount_all_cart->fetch_assoc();
		$product_count = $result['totalRow'];
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
				$product_img =  json_decode($result['image']);
				$product_img = $product_img[0]->image;
				$productSize = $result['productSize'];

		?>
				<div class="border-group text-right mt-2">
					<?php if ($date_order != $date_orderTemp[$i - 1]) {
					?>
						<p>
							<strong class="mr-2"><i class="fa fa-map-marker text-danger" aria-hidden="true"></i> Vị trí giao hàng</strong>
							<i class="fa fa-calendar text-primary" aria-hidden="true"></i><b class="text-primary"> Ngày đặt:</b> <?php echo $fm->formatDateTimeP($date_order) ?>
						</p>
					<?php
					}
					?>
				</div>
				<ul class="cartWrap">
					<li class="items odd">
						<div class="infoWrap">
							<div class="cartSection mwp">
								<!-- <h5 class="numorder"><?php echo $i++; ?></h5> -->
								<img data-src="<?php echo $product_img ?>" alt="" class="lazy itemImg mt-2" />
								<p class="itemNumber"><small>#<?php echo $result['product_code'] ?></small></p>
								<a href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html">
									<h3 class="name-cart"><?php echo $result['productName'] ?></h3>
								</a>

								<div class="row">
									<?php if ($productSize != 0) { ?>
										<div class="font-weight-light mr-2">
											Size:
											<?php
											switch ($productSize) {
												case 4: {
														echo "XL";
														break;
													}
												case 3: {
														echo "X";
														break;
													}
												case 2: {
														echo "M";
														break;
													}
												case 1: {
														echo "S";
														break;
													}
												default:
											} ?>
										</div>
									<?php } ?>
									<div class="font-weight-light">Số lượng: <?php echo $quantity ?></div>
								</div>
								<div class="font-weight-normal">
									Thanh toán: <p class="p-price"><?php echo $fm->format_currency($result['totalPayment']) . ' ₫' ?></p>
								</div>
								<div class="mt-2">
									<?php
									if ($status == 0) {
									?>
										<td>
											<div class="float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo 'Đang chờ xác nhận...'; ?></div>
										</td>
									<?php
									} elseif ($status == 1) {
									?>
										<td>
											<div class="float-right"><i class="fa fa-truck" aria-hidden="true"></i> Chờ nhận hàng...</div>
										</td>
									<?php
									} else {
									?>
										<td>
											<div class="float-right"><?php echo 'Đã giao'; ?></div>
										</td>
									<?php
									}
									?>
								</div>
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
	</div>
	<!-- Pagination -->
	<ul class="pagination">
		<?php
		if ($product_count >= $product_num) {
			$product_button = ceil(($product_count) / $product_num);
			$page_now = $page;
			if ($page_now == 0) {
				$page_now = (int)$query_string + 1;
			}
			if ($page_now != 1) {
				$page_now_index = $page_now - 1;
				echo '<li class="page-item"><a class="page-link" href="orderdetails-' . $page_now_index . '.html">❮</a></li>';
				// << previous
			}
		?>
			<?php
			$max = 0;
			for ($i = 1; $i <= $product_button; $i++) {
				if ($i == 1) {
			?>
					<li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>" style="margin-right:0px"><a class="page-link" href="orderdetails-<?php echo $i ?>.html"><?php echo $i ?></a></li>
					<?php
				} else {
					if ($i == $page_now) {
						if ($i == $max + 1) {
					?>
							<li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>" style="margin-left:0px"><a class="page-link" href="orderdetails-<?php echo $i ?>.html"><?php echo $i ?></a></li>
						<?php
						} else {
						?>
							<li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>"><a class="page-link" href="orderdetails-<?php echo $i ?>.html"><?php echo $i ?></a></li>
						<?php
						}
					} else {
						?>
						<li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>"><a class="page-link" href="orderdetails-<?php echo $i ?>.html"><?php echo $i ?></a></li>
		<?php
					}
				}
				$max++;
			}
			if ($page_now != $max) {
				$page_now_index = $page_now + 1;
				echo '<li class="page-item"><a class="page-link" href="orderdetails-' . $page_now_index . '.html">❯</a></li>';
				// >> next
			}
		}
		?>
</div>

<?php
include 'inc/footer.php';
?>