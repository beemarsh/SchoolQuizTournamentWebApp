<?php
    include 'sql-connection.php';
$current_user_encrypted=$_COOKIE['hafhk43'];
$c = new McryptCipher('passKey');
$current_user = $c->decrypt($current_user_encrypted);
    $select_user="SELECT * FROM account WHERE id='$current_user' ";
    $query_user_select=mysqli_query($sql_connect,$select_user);
    $row_check=mysqli_num_rows($query_user_select);
    $user_rank_record="SELECT * FROM user_rank WHERE id='$current_user'";
    $user_rank_record_query=mysqli_query($sql_connect,$user_rank_record);
    $row_rank_check=mysqli_num_rows($user_rank_record_query);
    if($row_check==1){
        $row=mysqli_fetch_assoc($query_user_select);
        $row_rank=mysqli_fetch_assoc($user_rank_record_query);
        $user_name=$row['name'];
        $user_username=$row['username'];
        $user_email=$row['email'];
        $points=$row_rank['points'];
        $global_rank=$row_rank['rank'];
    }
?>