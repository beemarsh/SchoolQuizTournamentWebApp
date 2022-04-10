<?php
session_start();
define('check',true);
include '../crypt.php';
define('sql-connection_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
    include 'sql-connection.php';
    if(!isset($_COOKIE['fdgirt3'])){
        include 'error.php';
        exit();
    }
    if(isset($_POST['check_if_submit'])){
        if(isset($_POST['newpass']) && !empty($_POST['newpass'])){
            $newpass=mysqli_real_escape_string($sql_connect,$_POST['newpass']);
        }else{
            $_SESSION['error1']='Fill up all the details';
            header('location:../changepassword');
            exit();
        }
        if(isset($_POST['confirmpass']) && !empty($_POST['confirmpass'])){
            $confirmpass=mysqli_real_escape_string($sql_connect,$_POST['confirmpass']);
        }else{
            $_SESSION['error1']='Fill up all the details';
            header('location:../changepassword');
            exit();
        }
        if(strlen($newpass)<8){
            $_SESSION['error1']='Your new password should be at least 8 characters long';
            header('location:../changepassword');
            exit();
        }
        if($newpass===$confirmpass){
            $current_userid_encrypt=$_COOKIE['fdgirt3'];
            $c = new McryptCipher('passKey');
            $current_userid= $c->decrypt($current_userid_encrypt);
            $select_password="SELECT * FROM account WHERE id='$current_userid'";
            $select_password_query=mysqli_query($sql_connect,$select_password);
            $check_row_pass=mysqli_num_rows($select_password_query);
            if($check_row_pass===1){
                $fetch_pass_data=mysqli_fetch_assoc($select_password_query);
                $old_pass_in_db=$fetch_pass_data['password'];
                if($old_pass_in_db===$newpass && $old_pass_in_db===$confirmpass){
                    $_SESSION['error1']='Your current password and new password are same!<br>Try a new password';
                    header('location:../changepassword');
                    exit();
                }else{                    
            $update_data_pass="UPDATE account SET password='$newpass' WHERE id='$current_userid'";
            mysqli_query($sql_connect,$update_data_pass);
            $_SESSION['error_direct']='Your password is successfully changed';
            setcookie('fdgirt3','',time()-3600,'/');
            unset($_COOKIE['fdgirt3']);
            header('location:../login');
            exit();
                }
            }else{
                $_SESSION['error1']='Sorry!There was an error';
                header('location:../changepassword');
                exit();
            }
        }else{
            $_SESSION['error1']='Your passwords donot match';
            header('location:../changepassword');
            exit();
        }
    }else{
        include 'error.php';
        exit();
    }
?>