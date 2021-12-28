<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../lib/session.php');
?>


 
<?php
ob_start();
/**
 * 
 */
class customer
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
		Session::init();
	}
	public function insert_binhluan()
	{
		$product_id = $_POST['product_id_binhluan'];
		$tenbinhluan = $_POST['ten_nguoibinhluan'];
		$noidungbinhluan = $_POST['noi_dung_binhluan'];
		echo $tenbinhluan;
		echo $noidungbinhluan;
		if ($tenbinhluan == '' || $noidungbinhluan == '') {
			return;
		} else {
			$query = "INSERT INTO tbl_binhluan(tenbinhluan,noidungbinhluan,product_id) VALUES('$tenbinhluan','$noidungbinhluan','$product_id')";
			$result = $this->db->insert($query);
			if ($result) {
				$alert = "<span class='success'>Bình luận đã được gửi thành công!</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Bình luận không thành công!</span>";
				return $alert;
			}
		}
	}

	public function insert_customer($data)
	{
		// 0 các trường ko được bỏ trống
		// 1 đăng ký thành công
		// 2 đăng ký tài khoản không thành công
		// 3 tài khoản này đã tồn tại
		// 4 mật khẩu nhập lại không chính xác
		// 5 tên đăng nhập sai cú pháp
		// 6 mật khẩu sai cú pháp

		$username = $this->fm->validation($data['username']);
		$pass1 = $this->fm->validation($data['password1']);
		$pass2 = $this->fm->validation($data['password2']);
		$password2 = $this->fm->validation($data['password2']);

		$username = mysqli_real_escape_string($this->db->link, $data['username']);
		$pass1 = mysqli_real_escape_string($this->db->link, $data['password1']);
		$pass2 = mysqli_real_escape_string($this->db->link, $data['password2']);
		$password2 = mysqli_real_escape_string($this->db->link, md5($data['password2']));

		if ($username == "" || $pass1 == "" || $pass2 == "") {
			return json_encode($result_json[] = ['status' => 0]);
		} else {
			if ($pass2 == $pass1) {
				$parttenUsername = "/^[a-z0-9_-]{3,16}$/";
				$parttenPassword = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
				if (!preg_match($parttenUsername, $username)) {
					return json_encode($result_json[] = ['status' => 5]);
				} elseif (!preg_match($parttenPassword, $pass2)) {
					return json_encode($result_json[] = ['status' => 6]);
				} else {
					$check_username = "SELECT username FROM tbl_customer WHERE username='$username' LIMIT 1";
					$result_check = $this->db->select($check_username);
					if ($result_check) {
						return json_encode($result_json[] = ['status' => 3]);
					} else {
						$query = "INSERT INTO tbl_customer(username,password) VALUES('$username','$password2') ";
						$result = $this->db->insert($query);
						if ($result) {
							return json_encode($result_json[] = ['status' => 1]);
						} else {
							return json_encode($result_json[] = ['status' => 2]);
						}
					}
				}
			} else {
				return json_encode($result_json[] = ['status' => 4]);
			}
		}
		$this->connection->close();
	}
	public function login_cookie()
	{
		// 0 tên đnăg nhập và mất khẩu không được bỏ trống
		// 1 thành công
		// 2 tên đăng nhập hoặc mật khẩu sai
		if (isset($_COOKIE['is_login'])) {
			$is_login = $_COOKIE['is_login'];
			$data = json_decode($is_login);

			$username = mysqli_real_escape_string($this->db->link, $data->username);
			$password = mysqli_real_escape_string($this->db->link, $data->password);
			$account_type = mysqli_real_escape_string($this->db->link, $data->type);

			if ($username == '' || $password == '') {
				return json_encode($result_json[][] = ['status' => 0, 'content' => 0]);
			} else {
				switch ($account_type) {
					case 0: {
							$check_login = "SELECT id, username, name, avatar, phone, password FROM tbl_customer WHERE username='$username' AND password='$password' ";
							$result_check = $this->db->select($check_login);
							break;
						}
					case 1: {
							$check_login = "SELECT id, username, name, phone, password FROM tbl_customer WHERE username='$username' AND password='$password' ";
							$result_check = $this->db->select($check_login);
							break;
						}
				}

				if ($result_check != false) {
					$value = $result_check->fetch_assoc();
					$customer_id = $value['id'];
					Session::set('loginAlert', true);
					Session::set('customer_login', true);
					Session::set('customer_id', $customer_id);
					Session::set('customer_username', $value['username']);
					Session::set('customer_name', $value['name']);

					switch ($account_type) {
						case 0: {
								Session::set('account_type', 0);
								Session::set('avatar', $value['avatar']);
								break;
							}
						case 1: {
								Session::set('account_type', 1);
								Session::set('avatar', "https://graph.facebook.com/" . $username . "/picture?type=normal");
								break;
							}
					}
					$extra = Session::get('REQUEST_URI');
					if ($value['phone'] == null) {
						$header = "profile.html";
					} else {
						if ($extra == "") {
							$header = "index.html";
						} else {
							$header = $extra;
						}
					}

					$query = "SELECT COUNT(customerId) AS countCart FROM tbl_cart where customerId = '$customer_id'";
					$check_quantity_cart = $this->db->select($query)->fetch_assoc();
					session::set('number_cart', (int)$check_quantity_cart['countCart']);
					return json_encode($result_json[] = ['status' => 1, 'url' => $header]);
				} else {
					return json_encode($result_json[] = ['status' => 2, 'content' => 0]);
				}
			}
			$this->connection->close();
		}
	}


	public function login_customer($date)
	{
		// 0 tên đnăg nhập và mất khẩu không được bỏ trống
		// 1 thành công
		// 2 tên đăng nhập hoặc mật khẩu sai
		$username = $this->fm->validation($date['username']);
		$password = $this->fm->validation($date['password']);

		$username =  $date['username'];
		$password = md5($date['password']);
		if ($username == '' || $password == '') {
			return json_encode($result_json[][] = ['status' => 0, 'content' => 0]);
		} else {
			$check_login = "SELECT id, username, name, avatar, phone, password FROM tbl_customer WHERE username='$username' AND password='$password' ";
			$result_check = $this->db->select($check_login);
			if ($result_check != false) {

				$value = $result_check->fetch_assoc();
				$customer_id = $value['id'];
				Session::set('loginAlert', true);
				Session::set('customer_login', true);
				Session::set('account_type', 0);
				Session::set('customer_id', $customer_id);
				Session::set('customer_username', $value['username']);
				Session::set('customer_name', $value['name']);
				Session::set('avatar', $value['avatar']);
				$extra = Session::get('REQUEST_URI');
				if ($value['phone'] == null) {
					$header = "profile.html";
				} else {
					if ($extra == "") {
						$header = "index.html";
					} else {
						$header = $extra;
					}
				}
				$query = "SELECT COUNT(customerId) AS countCart FROM tbl_cart where customerId = '$customer_id'";
				$check_quantity_cart = $this->db->select($query)->fetch_assoc();
				session::set('number_cart', (int)$check_quantity_cart['countCart']);


				$name = 'is_login';
				$value = json_encode($result_cookie[] = ['username' => $username, 'password' => $password, 'type' => 0]);
				$expire = time() + 3600;
				$path = '/';
				setcookie($name, $value, $expire, $path);

				return json_encode($result_json[] = ['status' => 1, 'url' => $header]);
			} else {
				return json_encode($result_json[] = ['status' => 2, 'content' => 0]);
			}
		}
		$this->connection->close();
	}

	//Hàm login sau khi mạng xã hội trả dữ liệu về
	function loginFromSocialCallBack($socialUser, $accessToken)
	{
		$socialUser_id = mysqli_real_escape_string($this->db->link, $socialUser['id']);
		$socialUser_name = mysqli_real_escape_string($this->db->link, $socialUser['name']);
		$socialUser_email = mysqli_real_escape_string($this->db->link, $socialUser['email']);
		$accessToken = mysqli_real_escape_string($this->db->link, md5($accessToken));

		$check_loginFromSocial = "SELECT id, username, name, password FROM tbl_customer WHERE username='$socialUser_id'";
		$result_check = $this->db->select($check_loginFromSocial);

		// kiểm tra đăng ký thì insert
		if ($result_check == false) {
			$insert_customerSocial = "INSERT INTO tbl_customer(username, name, email, password) VALUES('$socialUser_id', '$socialUser_name', '$socialUser_email', '$accessToken')";
			$insert_customer = $this->db->insert($insert_customerSocial);

			if ($insert_customer) {
				$select_loginFromSocial = "SELECT id, username, name, phone, password FROM tbl_customer WHERE username='$socialUser_id'";
				$result = $this->db->select($select_loginFromSocial);
				$value_select = $result->fetch_assoc();

				Session::set('loginAlert', true);
				Session::set('customer_login', true);
				Session::set('account_type', 1);
				Session::set('customer_id', $value_select['id']);
				Session::set('customer_username', $socialUser_id);
				Session::set('customer_name', $value_select['name']);
				Session::set('avatar', "https://graph.facebook.com/" . $socialUser_id . "/picture?type=normal");
				$extra = Session::get('REQUEST_URI');
				if ($value_select['phone'] == null) {
					header("Location: profile.html");
				} else {
					if ($extra == "") {
						header("Location: index.html");
					} else {
						header("Location: $extra");
					}
				}

				$name = 'is_login';
				$value = json_encode($result_cookie[] = ['username' => $socialUser_id, 'password' => $value_select['password'], 'type' => 1]);
				$expire = time() + 3600;
				$path = '/';
				setcookie($name, $value, $expire, $path);

				$customer_id = $value_select['id'];
				$query = "SELECT COUNT(customerId) AS countCart FROM tbl_cart where customerId = '$customer_id'";
				$check_quantity_cart = $this->db->select($query)->fetch_assoc();
				session::set('number_cart', (int)$check_quantity_cart['countCart']);
				return "Liên kết với Facebook thành công!";
			} else {
				return "Liên kết với Facebook thất bại!";
			}
		} else {
			$value = $result_check->fetch_assoc();
			$customer_id = $value['id'];

			Session::set('loginAlert', true);
			Session::set('customer_login', true);
			Session::set('account_type', 1);
			Session::set('customer_id', $customer_id);
			Session::set('customer_username', $socialUser_id);
			Session::set('customer_name', $value['name']);
			Session::set('avatar', "https://graph.facebook.com/" . $socialUser_id . "/picture?type=normal");

			$name = 'is_login';
			$value = json_encode($result_cookie[] = ['username' => $socialUser_id, 'password' => $value['password'], 'type' => 1]);
			$expire = time() + 3600;
			$path = '/';
			setcookie($name, $value, $expire, $path);

			$extra = Session::get('REQUEST_URI');
			if ($value['phone'] == null) {
				header("Location: profile.html");
			} else {
				if ($extra == "") {
					header("Location: index.html");
				} else {
					header("Location: $extra");
				}
			}

			$query = "SELECT COUNT(customerId) AS countCart FROM tbl_cart where customerId = '$customer_id'";
			$check_quantity_cart = $this->db->select($query)->fetch_assoc();
			session::set('number_cart', (int)$check_quantity_cart['countCart']);
			return "Đăng nhập Facebook thành công!";
		}
		$this->connection->close();
	}

	public function show_customers($id)
	{
		$query = "SELECT username, name, avatar, date_of_birth, gender, phone, email, maps_maplat, maps_maplng, date_Joined FROM tbl_customer WHERE id='$id' ";
		$result = $this->db->select($query);
		return $result;
		$this->connection->close();
	}

	public function show_AllCustomersAdmin()
	{
		$query = "SELECT id, username, name, maps_maplat, maps_maplng, date_Joined FROM tbl_customer
        ORDER BY id DESC";
		$show_AllCustomersAdmin = $this->db->select($query);
		return $show_AllCustomersAdmin;
	}

	public function delete_customer($customerId)
	{
		$customer_id = mysqli_real_escape_string($this->db->link, $customerId);
		$query = "DELETE FROM tbl_customer WHERE id='$customer_id' ";
		$result = $this->db->delete($query);
		if ($result) {
			return json_encode($result_json[] = ['status' => 1]);
		} else {
			return json_encode($result_json[] = ['status' => 0]);
		}
		return $result;
	}

	// public function update_customers($data, $id)
	// {
	// 	$fullName = mysqli_real_escape_string($this->db->link, $data['fullName']);
	// 	$gender = mysqli_real_escape_string($this->db->link, $data['gender']);
	// 	$avatarold = mysqli_real_escape_string($this->db->link, $data['avatarold']);
	// 	$date_of_birth = mysqli_real_escape_string($this->db->link, $data['date_of_birth']);
	// 	$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
	// 	$email = mysqli_real_escape_string($this->db->link, $data['email']);
	// 	$maps_maplat = mysqli_real_escape_string($this->db->link, $data['maps_maplat']);
	// 	$maps_maplng = mysqli_real_escape_string($this->db->link, $data['maps_maplng']);

	// 	$file_name = $_FILES['avatar']['name'];
	// 	//dinh dang ten file
	// 	$div = explode('.', $file_name);
	// 	$file_ext = strtolower(end($div));
	// 	$unique_image = substr(md5($id . " " . $file_name), 0, 32) . '.' . $file_ext;
	// 	//Thư mục bạn sẽ lưu file upload
	// 	$target_dir    = "upload/avatars/" . $unique_image;
	// 	//Vị trí file lưu tạm trong server
	// 	$target_file   = $target_dir;
	// 	$update_target_dir = $unique_image;

	// 	$allowUpload   = true;
	// 	//Lấy phần mở rộng của file
	// 	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	// 	$maxfilesize   = 1000000; //(bytes) 2100000byte = 1mb

	// 	////Những loại file được phép upload
	// 	$allowtypes    = array('jpg', 'png', 'jpeg', 'gif', null);

	// 	if (isset($_POST["save"])) {
	// 		//Kiểm tra xem có phải là ảnh
	// 		$check = ($_FILES["avatar"]["tmp_name"]);
	// 		if ($check != false) {
	// 			//echo "Đây là file ảnh - " . $check["mime"] . ".";
	// 			$allowUpload = true;
	// 		} else {
	// 			//echo "Không phải file ảnh.";
	// 			$allowUpload = false;
	// 		}
	// 	}

	// 	// Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
	// 	if (file_exists($target_file)) {
	// 		//echo "File đã tồn tại.";
	// 		$allowUpload = false;
	// 	}
	// 	// // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
	// 	if ($_FILES["avatar"]["size"] > $maxfilesize) {
	// 		$alert = "<span class='success'>Không được upload ảnh lớn hơn 2MB.</span>";
	// 		return $alert;
	// 		$allowUpload = false;
	// 	}

	// 	// Kiểm tra kiểu file
	// 	if (!in_array($imageFileType, $allowtypes)) {
	// 		echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
	// 		$allowUpload = false;
	// 	}

	// 	$files = glob("upload/avatars/$avatarold"); // get all file names
	// 	foreach ($files as $file) { // iterate files

	// 		if (is_file($file))
	// 			if ($_FILES["avatar"]["tmp_name"] == null) {
	// 				break;
	// 			} else {
	// 				unlink($file); // delete file
	// 			}
	// 	}

	// 	// Check if $uploadOk is set to 0 by an error
	// 	if ($allowUpload) {
	// 		move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
	// 	}

	// 	if ($fullName == "" || $gender == "" || $date_of_birth == "" || $phone == "" || $email == "" || $maps_maplat == "" || $maps_maplng == "") {
	// 		$alert = '<p style="color: red;">Các trường không được bỏ trống!</p>';
	// 		return $alert;
	// 	} else {
	// 		$patternPhone = '/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/';
	// 		$parttenEmail = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
	// 		$year_of_birth = date('Y', strtotime($date_of_birth));
	// 		$date = getdate();
	// 		$yearnow =  $date['year'];
	// 		if (($yearnow - $year_of_birth) < 12) {
	// 			$alert = '<p style="color: red;">- Năm sinh của bạn phải trên 12 tuổi</p>';
	// 			return $alert;
	// 		} elseif (!preg_match($patternPhone, $phone)) {
	// 			$alert = '<p style="color: red;">- Số điện thoại bạn vừa nhập không đúng định dạng!
	// 			 <br> + Bắt bộc phải có Ký tự @
	// 			 <br> + Nhóm ký tự trước @ có 6-32 ký tự
	// 			 <br> + Nhóm ký tự sau @ là domain một hoặc nhiều cấp
	// 			 </p>';
	// 			return $alert;
	// 		} elseif (!preg_match($parttenEmail, $email)) {
	// 			$alert = '<p style="color: red;">- Email bạn vừa nhập không đúng định dạng!
	// 			<br> + Bắt bộc phải có Ký tự @
	// 			<br> + Nhóm ký tự trước @ có 6-32 ký tự
	// 			<br> + Nhóm ký tự sau @ là domain một hoặc nhiều cấp
	// 			</p>';
	// 			return $alert;
	// 		} else {
	// 			if ($allowUpload == false) {
	// 				$query = "UPDATE tbl_customer SET name='$fullName',gender='$gender',date_of_birth= '$date_of_birth',phone='$phone',email='$email',maps_maplat='$maps_maplat', maps_maplng='$maps_maplng' WHERE id ='$id'";
	// 				$result = $this->db->insert($query);
	// 			} else {
	// 				$query = "UPDATE tbl_customer SET name='$fullName',gender='$gender',avatar='$update_target_dir',date_of_birth= '$date_of_birth',phone='$phone',email='$email',maps_maplat='$maps_maplat', maps_maplng='$maps_maplng' WHERE id ='$id'";
	// 				$result = $this->db->insert($query);
	// 			}

	// 			if ($result) {
	// 				$alert = '<p style="color: #7fad39;">Bạn đã cập nhật thông tin thành công!</p>';
	// 				return $alert;
	// 			} else {
	// 				$alert = '<p style="color: red;">Bạn đã cập nhật thông tin không thành công!</p>';
	// 				return $alert;
	// 			}
	// 		}
	// 	}
	// }

	public function update_customers($data, $id)
	{
		// 0 thất bại
		// 1 thành công
		// 2 các trường ko được bỏ trống
		// 3 số điện thoại sai cú pháp
		// 4 email sai cú pháp
		$fullName = $this->fm->validation($data['fullName']);
		$gender = $this->fm->validation($data['gender']);
		$date_of_birth = $this->fm->validation($data['date_of_birth']);
		$phone = $this->fm->validation($data['phone']);
		$email = $this->fm->validation($data['email']);
		$maps_maplat = $this->fm->validation($data['maps_maplat']);
		$maps_maplng = $this->fm->validation($data['maps_maplng']);

		$fullName = mysqli_real_escape_string($this->db->link, $data['fullName']);
		$gender = mysqli_real_escape_string($this->db->link, $data['gender']);
		$date_of_birth = mysqli_real_escape_string($this->db->link, $data['date_of_birth']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$maps_maplat = mysqli_real_escape_string($this->db->link, $data['maps_maplat']);
		$maps_maplng = mysqli_real_escape_string($this->db->link, $data['maps_maplng']);

		if ($fullName == "" || $gender == "" || $date_of_birth == "" || $phone == "" || $email == "" || $maps_maplat == "" || $maps_maplng == "") {
			return  json_encode($result_json[] = ['status' => 2]);
		} else {
			$patternPhone = '/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/';
			$parttenEmail = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
			if (!preg_match($patternPhone, $phone)) {
				return  json_encode($result_json[] = ['status' => 3]);
			} elseif (!preg_match($parttenEmail, $email)) {
				return  json_encode($result_json[] = ['status' => 4]);
			} else {
				$query = "UPDATE tbl_customer SET name='$fullName',gender='$gender',date_of_birth= '$date_of_birth',phone='$phone',email='$email',maps_maplat='$maps_maplat', maps_maplng='$maps_maplng' WHERE id ='$id'";
				$result = $this->db->insert($query);

				if ($result) {
					return  json_encode($result_json[] = ['status' => 1]);
				} else {
					return  json_encode($result_json[] = ['status' => 0]);
				}
			}
		}
		$this->connection->close();
	}

	public function update_avatar($data, $id)
	{
		$id = $this->fm->validation($id);
		$id = mysqli_real_escape_string($this->db->link, $id);
		$urlAvatarImage = mysqli_real_escape_string($this->db->link, $data['urlAvatarImage']);

		$query = "UPDATE tbl_customer SET avatar='$urlAvatarImage' WHERE id ='$id'";
		$result = $this->db->insert($query);

		if ($result) {
			Session::set('avatar', $urlAvatarImage);
			//Bạn đã cập nhật avatar thành công!
			return  json_encode($result_json[] = ['status' => 1]);
		} else {
			//Bạn đã cập nhật avatar không thành công!
			return  json_encode($result_json[] = ['status' => 0]);
		}
	}


	// public function update_avatar($data, $id)
	// {
	// 	$avatarold = mysqli_real_escape_string($this->db->link, $data['avatarold']);
	// 	$id = $this->fm->validation($id);
	// 	$id = mysqli_real_escape_string($this->db->link, $id);

	// 	$file_name = $_FILES['avatar']['name'];
	// 	if ($file_name != null) {
	// 		//dinh dang ten file
	// 		$div = explode('.', $file_name);
	// 		$file_ext = strtolower(end($div));
	// 		$unique_image = substr(md5($id . " " . $file_name), 0, 32) . '.' . $file_ext;
	// 		//Thư mục bạn sẽ lưu file upload
	// 		$target_dir    = "~/../../upload/avatars/" . $unique_image;
	// 		//Vị trí file lưu tạm trong server
	// 		$target_file   = $target_dir;
	// 		$update_target_dir = $unique_image;

	// 		$allowUpload   = true;
	// 		//Lấy phần mở rộng của file
	// 		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	// 		$maxfilesize   = 1000000; //(bytes) 2100000byte = 1mb

	// 		////Những loại file được phép upload
	// 		$allowtypes    = array('jpg', 'png', 'jpeg', 'gif', null);

	// 		// if (isset($_POST["save"])) {
	// 		//Kiểm tra xem có phải là ảnh
	// 		$check = ($_FILES["avatar"]["tmp_name"]);
	// 		if ($check != false) {
	// 			//echo "Đây là file ảnh - " . $check["mime"] . ".";
	// 			$allowUpload = true;
	// 		} else {
	// 			//echo "Không phải file ảnh.";
	// 			$allowUpload = false;
	// 		}
	// 		//}

	// 		// Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
	// 		if (file_exists($target_file)) {
	// 			//echo "File đã tồn tại.";
	// 			$allowUpload = false;
	// 		}
	// 		// // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
	// 		if ($_FILES["avatar"]["size"] > $maxfilesize) {
	// 			// ảnh phải nhỏ hơn 1 MB
	// 			return  json_encode($result_json[] = ['status' => 3, 'srcImage' => 0]);
	// 			$allowUpload = false;
	// 		}

	// 		// Kiểm tra kiểu file
	// 		if (!in_array($imageFileType, $allowtypes)) {
	// 			return "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
	// 			$allowUpload = false;
	// 		}

	// 		$files = glob("~/../../upload/avatars/$avatarold"); // get all file names
	// 		foreach ($files as $file) { // iterate files

	// 			if (is_file($file))
	// 				if ($_FILES["avatar"]["tmp_name"] == null) {
	// 					break;
	// 				} else {
	// 					unlink($file); // delete file
	// 				}
	// 		}

	// 		// Check if $uploadOk is set to 0 by an error
	// 		if ($allowUpload) {
	// 			move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
	// 		}

	// 		$query = "UPDATE tbl_customer SET avatar='$update_target_dir' WHERE id ='$id'";
	// 		$result = $this->db->insert($query);

	// 		if ($result) {
	// 			Session::set('avatar', $update_target_dir);
	// 			//Bạn đã cập nhật avatar thành công!
	// 			return  json_encode($result_json[] = ['status' => 1, 'srcImage' => $update_target_dir]);
	// 		} else {
	// 			//Bạn đã cập nhật avatar không thành công!
	// 			return  json_encode($result_json[] = ['status' => 0, 'srcImage' => 0]);
	// 		}
	// 	} else {
	// 		// Avatar này đang tồn tại
	// 		return  json_encode($result_json[] = ['status' => 2, 'srcImage' => 0]);
	// 	}
	// }

	public function update_customers_password($customer_id, $data)
	{
		// 0 Mật khẩu cũ, mật khẩu mới và nhập lại mật khẩu không được phét bỏ trống
		// 1 Đổi mật khẩu thành công
		// 2 Mật khẩu bạn vừa nhập không đúng định dạng
		// 3 Mật khẩu cũ bạn vừa nhập ko đúng
		// 4 Xác nhận mật khẩu ko chính xác
		$passold = $data['passwordold'];
		$passnew1 = $data['passwordnew1'];
		$passnew2 = $data['passwordnew2'];

		$pass_old = $this->fm->validation(md5($data['passwordold']));
		$pass_new1 = $this->fm->validation(md5($data['passwordnew1']));
		$pass_new2 = $this->fm->validation(md5($data['passwordnew2']));

		$pass_old = mysqli_real_escape_string($this->db->link, md5($data['passwordold']));
		$pass_new1 = mysqli_real_escape_string($this->db->link, md5($data['passwordnew1']));
		$pass_new2 = mysqli_real_escape_string($this->db->link, md5($data['passwordnew2']));

		if (empty($passold) || empty($passnew1) || empty($passnew2)) {
			return json_encode($result_json[] = ['status' => 0]);
		} else {
			if ($pass_new2 == $pass_new1) {
				$partten = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
				if (!preg_match($partten, $passnew2)) {
					return json_encode($result_json[] = ['status' => 2]);
				} else {
					$query = "SELECT id, password FROM tbl_customer WHERE id  = '$customer_id' AND password = '$pass_old' LIMIT 1";
					$result = $this->db->select($query);
					if ($result != false) {
						$query = "UPDATE tbl_customer SET password = '$pass_new2' where id = '$customer_id' LIMIT 1 ";
						$query = $this->db->insert($query);
						return json_encode($result_json[] = ['status' => 1]);
					} else {
						return json_encode($result_json[] = ['status' => 3]);
					}
				}
			} else {
				return json_encode($result_json[] = ['status' => 4]);
			}
			$this->connection->close();
		}
	}


	public function findEmailForgot($email)
	{
		// 0 email ko được phét bỏ trống
		// 1 đã lấy thông tin thành công
		// 2 email ko tồn tại trọng hệ thống

		$email = mysqli_real_escape_string($this->db->link, $email);

		if (empty($email)) {
			return json_encode($result_json[] = ['status' => 0]);
		} else {
			$query = "SELECT username, name, password FROM tbl_customer WHERE email = '$email'  LIMIT 1";
			$result = $this->db->select($query);
			if ($result) {
				while ($infor = $result->fetch_assoc()) {
					$username = $infor['username'];
					$name = $infor['name'];
					$password = $infor['password'];
				}
				return json_encode($result_json[] = ['status' => 1, 'username' => $username, 'name' => $name, 'password' => $password]);
			} else {
				return json_encode($result_json[] = ['status' => 2]);
			}
			$this->connection->close();
		}
	}
}
?>