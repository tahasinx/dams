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
$result = $server->partner_data();
$server->notification_seen('location');

if (isset($_POST['submit'])) {
    $error = $server->location_verification($_POST);
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

            form input{
                border:1px solid !important
            }
        </style>
    </head>

    <body>
        <div class="main-wrapper">
            <?php
            while ($row = $result->fetch_assoc()) {
                $profile_status = $row['profile_status'];
                $location_status = $row['location_status'];
                $location_request = $row['location_request'];
                $location_failed = $row['location_failed'];
                $location_failed_cause = $row['location_failed_cause'];
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
                            <h4 class="page-title"><u>Location Verification</u>&nbsp;
                                <i class="fa fa-check-circle" style="color:<?php
                                if ($location_status == 0 && $location_request == 0 || $location_failed == 1) {
                                    echo'red';
                                }elseif ($location_request == 1) {
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
                    if ($location_status == 0 && $location_request == 0 && $location_failed == 0) { 
                        ?>
                        <form method="POST" action = "">
                        <div class="card-box">
                            <h3 class="card-title">Google Map Information</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-focus">
                                        <label class="focus-label">Searchable Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control floating" name = "map_name" required>
                                    </div>
                                    <h3 class="card-title"><a href="https://www.clubrunnersupport.com/article/1416-how-to-find-a-location-s-latitude-longitude-in-google-maps" target="_blank">How to get longitude and latitude?</a></h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-focus">
                                        <label class="focus-label">Longitude</label>
                                        <input type="text" class="form-control floating" name="longitude" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-focus">
                                        <label class="focus-label">Latitude</label>
                                        <input type="text" class="form-control floating"  name="latitude" >
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php
                            if ($profile_status === '0') {
                                ?>
                                <div class="col-sm-12">
                                    <center>
                                        <a class="btn btn-primary" href="#modal">Send Request &nbsp;
                                            <i class="fa fa-paper-plane"></i>
                                        </a>
                                    </center>
                                </div>

                                <div class="awesome-modal" id="modal"><a class="close-icon" href="#close"></a>
                                    <center>
                                        <h3 class="modal-title">Sorry! your profile is not complete.</h3>
                                        <br>
                                        <a class="btn btn-primary" href="profile-update.php"
                                           style="">Complete Profile
                                        </a>
                                    </center>
                                </div>
                            <?php } else {
                                ?>
                                <div class="text-center m-t-20">
                                    <button class="btn btn-primary " type="submit" name="submit" >Send Request</button>
                                </div>
                            <?php }
                            ?>
                        

                    </form>
                    <?php } elseif ($location_request == 1) { ?>

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
                    <?php } elseif ($location_status == 1) { ?>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 card-box" style="min-height:200px">
                                <center>
                                    <h1 style="text-align: center;color:green;">
                                        <b>LOCATION VERIFIED!</b>
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
                                    <h4><?php echo $location_failed_cause; ?></h4>
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