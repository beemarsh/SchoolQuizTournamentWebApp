<?php
session_start();
define('handlecheckguest',TRUE);
include 'handlecheckguest.php';
if(defined('guest')){
    $_SESSION['errorcode']='x113';
    include 'error.php';
    exit();
}
define('session-cookie_check',TRUE);
define('sql-connection_check',TRUE);
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit;
}
    include 'session-cookie_check.php';
    include 'sql-connection.php';
    $currentid_encrypt=$_COOKIE['hafhk43'];
        $c = new McryptCipher('passKey');
        $currentid= $c->decrypt($currentid_encrypt);
        $filename=$_FILES['file']['name'];
        $temp_dir=$_FILES['file']['tmp_name'];
        $fileerror=$_FILES['file']['error'];
        $filetype=$_FILES['file']['type'];
        $filesize=$_FILES['file']['size'];

        //Now getting file name and extension
        $file_ext=explode('.',$filename);
        $actual_file_ext=end($file_ext);
        $file_name_only=$file_ext[0];
        $allowed=['png','jpeg','jpg','JPG','PNG','JPEG'];

        if($filename==""){
            echo "Please select a file";
            exit();
        }else{
            if($fileerror===0){
                    if(in_array($actual_file_ext,$allowed)){
                            if($filesize<5000000){
                                $newfilename=uniqid('',true).'.'.$actual_file_ext;
                                $file_destination="../uploads/profile_pic/".$newfilename;
                                $file_destination_db="uploads/profile_pic/".$newfilename;
                                move_uploaded_file($temp_dir,$file_destination);
                                $c=new McryptCipher('passKey');
                                $temp_pic_to_unnlink=$c->decrypt($_COOKIE['dfsdfr']);
                                unlink($temp_pic_to_unnlink);   //Deleting file from temprorary location
                                setcookie('dfsdfr','expired',1,'/'); //Deleting temrorary cookie that stores temprorary location
                                // Deleting old profile pic
                                $select_img_dir_old="SELECT * FROM account WHERE id='$currentid' ";
                                $select_img_dir_old_query=mysqli_query($sql_connect,$select_img_dir_old);
                                $fetch_dir=mysqli_fetch_assoc($select_img_dir_old_query);
                                $old_dir_image=$fetch_dir['pic_dir'];
                                $old='../'.$old_dir_image;
                                unlink($old);
                                // **************************
                                $insert_data="UPDATE account SET pic_status=1 , pic_dir='$file_destination_db' where id='$currentid' ";
                                mysqli_query($sql_connect,$insert_data);
                                $cookie_time=time()+60*60*60*24;
                                $profile_pic_encrypt="<img src='".$file_destination_db."'>";                           
                                $c = new McryptCipher('passKey');
                                $profile_pic = $c->encrypt($profile_pic_encrypt);
                                setcookie('nbie09',$profile_pic,$cookie_time,'/');
                                echo 1;
                                exit();
                            }else{
                                echo "File is too big";
                                exit();
                            }
                    }else{
                        echo "File type not allowed";
                        exit();
                    }
            }else{
                echo "There was an error";
                exit();
            }
        }
?>