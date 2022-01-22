<?php include 'inc/header.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
$ct = new cart();
$fm = new format();
?>

<link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
<link rel="stylesheet" href="css/mapAdmin.css">
</head>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=1179829049097202&autoLogAppEvents=1" nonce="LMMRbqRK"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Quản lý Đơn hàng</h1>
	<p class="mb-4">Một ngày tràng đầy năng lượng, giàu sức khỏe, mua may bán đắt, tiền vô như nước tiền ra như giọt coffee đặc.
	</p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4 mt-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các Đơn hàng</h6>
		</div>

		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<form method="get">
						<div class="ml-1">
							<div class="input-group">
								<div class="form-outline">
									<input type="number" name="product_num" class="form-control" style="width: 60px;" min="1" value="<?php echo $product_num ?>" />
								</div>
								<button type="submit" class="btn btn-primary ml-1">Hiển thị</button>
							</div>
						</div>
					</form>
				</div>
			</div>


			<div class="table-responsive">
				<table class="table table-bordered display datatable table-striped" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No.</th>
							<th>Ngày đặt</th>
							<th>Tên sản phẩm</th>
							<th>Chi tiết mẫu</th>
							<th>Thanh toán</th>
							<th>Khách hàng</th>
							<th>Trạng thái đơn hàng</th>
						</tr>
					</thead>
					<!-- <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Đơn hàng</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </tfoot> -->
					<tbody>
						<?php
						$list_order = $ct->get_inbox_order($page, $product_num, $searchText);
						$get_amount_inbox_order = $ct->get_amount_inbox_order($searchText);
						$result = $get_amount_inbox_order->fetch_assoc();
						$totalRow = $result['totalRow'];
						if ($list_order) {
							$i = 0;
							while ($result = $list_order->fetch_assoc()) {
								$i++;
								$orderId = $result['id'];
								$productId = $result['productId'];
								$quantity = $result['quantity'];
								$size = $result['productSize'];
								$color = $result['color'];

								$address_id = $result['address_id'];
								$status = $result['status'];
						?>
								<tr class="odd gradeX">
									<td><?php echo $i ?></td>
									<td><a href="#" data-orderid="<?php echo $address_id ?>" onclick="pasteFindByAttr(this, 'orderid')"><i class="fa fa-clipboard" aria-hidden="true"></i></a> ID: <?php echo $address_id . "<br>" . (date('d-m-Y h:m:s', strtotime($result['date_create']))); ?></td>
									<td>
										<a href="#" class="btn" data-productid="<?php echo $productId ?>" data-target="#productModal"><?php echo $result['productName'] ?></i></a>
									</td>
									<td>
										<?php echo "Sl: " . $quantity;
										echo ($size != null) ? "<br>Size: " . $size : "";
										echo ($color != null) ? "<br>Màu: " . $color : "";
										?>
									</td>
									<td><?php echo $fm->format_currency($result['totalPayment']) . ' ₫' ?></td>
									<td>
										<a href="#" data-addressid="<?php echo $address_id ?>" data-customerid="<?php echo $result['customer_id'] ?>" class="btn" data-toggle="modal" data-target="#customerModal"><?php echo $result['name'] ?></a>
									</td>
									<td>
										<?php
										if ($status == 0) {
										?>
											<a href="#" data-status="0" data-orderid="<?php echo $orderId ?>" data-qty="<?php echo $quantity ?>" data-productid="<?php echo $productId ?>" class="btn" data-toggle="modal" data-target="#statusModal0"><i class="fa fa-clock-o" aria-hidden="true"></i> Chờ duyệt...</a>
										<?php
										} elseif ($status == 1) {
										?>
											<a href="#" data-status="1" data-orderid="<?php echo $orderId ?>" data-qty="<?php echo $quantity ?>" data-productid="<?php echo $productId ?>" class="btn" data-toggle="modal" data-target="#statusModal1"><i class="fa fa-truck" aria-hidden="true"></i> Đang giao...</a>
										<?php
										}
										?>
									</td>
								</tr>
						<?php
							}
						}
						?>
					</tbody>
				</table>
				<!-- Pagination -->
				<?php
				if ($totalRow >= $product_num) {
					$product_button = ceil(($totalRow) / $product_num);
					$page_now = $page;
				}
				?>
				<div class="container mt-5 mb-4">
					<nav aria-label="Page navigation">
						<ul class="pagination" id="pagination"></ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

<!-- product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Thông tin sản phẩm</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<!-- <div class="modal-body"></div> -->
			<div class="modal-body">
				<form>
					<div class="form-group">
						<div id="facebookPluginModel" class="fb-post" data-href="" data-width="470	" data-show-text="true" data-lazy="true"></div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Mã sản phẩm</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"> <i class="fa fa-qrcode" aria-hidden="true"></i></span>
							</div>
							<input type="text" class="form-control" id="productCodeModel" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Tên sản phẩm</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"> <i class="fa fa-font" aria-hidden="true"></i></span>
							</div>
							<input type="text" class="form-control" id="productNameModel" readonly value="Bánh quy bơ">
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-md-6 col-sm-12">
							<label for="recipient-name" class="col-form-label">Giá bán</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"> <i class="fa fa-line-chart" aria-hidden="true"></i></span>
								</div>
								<input type="text" class="form-control" id="priceModel" readonly value="19k">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<label for="recipient-name" class="col-form-label">Số lượng trong kho</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"> <i class="fa fa-truck" aria-hidden="true"></i></span>
								</div>
								<input type="text" class="form-control" id="remainModel" readonly value="19k">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="copyProductName" class="btn btn-primary" onclick="pasteFind('#productNameModel');">Group</button>
				<a href="#" id="productDetaild" target="_blank" class="btn btn-info">Chi tiết</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
<!-- Load Facebook SDK for JavaScript -->

<!-- customer Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content colMax">
			<div class="modal-header">
				<h5 class="modal-title" id="delModallLabel">Thông tin khách hàng</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<!-- Nav pills -->
				<ul class="nav nav-pills">
					<li class="nav-item">
						<a class="nav-link active" id="btnViewInfo" data-toggle="pill" href="#info">Thông tin</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="btnOrderAddress" data-toggle="pill" href="#orderAddress">Vị trí giao hàng</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="btnOrderHistory" data-toggle="pill" href="#orderHistory">Lịch sử mua hàng</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane container active" id="info">
						<div class="card p-2 text-center mt-4">
							<div class="row">
								<div class="col-md-7 border-right no-gutters">
									<div class="py-3">
										<img class="img-thumbnail" id="cusAvatar" src="" style="width: 100px; height: 100px; object-fit: cover">
										<h4 class="text-secondary mt-2" id="cusName">Tên khách hàng</h4>
										<div class="allergy"><span id="cusUserName">UserName</span></div>
										<div class="stats">
											<table class="table table-borderless">
												<tbody>
													<tr>
														<td>
															<div class="d-flex flex-column"> <span class="text-left head font-weight-bold"><i class="fa fa-birthday-cake" aria-hidden="true"></i> Ngày Sinh</span> <span class="text-left bottom" id="cusDate_of_birth">03/13/2016</span> </div>
														</td>
														<td>
															<div class="d-flex flex-column"> <span class="text-left head font-weight-bold"><i class="fa fa-venus-double" aria-hidden="true"></i> Giới tính</span> <span class="text-left bottom" id="cusGender">nam</span> </div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="px-3"><button type="button" class="btn btn-primary btn-block">Send Message</button></div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="py-3">
										<div><span class="d-block head font-weight-bold"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ đăng ký</span> <span class="bottom" id="geocodingAddressSave">Đang tìm vị trí...</span> </div>
										<a id="googlemapAddressSave" href="#" target="_blank">Xem với Google map</a>

										<div class="mt-4"> <span class="d-block head font-weight-bold"><i class="fa fa-phone-square" aria-hidden="true"></i> Số điện thoại</span> <span class="bottom" id="cusPhone">718 (702)-9876</span> </div>
										<div class="mt-4"> <span class="d-block head font-weight-bold"><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</span> <span class="bottom" id="cusEmail">j.smith@gmail.com</span> </div>
										<div class="mt-4"> <span class="d-block head font-weight-bold"><i class="fa fa-sign-in" aria-hidden="true"></i> Gia nhập</span> <span class="bottom" id="cusDate_Joined">j.smith@gmail.com</span> </div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane container fade" id="orderAddress">
						<div class="mt-4">
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
									<div class="py-3">
										<div><span class="d-block head font-weight-bold"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ đăng ký</span> <span class="bottom" id="geocodingOrderAddress">Đang tìm vị trí...</span> </div>
										<a id="googlemapOrderAddress" href="#" target="_blank">Xem với Google map</a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="recipient-name" class="col-form-label">Ghi chú của khách hàng</label>
										<div class="input-group ">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1"> <i class="fa fa-sticky-note-o" aria-hidden="true"></i></span>
											</div>
											<textarea class="form-control" id="cusNoteModel" readonly></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane container fade" id="orderHistory">
						<div class="card p-2 text-center mt-4">
							<div class="row">
								<div class="col-md-6 border-right no-gutters">
									<div class="py-3">
										<h4 class="text-secondary">Đã mua thành công</h4>
										<div class="allergy"><a href="#" id="hrefOrderListDelivered" target="_blank" rel="noopener noreferrer" style="color: green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>
											<span id="numOrderSuccess">0</span>
										</div>
									</div>
									<div class="py-3">
										<h4 class="text-secondary">Đang chờ giao hàng</h4>
										<div class="allergy"><a href="#" id="hrefOrderWaitDelivery" target="_blank" rel="noopener noreferrer"><i class="fa fa-truck" aria-hidden="true"></i></a>
											<span id="numOrderWaitDelivery">0</span>
										</div>
									</div>
								</div>
								<div class="col-md-6 border-right no-gutters">
									<div class="py-3">
										<h4 class="text-secondary" id="cusName">Mua thất bại</h4>
										<div class="allergy"><a href="#" id="hrefOrderError" target="_blank" rel="noopener noreferrer" style="color: red;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
											<span id="numOrderError">0</span>
										</div>
									</div>
									<div class="py-3">
										<h4 class="text-secondary">Điểm xấu</h4>
										<div class="allergy"><a href="#" id="hrefOrderScoreBad" target="_blank" rel="noopener noreferrer" style="color: red;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
											<span id="numOrderScoreBad">Không có</span>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>

<!-- accept Modal = 0 -->
<div class="modal fade" id="statusModal0" tabindex="-1" role="dialog" aria-labelledby="statusModal0Label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="delModallLabel">Cập nhật trạng thái đơn hàng</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="recipient-name" class="col-form-label">Trạng thái</label>
					<select class="form-control" id="statusOrder0">
						<option value="0">-Chọn trạng thái-</option>
						<option value="1">Chấp nhận đơn hàng</option>
						<option value="3">Hủy đơn</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
				<button type="button" class="btn btn-success" id="updateStatusBtn0" disabled>Cập nhật</button>
			</div>
		</div>
	</div>
</div>


<!-- accept Modal = 1 -->
<div class="modal fade" id="statusModal1" tabindex="-1" role="dialog" aria-labelledby="statusModal1Label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="delModallLabel">Cập nhật trạng thái đơn hàng</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="recipient-name" class="col-form-label">Trạng thái</label>
					<select class="form-control" id="statusOrder1">
						<option value="0">-Chọn trạng thái-</option>
						<option value="2">Đã giao hàng</option>
						<option value="4">Hủy đơn, khách không nhận hàng</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
				<button type="button" class="btn btn-success" id="updateStatusBtn1" disabled>Cập nhật</button>
			</div>
		</div>
	</div>
</div>

<?php include 'inc/footer.php'; ?>
<script>
	$(document).ready(function() {
		$("#sidebarToggleTop").click();
	})
	$('#dataTable').dataTable({
		"paging": false
	});
</script>
<link href="../js/api.mapbox.com/mapbox-gl-js/v2.3.0/mapbox-gl.css" rel="stylesheet">
<script src="../js/api.mapbox.com/mapbox-gl-js/v2.3.0/mapbox-gl.js"></script>
<script src="../js/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="../js/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css">
<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
<script src="../js/cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="../js/cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

<script src="../js/map-api-admin.js"></script>
<script src="js/order.js"></script>
<script src="js/helpers.js"></script>
<script>
	order();
</script>

<script src="../js/pagination/jquery.twbsPagination.js" type="text/javascript"></script>
<script type="text/javascript">
	var product_num = <?php echo $product_num ?>;
	$(function() {
		window.pagObj = $('#pagination').twbsPagination({
			totalPages: <?php echo $product_button ?>,
			visiblePages: 4,
			startPage: <?php echo $page_now ?>,
			onPageClick: function(event, page) {
				// console.info(page + ' (from options)');
			}
		}).on('page', function(event, page) {
			// console.info(page + ' (from event listening)');
			location.href = "newOrders-list?page=" + page + "&product_num=" + product_num;
		});
	});
</script>