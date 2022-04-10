<?php
session_start();
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
</head>
<body>
    <section class="container">
        <section class="hero">
            <section class="forms forms-reg">
                    <form class="register-form" method="POST" action="handle/verify" autocomplete='on'>
                            <h1>Enter your verification code</h1>                            
                            <input name='vercode' placeholder="Verification code">
                            <div class="error">
                            <?php
                            if(isset($_SESSION['error1'])){
                                echo $_SESSION['error1'];
                            }
                            ?>
                            </div>
                            <button type='submit' name='submit'>Submit</button>
                            <button type='button' onclick='resendcode()'>Resend Code</button>
                            <p class='info'><b>If you didn't find verification code in Inbox,check Spam folder..</b></p>
                        </form>
            </section>
        </section>
    </section>
</body>
<script src="refrences/js/if_dataDel.js"></script>
                                <script src="refrences/js/jquery.js"></script>
                            <script src="refrences/js/forgotpassword.js"></script>
</html>
<?php session_destroy();?>
