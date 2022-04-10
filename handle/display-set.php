<?php
if(!defined('display-set_check')){
  include 'error.php';
  exit();
}
define('sql-connection_check',TRUE);
    include 'sql-connection.php';
    $currentuser_encrypt=$_COOKIE['hafhk43'];
    $c = new McryptCipher('passKey');
    $currentuser = $c->decrypt($currentuser_encrypt);
    $select_table="SELECT * FROM sets WHERE id='$currentuser'";
    $query_table_set=mysqli_query($sql_connect,$select_table);
    while($row=mysqli_fetch_assoc($query_table_set)){
      echo "<li >
                    <div><span class=set-name> ".$row['setname'].
                    "</span> <span>Fields : ".$row['field'].
                    "</span><span>Set ID:   ".$row['setId']."</span>
                    <div class=set-butts><a href='quizset_manage/".$row['setname']."'><button id='manageQSbutt' class='butt manageQSbutt'>Manage</button></a>          
                      <a href='handle/remove-set/".$row['setname']."'><button class='butt removeThisQSbutt'>Remove this Set</button></a> </div>
                    </div>
                </li>
                ";
    }