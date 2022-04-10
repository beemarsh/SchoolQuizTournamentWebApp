<?php
define('check',TRUE);
define('sql-connection_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
include 'handle/sql-connection.php';
include 'crypt.php';
session_start();
if(isset($_POST['guest-reg'])){
define('guest-entry',true);
$c=new McryptCipher('passKey');
$userid=$c->encrypt(0);
$cookie_time=0;
$data_pic_guest=$c->encrypt("<img src='uploads\profile_pic\guest.png'>");
setcookie('hafhk43',$userid,$cookie_time,'/');
setcookie("nbie09",$data_pic_guest,$cookie_time,"/");
header('location:home');
exit();
}else{
if(empty($_POST['username1'])){
    $_SESSION['error1']='Enter your email or username';
    header('location:login');
    exit();
}else{
    $user=mysqli_real_escape_string($sql_connect,$_POST['username1']);
}
if(empty($_POST['password1'])){
    $_SESSION['error1']='Enter your password';
    header('location:login');
    exit();
}else{
    $pass=mysqli_real_escape_string($sql_connect,$_POST['password1']);
}
$login_q1="SELECT * FROM account WHERE username='$user' AND password='$pass'";
$login_q2="SELECT * FROM account WHERE email='$user' AND password='$pass'";
$query_login1=mysqli_query($sql_connect,$login_q1);
$query_login2=mysqli_query($sql_connect,$login_q2);
$rows1=mysqli_num_rows($query_login1);
$rows2=mysqli_num_rows($query_login2);
if($rows1===1){
    $get_id=mysqli_fetch_assoc($query_login1);
}else{
    $get_id=mysqli_fetch_assoc($query_login2);
}
if($rows1==1||$rows2==1){
    $user_id=$get_id['id'];
    $c = new McryptCipher('passKey');
    $encrypted_user_id= $c->encrypt($user_id);
    $user_letter=$get_id['name'];
    $user_pic_status=$get_id['pic_status'];
    $cookie_time=time()+60*60*60*24;
    setcookie('hafhk43',$encrypted_user_id,$cookie_time,'/');
    $_SESSION['id']=$user_id;
        if($user_pic_status==0){
            $c = new McryptCipher('passKey');
        $encrypted_user_pic= $c->encrypt(strtoupper($user_letter[0]));
        setcookie('nbie09',$encrypted_user_pic,$cookie_time,'/');
        }else{
            $c = new McryptCipher('passKey');
            $location="<img src='".$get_id['pic_dir']."'>";
            $encrypted_user_pic= $c->encrypt($location);
            setcookie('nbie09',$encrypted_user_pic,$cookie_time,'/');
        }
        header('location:home');
        exit();
}else{
        $_SESSION['error1']='Incorrect username or Password';
        header('location:login');
        exit();
}
}
?>