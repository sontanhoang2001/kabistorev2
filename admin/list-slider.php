<?php include 'inc/header.php';
include '../classes/product.php';
$product = new product();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Quản lý thương hiệu</h1>
	<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
		For more information about DataTables.
		<br><a href="add-brand"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tạo thêm thương hiệu</a>.
	</p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4 mt-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các thương hiệu</h6>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered display datatable table-striped" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No.</th>
							<th>Chủ đề</th>
							<th>Hình ảnh</th>
							<th>Trạng thái</th>
							<th>Tùy chọn</th>

						</tr>
					</thead>
					<!-- <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>thương hiệu</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </tfoot> -->
					<tbody>
						<?php
						$slider_list = $product->show_slider_list();
						if ($slider_list) {
							$i = 0;
							while ($result_slider = $slider_list->fetch_assoc()) {
								$i++;
						?>
								<tr class="odd gradeX">
									<td><?php echo $i; ?></td>
									<td><?php echo $result_slider['sliderName'] ?></td>
									<td><img src="uploads/<?php echo $result_slider['slider_image'] ?>" height="120px" width="500px" /></td>
									<td>
										<?php
										if ($result_slider['type'] == 1) {
										?>
											<a class="btn btnn btn-success" href="?type_slider=<?php echo $result_slider['sliderId'] ?>&type=0">On <i class="fa fa-toggle-on" aria-hidden="true"></i></a>
										<?php
										} else {
										?>
											<a class="btn btnn btn-warning" href="?type_slider=<?php echo $result_slider['sliderId'] ?>&type=1">Off <i class="fa fa-toggle-off" aria-hidden="true"></i></a>
										<?php
										}
										?>

									</td>
									<td>
										<a class="btn btnn btn-danger" href="?slider_del=<?php echo $result_slider['sliderId'] ?>&amp;img=<?php echo $result_slider['slider_image'] ?>" onclick="return confirm('Are you sure to Delete!');">Delete <i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
				<h5 class="modal-title" id="exampleModalLabel">Cập nhật thương hiệu</h5>
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
						<label for="message-text" class="col-form-label">thương hiệu:</label>
						<input class="form-control" id="brandNameModel"></input>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="button" id="updateBrand" class="btn btn-primary">Lưu thay đổi</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModallLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="delModallLabel">Xóa thương hiệu</h5>
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
						<label for="message-text" class="col-form-label">thương hiệu:</label>
						<input class="form-control" id="delBrandNameModel"></input>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
				<button type="button" class="btn btn-danger" id="delSubmit">Xóa</button>
			</div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
<script src="js/brand.js"></script>
<script>
	update_del_Brand();
</script>