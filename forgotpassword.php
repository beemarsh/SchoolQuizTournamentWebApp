<?php
session_start();
define('checkguest',TRUE);
include 'handle/checkguest.php';
if(defined('guest')){
    $_SESSION['errorcode']='x113';
    include 'error.php';
    exit();
}
if(!isset($_SERVER['HTTP_REFERER'])){
    include 'error.php';
    exit();
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title> Forgot Password </title>
    <link rel='stylesheet' href="refrences/fonts/fonts.css">
    <link rel="stylesheet" href='refrences/css/login-style.css'>
    <script src="refrences/js/forgotpassword.js">
     </script>
</head>
<body>
    <section class="container">
        <section class="hero">
            <section class="forms forms-reg">
                    <form class="register-form" method="POST" action="forgotpass" autocomplete=on>
                            <h1>Forgot Password</h1>                            
                            <input type=email name='emailid' placeholder="Enter Your Email Address">
                            <div class="error">
                            <?php
                            if(isset($_SESSION['error1'])){
                                echo $_SESSION['error1'];
                            }
                            ?>
                            </div>
                            <button type='submit' name='submit'>Submit</button>
                        </form>
            </section>
        </section>
    </section>
</body>
<script src="refrences/js/if_dataDel.js"></script>
</html>
<?php session_destroy();?>