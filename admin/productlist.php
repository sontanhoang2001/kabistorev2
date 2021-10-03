<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/cart.php';  ?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/product.php';  ?>
<?php require_once '../helpers/format.php'; ?>
<?php
$pd = new product();
$fm = new Format();
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
	// echo "<script> window.location = 'catlist.php' </script>";

} else {
	$id = $_GET['productid']; // Lấy catid trên host
	$image = $_GET['image']; // Lấy catid trên host
	$delProduct = $pd->del_product($id, $image); // hàm check delete Name khi submit lên
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>All products</h2>
		<div class="block">
			<table class="data display datatable table-striped" id="example">
				<thead>
					<tr>
						<th>#</th>
						<th>Product id</th>
						<th>Product name</th>
						<th>Import</th>
						<th>Imported</th>
						<th>Sold</th>
						<th>In Stock</th>
						<th>Price</th>
						<th>Image</th>
						<th>Type</th>
						<th>Brand</th>
						<th>Group</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$pdlist = $pd->show_product();
					$i = 0;


					if ($pdlist) {

						while ($result = $pdlist->fetch_assoc()) {
							$i++;


					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['product_code'] ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><a href="productmorequantity.php?productid=<?php echo $result['productId'] ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm</a></td>
								<td>
									<?php echo $result['productQuantity'] ?>

								</td>
								<td>
									<?php echo $result['product_soldout'] ?>

								</td>
								<td>
									<?php echo $result['product_remain'] ?>

								</td>
								<td><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></td>
								<td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>
								<td><?php echo $result['catName'] ?></td>
								<td><?php echo $result['brandName'] ?></td>

								<td><?php
									if ($result['type'] == 0) {
										echo 'Non-featurered';
									} else {
										echo 'Featured';
									}

									?></td>

								<td><a class="btn btnn btn-warning" href="productedit.php?productid=<?php echo $result['productId'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp; <a class="btn btnn btn-danger" href="?productid=<?php echo $result['productId'] ?>&image=<?php echo $result['image'] ?>" onclick="return confirm('Bạn có chắc muốn xóa??? Bạn chỉ có thể xóa khi sản phẩm chưa được bán ra, để đảm bảo dữ liệu người dùng vui lòng xóa lịch sử người dùng và thực hiện lại bước xóa sản phẩm này!');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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