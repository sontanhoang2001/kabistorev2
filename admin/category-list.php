<?php include 'inc/header.php'; ?>
<?php include '../classes/category.php';  ?>
<?php
// gọi class category
$cat = new category();

?>


<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Quản lý loại sản phẩm</h1>
	<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
		For more information about DataTables.
		<br><a href="add-category"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tạo thêm loại sản phẩm</a>.
	</p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4 mt-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các loại sản phẩm</h6>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered display datatable table-striped" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No.</th>
							<th>Loại sản phẩm</th>
							<th>Tùy chọn</th>
						</tr>
					</thead>
					<!-- <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Loại sản phẩm</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </tfoot> -->
					<tbody>
						<?php
						$show_cat = $cat->show_category();
						if ($show_cat) {
							$i = 0;
							$tr_index = 2;

							while ($result = $show_cat->fetch_assoc()) {
								$i++;
								$categoryID = $result['catId'];
						?>
								<tr class="odd gradeX">
									<td><?php echo $i; ?></td>
									<td><?php echo $result['catName']; ?></td>
									<td>
										<a id="editCategory" data-id="<?php echo $categoryID ?>" class="btn" data-toggle="modal" data-target="#myModal" contenteditable="false">
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
										</a>
										<a id="delCategory" data-id="<?php echo $categoryID ?>" class="btn" data-toggle="modal" data-target="#delModal">
											<i class="fas fa-trash"></i>
										</a>
										<!-- <a id="delCategory" onclick="return confirm('Bạn có thật sự muốn xóa???')" href="?delid=<?php echo $result['catId'] ?>" class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </a> -->
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
				<h5 class="modal-title" id="exampleModalLabel">Cập nhật loại sản phẩm</h5>
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
						<label for="message-text" class="col-form-label">Loại sản phẩm:</label>
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

<!-- Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModallLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="delModallLabel">Xóa loại sản phẩm</h5>
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
						<label for="message-text" class="col-form-label">Loại sản phẩm:</label>
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
</div>
<?php include 'inc/footer.php'; ?>
<script src="js/category.js"></script>
<script>
	update_del_Category();
</script>