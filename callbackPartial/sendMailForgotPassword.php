<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include_once "../classes/customer.php";
	$cs = new customer();

	$email =  $_POST['email'];
	$findEmailForgot = $cs->findEmailForgot($email);

	$result_infor = json_decode($findEmailForgot);
	$status = $result_infor->status;
	$name = $result_infor->name;
	$password = $result_infor->password;
	if ($status == 2) {
		echo json_encode($result_json[] = ['status' => 2]); // email ko tồn tại trong hệ thống
	}
	if ($status == 0) {
		echo json_encode($result_json[] = ['status' => 3]); // email ko đc bỏ trống
	}

	// giải md5 to string
	$hash = $password;
	$hash_type = "md5";
	$emailAPI = "hoangsonytb123@gmail.com";
	$code = "01564c9af82dcb78";
	$responsePassword = file_get_contents("https://md5decrypt.net/en/Api/api.php?hash=" . $hash . "&hash_type=" . $hash_type . "&email=" . $emailAPI . "&code=" . $code);
	$check_responsePassword = substr($responsePassword, 13);
	if (!$check_responsePassword == "003") {
		//goi thu vien
		include('../lib/PHPMailer/class.smtp.php');
		include "../lib/PHPMailer/class.phpmailer.php";
		include "../lib/PHPMailer/functions.php";
		$title = 'Test Khôi phục mật khẩu';
		$content = 'Mật khẩu khôi phục của bạn là: ' . $responsePassword;
		$nTo = 'Gửi đến ' . $name;
		$mTo = 'hoangsonytb123@gmail.com';
		$diachi = 'kabistore24h@gmail.com';
		//test gui mail
		$mail = sendMail($user, $password, $title, $content, $nTo, $mTo, $diachi = '');
		if ($mail == 1)
			echo json_encode($result_json[] = ['status' => 1]); // gửi email thành công
		else echo json_encode($result_json[] = ['status' => 0]); // gửi email thất bại
	} else {
		echo json_encode($result_json[] = ['status' => 0]); // gửi email thất bại
	}
}
