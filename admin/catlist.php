<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
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

<div class="grid_10">
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
								<td><a class="btn btnn btn-warning" href="catedit.php?catid=<?php echo $result['catId']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a> &nbsp; <a class="btn btnn btn-danger" 
								onclick="return confirm('Are you sure???')" href="?delid=<?php echo $result['catId'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Detale</a></td>
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