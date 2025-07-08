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
$data = $server->upcomming_appointments();

if (isset($_POST['cancel'])) {
    $output = $server->cancel_appointment($_POST);
}
if (isset($_POST['done'])) {
    $output = $server->mark_as_done($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <?php include './parts/css-links.php'; ?>
    <style>
        .content {
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
                    <h4 class="page-title"><u>Upcoming Appointment</u></h4>
                </div>
                <div class="col-sm-4 col-6 text-right m-b-30">
                    <a href="appointments.php" class="btn btn-primary btn-rounded float-right"><i
                                class="fa fa-pencil"></i>Pendings</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10 card-box">
                    <center>
                        <table class="table">
                            <h3>Appointments</h3>
                            <tr>
                                <th>Serial</th>
                                <th>Requested By</th>
                                <th>Requested Date</th>
                                <th>Status</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                            <?php
                            $i = 1;
                            $m = 1;
                            $n = 1;

                            if ($data->num_rows > 0) {
                                while ($row = $data->fetch_assoc()) {
                                    date_default_timezone_set('Asia/Dhaka');
                                    $appointment_date = $row['requested_date'];
                                    $date = strtotime($appointment_date);
                                    $today = strtotime(date('d-m-Y'));
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $server->name_by_id($row['request_from']) ?></td>
                                        <td><?php echo $row['requested_date'] ?></td>
                                        <td>
                                            <?php
                                            if ($today > $date && $date != "" && $row['is_done'] == 0) {
                                                echo '<span style="color:red">Expired.</span>';
                                            } elseif ($row['is_done'] == 1) {
                                                echo '<span style="color:green">Completed</span>';
                                            } elseif ($row['request_status'] == 1) {
                                                echo '<span style="color:blueviolet">Pending</span>';
                                            } elseif ($row['status'] == 1) {
                                                echo '<span style="color:green">Accepted</span>';
                                            } elseif ($row['is_cancelled'] == 1) {
                                                echo '<span style="color:red">Cancelled</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <center>
                                                <form method="POST">
                                                    <a href="#modal<?= $m++ ?>" class="btn btn-outline-primary"><i
                                                                class="fa fa-user"></i></a>
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                                    <?php if ($today > $date || $row['is_done'] == 1) {

                                                    }elseif ($row['is_done'] == 0 && $row['status'] == 1) {?>
                                                        <button class="btn btn-outline-info" type="submit" title="Mark as done"
                                                                name="done" style="cursor: pointer"><i class="fa fa-check"></i>
                                                        </button>
                                                        <button class="btn btn-outline-danger" type="submit" title="cancel"
                                                                name="cancel" style="cursor: pointer"
                                                                onclick="return confirm('Are sure to cancel?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    <?php } ?>

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
                                                while ($a = $x->fetch_assoc()) {
                                                    ?>
                                                    <img src="../../<?= $a['propic'] ?>" style="height: 150px;width: 150px"/>
                                                    <ul>
                                                        <li style="color:orangered">Ordered By</li>
                                                        <li><?= $a['first_name'] ?></li>


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