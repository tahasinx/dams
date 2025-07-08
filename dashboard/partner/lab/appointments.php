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
$data = $server->appointments();

if (isset($_POST['accept'])) {
    $output = $server->accept_appointment($_POST);
}
if (isset($_POST['cancel'])) {
    $output = $server->cancel_appointment($_POST);
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
                        <div class="col-sm-8">
                            <h4 class="page-title"><u>Appointment Requests</u></h4>
                        </div>
                        <div class = "col-sm-4 col-6 text-right m-b-30">
                            <a href="upcoming-appoinments.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-pencil"></i>Upcomings</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10 card-box">
                            <center>
                                <table class="table table-info">
                                    <h3>Appointments</h3>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Test Name</th>
                                        <th>Test Price</th>
                                        <th>Requested Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    $m = 1;
                                    if ($data->num_rows > 0) {
                                        while ($row = $data->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $server->testName_byID($row['requested_test']) ?></td>
                                                <td><?php echo $row['test_price'] ?></td>
                                                <td><?php echo $row['requested_date'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['request_status'] == 1) {
                                                        echo '<span style="color:blueviolet">Pending</span>';
                                                    } elseif ($row['status'] == 1) {
                                                        echo '<span style="color:green">Accepted</span> [ <a href="#">Invoice</a> ]';
                                                    } elseif ($row['is_cancelled'] == 1) {
                                                        echo '<span style="color:red">Cancelled</span>';
                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                            <center>
                                                <form method="POST" action="">
                                                <a href="#modal<?= $m++ ?>" class="btn btn-outline-primary"><i
                                                                class="fa fa-user"></i></a>
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                                    <button class="btn btn-success" type="submit" title="accept" name="accept" style="cursor: pointer" >
                                                        Accept
                                                    </button>
                                                    <button class="btn btn-danger" type="submit" title="cancel" name="cancel" style="cursor: pointer" onclick="return confirm('Are sure to cancel?');">
                                                        Cancel
                                                    </button>
                                                </form>
                                            </center>
                                            </td>
                                            </tr>
                                            <div class="awesome-modal" id="modal<?= $n++ ?>">
                                                <a class="close-icon" href="#close"></a>
                                                <div class="row">
                                                    <div class="col-lg-10 offset-lg-1">

                                                        <?php
                                                        $x = $server->client_profile($row['request_from']);
                                                        while ($a = $x->fetch_assoc()){
                                                            ?>
                                                            <ul>
                                                                <li style="color:orangered">Ordered By</li>
                                                                <li><?= $a['first_name']?></li>


                                                                <li style="color:orangered">Country</li>
                                                                <li><?= $a['country'] ?></li>


                                                                <li style="color:orangered">City</li>
                                                                <li><?= $a['city'] ?></li>


                                                                <li style="color:orangered">Phone</li>
                                                                <li><?= $a['phone'] ?></li>


                                                                <li style="color:orangered">Email</li>
                                                                <li><?= $a['email'] ?></li>


                                                                <li style="color:orangered">Address</li>
                                                                <li><?= $a['address'] ?></li>
                                                            </ul>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">
                                                <span class="text-danger text-center">No Data Found!</span>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </table>
                            </center>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
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