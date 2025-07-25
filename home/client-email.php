<?php
session_start();
require_once './server/Home.php';


$result = "";

$server = new Home();

if (isset($_POST['submit'])) {
    $result = $server->client_email_check($_POST);
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
        <h1 class="font-weight-300"><u>Be Our Client</u></h1>
        <h1 style="color:red"><?php echo $result; ?></h1>
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
                                    <label class="control-label">Enter Your Email Address</label>
                                    <input class="" placeholder="" type="email" name="email" autocomplete="nope" required style="width: 100%">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-md btn-primary full-width" type="submit" name="submit">Submit</button>
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
