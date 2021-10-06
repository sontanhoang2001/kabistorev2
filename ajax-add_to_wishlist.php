<?php
include 'lib/session.php';
Session::init();

include('config/config.php');
include('helpers/format.php');

$host   = DB_HOST;
$user   = DB_USER;
$pass   = DB_PASS;
$dbname = DB_NAME;

$conn = mysqli_connect($host, $user, $pass, $dbname);

$customer_id = Session::get('customer_id');
$productid = $_POST['productId'];


// $productid = mysqli_real_escape_string($conn, $productid);
// $customer_id = mysqli_real_escape_string($conn, $customer_id);

// Nếu typeId = 1 thì thêm vào wishlist ngược lại thì xóa wishlist
if ($customer_id == null) {
    echo "<script> window.location = 'login.html' </script>";
} else {
    $check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customerId ='$customer_id'";
    $result = $conn->query($check_wlist);
    if ($result->num_rows > 0) {
        // nếu sản phẩm tồn tại thì xóa
        $query_delete = "DELETE FROM tbl_wishlist where productId = '$productid' AND customerId = '$customer_id' ";
        if ($conn->query($query_delete) === TRUE) {
            echo "bạn đã xóa yêu thích thành công";
        } else {
            echo "Bạn đã xóa yêu thích thất bại";
        }
    } else {
        // chưa có sản phẩm thì thêm vào
        $sql = "INSERT INTO tbl_wishlist(productId,customerId) VALUES('$productid','$customer_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Bạn đã thêm sản phẩm vào yêu thích thành công";
        } else {
            echo "Bạn đã thêm sản phẩm vào yêu thích thất bại";
        }
    }
    $conn->close();
}
