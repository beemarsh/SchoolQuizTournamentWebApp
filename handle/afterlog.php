<?php
define('sql-connection_check',TRUE);
 if(!defined('afterlog_check')){
     include 'error.php';
     exit;
 }
// session_start();
include 'sql-connection.php';
    if(isset($_COOKIE['hafhk43'])){
        $c = new McryptCipher('passKey');
        $user_id= $c->decrypt($_COOKIE['hafhk43']);
    }else{
        session_start();
        $_SESSION['error_direct']='Please login first';
        header('location:/quizee/login');
        exit();
    }
    if(isset($_COOKIE['nbie09'])){
        $c = new McryptCipher('passKey');
        $user_pic_bigdp= $c->decrypt($_COOKIE['nbie09']);
    }else{
        session_start();
        $_SESSION['error_direct']='Please login first';
        header('location:/quizee/login');
        exit();
    }
    $sel_name="SELECT * FROM account WHERE id='$user_id' ";
    $query_sel_name=mysqli_query($sql_connect,$sel_name);
    $name_user_fetch=mysqli_fetch_assoc($query_sel_name);
    $name_user=$name_user_fetch['name'];
    $username_user=$name_user_fetch['username'];
//     $acc_status=$name_user_fetch['acc_status'];
//     if($acc_status==0){
//         echo "<div class='container'>
//         You are not yet verified
// <a href='#' class='button red'><span>✓</span>Verify now</a>
// </div>";
//     }
?>