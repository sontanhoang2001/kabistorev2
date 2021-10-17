<?php include 'inc/header.php'; ?>
<?php include '../classes/category.php';  ?>
<?php
// gọi class category
$cat = new category();
if (!isset($_GET['delid']) || $_GET['delid'] == NULL) {
	// echo "<script> window.location = 'catlist.php' </script>";

} else {
	$id = $_GET['delid']; // Lấy catid trên host
	$delCat = $cat->del_category($id); // hàm check delete Name khi submit lên
}
?>


<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Tables</h1>
	<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
		For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các loại sản phẩm</h6>
			<?php
			if (isset($delCat)) {
				echo $delCat;
			}
			?>
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
					<tfoot>
						<tr>
							<th>No.</th>
							<th>Loại sản phẩm</th>
							<th>Tùy chọn</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
						$show_cat = $cat->show_category();
						if ($show_cat) {
							$i = 0;
							while ($result = $show_cat->fetch_assoc()) {
								$i++;

						?>
								<tr class="odd gradeX">
									<td><?php echo $i; ?></td>
									<td><?php echo $result['catName']; ?></td>

									<td>

										<a href="catEdit.php?catid=<?php echo $result['catId']; ?>" class="btn btn-warning btn-icon-split">
											<span class="icon text-white-50">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</span>
											<span class="text">Sửa</span>
										</a>
										<a onclick="return confirm('Bạn có thật sự muốn xóa???')" href="?delid=<?php echo $result['catId'] ?>" class="btn btn-danger btn-icon-split">
											<span class="icon text-white-50">
												<i class="fas fa-trash"></i>
											</span>
											<span class="text">Xóa</span>
										</a>
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



<?php include 'inc/footer.php'; ?>
