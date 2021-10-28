<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
 
<?php
/**
 * 
 */
class cart
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	// thêm vào giỏ hàng
	public function add_to_cart($customer_id, $productId, $productSize, $quantity)
	{
		$customer_id = $this->fm->validation($customer_id);
		$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

		if ($customer_id == null) {
			return json_encode($result_json[][] = ['status' => 0, 'value' => 0]);
		} else {
			$productId = $this->fm->validation($productId);
			$productId = mysqli_real_escape_string($this->db->link, $productId);
			$productSize = $this->fm->validation($productSize);
			$productSize = mysqli_real_escape_string($this->db->link, $productSize);
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);

			$queryCartCustomer = "SELECT COUNT(customerId) as CartCustomer FROM tbl_cart WHERE customerId = '$customer_id'";
			$resultCartCustomer = $this->db->select($queryCartCustomer)->fetch_assoc();

			if ($resultCartCustomer['CartCustomer'] < 12) {
				$query = "SELECT product_remain FROM tbl_product WHERE productId = '$productId' ";
				$result = $this->db->select($query)->fetch_assoc();

				if ($result['product_remain'] > $quantity) {
					$query = "INSERT INTO tbl_cart (customerId, productId, productSize, quantity) VALUES ('$customer_id', '$productId', '$productSize', '$quantity')";
					$inser_cart = $this->db->insert($query);
					if ($inser_cart) {
						// $query = "SELECT COUNT(customerId) AS countCart FROM tbl_cart where customerId = '$customer_id'";
						// $check_quantity_cart = $this->db->select($query)->fetch_assoc();
						$number_cart = session::get('number_cart');
						$number_cart++;
						session::set("number_cart", (int)$number_cart);
						return json_encode($return_json[][] = ['status' => 1, 'value' => session::get('number_cart')]); // add thành công
					} else {
						return json_encode($return_json[][] = ['status' => 2, 'value' => 0]); // add thất bại
					}
				} else {
					return json_encode($result_json[][] = ['status' => 3, 'value' => $result['product_remain']]);
				}
			} else {
				return json_encode($result_json[][] = ['status' => 4, 'value' => 0]);
			}
		}
	}


	public function add_to_wishlist($productid, $customer_id)
	{
		// customer_id = null = 0
		// thêm thành công = 1
		// thêm thất bại = 2
		// xóa thành công = 3
		// xóa thất bại = 4
		if ($customer_id == null) {
			return json_encode($result_json[][] = ['status' => 0]);
		} else {
			$check_wishlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customerId ='$customer_id'";
			$result = $this->db->select($check_wishlist);

			if ($result) {
				// nếu sản phẩm tồn tại thì xóa
				$query_delete = "DELETE FROM tbl_wishlist where productId = '$productid' AND customerId = '$customer_id' ";
				$result = $this->db->delete($query_delete);
				if ($result) {
					return json_encode($result_json[][] = ['status' => 3]);
				} else {
					return json_encode($result_json[][] = ['status' => 4]);
				}
			} else {
				// chưa có sản phẩm thì thêm vào
				$inser_wishlist = "INSERT INTO tbl_wishlist(productId,customerId) VALUES('$productid','$customer_id')";
				$result = $this->db->insert($inser_wishlist);
				if ($result) {
					return json_encode($result_json[][] = ['status' => 1]);
				} else {
					return json_encode($result_json[][] = ['status' => 2]);
				}
			}
			$this->db->null;
		}
	}

	public function get_product_cart($customerId)
	{
		$customer_id = mysqli_real_escape_string($this->db->link, $customerId);
		$query = "SELECT tbl_product.productName, tbl_product.product_code, tbl_product.product_remain, tbl_product.image, tbl_product.price, tbl_cart.cartId, tbl_cart.customerId, tbl_cart.productId, tbl_cart.productSize, tbl_cart.quantity
		FROM tbl_cart
		inner join tbl_product on tbl_cart.productId = tbl_product.productId
		WHERE tbl_cart.customerId = '$customer_id'
		ORDER by cartId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function get_amount_all_cart($customer_id)
	{
		$query = "SELECT COUNT(id) as totalRow FROM tbl_order WHERE customer_id = '$customer_id'";
		$result = $this->db->select($query);
		return $result;
	}

	// Cập nhật giỏ hàng
	public function update_quantity_Cart($customerId, $cartId, $productId, $quantity)
	{
		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$customerId = mysqli_real_escape_string($this->db->link, $customerId);

		$query = "SELECT product_remain FROM tbl_product WHERE productId = '$productId' ";
		$result = $this->db->select($query)->fetch_assoc();
		$product_remain = $result['product_remain'];

		if ($product_remain >= $quantity) {
			$query = "UPDATE tbl_cart SET quantity= '$quantity' WHERE cartId =  '$cartId'";
			$result = $this->db->update($query);
			if ($result) {
				$success = true;
				$Response = ['success' => $success, 'product_remain' => 0];
				return json_encode($return_json[][] = $Response);
			}
		} else {
			$success = false;
			$Response = ['success' => $success, 'product_remain' => $product_remain];
			return json_encode($return_json[][] = $Response);
		}

		// if ($result['product_remain'] > $quantity) {
		// 	$cart = ['id' => $id, 'quantity' => $quantity, 'element' => $element];
		// 	$_SESSION['cart'][$element] = $cart;
		// 	session::set('number_cart', $element);
		// } else {
		// 	$msg = "<span style='color: red;'> Số lượng " . $quantity . " bạn đặt quá số lượng chúng tôi chỉ còn " . $result['product_remain'] . " món</span> ";
		// 	return $msg;
		// }
	}


	// Cập nhật size giỏ hàng
	public function update_size_cart($customerId, $cartId, $size)
	{
		$size = $this->fm->validation($size);
		$size = mysqli_real_escape_string($this->db->link, $size);
		$customerId = mysqli_real_escape_string($this->db->link, $customerId);

		if ($size >= 1) {
			$query = "UPDATE tbl_cart SET productSize= '$size' WHERE cartId =  '$cartId' AND customerId = '$customerId'";
			$result = $this->db->update($query);
			if ($result) {
				$success = true;
				$Response = ['success' => $success];
				return json_encode($return_json[][] = $Response);
			} else {
				$success = false;
				$Response = ['success' => $success];
				return json_encode($return_json[][] = $Response);
			}
		} else {
			$success = false;
			$Response = ['success' => $success];
			return json_encode($return_json[][] = $Response);
		}
	}

	// // xóa giỏ hàng bằng session
	// public function del_product_cart($cartid)
	// {
	// 	unset($_SESSION['cart'][$cartid]);
	// 	header('Location:cart.php');
	// }

	public function get_price_ship()
	{
		$query = "SELECT priceshippingId, name_service, price FROM tbl_priceshipping";
		$price_ship = $this->db->select($query);
		if ($price_ship) {
			return $price_ship;
		}
	}

	public function discount($promo_code)
	{
		$query_select = "SELECT promotionsName, `condition`, discountMoney, `start_date`, `end_date` FROM tbl_promotions WHERE promotionsCode = '$promo_code'";
		$result1 = $this->db->select($query_select);

		if ($result1) {
			$timestamp = $this->fm->formatDateTimeMysql();
			$result2 = $result1->fetch_assoc();
			$promotionsName = $result2['promotionsName'];

			$condition = $result2['condition'];
			$start_date = $result2['start_date'];
			$end_date = $result2['end_date'];
			$discountMoney = $result2['discountMoney'];


			// nếu đơn hàng đủ điều kiện về giá thì tiếp tục
			$subtotal = Session::get('sum');
			if ($subtotal >= $condition) {
				// kiểm tra nếu time bắt đầu khuyến mãi >= and time kết thuc khuyến mãi <= thì mã này còn hạn sử dụng
				if (($timestamp >= $start_date) && ($timestamp <= $end_date)) {

					//if today = end date promotion then set to hourse
					if (strtotime($this->fm->formatDayParameters($timestamp)) == strtotime($this->fm->formatDayParameters($end_date))) {
						//get hours
						$hour = $this->fm->getHours();
						$end_hours = $this->fm->formatHoursParameters($end_date);
						$deadlineHours = $end_hours - $hour;
						$deadlineDate = $deadlineHours . " giờ";

						// set sesstion discountMoney
						session::set('discountMoney', $discountMoney);

						$Response = ['status' => 3, 'promotionsName' => $promotionsName, 'condition' => $this->fm->format_currency($condition), 'discountMoney' => $this->fm->format_currency($discountMoney), 'deadlinedate' => $deadlineDate];
						$return_json[][] = $Response;
						return json_encode($return_json);
					} else {
						//get day
						$day = $this->fm->getDate();
						$end_day = $this->fm->formatDayParameters($end_date);
						$deadlineDay = $end_day - $day;

						// set sesstion discountMoney
						session::set('discountMoney', $discountMoney);

						$deadlineDate = $deadlineDay . " ngày";

						$Response = ['status' => 3, 'promotionsName' => $promotionsName, 'condition' => $this->fm->format_currency($condition), 'discountMoney' => $this->fm->format_currency($discountMoney), 'deadlinedate' => $deadlineDate];
						$return_json[][] = $Response;
						return json_encode($return_json);
					}
				} else {
					//khuyến mãi hết hạn
					$Response = ['status' => 2];
					$return_json[][] = $Response;
					return json_encode($return_json);
				}
			} else {
				$Response = ['status' => 1, 'promotionsName' => $promotionsName, 'condition' => $this->fm->format_currency($condition), 'discountMoney' => $this->fm->format_currency($discountMoney)];
				$return_json[][] = $Response;
				return json_encode($return_json);
			}
		} else {
			// sai mã
			$Response = ['status' => 0];
			$return_json[][] = $Response;
			return json_encode($return_json);
		}
	}

	// xóa giỏ hàng
	public function del_product_cart($cartId, $customerId)
	{
		$cartId = mysqli_real_escape_string($this->db->link, $cartId);

		$query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
		$del_cart = $this->db->delete($query);
		if ($del_cart) {
			return $del_cart;
		}
	}


	public function save_temp_quantity_Cart($proId, $cartId, $quantity)
	{
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$cartId = mysqli_real_escape_string($this->db->link, $cartId);
		$proId = mysqli_real_escape_string($this->db->link, $proId);

		$query_product = "SELECT * FROM tbl_product WHERE productId = '$proId' ";
		$result_product = $this->db->select($query_product)->fetch_assoc();
		if ($quantity < $result_product['product_remain']) {
			$query = "UPDATE tbl_cart SET

				quantity = '$quantity'

				WHERE cartId = '$cartId'";

			$result = $this->db->update($query);
			if ($result) {
				header('Location:cart.php');
			} else {
				$msg = "<span class='erorr'> Product Quantity Update NOT Succesfully</span> ";
				return $msg;
			}
		} else {
			$msg = "<span class='erorr'> Số lượng " . $quantity . " bạn đặt quá số lượng chúng tôi chỉ còn " . $result_product['product_remain'] . " cái</span> ";
			return $msg;
		}
	}

	// bỏ phương thức check_cart
	public function check_cart($customer_id)
	{
		// $sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE customerId = '$customer_id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function check_order($customer_id)
	{
		// $sId = session_id();
		$query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function del_all_data_cart($customer_id)
	{
		// unset($_SESSION['cart']);
		// $sId = session_id();
		$query = "DELETE FROM tbl_cart WHERE customerId = '$customer_id' ";
		$result = $this->db->delete($query);
		return $result;
	}

	public function del_compare($customer_id)
	{
		$sId = session_id();
		$query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
		$result = $this->db->delete($query);
		return $result;
	}

	// public function check_payment()
	// {
	// 	// Tìm cart = customer_id
	// 	foreach ($_SESSION['cart_payment'] as $val) {
	// 		$productId = $val['productId'];
	// 		$quantity = $val['quantity'];

	// 		$query_product = "SELECT * FROM tbl_product WHERE productId = '$productId' ";
	// 		$result_product = $this->db->select($query_product)->fetch_assoc();

	// 		//kiem tra so luong hop le
	// 		if ($quantity < $result_product['product_remain']) {
	// 		} else {
	// 			return $productId;
	// 		}
	// 	}
	// }

	public function insertOrder($data)
	{
		// $sId = session_id();
		// $query = "SELECT * FROM tbl_cart WHERE customerId = '$customer_id'";
		// $query = "SELECT tbl_product.productId, tbl_product.productName, tbl_cart.quantity, tbl_product.price, tbl_product.image
		// FROM tbl_cart INNER JOIN tbl_product ON tbl_cart.productId = tbl_product.productId
		// WHERE tbl_cart.customerId = '$customer_id' ";
		// $get_product = $this->db->select($query);

		// while ($result = $get_product->fetch_assoc()) {
		// 	$productid = $result['productId'];
		// 	$productName = $result['productName'];
		// 	$quantity = $result['quantity'];
		// 	$price = $result['price'] * $quantity;
		// 	$image = $result['image'];
		// 	$customer_id = $customer_id;

		// bỏ bức kiểm tra vì đã có bước kiểm tra rồi

		$customer_id = Session::get('customer_id');
		$lat = $data['maps_maplat'];
		$lng = $data['maps_maplng'];
		// $geocoder = $data['geocoder'];
		$note_address = $data['note'];
		$sId = session_id();
		$discount = session::get('discountMoney');

		// Tìm cart = customer_id
		$status = false;
		foreach ($_SESSION['cart_payment'] as $val) {
			$cartId = $val['cartId'];
			$productId = $val['productId'];
			$productName = $val['productName'];
			$quantity = $val['quantity'];

			$query_product = "SELECT * FROM tbl_product WHERE productId = '$productId' ";
			$result_product = $this->db->select($query_product)->fetch_assoc();
			$product_remain = $result_product['product_remain'];

			//kiem tra so luong hop le
			if ($quantity <= $product_remain) {
				$status = true;
			} else {
				$status = false;
				$return_json[] = ['status' => 0, 'cartId' => $cartId, 'productName' => $productName, 'quantity' => $quantity, 'product_remain' => $product_remain];
			}
		}

		// false là số lượng ko hợp lệ
		if ($status == false) {
			return json_encode($return_json);
		} else {
			//insert address
			$query = "INSERT INTO tbl_address (maps_maplat, maps_maplng, note_address, sId, customer_id) VALUES ('$lat','$lng','$note_address','$sId','$customer_id')";
			$insertAddress = $this->db->insert($query);
			if ($insertAddress) {
				$query = "SELECT address_id FROM tbl_address WHERE sId = '$sId' AND customer_id = '$customer_id'";
				$selectAddress = $this->db->select($query);
				if ($selectAddress) {
					$result = $selectAddress->fetch_assoc();
					$address_id = $result['address_id'];
					//insert order
					$countCart_payment = 0;
					foreach ($_SESSION['cart_payment'] as $val) {
						$countCart_payment++;
					}
					$discountItem = $discount / $countCart_payment;
					foreach ($_SESSION['cart_payment'] as $val) {
						$productId = $val['productId'];
						$productName = $val['productName'];
						$totalPrice = $val['totalPrice'];
						$totalPayment = $totalPrice - $discountItem;
						$quantity = $val['quantity'];
						$query_order = "INSERT INTO tbl_order(productId, customer_id, address_id, quantity, totalPayment) VALUES('$productId', '$customer_id', '$address_id','$quantity', '$totalPayment')";
						$insert_order = $this->db->insert($query_order);
					}
					if ($insert_order) {
						Session::set('payment', true);
						// header('Location:success.php');
						return json_encode($return_json[] = ['status' => 1]);
					}
				} else {
					return json_encode($return_json[] = ['status' => 2]);
				}
			} else {
				return json_encode($return_json[] = ['status' => 2]);
			}
		}
	}

	// Bỏ getAmountPrice do đã sử dụng bằng session
	public function getAmountPrice($customer_id)
	{
		$query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id' ";
		$get_price = $this->db->select($query);
		return $get_price;
	}

	public function get_cart_ordered($customer_id, $page, $product_num)
	{
		$index_page = ($page - 1) * $product_num;
		$query = "SELECT p.productName, p.product_code, p.image, o.id, o.address_id, o.quantity, o.totalPayment, o.status, a.date_create
		FROM tbl_order as o
		inner join tbl_product as p on o.productId = p.productId
        inner join tbl_address as a on o.address_id = a.address_id
		WHERE o.customer_id = '$customer_id'
		ORDER by o.id DESC LIMIT $index_page, $product_num";
		$get_cart_ordered = $this->db->select($query);
		return $get_cart_ordered;
	}

	public function get_cart_ordered_detail($orderId, $customer_id)
	{
		$query = "SELECT tbl_product.productName, tbl_product.image, tbl_product.price, tbl_order.id, tbl_order.address_id, tbl_order.quantity, tbl_order.status, tbl_order.date_order
		FROM tbl_order inner join tbl_product on tbl_order.productId = tbl_product.productId
		WHERE tbl_order.id = '$orderId' AND tbl_order.customer_id = '$customer_id'";
		$get_cart_ordered_detail = $this->db->select($query);
		return $get_cart_ordered_detail;
	}

	// Đơn đặt hàng
	public function get_inbox_order()
	{
		$query = "SELECT o.id, p.productId, p.productName, o.totalPayment , o.customer_id, c.name, o.quantity, o.status, a.date_create, a.address_id
		FROM tbl_order as o
		inner join tbl_product as p
		on p.productId = o.productId
        inner join tbl_address as a
		on a.address_id = o.address_id
        inner join tbl_customer as c
		on o.customer_id = c.id
		Where o.status = '0' OR o.status = '1'
        ORDER BY a.address_id DESC";
		$get_inbox_order = $this->db->select($query);
		return $get_inbox_order;
	}

	// Status 1: chấp nhận đơn hàng -> bắt đầu giao hàng
	// Status 3: hủy đơn hàng
	// Status 4: giao hàng thất bại
	public function order_status($id, $num_status)
	{
		$id = mysqli_real_escape_string($this->db->link, $id);
		$query = "UPDATE tbl_order SET status = '$num_status' WHERE id = '$id'";
		$result = $this->db->update($query);
		if ($result) {
			return json_encode($result_json[] = ['status' => 1]);
		} else {
			return json_encode($result_json[] = ['status' => 0]);
		}
	}

	// Status 2: Đã giao hàng thành công
	public function delivered($id, $proid, $qty)
	{
		$id = mysqli_real_escape_string($this->db->link, $id);
		$proid = mysqli_real_escape_string($this->db->link, $proid);
		$qty = mysqli_real_escape_string($this->db->link, $qty);

		$query_select = "SELECT * FROM tbl_product WHERE productId='$proid'";
		$get_select = $this->db->select($query_select);

		if ($get_select) {
			while ($result = $get_select->fetch_assoc()) {
				$soluong_new = $result['product_remain'] - $qty;
				$qty_soldout = $result['product_soldout'] + $qty;
				$query_soluong = "UPDATE tbl_product SET product_remain = '$soluong_new',product_soldout = '$qty_soldout' WHERE productId = '$proid'";
				$result = $this->db->update($query_soluong);
			}
		}

		$query = "UPDATE tbl_order SET status = '2' WHERE id = '$id'";
		$result = $this->db->update($query);
		if ($result) {
			// Cập nhật thành công
			return json_encode($result_json[] = ['status' => 1]);
		} else {
			// Cập nhật thất bại
			return json_encode($result_json[] = ['status' => 0]);
		}
	}
	public function getOrderAddress($addressid)
	{
		$addressid = mysqli_real_escape_string($this->db->link, $addressid);
		$query = "SELECT maps_maplat, maps_maplng, note_address FROM tbl_address WHERE address_id = '$addressid'";
		$result = $this->db->update($query);
		return $result;
	}

	// đếm khách hàng đã mua bao nhiêu đơn hàng
	public function getCountOrderSuccess($customerId)
	{
		$customerId = mysqli_real_escape_string($this->db->link, $customerId);
		$query = "SELECT DISTINCT
		(SELECT COUNT(id) FROM tbl_order WHERE customer_id = '$customerId' and status = '2') as numOrderSuccess,
		(SELECT COUNT(id) FROM tbl_order WHERE customer_id = '$customerId' and status = '1') as numOrderWaitDelivery,
	    (SELECT COUNT(id) FROM tbl_order WHERE customer_id = '$customerId' and status = '3') as numOrderError,
		(SELECT COUNT(id) FROM tbl_order WHERE customer_id = '$customerId' and status = '4') as numOrderScoreBad
		FROM tbl_order";
		$result = $this->db->select($query);
		return $result;
	}



	public function get_list_statusDetails($cusId, $status)
	{
		if ($cusId == 0) {
			$query = "SELECT o.id, p.productId, p.productName, o.totalPayment , o.customer_id, c.name, o.quantity, a.date_create, a.address_id
			FROM tbl_order as o
			inner join tbl_product as p
			on p.productId = o.productId
			inner join tbl_address as a
			on a.address_id = o.address_id
			inner join tbl_customer as c
			on o.customer_id = c.id
			Where o.status = '$status'
			ORDER BY a.address_id DESC";
		} else {
			$query = "SELECT o.id, p.productId, p.productName, o.totalPayment , o.customer_id, c.name, o.quantity, a.date_create, a.address_id
			FROM tbl_order as o
			inner join tbl_product as p
			on p.productId = o.productId
			inner join tbl_address as a
			on a.address_id = o.address_id
			inner join tbl_customer as c
			on o.customer_id = c.id
			Where o.status = '$status' AND o.customer_id = '$cusId'
			ORDER BY a.address_id DESC";
		}
		$get_list_delivered = $this->db->select($query);
		return $get_list_delivered;
	}


	// chọn giao hàng admin
	// public function shifted($id, $proid, $qty, $time)
	// {
	// 	$id = mysqli_real_escape_string($this->db->link, $id);
	// 	$proid = mysqli_real_escape_string($this->db->link, $proid);
	// 	$qty = mysqli_real_escape_string($this->db->link, $qty);
	// 	$time = mysqli_real_escape_string($this->db->link, $time);

	// 	$query_select = "SELECT * FROM tbl_product WHERE productId='$proid'";
	// 	$get_select = $this->db->select($query_select);

	// 	if ($get_select) {
	// 		while ($result = $get_select->fetch_assoc()) {
	// 			$soluong_new = $result['product_remain'] - $qty;
	// 			$qty_soldout = $result['product_soldout'] + $qty;
	// 			$query_soluong = "UPDATE tbl_product SET product_remain = '$soluong_new',product_soldout = '$qty_soldout' WHERE productId = '$proid'";
	// 			$result = $this->db->update($query_soluong);
	// 		}
	// 	}

	// 	$query = "UPDATE tbl_order SET status = '1' WHERE id = '$id' AND date_order = '$time'";
	// 	$result = $this->db->update($query);
	// 	if ($result) {
	// 		$msg = "<span class='success'> Cập nhật thành công</span> ";
	// 		return $msg;
	// 	} else {
	// 		$msg = "<span class='erorr'> Cập nhật thành công</span> ";
	// 		return $msg;
	// 	}
	// }

	// xóa order của admin
	// public function del_shifted($id, $time)
	// {
	// 	$id = mysqli_real_escape_string($this->db->link, $id);
	// 	$time = mysqli_real_escape_string($this->db->link, $time);
	// 	$query = "DELETE FROM tbl_order 
	// 				  WHERE id = '$id' AND date_order = '$time' ";

	// 	$result = $this->db->update($query);
	// 	if ($result) {
	// 		$msg = "<span class='success'> Xóa Đơn hàng thành công</span>";
	// 		return $msg;
	// 	} else {
	// 		$msg = "<span class='erorr'> Xóa Đơn hàng thất bạithành công</span> ";
	// 		return $msg;
	// 	}
	// }

	// xác nhận đã giao hàng customer
	// public function shifted_confirm($id, $cusId)
	// {
	// 	$id = mysqli_real_escape_string($this->db->link, $id);
	// 	$cusId = mysqli_real_escape_string($this->db->link, $cusId);
	// 	$query = "UPDATE tbl_order SET
	// 		status = '2'
	// 		WHERE id = '$id' AND customer_id = '$cusId' ";
	// 	$result = $this->db->update($query);
	// 	return $result;
	// }

	public function getEarningsMonthly()
	{
		$month = date("m");
		if ($month != 12) {
			$nextMonth = $month + 1;
		} else {
			$nextMonth = 1;
		}
		$query = "SELECT o.totalPayment
		FROM tbl_order as o
		INNER JOIN tbl_address as a
		ON a.address_id = o.address_id
		WHERE Month(a.date_create) BETWEEN '$month' AND '$nextMonth' AND o.status = '2'";
		$getEarningsMonthly = $this->db->select($query);
		if ($getEarningsMonthly) {
			$earningsMonthly = 0;
			while ($result = $getEarningsMonthly->fetch_assoc()) {
				$earningsMonthly =  $result['totalPayment'] + $earningsMonthly;
			}
			return $earningsMonthly;
		} else {
			return 0;
		}
	}

	public function getEarningsAnnual()
	{
		$year = date("Y");
		$nextYear = $year + 1;
		$query = "SELECT o.totalPayment
		FROM tbl_order as o
		INNER JOIN tbl_address as a
		ON a.address_id = o.address_id
		WHERE  a.date_create BETWEEN '$year-01-01' AND '$nextYear-01-01' AND o.status = '2'";
		$getEarningsAnnual = $this->db->select($query);
		if ($getEarningsAnnual) {
			$earningsAnnual = 0;
			while ($result = $getEarningsAnnual->fetch_assoc()) {
				$earningsAnnual =  $result['totalPayment'] + $earningsAnnual;
			}
			return $earningsAnnual;
		} else {
			return 0;
		}
	}


	public function getEarningsAnnualOverview()
	{
		$year = date("Y");
		$nextYear = $year + 1;
		$query = "SELECT o.totalPayment
		FROM tbl_order as o
		INNER JOIN tbl_address as a
		ON a.address_id = o.address_id
		WHERE  a.date_create BETWEEN '$year-01-01' and '$nextYear-01-01'";
		$getEarningsAnnual = $this->db->select($query);
		if ($getEarningsAnnual) {
			$earningsAnnual = 0;
			while ($result = $getEarningsAnnual->fetch_assoc()) {
				$earningsAnnual =  $result['totalPayment'] + $earningsAnnual;
			}
			return $earningsAnnual;
		}
	}
}
?>
