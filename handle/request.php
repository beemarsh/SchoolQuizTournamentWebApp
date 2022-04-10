<?php
    define('check',TRUE);
    define('sql-connection_check',TRUE);
    if(!isset($_SERVER['HTTP_REFERER'])){
        include 'error.php';
        exit();
    }
    include 'sql-connection.php';
    include '../crypt.php';
    if(!isset($_POST['cvrt'])){
        include 'error..php';
        exit();
    }
    $curr_time=time();
    $c=new McryptCipher('passKey');
    $curr_user=$c->decrypt($_COOKIE['hafhk43']);
    $d=new McryptCipher('passKey');
    $curr_code=$d->decrypt($_COOKIE['dijfnj']);
    $selcte="SELECT * FROM user_activity WHERE id=$curr_user";
    $selcte_query=mysqli_query($sql_connect,$selcte);
    $selcte_noros=mysqli_num_rows($selcte_query);
    if($selcte_noros==0){
        $update_time="INSERT INTO user_activity (id,time) VALUES($curr_user,$curr_time)";
    }else{
        $update_time="UPDATE user_activity SET time=$curr_time WHERE id=$curr_user";
    }
    mysqli_query($sql_connect,$update_time);
    // Data management for showing user inactivity by popups
    $selectiang_user_tempcode="SELECT * FROM jointable WHERE tempcode=$curr_code AND shown=0";
    $selectiang_user_tempcode_query=mysqli_query($sql_connect,$selectiang_user_tempcode);
    if(mysqli_num_rows($selectiang_user_tempcode_query)!==0){
        while($store_notshown_uers=mysqli_fetch_assoc($selectiang_user_tempcode_query)){
            $selected_user=$store_notshown_uers['id'];
            $select_him_in_timetable="SELECT * FROM user_activity WHERE id=$store_notshown_uers[id]";
            $select_him_in_timetable_Query=mysqli_query($sql_connect,$select_him_in_timetable);
            if(mysqli_num_rows($select_him_in_timetable_Query)!==0){
                $time_nowed=mysqli_fetch_assoc($select_him_in_timetable_Query);
                $tim_diff=time()-$time_nowed['time'];
                if($tim_diff>7){
                    $select_his_name_acc="SELECT * FROM account WHERE id=$time_nowed[id]";
                    $select_his_name_acc_query=mysqli_query($sql_connect,$select_his_name_acc);
                    $name_datas=mysqli_fetch_assoc($select_his_name_acc_query);
                    $update_for_shown="UPDATE jointable SET shown=1,tempcode=0 WHERE id=$time_nowed[id]";
                    mysqli_query($sql_connect,$update_for_shown);
                    echo $name_datas['name'];
                break;
                }
            }
        }
        }
    // Relative database processing for online checking updates of datas
    $check_he_adm="SELECT * FROM jointable WHERE code='$curr_code' AND status=2 AND id=$curr_user";
      $check_he_adm_query=mysqli_query($sql_connect,$check_he_adm);
      $check_he_adm_nums=mysqli_num_rows($check_he_adm_query);
      // Checking if admin is on or off
      $select_adin_multiplay="SELECT * FROM multiplay WHERE code=$curr_code";
      $select_adin_multiplay_query=mysqli_query($sql_connect,$select_adin_multiplay);
      $select_adin_multiplay_data=mysqli_fetch_assoc($select_adin_multiplay_query);
      $user_select_if="SELECT * FROM jointable WHERE id=$curr_user";
      $user_select_if_query=mysqli_query($sql_connect,$user_select_if);
      $user_select_if_NUMS=mysqli_num_rows($user_select_if_query);
      if($user_select_if_NUMS==0){
          echo 2;
          exit();
        }
        if($check_he_adm_nums!==0){
            $user_select_jointbla="UPDATE jointable SET code=$curr_code,status=2 WHERE id=$curr_user";
            $admin_select_mutlis="UPDATE multiplay SET code=$curr_code,status=1 WHERE id=$curr_user";
            mysqli_query($sql_connect,$admin_select_mutlis);        
        }else{
            $user_select_jointbla="UPDATE jointable SET code=$curr_code,status=1 WHERE id=$curr_user";        
        }
        mysqli_query($sql_connect,$user_select_jointbla);
        //   **************
        if($select_adin_multiplay_data['status']==0){
        echo 1;
        exit();
        }