<?php
//goi thu vien
include('lib/PHPMailer/class.smtp.php');
include "lib/PHPMailer/class.phpmailer.php";
include "lib/PHPMailer/functions.php";
$title = 'HỖ TRỢ KHÔI PHỤC MẬT KHẨU ĐĂNG NHẬP';
$content = 'ok roi';
$nTo = 'Gửi đến Hoang';
$mTo = "hoangsonytb123@gmail.com";
$diachi = 'hotrokhachhang@kabistore.com.vn';
$mail = sendMail($title, $content, $nTo, $mTo, $diachi = '');

if ($mail == 1)
    echo json_encode($result_json[] = ['status' => 1]); // gửi email thành công
else
    echo json_encode($result_json[] = ['status' => 0]); // gửi email thất bại





// $mail = new PHPMailer;
// //Enable SMTP debugging.
// $mail->SMTPDebug = 3;                           
// //Set PHPMailer to use SMTP.
// $mail->isSMTP();        
// //Set SMTP host name                      
// $mail->Host = "smtp.gmail.com";
// //Set this to true if SMTP host requires authentication to send email
// $mail->SMTPAuth = true;                      
// //Provide username and password
// $mail->Username = "toptopapphostmail@gmail.com";             
// $mail->Password = "bqfhhroqxjbigvvl";                       
// //If SMTP requires TLS encryption then set it
// $mail->SMTPSecure = "tls";                       
// //Set TCP port to connect to
// $mail->Port = 587;                    
// $mail->From = "hoangsonytb123@gmail.com";
// $mail->FromName = "Full Name";
// $mail->addAddress("hoangsonytb123@gmail.com", "Tấn Hoàng");
// $mail->isHTML(true);
// $mail->Subject = "Subject Text";
// $mail->Body = "<i>Mail body in HTML</i>";
// $mail->AltBody = "This is the plain text version of the email content";
// if(!$mail->send())
// {
// echo "Mailer Error: " . $mail->ErrorInfo;
// }
// else
// {
// echo "Message has been sent successfully";
// }