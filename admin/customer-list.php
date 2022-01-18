<?php include 'inc/header.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/customer.php');
include_once($filepath . '/../helpers/format.php');
$cs = new customer();
$fm = new format();

if (!isset($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}

if (!isset($_GET['product_num'])) {
	$product_num = $product_num_admin;
} else {
	$product_num = $_GET['product_num'];
}
?>

<link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
<link rel="stylesheet" href="css/mapAdmin.css">

</head>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=1179829049097202&autoLogAppEvents=1" nonce="LMMRbqRK"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Quản lý khách hàng</h1>
	<p class="mb-4">Một ngày tràng đầy năng lượng, giàu sức khỏe, mua may bán đắt, tiền vô như nước tiền ra như giọt coffee đặc.
	</p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4 mt-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các khách hàng</h6>
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
							<th>UserName/ Tên khách hàng</th>
							<th>Ngày gia nhập</th>
							<!-- <th>Địa chỉ</th> -->
						</tr>
					</thead>
					<!-- <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>khách hàng</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </tfoot> -->
					<tbody>
						<?php
						$show_customers = $cs->show_AllCustomersAdmin($page, $product_num, $searchText);
						$get_amount_all_show_customerAdmin = $cs->get_amount_all_show_customerAdmin($searchText);
						$result = $get_amount_all_show_customerAdmin->fetch_assoc();
						$totalRow = $result['totalRow'];
						if ($show_customers) {
							$i = 0;
							while ($result = $show_customers->fetch_assoc()) {
								$i++;
								$maps_maplat = $result['maps_maplat'];
								$maps_maplat = ($maps_maplat == null) ? 0 : $maps_maplat;
								$maps_maplng = $result['maps_maplng'];
								$maps_maplng = ($maps_maplng == null) ? 0 : $maps_maplng;

						?>
								<tr class="odd gradeX">
									<td><?php echo $i ?></td>
									<td>
										<a href="#" data-customerid="<?php echo $result['id'] ?>" data-lat="<?php echo $maps_maplat ?>" data-lng="<?php echo $maps_maplng ?>" class="btn" data-toggle="modal" data-target="#customerModal"><?php echo $result['username'] . " - " . $result['name'] ?></a>
									</td>
									<td><?php echo (date('d-m-Y h:m:s', strtotime($result['date_Joined']))); ?></td>
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
						<a class="nav-link" id="btnloadCustomerMap" data-toggle="pill" href="#loadCustomerMap">Vị trí giao hàng</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="btnOrderHistory" data-toggle="pill" href="#orderHistory">Lịch sử mua hàng</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="btnOrderHistory" data-toggle="pill" href="#deleteAccount">Xóa tài khoản</a>
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
										<div class="mt-4"> <span class="d-block head font-weight-bold"><i class="fa fa-sign-in" aria-hidden="true"></i> Ngày gia nhập</span> <span class="bottom" id="cusDate_Joined">j.smith@gmail.com</span> </div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane container fade" id="loadCustomerMap">
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
					<div class="tab-pane container fade" id="deleteAccount">
						<div class="card p-2 text-center mt-4">
							<div class="row">
								<div class="py-3 m-5">
									<div class="form-group">
										<div class="text-danger mb-2"> Khi chọn xóa tài khoản, tất cả các dữ liệu lịch sử mua hàng sẽ bị xóa vĩnh viễn.</div>
										<button type="button" id="delAccount" class="btn btn-danger">Xóa tài khoản</button>
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


<?php include 'inc/footer.php'; ?>
<script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">
<script src="../js/map-api-admin.js"></script>
<script src="js/order.js"></script>
<script src="js/customer.js"></script>
<script src="js/helpers.js"></script>
<script>
	$(document).ready(function() {
		$("#sidebarToggleTop").click();
	})
	$('#dataTable').dataTable({
		"paging": false
	});
	order();
	loadCustomerMap();
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
			location.href = "customer-list?page=" + page + "&product_num=" + product_num;
		});
	});
</script>