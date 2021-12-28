<?php
include 'inc/header.php';
include 'config/global.php';

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
	<h1 class="projTitle">MUA SẮM THỎA THÍCH<span>-cùng</span> Kabi Store</h1>
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
	<?php
	if ($product_count >= $product_num) {
		$product_button = ceil(($product_count) / $product_num);
		$page_now = $page;
	}
	?>
	<div class="container mt-5 mb-4">
		<nav aria-label="Page navigation">
			<ul class="pagination" id="pagination"></ul>
		</nav>
	</div>
</div>


<div class="fixed" id="message"></div>

<?php
include 'inc/footer.php';
?>
<script src="js/ajax_wishlist-and-cart.js"></script>
<script src="js/audio-message.js"></script>
<script src="js/pagination/jquery.twbsPagination.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		window.pagObj = $('#pagination').twbsPagination({
            totalPages: "<?php echo $product_button ?>",
			visiblePages: 4,
			startPage: <?php echo $page_now ?>,
			onPageClick: function(event, page) {
				// console.info(page + ' (from options)');
			}
		}).on('page', function(event, page) {
			// console.info(page + ' (from event listening)');
			location.href = "wishlist-" + page + ".html";
		});
	});
</script>