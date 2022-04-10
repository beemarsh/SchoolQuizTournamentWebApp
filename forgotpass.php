<?php
session_start();
define('checkguest',TRUE);
include 'handle/checkguest.php';
if(defined('guest')){
    $_SESSION['errorcode']='x113';
    include 'error.php';
    exit();
}
define('sql-connection_check',TRUE);
define('mail_check',TRUE);
define('check',TRUE);
define('verifyemail_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit();
}
include 'handle/sql-connection.php';
require_once 'handle/VerifyEmail.class.php';
//If code is resend
if(isset($_POST['dated'])){
    define('resend',true);
    $c=new McryptCipher('passKey');
    $userid=$c->decrypt($_POST['dated']);
    $db_query="SELECT * FROM account WHERE id='$userid'";
    $select_db_query=mysqli_query($sql_connect,$db_query);
    $no_rows=mysqli_num_rows($select_db_query);
    if($no_rows!==1){
        echo 'Sorry.There is some error.';
        exit();
    }
    $emailed=mysqli_fetch_assoc($select_db_query);
    $email=$emailed['email'];
    $fetch_data=mysqli_fetch_assoc($select_db_query);
}
else{
if(!isset($_POST['submit'])){
    $_SESSION['error1']='Please fill the details';
    header('location:forgotpassword');
    exit();
}
if(!isset($_POST['emailid'])||empty($_POST['emailid'])){
    $_SESSION['error1']='Please fill the details';
    header('location:forgotpassword');
    exit();
}
$purified_email=mysqli_real_escape_string($sql_connect,$_POST['emailid']);
$email=mysqli_real_escape_string($sql_connect,$purified_email);
$email_check="SELECT * FROM account WHERE email='$email'";
$email_check_query=mysqli_query($sql_connect,$email_check);
$rows=mysqli_num_rows($email_check_query);
if($rows!==1){
    $_SESSION['error1']="This email is not associated with any account";
    header('location:forgotpassword');
    exit();
}
$fetch_data=mysqli_fetch_assoc($email_check_query);
}
top:
$pin=mt_rand(1000000,9999999);
if(mb_strlen($pin)!==7){
    goto top;
}
// Update mail send data
    $db_get_data_resend="SELECT *FROM account WHERE email='$email'";
    $store_data_resend_query=mysqli_query($sql_connect,$db_get_data_resend);
    $store_data_resend=mysqli_fetch_assoc($store_data_resend_query);
    $data_mail_no=$store_data_resend['mail_sent_no']+1;
    $data_mail_time=time();
    $time_difference=time()-$store_data_resend['mail_sent_time'];
    
    if($data_mail_no>3&&$time_difference<86400){
        if(!defined('resend')){
            $_SESSION['error1']='Your have already tried 3 times.Try again after 24 hours.';
            header('location:forgotpassword');
            exit();
        }else{
            echo 'Already sent 3 mails in a day. Try again after 24 hours';
            exit();
        }
    }
    $db_update_resend="UPDATE account SET mail_sent_no='$data_mail_no',mail_sent_time='$data_mail_time' WHERE email='$email'";
    mysqli_query($sql_connect,$db_update_resend);
    // **********************
$pin_time=time();
$db_update="UPDATE account SET pass_pin='$pin',pin_time='$pin_time' WHERE email='$email'";
mysqli_query($sql_connect,$db_update);
$c=new McryptCipher('passKey');
$pin_encrypt_encoded=$c->encrypt($pin);
$pin_encrypt=rawurlencode($pin_encrypt_encoded);
$c = new McryptCipher('passKey');
$temp_userid_encoded = $c->encrypt($fetch_data['id']);
$temp_userid=rawurlencode($temp_userid_encoded);
include 'handle/mail.php';
$cookie_time=time()+60*10;
if(!defined('resend')){
    setcookie('fdgirt3',$temp_userid,$cookie_time,'/');
    header('location:verify');
}
exit();