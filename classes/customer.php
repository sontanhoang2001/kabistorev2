<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
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

	public function insert_customer($date)
	{
		$username = mysqli_real_escape_string($this->db->link, $date['username']);
		$pass1 = mysqli_real_escape_string($this->db->link, $date['password1']);
		$pass2 = mysqli_real_escape_string($this->db->link, $date['password2']);
		$password2 = mysqli_real_escape_string($this->db->link, md5($date['password2']));

		if ($username == "" || $pass1 == "" || $pass2 == "") {
			$alert = '<p style="color: red;">Cách trường không được bỏ trống!</p>';
			return $alert;
		} else {
			if ($pass2 == $pass1) {
				$parttenUsername = "/^[A-Za-z0-9_\.]{6,32}$/";
				$parttenPassword = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
				if (!preg_match($parttenUsername, $username)) {
					$alert = '<p style="color: red;">- Tên đăng nhập bạn vừa nhập không đúng định dạng!
					<br> + Tên đăng nhập bao gồm các ký tự chữ cái, chữ số, dấu gạch dưới, dấu chấm
					<br> + Độ dài 6-32 ký tự
					<br> + VD: canthofood123456@
					</p>';
					return $alert;
				} elseif (!preg_match($parttenPassword, $pass2)) {
					$alert = '<p style="color: red;">- Mật khẩu bạn vừa nhập không đúng định dạng!
					<br> + Mật khẩu bao gồm các ký chữ cái, chữ số, ký tự đặc biệt, dấu chấm
					<br> + Bắt đầu bằng ký tự in hoa
					<br> + Độ dài 6-32 ký tự
					<br> + VD: canthofood123456@
					</p>';
					return $alert;
				} else {
					$check_username = "SELECT username FROM tbl_customer WHERE username='$username' LIMIT 1";
					$result_check = $this->db->select($check_username);
					if ($result_check) {
						$alert = '<p style="color: red;">Tên đăng nhập đã tồn tại vui lòng thử lại!</p>';
						return $alert;
					} else {
						$query = "INSERT INTO tbl_customer(username,password) VALUES('$username','$password2') ";
						$result = $this->db->insert($query);
						if ($result) {
							$alert = '<p style="color: #7fad39;">Bạn đã đăng ký tài khoản thành công!</p>';
							return $alert;
						} else {
							$alert = '<p style="color: red;">Bạn đã đăng ký tài khoản không thành công!</p>';
							return $alert;
						}
					}
				}
			} else {
				$alert = '<p style="color: red;">Mật khẩu nhập lại của bạn không chính xác!</p>';
				return $alert;
			}
		}
	}

	public function login_customer($date)
	{
		$username =  $date['username'];
		$password = md5($date['password']);
		if ($username == '' || $password == '') {
			$alert = "<span class='error'>Tên đăng nhập và mật khẩu không được để trống!</span>";
			return $alert;
		} else {
			$check_login = "SELECT id, username, phone, password FROM tbl_customer WHERE username='$username' AND password='$password' ";
			$result_check = $this->db->select($check_login);
			if ($result_check != false) {

				$value = $result_check->fetch_assoc();
				$customer_id = $value['id'];
				Session::set('customer_login', true);
				Session::set('customer_id', $customer_id);
				Session::set('customer_username', $value['username']);
				$extra = Session::get('REQUEST_URI');
				if ($value['phone'] == null) {
					header("Location: editprofile.html");
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
			} else {
				$alert = "<span style='color: red;'>Tên đăng nhập hoặc mặt khẩu không đúng!</span>";
				return $alert;
			}
		}
	}

	//Hàm login sau khi mạng xã hội trả dữ liệu về
	function loginFromSocialCallBack($socialUser)
	{
		$socialUser_id = $socialUser['id'];
		$socialUser_name = $socialUser['name'];
		$socialUser_email = $socialUser['email'];

		// echo $_SESSION['fb_user_name'] = $fb_user->getProperty('name');
		// echo $_SESSION['fb_user_email'] = $fb_user->getProperty('email');
		// echo $_SESSION['fb_user_pic'] = $picture['url'];

		$check_loginFromSocial = "SELECT id, username FROM tbl_customer WHERE username='$socialUser_id'";
		$result_check = $this->db->select($check_loginFromSocial);

		if ($result_check == false) {
			$insert_customerSocial = "INSERT INTO tbl_customer(username, name, email) VALUES('$socialUser_id', '$socialUser_name', '$socialUser_email')";
			$insert_customer = $this->db->insert($insert_customerSocial);

			if ($insert_customer) {
				$select_loginFromSocial = "SELECT id, username, phone FROM tbl_customer WHERE username='$socialUser_id'";
				$result = $this->db->select($select_loginFromSocial);
				$value_select = $result->fetch_assoc();

				Session::set('customer_login', true);
				Session::set('customer_id', $value_select['id']);
				Session::set('customer_username', $socialUser_name);
				$extra = Session::get('REQUEST_URI');
				if ($value_select['phone'] == null) {
					header("Location: editprofile.html");
				} else {
					if ($extra == "") {
						header("Location: index.html");
					} else {
						header("Location: $extra");
					}
				}

				$customer_id = $value_select['id'];
				$query = "SELECT COUNT(customerId) AS countCart FROM tbl_cart where customerId = '$customer_id'";
				$check_quantity_cart = $this->db->select($query)->fetch_assoc();
				session::set('number_cart', (int)$check_quantity_cart['countCart']);
			} else {
				return "đăng nhập Facebook thất bại";
			}
		} else {
			$value = $result_check->fetch_assoc();
			$customer_id = $value['id'];

			Session::set('customer_login', true);
			Session::set('customer_id', $customer_id);
			Session::set('customer_username', $socialUser_name);
			$extra = Session::get('REQUEST_URI');
			if ($value['phone'] == null) {
				header("Location: editprofile.html");
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
		}
		// $result = mysqli_query($con, "Select `id`,`username`,`email`,`fullname` from `user` WHERE `email` ='" . $socialUser['email'] . "'");
		// if ($result->num_rows == 0) {
		//     $result = mysqli_query($con, "INSERT INTO `user` (`fullname`,`email`, `status`, `created_time`, `last_updated`) VALUES ('" . $socialUser['name'] . "', '" . $socialUser['email'] . "', 1, " . time() . ", '" . time() . "');");
		//     if (!$result) {
		//         echo mysqli_error($con);
		//         exit;
		//     }
		//     $result = mysqli_query($con, "Select `id`,`username`,`email`,`fullname` from `user` WHERE `email` ='" . $socialUser['email'] . "'");
		// }
		// if ($result->num_rows > 0) {
		//     $user = mysqli_fetch_assoc($result);
		//     if (session_status() == PHP_SESSION_NONE) {
		//         session_start();
		//     }
		//     $_SESSION['current_user'] = $user;
		//     header('Location: ./login.php');
		// }
	}

	public function show_customers($id)
	{
		$query = "SELECT username, name, avatar, date_of_birth, gender, phone, email, maps_maplat, maps_maplng, date_Joined FROM tbl_customer WHERE id='$id' ";
		$result = $this->db->select($query);
		return $result;
	}

	public function update_customers($data, $id)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$gender = mysqli_real_escape_string($this->db->link, $data['gender']);
		$avatarold = mysqli_real_escape_string($this->db->link, $data['avatarold']);
		$date_of_birth = mysqli_real_escape_string($this->db->link, $data['date_of_birth']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$note = mysqli_real_escape_string($this->db->link, $data['note']);


		$file_name = $_FILES['avatar']['name'];
		//dinh dang ten file
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5($id . " " . $file_name), 0, 32) . '.' . $file_ext;
		//Thư mục bạn sẽ lưu file upload
		$target_dir    = "admin/uploads/avatars/" . $unique_image;
		//Vị trí file lưu tạm trong server
		$target_file   = $target_dir;
		$update_target_dir = $unique_image;

		$allowUpload   = true;
		//Lấy phần mở rộng của file
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		$maxfilesize   = 2100000; //(bytes) 2100000byte = 2mb

		////Những loại file được phép upload
		$allowtypes    = array('jpg', 'png', 'jpeg', 'gif', null);

		if (isset($_POST["save"])) {
			//Kiểm tra xem có phải là ảnh
			$check = ($_FILES["avatar"]["tmp_name"]);
			if ($check != false) {
				//echo "Đây là file ảnh - " . $check["mime"] . ".";
				$allowUpload = true;
			} else {
				//echo "Không phải file ảnh.";
				$allowUpload = false;
			}
		}

		// Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
		if (file_exists($target_file)) {
			//echo "File đã tồn tại.";
			$allowUpload = false;
		}
		// // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
		if ($_FILES["avatar"]["size"] > $maxfilesize) {
			$alert = "<span class='success'>Không được upload ảnh lớn hơn 2MB.</span>";
			return $alert;
			$allowUpload = false;
		}

		// Kiểm tra kiểu file
		if (!in_array($imageFileType, $allowtypes)) {
			echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
			$allowUpload = false;
		}

		$files = glob("admin/uploads/avatars/$avatarold"); // get all file names
		foreach ($files as $file) { // iterate files

			if (is_file($file))
				if ($_FILES["avatar"]["tmp_name"] == null) {
					break;
				} else {
					unlink($file); // delete file
				}
		}

		// Check if $uploadOk is set to 0 by an error
		if ($allowUpload) {
			move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
		}

		if ($name == "" || $gender == "" || $date_of_birth == "" || $phone == "" || $email == "" || $address == "" || $note == "") {
			$alert = '<p style="color: #7fad39;">Các trường không được bỏ trống!</p>';
			return $alert;
		} else {
			$patternPhone = '/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/';
			$parttenEmail = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
			$year_of_birth = date('Y', strtotime($date_of_birth));
			$date = getdate();
			$yearnow =  $date['year'];
			if (($yearnow - $year_of_birth) < 12) {
				$alert = '<p style="color: red;">- Năm sinh của bạn phải trên 12 tuổi</p>';
				return $alert;
			} elseif (!preg_match($patternPhone, $phone)) {
				$alert = '<p style="color: red;">- Số điện thoại bạn vừa nhập không đúng định dạng!
				 <br> + Bắt bộc phải có Ký tự @
				 <br> + Nhóm ký tự trước @ có 6-32 ký tự
				 <br> + Nhóm ký tự sau @ là domain một hoặc nhiều cấp
				 </p>';
				return $alert;
			} elseif (!preg_match($parttenEmail, $email)) {
				$alert = '<p style="color: red;">- Email bạn vừa nhập không đúng định dạng!
				<br> + Bắt bộc phải có Ký tự @
				<br> + Nhóm ký tự trước @ có 6-32 ký tự
				<br> + Nhóm ký tự sau @ là domain một hoặc nhiều cấp
				</p>';
				return $alert;
			} else {
				if ($allowUpload == false) {
					$query = "UPDATE tbl_customer SET name='$name',gender='$gender',date_of_birth= '$date_of_birth',phone='$phone',email='$email',address='$address', note='$note' WHERE id ='$id'";
					$result = $this->db->insert($query);
				} else {
					$query = "UPDATE tbl_customer SET name='$name',gender='$gender',avatar='$update_target_dir',date_of_birth= '$date_of_birth',phone='$phone',email='$email',address='$address', note='$note' WHERE id ='$id'";
					$result = $this->db->insert($query);
				}

				if ($result) {
					$alert = '<p style="color: #7fad39;">Bạn đã cập nhật thông tin thành công!</p>';
					return $alert;
				} else {
					$alert = '<p style="color: #7fad39;">Bạn đã cập nhật thông tin không thành công!</p>';
					return $alert;
				}
			}
		}
	}


	public function update_customers_location()
	{
	}


	public function update_customers_password($customer_id, $passold, $passnew1, $passnew2)
	{
		$pass_old = mysqli_real_escape_string($this->db->link, md5($passold));
		$pass_new1 = mysqli_real_escape_string($this->db->link, md5($passnew1));
		$pass_new2 = mysqli_real_escape_string($this->db->link, md5($passnew2));

		if (empty($passold) || empty($passnew1) || empty($passnew2)) {
			$alert = '<p style="color: red;">Mật khẩu cũ, mật khẩu mới và nhập lại mật khẩu không được phét bỏ trống!</p>';
			return $alert;
		} else {
			if ($pass_new2 == $pass_new1) {
				$partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
				if (!preg_match($partten, $passnew2)) {
					$alert = '<p style="color: red;">- Mật khẩu bạn vừa nhập không đúng định dạng!
					<br> + Mật khẩu bao gồm các ký chữ cái, chữ số, ký tự đặc biệt, dấu chấm
					<br> + Bắt đầu bằng ký tự in hoa
					<br> + Độ dài 6-32 ký tự
					</p>';
					return $alert;
				} else {
					$query = "SELECT id, password FROM tbl_customer WHERE id  = '$customer_id' AND password = '$pass_old' LIMIT 1";
					$result = $this->db->select($query);
					if ($result != false) {
						$query = "UPDATE tbl_customer SET password = '$pass_new2' where id = '$customer_id' LIMIT 1 ";
						$query = $this->db->insert($query);
						$alert = '<p style="color: #7fad39;">Bạn đã đổi mật khẩu thành công!</p>';
						return $alert;
					} else {
						$alert = '<p style="color: red;">Mật khẩu cũ của bạn đã nhập không đúng!</p>';
						return $alert;
					}
				}
			} else {
				$alert = '<p style="color: red;">Mật khẩu nhập lại của bạn không chính xác!</p>';
				return $alert;
			}
			$this->link = null;
		}
	}
}
?>