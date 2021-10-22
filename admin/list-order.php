<?php include 'inc/header.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
$ct = new cart();
$fm = new format();

?>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
</head>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=1179829049097202&autoLogAppEvents=1" nonce="LMMRbqRK"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Quản lý Đơn hàng</h1>
	<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
		For more information about DataTables.
		<br><a href="add-category"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tạo thêm Đơn hàng</a>.
	</p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4 mt-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các Đơn hàng</h6>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered display datatable table-striped" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No.</th>
							<th>Ngày đặt</th>
							<th>Tên sản phẩm</th>
							<th>SL</th>
							<th>T.Toán</th>
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
						$list_order = $ct->get_inbox_order();
						if ($list_order) {
							$i = 0;

							while ($result = $list_order->fetch_assoc()) {
								$i++;
								$orderId = $result['id'];
								$productId = $result['productId'];
								$address_id = $result['address_id'];
						?>
								<tr class="odd gradeX">
									<td><?php echo $i ?></td>
									<td>ID: <?php echo $address_id . "<br>" . (date('d-m-Y h:m:s', strtotime($result['date_create']))); ?></td>
									<td>
										<a href="#" class="btn" data-productid="<?php echo $productId ?>" data-target="#productModal"><?php echo $result['productName'] ?></i></a>
									</td>
									<td><?php echo $result['quantity'] ?></td>
									<td><?php echo $fm->format_currency($result['totalPayment']) . ' ₫' ?></td>
									<td>
										<a href="#" data-addressid="<?php echo $address_id ?>" data-customerid="<?php echo $result['customer_id'] ?>" class="btn" data-toggle="modal" data-target="#customerModal"><?php echo $result['name'] ?></a>
									</td>
									<td>

										<?php
										if ($result['status'] == 0) {
										?>
											<a href="#" data-status="0" data-orderid="<?php echo $orderId ?>" data-productid="<?php echo $productId ?>" class="btn" data-toggle="modal" data-target="#statusModal0"><i class="fa fa-clock-o" aria-hidden="true"></i> Chờ duyệt...</a>
										<?php
										} elseif ($result['status'] == 1) {
										?>
											<a href="#" data-orderid="<?php echo $orderId ?>" data-productid="<?php echo $productId ?>" class="btn" data-toggle="modal" data-target="#statusModal1"><i class="fa fa-truck" aria-hidden="true"></i> Đang giao...</a>
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
				<a href="#" id="productDetaild" class="btn btn-info">Chi tiết</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
<!-- Load Facebook SDK for JavaScript -->

<style>
	a.mapboxgl-ctrl-logo {
		display: none !important;
	}

	.customerModal {
		width: 700px;
		min-height: 400px;
	}

	@media only screen and (max-width: 600px) {
		.customerModal {
			width: 400px;
			min-height: 400px;
		}
	}

	#map {
		position: absolute;
		top: 0;
		bottom: 0;
		width: 100%;
	}

	.panelmapOrderAddress {
		margin-top: 300px;
	}
</style>

<!-- customer Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content customerModal">
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
						<a class="nav-link active" data-toggle="pill" href="#info">Thông tin</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="btnOrderAddress" data-toggle="pill" href="#orderAddress">Vị trí giao hàng</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#orderHistory">Lịch sử mua hàng</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#customerBlacklist">Danh sách đen</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane container active" id="info">
						<div class="card p-2 text-center mt-4">
							<div class="row">
								<div class="col-md-7 border-right no-gutters">
									<div class="py-3"><img id="cusAvatar" src="" width="100" class="rounded-circle">
										<h4 class="text-secondary" id="cusName">Tên khách hàng</h4>
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
										<div><span class="d-block head font-weight-bold"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ đăng ký</span> <span class="bottom" id="geocoding">Đang tìm vị trí...</span> </div>
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
						<div class="p-2 mt-4">
							<div class="row">
								<div class="col-md-12">
									<div class="panelmapOrderAddress">
										<div id="map"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="py-3">
										<div><span class="d-block head font-weight-bold"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ đăng ký</span> <span class="bottom" id="geocodingAddressSave">Đang tìm vị trí...</span> </div>
									</div>
									<a id="googlemapOrderAddress" href="#" target="_blank">Xem với Google map</a>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane container fade" id="orderHistory">

					</div>
					<div class="tab-pane container fade" id="customerBlacklist">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" id="delSubmit">f</button>
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
<script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">
<script src="js/map-api-admin.js"></script>
<script src="js/order.js"></script>
<script src="js/helpers.js"></script>
<script>
	order();
</script>