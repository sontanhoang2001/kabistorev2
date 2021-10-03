<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php';  ?>
<?php
// gọi class category
$brand = new brand();
if (!isset($_GET['delid']) || $_GET['delid'] == NULL) {
	// echo "<script> window.location = 'catlist.php' </script>";

} else {
	$id = $_GET['delid']; // Lấy catid trên host
	$delbrand = $brand->del_brand($id); // hàm check delete Name khi submit lên
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách thương hiệu</h2>
		<div class="block">
			<?php
			if (isset($delbrand)) {
				echo $delbrand;
			}
			?>
			<table class="data display datatable table-striped" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Brand name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_brand = $brand->show_brand();
					if ($show_brand) {
						$i = 0;
						while ($result = $show_brand->fetch_assoc()) {
							$i++;

					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['brandName']; ?></td>
								<td><a class="btn btnn btn-warning" href="brandedit.php?brandid=<?php echo $result['brandId']; ?>">Sửa <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp; <a class="btn btnn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa???')" href="?delid=<?php echo $result['brandId'] ?>">Xóa <i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>