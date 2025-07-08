<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"]) && !isset($_SESSION["zone"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';
$output = "";
$error = "";
$server = new Partner();

$result = $server->partner_data();

if (isset($_POST['change'])) {
    if ($_POST['new_password'] === $_POST['confirm_password']) {

        $output = $server->change_password($_POST);

    } else {
        $error = "Passwords are not matched.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DAMS</title>

    <?php
    include './parts/css-links.php';
    ?>

</head>

<body>

<div class="main-wrapper">
    <?php while ($row = $result->fetch_assoc()) {
        $profile_status = $row['profile_status']
        ?>
        <!--topnav-->
        <?php include './parts/top-nav.php'; ?>

        <!--sidenav-->
        <?php include './parts/side-nav.php'; ?>

    <?php } ?>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="page-title"><u>Change Password</u>
                        <?php
                        if ($output == '1') {
                            ?>
                            <span class="text-success">Password is changed successfully.</span>
                        <?php } elseif ($output == '0') {
                            ?>
                            <span class="text-danger">Sorry! Something went wrong.</span>
                        <?php }
                        ?>
                    </h4>
                </div>
            </div>
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="dash-widget">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>
                                        Email Address <span class="text-danger">*</span>
                                        <span class="text-danger">
                                           <?php
                                           if ($output <> '0' || $output <> '1') {
                                               echo $output;
                                           }
                                           ?>
                                       </span>
                                    </label>
                                    <input class="form-control" type="email" name="email"
                                           placeholder="Enter Your Email" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Current Password <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="current_password"
                                           placeholder="Enter Current Password" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="dash-widget">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>New Password <span class="text-danger">*</span> <span
                                                class="text-danger"> <?= $error ?></span></label>
                                    <input class="form-control" type="password" name="new_password"
                                           placeholder="Enter Current Password" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="confirm_password"
                                           placeholder="Enter Current Password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <center>
                    <button type="submit" class="btn btn-outline-primary" name="change">Change Password</button>
                </center>
            </form>
        </div>

    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>

<!--scripts-->
<?php include './parts/js-links.php'; ?>

</body>


</html>