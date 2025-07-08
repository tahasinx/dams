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

if (isset($_POST['create'])) {
    $output = $server->create_test($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
        <title>DAMS</title>
        <?php include './parts/css-links.php'; ?>
        <style>
            .content{
                text-transform: uppercase;
            }
            label,h3{
                font-weight: bolder;
            }
            form input{
                border:1px solid !important
            }
        </style>
    </head>

    <body>
        <div class="main-wrapper">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <!--topnav-->
                <?php include './parts/top-nav.php'; ?>

                <!--sidenav-->
                <?php include './parts/side-nav.php'; ?>

            <?php } ?>
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-8">
                            <h4 class="page-title"><u>CREATE TEST</u>&emsp;<?php echo $output; ?></h4>
                        </div>
                        <div class="col-sm-4">
                            <a href="test-repository.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-pencil"></i>Repository</a>
                        </div>
                    </div>
                    <form method="POST" action = "" >
                        <div class="card-box">
                            <h3 class="card-title">Test Information</h3>
                            <div class="row">
                                <input type="hidden" name="category_id" value="<?php echo $_GET['category_id'] ?>" />
                                <input type="hidden" name="test_id" value="<?php echo $_GET['test_id'] ?>" />
                                <div class="col-md-6">
                                    <div class="form-group form-focus">
                                        <label class="focus-label">Category Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control floating" value="<?php echo $_GET['category_name'] ?>" name="category_name" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-focus">
                                        <label class="focus-label">Test Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control floating"  name="test_name" required >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-focus">
                                        <label class="focus-label">Test Price [<span style="color:orangered">In Taka</span>]<span class="text-danger">*</span></label>
                                        <input type="number" min="1" class="form-control floating" name="test_price" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-focus">
                                        <label class="focus-label">Discount Amount/Percentage<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control floating" name="test_discount" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-box" style="min-height:200px">
                            <h3 class="card-title">Description [ <span style="color:orangered">Rules/Regulations/Process/Procedures etc</span>]</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-focus">
                                        <label class="focus-label">Description<span class="text-danger">*</span></label>
                                        <textarea class="form-control floating" style="min-height: 100px;resize: none" name="test_description" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center m-t-20">
                            <button class="btn btn-primary submit-btn" type="submit" name="create" >Create</button>
                        </div>
                    </form>
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