<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
$ct = new cart();
if (isset($_GET['shiftid'])) {
	$id = $_GET['shiftid'];
	$proid = $_GET['proid'];
	$qty = $_GET['qty'];
	$time = $_GET['time'];
	$shifted = $ct->shifted($id, $proid, $qty, $time);
}

if (isset($_GET['delid'])) {
	$id = $_GET['delid'];

	$time = $_GET['time'];
	$del_shifted = $ct->del_shifted($id, $time);
}

?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Đơn đặt hàng</h2>
		<div class="block">
			<?php
			if (isset($shifted)) {
				echo $shifted;
			}
			?>
			<?php
			if (isset($del_shifted)) {
				echo $del_shifted;
			}
			?>
			<table class="data display datatable table-striped" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Order date</th>
						<th>Product name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Customer id</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$ct = new cart();
					$fm = new Format();
					$get_inbox_cart = $ct->get_inbox_cart();
					if ($get_inbox_cart) {
						$i = 0;
						while ($result = $get_inbox_cart->fetch_assoc()) {
							$i++;

					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo (date('d-m-Y h:m:s',strtotime($result['date_order']))); ?></td>
								<td><?php echo $result['productName'] ?> </td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo $fm->format_currency($result['price']) . ' VNĐ' ?></td>
								<td><?php echo $result['customer_id'] ?></td>
								<td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>"><i class="fa fa-info-circle" aria-hidden="true"></i> info</a></td>
								<td>
									<?php
									if ($result['status'] == 0) {
									?>

										<a href="?shiftid=<?php echo $result['id'] ?>&qty=<?php echo $result['quantity'] ?>&proid=<?php echo $result['productId'] ?>&time=<?php echo $result['date_order'] ?>"><i class="fa fa-clock-o" aria-hidden="true"></i> Confirm...
										<?php
									} elseif ($result['status'] == 1) {
										?>

											<?php
											echo '<a><i class="fa fa-truck" aria-hidden="true"></i></a> Đang giao...';
											?>

										<?php
									} elseif ($result['status'] == 2) {

										?>
											<a href="?delid=<?php echo $result['id'] ?>&time=<?php echo $result['date_order'] ?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
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
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>