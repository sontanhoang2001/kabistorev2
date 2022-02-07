<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 *
 */

class product
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	// Tìm kiếm live sản phẩm
	public function live_search($search_text)
	{
		$query = "SELECT productId, productName, old_price, price, image FROM tbl_product WHERE productName LIKE '%$search_text%' AND `type` != 9 LIMIT 6";
		$product = $this->db->select($query);
		return $product;
	}

	// Tìm kiếm sản phẩm
	public function search_product($search_text, $page, $product_num)
	{
		$index_page = ($page - 1) * $product_num;
		$search_text = $this->fm->validation($search_text); //gọi ham validation từ file Format để ktra
		$query = "SELECT productId, productName, product_soldout, brandId, old_price, price, size, color, image FROM tbl_product WHERE productName LIKE '%$search_text%' AND `type` != 9
		order by productId desc LIMIT $index_page, $product_num";
		$result = $this->db->select($query);
		return $result;
	}

	// đếm tổng số sản phẩm search được
	public function get_amount_search_product($search_text)
	{
		$query = "SELECT COUNT(productId) as totalRow FROM tbl_product WHERE productName LIKE '%$search_text%' AND `type` != 9";
		$result = $this->db->select($query);
		return $result;
	}



	// đếm tổng số sản phẩm
	// public function get_amount_search_product($filter, $type)
	// {
	// 	$catId = $type;
	// 	$brandId = $type;

	// 	// Đếm tất cả sản phẩm select = 0
	// 	$query = "SELECT COUNT(productId) as totalRow FROM tbl_product";
	// 	$result = $this->db->select($query);
	// 	return $result;
	// }


	// Nhập sản phẩm admin
	public function insert_product($formData)
	{
		$productName = mysqli_real_escape_string($this->db->link, $formData['productName']);
		$product_code = mysqli_real_escape_string($this->db->link, $formData['product_code']);
		$productQuantity = mysqli_real_escape_string($this->db->link, $formData['productQuantity']);
		$category = mysqli_real_escape_string($this->db->link, $formData['category']);
		$brand = mysqli_real_escape_string($this->db->link, $formData['brand']);
		$root_price = mysqli_real_escape_string($this->db->link, $formData['root_price']);
		$perPrice = mysqli_real_escape_string($this->db->link, $formData['perPrice']);
		$old_price = mysqli_real_escape_string($this->db->link, $formData['old_price']);
		$price = mysqli_real_escape_string($this->db->link, $formData['price']);
		$type = mysqli_real_escape_string($this->db->link, $formData['type']);
		$image = mysqli_real_escape_string($this->db->link, $formData['image']);
		$product_desc = mysqli_real_escape_string($this->db->link, $formData['product_desc']);
		$product_soldout = mysqli_real_escape_string($this->db->link, $formData['product_soldout']);
		$size = mysqli_real_escape_string($this->db->link, $formData['size']);
		$color = mysqli_real_escape_string($this->db->link, $formData['color']);

		// 0 các trường ko đc bỏ trống
		if (
			$productName == "" || $product_code == '' || $productQuantity == "" || $category == ""
			|| $brand == "" || $perPrice == "" || $root_price == "" || $price == "" || $type == "" || $image == ""
		) {
			return json_encode($result_json[] = ['status' => 0]);
		} else {
			$query1 = "SELECT product_code FROM tbl_product WHERE product_code = '$product_code'";
			$result = $this->db->select($query1);
			if ($result) {
				// 3 Mã sản phẩm này đã tồn tại
				return json_encode($result_json[] = ['status' => 3]);
			} else {
				$old_price = $old_price != null ? "'$old_price'" : "NULL";
				$size = $size != null ? "'$size'" : "NULL";
				$color = $color != null ? "'$color'" : "NULL";
				$product_desc = $product_desc != null ? "'$product_desc'" : "NULL";

				$query2 = "INSERT INTO tbl_product(productName,product_code,product_remain,productQuantity, product_soldout, catId,brandId,product_desc,type,perPrice, root_price, old_price, price,image, size, color) VALUES('$productName','$product_code','$productQuantity','$productQuantity', '$product_soldout','$category','$brand',$product_desc,'$type', '$perPrice', '$root_price', $old_price,'$price', '$image', $size, $color)";
				$result = $this->db->insert($query2);
				if ($result) {
					// 1 thành công
					return json_encode($result_json[] = ['status' => 1]);
				} else {
					// 2 thất bại
					return json_encode($result_json[] = ['status' => 2]);
				}
			}
		}
	}

	// public function insert_product($date, $files)
	// {
	// 	$productName = mysqli_real_escape_string($this->db->link, $date['productName']);
	// 	$product_code = mysqli_real_escape_string($this->db->link, $date['product_code']);
	// 	$productQuantity = mysqli_real_escape_string($this->db->link, $date['productQuantity']);
	// 	$category = mysqli_real_escape_string($this->db->link, $date['category']);
	// 	$brand = mysqli_real_escape_string($this->db->link, $date['brand']);
	// 	$product_desc = mysqli_real_escape_string($this->db->link, $date['product_desc']);
	// 	$old_price = mysqli_real_escape_string($this->db->link, $date['old_price']);
	// 	$price = mysqli_real_escape_string($this->db->link, $date['price']);
	// 	$type = mysqli_real_escape_string($this->db->link, $date['type']);
	// 	//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

	// 	// kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
	// 	$permited = array('jpg', 'jpeg', 'png', 'gif');
	// 	$file_name = $_FILES['image']['name'];
	// 	$file_size = $_FILES['image']['size'];
	// 	$file_temp = $_FILES['image']['tmp_name'];

	// 	$div = explode('.', $file_name);
	// 	$file_ext = strtolower(end($div));
	// 	$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
	// 	$uploaded_image = "uploads/" . $unique_image;

	// 	if ($productName == "" || $product_code == '' || $productQuantity == "" || $category == "" || $brand == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == "") {
	// 		$alert = "<span class='error'>Các Trường không được bỏ trống!</span>";
	// 		return $alert;
	// 	} else {
	// 		$query = "SELECT product_code FROM tbl_product WHERE product_code = '$product_code'";
	// 		$result = $this->db->select($query);
	// 		if ($result) {
	// 			$alert = "<span class='error'>Mã đơn hàng đã tồn tại!</span>";
	// 			return $alert;
	// 		} else {
	// 			move_uploaded_file($file_temp, $uploaded_image);
	// 			$query = "INSERT INTO tbl_product(productName,product_code,product_remain,productQuantity,catId,brandId,product_desc,type,old_price,price,image) VALUES('$productName','$product_code','$productQuantity','$productQuantity','$category','$brand','$product_desc','$type', '$old_price','$price','$unique_image') ";
	// 			$result = $this->db->insert($query);
	// 			if ($result) {
	// 				$alert = "<span class='success'>Bạn đã thêm sản phẩm thành công</span>";
	// 				return $alert;
	// 			} else {
	// 				$alert = "<span class='error'>Bạn đã thêm sản phẩm không thành công</span>";
	// 				return $alert;
	// 			}
	// 		}
	// 	}
	// }

	public function insert_slider($data, $files)
	{
		$sliderTitle = mysqli_real_escape_string($this->db->link, $data['sliderTitle']);
		$sliderContent = mysqli_real_escape_string($this->db->link, $data['sliderContent']);
		$sliderLink = $data['sliderLink'];
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

		// kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
		$permited  = array('jpg', 'jpeg', 'png', 'gif');

		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		// $file_current = strtolower(current($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "../upload/slider/" . $unique_image;


		if ($type == "" || $unique_image == "") {
			$alert = "<span class='error'>Các Trường không được bỏ trống!</span>";
			return $alert;
		} else {
			if (!empty($file_name)) {
				//Nếu người dùng chọn ảnh
				if ($file_size > 2048000) {

					$alert = "<span class='text-danger'>Ảnh phải có kích thước dưới 2MB</span>";
					return $alert;
				} elseif (in_array($file_ext, $permited) === false) {
					// echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
					$alert = "<span class='text-danger'>You can upload only:-" . implode(', ', $permited) . "</span>";
					return $alert;
				}
				move_uploaded_file($file_temp, $uploaded_image);

				$sliderTitle = $sliderTitle != null ? "'$sliderTitle'" : "NULL";
				$sliderContent = $sliderContent != null ? "'$sliderContent'" : "NULL";
				$sliderLink = $sliderLink != null ? "'$sliderLink'" : "NULL";

				$query = "INSERT INTO tbl_slider(sliderTitle, sliderContent, sliderLink, type, slider_image) VALUES($sliderTitle, $sliderContent, $sliderLink,'$type','$unique_image') ";
				$result = $this->db->insert($query);
				if ($result) {
					$alert = "<span class='text-success'>Bạn đã thêm Slider thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='text-danger'>Bạn đã thêm Slider không thành công</span>";
					return $alert;
				}
			}
		}
	}


	// hiểu thị slider index
	public function show_slider()
	{
		$query = "SELECT sliderTitle, sliderContent, sliderLink, slider_image FROM tbl_slider where type='1' order by sliderId desc";
		$result = $this->db->select($query);
		return $result;
	}
	// hiển thị slider list admin
	public function show_slider_list()
	{
		$query = "SELECT sliderId, sliderTitle, sliderContent, sliderLink, slider_image, type FROM tbl_slider order by sliderId desc";
		$result = $this->db->select($query);
		return $result;
	}

	// hiển thị slider list admin
	public function show_sliderEdit($sliderId)
	{
		$query = "SELECT sliderId, sliderTitle, sliderContent, sliderLink, slider_image, type FROM tbl_slider WHERE sliderId = '$sliderId' order by sliderId desc";
		$result = $this->db->select($query);
		return $result;
	}

	// cập nhật sản phẩm admin
	public function update_slider($sliderId, $data)
	{
		$sliderId = mysqli_real_escape_string($this->db->link, $sliderId);
		// $slider_image = mysqli_real_escape_string($this->db->link, $data['slider_image']);
		$sliderTitle = mysqli_real_escape_string($this->db->link, $data['sliderTitle']);
		$sliderContent = mysqli_real_escape_string($this->db->link, $data['sliderContent']);
		$sliderLink = mysqli_real_escape_string($this->db->link, $data['sliderLink']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		$imgOld = mysqli_real_escape_string($this->db->link, $data['slider_image_old']);

		$sliderTitle = $sliderTitle != null ? "'$sliderTitle'" : "NULL";
		$sliderContent = $sliderContent != null ? "'$sliderContent'" : "NULL";
		$sliderLink = $sliderLink != null ? "'$sliderLink'" : "NULL";

		$file_name = $_FILES['slider_image']['name'];
		if ($file_name != null) {
			//dinh dang ten file
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
			//Thư mục bạn sẽ lưu file upload
			$target_dir    = "~/../../upload/slider/" . $unique_image;
			//Vị trí file lưu tạm trong server
			$target_file   = $target_dir;
			// $update_target_dir = $unique_image;

			$allowUpload   = true;
			//Lấy phần mở rộng của file
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			$maxfilesize   = 1000000; //(bytes) 2100000byte = 1mb

			////Những loại file được phép upload
			$allowtypes    = array('jpg', 'png', 'jpeg', 'gif', null);

			// if (isset($_POST["save"])) {
			//Kiểm tra xem có phải là ảnh
			$check = ($_FILES["slider_image"]["tmp_name"]);
			if ($check != false) {
				//echo "Đây là file ảnh - " . $check["mime"] . ".";
				$allowUpload = true;
			} else {
				//echo "Không phải file ảnh.";
				$allowUpload = false;
			}
			//}

			// Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
			if (file_exists($target_file)) {
				//echo "File đã tồn tại.";
				$allowUpload = false;
			}

			// // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
			if ($_FILES["slider_image"]["size"] > $maxfilesize) {
				// ảnh phải nhỏ hơn 1 MB
				return '<div class="text-danger">Ảnh phải nhỏ hơn 1MB!</div>';
				$allowUpload = false;
			}

			// Kiểm tra kiểu file
			if (!in_array($imageFileType, $allowtypes)) {
				return '<div class="text-danger">Chỉ được upload các định dạng JPG, PNG, JPEG, GIF!</div>';
				$allowUpload = false;
			}

			if ($sliderId == "" || $type == "" || $imgOld == "") {
				return "Các trường không được bỏ trống";
			} else {
				if ($allowUpload) {

					$query = "UPDATE `tbl_slider`
					 SET `sliderTitle`=$sliderTitle, `sliderContent`=$sliderContent, 
					 `sliderLink`=$sliderLink, `slider_image`='$unique_image', `type`='$type'
					WHERE sliderId = '$sliderId'";

					$result = $this->db->update($query);
					if ($result) {
						$files = glob("~/../../upload/slider/" . $imgOld); // get all file names
						foreach ($files as $file) { // iterate files

							if (is_file($file))
								if ($_FILES["slider_image"]["tmp_name"] == null) {
									break;
								} else {
									unlink($file); // delete file
								}
						}

						// Check if $uploadOk is set to 0 by an error
						move_uploaded_file($_FILES["slider_image"]["tmp_name"], $target_file);

						return '<div class="text-success">Cập nhật thành công!</div>';
					} else {
						return '<div class="text-danger">Cập nhật thất bại!</div>';
					}
				}
			}
		} else {
			$query = "UPDATE `tbl_slider` SET `sliderTitle`=$sliderTitle, `sliderContent`=$sliderContent, 
				`sliderLink`=$sliderLink, `type`='$type'
				WHERE sliderId = '$sliderId'";
			$result = $this->db->update($query);
			if ($result) {
				return '<div class="text-success">Cập nhật thành công!</div>';
			} else {
				return '<div class="text-success">Cập nhật thất bại!</div>';
			}
		}
	}


	// hiểu thị trong trang quản lý kho admin
	public function show_product_warehouse()
	{
		$query =
			"SELECT tbl_product.*, tbl_warehouse.*

			 FROM tbl_product INNER JOIN tbl_warehouse ON tbl_product.productId = tbl_warehouse.product_id
								
			 order by tbl_warehouse.inport_date desc ";


		$result = $this->db->select($query);
		return $result;
	}

	public function show_product($type, $page, $product_num, $search_text)
	{
		$adminId = Session::get('adminId');
		$level = Session::get('level');

		$index_page = ($page - 1) * $product_num;
		if ($level == 0) {
			switch ($type) {
				case 0: {
						$query =
							"SELECT tbl_product.productId, tbl_product.productName, tbl_product.product_code, tbl_product.productQuantity, tbl_product.product_soldout, tbl_product.product_remain, tbl_product.catId, tbl_product.brandId, tbl_product.product_desc, tbl_product.type, tbl_product.price, tbl_product.image, tbl_category.catName, tbl_brand.brandName
			 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
								INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
								WHERE tbl_product.type != 9 AND tbl_product.productName LIKE '%$search_text%' OR tbl_product.product_code LIKE '%$search_text%'
			 order by tbl_product.productId desc LIMIT $index_page, $product_num";
						break;
					}
				case 9: {
						$query =
							"SELECT tbl_product.productId, tbl_product.productName, tbl_product.product_code, tbl_product.productQuantity, tbl_product.product_soldout, tbl_product.product_remain, tbl_product.catId, tbl_product.brandId, tbl_product.product_desc, tbl_product.type, tbl_product.price, tbl_product.image, tbl_category.catName, tbl_brand.brandName
			 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
								INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
								WHERE tbl_product.type = 9 AND (tbl_product.productName LIKE '%$search_text%' OR tbl_product.product_code LIKE '%$search_text%')
			 order by tbl_product.productId desc LIMIT $index_page, $product_num";
						break;
					}
			}
		} else {
			switch ($type) {
				case 0: {
						$query =
							"SELECT tbl_product.productId, tbl_product.productName, tbl_product.product_code, tbl_product.productQuantity, tbl_product.product_soldout, tbl_product.product_remain, tbl_product.catId, tbl_product.brandId, tbl_product.product_desc, tbl_product.type, tbl_product.price, tbl_product.image, tbl_category.catName, tbl_brand.brandName
			 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
								INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
								WHERE tbl_brand.adminId = $adminId AND tbl_product.type != 9 AND (tbl_product.productName LIKE '%$search_text%' OR tbl_product.product_code LIKE '%$search_text%')
			 order by tbl_product.productId desc LIMIT $index_page, $product_num";
						break;
					}
				case 9: {
						$query =
							"SELECT tbl_product.productId, tbl_product.productName, tbl_product.product_code, tbl_product.productQuantity, tbl_product.product_soldout, tbl_product.product_remain, tbl_product.catId, tbl_product.brandId, tbl_product.product_desc, tbl_product.type, tbl_product.price, tbl_product.image, tbl_category.catName, tbl_brand.brandName
			 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
								INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
								WHERE tbl_brand.adminId = $adminId AND tbl_product.type = 9 AND (tbl_product.productName LIKE '%$search_text%' OR tbl_product.product_code LIKE '%$search_text%')
			 order by tbl_product.productId desc LIMIT $index_page, $product_num";
						break;
					}
			}
		}
		$result = $this->db->select($query);
		return $result;
	}

	public function get_amount_all_show_product($type, $searchText)
	{
		$adminId = Session::get('adminId');
		$level = Session::get('level');

		if ($level == 0) {
			switch ($type) {
				case 0: {
						$query =
							"SELECT COUNT(productId) as totalRow FROM tbl_product
								WHERE tbl_product.type != 9 AND tbl_product.productName LIKE '%$searchText%' OR tbl_product.product_code LIKE '%$searchText%'";
						break;
					}
				case 9: {
						$query =
							"SELECT COUNT(productId) as totalRow FROM tbl_product
								WHERE tbl_product.type = 9 AND (tbl_product.productName LIKE '%$searchText%' OR tbl_product.product_code LIKE '%$searchText%')";
						break;
					}
			}
		} else {
			switch ($type) {
				case 0: {
						$query =
							"SELECT COUNT(productId) as totalRow FROM tbl_product as p
							JOIN tbl_brand as b on p.productId = b.brandId
							WHERE b.adminId = '$adminId' AND p.type != 9 AND (p.productName LIKE '%$searchText%' OR p.product_code LIKE '%$searchText%')";
						break;
					}
				case 9: {
						$query =
							"SELECT COUNT(productId) as totalRow FROM tbl_product as p
							JOIN tbl_brand as b on p.productId = b.brandId
							WHERE b.adminId = '$adminId' AND p.type = 9 AND (p.productName LIKE '%$searchText%' OR p.product_code LIKE '%$searchText%')";
						break;
					}
			}
		}
		$result = $this->db->select($query);
		return $result;
	}


	public function update_type_slider($id, $type)
	{
		$type = mysqli_real_escape_string($this->db->link, $type);
		$query = "UPDATE tbl_slider SET type = '$type' where sliderId='$id'";
		$result = $this->db->update($query);
		if ($result) {
			return "<span class='text-success'>Bạn đã cập nhật thành công!</span>";
		} else {
			return "<span class='text-danger'>Bạn đã cập nhật thất bại!</span>";
		}
	}

	// xóa slider
	public function del_slider($id, $image)
	{
		$files = "../upload/slider/$image"; // get all file names

		$query = "DELETE FROM tbl_slider where sliderId = '$id' ";
		$result = $this->db->delete($query);
		if ($result) {
			if (file_exists($files)) {
				if (file_exists($files)) {
					unlink($files);
					// echo "File Successfully Delete.";
				} else {
					// echo "File does not exists";
				}
			}
			$alert = "<span class='text-success'>Đã xóa slider thành công!</span>";
			return $alert;
		} else {
			$alert = "<span class='text-danger'>Đã xóa slider không thành công!</span>";
			return $alert;
		}
	}

	// nhập kho sản phẩm
	public function update_quantity_product($formData)
	{
		$productId = mysqli_real_escape_string($this->db->link, $formData['productid']);
		$product_more_quantity = mysqli_real_escape_string($this->db->link, $formData['product_more_quantity']);
		$product_remain = mysqli_real_escape_string($this->db->link, $formData['product_remain']);

		if ($product_more_quantity == "") {
			// 0 Các trường ko đc bỏ trống
			return json_encode($result_json[] = ['status' => 0]);
		} else {
			$qty_total = $product_more_quantity + $product_remain;
			$query_warehouse = "INSERT INTO tbl_warehouse(product_id,inport_quantity) VALUES('$productId','$product_more_quantity') ";
			$result_insert = $this->db->insert($query_warehouse);

			$query = "UPDATE tbl_product SET product_remain = '$qty_total' WHERE productId = '$productId'";
			$result = $this->db->update($query);

			if ($result == true && $result_insert == true) {
				// 1  thành công
				return json_encode($result_json[] = ['status' => 1]);
			} else {
				// 2 thất bại
				return json_encode($result_json[] = ['status' => 2]);
			}
		}
	}

	// cập nhật sản phẩm admin
	public function update_product($data)
	{
		$productId = mysqli_real_escape_string($this->db->link, $data['productId']);
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$product_code = mysqli_real_escape_string($this->db->link, $data['product_code']);
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$product_soldout = mysqli_real_escape_string($this->db->link, $data['product_soldout']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$perPrice = mysqli_real_escape_string($this->db->link, $data['perPrice']);
		$root_price = mysqli_real_escape_string($this->db->link, $data['root_price']);
		$old_price = mysqli_real_escape_string($this->db->link, $data['old_price']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		$image = $data['image'];
		$size = mysqli_real_escape_string($this->db->link, $data['size']);
		$color = mysqli_real_escape_string($this->db->link, $data['color']);

		if ($product_code == "" || $productName == ""  || $brand == "" || $category == "" || $perPrice == "" || $root_price == "" || $price == "" || $type == "" || $image == "") {
			return json_encode($result_json[] = ['status' => 0]);
		} else {
			$old_price = $old_price != null ? "'$old_price'" : "NULL";
			$size = $size != null ? "'$size'" : "NULL";
			$color = $color != null ? "'$color'" : "NULL";
			$product_desc = $product_desc != null ? "'$product_desc'" : "NULL";

			$query = "UPDATE tbl_product SET
					productName = '$productName',
					product_code = '$product_code',
					brandId = '$brand',
					catId = '$category',
					product_soldout = '$product_soldout',
					`type` = '$type',
					perPrice = '$perPrice',
					root_price = '$root_price',
					old_price = $old_price,
					price = '$price', 
					`image` = '$image',
					product_desc = $product_desc,
					size = $size, color = $color
					WHERE productId = '$productId'";

			$result = $this->db->update($query);
			if ($result) {
				return json_encode($result_json[] = ['status' => 1]);
			} else {
				return json_encode($result_json[] = ['status' => 2]);
			}
		}
		$this->connection->close();
	}

	// Xóa sản phẩm admin
	public function del_product($id)
	{
		$id = $this->fm->validation($id);
		$id = mysqli_real_escape_string($this->db->link, $id);

		$query1 = "DELETE FROM tbl_cart where productId = '$id'";
		$result1 = $this->db->delete($query1);

		$query2 = "DELETE FROM tbl_wishlist where productId = '$id'";
		$result2 = $this->db->delete($query2);

		$query3 = "DELETE FROM tbl_order where productId = '$id'";
		$result3 = $this->db->delete($query3);

		$query4 = "DELETE FROM tbl_product where productId = '$id'";
		$result4 = $this->db->delete($query4);

		if ($result1 == true && $result2 == true && $result3 == true && $result4 == true) {
			return json_encode($result_json[] = ['status' => 1]);
		} else {
			return json_encode($result_json[] = ['status' => 0]);
		}
		$this->connection->close();
	}

	// public function del_product($id, $image)
	// {
	// 	$files = "../admin/uploads/$image"; // get all file names
	// 	$query = "DELETE FROM tbl_product where productId = '$id' ";
	// 	$result = $this->db->delete($query);
	// 	if ($result) {
	// 		if (file_exists($files)) {
	// 			if (file_exists($files)) {
	// 				unlink($files);
	// 				echo "File Successfully Delete.";
	// 			} else {
	// 				echo "File does not exists";
	// 			}
	// 		}
	// 		$alert = "<span class='success'>Bạn đã xóa sản phẩm thành công</span>";
	// 		return $alert;
	// 	} else {
	// 		$alert = "<span class='success'>Bạn đã xóa sản phẩm không thành công</span>";
	// 		return $alert;
	// 	}
	// }
	public function del_wlist($proid, $customer_id)
	{
		$proid = $this->fm->validation($proid);
		$proid = mysqli_real_escape_string($this->db->link, $proid);
		$customer_id = $this->fm->validation($customer_id);
		$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
		$query = "DELETE FROM tbl_wishlist where productId = '$proid' AND customer_id='$customer_id' ";
		$result = $this->db->delete($query);
		return $result;
	}

	// lấy sản phẩm cho edit product
	public function getproductForEdit($id)
	{
		$query = "SELECT productName, product_code, catId, brandId, product_soldout, product_desc, type, perPrice, root_price, old_price, price, image, size, color FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}


	//lấy sản phẩm productedit
	// public function getproductbyId($id)
	// {
	// 	$query = "SELECT * FROM tbl_product where productId = '$id' ";
	// 	$result = $this->db->select($query);
	// 	return $result;
	// }

	//Kết thúc Backend

	// public function getproduct_featheread()
	// {
	// 	$query = "SELECT * FROM tbl_product where type = '0' order by productId desc LIMIT 4 ";
	// 	$result = $this->db->select($query);
	// 	return $result;
	// }

	public function get_all_product_rank()
	{
		$query = "SELECT p.productId, p.productName, p.type, p.product_soldout, p.brandId, p.old_price, p.price, p.image, p.size, p.color, c.catName
		FROM tbl_product as p
		INNER JOIN tbl_category as c
		ON p.catId = c.catId
		where type = '2' LIMIT 25";
		$result = $this->db->select($query);
		return $result;
	}

	public function get_all_product_featheread()
	{
		$query = "SELECT * FROM tbl_product where type = '0' order by productId desc LIMIT 8 ";
		$result = $this->db->select($query);
		return $result;
	}

	// Lấy tất cả sản phẩm
	public function get_all_product($filter, $page, $type, $product_num, $priceStart, $priceEnd)
	{
		$index_page = ($page - 1) * $product_num;
		$catId = $type;
		$brandId = $type;
		// Nếu type = 0 thì thực hiện chức năng 1
		if ($type == 0) {
			switch ($filter) {
				case 0: {
						// lấy tất cả sản phẩm select = 0
						$query = "SELECT productId, productName, product_soldout, tbl_category.catName, brandId, old_price, price, size, color, image FROM tbl_product
						inner join tbl_category
						on tbl_product.catId = tbl_category.catId
						WHERE tbl_product.price BETWEEN $priceStart and $priceEnd AND `type` != 9
						order by productId desc LIMIT $index_page, $product_num";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				case 1: {
						// Lấy Sản phẩm bán nhiều nhất select = 2
						$query = "SELECT productId, productName, product_soldout, tbl_category.catName, brandId, old_price, price, size, color, image FROM tbl_product
						inner join tbl_category
						on tbl_product.catId = tbl_category.catId
						WHERE tbl_product.price BETWEEN $priceStart AND $priceEnd AND `type` != 9
						order by product_soldout desc LIMIT $index_page, $product_num";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				case 2: {
						// Lấy tất cả Sản phẩm khuyến mãi select = 3
						$query = "SELECT productId, productName, product_soldout, tbl_category.catName, brandId, price, old_price, size, color, image
						FROM tbl_product
						inner join tbl_category
						on tbl_product.catId = tbl_category.catId
						where old_price != 0 and tbl_product.price BETWEEN $priceStart and $priceEnd AND `type` != 9
						order by old_price desc LIMIT $index_page, $product_num";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				case 3: {
						// Lấy tất cả Sản phẩm đc đánh giá cao nhât 3
						$query = "SELECT p.productId, p.productName, p.product_soldout, c.catName, brandId, p.price, p.old_price, p.size, p.color, p.image
						FROM tbl_product as p 
						inner join tbl_category as c
						on p.catId = c.catId
						where p.type = 2 AND p.price BETWEEN $priceStart AND $priceEnd AND `type` != 9
						order by productId desc LIMIT $index_page, $product_num";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				default: {
						return;
					}
			}
		} else {
			switch ($filter) {
				case "c": {
						// Tìm theo loại sản phẩm
						$query = "SELECT tbl_product.productId, tbl_product.productName, product_soldout, tbl_product.brandId, tbl_product.old_price, tbl_product.price, tbl_product.size, tbl_product.color, tbl_product.image
						FROM tbl_product
						inner join tbl_category on tbl_product.catId = tbl_category.catId
						where tbl_category.catId = '$catId' AND `type` != 9 AND tbl_product.price BETWEEN $priceStart AND $priceEnd
						order by tbl_product.productId desc
						LIMIT $index_page, $product_num";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				case "b": {
						$query = "SELECT tbl_product.productId, tbl_product.productName, product_soldout, tbl_product.brandId, tbl_product.old_price, tbl_product.price, tbl_product.size, tbl_product.color, tbl_product.image
						FROM tbl_product
						inner join tbl_brand on tbl_product.brandId = tbl_brand.brandId
						where tbl_brand.brandId = '$brandId' AND `type` != 9 AND tbl_product.price BETWEEN $priceStart AND $priceEnd
						order by tbl_product.productId desc
						LIMIT $index_page, $product_num";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				default: {
						return;
					}
			}
		}
	}


	// đếm tổng số sản phẩm
	public function get_amount_all_product($filter, $type, $priceStart, $priceEnd)
	{
		$catId = $type;
		$brandId = $type;
		// Nếu type = 0 thì thực hiện chức năng 1
		if ($type == 0) {
			switch ($filter) {
				case 0: {
						// Đếm tất cả sản phẩm select = 0
						$query = "SELECT COUNT(productId) as totalRow FROM tbl_product
						where price BETWEEN $priceStart AND $priceEnd AND `type` != 9";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				case 1: {
						// Đếm Sản phẩm bán nhiều nhất select = 2
						$query = "SELECT COUNT(productId) as totalRow FROM tbl_product
						where price BETWEEN $priceStart AND $priceEnd AND `type` != 9";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				case 2: {
						// Đếm tất cả Sản phẩm khuyến mãi select = 3
						$query = "SELECT COUNT(productId) as totalRow
					FROM tbl_product
					where old_price != 0 AND `type` != 9 AND price BETWEEN $priceStart AND $priceEnd";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				case 3: {
						// Lấy tất cả Sản phẩm đc đánh giá cao nhât 3
						$query = "SELECT COUNT(productId) as totalRow
						FROM tbl_product
						where type = 2 AND `type` != 9 AND price BETWEEN $priceStart AND $priceEnd";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				default: {
					}
			}
		} else {
			switch ($filter) {
				case "c": {
						// Tìm theo loại sản phẩm
						$query = "SELECT COUNT(tbl_product.productId) as totalRow
						FROM tbl_product
						inner join tbl_category on tbl_product.catId = tbl_category.catId
						where tbl_category.catId = '$catId' AND `type` != 9 AND price BETWEEN $priceStart AND $priceEnd";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				case "b": {
						$query = "SELECT COUNT(tbl_product.productId) as totalRow
						FROM tbl_product
						inner join tbl_brand on tbl_product.brandId = tbl_brand.brandId
						where tbl_brand.brandId = '$brandId' AND `type` != 9 AND price BETWEEN $priceStart AND $priceEnd";
						$result = $this->db->select($query);
						return $result;
						break;
					}
				default: {
						return;
					}
			}
		}
	}

	// Lấy chi tiết sản phẩm
	public function get_details($id)
	{
		$query =
			"SELECT tbl_product.productId, tbl_product.productName, tbl_product.productQuantity, tbl_product.product_remain, tbl_product.catId, tbl_product.brandId, tbl_product.product_desc, tbl_product.type, tbl_product.old_price , tbl_product.price , tbl_product.image, tbl_product.size, tbl_product.color, tbl_category.catName, tbl_brand.brandName
			 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
								INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
			 WHERE tbl_product.productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}


	// Lấy Sản phẩm nổi bật (index)
	public function get_all_product_Featured()
	{
		$query = "SELECT p.productId, p.productName, p.type, p.product_soldout, p.brandId, p.old_price, p.price, p.image, p.size, p.color, c.catName
		FROM tbl_product as p
		INNER JOIN tbl_category as c
		ON p.catId = c.catId
		where type = '1' LIMIT 12";
		$result = $this->db->select($query);
		return $result;
	}

	// Lấy Sản phẩm mới nhất select = 1
	// public function get_product_Latest()
	// {
	// 	$query = "SELECT productId, productName, price, image FROM tbl_product order by productId desc LIMIT 6";
	// 	$result = $this->db->select($query);
	// 	return $result;
	// }

	// Lấy Sản phẩm bán nhiều nhất select = 2
	// public function get_product_topsell()
	// {
	// 	$query = "SELECT productId, productName, price, product_soldout, image FROM tbl_product order by product_soldout desc LIMIT 6";
	// 	$result = $this->db->select($query);
	// 	return $result;
	// }

	// Lấy Sản phẩm khuyến mãi (index)
	public function get_product_saleOff()
	{
		$query = "SELECT productId, productName, price, old_price, image FROM tbl_product where old_price != 0 order by old_price desc LIMIT 6";
		$result = $this->db->select($query);
		return $result;
	}

	// Lấy tất cả Sản phẩm khuyến mãi select = 3
	// public function get_all_product_saleOff()
	// {
	// 	$query = "SELECT tbl_brand.brandName, productId, productName, price, old_price, image
	// 	FROM tbl_product
	// 	inner join tbl_brand
	// 	on tbl_product.brandId = tbl_brand.brandId
	// 	where old_price != 0
	// 	order by old_price desc";
	// 	$result = $this->db->select($query);
	// 	return $result;
	// }

	// Lấy Sản phẩm Tương tự cho trang (details)
	public function get_product_related($catId, $productId)
	{
		$query = "SELECT productId, productName, price, image FROM tbl_product where catId = '$catId' AND productId != '$productId' order by productId desc LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}

	public function get_all_product_new()
	{
		$query = "SELECT * FROM tbl_product where type = '0' order by productId desc LIMIT 8 ";
		$result = $this->db->select($query);
		return $result;
	}


	public function getproduct_new()
	{
		$query = "SELECT * FROM tbl_product order by productId desc LIMIT 4 ";
		$result = $this->db->select($query);
		return $result;
	}

	public function getLastestDell()
	{
		$query = "SELECT * FROM tbl_product where brandId = '10' order by productId desc limit 1";
		$result = $this->db->select($query);
		return $result;
	}

	// lấy yêu thích
	public function get_wishlist($customer_id, $page, $product_num)
	{
		$index_page = ($page - 1) * $product_num;
		$query = "SELECT tbl_product.productId, tbl_product.productName, tbl_product.product_code, tbl_product.old_price, tbl_product.price, tbl_product.image
		FROM tbl_wishlist
		INNER JOIN tbl_product ON tbl_wishlist.productId = tbl_product.productId
		where tbl_wishlist.customerId = '$customer_id'
		order by tbl_wishlist.wishlistId desc
		LIMIT $index_page, $product_num";
		$result = $this->db->select($query);
		return $result;
	}


	public function get_wishlist_all_product($customer_id)
	{
		$query = "SELECT COUNT(wishlistId) as totalRow FROM tbl_wishlist WHERE customerId = '$customer_id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function wishlist_check($customer_id, $productid)
	{
		$query = "SELECT productId, customerId FROM tbl_wishlist where productId = '$productid' and customerId = '$customer_id' ";
		$result = $this->db->select($query);
		return $result;
	}


	public function insertCompare($productid, $customer_id)
	{
		$productid = $this->fm->validation($productid);
		$productid = mysqli_real_escape_string($this->db->link, $productid);
		$customer_id = $this->fm->validation($customer_id);
		$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

		$check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id ='$customer_id'";
		$result_check_compare = $this->db->select($check_compare);

		if ($result_check_compare) {
			$msg = "<span class='error'>Sản phẩm đã được thêm vào so sánh</span>";
			return $msg;
		} else {
			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();

			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			$query_insert = "INSERT INTO tbl_compare(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_compare = $this->db->insert($query_insert);

			if ($insert_compare) {
				$alert = "<span class='success'>Thêm sản phẩm vào so sánh thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Thêm sản phẩm vào so sánh thất bại</span>";
				return $alert;
			}
		}
	}

	// thêm vào yêu thích
	public function insertWishlist($productid, $customer_id)
	{
		$productid = $this->fm->validation($productid);
		$productid = mysqli_real_escape_string($this->db->link, $productid);
		$customer_id = $this->fm->validation($customer_id);
		$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

		$check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customerId ='$customer_id'";
		$result_check_wlist = $this->db->select($check_wlist);

		if ($result_check_wlist) {
			$query_delete = "DELETE FROM tbl_wishlist where productId = '$productid' AND customerId = '$customer_id' ";
			$delete_wlist = $this->db->delete($query_delete);
			// $msg = "<span class='error'>Product Added to Wishlist</span>";
			// return $msg;
		} else {
			// $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			// $result = $this->db->select($query)->fetch_assoc();

			$query_insert = "INSERT INTO tbl_wishlist(productId,customerId) VALUES('$productid','$customer_id')";
			$insert_wlist = $this->db->insert($query_insert);

			if ($insert_wlist) {
				$alert = "<span class='success'>Thêm sản phẩm vào wishlist thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Thêm sản phẩm vào wishlist thất bại</span>";
				return $alert;
			}
		}
	}

	// hiển thị khuyến mãi
	public function show_promotion()
	{
		$query = "SELECT promotionsCode, description, `condition`, discountMoney, style FROM tbl_promotions WHERE `status` = '1'  order by promotionsId asc";
		$result = $this->db->select($query);
		return $result;
	}

	public function viewProductOrderAdmin($productid)
	{
		$query = "SELECT product_code, productName ,product_remain, price FROM tbl_product where productId = '$productid'";
		$result = $this->db->select($query);
		return $result;
	}

	public function get_priceShipping()
	{
		$query = "SELECT price FROM tbl_priceshipping WHERE priceshippingId = '1' ";
		$result = $this->db->select($query);
		return $result;
	}

	public function update_priceShipping($priceShipping)
	{
		$type = mysqli_real_escape_string($this->db->link, $priceShipping);
		$query = "UPDATE tbl_priceshipping SET price= '$priceShipping' WHERE priceshippingId = '1'";
		$result = $this->db->update($query);
		if ($result) {
			return '<div class="text-success">Bạn đã cập nhật giá ship thành công!</div>';
		} else {
			return '<div class="text-danger">Bạn đã cập nhật giá ship thất bại!</div>';
		}
	}

	public function get_AllPromotions()
	{
		$query = "SELECT `promotionsId`, `promotionsCode`, `promotionsName`, `description`, `condition`, `discountMoney`, `style`, `creation_date`, `start_date`, `end_date`, `status` FROM `tbl_promotions`";
		$result = $this->db->select($query);
		return $result;
	}

	public function update_statusPromotions($promotionsId, $status)
	{
		$query = "UPDATE tbl_promotions SET `status`='$status' WHERE promotionsId = '$promotionsId'";
		$result = $this->db->update($query);
		if ($result) {
			return $result;
		}
	}

	public function del_Promotions($promotionsId)
	{
		$query = "DELETE FROM tbl_promotions WHERE promotionsId = '$promotionsId'";
		$result = $this->db->update($query);
		if ($result) {
			return $result;
		}
	}

	// Nhập sản phẩm admin
	public function insert_promotions($formData)
	{
		$promotionsCode = mysqli_real_escape_string($this->db->link, $formData['promotionsCode']);
		$promotionsName = mysqli_real_escape_string($this->db->link, $formData['promotionsName']);
		$description = mysqli_real_escape_string($this->db->link, $formData['description']);
		$condition = mysqli_real_escape_string($this->db->link, $formData['condition']);
		$discountMoney = mysqli_real_escape_string($this->db->link, $formData['discountMoney']);
		$style = mysqli_real_escape_string($this->db->link, $formData['style']);
		$start_date = mysqli_real_escape_string($this->db->link, $formData['start_date']);
		$end_date = mysqli_real_escape_string($this->db->link, $formData['end_date']);
		$status = mysqli_real_escape_string($this->db->link, $formData['status']);

		// 0 các trường ko đc bỏ trống
		if ($promotionsCode == "" || $promotionsName == "" || $description == "" || $condition == "" || $discountMoney == "" || $style == "" || $start_date == "" || $end_date == "" || $status == "") {
			return "Các trường không được bỏ trống!";
		} else {
			$query = "INSERT INTO `tbl_promotions` (`promotionsId`, `promotionsCode`, `promotionsName`, `description`, `condition`, `discountMoney`, `style`, `start_date`, `end_date`, `status`) VALUES (NULL, '$promotionsCode', '$promotionsName', '$description', '$condition', '$discountMoney', '$style', '$start_date', '$end_date', '$status');";
			$result = $this->db->insert($query);
			if ($result) {
				// 1 thành công
				return '<div class="text-success">Đã thêm mã giảm giá thành công!</div>';
			} else {
				// 2 thất bại
				return '<div class="text-danger">Đã thêm mã giảm giá thất bại!!</div>';
			}
			//promotionsId`, `promotionsCode`, `promotionsName`, `description`, `condition`, `discountMoney`, `style`, `creation_date`, `start_date`, `end_date`, `status`
		}
	}

	public function get_AllPromotion($promotionsId)
	{
		$query = "SELECT `promotionsId`, `promotionsCode`, `promotionsName`, `description`, `condition`, `discountMoney`, `style`, `creation_date`, `start_date`, `end_date`, `status` FROM `tbl_promotions` WHERE promotionsId = '$promotionsId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function update_Promotion($promotionsId, $formData)
	{
		$promotionsCode = mysqli_real_escape_string($this->db->link, $formData['promotionsCode']);
		$promotionsName = mysqli_real_escape_string($this->db->link, $formData['promotionsName']);
		$description = mysqli_real_escape_string($this->db->link, $formData['description']);
		$condition = mysqli_real_escape_string($this->db->link, $formData['condition']);
		$discountMoney = mysqli_real_escape_string($this->db->link, $formData['discountMoney']);
		$style = mysqli_real_escape_string($this->db->link, $formData['style']);
		$start_date = mysqli_real_escape_string($this->db->link, $formData['start_date']);
		$end_date = mysqli_real_escape_string($this->db->link, $formData['end_date']);
		$status = mysqli_real_escape_string($this->db->link, $formData['status']);
		$query = "UPDATE `tbl_promotions` SET `promotionsCode`='$promotionsCode',`promotionsName`='$promotionsName',`description`='$description',`condition`='$condition',`discountMoney`='$discountMoney',`style`='$style',`start_date`='$start_date',`end_date`='$end_date',`status`='$status' WHERE promotionsId = '$promotionsId'";
		$result = $this->db->update($query);
		if ($result) {
			// 1 thành công
			return '<div class="text-success">Đã thêm mã giảm giá thành công!</div>';
		} else {
			// 2 thất bại
			return '<div class="text-danger">Đã thêm mã giảm giá thất bại!!</div>';
		}
	}

	public function get_relatedProduct($productid)
	{
		$query = "SELECT catId FROM `tbl_product` WHERE productId = '$productid'";
		$get_relatedProduct = $this->db->select($query);
		if ($get_relatedProduct) {
			$result = $get_relatedProduct->fetch_assoc();
			$catId = $result['catId'];

			$query = "SELECT productId, productName, brandId, `type` ,product_soldout,old_price, price, `image`, size
		FROM tbl_product
		WHERE catId = '$catId' AND `type` != 9 ORDER BY productId DESC LIMIT 12";
			$result = $this->db->select($query);
			return $result;
		}
	}
}
?>
