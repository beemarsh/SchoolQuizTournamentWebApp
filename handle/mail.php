<?php
define('session-cookie_check',TRUE);
// define('mail_check',TRUE);
define('mailer_check',TRUE);
define('credential_check',TRUE);
if(!defined('mail_check')){
    include 'error.php';
    exit();
}
if(!defined('resend')){
require 'PHPMailerAutoload.php';
require 'credential.php';
}else{
    require 'handle/PHPMailerAutoload.php';
    require 'handle/credential.php';
}
$mail = new PHPMailer;

$mail->SMTPDebug = 4;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = EMAIL;
$mail->Password = PASS;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom(EMAIL, 'Quizee');
$mail->addAddress($email);
$mail->addReplyTo(EMAIL);
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Password Reset';
$link='http://localhost/quizee/handle/verify?c1='.$temp_userid.'&c66='.$pin_encrypt;

$mail->Body    ="
<div style='width: 100%;height: 100%;display: flex;justify-content: center;align-items: center;'>
<section style='width: 100%;'>
<header style='padding: 20px;background: dodgerblue;color:white;'>
     <h1 style='font: 28px poppins;text-align:center;text-emphasis: weight;'>Omni Quiz :Password Reset</h1>
</header>
<div  style='background: whitesmoke;padding: 50px;font: 20px passion;'>
    <p> Password Reset <br>
     <p style='margin: 20px; font-size:2em;'>
     Verification code:<b>$pin</b></p>
     <a href=$link style='text-align:center;margin:0px 40px;text-decoration: none;color:white;display: block;'>
     <div style='font: 25px poppins;padding:5px;background: dodgerblue;width: 20vw;margin: auto;'>Verify Account</div></a>

     <p style='margin: 5px;'>If you are having any issues,Contact us on <a href='https://www.facebook.com/beemars.vhushaal'>Facebook</a>
         <br> <h2>Keep learning :) </h2>
     </p>
</div>
</section>
</div>
";
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
if(!$mail->send()) {
    // echo 'Message could not be sent.';
    $_SESSION['error1']="Sorry error communicatiing with mail server";
    if(!defined('resend')){
    header('location:../forgotpassword');
    }else{
        echo 'Error';
    }
    exit();
}
echo 1;
?>