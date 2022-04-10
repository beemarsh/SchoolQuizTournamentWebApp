<?php
if(!defined('sql-connection_check')){
    include 'error.php';
    exit();
    }
    
// $sql_connect=mysqli_connect('sql210.epizy.com','	epiz_24710717','GVeG8sW89IySJFz');
// $db_connect=mysqli_select_db($sql_connect,'epiz_24710717_user_record');

$sql_connect=mysqli_connect('localhost','root','');
$db_connect=mysqli_select_db($sql_connect,'user_record');
mysqli_query($sql_connect,$db_connect);
 ?>