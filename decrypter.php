<!DOCTYPE html>
<html>
    <head>
        <title>
            Decrypter
        </title>
    </head>
    <body>
        <form style="width: 600px;height: 100px;margin: auto;" method="POST" action="decrypt.php">
            <input type='text' style='height: 40px;width:90%;' placeholder="Type the encrypted code" name='code'>
            <button type="submit">OK</button>
        </form>
        <form style="width: 600px;height: 100px;margin: auto;" method="POST" action="decrypt.php">
            <input type='text' style='height: 40px;width:90%;' placeholder="Type the code to be encrypted" name='encode'>
            <button type="submit">OK</button>
        </form>
        <p style='display:block;margin:auto;font-size:2em;text-align:center'><b>Answer:</b></p>
        <div style='height:100px;width:300px;font-size:1.2em;margin:auto;word-wrap:break-word;text-align:center'>
        <b>
        <?php
        session_start();
        if(isset($_SESSION['decrypted'])){
            echo $_SESSION['decrypted'];
        }
        ?>
        </b>
        </div>
    </body>
</html>