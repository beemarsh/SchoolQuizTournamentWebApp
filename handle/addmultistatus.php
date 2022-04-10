<?php
    define('check',TRUE);
    define('sql-connection_check',TRUE);
    if(!isset($_SERVER['HTTP_REFERER'])){
        include 'error.php';
        exit();
    }
    include '../crypt.php';
    include 'sql-connection.php';
    $c=new McryptCipher('passKey');
    $curr_id=$c->decrypt($_COOKIE['hafhk43']);
    $encrypt_code=$_COOKIE['dijfnj'];
    $d=new McryptCipher('passKey');
    $code_decrypt=$d->decrypt($encrypt_code);
    $check_quer="SELECT * FROM multiplay WHERE id=$curr_id AND status='1'";
    $check_quer_query=mysqli_query($sql_connect,$check_quer);
    $no_check=mysqli_num_rows($check_quer_query);
    if($no_check!==1){
        $new_query="UPDATE multiplay SET status=1";
        echo "Could'nt perform the request";
        exit();
    }
    $checkfirstuser="SELECT * FROM jointable WHERE id='$curr_id'";
    $checkfirstuser_query=mysqli_query($sql_connect,$checkfirstuser);
    $num_if_exist=mysqli_num_rows($checkfirstuser_query);
    if($num_if_exist!==0){
        $now_new="UPDATE jointable SET code=$code_decrypt,status=2 WHERE id=$curr_id";
    }else{
        $now_new="INSERT INTO jointable (id,code,status) VALUES($curr_id,$code_decrypt,2)";
    }
    mysqli_query($sql_connect,$now_new);
    echo 1;
?>