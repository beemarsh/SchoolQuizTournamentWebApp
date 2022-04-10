<?php
    define('sql-connection_check',TRUE);
    include 'sql-connection.php';
    define('check',TRUE);
    include '../crypt.php';
    if(!isset($_SERVER['HTTP_REFERER'])){
        include 'error.php';
        exit();
    }
    if(!isset($_POST['pts'])){
        echo "Error";
        exit();
    }
    $points_array=[];
    $points=mysqli_real_escape_string($sql_connect,$_POST['pts']);
    $c=new McryptCipher('passKey');
    $curr_user=$c->decrypt($_COOKIE['hafhk43']);
    $d=new McryptCipher('passKey');
    $curr_code=$d->decrypt($_COOKIE['dijfnj']);
    $select_this="SELECT * FROM result WHERE id='$curr_user' AND code='$curr_code'";
    $select_this_query=mysqli_query($sql_connect,$select_this);
    $check_if_exits=mysqli_num_rows($select_this_query);
    if($check_if_exits!==0){
        $updater="UPDATE result SET points=$points WHERE id=$curr_user";
    }else{
        $updater="INSERT INTO result(id,points,code) VALUES($curr_user,$points,$curr_code)";
    }
    mysqli_query($sql_connect,$updater);
    $select_for_last="SELECT * FROM result WHERE code='$curr_code'";
    $select_for_last_query=mysqli_query($sql_connect,$select_for_last);
    while($roweddd=mysqli_fetch_assoc($select_for_last_query)){
        $select_name_of_user="SELECT * FROM account WHERE id=$roweddd[id]";
        $select_name_of_user_query=mysqli_query($sql_connect,$select_name_of_user);
        $name_Dats=mysqli_fetch_assoc($select_name_of_user_query);
        $get_ponts_db="SELECT * FROM result WHERE id=$roweddd[id]";
        $get_ponts_db_query=mysqli_query($sql_connect,$get_ponts_db);
        $thisponts=mysqli_fetch_assoc($get_ponts_db_query);
        $this_data=[$name_Dats['name'],$thisponts['points']];
        array_push($points_array,$this_data);
    }
    $jsonifieddata=json_encode($points_array);
    echo $jsonifieddata;