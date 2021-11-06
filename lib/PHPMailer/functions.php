<?php
// $user = "Cskhkabistore@gmail.com";
// $password = "hoangthao123";
$user = "hotrokhachhang@kabistore.tk";
$password = "sieubaomat96308520@";

function sendMail($user, $password, $title, $content, $nTo, $mTo, $diachicc = '')
{
	$nFrom = 'Kabistore.tk';
	$mFrom = $user;	//dia chi email cua ban 
	$mPass = $password;		//mat khau email cua ban
	$mail             = new PHPMailer();
	$body             = $content;
	$mail->IsSMTP();
	$mail->CharSet 	= "utf-8";
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;                  	// enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "mail.kabistore.tk"; //smtp.gmail.com
	$mail->Port       = 465;
	$mail->Username   = $mFrom;  // GMAIL username
	$mail->Password   = $mPass;           	 // GMAIL password
	$mail->SetFrom($mFrom, $nFrom);
	//chuyen chuoi thanh mang
	$ccmail = explode(',', $diachicc);
	$ccmail = array_filter($ccmail);
	if (!empty($ccmail)) {
		foreach ($ccmail as $k => $v) {
			$mail->AddCC($v);
		}
	}
	$mail->Subject    = $title;
	$mail->MsgHTML($body);
	$address = $mTo;
	$mail->AddAddress($address, $nTo);
	$mail->AddReplyTo('hotrokhachhang@kabistore.tk', 'https://kabistore.tk');
	if (!$mail->Send()) {
		return 0;
	} else {
		return 1;
	}
}

function sendMailAttachment($user, $password, $title, $content, $nTo, $mTo, $diachicc = '', $file, $filename)
{
	$nFrom = 'Kabistore.tk';
	$mFrom = $user;	//dia chi email cua ban 
	$mPass = $password;		//mat khau email cua ban
	$mail             = new PHPMailer();
	$body             = $content;
	$mail->IsSMTP();
	$mail->CharSet 	= "utf-8";
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;                  	// enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";
	$mail->Port       = 465;
	$mail->Username   = $mFrom;  // GMAIL username
	$mail->Password   = $mPass;           	 // GMAIL password
	$mail->SetFrom($mFrom, $nFrom);
	//chuyen chuoi thanh mang
	$ccmail = explode(',', $diachicc);
	$ccmail = array_filter($ccmail);
	if (!empty($ccmail)) {
		foreach ($ccmail as $k => $v) {
			$mail->AddCC($v);
		}
	}
	$mail->Subject    = $title;
	$mail->MsgHTML($body);
	$address = $mTo;
	$mail->AddAddress($address, $nTo);
	$mail->AddReplyTo('admin@kabistore.tk', 'kabistore.tk');
	$mail->AddAttachment($file, $filename);
	if (!$mail->Send()) {
		return 0;
	} else {
		return 1;
	}
}
