<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"]) && !isset($_SESSION["zone"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';

$result = "";
$output = "";

$server = new Partner();

$result = $server->partner_data();

$drugs = $server->processing_drugOrders();
$prescriptions = $server->processing_prescriptions();

if (isset($_POST['deliver'])) {

    if($_POST['x'] == 0){

        $server->drugOrder_delivered($_POST);

    }elseif ($_POST['x'] == 1){

        $server->prescription_delivered($_POST);

    }
}

if (isset($_POST['cancel'])) {

    if($_POST['x'] == 0){

        $server->drugOrder_cancelled($_POST);

    }elseif ($_POST['x'] == 1){

        $server->prescription_cancelled($_POST);

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
                <div class="col-sm-8">
                    <h4 class="page-title text-primary">
                        <u>Processing Orders</u>
                    </h4>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-7 col-md-7 col-lg-7 col-xl-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Orders For Drug
                                <a href="#" class="btn btn-outline-dark float-right">Total Orders:
                                    <span style="color: orangered"><?= $server->totalProcessing_drugOrders() ?></span>
                                </a>
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody id="myTable">
                                    <?php
                                    $i = 1;
                                    $j = 1;
                                    $m = 1000001;
                                    $n = 1000001;
                                    if ($drugs->num_rows > 0) {
                                        while ($row = $drugs->fetch_assoc()) {
                                            ?>

                                            <tr>
                                                <td>
                                                    <h5 class="time-title p-0">Ordered Drug</h5>
                                                    <p><?= $row['drug_name'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Delivery Type</h5>
                                                    <p><?= $row['delivery_type'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Total Price</h5>
                                                    <p><?= $row['total_price'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Ordered On</h5>
                                                    <p><?= $row['ordered_on'] ?></p>
                                                </td>
                                                <td class="text-right">
                                                    <a href="#modal<?= $i++ ?>"
                                                       class="btn btn-outline-primary " title="Ordered By">
                                                        <i class="fa fa-user"></i>
                                                    </a>
                                                    <a href="#modal<?= $m++ ?>"
                                                       class="btn btn-outline-danger " title="Take Action">
                                                        <i class="fa fa-tasks"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <div class="awesome-modal" id="modal<?= $j++ ?>">
                                                <a class="close-icon" href="#close"></a>
                                                <div class="row">
                                                    <div class="col-lg-10 offset-lg-1">

                                                        <?php
                                                        $x = $server->client_profile($row['client_id']);
                                                        while ($data = $x->fetch_assoc()){
                                                            ?>
                                                            <ul>
                                                                <li style="color:orangered">Ordered By</li>
                                                                <li><?= $data['first_name']?></li>


                                                                <li style="color:orangered">Country</li>
                                                                <li><?= $data['country'] ?></li>


                                                                <li style="color:orangered">City</li>
                                                                <li><?= $data['city'] ?></li>


                                                                <li style="color:orangered">Phone</li>
                                                                <li><?= $data['phone'] ?></li>


                                                                <li style="color:orangered">Email</li>
                                                                <li><?= $data['email'] ?></li>


                                                                <li style="color:orangered">Address</li>
                                                                <li><?= $data['address'] ?></li>
                                                            </ul>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="awesome-modal" id="modal<?= $n++ ?>">
                                                <a class="close-icon" href="#close"></a>
                                                <div class="row">
                                                    <div class="col-lg-10 offset-lg-1">

                                                        <center>
                                                            <form method="POST" action="">
                                                                <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                                                                <input type="hidden" name="x" value="0">
                                                                <button type="submit" name="deliver" class="btn btn-outline-success" style="cursor: pointer;width: 160px">
                                                                    <i class="fa fa-paper-plane"></i>&nbsp;Mark as delivered.
                                                                </button><br><br>
                                                                <button type="submit" name="cancel" class="btn btn-outline-danger" style="cursor: pointer;width: 160px" onclick="return confirm('Are you really sure to cancel?')">
                                                                    <i class="fa fa-remove"></i>&nbsp;Mark as cancelled.
                                                                </button><br><br>
                                                            </form>
                                                        </center>

                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="">
                                                <center>
                                                   <span class="text-danger">
                                                       This repository is empty.
                                                   </span>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-5 col-md-5 col-lg5 col-xl-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Orders By Prescription
                                <a href="#" class="btn btn-outline-dark float-right">Total Orders:
                                    <span style="color: orangered"><?= $server->totalProcessing_prescriptions() ?></span>
                                </a>
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody id="myTable">
                                    <?php
                                    $a = 20000001;
                                    $b = 20000001;
                                    $c = 30000001;
                                    $d = 30000001;
                                    if ($prescriptions->num_rows > 0) {
                                        while ($row = $prescriptions->fetch_assoc()) {
                                            ?>

                                            <tr>
                                                <td>
                                                    <h5 class="time-title p-0">Delivery Type</h5>
                                                    <p><?= "Home Delivery" ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Ordered On</h5>
                                                    <p><?= $row['ordered_on'] ?></p>
                                                </td>
                                                <td class="text-right">
                                                    <a href="../../<?= $row['prescription_image'] ?>" target="_blank"
                                                       class="btn btn-outline-primary " title="View Prescription">
                                                        <i class="fa fa-file"></i>
                                                    </a>
                                                    <a href="#modal<?= $a++ ?>"
                                                       class="btn btn-outline-primary " title="Ordered By">
                                                        <i class="fa fa-user"></i>
                                                    </a>
                                                    <a href="#modal<?= $c++ ?>"
                                                       class="btn btn-outline-danger " title="Take Action">
                                                        <i class="fa fa-tasks"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="awesome-modal" id="modal<?= $b++ ?>">
                                                <a class="close-icon" href="#close"></a>
                                                <div class="row">
                                                    <div class="col-lg-10 offset-lg-1">

                                                        <?php
                                                        $x = $server->client_profile($row['client_id']);
                                                        while ($data = $x->fetch_assoc()){
                                                            ?>
                                                            <ul>
                                                                <li style="color:orangered">Ordered By</li>
                                                                <li><?= $data['first_name']?></li>


                                                                <li style="color:orangered">Country</li>
                                                                <li><?= $data['country'] ?></li>


                                                                <li style="color:orangered">City</li>
                                                                <li><?= $data['city'] ?></li>


                                                                <li style="color:orangered">Phone</li>
                                                                <li><?= $data['phone'] ?></li>


                                                                <li style="color:orangered">Email</li>
                                                                <li><?= $data['email'] ?></li>


                                                                <li style="color:orangered">Address</li>
                                                                <li><?= $data['address'] ?></li>
                                                            </ul>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="awesome-modal" id="modal<?= $d++ ?>">
                                                <a class="close-icon" href="#close"></a>
                                                <div class="row">
                                                    <div class="col-lg-10 offset-lg-1">
                                                        <center>
                                                            <form method="POST" action="">
                                                                <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                                                                <input type="hidden" name="x" value="1">
                                                                <button type="submit" name="deliver" class="btn btn-outline-success" style="cursor: pointer;width: 160px">
                                                                    <i class="fa fa-paper-plane"></i>&nbsp;Mark as delivered.
                                                                </button><br><br>
                                                                <button type="submit" name="cancel" class="btn btn-outline-danger" style="cursor: pointer;width: 160px" onclick="return confirm('Are you really sure to cancel?')">
                                                                    <i class="fa fa-remove"></i>&nbsp;Mark as cancelled.
                                                                </button><br><br>
                                                            </form>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>


                                            <?php
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="">
                                                <center>
                                                   <span class="text-danger">
                                                       This repository is empty.
                                                   </span>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'parts/notifications.php' ?>

    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>

<!--scripts-->
<?php include './parts/js-links.php'; ?>
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
</body>


</html>