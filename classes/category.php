<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
 
<?php
/**
 * 
 */
class category
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function insert_category($catName)
	{
		$catName = $this->fm->validation($catName); //gọi ham validation từ file Format để ktra
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

		if (empty($catName)) {
			// 0 catName ko đc bỏ trống
			return json_encode($result_json[] = ['status' => 0]);
		} else {
			$check = "SELECT catName FROM tbl_category WHERE catName = '$catName'";
			$resultCheck = $this->db->select($check);
			if ($resultCheck) {
				// 3 catName đã tồn tại
				return json_encode($result_json[] = ['status' => 3]);
			} else {
				$query = "INSERT INTO tbl_category(catName) VALUES('$catName') ";
				$result = $this->db->insert($query);
				if ($result) {
					// 1 thêm thành công
					return json_encode($result_json[] = ['status' => 1]);
				} else {
					// 2 thêm thất bại
					return json_encode($result_json[] = ['status' => 2]);
				}
			}
		}
		$this->connection->close();
	}
	// hiển thị loại sản phẩm
	public function show_category()
	{
		$query = "SELECT * FROM tbl_category order by catId asc";
		$result = $this->db->select($query);
		return $result;
	}

	// hiển thị loại sản phẩm có hình ảnh
	public function show_category_img()
	{
		$query = "SELECT c.catId, c.catName, p.image
		FROM tbl_product as p
		inner join tbl_category as c
		on c.catId = p.catId
		group by c.catId
		order by c.catId asc";
		$result = $this->db->select($query);
		return $result;
	}



	public function update_category($catID, $catName)
	{
		$catID = $this->fm->validation($catID);
		$catID = mysqli_real_escape_string($this->db->link, $catID);
		$catName = $this->fm->validation($catName); //gọi ham validation từ file Format để ktra
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		if (empty($catName)) {
			// 0 catName ko đc bỏ trống
			return json_encode($result_json[] = ['status' => 0]);
		} else {
			$check = "SELECT catName FROM tbl_category WHERE catName = '$catName'";
			$resultCheck = $this->db->select($check);
			if ($resultCheck) {
				// 3 catName đã tồn tại
				return json_encode($result_json[] = ['status' => 3]);
			} else {
				$query = "UPDATE tbl_category SET catName= '$catName' WHERE catId = '$catID'";
				$result = $this->db->update($query);
				if ($result) {
					// 1 Cập nhật thành công
					return json_encode($result_json[] = ['status' => 1]);
				} else {
					// 1 Cập nhật thất bại
					return json_encode($result_json[] = ['status' => 2]);
				}
			}
		}
	}
	public function del_category($id)
	{
		$id = $this->fm->validation($id);
		$id = mysqli_real_escape_string($this->db->link, $id);
		$query = "DELETE FROM tbl_category where catId = '$id'";
		$result = $this->db->delete($query);
		if ($result) {
			return json_encode($result_json[] = ['status' => 1]);
		} else {
			return json_encode($result_json[] = ['status' => 0]);
		}
	}

	// Bỏ
	// Tìm theo loại sản phẩm
	public function get_by_category($catId, $page)
	{
		$catId = $this->fm->validation($catId);
		$catId = mysqli_real_escape_string($this->db->link, $catId);
		$page = $this->fm->validation($page);
		$page = mysqli_real_escape_string($this->db->link, $page);
		$product_num = 12;
		$index_page = ($page - 1) * $product_num;
		$query = "SELECT tbl_product.productId, tbl_product.productName, tbl_product.old_price, tbl_product.price, tbl_product.image, tbl_category.catName
			FROM tbl_product
			inner join tbl_category on tbl_product.catId = tbl_category.catId
			where tbl_category.catId = '$catId'
			LIMIT $index_page, $product_num";
		$result = $this->db->select($query);
		return $result;
	}


	// Tìm tên loại sản phẩm
	public function get_name_category($catId)
	{
		$catId = $this->fm->validation($catId);
		$catId = mysqli_real_escape_string($this->db->link, $catId);
		$query = "SELECT catName FROM tbl_category WHERE catId = '$catId'";
		$result = $this->db->select($query);
		return $result;
	}


	public function getcatbyId($id)
	{
		$id = $this->fm->validation($id);
		$id = mysqli_real_escape_string($this->db->link, $id);
		$query = "SELECT * FROM tbl_category where catId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_category_fontend()
	{
		$query = "SELECT * FROM tbl_category order by catId desc ";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_product_by_cat($id)
	{
		$id = $this->fm->validation($id);
		$id = mysqli_real_escape_string($this->db->link, $id);
		$query = "SELECT * FROM tbl_product where catId = '$id' order by catId desc LIMIT 8";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_name_by_cat($id)
	{
		$id = $this->fm->validation($id);
		$id = mysqli_real_escape_string($this->db->link, $id);
		$query = "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId 
					  FROM tbl_product,tbl_category 
					  WHERE tbl_product.catId = tbl_category.catId
					  AND tbl_product.catId ='$id' LIMIT 1 ";
		$result = $this->db->select($query);
		return $result;
	}
}
?>