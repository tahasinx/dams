<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

$admin_id = $_SESSION['admin_id'];

require_once './server/Admin.php';
$result = "";
$data = "";

$server = new Admin();
$server->notification_seen('account');
$result = $server->adminData();

$data = $server->account_requests();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <?php include './parts/css-links.php'; ?>
    </head>

    <body>
        <div class="main-wrapper">
            <?php while ($row = $result->fetch_assoc()) { ?>
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
                        <div class="col-sm-6 col-3">
                            <h4 class="page-title"><u>Verification Requests</u></h4>
                        </div>
                        <div class="col-sm-6 col-9 text-right m-b-20">
                            <!--<a href="clients.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-users"></i> All Clients</a>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title d-inline-block">Total Requests[<span style="color:red"><?php echo $server->total_account_requests() ?></span>]</h4> 
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
                                                <div class="col-md-12 col-sm-12  col-lg-12">
                                                    <div class="profile-widget">
                                                        <center>
                                                            <img alt="" src="../../gallery/nodata-found.png" alt="" style="height: 100%;width: 100%">
                                                        </center>
                                                    </div>
                                                </div>
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
                <?php include './parts/messages.php'; ?>
            </div>
        </div>
        <?php include './parts/js-links.php'; ?>

    </body>
</html>