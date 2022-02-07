<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function changepassword($passold, $passnew1, $passnew2)
    {
        $pass_old = mysqli_real_escape_string($this->db->link, md5($passold));
        $pass_new1 = mysqli_real_escape_string($this->db->link, md5($passnew1));
        $pass_new2 = mysqli_real_escape_string($this->db->link, md5($passnew2));

        $id = Session::get('adminId');
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
                    $query = "SELECT * FROM tbl_admin WHERE adminId  = '$id' AND adminPass = '$pass_old' LIMIT 1";
                    $result = $this->db->select($query);
                    if ($result != false) {
                        $query = "UPDATE tbl_admin SET adminPass = '$pass_new2' where adminId = '$id' LIMIT 1 ";
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

    public function getAdminUserSendEmail($adminId)
    {
        $adminId = mysqli_real_escape_string($this->db->link, $adminId);
        $query = "SELECT `adminEmail` FROM `tbl_admin` WHERE adminId = '$adminId'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>