<?php
session_start();
require_once '../LoginController/Client.php';
$result = '';

if (isset($_SESSION['clien_id'])) {
    header('location:../../home/index.php');
}

$login = new Client();

if (isset($_POST['login'])) {

    $result = $login->clientLogin($_POST);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-grid.css" />
        <link rel="stylesheet" href="css/bootstrap-grid.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="../assets/gellery/c1.jpg">
        <style>
            body{background-repeat:no-repeat ;font-family: 'Rajdhani', sans-serif;background-color: #333333;}
            .form{margin: 15% auto;border: 1px solid;height: 300px;width: 35%;padding: 3%;background-color: #fff}
            .head{font-weight: 400;}
            .bottom h6{font-weight: 600}
            .bottom h6{font-size: 13px}
            form input{ border: 1px #000;border-style: none none solid none;background: none;outline: none;width: 100%}
            button{outline: none}
            .submit{width:100px;float: right;height: 30px;outline: none;border-color: #0067b8;background-color: #0067b8;color: #fff;text-decoration: underline;cursor: pointer;}
            .active{ color: orangered}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">

                <div class="col-sm-5">
                    <center><a href="../../home/" style="color:white;font-size:20px">DIAGNOSTIC ASSISTANT MANAGEMENT SYSTEM</a></center>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-5" style="color:white;font-size:20px">
                    <a class="active" href="index.php">CLIENT PORTAL</a>||
                    <a href="../partners/">PARTNER PORTAL</a>||
                    <a href="../admin/">ADMIN PORTAL</a>
                </div>

                <div class="col-sm-12">
                    <div class="form">
                        <div class="head">CLIENT <?php echo $result ?><br><h3><b>Sign in</b></h3></div>
                        <br/>
                        <form method="post" action="">
                            <input placeholder="Enter Username" type="text" name="username" required><br/><br/>
                            <input placeholder="Enter Password" type="password" name="password" autocomplete="new-password" required><br/><br/>
                            <div class="bottom"><h6><a href="#">Forgot account?</a>&emsp;</h6></div>
                            <input type="submit" class="submit btn-dark" name="login" value="Sign In">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</html>
