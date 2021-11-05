<?php include 'inc/header.php';
include '../classes/product.php';
$product = new product();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Quản lý kho hàng</h1>
	<p class="mb-4">Một ngày tràng đầy năng lượng, giàu sức khỏe, mua may bán đắt, tiền vô như nước tiền ra như giọt coffee đặc.
		<br><a href="list-product"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nhập thêm hàng</a>.
	</p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4 mt-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các kho hàng</h6>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered display datatable table-striped" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No.</th>
							<th>Mã sp</th>
							<th>Tên sản phẩm</th>
							<th>SL ban đầu</th>
							<th>Đã bán</th>
							<th>SL trước khi nhập</th>
							<th>Đã nhập</th>
							<th>Sl sau khi nhập</th>
							<th>Ngày nhập</th>
						</tr>
					</thead>
					<!-- <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>kho hàng</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </tfoot> -->
					<tbody>
						<?php
						$product_warehouse = $product->show_product_warehouse();
						if ($product_warehouse) {
							$i = 0;
							$tr_index = 2;

							while ($result = $product_warehouse->fetch_assoc()) {
								$i++;
								$categoryID = $result['catId'];
						?>
								<tr class="odd gradeX">

									<td><?php echo $i ?></td>
									<td><?php echo $result['product_code'] ?></td>
									<td><?php echo $result['productName'] ?></td>
									<td>
										<?php echo $result['productQuantity'] ?>
									</td>
									<td>
										<?php echo $result['product_soldout'] ?>
									</td>
									<td>
										<?php echo $result['product_remain'] - $result['inport_quantity'] ?>
									</td>
									<td>
										<?php echo $result['inport_quantity'] ?>
									</td>
									<td>
										<?php echo $result['product_remain'] ?>

									</td>
									<td>
										<?php echo (date('d-m-Y h:m:s', strtotime($result['inport_date']))) ?>
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
<?php include 'inc/footer.php'; ?>