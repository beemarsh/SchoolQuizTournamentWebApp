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
    if(isset($_POST['submit_check'])){
        if(isset($_POST['name']) && !empty($_POST['name'])){
            $name=mysqli_real_escape_string($sql_connect,$_POST['name']);
            // header("location:javascript://history.go(-1)");
        }else{
            echo 'Fill up your name';
            exit();
        }
        if(isset($_POST['password']) && !empty($_POST['password'])){
            $password=mysqli_real_escape_string($sql_connect,$_POST['password']);
        }else{
            echo 'Enter your password';
            exit();
        }
        $current_userid_encrypt=$_COOKIE['hafhk43'];
        $c = new McryptCipher('passKey');
        $current_userid = $c->decrypt($current_userid_encrypt);
        $select_password="SELECT * FROM account WHERE id='$current_userid' AND password='$password'";
        $select_password_query=mysqli_query($sql_connect,$select_password);
        $check_password_existence=mysqli_num_rows($select_password_query);
        if($check_password_existence===1){
            $fetch_acc_detail=mysqli_fetch_assoc($select_password_query);
            if($fetch_acc_detail['name_change'] > 10){
                echo 'Sorry you have already changed your name 10 times !';
                exit();
            }else{
                $compare_string=strncasecmp($fetch_acc_detail['name'],$name,strlen($name));
                if($compare_string===0){
                    echo 'This name is already in use <br> Choose another name';
                    exit();
                }else{
                $times_change=$fetch_acc_detail['name_change']+1;
                $update_name="UPDATE account SET name='$name',name_change='$times_change' WHERE id='$current_userid' AND password='$password'";
                mysqli_query($sql_connect,$update_name);
                echo 'Success';
                exit();
                }    
            }

        }else{
            echo 'Your password is incorrect';
            exit();
        }
    }else{
        header('location:../my_account');
        exit();
    }
?>