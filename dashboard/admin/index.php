<?php
session_start();
$adminid = $_SESSION['admin_id'];

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

require_once './server/Admin.php';
$result = "";
$datax ="";
$server = new Admin();
$result = $server->adminData();
$data = $server->account_requests();
$data2 = $server->location_requests();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">


        <?php
        include './parts/css-links.php';
        ?>

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
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3" onclick="window.location.href='partner-doctors.php'" style="cursor: pointer">
                            <div class="dash-widget">
                                <span class="dash-widget-bg1"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $server->total_doctors() ?></h3>
                                    <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3" onclick="window.location.href='partner-labs.php'" style="cursor: pointer">
                            <div class="dash-widget">
                                <span class="dash-widget-bg2"><i class="fa fa-medkit"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $server->total_labs() ?></h3>
                                    <span class="widget-title2">Labs <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3" onclick="window.location.href='partner-pharmacies.php'" style="cursor: pointer">
                            <div class="dash-widget">
                                <span class="dash-widget-bg3"><i class="fa fa-home" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $server->total_pharmacies() ?></h3>
                                    <span class="widget-title3">Pharmacy <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget">
                                <span class="dash-widget-bg4"><i class="fa fa-user-plus" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $server->total_account_requests() + $server->total_location_requests() ?></h3>
                                    <span class="widget-title4">Requests <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title d-inline-block">Account Requests</h4> <a href="account-verification.php" class="btn btn-primary float-right">View all</a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="d-none">

                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($data->num_rows > 0) {
                                                while ($row = $data->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td style="min-width: 200px;">
                                                            <a class="avatar" href=""><img src="<?php echo $row['institute_logo'] ?>" onerror="this.onerror=null; this.src='assets/img/medical.jpg'" alt=""/></a>
                                                            <h2><a href=""><?php echo $row['institute_name'] ?><span><?php echo $row['city'] ?>,<?php echo $row['country'] ?></span></a></h2>
                                                        </td>
                                                        <td>
                                                            <h5 class="time-title p-0">Type</h5>
                                                            <p>Account Verification</p>
                                                        </td>
                                                        <td class="text-right">
                                                            <a href="verify-account.php?partner_id=<?php echo $row['partner_id'] ?>&verification_type=account" class="btn btn-outline-primary take-btn">Take up</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td style="color:orangered">
                                                        <center>
                                                            No New Account Request Found!
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
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title d-inline-block">Location Requests</h4> <a href="location-verification.php" class="btn btn-primary float-right">View all</a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="d-none">

                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($data2->num_rows > 0) {
                                                while ($row = $data2->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td style="min-width: 200px;">
                                                            <a class="avatar" href=""><img src="<?php echo $row['institute_logo'] ?>" onerror="this.onerror=null; this.src='assets/img/medical.jpg'" alt=""/></a>
                                                            <h2><a href=""><?php echo $row['institute_name'] ?><span><?php echo $row['city'] ?>,<?php echo $row['country'] ?></span></a></h2>
                                                        </td>
                                                        <td>
                                                            <h5 class="time-title p-0">Type</h5>
                                                            <p>Location Verification</p>
                                                        </td>
                                                        <td class="text-right">
                                                            <a href="verify-location.php?partner_id=<?php echo $row['partner_id'] ?>&verification_type=location" class="btn btn-outline-primary take-btn">Take up</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td style="color:orangered">
                                                        <center>
                                                            No New Location Request Found!
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

            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>

        <!--scripts-->
        <?php include './parts/js-links.php'; ?>

    </body>


</html>