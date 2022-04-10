<?php
define('check',true);
include 'crypt.php';
$c=new McryptCipher('passKey');
$data=$c->encrypt(4);
$cookie_time=time()+3464565;
setcookie('fdgirt3',$data,$cookie_time,'/');
exit();