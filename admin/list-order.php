<?php include 'inc/header.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
$ct = new cart();
$fm = new format();

?>


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
								$orderID = $result['id'];

						?>
								<tr class="odd gradeX">
									<td><?php echo $i; ?></td>
									<td><?php echo (date('d-m-Y h:m:s', strtotime($result['date_create']))); ?></td>
									<td>
										<a href=""><i class="fa fa-book" aria-hidden="true"></i>
										</a>
										<?php echo $result['productName'] ?>
									</td>
									<td><?php echo $result['quantity'] ?></td>
									<td><?php echo $fm->format_currency($result['totalPayment']) . ' ₫' ?></td>
									<td>
										<a href=""><i class="fa fa-user" aria-hidden="true"></i>
										</a><?php echo $result['name'] ?>
									</td>
									<!-- <td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>"><i class="fa fa-info-circle" aria-hidden="true"></i> info</a></td> -->
									<td>

										<?php
										if ($result['status'] == 0) {
										?>
											<a href="#" data-status="0" data-orderID="<?php echo $orderID ?>" class="btn" data-toggle="modal" data-target="#statusModal0"><i class="fa fa-clock-o" aria-hidden="true"></i> Chờ duyệt...</a>
										<?php
										} elseif ($result['status'] == 1) {
										?>
											<a href="#" data-status="1" data-orderID="<?php echo $orderID ?>" class="btn" data-toggle="modal" data-target="#statusModal1"><i class="fa fa-truck" aria-hidden="true"></i> Đang giao...</a>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cập nhật Đơn hàng</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<!-- <div class="modal-body"></div> -->
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">No.</label>
						<input type="text" class="form-control" id="noModel" readonly>
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Đơn hàng:</label>
						<input class="form-control" id="categoryNameModel"></input>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="button" id="updateCategory" class="btn btn-primary">Lưu thay đổi</button>
			</div>
		</div>
	</div>
</div>

<!-- customer Modal -->
<!-- <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="acceptModallLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="delModallLabel">Xóa Đơn hàng</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">No.</label>
						<input type="text" class="form-control" id="delNoModel" readonly>
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Đơn hàng:</label>
						<input class="form-control" id="delCategoryNameModel"></input>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
				<button type="button" class="btn btn-danger" id="delSubmit">Xóa</button>
			</div>
		</div>
	</div>
</div> -->

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
					<label for="recipient-name" class="col-form-label">No.</label>
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
					<label for="recipient-name" class="col-form-label">No.</label>
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
<script src="js/order.js"></script>
<script>
	order();
</script>