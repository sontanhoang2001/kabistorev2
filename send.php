<?php
include 'lib/session.php';
Session::init();
include 'helpers/format.php';
$fm = new Format();

$customer_username = Session::get('customer_username');
$customer_name = Session::get('customer_name');
$grandTotal =  session::get("grandTotal");
$numberOfOrders = session::get("numberOfOrders");

//goi thu vien
include 'lib/PHPMailer/class.smtp.php';
include "lib/PHPMailer/class.phpmailer.php";
include "lib/PHPMailer/functions.php";
$title = 'THÔNG BÁO CÓ ĐƠN ĐẶT HÀNG MỚI';
$content = 'test';
$nTo = 'Gửi đến Admin';
// $mTo = 'hoangsonytb123@gmail.com';
$diachi = 'hotrokhachhang@kabistore.com.vn';

// $to = array(
//     'hoangsonytb123@gmail.com',
//     'sthoanga19057@cusc.ctu.edu.vn',
//     'phuongthaocmc7f@gmail.com'
// );
$to = array(
    'hoangsonytb123@gmail.com',
);
foreach ($to as $mTo) {
    $mail = sendMail($user, $password, $title, $content, $nTo, $mTo, $diachi = '');
}
if ($mail == 1)
    echo json_encode($result_json[] = ['status' => 1]); // gửi email thành công
else echo json_encode($result_json[] = ['status' => 0]); // gửi email thất bại