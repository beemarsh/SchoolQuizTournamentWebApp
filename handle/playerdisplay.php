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
     $curr_code=$c->decrypt($_COOKIE['dijfnj']);
     $d=new McryptCipher('passKey');
     $abs=0;
     $curr_user=$d->decrypt($_COOKIE['hafhk43']);
     if(isset($_POST['rdcondtn'])){
        $ready_cc="UPDATE jointable SET ready=1 WHERE code=$curr_code AND id=$curr_user";
        mysqli_query($sql_connect,$ready_cc);
        exit();
      }
      // Checking if quiz started
      $check_id_db="SELECT * FROM jointable WHERE code=$curr_code AND ready=1";
      $check_id_db_query=mysqli_query($sql_connect,$check_id_db);
      $check_id_db_nums=mysqli_num_rows($check_id_db_query);
      if($check_id_db_nums!==0){
        echo 1;
        exit();
      }
      // Checking if he/she is a admin
      $check_he_adm="SELECT * FROM jointable WHERE code='$curr_code' AND status=2 AND id=$curr_user";
      $check_he_adm_query=mysqli_query($sql_connect,$check_he_adm);
      $check_he_adm_nums=mysqli_num_rows($check_he_adm_query);
      if($check_he_adm_nums!==0){
        setcookie('sdlfue43','cvgya',0,'/');
      }
      // Checking if admin is on or off
      $select_adin_multiplay="SELECT * FROM multiplay WHERE code=$curr_code";
      $select_adin_multiplay_query=mysqli_query($sql_connect,$select_adin_multiplay);
      $select_adin_multiplay_data=mysqli_fetch_assoc($select_adin_multiplay_query);
      $admin_id=$select_adin_multiplay_data;
      // Ensuring if data is protected
      $user_select_if="SELECT * FROM jointable WHERE id=$curr_user";
      $user_select_if_query=mysqli_query($sql_connect,$user_select_if);
      $user_select_if_NUMS=mysqli_num_rows($user_select_if_query);
      if($user_select_if_NUMS==0){
        echo "The Session has expired";
        exit();
      }
      if($check_he_adm_nums!==0){
        $user_select_jointbla="UPDATE jointable SET code=$curr_code,status=2,tempcode=$curr_code WHERE id=$curr_user";
        $admin_select_mutlis="UPDATE multiplay SET code=$curr_code,status=1 WHERE id=$curr_user";
        mysqli_query($sql_connect,$admin_select_mutlis);        
      }else{
        $user_select_jointbla="UPDATE jointable SET code=$curr_code,status=1,tempcode=$curr_code WHERE id=$curr_user";        
      }
      mysqli_query($sql_connect,$user_select_jointbla);
      // ****
     $select_name="SELECT id FROM jointable WHERE code='$curr_code'";
    $query_select_name=mysqli_query($sql_connect,$select_name);
    if($select_adin_multiplay_data['status']==0){
        echo 'Server Connection Failed.No response from Host';
        exit();
      }
    while($row12=mysqli_fetch_assoc($query_select_name)){
        $select_account="SELECT * FROM account WHERE id=$row12[id]";
        $select_account_query=mysqli_query($sql_connect,$select_account);
        while($row=mysqli_fetch_assoc($select_account_query)){
        $user_profile_status=$row['pic_status'];
        $user_letter=$row['name'][0];
        $location_pic=$row['pic_dir'];
          if($row['id']==$curr_user){
              if($user_profile_status==0){
                echo "<div class='a-result-multi'>
                                    <div class='opponent-userpic opp-found'>".$user_letter."</div>
                                    <span id='result-search'>".$row['name'] ."</span>
                                    <div class='status-state'></div>";
                                    if($admin_id['id']==$row['id']){echo 'Admin';}
                                    echo "</div>";
                                                                               
                                  }else{
                                    echo "<div class='a-result-multi'>
                                    <div class='opponent-userpic'><img src='".$location_pic."'></div>
                                    <span id='result-search'>".$row['name'] ."</span>
                                    <div class='status-state'></div>";
                                    if($admin_id['id']==$row['id']){echo 'Admin';}
                                    echo "</div>";                                           
                                    
                                  }
                                }else{
                                  if($user_profile_status=='text'){
                                    echo "<div class='a-result-multi'>
                                    <div class='opponent-userpic opp-found'>".$user_letter."</div>
                                    <span id='result-search'>".$row['name'] ."</span>
                                    <div class='status-state'></div>";
                                    if($admin_id['id']==$row['id']){echo 'Admin';}
                                    echo "</div>";
                                                                                 
                                  }else{
                                    echo "<div class='a-result-multi'>
                                    <div class='opponent-userpic'><img src='".$location_pic."'></div>
                                    <span id='result-search'>".$row['name'] ."</span>
                                    <div class='status-state'></div>";
                                    if($admin_id['id']==$row['id']){echo 'Admin';}
                                    echo "</div>";
                                                                                 
            }
          }
    }
    $abs+=1;
    }