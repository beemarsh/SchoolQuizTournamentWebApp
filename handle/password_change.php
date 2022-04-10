<?php
session_start();
define('handlecheckguest',TRUE);
include 'handlecheckguest.php';
if(defined('guest')){
    $_SESSION['errorcode']='x113';
    include 'error.php';
    exit();
}
define('session-cookie_check',TRUE);
define('sql-connection_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
    include 'session-cookie_check.php';
    include 'sql-connection.php';
    if(isset($_POST['check_if_submit'])){
        if(isset($_POST['oldpass']) && !empty($_POST['oldpass'])){
            $oldpass=mysqli_real_escape_string($sql_connect,$_POST['oldpass']);
        }else{
            echo 'Fill up all the details';
            exit();
        }

        if(isset($_POST['newpass']) && !empty($_POST['newpass'])){
            $newpass=mysqli_real_escape_string($sql_connect,$_POST['newpass']);
        }else{
            echo 'Fill up all the details';
            exit();
        }
        if(isset($_POST['confirmpass']) && !empty($_POST['confirmpass'])){
            $confirmpass=mysqli_real_escape_string($sql_connect,$_POST['confirmpass']);
        }else{
            echo 'Fill up all the details';
            exit();
        }
        if(strlen($newpass)<8){
            echo 'Your new password should be at least 8 characters long';
            exit();
        }
        if($newpass===$confirmpass){
            $current_userid_encrypt=$_COOKIE['hafhk43'];
            $c = new McryptCipher('passKey');
            $current_userid= $c->decrypt($current_userid_encrypt);
            $select_password="SELECT * FROM account WHERE id='$current_userid' AND password='$oldpass'";
            $select_password_query=mysqli_query($sql_connect,$select_password);
            $check_row_pass=mysqli_num_rows($select_password_query);
            if($check_row_pass===1){
                $fetch_pass_data=mysqli_fetch_assoc($select_password_query);
                $old_pass_in_db=$fetch_pass_data['password'];
                if($old_pass_in_db===$newpass && $old_pass_in_db===$confirmpass){
                    echo 'Your current password and new password are same!<br>Try a new password';
                    exit();
                }else{                    
            $update_data_pass="UPDATE account SET password='$newpass' WHERE id='$current_userid' AND password='$oldpass'";
            mysqli_query($sql_connect,$update_data_pass);
            echo 'Success';
            exit();
                }
            }else{
                echo 'Your password is wrong';
                exit();
            }
        }else{
            echo 'Your passwords donot match';
            exit();
        }
    }else{
        header('location:../my_account');
        exit();
    }

?>