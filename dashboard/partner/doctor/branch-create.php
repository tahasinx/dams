<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';
$result = "";
$output = "";

$server = new Partner();

$result = $server->partner_data();

if (isset($_POST['save'])) {
    $output = $server->create_branch($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <title>DAMS</title>
    <?php include './parts/css-links.php'; ?>
    <style>
        label{
            font-family: 'Roboto', sans-serif !important;
        }
        .content {
            text-transform: uppercase;
        }

        label, h3 {

        }

        form input {
            border: 1px solid !important
        }
    </style>
</head>

<body>
<div class="main-wrapper">
    <?php while ($row = $result->fetch_assoc()) {
        $title            = $row['doctor_title'];
        $institute_logo   = $row['institute_logo'];
        $partnership_zone = $row['partnership_zone'];
        $profile_status   = $row['profile_status'];
        $premium_status   = $row['premium_status'];
        ?>
        <!--topnav-->
        <?php include './parts/top-nav.php'; ?>

        <!--sidenav-->
        <?php include './parts/side-nav.php'; ?>

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="page-title"><u>Add Branch</u> &emsp;<span class="text-success"><?php echo $output; ?></span></h4>
                    </div>
                    <div class="col-sm-4">
                        <a href="branch-list.php" class="btn btn-primary btn-rounded float-right">
                            <i class="fa fa-cubes"></i>All&nbsp;Branches
                        </a>
                    </div>
                </div>
                <form method="POST" action="">
                    <input type="hidden" value="<?= $institute_logo ?>"  name="institute_logo"/>
                    <input type="hidden" value="<?= $title ?>"  name="doctor_title"/>
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Institute Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="institute_name" placeholder="Enter Institute Name"  required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Partnership Zone <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="partnership_zone" value="<?= $partnership_zone ?>" placeholder="Enter Drug Name" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Country<span class="text-danger">*</span></label>
                                                <select class="form-control" name="country" required style="border: 1px solid">
                                                    <option value="">Select</option>
                                                    <?php include '../../countries.php'?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>City<span class="text-danger">*</span></label>
                                                <input class="form-control" name="city" placeholder="Enter Branch City" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Region<span class="text-danger">*</span></label>
                                                <input class="form-control" name="region" placeholder="Enter Branch Region" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Service Period<span class="text-danger">*</span></label>
                                                <input class="form-control" name="service_period" value="24/7" placeholder="Enter Branch Region" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Off Days<span class="text-danger">*</span></label>
                                                <input class="form-control" name="off_days" value="None" placeholder="Enter Branch Region" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Contact No 1<span class="text-danger">*</span></label>
                                                <input class="form-control" name="contact_no1" placeholder="Enter Contact No" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Contact No 2</label>
                                                <input class="form-control" name="contact_no2" placeholder="Enter Contact No" type="text" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Contact No 3</label>
                                                <input class="form-control" name="contact_no3" placeholder="Enter Contact No" type="text" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Hotline No<span class="text-danger">*</span></label>
                                                <input class="form-control" name="hotline_no" placeholder="Enter Hotline No" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email Address<span class="text-danger">*</span></label>
                                                <input class="form-control" name="email" placeholder="Enter Email Address" type="email" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Address [ Google Map Searchable ]<span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="address" placeholder="Enter Branch Address" type="text" style="border: 1px solid;height: 100px" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Visiting Price<span class="text-danger">*</span></label>
                                                <input class="form-control" name="visit_price" placeholder="Enter visit price" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Publication Status <span class="text-danger">*</span></label>
                                                <select class="form-control" name="status" required style="border: 1px solid">
                                                    <option value="">Select</option>
                                                    <option value="1">Published</option>
                                                    <option value="0">Unpublished</option>
                                                </select>
                                            </div>
                                        </div>

                                        <?php
                                        if ($profile_status === '0') {
                                            ?>
                                            <div class="col-sm-12">
                                                <center>
                                                    <a class="btn btn-primary" href="#modal">Save &nbsp;
                                                        <i class="fa fa-save"></i>
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
                                        <?php } elseif ($premium_status === '0'){?>
                                            <div class="col-sm-12">
                                                <center>
                                                    <a class="btn btn-primary" href="#modal">Save &nbsp;
                                                        <i class="fa fa-save"></i>
                                                    </a>
                                                </center>
                                            </div>

                                            <div class="awesome-modal" id="modal"><a class="close-icon" href="#close"></a>
                                                <center>
                                                    <h3 class="modal-title">Sorry! your are not premium user.</h3>
                                                    <br>
                                                    <a class="btn btn-primary" href="premium-packages.php"
                                                       style="">Get Premium
                                                    </a>
                                                </center>
                                            </div>
                                        <?php } else {
                                            ?>
                                            <div class="col-sm-12">
                                                <center>
                                                    <button class="btn btn-primary" type="submit" name="save">Save
                                                        &nbsp;
                                                        <i class="fa fa-save"></i>
                                                    </button>
                                                </center>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php include './parts/messages.php'; ?>
        </div>
    <?php } ?>
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