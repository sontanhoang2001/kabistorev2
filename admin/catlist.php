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
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Thêm Danh mục sản phẩm</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>

	<!-- Content Row -->
	<div class="row">
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-6 col-md-12 mb-12">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="box round first grid">
						<h2>Danh mục sản phẩm</h2>
						<div class="block">
							<?php
							if (isset($delCat)) {
								echo $delCat;
							}
							?>
							<table class="data display datatable table-striped" id="example">
								<thead>
									<tr>
										<th>No.</th>
										<th>Category name</th>
										<th>Action</th>
									</tr>
								</thead>
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
												<td><a class="btn btnn btn-warning" href="catEdit.php?catid=<?php echo $result['catId']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a> &nbsp; <a class="btn btnn btn-danger" onclick="return confirm('Are you sure???')" href="?delid=<?php echo $result['catId'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Detale</a></td>
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
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>