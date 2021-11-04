<?php
include 'inc/header.php';
include 'inc/global.php';

Session::set('REQUEST_URI', getRequestUrls()); // lưu vị trí đường dẫn trang khi chưa đăng nhập

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
} else {
	if (!isset($_GET['page'])) {
		$page = 1;
	} else {
		$page = $_GET['page'];
	}
}
?>

<link rel="stylesheet" href="css/pagination.css">

<div class="wrap cf">
	<h1 class="projTitle">MUA SẮN THỎA THÍCH<span>-cùng</span> Kabi Store</h1>
	<div class="heading cf">
		<h1>Yêu Thích</h1>
		<div class="pull-right">
			<a href="san-pham-f0p1t0smem.html" class="btn btn-info text"><small>Tiếp Tục Mua Sắm </small> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
		</div>
	</div>
	<div class="cart mb-5">
		<?php
		$product_num = 6;
		$customer_id = Session::get('customer_id');
		$get_wishlist = $product->get_wishlist($customer_id, $page, $product_num);
		$get_wishlist_all_product = $product->get_wishlist_all_product($customer_id);
		$result = $get_wishlist_all_product->fetch_assoc();
		$product_count = $result['totalRow'];
		if ($get_wishlist) {
			$i = 0;
			while ($result = $get_wishlist->fetch_assoc()) {
				$productId = $result['productId'];
				$old_price = $result['old_price'];
				$product_img =  json_decode($result['image']);
				$product_img = $product_img[0]->image;
				$i++;
		?>
				<ul class="cartWrap" data-id-1="<?php echo $productId; ?>">
					<li class="items odd">
						<div class="infoWrap">
							<div class="cartSection">
								<a href="details/<?php echo $productId ?>/<?php echo $seo ?>.html">
									<img data-src="<?php echo $product_img ?>" alt="" class="lazy itemImg" />
								</a>
								<p class="itemNumber" style="margin-top: 0px"><small>#<?php echo $result['product_code'] ?></small></small></p>
								<a href="details/<?php echo $productId ?>/<?php echo $seo ?>.html">
									<h3 class="name-cart"><?php echo $result['productName'] ?></h3>
								</a>
								Giá:
								<small class="old-price"><?php echo ($old_price == 0) ? $old_price : '' ?></small>
								<p class="p-price"> <?php echo $fm->format_currency($result['price']) . ' ₫' ?></p>
								<!-- <button class="btn btn-succes btn-buy" onclick="window.location.href='details/<?php echo $productId ?>/<?php echo $seo ?>.html'"><i class="fa fa-shopping-cart" aria-hidden="true"> Mua ngay</i></button> -->
							</div>
							<div class="cartSection removeWrap">
								<a class="remove" id="remove-wishlist" href="#">x</a>
							</div>
						</div>
					</li>
					<!--<li class="items even">Item 2</li>-->
				</ul>
		<?php
			}
		} else {
			echo '
 			<div class="container">
				<div class="row">
					<div class="col-12">
						<p>Không có sản phẩm nào trong yêu thích! Hãy nhấn tim <i class="fa fa-heart" aria-hidden="true"></i> sản phẩm để lưu trữ vào ưa thích.</p>
					</div>
				</div>
	 		</div>';
		}
		?>
	</div>
	<!-- Pagination -->
	<ul class="pagination ml-2 mt-5 mb-5">
		<?php
		if ($product_count >= $product_num) {
			$product_button = ceil(($product_count) / $product_num);
			$page_now = $page;
			if ($page_now == 0) {
				$page_now = (int)$query_string + 1;
			}
			if ($page_now != 1) {
				$page_now_index = $page_now - 1;
				echo '<li class="page-item"><a class="page-link" href="wishlist-' . $page_now_index . '.html">❮</a></li>';
				// << previous
			}
		?>
			<?php
			$max = 0;
			for ($i = 1; $i <= $product_button; $i++) {
				if ($i == 1) {
			?>
					<li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>" style="margin-right:0px"><a class="page-link" href="wishlist-<?php echo $i ?>.html"><?php echo $i ?></a></li>
					<?php
				} else {
					if ($i == $page_now) {
						if ($i == $max + 1) {
					?>
							<li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>" style="margin-left:0px"><a class="page-link" href="wishlist-<?php echo $i ?>.html"><?php echo $i ?></a></li>
						<?php
						} else {
						?>
							<li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>"><a class="page-link" href="wishlist-<?php echo $i ?>-<?php echo $type ?>.html"><?php echo $i ?></a></li>
						<?php
						}
					} else {
						?>
						<li class="page-item <?php echo ($i == $page_now) ? 'active' : '' ?>"><a class="page-link" href="wishlist-<?php echo $i ?>.html"><?php echo $i ?></a></li>
		<?php
					}
				}
				$max++;
			}
			if ($page_now != $max) {
				$page_now_index = $page_now + 1;
				echo '<li class="page-item"><a class="page-link" href="wishlist-' . $page_now_index .  '.html">❯</a></li>';
				// >> next
			}
		}
		?>
	</ul>
</div>


<div class="fixed" id="message"></div>

<?php
include 'inc/footer.php';
?>
<script src="js/ajax_wishlist-and-cart.js"></script>
<script src="js/audio-message.js"></script>