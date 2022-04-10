<?php
define('sql-connection_check',TRUE);
define('verifyemail_check',TRUE);
define('credential_check',TRUE);
define('mail_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
session_start();
    include 'sql-connection.php';
    require_once 'VerifyEmail.class.php';
    include 'credential.php';
    if(empty($_POST['fullname'])){
        $_SESSION['error']='Please enter your name';
        header('location:../register');
        exit();
    }else{
        $name=mysqli_real_escape_string($sql_connect,$_POST['fullname']);
    }
    if(empty($_POST['emailid'])){
        $_SESSION['error']='Please enter your email';
        header('location:../register');
        exit();
    }else{
        $email=mysqli_real_escape_string($sql_connect,$_POST['emailid']);
    }
    if(empty($_POST['username'])){
        $_SESSION['error']='Please enter your username';
        header('location:../register');
        exit();
    }else{
        $username=mysqli_real_escape_string($sql_connect,$_POST['username']);
    }
    if(empty($_POST['password'])){
        $_SESSION['error']='Please enter your password';
        header('location:../register');
        exit();
    }else{
        $password=mysqli_real_escape_string($sql_connect,$_POST['password']);
    }
    if(strlen($password)<8){
        $_SESSION['error']='Password should be at least 8 character';
        header('location:../register');
        exit();
    }
    if(strlen($username)<6){
        $_SESSION['error']='Username should be at least 6 character';
        header('location:../register');
        exit();
    }
    $check_email="SELECT * FROM account WHERE email='$email'";
    $query_check_email=mysqli_query($sql_connect,$check_email);
    $check_username="SELECT * FROM account WHERE username='$username'";
    $query_check_username=mysqli_query($sql_connect,$check_username);

    $row_email=mysqli_num_rows($query_check_email);
    if($row_email>=1){
        $_SESSION['error']='Email is already used';
        header('location:../register');
        exit();
    }
    $row_username=mysqli_num_rows($query_check_username);
    if($row_username>=1){
        $_SESSION['error']='Username is already taken';
        header('location:../register');
        exit();
    }
    // Initialize library class
    // $mail = new VerifyEmail();
    // // Set the timeout value on stream
    // // $mail->setStreamTimeoutWait(20);
    // // Set debug output mode
    // // $mail->Debug= TRUE;
    // // $mail->Debugoutput= 'html';
    // // Set email address for SMTP request
    // $mail->setEmailFrom(EMAIL); // you can type what email you want
    // // Check if email is valid and exist
    // $result = $mail->check($email);
    // header('Content-Type: application/json');
    // switch ($result) {
    //     case 0:
    //         $_SESSION['error']= 'E-mail is not valid';
    //         header('location:../register');
    //         exit;
    //         break;
    //   case 1:
    //   define('check-user_cookie_check',TRUE);
    //         include 'mail.php';
    //         break;
    //     case 2:
    //     $_SESSION['error']= 'This is not a valid email address';
    //     header('location:../register');
    //     exit;
    //         break;
    //     case 3:
    //     $_SESSION['error']= 'Please check your internet connection';
    //     header('location:../register');
    //     exit;
    //     break;
    // }
    $record="INSERT INTO account(name,username,email,password) VALUES('$name','$username','$email','$password')";
    mysqli_query($sql_connect,$record);
    $select_user_id="SELECT * FROM account WHERE username='$username' AND password='$password'";
    $select_user_id_query=mysqli_query($sql_connect,$select_user_id);
    $row_check=mysqli_num_rows($select_user_id_query);
    if($row_check==1){
        $row=mysqli_fetch_assoc($select_user_id_query);
        $user_curr_id=$row['id'];
    }
    $rank_record="INSERT INTO user_rank(id) VALUES('$user_curr_id')";
    mysqli_query($sql_connect,$rank_record);
    $_SESSION['register_success']='Congratulations!You have successfully registered<br>Now login with your details.';
    header('location:../login');