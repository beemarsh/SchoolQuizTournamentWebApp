<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit();
}
define('check',TRUE);
define('sql-connection_check',TRUE);
include '../crypt.php';
include 'sql-connection.php';
$c=new McryptCipher('passKey');
$curr_user=$c->decrypt($_COOKIE['hafhk43']);
top:
$our_pin_rand=mt_rand(1000000,9999999);
$query_randcheck="SELECT * FROM multiplay WHERE code='$our_pin_rand'";
$soreed=mysqli_query($sql_connect,$query_randcheck);
$rows_find=mysqli_num_rows($soreed);
if($rows_find!==0){
    goto top;
}
$pre_querr="SELECT * FROM multiplay WHERE id=$curr_user";
$pre_querr_store=mysqli_query($sql_connect,$pre_querr);
$num_rows_check=mysqli_num_rows($pre_querr_store);
if($num_rows_check!==0){
    $query_eer="UPDATE multiplay SET code=$our_pin_rand,status=1,adm_stat=1,ready=0 WHERE id=$curr_user";
}else{
    $query_eer="INSERT INTO `multiplay` (`id`, `code`,`adm_stat`,`status`) VALUES ($curr_user, $our_pin_rand,1,1);";
}
mysqli_query($sql_connect,$query_eer);
setcookie('dijfnj',$our_pin_rand,0,'/');
setcookie('reusMTP',$curr_user,0,'/');
setcookie('ursADM',1,0,'/');
echo $our_pin_rand;