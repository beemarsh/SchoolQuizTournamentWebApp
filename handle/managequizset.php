<?php
define('sql-connection_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
    include 'session-cookie_check.php';
    include 'sql-connection.php';
    $userid_encrypt=$_COOKIE['hafhk43'];
    $c = new McryptCipher('passKey');
    $userid= $c->decrypt($userid_encrypt);
    if(isset($_GET['set'])){
        $setname=mysqli_real_escape_string($sql_connect,$_GET['set']);
    }else{
        header('location:../manage_quiz');
        exit();
    }
    $for_select="SELECT * FROM sets WHERE id='$userid' AND setname='$setname'";
    $query_for_select=mysqli_query($sql_connect,$for_select);
    $row_check=mysqli_num_rows($query_for_select);
    if($row_check==0){
        header('location:../manage_quiz');
        exit();
    }
    $data_set=mysqli_fetch_assoc($query_for_select);
    $_SESSION['current_setname']=$data_set['setname'];
    $_SESSION['current_field']=$data_set['field'];
?>