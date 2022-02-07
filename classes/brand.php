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
class brand
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function insert_brand($brandName)
	{
		$brandName = $this->fm->validation($brandName); //gọi ham validation để ktra có rỗng hay ko để ktra
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

		if (empty($brandName)) {
			// 0 brandName đang bỏ trống
			return json_encode($result_json[] = ['status' => 0]);
		} else {
			$check = "SELECT brandName FROM tbl_brand WHERE brandName = '$brandName'";
			$result_check = $this->db->select($check);
			if ($result_check) {
				// brandName đã tồn tại
				return json_encode($result_json[] = ['status' => 3]);
			} else {
				$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName') ";
				$result = $this->db->insert($query);
				if ($result) {
					// thành công
					return json_encode($result_json[] = ['status' => 1]);
				} else {
					// thất bại
					return json_encode($result_json[] = ['status' => 2]);
				}
			}
		}
	}

	public function show_brand()
	{
		$adminId = Session::get('adminId');
		$level = Session::get('level');

		if ($level == 0) {
			$query = "SELECT * FROM tbl_brand order by brandId desc";
		} else {
			$query = "SELECT * FROM tbl_brand WHERE adminId = $adminId";
		}
		$result = $this->db->select($query);
		return $result;
	}

	public function get_name_brand($brandId)
	{
		$query = "SELECT brandId, brandName FROM tbl_brand WHERE brandId = '$brandId'";
		$result = $this->db->select($query);
		return $result;
	}

	// bo
	// Lọc theo thương hiệu
	public function get_by_brand($brandId, $page)
	{
		$product_num = 12;
		$index_page = ($page - 1) * $product_num;
		$query = "SELECT tbl_product.productId, tbl_product.productName, tbl_product.old_price, tbl_product.price, tbl_product.image, tbl_brand.brandId
			FROM tbl_product
			inner join tbl_brand on tbl_product.brandId = tbl_brand.brandId
			where tbl_brand.brandId = '$brandId'
			LIMIT $index_page, $product_num";
		$result = $this->db->select($query);
		return $result;
	}

	public function getbrandbyId($id)
	{
		$query = "SELECT * FROM tbl_brand where brandId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_brand($brandId, $brandName)
	{
		$brandId = $this->fm->validation($brandId);
		$brandId = mysqli_real_escape_string($this->db->link, $brandId);
		$brandName = $this->fm->validation($brandName);
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);

		if (empty($brandName)) {
			// brandName ko đã bỏ trống
			return json_encode($result_json[] = ['status' => 0]);
		} else {
			$check = "SELECT brandName FROM tbl_brand WHERE brandName = '$brandName'";
			$result_check = $this->db->select($check);
			if ($result_check) {
				// brandName đã tồn tại
				return json_encode($result_json[] = ['status' => 3]);
			} else {
				$query = "UPDATE tbl_brand SET brandName= '$brandName' WHERE brandId = '$brandId' ";
				$result = $this->db->update($query);
				if ($result) {
					// thành công
					return json_encode($result_json[] = ['status' => 1]);
				} else {
					// thất bại
					return json_encode($result_json[] = ['status' => 2]);
				}
			}
		}
	}

	public function del_brand($brandId)
	{
		$brandId = $this->fm->validation($brandId);
		$brandId = mysqli_real_escape_string($this->db->link, $brandId);
		$query = "DELETE FROM tbl_brand where brandId = '$brandId' ";
		$result = $this->db->delete($query);
		if ($result) {
			// thành công
			return json_encode($result_json[] = ['status' => 1]);
		} else {
			// thất bại
			return json_encode($result_json[] = ['status' => 0]);
		}
	}
}
?>