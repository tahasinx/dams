<?php
session_start();
        
require_once './server/Home.php';
$result = "";

$server = new Home();

if (isset($_POST['submit'])) {
    $result = $server->client_signup($_POST);
}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <?php include './parts/css-links.php'; ?>
    </head>
    
    <style>
        .container{
            font-family: 'Titillium Web', sans-serif;
        }
        table{
            padding: 0%
        }
        input{
            width: 200px;
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
                <h1 class="font-weight-300"><u>sign up with us</u></h1>
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
                                    <td>
                                        <div class="form-group label-floating">
                                            <label class="control-label">First Name</label>
                                            <input class="" placeholder="" type="text" name="first_name" autocomplete="nope" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Last Name</label>
                                            <input class="" type="text" name="last_name" autocomplete="nope" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Your Email</label>
                                            <input class="" placeholder="" type="email" value="<?= $email = $_SESSION['client_email'] ?>" name="email" autocomplete="nope" required readonly style="width: 100%">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Your Phone</label>
                                            <input class="" placeholder="" type="text" name="phone" autocomplete="nope" required style="width: 100%">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Country</label>
                                            <select name="country" style="width: 100%;height: 40px;border-color: white;background-color: whitesmoke">
                                                <option value="" selected disabled>Select</option>
                                                <?php include '../dashboard/countries2.php'?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">City</label>
                                            <input class="" placeholder="" type="text" name="city" autocomplete="nope" required style="width: 100%">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Address</label>
                                            <input class="" placeholder="" type="text" name="address" autocomplete="nope" required style="width: 100%">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Choose a username</label>
                                            <input class="" placeholder="" type="text" name="username" autocomplete="nope" required style="width: 100%">
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
                                        <p style="float: left">you have an account? <a href="../login/clients/index.php"> Sing in !</a> </p>
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
