<?php
    define('check',TRUE);
    define('sql-connection_check',TRUE);
    if(!isset($_SERVER['HTTP_REFERER'])){
        include 'error.php';
        exit();
    }
    include '../crypt.php';
    include 'sql-connection.php';
    if(!isset($_POST['code'])||empty($_POST['code'])){
        echo "Enter your Host code";
        exit();
    }
    $vercode=mysqli_real_escape_string($sql_connect,$_POST['code']);
    $checkIF_data="SELECT * FROM multiplay WHERE code=$vercode AND adm_stat=1";
    $checkIF_data_query=mysqli_query($sql_connect,$checkIF_data);
    $checkIF_data_exists=mysqli_num_rows($checkIF_data_query);
    $HostID=mysqli_fetch_assoc($checkIF_data_query);
    if($checkIF_data_exists==0){
        echo 'The code is invalid Or The Host Admin is Offline';
        exit();
    }
    if($HostID['ready']==1){
        echo 'Sorry! The HOST has already Stopped Adding Users.<br>Contact The Admin To Continue Searching';
        exit();
    }
    $c=new McryptCipher('passKey');
    $curr_user=$c->decrypt($_COOKIE['hafhk43']);
    $jon_me="SELECT * FROM jointable WHERE id=$curr_user";
    $jon_me_query=mysqli_query($sql_connect,$jon_me);
    $jon_me_rows=mysqli_num_rows($jon_me_query);
    if($jon_me_rows==0){
        $insert_me="INSERT INTO jointable(id,code,status) VALUES($curr_user,$vercode,1)";
    }else{
        $insert_me="UPDATE jointable SET code=$vercode,status=1 WHERE id=$curr_user";
    }
    mysqli_query($sql_connect,$insert_me);
     setcookie('dijfnj',$vercode,0,'/');
     setcookie('reusMTP',$curr_user,0,'/');
    $hoster=$HostID['id'];
    $sqlAccount="SELECT * FROM `account` WHERE id=$hoster";
    $sqlAccountQuery=mysqli_query($sql_connect,$sqlAccount);
    $Username=mysqli_fetch_assoc($sqlAccountQuery);
    $makeObj=[1,$Username['name']];
    echo json_encode($makeObj);