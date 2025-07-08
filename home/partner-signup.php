<?php
session_start();
        
require_once './server/Home.php';
$result = "";

$server = new Home();

if (isset($_POST['submit'])) {
    $result = $server->partner_singup($_POST);
}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <?php include './parts/css-links.php'; ?>
    </head>
    
    <style>
        table{
            padding: 0%
        }
        input{
            width: 200px;
        }
        select,option{
            font-size: 13px
        }
    </style>

    <body>

        <header>
            <?php include './parts/header.php'; ?>
        </header>
        <!-- // Header  -->
        <br>
        <br>
        <br>
        <div id="page-title" class="padding-tb-30px gradient-white" style="font-family: 'Titillium Web', sans-serif; ">
            <div class="container text-center">
                <h1 class="font-weight-300"><u>Be Our Partner</u></h1>
                <h1><?php echo $result; ?></h1>
            </div>
        </div>

        <div class="container margin-bottom-100px">
            <div class="row">
                <div id="log-in" class="site-form log-in-form box-shadow border-radius-10">

                    <div class="form-output">

                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <table>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Your Email</label>
                                            <input class="" placeholder="" type="Email" name="email" autocomplete="nope" required style="width: 100%">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Partnership Zone</label>
                                            <select class="form-control" name="zone" required style="width: 100%;font-size: 13px">
                                                <option value="" >Select</option>
                                                <option value="doctor">Doctor</option>
                                                <option value="Clinic">Clinic</option>
                                                <option value="lab">Lab</option>
                                                <option value="pharmacy">Pharmacy</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Your Password</label>
                                            <input class="" placeholder="" type="password" name="password" autocomplete="new-password" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Confirm Your Password</label>
                                            <input class="" type="password" name="confirm_password" autocomplete="new-password" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="remember">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="confirm_password" style="width:20px"  required>
                                                    I accept the <a href="#">Terms and Conditions.</a>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button class="btn btn-md btn-primary full-width" type="submit" name="submit">Complete sign up !</button>
                                        <p style="float: left">you have an account? <a href="page-login.html"> Sing in !</a> </p>
                                    </td>
                                </tr>
                            </table>
                        </form>


                    </div>
                </div>
            </div>


        </div>
    </div>


    <!--footer-->
    <?php include './parts/footer.php'; ?>

    <!--scripts-->
    <?php include './parts/js-links.php'; ?>
</body>

</html>
