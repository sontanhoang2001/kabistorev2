<?php
include 'inc/header.php';
include 'config/global.php';

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

<link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
<link rel="stylesheet" href="css/pagination.css">
<style>
	a.mapboxgl-ctrl-logo {
		display: none !important;
	}

	#map {
		position: absolute;
		top: 0;
		bottom: 0;
		width: 95% !important;
	}

	.panelmapOrderAddress {
		margin-top: 300px;
	}

	.mapboxgl-ctrl-bottom-right {
		display: none
	}

	#menu-map {
		z-index: 3;
		position: absolute;
		background: #efefef;
		padding: 4px;
		/* font-family: 'Open Sans', sans-serif; */
		bottom: 0px;
		height: 25px;
	}
</style>

<h1 class="projTitle">MUA SẮM THỎA THÍCH<span>-cùng</span> Kabi Store</h1>
<div class="wrap cf">
	<div class="heading cf" style="border-bottom: none">
		<h1>Theo dõi đơn hàng</h1>
		<div class="pull-right">
			<a href="san-pham-f0p1t0smem.html" class="btn btn-primary text"><small>Tiếp Tục Mua Sắm </small> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
		</div>
	</div>
	<div class="cart">
		<?php
		$customer_id = Session::get('customer_id');
		$product_num = 10;
		$get_cart_ordered = $ct->get_cart_ordered($customer_id, $page, $product_num);
		$amount_all_cart = $ct->get_amount_all_cart($customer_id);
		$result = $amount_all_cart->fetch_assoc();
		$product_count = $result['totalRow'];
		if ($get_cart_ordered) {
			$i = 0;
			$qty = 0;
			$address_idTemp[0] = "0000-00-00 00:00:00";
			while ($result = $get_cart_ordered->fetch_assoc()) {
				$i++;
				$address_id = $result['address_id'];
				$maps_maplat = $result['maps_maplat'];
				$maps_maplng = $result['maps_maplng'];
				$note_address = $result['note_address'];
				$status = $result['status'];
				$date_order = $result['date_create'];
				$address_idTemp[$i + 1] = $address_id;
				$quantity = $result['quantity'];
				$product_img =  json_decode($result['image']);
				$product_img = $product_img[0]->image;
				$productSize = $result['productSize'];
				$productColor = $result['color'];
		?>
				<div class="border-group text-right mt-2">
					<?php if ($address_id != $address_idTemp[$i - 1]) {
					?>
						<p style="border-top: 2px dashed #bfbfbf;"></p>
						<p>
							<a class="mr-2" href="#" data-address_id="<?php echo $address_id ?>" data-maps_maplat="<?php echo $maps_maplat ?>" data-maps_maplng="<?php echo $maps_maplng ?>" data-note_address="<?php echo $note_address ?>" data-toggle="modal" data-target="#customerModal"><i class="fa fa-map-marker fa-lg text-danger" aria-hidden="true"></i> Vị trí giao hàng</a>
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
								<a title="Chi tiết sản phẩm" href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html">
									<img src="img/core-img/best-loader.gif" data-src="<?php echo $product_img ?>" class="lazy itemImg mt-2" data-status="0" />
								</a>
								<p class="itemNumber"><small>#<?php echo $result['product_code'] ?></small></p>
								<a title="Chi tiết sản phẩm" href="details/<?php echo $result['productId'] ?>/<?php echo $fm->vn_to_str($result['productName']) . $seo ?>.html">
									<h3 class="name-cart mb-1"><?php echo $result['productName'] ?></h3>
								</a>
								<?php if ($productSize != 0) { ?>
									<div class="row mb-1 optionProduct">
										Size:
										<?php
										switch ($quantity) {
											case 5: {
													echo "Freesize";
													break;
												}
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
										}
										echo ", Nhóm màu: " . $productColor; ?>
									</div>
								<?php } ?>

								<div class="font-weight-normal">
									<p class="p-price" style="color: #787878; font-weight: 400;">Thanh toán: </p>
									<p class="p-price"><?php echo $fm->format_currency($result['totalPayment']) . ' ₫' ?></p>
								</div>
								<div class="mt-2">
									<?php
									switch ($status) {
										case 0:
									?>
											<td>
												<div class="float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo 'Đang chờ xác nhận...'; ?></div>
											</td>
										<?php
											break;
										case 1:
										?>
											<td>
												<div class="float-right"><i class="fa fa-truck" aria-hidden="true"></i> Chờ nhận hàng...</div>
											</td>
										<?php
											break;
										case 2:
										?>
											<td>
												<div class="float-right"><i class="fa fa-check-circle" aria-hidden="true" style="color: #4caf50;"></i> Đã nhận hàng</div>
											</td>
										<?php
											break;
										case 3:
										?>
											<td>
												<div class="float-right"><i class="fa fa-ban" aria-hidden="true" style="color: red;"></i> Đã hủy đơn</div>
											</td>
										<?php
											break;
										case 4:
										?>
											<td>
												<div class="float-right"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: red;"></i> Đơn hàng lỗi</div>
											</td>
									<?php
										default:
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
		} else {
			echo '
 			<div class="container">
				<div class="row">
					<div class="col-12">
						<p>Bạn chưa từng mua sản phẩm nào! Hãy quay lại trang này khi bạn đã đặt hàng thành công.</p>
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


<!-- customer Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content customerModal">
			<div class="modal-header">
				<h5 class="modal-title" id="delModallLabel">Thông tin giao hàng</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-12">
					<div class="row">
						<div class="col-md-12">
							<div class="panelmapOrderAddress">
								<div id="map"></div>
								<div id="menu-map">
									<input id="satellite-v9" type="radio" name="rtoggle" value="satellite" checked="checked">
									<label for="satellite-v9">vệ tinh</label>
									<input id="streets-v11" type="radio" name="rtoggle" value="streets" checked="checked">
									<label for="streets-v11">đường phố</label>
									<input id="dark-v10" type="radio" name="rtoggle" value="dark">
									<label for="dark-v10">tối</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group py-3">
								<label for="maps_address"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ giao hàng</label>
								<div class="bottom" id="geocodingOrderAddress" style="color: #4caf50;">Đang tìm vị trí...</div>
								<a style="color: #007bff;" id="googlemapOrderAddress" target="_blank">Xem với Google map</a>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="recipient-name" class="col-form-label">Mã đơn hàng</label>
								<div class="input-group ">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"> <i class="fa fa-qrcode" aria-hidden="true"></i></span>
									</div>
									<input type="text" class="form-control" id="cusAddress_id" readonly>
								</div>
								<label for="recipient-name" class="col-form-label">Ghi chú của bạn cho kiện hàng</label>
								<div class="input-group ">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"> <i class="fa fa-sticky-note-o" aria-hidden="true"></i></span>
									</div>
									<textarea type="text" class="form-control" id="cusNoteModel" readonly></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="copyToClipboardVal('#cusAddress_id');">Sao chép mã đơn hàng</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>

<?php
include 'inc/footer.php';
?>

<script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">
<script src="js/map-api-admin.js"></script>
<script src="js/getLocaltionOrder.js"></script>
<script src="js/function.js"></script>
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
			location.href = "orderdetails-" + page + ".html";
		});
	});
</script>