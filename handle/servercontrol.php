<?php
define('sql-connection_check',TRUE);
include 'sql-connection.php';
$select_data="SELECT * FROM user_activity";
$select_data_query=mysqli_query($sql_connect,$select_data);
while($row=mysqli_fetch_assoc($select_data_query)){
    $t_d=time()-$row['time'];
    if($t_d>6){
        $select_this_multiplay="UPDATE multiplay SET status=0,code=0 WHERE id=$row[id]";
        mysqli_query($sql_connect,$select_this_multiplay);
        $select_this_jointable="UPDATE jointable SET code=0,status=0,ready=0,shown=0 WHERE id=$row[id]";
        mysqli_query($sql_connect,$select_this_jointable);
        $curr_time=time();
        $select_this_user_activity="UPDATE user_activity SET time=$curr_time WHERE id=$row[id]";
        // mysqli_query($sql_connect,$select_this_user_activity);
    }
}