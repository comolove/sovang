<?php
require_once __DIR__ . '/..' . '/vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();

//Server settings
$mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
$mail->isSMTP();                                            // Send using SMTP
$mail->CharSet = 'utf-8';
$mail->Host       = 'smtp.naver.com';                   // Set the SMTP server to send through
$mail->SMTPAuth   = true;                               // Enable SMTP authentication
$mail->Username   = 'yikolden';                     // SMTP username
$mail->Password   = '0!ow1N1593';                               // SMTP password
$mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//Recipients
// $mail->setFrom('ljh34210329@gmail.com', '메일 보내는 사람');
$mail->setFrom('yikolden@naver.com', '메일 보내는 사람');
$mail->addAddress('yikolden@naver.com', "메일 받는 사람");     // Add a recipient
// $mail->addAddress('yikolden@naver.com', "메일 받는 사람");     // Add a recipient

// Attachments
// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if ($mail->send()) {
    echo "Message has been sent";
}
else {
    echo "Message could not be sent";
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>