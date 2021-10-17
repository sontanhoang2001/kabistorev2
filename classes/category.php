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
			$alert = "<span class='error'>Category must be not empty</span>";
			return $alert;
		} else {
			$query = "INSERT INTO tbl_category(catName) VALUES('$catName') ";
			$result = $this->db->insert($query);
			if ($result) {
				$alert = "<span class='success'>Insert Category Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Insert Category NOT Success</span>";
				return $alert;
			}
		}
	}
	// hiển thị loại sản phẩm
	public function show_category()
	{
		$query = "SELECT * FROM tbl_category order by catId desc";
		$result = $this->db->select($query);
		return $result;
	}

	// hiển thị loại sản phẩm có hình ảnh
	public function show_category_img()
	{
		$query = "SELECT tbl_category.catId, tbl_category.catName , tbl_product.image
		FROM tbl_product
		inner join tbl_category
		on tbl_category.catId = tbl_product.catId
		group by tbl_category.catId";
		$result = $this->db->select($query);
		return $result;
	}



	public function update_category($catName, $id)
	{
		$catName = $this->fm->validation($catName); //gọi ham validation từ file Format để ktra
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		$id = mysqli_real_escape_string($this->db->link, $id);
		if (empty($catName)) {
			$alert = "<span class='error'>Category must be not empty</span>";
			return $alert;
		} else {
			$query = "UPDATE tbl_category SET catName= '$catName' WHERE catId = '$id' ";
			$result = $this->db->update($query);
			if ($result) {
				$alert = "<span class='success'>Category Update Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Update Category NOT Success</span>";
				return $alert;
			}
		}
	}
	public function del_category($id)
	{
		$query = "DELETE FROM tbl_category where catId = '$id' ";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Category Deleted Successfully</span>";
			return $alert;
		} else {
			$alert = "<span class='success'>Category Deleted Not Success</span>";
			return $alert;
		}
	}

	// Bỏ
	// Tìm theo loại sản phẩm
	public function get_by_category($catId, $page)
	{
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
		$query = "SELECT catName FROM tbl_category WHERE catId = '$catId'";
		$result = $this->db->select($query);
		return $result;
	}


	public function getcatbyId($id)
	{
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
		$query = "SELECT * FROM tbl_product where catId = '$id' order by catId desc LIMIT 8";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_name_by_cat($id)
	{
		$query = "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId 
					  FROM tbl_product,tbl_category 
					  WHERE tbl_product.catId = tbl_category.catId
					  AND tbl_product.catId ='$id' LIMIT 1 ";
		$result = $this->db->select($query);
		return $result;
	}
}
?>