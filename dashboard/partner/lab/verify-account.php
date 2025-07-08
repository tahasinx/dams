<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';
$result = "";
$updateError = "";

$server = new Partner();
$server->notification_seen('account');
$result = $server->partner_data();

if (isset($_POST['submit'])) {
    $error = $server->account_verification($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <?php include './parts/css-links.php'; ?>
        <style>
            .content{
                font-family: 'Titillium Web', sans-serif;
            }

        </style>
    </head>

    <body>
        <div class="main-wrapper">
            <?php
            while ($row = $result->fetch_assoc()) {
                $account_status = $row['account_status'];
                $account_request = $row['account_request'];
                $account_failed = $row['account_failed'];
                $account_failed_cause = $row['account_failed_cause'];
                ?>

                <?php
                if ($row['status'] == 0) {
                    echo "<script type='text/javascript'>alert('SORRY! YOU ARE BLOCKED!');document.location='logout.php';</script>";
                }
                ?>

                <div class="header">
                    <?php include './parts/top-nav.php'; ?>
                </div>
                <div class="sidebar" id="sidebar">
                    <?php include './parts/side-nav.php'; ?>
                </div>
            <?php } ?>
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="page-title"><u>Account Verification</u>&nbsp;
                                <i class="fa fa-check-circle" style="color:<?php
                                if ($account_status == 0 && $account_request == 0 || $account_failed == 1) {
                                    echo'red';
                                }elseif ($account_request == 1) {
                                    echo 'blueviolet';
                                } else {
                                    echo 'green';
                                }
                                ?>"></i>
                            </h4>
                        </div>
                        <div class="col-sm-6">
                            <h4 style="color:red"><?php echo $updateError; ?></h4>
                        </div>
                    </div>
                    <?php
                    if ($account_status == 0 && $account_request == 0 && $account_failed == 0) { 
                        ?>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="row">
                                
                                <div class="col-sm-6 card-box">
                                    <center>
                                        <h4 class="modal-title">Upload TIN Certificate</h4>
                                        <small style="color:red">Upload a clear photo. Follow the example.</small>
                                        <div style="min-height: 400px;width: 300px;border:1px solid;border-radius: 5px">
                                            <img id="tin" alt="" style="height: 398px;width:297px " src="" onerror="this.onerror=null; this.src='../../gallery/tin-example.jpg'"/>
                                        </div>
                                        <div class="fileupload btn">
                                            <span class="btn-text">upload</span>
                                            <input class="upload" type="file" 
                                                   onchange="document.getElementById('tin').src = window.URL.createObjectURL(this.files[0])" name="tin_certificate" required>
                                        </div>
                                    </center>
                                </div>
                                <div class="col-sm-6 card-box">
                                    <center>
                                        <h4 class="modal-title">Upload License Certificate</h4>
                                        <small style="color:red">Upload a clear photo. Follow the example.</small>
                                        <div style="min-height: 400px;width: 300px;border:1px solid;border-radius: 5px">
                                            <img id="license" alt="" style="height: 398px;width:297px " src="" onerror="this.onerror=null; this.src='../../gallery/license-example.jpg'"/>
                                        </div>
                                        <div class="fileupload btn">
                                            <span class="btn-text">upload</span>
                                            <input class="upload" type="file" 
                                                   onchange="document.getElementById('license').src = window.URL.createObjectURL(this.files[0])" name="licence_certificate" required>
                                        </div>
                                    </center>
                                </div>
                             
                            </div>
                            <center>
                                <input type="submit" class="btn btn-primary btn-group-lg" name="submit" style="200px;font-size: 20px" name value="Send Request" />
                            </center>

                        </form>
                    <?php } elseif ($account_request == 1) { ?>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 card-box" style="min-height:200px">
                                <center>
                                    <h1 style="text-align: center;color:blueviolet; ">
                                        <b>You have a pending request.</b>
                                    </h1>
                                    <br>
                                    <i class="fa fa-clock-o" style="font-size:100px;color:blueviolet"></i>
                                </center>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    <?php } elseif ($account_status == 1) { ?>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 card-box" style="min-height:200px">
                                <center>
                                    <h1 style="text-align: center;color:green;">
                                        <b>ACCOUNT VERIFIED!</b>
                                    </h1>
                                    <br>
                                    <i class="fa fa-check-circle" style="font-size:100px;color:green"></i>
                                </center>

                            </div>
                            <div class="col-sm-2"></div>
                        </div>

                    <?php } else { ?>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 card-box" style="min-height:200px">
                                <center>
                                    <h1 style="text-align: center;color:red;">
                                        <b>ACCOUNT VERIFICATION FAILED!</b>
                                    </h1>
                                    <br>
                                    <i class="fa fa-times-circle" style="font-size:100px;color:red"></i>
                                    <h4><?php echo $account_failed_cause; ?></h4>
                                    <form method="POST">
                                        <input type="submit" name="try_again" class="btn btn-primary" value="Try Again"/>
                                    </form>
                                </center>

                            </div>
                            <div class="col-sm-2"></div>
                        </div>

                    <?php } ?>
                </div>
                <?php include './parts/messages.php'; ?>
            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="assets/js/app.js"></script>
    </body>
</html>