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
    $output = $server->add_drug($_POST);
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
        label {
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

        $profile_status = $row['profile_status'];
        $premium_status = $row['premium_status'];
        $institute_name = $row['institute_name'];

        ?>
        <!--topnav-->
        <?php include './parts/top-nav.php'; ?>

        <!--sidenav-->
        <?php include './parts/side-nav.php'; ?>

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="page-title"><u>Add Drug</u> &emsp;<span
                                    class="text-success"><?php echo $output; ?></span></h4>
                    </div>
                    <div class="col-sm-4">
                        <a href="drug-repo.php" class="btn btn-primary btn-rounded float-right">
                            <i class="fa fa-cubes"></i>&nbsp;Repository
                        </a>
                    </div>
                </div>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <form method="POST" action="">
                                    <input type="hidden" name="institute_name" value="<?= $institute_name ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Drug Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="drug_name"
                                                       placeholder="Enter Drug Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Drug Type <span class="text-danger">*</span></label>
                                                <select class="form-control" name="drug_type" required
                                                        style="border: 1px solid">
                                                    <option value="">Select</option>
                                                    <option value="Liquid">Liquid</option>
                                                    <option value="Tablet">Tablet</option>
                                                    <option value="Capsule">Capsule</option>
                                                    <option value="Drop">Drop</option>
                                                    <option value="Inhaler">Inhaler</option>
                                                    <option value="Injection">Injection</option>
                                                    <option value="Suppository">Suppository</option>
                                                    <option value="Topical">Topical</option>
                                                    <option value="Patch">Implant or patch</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Drug Group<span class="text-danger">*</span></label>
                                                <input class="form-control" name="drug_group"
                                                       placeholder="Enter Drug Group" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Producer/Company<span class="text-danger">*</span></label>
                                                <input class="form-control" name="producer"
                                                       placeholder="Enter Producer's Name" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Unit Price [In Taka]<span class="text-danger">*</span></label>
                                                <input class="form-control" name="unit_price"
                                                       placeholder="Enter Unit Price" type="text"  required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Quantity/Weight/Volume <span class="text-danger">*</span></label>
                                                <input class="form-control" name="drug_quantity"
                                                       placeholder="Enter Drug Quantity" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Publication Status <span class="text-danger">*</span></label>
                                                <select class="form-control" name="status" required
                                                        style="border: 1px solid">
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
                                        <?php }elseif ($premium_status === '0'){?>
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