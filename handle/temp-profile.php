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
                                $file_destination="../uploads/temp/".$newfilename;
                                $file_destination_tmp="uploads/temp/".$newfilename;
                                $c=new McryptCipher('passKey');
                                $file_destination_encrypt=$c->encrypt($file_destination);
                                setcookie('dfsdfr',$file_destination_encrypt,0,'/');
                                copy($temp_dir,$file_destination);
                                echo $file_destination_tmp;
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